<?php

class TransaksiSubscription extends BaseModel {
    protected $table = 'transaksi_subscription';

    public function __construct() {
        return parent::__construct();
    }

    public function getDetailWithPaket($id_subscription) {
        $sql = "SELECT t.*, p.durasi_hari, p.nama_paket 
                FROM transaksi_subscription t
                JOIN paket_subscription p ON t.id_paket = p.id_paket
                WHERE t.id_subscription = ?";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id_subscription]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function getPendingByGudang($id_gudang) {
        $sql = "SELECT * FROM transaksi_subscription 
                WHERE id_gudang = ? AND status_bayar = 'pending'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id_gudang]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}