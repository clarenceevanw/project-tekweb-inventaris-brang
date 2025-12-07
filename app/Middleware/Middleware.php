<?php
class Middleware {
    public static function auth($next) {
        if (!isset($_SESSION['user'])) {
            header("Location: /auth/select/login");
            $_SESSION['flash']['error'] = 'Anda belum login!';
            exit;
        }
        $next();
    }

    public static function admin($next) {
        if (!isset($_SESSION['user']) || !isset($_SESSION["role"]) || $_SESSION["role"] !== "admin") {
            header("Location: /login?role=admin");
            $_SESSION['flash']['error'] = 'Anda belum login!';
            exit;
        }
        $next();
    }

    public static function subscription($next) {
        if (session_status() == PHP_SESSION_NONE) session_start();

        if (!isset($_SESSION['gudang']['id_gudang'])) {
            header("Location: /auth/select/login");
            exit;
        }

        $gudangModel = new Gudang();
        $gudang = $gudangModel->find('id_gudang', $_SESSION['gudang']['id_gudang']);

        if ($gudang) {
            $tgl_expired = $gudang['expired_date_gudang'];
            $sekarang = date('Y-m-d H:i:s');

            if ($sekarang > $tgl_expired) {
                if ($gudang['status_gudang'] == 'active') {
                    $gudangModel->update([
                        'status_gudang' => 'expired'
                    ], 'id_gudang', $_SESSION['gudang']['id_gudang']);
                }
                $_SESSION['flash']['error'] = "Masa langganan habis. Mohon perpanjang.";
                header("Location: /admin/gudang/pembayaran");
                exit;
            }
        }

        // Kalau lolos semua pengecekan, silakan masuk
        return $next();
    }

}
