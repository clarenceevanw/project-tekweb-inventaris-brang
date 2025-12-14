<?php

require_once __DIR__ . '/../Models/Barang.php';
require_once __DIR__ . '/../Models/Transaksi.php';
require_once __DIR__ . '/../Models/Mitra.php';
require_once __DIR__ . '/../Services/SubscriptionService.php';

class DashboardController extends BaseController {
    private $barangModel;
    private $transaksiModel;
    private $mitraModel;
    private $subscriptionService;

    public function __construct() {
        parent::__construct();
        $this->barangModel = new Barang();
        $this->transaksiModel = new Transaksi();
        $this->mitraModel = new Mitra();
        $this->subscriptionService = new SubscriptionService();
    }
    
    public function adminDashboard() {
        $id_gudang = $_SESSION['gudang']['id_gudang'];

        $data['total_barang'] = $this->barangModel->countByGudang($id_gudang);
        $data['total_stok'] = $this->barangModel->getTotalStokByGudang($id_gudang);
        $data['total_supply'] = $this->transaksiModel->countByGudangAndType($id_gudang, 'supply');
        $data['total_buy'] = $this->transaksiModel->countByGudangAndType($id_gudang, 'buy');
        $data['transaksi_bulanan'] = $this->transaksiModel->getMonthlyTransaksi($id_gudang, 6);
        $data['top_barang'] = $this->barangModel->getTopBarangByStok($id_gudang, 5);
        $data['paket_list'] = $this->subscriptionService->getAllPaket();

        $data['title'] = 'Dashboard';
        return $this->view('admin/dashboard', $data);
    }

    public function mitraDashboard() {
        $id_mitra = $_SESSION['user']['id_mitra'];

        $data['total_transaksi'] = $this->mitraModel->getTotalTransaksi($id_mitra);
        $data['transaksi_bulan_ini'] = $this->mitraModel->getTransaksiBulanIni($id_mitra);
        $data['transaksi_bulan_lalu'] = $this->mitraModel->getTransaksiBulanLalu($id_mitra);
        $data['total_supply'] = $this->mitraModel->getTotalSupply($id_mitra);
        $data['total_buy'] = $this->mitraModel->getTotalBuy($id_mitra);
        $data['rata_rata_per_hari'] = $this->mitraModel->getRataRataPerHari($id_mitra);
        $data['gudang_favorit'] = $this->mitraModel->getGudangFavorit($id_mitra);
        $data['trend_7_hari'] = $this->mitraModel->getTrend7Hari($id_mitra);
        $data['top_barang'] = $this->mitraModel->getTopBarang($id_mitra, 5);
        $data['aktivitas_terbaru'] = $this->mitraModel->getAktivitasTerbaru($id_mitra, 5);

        $data['title'] = 'Dashboard Mitra';
        return $this->view('mitra/dashboard', $data);
    }

    public function pembayaran() {
        $data['paket_list'] = $this->subscriptionService->getAllPaket();
        $data['title'] = 'Perpanjang Langganan';
        return $this->view('admin/pembayaran', $data);
    }
}
