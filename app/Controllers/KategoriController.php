<?php

require_once __DIR__ . '/../Models/Kategori.php';

class KategoriController extends BaseController {
    
    public function __construct() {
        parent::__construct(new Kategori());
    }

    public function index() {
        $data['title'] = 'Kategori';
        $data['dataKategori'] = $this->model->byGudang($_SESSION['gudang']['id_gudang']);
        return $this->view('kategori/index', $data);
    }

    public function store() {
        header('Content-Type: application/json');
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->json(['success' => false, 'message' => 'Method not allowed']);
            return;
        }

        $nama_kategori = $_POST['nama_kategori'] ?? '';
        
        if (empty($nama_kategori)) {
            $this->json(['success' => false, 'message' => 'Nama kategori harus diisi']);
            return;
        }

        $id_gudang = $_SESSION['gudang']['id_gudang'];
        
        $result = $this->model->insert([
            'nama_kategori' => $nama_kategori,
            'id_gudang' => $id_gudang
        ]);

        if ($result) {
            $this->json(['success' => true, 'message' => 'Kategori berhasil ditambahkan']);
        } else {
            $this->json(['success' => false, 'message' => 'Gagal menambahkan kategori']);
        }
    }
}
