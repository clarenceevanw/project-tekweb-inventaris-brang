<?php

require_once __DIR__ . "/../Models/SuperAdmin.php";
require_once __DIR__ . "/../Models/Gudang.php";
require_once __DIR__ . "/../Models/Admin.php";
require_once __DIR__ . "/../Models/Mitra.php";

class SuperAdminController extends BaseController
{
    private $superAdminModel;
    private $gudangModel;
    private $adminModel;
    private $mitraModel;

    public function __construct()
    {
        parent::__construct();
        $this->superAdminModel = new SuperAdmin();
        $this->gudangModel = new Gudang();
        $this->adminModel = new Admin();
        $this->mitraModel = new Mitra();
    }

    public function dashboard()
    {
        $stats = $this->superAdminModel->getDashboardStats();
        $recentGudang = $this->superAdminModel->getRecentGudang();
        $recentAdmin = $this->superAdminModel->getRecentAdmin();
        $gudangChartData = $this->superAdminModel->getGudangChartData();
        $adminChartData = $this->superAdminModel->getAdminChartData();

        return $this->view('superadmin/dashboard', [
            'title' => 'Dashboard Super Admin',
            'total_gudang' => $stats['total_gudang'],
            'total_admin' => $stats['total_admin'],
            'total_mitra' => $stats['total_mitra'],
            'total_transaksi' => $stats['total_transaksi'],
            'recent_gudang' => $recentGudang,
            'recent_admin' => $recentAdmin,
            'gudang_chart_data' => array_column($gudangChartData, 'count'),
            'admin_chart_data' => $adminChartData
        ]);
    }

    public function gudang()
    {
        $gudangList = $this->superAdminModel->getAllGudangWithAdmin();

        $totalGudang = count($gudangList);
        $gudangAktif = 0;
        foreach ($gudangList as $g) {
            if (($g['status_gudang'] ?? 'active') === 'active') {
                $gudangAktif++;
            }
        }
        $gudangTidakAktif = $totalGudang - $gudangAktif;

        return $this->view('superadmin/gudang', [
            'title' => 'Kelola Gudang',
            'gudang_list' => $gudangList,
            'total_gudang' => $totalGudang,
            'gudang_aktif' => $gudangAktif,
            'gudang_tidak_aktif' => $gudangTidakAktif
        ]);
    }

    public function admin()
    {
        $adminList = $this->superAdminModel->getAllAdminWithGudang();
        $gudangOptions = $this->gudangModel->all();

        $totalAdmin = count($adminList);
        $adminAktif = 0;
        $adminBelumDitugaskan = 0;
        foreach ($adminList as $a) {
            if (!empty($a['id_gudang'])) {
                $adminAktif++;
            } else {
                $adminBelumDitugaskan++;
            }
        }

        return $this->view('superadmin/admin', [
            'title' => 'Kelola Admin',
            'admin_list' => $adminList,
            'gudang_options' => $gudangOptions,
            'total_admin' => $totalAdmin,
            'admin_aktif' => $adminAktif,
            'admin_belum_ditugaskan' => $adminBelumDitugaskan
        ]);
    }

    public function mitra()
    {
        $mitraList = $this->superAdminModel->getAllMitraWithSubscription();

        $totalMitra = count($mitraList);
        $mitraAktif = $totalMitra;
        
        // Hitung gudang dengan langganan aktif
        $gudangAktif = $this->superAdminModel->getGudangAktifCount();
        $langgananAktif = $gudangAktif;
        $akanBerakhir = $this->superAdminModel->getGudangAkanBerakhir();

        return $this->view('superadmin/mitra', [
            'title' => 'Kelola Mitra',
            'mitra_list' => $mitraList,
            'total_mitra' => $totalMitra,
            'mitra_aktif' => $mitraAktif,
            'langganan_aktif' => $langgananAktif,
            'akan_berakhir' => $akanBerakhir
        ]);
    }

    public function laporan()
    {
        $laporanData = $this->superAdminModel->getLaporanData();
        $topGudang = $this->superAdminModel->getTopGudang();

        return $this->view('superadmin/laporan', [
            'title' => 'Laporan',
            'total_pendapatan' => $laporanData['total_pendapatan'],
            'transaksi_baru' => $laporanData['transaksi_baru'],
            'gudang_baru' => $laporanData['gudang_baru'],
            'mitra_baru' => $laporanData['mitra_baru'],
            'top_gudang' => $topGudang,
            'recent_activities' => []
        ]);
    }

    // CRUD Operations
    public function storeGudang()
    {
        if ($this->superAdminModel->createGudang($_POST)) {
            return $this->json(['success' => true, 'message' => 'Gudang berhasil ditambahkan!']);
        }
        return $this->json(['success' => false, 'message' => 'Gagal menambahkan gudang!']);
    }

    public function storeAdmin()
    {
        if ($this->superAdminModel->createAdmin($_POST)) {
            return $this->json(['success' => true, 'message' => 'Admin berhasil ditambahkan!']);
        }
        return $this->json(['success' => false, 'message' => 'Gagal menambahkan admin!']);
    }

    public function storeMitra()
    {
        if ($this->superAdminModel->createMitra($_POST)) {
            return $this->json(['success' => true, 'message' => 'Mitra berhasil ditambahkan!']);
        }
        return $this->json(['success' => false, 'message' => 'Gagal menambahkan mitra!']);
    }

    public function updateGudang()
    {
        $id = $_POST['id_gudang'];
        $namaGudang = $_POST['nama_gudang'];
        $alamat = $_POST['alamat'];
        
        if ($this->superAdminModel->updateGudang($id, $namaGudang, $alamat)) {
            return $this->json(['success' => true, 'message' => 'Gudang berhasil diupdate!']);
        }
        return $this->json(['success' => false, 'message' => 'Gagal mengupdate gudang!']);
    }

    public function deleteGudang()
    {
        $id = $_POST['id'];
        if ($this->superAdminModel->deleteGudang($id)) {
            return $this->json(['success' => true, 'message' => 'Gudang berhasil dihapus!']);
        }
        return $this->json(['success' => false, 'message' => 'Gagal menghapus gudang!']);
    }

    public function deleteAdmin()
    {
        $id = $_POST['id'];
        if ($this->superAdminModel->deleteAdmin($id)) {
            return $this->json(['success' => true, 'message' => 'Admin berhasil dihapus!']);
        }
        return $this->json(['success' => false, 'message' => 'Gagal menghapus admin!']);
    }

    public function deleteMitra()
    {
        $id = $_POST['id'];
        if ($this->superAdminModel->deleteMitra($id)) {
            return $this->json(['success' => true, 'message' => 'Mitra berhasil dihapus!']);
        }
        return $this->json(['success' => false, 'message' => 'Gagal menghapus mitra!']);
    }
}