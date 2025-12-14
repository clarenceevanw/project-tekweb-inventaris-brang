<?php

class Mitra extends BaseModel
{
    protected $table = 'mitra';

    public function __construct()
    {
        return parent::__construct();
    }

    public function signUp($data) {
        return $this->insert($data);
    }

    public function historySupply($id) {
        $stmt = $this->db->prepare("
            SELECT t.*, b.nama_barang, d.kuantitas_transaksi, g.nama_gudang
            FROM transaksi t
            JOIN detail_transaksi d ON t.id_transaksi = d.id_transaksi
            JOIN barang b ON d.id_barang = b.id_barang
            JOIN admin a on t.id_admin = a.id_admin
            JOIN gudang g on a.id_gudang = g.id_gudang
            WHERE t.id_mitra = ? AND t.jenis_transaksi = 'supply'
            ORDER BY t.tanggal_transaksi DESC
        ");
        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function historyBuy($id) {
        $stmt = $this->db->prepare("
            SELECT t.*, b.nama_barang, d.kuantitas_transaksi, g.nama_gudang
            FROM transaksi t
            JOIN detail_transaksi d ON t.id_transaksi = d.id_transaksi
            JOIN barang b ON d.id_barang = b.id_barang
            JOIN admin a on t.id_admin = a.id_admin
            JOIN gudang g on a.id_gudang = g.id_gudang
            WHERE t.id_mitra = ? AND t.jenis_transaksi = 'buy'
            ORDER BY t.tanggal_transaksi DESC
        ");
        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTotalTransaksi($id_mitra) {
        $stmt = $this->db->prepare("SELECT COUNT(*) as total FROM transaksi WHERE id_mitra = ?");
        $stmt->execute([$id_mitra]);
        return (int)$stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    public function getTransaksiBulanIni($id_mitra) {
        $stmt = $this->db->prepare(
            "SELECT COUNT(*) as total FROM transaksi 
            WHERE id_mitra = ? 
            AND MONTH(tanggal_transaksi) = MONTH(CURDATE()) 
            AND YEAR(tanggal_transaksi) = YEAR(CURDATE())"
        );
        $stmt->execute([$id_mitra]);
        return (int)$stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    public function getTotalSupply($id_mitra) {
        $stmt = $this->db->prepare(
            "SELECT COUNT(*) as total FROM transaksi 
            WHERE id_mitra = ? AND jenis_transaksi = 'supply'"
        );
        $stmt->execute([$id_mitra]);
        return (int)$stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    public function getTotalBuy($id_mitra) {
        $stmt = $this->db->prepare(
            "SELECT COUNT(*) as total FROM transaksi 
            WHERE id_mitra = ? AND jenis_transaksi = 'buy'"
        );
        $stmt->execute([$id_mitra]);
        return (int)$stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    public function getAktivitasTerbaru($id_mitra, $limit = 5) {
        $limit = (int)$limit;
        $stmt = $this->db->prepare(
            "SELECT t.tanggal_transaksi, t.jenis_transaksi, b.nama_barang, 
            dt.kuantitas_transaksi, g.nama_gudang, a.nama_admin
            FROM transaksi t
            JOIN detail_transaksi dt ON t.id_transaksi = dt.id_transaksi
            JOIN barang b ON dt.id_barang = b.id_barang
            JOIN admin a ON t.id_admin = a.id_admin
            JOIN gudang g ON a.id_gudang = g.id_gudang
            WHERE t.id_mitra = ?
            ORDER BY t.tanggal_transaksi DESC
            LIMIT $limit"
        );
        $stmt->execute([$id_mitra]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTrend7Hari($id_mitra) {
        $stmt = $this->db->prepare(
            "SELECT DATE(t.tanggal_transaksi) as tanggal, 
            t.jenis_transaksi,
            COUNT(*) as jumlah
            FROM transaksi t
            WHERE t.id_mitra = ? 
            AND t.tanggal_transaksi >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)
            GROUP BY DATE(t.tanggal_transaksi), t.jenis_transaksi
            ORDER BY tanggal"
        );
        $stmt->execute([$id_mitra]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTopBarang($id_mitra, $limit = 5) {
        $limit = (int)$limit;
        $stmt = $this->db->prepare(
            "SELECT b.nama_barang, COUNT(*) as total_transaksi
            FROM transaksi t
            JOIN detail_transaksi dt ON t.id_transaksi = dt.id_transaksi
            JOIN barang b ON dt.id_barang = b.id_barang
            WHERE t.id_mitra = ?
            GROUP BY b.id_barang
            ORDER BY total_transaksi DESC
            LIMIT $limit"
        );
        $stmt->execute([$id_mitra]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getGudangFavorit($id_mitra) {
        $stmt = $this->db->prepare(
            "SELECT g.nama_gudang, COUNT(*) as total
            FROM transaksi t
            JOIN admin a ON t.id_admin = a.id_admin
            JOIN gudang g ON a.id_gudang = g.id_gudang
            WHERE t.id_mitra = ?
            GROUP BY g.id_gudang
            ORDER BY total DESC
            LIMIT 1"
        );
        $stmt->execute([$id_mitra]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['nama_gudang'] : '-';
    }

    public function getTransaksiBulanLalu($id_mitra) {
        $stmt = $this->db->prepare(
            "SELECT COUNT(*) as total FROM transaksi 
            WHERE id_mitra = ? 
            AND MONTH(tanggal_transaksi) = MONTH(DATE_SUB(CURDATE(), INTERVAL 1 MONTH))
            AND YEAR(tanggal_transaksi) = YEAR(DATE_SUB(CURDATE(), INTERVAL 1 MONTH))"
        );
        $stmt->execute([$id_mitra]);
        return (int)$stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    public function getRataRataPerHari($id_mitra) {
        $stmt = $this->db->prepare(
            "SELECT COUNT(*) / 30 as rata_rata FROM transaksi 
            WHERE id_mitra = ? 
            AND tanggal_transaksi >= DATE_SUB(CURDATE(), INTERVAL 30 DAY)"
        );
        $stmt->execute([$id_mitra]);
        return round($stmt->fetch(PDO::FETCH_ASSOC)['rata_rata'], 1);
    }
}