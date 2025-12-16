<?php

class TransaksiSubscription extends BaseModel {
    protected $table = 'transaksi_subscription';

    public function __construct() {
        return parent::__construct();
    }

    public function getDetailWithPaket($id_subscription) {
        $sql = "SELECT t.*, p.durasi_hari, p.nama_paket 
                FROM transaksi_subscription t
                JOIN paket_subscription p ON t.id_paket = p.id_paket
                WHERE t.id_subscription = ?";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id_subscription]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function getPendingByGudang($id_gudang) {
        $sql = "SELECT * FROM transaksi_subscription 
                WHERE id_gudang = ? AND status_bayar = 'pending'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id_gudang]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getStats() {
        $data = [];
        
        $stmt = $this->db->prepare("
            SELECT COUNT(*) as count 
            FROM gudang 
            WHERE expired_date_gudang > NOW()
        ");
        $stmt->execute();
        $data['total_aktif'] = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
        
        $stmt = $this->db->prepare("
            SELECT COUNT(*) as count 
            FROM gudang 
            WHERE expired_date_gudang > NOW()
            AND expired_date_gudang <= DATE_ADD(NOW(), INTERVAL 7 DAY)
        ");
        $stmt->execute();
        $data['akan_berakhir'] = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
        
        $stmt = $this->db->prepare("SELECT COUNT(*) as count FROM gudang");
        $stmt->execute();
        $data['total_gudang'] = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
        
        return $data;
    }

    public function getPaketPopuler($startDate = null, $endDate = null) {
        if ($startDate && $endDate) {
            $stmt = $this->db->prepare("
                SELECT p.nama_paket, COUNT(ts.id_subscription) as total_pembelian
                FROM paket_subscription p
                LEFT JOIN transaksi_subscription ts ON p.id_paket = ts.id_paket
                WHERE p.nama_paket NOT LIKE '%trial%' 
                AND ts.status_bayar LIKE '%lunas%'
                AND DATE(ts.tanggal_bayar) BETWEEN ? AND ?
                GROUP BY p.id_paket
                ORDER BY total_pembelian DESC
                LIMIT 5
            ");
            $stmt->execute([$startDate, $endDate]);
        } else {
            $stmt = $this->db->prepare("
                SELECT p.nama_paket, COUNT(ts.id_subscription) as total_pembelian
                FROM paket_subscription p
                LEFT JOIN transaksi_subscription ts ON p.id_paket = ts.id_paket
                WHERE p.nama_paket NOT LIKE '%trial%' AND ts.status_bayar LIKE '%lunas%'
                GROUP BY p.id_paket
                ORDER BY total_pembelian DESC
                LIMIT 5
            ");
            $stmt->execute();
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getBulanIni($startDate = null, $endDate = null) {
        if ($startDate && $endDate) {
            $stmt = $this->db->prepare("
                SELECT g.nama_gudang, p.nama_paket, ts.tanggal_bayar as tanggal_transaksi, ts.status_bayar
                FROM transaksi_subscription ts
                JOIN gudang g ON ts.id_gudang = g.id_gudang
                JOIN paket_subscription p ON ts.id_paket = p.id_paket
                WHERE DATE(ts.tanggal_bayar) BETWEEN ? AND ?
                ORDER BY ts.tanggal_bayar DESC
                LIMIT 10
            ");
            $stmt->execute([$startDate, $endDate]);
        } else {
            $stmt = $this->db->prepare("
                SELECT g.nama_gudang, p.nama_paket, ts.tanggal_bayar as tanggal_transaksi, ts.status_bayar
                FROM transaksi_subscription ts
                JOIN gudang g ON ts.id_gudang = g.id_gudang
                JOIN paket_subscription p ON ts.id_paket = p.id_paket
                WHERE MONTH(ts.tanggal_bayar) = MONTH(NOW())
                AND YEAR(ts.tanggal_bayar) = YEAR(NOW())
                ORDER BY ts.tanggal_bayar DESC
                LIMIT 10
            ");
            $stmt->execute();
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getChartData($periode = 30, $startDate = null, $endDate = null) {
        if ($startDate && $endDate) {
            $stmt = $this->db->prepare("
                SELECT DATE(tanggal_bayar) as tanggal, COUNT(*) as total
                FROM transaksi_subscription
                WHERE DATE(tanggal_bayar) BETWEEN ? AND ?
                GROUP BY DATE(tanggal_bayar)
                ORDER BY tanggal ASC
            ");
            $stmt->execute([$startDate, $endDate]);
        } else {
            $stmt = $this->db->prepare("
                SELECT DATE(tanggal_bayar) as tanggal, COUNT(*) as total
                FROM transaksi_subscription
                WHERE tanggal_bayar >= DATE_SUB(NOW(), INTERVAL ? DAY)
                GROUP BY DATE(tanggal_bayar)
                ORDER BY tanggal ASC
            ");
            $stmt->execute([$periode]);
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllWithDetails() {
        $stmt = $this->db->prepare("
            SELECT g.nama_gudang, p.nama_paket, ts.tanggal_bayar, ts.status_bayar, p.id_paket
            FROM transaksi_subscription ts
            JOIN gudang g ON ts.id_gudang = g.id_gudang
            JOIN paket_subscription p ON ts.id_paket = p.id_paket
            ORDER BY ts.tanggal_bayar DESC
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}