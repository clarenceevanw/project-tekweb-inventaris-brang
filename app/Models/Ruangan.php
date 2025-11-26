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
}