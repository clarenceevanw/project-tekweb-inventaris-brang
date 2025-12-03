<?php

class DetailRuangan extends BaseModel
{
    protected $table = 'detail_ruangan';
    public function __construct()
    {
        return parent::__construct();
    }

    public function getBarangByRuangan($id_ruangan) {
        $sql = "SELECT b.id_barang, b.nama_barang, SUM(dr.kuantitas_ruangan) as total_stok
                FROM detail_ruangan dr
                JOIN detail_transaksi dt ON dr.id_detail_transaksi = dt.id_detail_transaksi
                JOIN barang b ON dt.id_barang = b.id_barang
                WHERE dr.id_ruangan = ?
                GROUP BY b.id_barang, b.nama_barang";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id_ruangan]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getActiveBarangByRuangan($id_ruangan) {
        $sql = "SELECT b.id_barang, b.nama_barang, SUM(dr.kuantitas_ruangan) as total_stok
                FROM detail_ruangan dr
                JOIN detail_transaksi dt ON dr.id_detail_transaksi = dt.id_detail_transaksi
                JOIN barang b ON dt.id_barang = b.id_barang
                WHERE dr.id_ruangan = ?
                GROUP BY b.id_barang, b.nama_barang
                HAVING SUM(dr.kuantitas_ruangan) > 0";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id_ruangan]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getBatchByRuanganBarang($id_ruangan, $id_barang) {
        $sql = "SELECT dr.*, dt.expired_date, dt.id_detail_transaksi, b.nama_barang
                FROM detail_ruangan dr
                JOIN detail_transaksi dt ON dr.id_detail_transaksi = dt.id_detail_transaksi
                JOIN barang b ON dt.id_barang = b.id_barang
                WHERE dr.id_ruangan = ? AND dt.id_barang = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id_ruangan, $id_barang]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}