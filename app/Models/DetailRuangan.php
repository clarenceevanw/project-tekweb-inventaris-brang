<?php

class DetailRuangan extends BaseModel
{
    protected $table = 'detail_ruangan';
    public function __construct()
    {
        return parent::__construct();
    }

    public function getIsiRuangan($id_ruangan) {
        $sql = "SELECT dr.*, b.nama_barang, dt.expired_date 
                FROM detail_ruangan dr
                JOIN detail_transaksi dt ON dr.id_detail_transaksi = dt.id_detail_transaksi
                JOIN barang b ON dt.id_barang = b.id_barang
                WHERE dr.id_ruangan = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id_ruangan]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}