<?php

require_once __DIR__ . "/../Models/Admin.php";
require_once __DIR__ . "/../Models/Mitra.php";
require_once __DIR__ . "/../Models/Gudang.php";

class AuthController extends BaseController {
    protected $admin;
    protected $mitra;
    protected $gudang;

    public function __construct() {
        parent::__construct();
        $this->admin = new Admin();
        $this->mitra = new Mitra();
        $this->gudang = new Gudang();
    }

    public function redirectSelectLogin() {
        $_SESSION['auth_mode'] = 'login';
        setcookie("auth_mode", "login", time() + (5 * 60), "/");
        header("Location: /auth/select");
        exit;
    }

    public function redirectSelectSignup() {
        $_SESSION['auth_mode'] = 'signup';
        setcookie("auth_mode", "login", time() + (5 * 60), "/");
        header("Location: /auth/select");
        exit;
    }

    public function showSelectAuthAdminMitra() {
        if (!isset($_SESSION['auth_mode']) && isset($_COOKIE['auth_mode'])) {
            $_SESSION['auth_mode'] = $_COOKIE['auth_mode'];
        }

        $mode = $_SESSION['auth_mode'] ?? 'login';

        return $this->view("auth/select-auth-admin-mitra", [
            'title' => "Select Admin/Mitra",
            'mode'  => $mode
        ]);
    }

    public function showLoginAdmin() {
        $data['title'] = "Login Admin";
        $data['redirect'] = $_GET['redirect'] ?? '';
        return $this->view("auth/login-admin", $data);
    }

    public function showLoginMitra() {
        $data['title'] = "Login Mitra";
        return $this->view("auth/login-mitra", $data);
    }

    public function showSignupAdmin() {
        $data['title'] = "Signup Admin";
        return $this->view("auth/signup-admin", $data);
    }

    public function showSignupMitra() {
        $data['title'] = "Signup Mitra";
        return $this->view("auth/signup-mitra", $data);
    }

    public function loginAdmin() {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $user = $this->admin->find('username_admin', $username);
        
        $gudang = $this->gudang->find('id_gudang', $user['id_gudang']);

        if ($user && password_verify($password, $user['password_admin'])) {
            $_SESSION['user'] = $user;
            $_SESSION['role'] = 'admin';
            $_SESSION['gudang'] = $gudang;
            $this->flash('success', 'Login berhasil!');
            
            // Check for redirect parameter
            $redirect = $_GET['redirect'] ?? '/admin/dashboard';
            return $this->redirect($redirect);
        }

        $this->flash('error', 'Username atau password salah!');
        return $this->redirect('/login/admin');
    }

    public function loginMitra() {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $user = $this->mitra->find('username_mitra', $username);

        if ($user && password_verify($password, $user['password_mitra'])) {
            $_SESSION['user'] = $user;
            $_SESSION['role'] = 'mitra';
            $this->flash('success', 'Login berhasil!');
            return $this->redirect('/mitra/dashboard');
        }

        $this->flash('error', 'Username atau password salah!');
        return $this->redirect('/login/mitra');
    }

    public function signupAdmin() {
        $adminData = [
            'nama_admin' => $_POST['nama_admin'],
            'username_admin' => $_POST['username_admin'],
            'password_admin' => password_hash($_POST['password_admin'], PASSWORD_DEFAULT)
        ];

        $gudangData = [
            'nama_gudang' => $_POST['nama_gudang'],
            'lokasi_gudang' => $_POST['lokasi_gudang']
        ];

        if ($this->admin->signUpWithGudang($adminData, $gudangData)) {
            $this->flash('success', 'Signup berhasil! Silahkan login.');
            return $this->redirect('/login/admin');
        }

        $this->flash('error', 'Signup gagal!');
        return $this->redirect('/signup/admin');
    }

    public function signupMitra() {
        $mitraData = [
            'nama_mitra' => $_POST['nama_mitra'],
            'username_mitra' => $_POST['username_mitra'],
            'password_mitra' => password_hash($_POST['password_mitra'], PASSWORD_DEFAULT)
        ];

        if ($this->mitra->signUp($mitraData)) {
            $this->flash('success', 'Signup berhasil! Silakan login.');
            return $this->redirect('/login/mitra');
        }

        $this->flash('error', 'Signup gagal!');
        return $this->redirect('/signup/mitra');
    }

    public function logout() {
        session_destroy();
        return $this->redirect('/');
    }
}
