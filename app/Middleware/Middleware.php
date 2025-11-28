<?php
class Middleware {
    public static function auth($next) {
        if (!isset($_SESSION['user'])) {
            header("Location: /login/mitra");
            $_SESSION['flash']['error'] = 'Anda belum login!';
            exit;
        }
        $next();
    }

    public static function admin($next) {
        if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "admin") {
            header("Location: /login/admin");
            $_SESSION['flash']['error'] = 'Anda belum login!';
            exit;
        }
        $next();
    }

}
