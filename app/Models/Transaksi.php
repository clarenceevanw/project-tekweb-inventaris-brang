<?php

require_once __DIR__ . '/DetailTransaksi.php';

class Transaksi extends BaseModel {
    protected $table = 'transaksi';

    public function __construct()
    {
        return parent::__construct();
    }
}