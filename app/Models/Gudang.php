<?php

class Gudang extends BaseModel {
    protected $table = 'gudang';

    protected $nama_gudang;
    protected $lokasi_gudang;

    public function __construct() {
        parent::__construct();
    }
}
