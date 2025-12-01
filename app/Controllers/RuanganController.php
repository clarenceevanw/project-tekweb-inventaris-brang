<?php

require_once __DIR__ . '/../Models/Ruangan.php';
require_once __DIR__ . '/../Models/DetailRuangan.php';

class RuanganController extends BaseController {
    protected $detailRuangan;
    
    public function __construct() {
        parent::__construct(new Ruangan());
        $this->detailRuangan = new DetailRuangan();
    }

    public function index() {
        $data['title'] = 'Ruangan';
        $data['dataRuangan'] = $this->model->byGudang($_SESSION['gudang']['id_gudang']);
        return $this->view('ruangan/index', $data);
    }

    public function barang() {
        $id_ruangan = $_GET['id'] ?? null;

        if (!$id_ruangan) {
            $this->flash('error', 'ID ruangan tidak ditemukan.');
            return $this->redirect('/admin/ruangan');
        }

        $ruangan = $this->model->find('id_ruangan', $id_ruangan);

        if (!$ruangan) {
            $this->flash('error', 'Ruangan tidak ditemukan.');
            return $this->redirect('/admin/ruangan');
        }

        $barangList = $this->detailRuangan->getBarangByRuangan($id_ruangan);

        $data['title'] = 'Barang di Ruangan';
        $data['ruangan'] = $ruangan;
        $data['barangList'] = $barangList;
        return $this->view('ruangan/barang', $data);
    }

    public function batch() {
        $id_ruangan = $_GET['id_ruangan'] ?? null;
        $id_barang = $_GET['id_barang'] ?? null;

        if (!$id_ruangan || !$id_barang) {
            $this->flash('error', 'Parameter tidak lengkap.');
            return $this->redirect('/admin/ruangan');
        }

        $ruangan = $this->model->find('id_ruangan', $id_ruangan);

        if (!$ruangan) {
            $this->flash('error', 'Ruangan tidak ditemukan.');
            return $this->redirect('/admin/ruangan');
        }

        $batches = $this->detailRuangan->getBatchByRuanganBarang($id_ruangan, $id_barang);

        $data['title'] = 'Batch Barang di Ruangan';
        $data['ruangan'] = $ruangan;
        $data['batches'] = $batches;
        $data['id_ruangan'] = $id_ruangan;
        return $this->view('ruangan/batch', $data);
    }

    public function store() {
        header('Content-Type: application/json');
        
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->json(['success' => false, 'message' => 'Method not allowed']);
            return;
        }

        $nama_ruangan = $_POST['nama_ruangan'] ?? '';
        
        if (empty($nama_ruangan)) {
            $this->json(['success' => false, 'message' => 'Nama ruangan harus diisi']);
            return;
        }

        $id_gudang = $_SESSION['gudang']['id_gudang'];
        
        $result = $this->model->insert([
            'nama_ruangan' => $nama_ruangan,
            'id_gudang' => $id_gudang
        ]);

        if ($result) {
            $this->json(['success' => true, 'message' => 'Ruangan berhasil ditambahkan']);
        } else {
            $this->json(['success' => false, 'message' => 'Gagal menambahkan ruangan']);
        }
    }
}
