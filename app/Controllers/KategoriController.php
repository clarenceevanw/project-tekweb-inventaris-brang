<?php

require_once __DIR__ . '/../Models/Kategori.php';
require_once __DIR__ . '/../Models/Barang.php';

class KategoriController extends BaseController {
    protected $barang;
    
    public function __construct() {
        parent::__construct(new Kategori());
        $this->barang = new Barang();
    }

    public function index() {
        $data['title'] = 'Kategori';
        $data['dataKategori'] = $this->model->byGudang($_SESSION['gudang']['id_gudang']);
        return $this->view('kategori/index', $data);
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->json(['success' => false, 'message' => 'Method not allowed']);
            return;
        }

        try {
            if (empty($_POST['nama_kategori'])) throw new Exception('Nama kategori harus diisi');

            $result = $this->model->insert([
                'nama_kategori' => $_POST['nama_kategori'],
                'id_gudang' => $_SESSION['gudang']['id_gudang']
            ]);

            if ($result) {
                $this->json(['success' => true, 'message' => 'Kategori berhasil ditambahkan']);
            } else {
                throw new Exception('Gagal menambahkan kategori');
            }
        } catch (Exception $e) {
            $this->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->json(['success' => false, 'message' => 'Method not allowed']);
            return;
        }

        try {
            if (empty($_POST['id_kategori'])) throw new Exception('ID kategori tidak ditemukan');
            if (empty($_POST['nama_kategori'])) throw new Exception('Nama kategori harus diisi');

            $result = $this->model->update(
                ['nama_kategori' => $_POST['nama_kategori']],
                'id_kategori',
                $_POST['id_kategori']
            );

            if ($result) {
                $this->json(['success' => true, 'message' => 'Kategori berhasil diupdate']);
            } else {
                throw new Exception('Gagal mengupdate kategori');
            }
        } catch (Exception $e) {
            $this->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function delete() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->json(['success' => false, 'message' => 'Method not allowed']);
            return;
        }

        try {
            if (empty($_POST['id_kategori'])) throw new Exception('ID kategori tidak ditemukan');

            $barangList = $this->barang->byKategori($_POST['id_kategori']);
            
            if (!empty($barangList)) {
                throw new Exception('Kategori tidak dapat dihapus karena masih memiliki barang.');
            }

            $result = $this->model->delete('id_kategori', $_POST['id_kategori']);

            if ($result) {
                $this->json(['success' => true, 'message' => 'Kategori berhasil dihapus']);
            } else {
                throw new Exception('Gagal menghapus kategori');
            }
        } catch (Exception $e) {
            $this->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}
