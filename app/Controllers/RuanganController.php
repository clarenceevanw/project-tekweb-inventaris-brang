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

        $barangList = $this->detailRuangan->getActiveBarangByRuangan($id_ruangan);

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
        $allRuangan = $this->model->byGudang($_SESSION['gudang']['id_gudang']);

        $data['title'] = 'Batch Barang di Ruangan';
        $data['ruangan'] = $ruangan;
        $data['batches'] = $batches;
        $data['id_ruangan'] = $id_ruangan;
        $data['allRuangan'] = $allRuangan;
        return $this->view('ruangan/batch', $data);
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->json(['success' => false, 'message' => 'Method not allowed']);
            return;
        }

        try {
            if (empty($_POST['nama_ruangan'])) throw new Exception('Nama ruangan harus diisi');

            $result = $this->model->insert([
                'nama_ruangan' => $_POST['nama_ruangan'],
                'id_gudang' => $_SESSION['gudang']['id_gudang']
            ]);

            if ($result) {
                $this->json(['success' => true, 'message' => 'Ruangan berhasil ditambahkan']);
            } else {
                throw new Exception('Gagal menambahkan ruangan');
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
            if (empty($_POST['id_ruangan'])) throw new Exception('ID ruangan tidak ditemukan');
            if (empty($_POST['nama_ruangan'])) throw new Exception('Nama ruangan harus diisi');

            $result = $this->model->update(
                ['nama_ruangan' => $_POST['nama_ruangan']],
                'id_ruangan',
                $_POST['id_ruangan']
            );

            if ($result) {
                $this->json(['success' => true, 'message' => 'Ruangan berhasil diupdate']);
            } else {
                throw new Exception('Gagal mengupdate ruangan');
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
            if (empty($_POST['id_ruangan'])) throw new Exception('ID ruangan tidak ditemukan');

            $barangList = $this->detailRuangan->getBarangByRuangan($_POST['id_ruangan']);
            if (!empty($barangList)) {
                throw new Exception('Ruangan tidak dapat dihapus karena masih memiliki barang.');
            }

            $result = $this->model->delete('id_ruangan', $_POST['id_ruangan']);

            if ($result) {
                $this->json(['success' => true, 'message' => 'Ruangan berhasil dihapus']);
            } else {
                throw new Exception('Gagal menghapus ruangan');
            }
        } catch (Exception $e) {
            $this->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}
