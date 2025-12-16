<?php

require_once __DIR__ . "/../Models/Admin.php";
require_once __DIR__ . "/../Models/Mitra.php";
require_once __DIR__ . "/../Models/Gudang.php";
require_once __DIR__ . "/../Models/SuperAdmin.php";
require_once __DIR__ . "/../../config/GoogleConfig.php";

class AuthController extends BaseController {
    protected $admin;
    protected $mitra;
    protected $gudang;
    protected $superAdmin;

    public function __construct() {
        parent::__construct();
        $this->admin = new Admin();
        $this->mitra = new Mitra();
        $this->gudang = new Gudang();
        $this->superAdmin = new SuperAdmin();
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

    public function subscribeRedirect() {
        $_SESSION['redirect_after_login'] = '/admin/gudang/pembayaran';
        return $this->redirect('/login?role=admin');
    }

    public function showSignupAdmin() {
        $data['title'] = "Signup Admin";
        return $this->view("auth/signup-admin", $data);
    }

    public function showSignupMitra() {
        $data['title'] = "Signup Mitra";
        return $this->view("auth/signup-mitra", $data);
    }

    public function showLogin() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $role = $_POST['role'] ?? 'admin';
            if ($role === 'mitra') {
                return $this->loginMitra();
            } else {
                return $this->loginAdmin();
            }
        }
        
        $data['title'] = "Login";
        $data['role'] = $_GET['role'] ?? 'admin';
        
        if (isset($_SESSION['login_error'])) {
            $data['login_error'] = $_SESSION['login_error'];
            unset($_SESSION['login_error']);
        }
        
