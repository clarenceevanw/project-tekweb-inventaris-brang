<?php

class Kategori extends BaseModel {
    protected $table = 'kategori';

    public function __construct()
    {
        return parent::__construct();
    }
    public function byGudang($id) {
        $stmt = $this->db->prepare("SELECT * FROM kategori WHERE id_gudang=?");
        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}