<?php

class Gudang extends BaseModel {
    protected $table = 'gudang';

    public function __construct() {
        return parent::__construct();
    }

    public function perpanjangSewa($id_gudang, $durasi_hari) {
        $gudang = $this->find('id_gudang', $id_gudang);
        
        $sekarang = time();
        $expired_lama = strtotime($gudang['expired_date_gudang']);
        
        if ($expired_lama > $sekarang) {
            $tanggal_baru = date('Y-m-d H:i:s', strtotime("+$durasi_hari days", $expired_lama));
        } else {
            $tanggal_baru = date('Y-m-d H:i:s', strtotime("+$durasi_hari days"));
        }

        return $this->update([
            'expired_date_gudang' => $tanggal_baru,  
            'status_gudang' => 'active'
        ], 'id_gudang', $id_gudang);
    }
}
