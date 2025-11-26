<?php

class Barang extends BaseModel {
    protected $table = 'barang';

    public function __construct()
    {
        return parent::__construct();
    }

    public function byKategori($id) {
        $stmt = $this->db->prepare("SELECT * FROM barang WHERE id_kategori=?");
        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}