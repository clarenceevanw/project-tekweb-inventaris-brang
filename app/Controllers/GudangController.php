<?php

require_once __DIR__ . '/../Models/Gudang.php';

class GudangController extends BaseController {
    
    public function __construct()
    {
        parent::__construct(new Gudang());
    }

    public function index() {
        // Ambil data gudang dari session
        $gudangData = $_SESSION['gudang'] ?? null;
        
        if (!$gudangData) {
            $this->flash('error', 'Data gudang tidak ditemukan.');
            return $this->redirect('/auth/login-admin');
        }

        // Ambil data lengkap gudang dari database
        $gudang = $this->model->find('id_gudang', $gudangData['id_gudang']);
        
        if (!$gudang) {
            $this->flash('error', 'Gudang tidak ditemukan.');
            return $this->redirect('/auth/login-admin');
        }

        // Siapkan data untuk view
        $data['title'] = 'Informasi Gudang';
        $data['gudang'] = [
            'id_gudang' => $gudang['id_gudang'],
            'nama_gudang' => $gudang['nama_gudang'],
            'alamat' => $gudang['lokasi_gudang'],
            'tanggal_berakhir' => $gudang['expired_date_gudang']
        ];
        
        return $this->view('gudang/index', $data);
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->json(['success' => false, 'message' => 'Method not allowed']);
            return;
        }

        try {
            $id_gudang = $_POST['id_gudang'] ?? null;
            $nama_gudang = $_POST['nama_gudang'] ?? null;
            $alamat_gudang = $_POST['lokasi_gudang'] ?? null;

            if (!$id_gudang || !$nama_gudang || !$alamat_gudang) {
                throw new Exception('Semua field harus diisi');
            }

            $result = $this->model->update([
                'nama_gudang' => $nama_gudang,
                'lokasi_gudang' => $alamat_gudang
            ], 'id_gudang', $id_gudang);

            if ($result) {
                $this->json(['success' => true, 'message' => 'Data gudang berhasil diupdate']);
            } else {
                throw new Exception('Gagal mengupdate data gudang');
            }

        } catch (Exception $e) {
            $this->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}