        return $this->view('auth/login', $data);
    }

    public function loginAdmin() {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $user = $this->admin->find('username_admin', $username);
        
        if ($user) {
            $gudang = $this->gudang->find('id_gudang', $user['id_gudang']);
        }

        if ($user && password_verify($password, $user['password_admin'])) {
            $_SESSION['user'] = $user;
            $_SESSION['role'] = 'admin';
            $_SESSION['gudang'] = $gudang;
            $_SESSION['user_id'] = $user['id_admin'];
            $_SESSION['username'] = $user['username_admin'];
            
            // Check for redirect in session
            $redirect = $_SESSION['redirect_after_login'] ?? '/admin/dashboard';
            unset($_SESSION['redirect_after_login']); // Clear redirect after use
            return $this->redirect($redirect);
        }

        $_SESSION['login_error'] = 'Username atau password salah!';
        return $this->redirect('/login?role=admin');
    }

    public function loginMitra() {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $user = $this->mitra->find('username_mitra', $username);

        if ($user && password_verify($password, $user['password_mitra'])) {
            $_SESSION['user'] = $user;
            $_SESSION['role'] = 'mitra';
            $_SESSION['user_id'] = $user['id_mitra'];
            $_SESSION['username'] = $user['username_mitra'];
            return $this->redirect('/mitra/dashboard');
        }

        $_SESSION['login_error'] = 'Username atau password salah!';
        return $this->redirect('/login?role=mitra');
    }

    public function loginSuperAdmin() {
        // Redirect to Google OAuth for superadmin
        $client = GoogleConfig::getClient(); 
        $client->setState('superadmin');
        $authUrl = $client->createAuthUrl();
        $_SESSION['role'] = 'superadmin';
        header("Location: " . $authUrl);
        exit;
    }

    public function signupAdmin() {
        $adminData = [
            'nama_admin' => $_POST['nama_admin'],
            'email_admin' => $_POST['email_admin'],
            'username_admin' => $_POST['username_admin'],
            'password_admin' => password_hash($_POST['password_admin'], PASSWORD_DEFAULT)
        ];

        $gudangData = [
            'nama_gudang' => $_POST['nama_gudang'],
            'lokasi_gudang' => $_POST['lokasi_gudang']
        ];

        if ($this->admin->signUpWithGudang($adminData, $gudangData)) {
            $this->flash('success', 'Signup berhasil! Silahkan login.');
            return $this->redirect('/login?role=admin');
        }

        $this->flash('error', 'Signup gagal!');
        return $this->redirect('/signup/admin');
    }

    public function signupMitra() {
        $mitraData = [
            'nama_mitra' => $_POST['nama_mitra'],
            'email_mitra' => $_POST['email_mitra'],
            'username_mitra' => $_POST['username_mitra'],
            'password_mitra' => password_hash($_POST['password_mitra'], PASSWORD_DEFAULT)
        ];

        if ($this->mitra->signUp($mitraData)) {
            $this->flash('success', 'Signup berhasil! Silakan login.');
            return $this->redirect('/login?role=mitra');
        }

        $this->flash('error', 'Signup gagal!');
        return $this->redirect('/signup/mitra');
    }

    public function logout() {
        session_destroy();
        return $this->redirect('/');
    }


    public function loginGoogle() {
        $role = $_GET['role'] ?? 'admin';
        $client = GoogleConfig::getClient(); 
        $client->setState($role);
        $authUrl = $client->createAuthUrl();
        header("Location: " . $authUrl);
        exit;
    }

    public function callbackGoogle() {
        $client = GoogleConfig::getClient();

        if (isset($_GET['code'])) {
            try {
                $role_target = $_GET['state'] ?? 'admin'; 

                $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
                $client->setAccessToken($token);

                $google_oauth = new Google\Service\Oauth2($client);
                $google_account_info = $google_oauth->userinfo->get();

                $email = $google_account_info->email;
                $name = $google_account_info->name;

                if ($role_target === 'admin') {
                    $this->handleLoginAdmin($email);
                } 
                else if ($role_target === 'mitra') {
                    $this->handleLoginMitra($email);
                } 
                else if ($role_target === 'superadmin') {
                    $this->handleLoginSuperAdmin($email);
                } 
                else {
                    throw new Exception("Role login tidak dikenali.");
                }

            } catch (Exception $e) {
                $this->flash('error', 'Gagal Login Google: ' . $e->getMessage());
                $redirect = ($role_target == 'mitra') ? '/login?role=mitra' : '/login?role=admin';
                $this->redirect($redirect);
            }
        } else {
            $this->redirect('/auth/select/login');
        }
    }

    private function handleLoginAdmin($email) {
        $user = $this->admin->find('email_admin', $email); 

        if (!$user) {
            $this->flash('error', 'Email Google tidak terdaftar sebagai Admin!');
            $this->redirect('/login?role=admin');
            exit;
        }

        $gudang = $this->gudang->find('id_gudang', $user['id_gudang']);

        $_SESSION['user'] = $user;
        $_SESSION['role'] = 'admin';
        $_SESSION['gudang'] = $gudang;
        $_SESSION['user_id'] = $user['id_admin'];
        $_SESSION['username'] = $user['username_admin'];

        $this->flash('success', 'Login Admin Berhasil!');
        $this->redirect('/admin/dashboard');
    }

    private function handleLoginMitra($email) {
        $user = $this->mitra->find('email_mitra', $email); 

        if (!$user) {
            $this->flash('error', 'Email Google tidak terdaftar sebagai Mitra!');
            $this->redirect('/login?role=mitra');
            exit;
        }

        $_SESSION['user'] = $user;
        $_SESSION['role'] = 'mitra';
        $_SESSION['user_id'] = $user['id_mitra'];
        $_SESSION['username'] = $user['nama_mitra'];

        $this->flash('success', 'Login Mitra Berhasil!');
        $this->redirect('/mitra/dashboard');
    }

    private function handleLoginSuperAdmin($email) {
        $user = $this->superAdmin->findByEmail($email); 

        if (!$user) {
            $this->flash('error', 'Email Google tidak terdaftar sebagai Super Admin!');
            $this->redirect('/');
            exit;
        }

        $_SESSION['user'] = $user;
        $_SESSION['role'] = 'superadmin';
        $_SESSION['user_id'] = $user['id_superadmin'];
        $_SESSION['username'] = $user['nama_superadmin'];

        $this->flash('success', 'Login Super Admin Berhasil!');
        $this->redirect('/superadmin/dashboard');
    }
}
