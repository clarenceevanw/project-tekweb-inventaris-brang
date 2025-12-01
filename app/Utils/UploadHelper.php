<?php
class UploadHelper {
    public static function uploadGambar($fileInfo, $subFolder = '') {

        if ($fileInfo['error'] !== UPLOAD_ERR_OK) {
            return null;
        }

        $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
        if (!in_array($fileInfo['type'], $allowedTypes)) {
            throw new Exception("Tipe file tidak valid. Hanya JPG/PNG.");
        }

        // Validasi Ukuran (Max 2MB)
        if ($fileInfo['size'] > 2 * 1024 * 1024) {
            throw new Exception("Ukuran file terlalu besar (Max 2MB).");
        }

        // Generate Nama Unik
        $ext = pathinfo($fileInfo['name'], PATHINFO_EXTENSION);
        $fileName = uniqid() . '.' . $ext;

        // Folder Tujuan (public/uploads/barang/)
        $targetDir = __DIR__ . '/../../public/uploads/' . $subFolder;
        
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        // Pindahkan File
        if (move_uploaded_file($fileInfo['tmp_name'], $targetDir . $fileName)) {
            return $fileName;
        }

        throw new Exception("Gagal memindahkan file upload.");
    }
}