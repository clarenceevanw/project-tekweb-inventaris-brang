<?php

require_once __DIR__ . "/../Models/Admin.php";
require_once __DIR__ . "/../Models/Mitra.php";

class AuthController extends BaseController {
    
    public function showLoginAdmin() {
        return $this->view("auth/login-admin");
    }

    public function showLoginMitra() {
        return $this->view("auth/login-mitra");
    }

    public function showSignupAdmin() {
        return $this->view("auth/signup-admin");
    }

    public function showSignupMitra() {
        return $this->view("auth/signup-mitra");
    }

    public function loginAdmin() {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $adminModel = new Admin();
        $user = $adminModel->find('username_admin', $username);
        
        if ($user && password_verify($password, $user['password_admin'])) {
            $_SESSION['user'] = $user;
            $_SESSION['role'] = 'admin';
            $this->flash('success', 'Login berhasil!');
            return $this->redirect('/admin/dashboard');
        }

        $this->flash('error', 'Username atau password salah!');
        return $this->redirect('/login/admin');
    }

    public function loginMitra() {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $mitraModel = new Mitra();
        $user = $mitraModel->find('username_mitra', $username);
        
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

        $adminModel = new Admin();
        if ($adminModel->signUpWithGudang($adminData, $gudangData)) {
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

        $mitraModel = new Mitra();
        if ($mitraModel->signUp($mitraData)) {
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
