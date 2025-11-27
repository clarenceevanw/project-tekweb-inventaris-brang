<?php
require_once __DIR__ . '/../../libs/phpqrcode/qrlib.php';

class QrHelper {
    public static function generateBase64($data) {
        ob_start(); // Tangkap output gambar
        QRcode::png($data, null, QR_ECLEVEL_L, 4, 2);
        $imageString = base64_encode(ob_get_contents());
        ob_end_clean(); // Bersihkan buffer
        return 'data:image/png;base64,' . $imageString;
    }
}