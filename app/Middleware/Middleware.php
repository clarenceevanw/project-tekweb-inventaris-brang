<?php
class Middleware {
    public static function auth($next) {
        session_start();
        if (!isset($_SESSION['user'])) {
            header("Location: /login");
            exit;
        }
        $next();
    }

    public static function admin($next) {
    session_start();
    if (!isset($_SESSION["role"]) || $_SESSION["role"] !== "admin") {
        header("Location: /forbidden");
        exit;
    }
    $next();
}

}
