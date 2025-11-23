<?php

class BaseController
{
    protected function view($view, $data = [])
    {
        extract($data);
        require __DIR__ . "/../views/{$view}.php";
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
        session_start();
        $_SESSION['flash'][$key] = $message;
    }

    protected function getFlash($key)
    {
        session_start();
        if (!isset($_SESSION['flash'][$key])) return null;

        $msg = $_SESSION['flash'][$key];
        unset($_SESSION['flash'][$key]);
        return $msg;
    }
}
