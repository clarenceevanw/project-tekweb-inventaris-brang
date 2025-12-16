<?php

require_once __DIR__ . "/../Models/SuperAdmin.php";
require_once __DIR__ . "/../Models/Gudang.php";
require_once __DIR__ . "/../Models/Admin.php";
require_once __DIR__ . "/../Models/Mitra.php";
require_once __DIR__ . "/../Models/TransaksiSubscription.php";

class SuperAdminController extends BaseController
{
    private $superAdminModel;
    private $gudangModel;
    private $adminModel;
    private $mitraModel;
    private $subscriptionModel;

    public function __construct()
    {
        parent::__construct();
        $this->superAdminModel = new SuperAdmin();
        $this->gudangModel = new Gudang();
        $this->adminModel = new Admin();
        $this->mitraModel = new Mitra();
        $this->subscriptionModel = new TransaksiSubscription();
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
        $gudangList = $this->gudangModel->getAllWithAdmin();

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
        
        $gudangAktif = $this->gudangModel->getAktifCount();
        $langgananAktif = $gudangAktif;
        $akanBerakhir = $this->gudangModel->getAkanBerakhir();

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
        $subscriptionStats = $this->subscriptionModel->getStats();
        $gudangAkanBerakhir = $this->gudangModel->getAkanBerakhir();
        $allSubscriptions = $this->subscriptionModel->getAllWithDetails();

        return $this->view('superadmin/laporan', [
            'title' => 'Laporan Subscription',
            'total_subscription_aktif' => $subscriptionStats['total_aktif'],
            'akan_berakhir_7_hari' => $subscriptionStats['akan_berakhir'],
            'total_gudang_terdaftar' => $subscriptionStats['total_gudang'],
            'gudang_akan_berakhir' => $gudangAkanBerakhir,
            'all_subscriptions' => $allSubscriptions
        ]);
    }

