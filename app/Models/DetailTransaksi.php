<?php

class DetailTransaksi extends BaseModel {
    protected $table = 'detail_transaksi';

    public function almostExpired($days=7) {
        return $this->db->query("
            SELECT * FROM detail_transaksi 
            WHERE expired_date <= DATE_ADD(CURDATE(), INTERVAL $days DAY)
            AND sisa_kuantitas > 0
        ")->fetchAll(PDO::FETCH_ASSOC);
    }
}
