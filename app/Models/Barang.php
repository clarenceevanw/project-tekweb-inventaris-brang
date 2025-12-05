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
                WHERE dt.id_barang = b.id_barang) as total_stok
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

    public function countByGudang($id_gudang) {
        $stmt = $this->db->prepare("SELECT COUNT(*) as total FROM barang b JOIN kategori k ON b.id_kategori = k.id_kategori WHERE k.id_gudang = ?");
        $stmt->execute([$id_gudang]);
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    public function getTotalStokByGudang($id_gudang) {
        $stmt = $this->db->prepare("SELECT COALESCE(SUM(dt.sisa_kuantitas), 0) as total FROM detail_transaksi dt JOIN barang b ON dt.id_barang = b.id_barang JOIN kategori k ON b.id_kategori = k.id_kategori WHERE k.id_gudang = ?");
        $stmt->execute([$id_gudang]);
        return (int)$stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    public function getTopBarangByStok($id_gudang, $limit = 5) {
        $limit = (int)$limit;
        $stmt = $this->db->prepare("SELECT b.nama_barang, COALESCE(SUM(dt.sisa_kuantitas), 0) as stok FROM barang b JOIN kategori k ON b.id_kategori = k.id_kategori LEFT JOIN detail_transaksi dt ON b.id_barang = dt.id_barang WHERE k.id_gudang = ? GROUP BY b.id_barang ORDER BY stok DESC LIMIT $limit");
        $stmt->execute([$id_gudang]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function byGudang($id_gudang) {
        $stmt = $this->db->prepare("SELECT b.* FROM barang b JOIN kategori k ON b.id_kategori = k.id_kategori WHERE k.id_gudang = ?");
        $stmt->execute([$id_gudang]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}