<?php

require_once __DIR__ . '/../Models/Admin.php';
require_once __DIR__ . '/../Models/Mitra.php';
require_once __DIR__ . '/../Models/SuperAdmin.php';

class ProfileController extends BaseController {
    protected $admin;
    protected $mitra;
    protected $superAdmin;

    public function __construct() {
        parent::__construct();
        $this->admin = new Admin();
        $this->mitra = new Mitra();
        $this->superAdmin = new SuperAdmin();
    }
    
    public function index() {
        if (!isset($_SESSION['user_id'])) {
            return $this->redirect('/auth/select/login');
        }

        $data = [
            'title' => 'Profile',
            'user' => $_SESSION['user'],
            'role' => $_SESSION['role'],
            'gudang' => $_SESSION['gudang'] ?? null
        ];

        return $this->view('profile/index', $data);
    }

    public function updateUsername() {
        if (!isset($_SESSION['user_id'])) {
            return $this->redirect('/auth/select/login');
        }

        $username = $_POST['username'];
        $role = $_SESSION['role'];
        $userId = $_SESSION['user_id'];

        if ($role === 'superadmin') {
            $this->superAdmin->update(['nama_superadmin' => $username], 'id_superadmin', $userId);
            $_SESSION['user']['nama_superadmin'] = $username;
            $_SESSION['username'] = $username;
            $this->flash('success', 'Nama berhasil diupdate!');
            return $this->redirect('/profile');
        }

        // Check if username already exists
        $existingAdmin = $this->admin->find('username_admin', $username);
        $existingMitra = $this->mitra->find('username_mitra', $username);

        if ($existingAdmin && $existingAdmin['id_admin'] !== $userId) {
            $this->flash('error', 'Username sudah digunakan!');
            return $this->redirect('/profile');
        }

        if ($existingMitra && $existingMitra['id_mitra'] !== $userId) {
            $this->flash('error', 'Username sudah digunakan!');
            return $this->redirect('/profile');
        }

        // Update username
        if ($role === 'admin') {
            $this->admin->update(['username_admin' => $username], 'id_admin', $userId);
            $_SESSION['user']['username_admin'] = $username;
            $_SESSION['username'] = $username;
        } else {
            $this->mitra->update(['username_mitra' => $username], 'id_mitra', $userId);
            $_SESSION['user']['username_mitra'] = $username;
            $_SESSION['username'] = $username;
        }

        $this->flash('success', 'Username berhasil diupdate!');
        return $this->redirect('/profile');
    }

    public function updateEmail() {
        if (!isset($_SESSION['user_id'])) {
            return $this->redirect('/auth/select/login');
        }

        $email = $_POST['email'];
        $role = $_SESSION['role'];
        $userId = $_SESSION['user_id'];

        // Check if email already exists
        $existingAdmin = $this->admin->find('email_admin', $email);
        $existingMitra = $this->mitra->find('email_mitra', $email);
        $existingSuperAdmin = $this->superAdmin->findByEmail($email);

        if ($existingAdmin && $existingAdmin['id_admin'] !== $userId) {
            $this->flash('error', 'Email sudah digunakan!');
            return $this->redirect('/profile');
        }

        if ($existingMitra && $existingMitra['id_mitra'] !== $userId) {
            $this->flash('error', 'Email sudah digunakan!');
            return $this->redirect('/profile');
        }

        if ($existingSuperAdmin && $existingSuperAdmin['id_superadmin'] != $userId) {
            $this->flash('error', 'Email sudah digunakan!');
            return $this->redirect('/profile');
        }

        // Update email
        if ($role === 'admin') {
            $this->admin->update(['email_admin' => $email], 'id_admin', $userId);
            $_SESSION['user']['email_admin'] = $email;
        } elseif ($role === 'mitra') {
            $this->mitra->update(['email_mitra' => $email], 'id_mitra', $userId);
            $_SESSION['user']['email_mitra'] = $email;
        } else {
            $this->superAdmin->update(['email_superadmin' => $email], 'id_superadmin', $userId);
            $_SESSION['user']['email_superadmin'] = $email;
        }

        $this->flash('success', 'Email berhasil diupdate!');
        return $this->redirect('/profile');
    }
}