    // CRUD Operations
    public function storeGudang()
    {
        try {
            // Validasi input
            $errors = [];
            
            if (empty($_POST['nama_gudang']) || strlen(trim($_POST['nama_gudang'])) < 3) {
                $errors[] = 'Nama gudang minimal 3 karakter';
            }
            
            if (empty($_POST['alamat']) || strlen(trim($_POST['alamat'])) < 5) {
                $errors[] = 'Alamat minimal 5 karakter';
            }
            
            if (empty($_POST['nama_admin']) || strlen(trim($_POST['nama_admin'])) < 3) {
                $errors[] = 'Nama admin minimal 3 karakter';
            }
            
            if (empty($_POST['username_admin']) || strlen(trim($_POST['username_admin'])) < 3) {
                $errors[] = 'Username admin minimal 3 karakter';
            }
            
            if (empty($_POST['email_admin']) || !filter_var($_POST['email_admin'], FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'Email admin tidak valid';
            }
            
            if (empty($_POST['password_admin']) || strlen($_POST['password_admin']) < 6) {
                $errors[] = 'Password admin minimal 6 karakter';
            }
            
            if (!empty($errors)) {
                return $this->json(['success' => false, 'message' => implode(', ', $errors)]);
            }
            
            // Sanitasi input
            $data = [
                'nama_gudang' => htmlspecialchars(trim($_POST['nama_gudang']), ENT_QUOTES, 'UTF-8'),
                'alamat' => htmlspecialchars(trim($_POST['alamat']), ENT_QUOTES, 'UTF-8'),
                'nama_admin' => htmlspecialchars(trim($_POST['nama_admin']), ENT_QUOTES, 'UTF-8'),
                'username_admin' => htmlspecialchars(trim($_POST['username_admin']), ENT_QUOTES, 'UTF-8'),
                'email_admin' => filter_var(trim($_POST['email_admin']), FILTER_SANITIZE_EMAIL),
                'password_admin' => $_POST['password_admin']
            ];
            
            if ($this->gudangModel->createWithAdmin($data)) {
                return $this->json(['success' => true, 'message' => 'Gudang berhasil ditambahkan!']);
            }
            return $this->json(['success' => false, 'message' => 'Gagal menambahkan gudang!']);
        } catch (Exception $e) {
            error_log("Error storeGudang: " . $e->getMessage());
            return $this->json(['success' => false, 'message' => 'Terjadi kesalahan server']);
        }
    }

    public function storeAdmin()
    {
        try {
            $errors = [];
            
            if (empty($_POST['nama_admin']) || strlen(trim($_POST['nama_admin'])) < 3) {
                $errors[] = 'Nama admin minimal 3 karakter';
            }

            $admin = $this->adminModel->find('username_admin', $_POST['username_admin']);
            if ($admin) {
                $errors[] = 'Username sudah terdaftar!';
            }
            
            if (empty($_POST['email_admin']) || !filter_var($_POST['email_admin'], FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'Email tidak valid';
            }
            
            if (empty($_POST['password_admin']) || strlen($_POST['password_admin']) < 6) {
                $errors[] = 'Password minimal 6 karakter';
            }

            if (empty($_POST['id_gudang'])) {
                $errors[] = 'Gudang harus dipilih';
            }
            
            $admin = $this->adminModel->find('email_admin', $_POST['email_admin']);
            if ($admin) {
                $errors[] = 'Email sudah terdaftar!';
            }

            if (!empty($errors)) {
                return $this->json(['success' => false, 'message' => implode(', ', $errors)]);
            }
            
            error_log("POST data: " . print_r($_POST, true));
            
            $data = [
                'nama_admin' => htmlspecialchars(trim($_POST['nama_admin']), ENT_QUOTES, 'UTF-8'),
                'username_admin' => htmlspecialchars(trim($_POST['username_admin']), ENT_QUOTES, 'UTF-8'),
                'email_admin' => filter_var(trim($_POST['email_admin']), FILTER_SANITIZE_EMAIL),
                'password_admin' => $_POST['password_admin'],
                'id_gudang' => !empty($_POST['id_gudang']) ? htmlspecialchars(trim($_POST['id_gudang']), ENT_QUOTES, 'UTF-8') : null
            ];
            
            error_log("Data untuk insert: " . print_r($data, true));
            
            if ($this->adminModel->addAdminToGudang($data)) {
                return $this->json(['success' => true, 'message' => 'Admin berhasil ditambahkan!']);
            }
            return $this->json(['success' => false, 'message' => 'Gagal menambahkan admin!']);
        } catch (Exception $e) {
            error_log("Error storeAdmin: " . $e->getMessage());
            error_log("Stack trace: " . $e->getTraceAsString());
            return $this->json(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
        }
    }

    public function storeMitra()
    {
        try {
            $errors = [];
            
            if (empty($_POST['nama_mitra']) || strlen(trim($_POST['nama_mitra'])) < 3) {
                $errors[] = 'Nama mitra minimal 3 karakter';
            }
            
            if (empty($_POST['username_mitra']) || strlen(trim($_POST['username_mitra'])) < 3) {
                $errors[] = 'Username minimal 3 karakter';
            }
            
            $mitra = $this->mitraModel->find('username_mitra', $_POST['username_mitra']);
            if ($mitra) {
                $errors[] = 'Username sudah terdaftar!';
            }
            
            if (empty($_POST['email_mitra']) || !filter_var($_POST['email_mitra'], FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'Email tidak valid';
            }
            
            $mitra = $this->mitraModel->find('email_mitra', $_POST['email_mitra']);
            if ($mitra) {
                $errors[] = 'Email sudah terdaftar!';
            }
            
            if (empty($_POST['password_mitra']) || strlen($_POST['password_mitra']) < 6) {
                $errors[] = 'Password minimal 6 karakter';
            }
            
            if (!empty($errors)) {
                return $this->json(['success' => false, 'message' => implode(', ', $errors)]);
            }
            
            $data = [
                'nama_mitra' => htmlspecialchars(trim($_POST['nama_mitra']), ENT_QUOTES, 'UTF-8'),
                'username_mitra' => htmlspecialchars(trim($_POST['username_mitra']), ENT_QUOTES, 'UTF-8'),
                'email_mitra' => filter_var(trim($_POST['email_mitra']), FILTER_SANITIZE_EMAIL),
                'password_mitra' => $_POST['password_mitra']
            ];
            
            if ($this->superAdminModel->createMitra($data)) {
                return $this->json(['success' => true, 'message' => 'Mitra berhasil ditambahkan!']);
            }
            return $this->json(['success' => false, 'message' => 'Gagal menambahkan mitra!']);
        } catch (Exception $e) {
            error_log("Error storeMitra: " . $e->getMessage());
            return $this->json(['success' => false, 'message' => 'Terjadi kesalahan server']);
        }
    }

    public function updateGudang()
    {
        try {
            $errors = [];
            
            if (empty($_POST['id_gudang'])) {
                $errors[] = 'ID gudang tidak valid';
            }
            
            if (empty($_POST['nama_gudang']) || strlen(trim($_POST['nama_gudang'])) < 3) {
                $errors[] = 'Nama gudang minimal 3 karakter';
            }
            
            if (empty($_POST['alamat']) || strlen(trim($_POST['alamat'])) < 5) {
                $errors[] = 'Alamat minimal 5 karakter';
            }
            
            if (!empty($errors)) {
                return $this->json(['success' => false, 'message' => implode(', ', $errors)]);
            }
            
            $id = htmlspecialchars(trim($_POST['id_gudang']), ENT_QUOTES, 'UTF-8');
            $namaGudang = htmlspecialchars(trim($_POST['nama_gudang']), ENT_QUOTES, 'UTF-8');
            $alamat = htmlspecialchars(trim($_POST['alamat']), ENT_QUOTES, 'UTF-8');
            
            if ($this->gudangModel->updateGudang($id, $namaGudang, $alamat)) {
                return $this->json(['success' => true, 'message' => 'Gudang berhasil diupdate!']);
            }
            return $this->json(['success' => false, 'message' => 'Gagal mengupdate gudang!']);
        } catch (Exception $e) {
            error_log("Error updateGudang: " . $e->getMessage());
            return $this->json(['success' => false, 'message' => 'Terjadi kesalahan server']);
        }
    }

    public function deleteGudang()
    {
        try {
            if (empty($_POST['id'])) {
                return $this->json(['success' => false, 'message' => 'ID gudang tidak valid']);
            }
            
            $id = htmlspecialchars(trim($_POST['id']), ENT_QUOTES, 'UTF-8');
            
            if ($this->gudangModel->deleteGudang($id)) {
                return $this->json(['success' => true, 'message' => 'Gudang berhasil dihapus!']);
            }
            return $this->json(['success' => false, 'message' => 'Gagal menghapus gudang!']);
        } catch (Exception $e) {
            error_log("Error deleteGudang: " . $e->getMessage());
            return $this->json(['success' => false, 'message' => 'Terjadi kesalahan server']);
        }
    }

    public function updateAdmin()
    {
        $id = $_POST['id_admin'];
        $data = [
            'nama_admin' => $_POST['nama_admin'],
            'email_admin' => $_POST['email_admin'],
            'username_admin' => $_POST['username_admin'],
            'id_gudang' => !empty($_POST['gudang_id']) ? $_POST['gudang_id'] : null
        ];
        
        if (!empty($_POST['password_admin'])) {
            $data['password_admin'] = password_hash($_POST['password_admin'], PASSWORD_DEFAULT);
        }
        
        if ($this->adminModel->updateAdmin($id, $data)) {
            return $this->json(['success' => true, 'message' => 'Admin berhasil diupdate!']);
        }
        return $this->json(['success' => false, 'message' => 'Gagal mengupdate admin!']);
    }

    public function deleteAdmin()
    {
        try {
            if (empty($_POST['id'])) {
                return $this->json(['success' => false, 'message' => 'ID admin tidak valid']);
            }
            
            $id = htmlspecialchars(trim($_POST['id']), ENT_QUOTES, 'UTF-8');
            
            if ($this->adminModel->deleteAdmin($id)) {
                return $this->json(['success' => true, 'message' => 'Admin berhasil dihapus!']);
            }
            return $this->json(['success' => false, 'message' => 'Gagal menghapus admin!']);
        } catch (Exception $e) {
            return $this->json(['success' => false, 'message' => 'Terjadi kesalahan server']);
        }
    }

    public function getAdmin()
    {
        $id = $_GET['id'];
        $admin = $this->adminModel->find('id_admin', $id);
        if ($admin) {
            return $this->json(['success' => true, 'data' => $admin]);
        }
        return $this->json(['success' => false, 'message' => 'Admin tidak ditemukan!']);
    }

    public function getMitra()
    {
        try {
            if (empty($_GET['id'])) {
                return $this->json(['success' => false, 'message' => 'ID mitra tidak valid']);
            }
            
            $id = htmlspecialchars(trim($_GET['id']), ENT_QUOTES, 'UTF-8');
            $mitra = $this->mitraModel->find('id_mitra', $id);
            
            if ($mitra) {
                return $this->json(['success' => true, 'data' => $mitra]);
            }
            return $this->json(['success' => false, 'message' => 'Mitra tidak ditemukan!']);
        } catch (Exception $e) {
            error_log("Error getMitra: " . $e->getMessage());
            return $this->json(['success' => false, 'message' => 'Terjadi kesalahan server']);
        }
    }

    public function updateMitra()
    {
        try {
            $errors = [];
            
            if (empty($_POST['id_mitra'])) {
                $errors[] = 'ID mitra tidak valid';
            }
            
            if (empty($_POST['nama_mitra']) || strlen(trim($_POST['nama_mitra'])) < 3) {
                $errors[] = 'Nama mitra minimal 3 karakter';
            }
            
            if (empty($_POST['email_mitra']) || !filter_var($_POST['email_mitra'], FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'Email tidak valid';
            }
            
            $mitra = $this->mitraModel->find('email_mitra', $_POST['email_mitra']);
            if ($mitra && $mitra['id_mitra'] !== $_POST['id_mitra']) {
                $errors[] = 'Email sudah digunakan oleh mitra lain!';
            }
            
            if (!empty($errors)) {
                return $this->json(['success' => false, 'message' => implode(', ', $errors)]);
            }
            
            $id = htmlspecialchars(trim($_POST['id_mitra']), ENT_QUOTES, 'UTF-8');
            $data = [
                'nama_mitra' => htmlspecialchars(trim($_POST['nama_mitra']), ENT_QUOTES, 'UTF-8'),
                'email_mitra' => filter_var(trim($_POST['email_mitra']), FILTER_SANITIZE_EMAIL)
            ];
            
            if ($this->superAdminModel->updateMitra($id, $data)) {
                return $this->json(['success' => true, 'message' => 'Mitra berhasil diupdate!']);
            }
            return $this->json(['success' => false, 'message' => 'Gagal mengupdate mitra!']);
        } catch (Exception $e) {
            error_log("Error updateMitra: " . $e->getMessage());
            return $this->json(['success' => false, 'message' => 'Terjadi kesalahan server']);
        }
    }

    public function deleteMitra()
    {
        try {
            if (empty($_POST['id'])) {
                return $this->json(['success' => false, 'message' => 'ID mitra tidak valid']);
            }
            
            $id = htmlspecialchars(trim($_POST['id']), ENT_QUOTES, 'UTF-8');
            
            if ($this->superAdminModel->deleteMitra($id)) {
                return $this->json(['success' => true, 'message' => 'Mitra berhasil dihapus!']);
            }
            return $this->json(['success' => false, 'message' => 'Gagal menghapus mitra!']);
        } catch (Exception $e) {
            error_log("Error deleteMitra: " . $e->getMessage());
            return $this->json(['success' => false, 'message' => 'Terjadi kesalahan server']);
        }
    }
}