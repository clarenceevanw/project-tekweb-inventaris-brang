<?php

class Ruangan extends BaseModel {
    protected $table = 'ruangan';

    public function __construct()
    {
        return parent::__construct();
    }

    public function byGudang($id) {
        $stmt = $this->db->prepare("SELECT * FROM ruangan WHERE id_gudang=?");
        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getRuanganByBatch($id) {
        $sql = "SELECT r.*, dr.kuantitas_ruangan 
                FROM ruangan r 
                JOIN detail_ruangan dr ON r.id_ruangan = dr.id_ruangan 
                WHERE dr.id_detail_transaksi = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}