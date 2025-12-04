<?php

require __DIR__ . '/../Models/Barang.php';
require __DIR__ . '/../Models/Transaksi.php';
require __DIR__ . '/../Models/PaketSubscription.php';

class DashboardController extends BaseController {
    private $barangModel;
    private $transaksiModel;
    private $paketModel;

    public function __construct() {
        parent::__construct();
        $this->barangModel = new Barang();
        $this->transaksiModel = new Transaksi();
        $this->paketModel = new PaketSubscription();
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

    public function pembayaran() {
        $data['paket_list'] = $this->paketModel->all();
        $data['title'] = 'Perpanjang Langganan';
        return $this->view('admin/pembayaran', $data);
    }
}
