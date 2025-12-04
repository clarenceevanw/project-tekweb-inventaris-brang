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
}