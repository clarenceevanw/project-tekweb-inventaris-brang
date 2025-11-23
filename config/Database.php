<?php
require_once __DIR__ . "/env.php";

class Database {
    private static $pdo;

    public static function getConnection() {
        if (!self::$pdo) {
            $host = env("DB_HOST");
            $db   = env("DB_NAME");
            $user = env("DB_USER");
            $pass = env("DB_PASS");
            $port = env("DB_PORT", 3306);
            $charset = env("DB_CHARSET", "utf8mb4");

            $dsn = "mysql:host=$host;dbname=$db;port=$port;charset=$charset";

            self::$pdo = new PDO($dsn, $user, $pass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]);
        }

        return self::$pdo;
    }
}
