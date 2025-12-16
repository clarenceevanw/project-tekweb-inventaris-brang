<?php

require_once __DIR__ . '/../Views/View.php';
require_once __DIR__ . '/../Models/Gudang.php';

class BaseController
{
    protected $model;

    public function __construct(BaseModel $model = null) {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $this->model = $model;
        $this->autoUpdateGudangStatus();
    }

    private function autoUpdateGudangStatus() {
        // Update status gudang yang sudah expired
        // Hanya jalankan sekali per session untuk efisiensi
        if (!isset($_SESSION['gudang_status_checked'])) {
            $gudangModel = new Gudang();
            $gudangModel->updateExpiredStatus();
            $_SESSION['gudang_status_checked'] = time();
        } else {
            // Cek ulang setiap 1 jam
            $lastCheck = $_SESSION['gudang_status_checked'];
            if ((time() - $lastCheck) > 3600) {
                $gudangModel = new Gudang();
                $gudangModel->updateExpiredStatus();
                $_SESSION['gudang_status_checked'] = time();
            }
        }
    }
    protected function view($viewName, $data = [])
    {
        $view = new View();
        $data['flash'] = $this->getAllFlash();
        return $view->render($viewName, $data);
    }

    protected function redirect($path)
    {
        header("Location: {$path}");
        exit;
    }

    protected function json($data, $code = 200)
    {
        http_response_code($code);
        header("Content-Type: application/json");
        echo json_encode($data);
        exit;
    }

    protected function flash($key, $message)
    {
        $_SESSION['flash'][$key] = $message;
    }

    protected function getFlash($key)
    {
        if (!isset($_SESSION['flash'][$key])) return null;

        $msg = $_SESSION['flash'][$key];
        unset($_SESSION['flash'][$key]);
        return $msg;
    }

    protected function getAllFlash()
    {
        $flashes = $_SESSION['flash'] ?? [];
        unset($_SESSION['flash']);
        return $flashes;
    }
}
