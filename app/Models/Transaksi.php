<?php

require_once __DIR__ . '/DetailTransaksi.php';

class Transaksi extends BaseModel {
    protected $table = 'transaksi';

    public function __construct()
    {
        return parent::__construct();
    }

    public function createFullTransaction($dataTransaksi, $items) {
        try {
            $this->db->beginTransaction();

            $transaksiId = generate_uuid(); 

            $sqlTrans = "INSERT INTO transaksi (id_transaksi, jenis_transaksi, id_mitra, id_admin) VALUES (?, ?, ?, ?)";
            $stmt = $this->db->prepare($sqlTrans);
            $stmt->execute([
                $transaksiId, 
                $dataTransaksi['jenis_transaksi'], 
                $dataTransaksi['id_mitra'], 
                $dataTransaksi['id_admin']
            ]);

            // 4. Insert Detail Transaksi (Looping items)
            $sqlDetail = "INSERT INTO detail_transaksi (id_detail_transaksi, kuantitas_transaksi, sisa_kuantitas, expired_date, id_transaksi, id_barang) VALUES (?, ?, ?, ?, ?, ?)";
            $stmtDetail = $this->db->prepare($sqlDetail);

            foreach($items as $item) {
                $stmtDetail->execute([
                    generate_uuid(),
                    $item['qty'],
                    $item['qty'],
                    $item['expired_date'],
                    $transaksiId,
                    $item['id_barang']
                ]);
            }

            $this->db->commit();
            return true;

        } catch (Exception $e) {
            $this->db->rollBack();
            return false;
        }
    }

    public function countByGudangAndType($id_gudang, $jenis_transaksi) {
        $stmt = $this->db->prepare("SELECT COUNT(*) as total FROM transaksi t JOIN admin a ON t.id_admin = a.id_admin WHERE a.id_gudang = ? AND t.jenis_transaksi = ?");
        $stmt->execute([$id_gudang, $jenis_transaksi]);
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    public function getMonthlyTransaksi($id_gudang, $months = 6) {
        $stmt = $this->db->prepare("SELECT DATE_FORMAT(t.tanggal_transaksi, '%Y-%m') as bulan, t.jenis_transaksi, COUNT(*) as jumlah FROM transaksi t JOIN admin a ON t.id_admin = a.id_admin WHERE a.id_gudang = ? AND t.tanggal_transaksi >= DATE_SUB(CURDATE(), INTERVAL ? MONTH) GROUP BY bulan, t.jenis_transaksi ORDER BY bulan");
        $stmt->execute([$id_gudang, $months]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByGudang($id_gudang) {
        $stmt = $this->db->prepare("SELECT t.*, m.nama_mitra FROM transaksi t LEFT JOIN mitra m ON t.id_mitra = m.id_mitra JOIN admin a ON t.id_admin = a.id_admin WHERE a.id_gudang = ? ORDER BY t.tanggal_transaksi DESC");
        $stmt->execute([$id_gudang]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDetailById($id_transaksi) {
        $stmt = $this->db->prepare("SELECT t.*, m.nama_mitra, a.nama_admin FROM transaksi t LEFT JOIN mitra m ON t.id_mitra = m.id_mitra LEFT JOIN admin a ON t.id_admin = a.id_admin WHERE t.id_transaksi = ?");
        $stmt->execute([$id_transaksi]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}