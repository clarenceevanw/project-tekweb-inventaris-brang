<?php

require_once __DIR__ . "/../Models/Admin.php";
require_once __DIR__ . "/../Models/Gudang.php";
require_once __DIR__ . "/../Middleware/AdminManagementMiddleware.php";

class AdminController extends BaseController
{
    private $adminModel;
    private $gudangModel;

    public function __construct()
    {
        parent::__construct();
        $this->adminModel = new Admin();
        $this->gudangModel = new Gudang();
        
        // Jalankan middleware keamanan
        AdminManagementMiddleware::handle();
    }

    public function index()
    {
        // Keamanan: Hanya admin yang bisa mengakses
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            $this->flash('error', 'Akses ditolak!');
            return $this->redirect('/admin/dashboard');
        }

        $currentGudangId = $_SESSION['gudang']['id_gudang'];
        
        // Ambil semua admin di gudang yang sama
        $dataAdmin = $this->adminModel->query(
            "SELECT a.*, g.nama_gudang, g.lokasi_gudang 
             FROM admin a 
             JOIN gudang g ON a.id_gudang = g.id_gudang 
             WHERE a.id_gudang = ? 
             ORDER BY a.nama_admin ASC", 
            [$currentGudangId]
        );

        return $this->view('admin/manage-admin/index', [
            'title' => 'Kelola Admin',
            'dataAdmin' => $dataAdmin,
            'currentGudang' => $_SESSION['gudang']
        ]);
    }

    public function store()
    {
        // Keamanan: Validasi role dan CSRF
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            return $this->json(['success' => false, 'message' => 'Akses ditolak!']);
        }

        // Sanitasi dan validasi input
        $namaAdmin = AdminManagementMiddleware::sanitizeInput($_POST['nama_admin'] ?? '');
        $emailAdmin = AdminManagementMiddleware::sanitizeInput($_POST['email_admin'] ?? '');
        $usernameAdmin = AdminManagementMiddleware::sanitizeInput($_POST['username_admin'] ?? '');
        $passwordAdmin = $_POST['password_admin'] ?? '';

        if (empty($namaAdmin) || empty($emailAdmin) || empty($usernameAdmin) || empty($passwordAdmin)) {
            return $this->json(['success' => false, 'message' => 'Semua field harus diisi!']);
        }

        // Validasi format email
        if (!filter_var($emailAdmin, FILTER_VALIDATE_EMAIL)) {
            return $this->json(['success' => false, 'message' => 'Format email tidak valid!']);
        }

        // Validasi password
        $passwordValidation = AdminManagementMiddleware::validatePassword($passwordAdmin);
        if (!$passwordValidation['valid']) {
            return $this->json(['success' => false, 'message' => $passwordValidation['message']]);
        }

        // Validasi username unik
        $existingAdmin = $this->adminModel->find('username_admin', $usernameAdmin);
        if ($existingAdmin) {
            return $this->json(['success' => false, 'message' => 'Username sudah digunakan!']);
        }

        // Validasi format username
        $usernameValidation = AdminManagementMiddleware::validateUsername($usernameAdmin);
        if (!$usernameValidation['valid']) {
            return $this->json(['success' => false, 'message' => $usernameValidation['message']]);
        }

        $currentGudangId = $_SESSION['gudang']['id_gudang'];

        $adminData = [
            'nama_admin' => $namaAdmin,
            'email_admin' => $emailAdmin,
            'username_admin' => $usernameAdmin,
            'password_admin' => password_hash($passwordAdmin, PASSWORD_DEFAULT),
            'id_gudang' => $currentGudangId
        ];

        if ($this->adminModel->addAdminToGudang($adminData)) {
            AdminManagementMiddleware::logActivity('CREATE_ADMIN', $namaAdmin);
            return $this->json(['success' => true, 'message' => 'Admin berhasil ditambahkan!']);
        }

        return $this->json(['success' => false, 'message' => 'Gagal menambahkan admin!']);
    }

    public function update()
    {
        // Keamanan: Validasi role
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            return $this->json(['success' => false, 'message' => 'Akses ditolak!']);
        }

        $idAdmin = AdminManagementMiddleware::sanitizeInput($_POST['id_admin'] ?? '');
        $namaAdmin = AdminManagementMiddleware::sanitizeInput($_POST['nama_admin'] ?? '');
        $emailAdmin = AdminManagementMiddleware::sanitizeInput($_POST['email_admin'] ?? '');
        $usernameAdmin = AdminManagementMiddleware::sanitizeInput($_POST['username_admin'] ?? '');
        $passwordAdmin = $_POST['password_admin'] ?? '';

        if (empty($idAdmin) || empty($namaAdmin) || empty($emailAdmin) || empty($usernameAdmin)) {
            return $this->json(['success' => false, 'message' => 'Data tidak lengkap!']);
        }

        // Validasi format email
        if (!filter_var($emailAdmin, FILTER_VALIDATE_EMAIL)) {
            return $this->json(['success' => false, 'message' => 'Format email tidak valid!']);
        }

        // Validasi akses admin
        $accessValidation = AdminManagementMiddleware::validateAdminAccess($idAdmin, $this->adminModel);
        if (!$accessValidation['valid']) {
            return $this->json(['success' => false, 'message' => $accessValidation['message']]);
        }
        $adminToEdit = $accessValidation['admin'];

        // Validasi username unik (kecuali untuk admin yang sedang diedit)
        $existingAdmin = $this->adminModel->query(
            "SELECT * FROM admin WHERE username_admin = ? AND id_admin != ?", 
            [$usernameAdmin, $idAdmin]
        );
        if (!empty($existingAdmin)) {
            return $this->json(['success' => false, 'message' => 'Username sudah digunakan!']);
        }

        // Validasi format username
        $usernameValidation = AdminManagementMiddleware::validateUsername($usernameAdmin);
        if (!$usernameValidation['valid']) {
            return $this->json(['success' => false, 'message' => $usernameValidation['message']]);
        }

        $updateData = [
            'nama_admin' => $namaAdmin,
            'email_admin' => $emailAdmin,
            'username_admin' => $usernameAdmin
        ];

        // Update password jika diisi
        if (!empty($passwordAdmin)) {
            $passwordValidation = AdminManagementMiddleware::validatePassword($passwordAdmin);
            if (!$passwordValidation['valid']) {
                return $this->json(['success' => false, 'message' => $passwordValidation['message']]);
            }
            $updateData['password_admin'] = password_hash($passwordAdmin, PASSWORD_DEFAULT);
        }

        if ($this->adminModel->updateAdmin($idAdmin, $updateData)) {
            AdminManagementMiddleware::logActivity('UPDATE_ADMIN', $adminToEdit['nama_admin']);
            return $this->json(['success' => true, 'message' => 'Admin berhasil diupdate!']);
        }

        return $this->json(['success' => false, 'message' => 'Gagal mengupdate admin!']);
    }

    public function delete()
    {
        // Keamanan: Validasi role
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            return $this->json(['success' => false, 'message' => 'Akses ditolak!']);
        }

        $idAdmin = AdminManagementMiddleware::sanitizeInput($_POST['id_admin'] ?? '');

        if (empty($idAdmin)) {
            return $this->json(['success' => false, 'message' => 'ID admin tidak valid!']);
        }

        // Validasi akses admin
        $accessValidation = AdminManagementMiddleware::validateAdminAccess($idAdmin, $this->adminModel);
        if (!$accessValidation['valid']) {
            return $this->json(['success' => false, 'message' => $accessValidation['message']]);
        }
        $adminToDelete = $accessValidation['admin'];

        // Validasi admin terakhir
        if (!AdminManagementMiddleware::validateLastAdmin($this->adminModel, $_SESSION['gudang']['id_gudang'])) {
            return $this->json(['success' => false, 'message' => 'Tidak dapat menghapus admin terakhir di gudang!']);
        }

        if ($this->adminModel->deleteAdmin($idAdmin)) {
            AdminManagementMiddleware::logActivity('DELETE_ADMIN', $adminToDelete['nama_admin']);
            return $this->json(['success' => true, 'message' => 'Admin berhasil dihapus!']);
        }

        return $this->json(['success' => false, 'message' => 'Gagal menghapus admin!']);
    }
}