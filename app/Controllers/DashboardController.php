<?php

require __DIR__ . '/../Models/Barang.php';
require __DIR__ . '/../Models/Transaksi.php';

class DashboardController extends BaseController {
    private $barangModel;
    private $transaksiModel;

    public function __construct() {
        parent::__construct();
        $this->barangModel = new Barang();
        $this->transaksiModel = new Transaksi();
    }
    
    public function adminDashboard() {
        $id_gudang = $_SESSION['gudang']['id_gudang'];
        
        $data['total_barang'] = $this->barangModel->countByGudang($id_gudang);
        $data['total_stok'] = $this->barangModel->getTotalStokByGudang($id_gudang);
        $data['total_supply'] = $this->transaksiModel->countByGudangAndType($id_gudang, 'supply');
        $data['total_buy'] = $this->transaksiModel->countByGudangAndType($id_gudang, 'buy');
        $data['transaksi_bulanan'] = $this->transaksiModel->getMonthlyTransaksi($id_gudang, 6);
        $data['top_barang'] = $this->barangModel->getTopBarangByStok($id_gudang, 5);
        $data['title'] = 'Dashboard';
        
        return $this->view('admin/dashboard', $data);
    }

    public function mitraDashboard() {
        $data['title'] = 'Dashboard Mitra';
        return $this->view('mitra/dashboard', $data);
    }
}
