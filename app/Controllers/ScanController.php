<?php

require_once __DIR__ . "/../../libs/phpqrcode/qrlib.php";
class ScanController extends BaseController {
    public function index() {
        return $this->view("scan/index");
    }

    public function generateQr() {
        $text = $_GET['text'] ?? 'kosong';
        
        QRcode::png($text, null, QR_ECLEVEL_L, 4, 2);
        exit;
    }
}