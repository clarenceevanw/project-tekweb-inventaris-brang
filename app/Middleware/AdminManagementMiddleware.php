<?php

class AdminManagementMiddleware
{
    public static function handle()
    {
        // Pastikan user sudah login
        if (!isset($_SESSION['user']) || !isset($_SESSION['role'])) {
            header('Location: /login/admin');
            exit;
        }

        // Pastikan role adalah admin
        if ($_SESSION['role'] !== 'admin') {
            header('Location: /');
            exit;
        }

        // Pastikan ada data gudang
        if (!isset($_SESSION['gudang']) || empty($_SESSION['gudang']['id_gudang'])) {
            session_destroy();
            header('Location: /login/admin');
            exit;
        }

        // Rate limiting sederhana (opsional)
        if (!isset($_SESSION['admin_requests'])) {
            $_SESSION['admin_requests'] = [];
        }

        $now = time();
        $timeWindow = 60; // 1 menit
        $maxRequests = 30; // maksimal 30 request per menit

        // Bersihkan request lama
        $_SESSION['admin_requests'] = array_filter($_SESSION['admin_requests'], function($timestamp) use ($now, $timeWindow) {
            return ($now - $timestamp) < $timeWindow;
        });

        // Cek apakah melebihi limit
        if (count($_SESSION['admin_requests']) >= $maxRequests) {
            http_response_code(429);
            echo json_encode(['success' => false, 'message' => 'Terlalu banyak request. Coba lagi nanti.']);
            exit;
        }

        // Tambahkan request saat ini
        $_SESSION['admin_requests'][] = $now;

        return true;
    }

    public static function validateAdminAccess($targetAdminId, $adminModel)
    {
        // Ambil data admin target
        $targetAdmin = $adminModel->find('id_admin', $targetAdminId);
        
        if (!$targetAdmin) {
            return ['valid' => false, 'message' => 'Admin tidak ditemukan!'];
        }

        // Pastikan admin target berada di gudang yang sama
        if ($targetAdmin['id_gudang'] !== $_SESSION['gudang']['id_gudang']) {
            return ['valid' => false, 'message' => 'Tidak memiliki akses ke admin ini!'];
        }

        // Pastikan bukan akun sendiri
        if ($targetAdminId === $_SESSION['user']['id_admin']) {
            return ['valid' => false, 'message' => 'Tidak dapat mengakses akun sendiri!'];
        }

        return ['valid' => true, 'admin' => $targetAdmin];
    }

    public static function validateLastAdmin($adminModel, $gudangId)
    {
        $adminCount = $adminModel->query(
            "SELECT COUNT(*) as total FROM admin WHERE id_gudang = ?", 
            [$gudangId]
        );
        
        return $adminCount[0]['total'] > 1;
    }

    public static function sanitizeInput($input)
    {
        if (is_array($input)) {
            return array_map([self::class, 'sanitizeInput'], $input);
        }
        
        return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
    }

    public static function validateUsername($username)
    {
        // Username hanya boleh huruf, angka, dan underscore
        if (!preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
            return ['valid' => false, 'message' => 'Username hanya boleh berisi huruf, angka, dan underscore!'];
        }

        // Panjang username
        if (strlen($username) < 3 || strlen($username) > 50) {
            return ['valid' => false, 'message' => 'Username harus 3-50 karakter!'];
        }

        return ['valid' => true];
    }

    public static function validatePassword($password)
    {
        if (strlen($password) < 6) {
            return ['valid' => false, 'message' => 'Password minimal 6 karakter!'];
        }

        if (strlen($password) > 255) {
            return ['valid' => false, 'message' => 'Password terlalu panjang!'];
        }

        return ['valid' => true];
    }

    public static function logActivity($action, $targetAdmin = null)
    {
        $logData = [
            'timestamp' => date('Y-m-d H:i:s'),
            'admin_id' => $_SESSION['user']['id_admin'],
            'admin_name' => $_SESSION['user']['nama_admin'],
            'gudang_id' => $_SESSION['gudang']['id_gudang'],
            'action' => $action,
            'target_admin' => $targetAdmin,
            'ip_address' => $_SERVER['REMOTE_ADDR'] ?? 'unknown',
            'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'unknown'
        ];

        // Simpan ke session untuk sementara (bisa dipindah ke database)
        if (!isset($_SESSION['admin_activity_log'])) {
            $_SESSION['admin_activity_log'] = [];
        }

        $_SESSION['admin_activity_log'][] = $logData;

        // Batasi log hanya 100 entry terakhir
        if (count($_SESSION['admin_activity_log']) > 100) {
            $_SESSION['admin_activity_log'] = array_slice($_SESSION['admin_activity_log'], -100);
        }
    }
}