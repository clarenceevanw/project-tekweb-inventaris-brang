<?php

class Barang extends BaseModel {
    protected $table = 'barang';

    public function __construct()
    {
        return parent::__construct();
    }

    public function allByGudang($id_gudang) {
        $sql = "SELECT b.*, k.nama_kategori 
                FROM barang b
                JOIN kategori k ON b.id_kategori = k.id_kategori
                WHERE k.id_gudang = ?"; // Filter Gudang disini
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id_gudang]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function findByGudang($id_barang, $id_gudang) {
        $sql = "SELECT b.* FROM barang b
                JOIN kategori k ON b.id_kategori = k.id_kategori
                WHERE b.id_barang = ? AND k.id_gudang = ?";
                
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id_barang, $id_gudang]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function byKategori($id) {
        $stmt = $this->db->prepare("SELECT * FROM barang WHERE id_kategori=?");
        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function withKategoriAndStok($id_gudang = null) {
        $sql = "SELECT b.*, k.nama_kategori, 
                (SELECT COALESCE(SUM(sisa_kuantitas), 0) 
                FROM detail_transaksi dt 
                WHERE dt.id_barang = b.id_barang AND dt.expired_date > CURDATE()) as total_stok
                FROM barang b
                JOIN kategori k ON b.id_kategori = k.id_kategori";
        
        if ($id_gudang) {
            $sql .= " WHERE k.id_gudang = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$id_gudang]);
        } else {
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
        }
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}