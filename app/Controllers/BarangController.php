<?php

require_once __DIR__ . '/../Models/DetailTransaksi.php';
require_once __DIR__ . '/../Models/Barang.php';
require_once __DIR__ . '/../Models/Ruangan.php';
require_once __DIR__ . '/../Utils/UploadHelper.php';
class BarangController extends BaseController {
    
    protected $kategori;
    protected $detailTransaksi;
    protected $ruangan;
    public function __construct()
    {
        parent::__construct(new Barang());
        $this->kategori = new Kategori();
        $this->detailTransaksi = new DetailTransaksi();
        $this->ruangan = new Ruangan();
    }

    public function index() {
        $data['title'] = 'Barang';
        $data['dataBarang'] = $this->model->withKategoriAndStok($_SESSION['gudang']['id_gudang']);
        $data['kategori'] = $this->kategori->byGudang($_SESSION['gudang']['id_gudang']);
        return $this->view('barang/index', $data);
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->json(['success' => false, 'message' => 'Method not allowed']);
            return;
        }

        try {
            if (empty($_POST['nama_barang'])) throw new Exception('Nama Barang harus diisi');
            if (empty($_POST['kategori'])) throw new Exception('Kategori harus dipilih');

            $nama_barang = $_POST['nama_barang'];
            $id_kategori = $_POST['kategori'];

            $katCheck = $this->kategori->find('id_kategori', $id_kategori);
            if (!$katCheck) throw new Exception('Kategori tidak valid.');

            if(empty($_FILES['foto_barang']) || $_FILES['foto_barang']['error'] == 4) {
                throw new Exception('Foto barang harus diisi');
            }

            $fotoName = null;
            if (isset($_FILES['foto_barang']) && $_FILES['foto_barang']['error'] != 4) {
                $fotoName = UploadHelper::uploadGambar($_FILES['foto_barang'], 'barang/');
            }

            $dataInsert = [
                'nama_barang' => $nama_barang,
                'id_kategori' => $id_kategori,
                'foto_barang' => $fotoName
            ];

            $result = $this->model->insert($dataInsert);

            if ($result) {
                $this->json(['success' => true, 'message' => 'Barang berhasil ditambahkan']);
            } else {
                throw new Exception('Gagal menyimpan ke database.');
            }

        } catch (Exception $e) {
            $this->json(['success' => false, 'message' => $e->getMessage()]);
        }
        return;
    }

    public function update() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->json(['success' => false, 'message' => 'Method not allowed']);
            return;
        }

        try {
            if (empty($_POST['id_barang'])) throw new Exception('ID Barang tidak ditemukan');
            if (empty($_POST['nama_barang'])) throw new Exception('Nama Barang harus diisi');
            if (empty($_POST['kategori'])) throw new Exception('Kategori harus dipilih');

            $id_barang = $_POST['id_barang'];
            $nama_barang = $_POST['nama_barang'];
            $id_kategori = $_POST['kategori'];

            $katCheck = $this->kategori->find('id_kategori', $id_kategori);
            if (!$katCheck) throw new Exception('Kategori tidak valid.');
            
            $dataUpdate = [
                'nama_barang' => $nama_barang,
                'id_kategori' => $id_kategori
            ];

            // Hanya update foto jika ada file baru yang diupload
            if (isset($_FILES['foto_barang']) && $_FILES['foto_barang']['error'] != 4) {
                $fotoName = UploadHelper::uploadGambar($_FILES['foto_barang'], 'barang/');
                $dataUpdate['foto_barang'] = $fotoName;
            }

            $result = $this->model->update($dataUpdate, 'id_barang', $id_barang);

            if ($result) {
                $this->json(['success' => true, 'message' => 'Barang berhasil diupdate']);
            } else {
                throw new Exception('Gagal menyimpan ke database.');
            }

        } catch (Exception $e) {
            $this->json(['success' => false, 'message' => $e->getMessage()]);
        }
        return;
    }

    public function delete() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->json(['success' => false, 'message' => 'Method not allowed']);
            return;
        }

        try {
            if (empty($_POST['id_barang'])) throw new Exception('ID Barang tidak ditemukan');

            $id_barang = $_POST['id_barang'];

            $batches = $this->detailTransaksi->getBatchesByBarang($id_barang);
            if (!empty($batches)) {
                throw new Exception('Barang tidak dapat dihapus karena masih memiliki transaksi/batch aktif.');
            }

            $result = $this->model->delete('id_barang', $id_barang);

            if ($result) {
                $this->json(['success' => true, 'message' => 'Barang berhasil dihapus']);
            } else {
                throw new Exception('Gagal menghapus barang.');
            }

        } catch (Exception $e) {
            $this->json(['success' => false, 'message' => $e->getMessage()]);
        }
        return;
    }

    public function batch() {
        $id_barang = $_GET['id'] ?? null;
        
        if (!$id_barang) {
            $this->flash('error', 'ID barang tidak ditemukan.');
            return $this->redirect('/admin/barang');
        }

        $barang = $this->model->findByGudang($id_barang, $_SESSION['gudang']['id_gudang']);
        
        if (!$barang) {
            $this->flash('error', 'Barang tidak ditemukan.');
            return $this->redirect('/admin/barang');
        }

        $batches = $this->detailTransaksi->getBatchesByBarang($id_barang);

        $data['title'] = 'Batch Barang';
        $data['barang'] = $barang;
        $data['batches'] = $batches;
        return $this->view('barang/batch', $data);
    }

    public function detail() {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            $this->flash('error', 'ID barang tidak ditemukan.');
            return $this->redirect('/');
        }

        // PANGGIL METHOD BARU YANG KITA BUAT DI MODEL TADI
        $dataLengkap = $this->detailTransaksi->getBatchDetail($id);

        if (!$dataLengkap) {
            $this->flash('error', 'Data barang tidak ditemukan.');
            return $this->redirect('/');
        }

        // Kirim ke View
        $data['title'] = 'Detail Barang';
        $data['item'] = $dataLengkap;
        return $this->view('barang/detail', $data);
    }

    public function batchRuangan() {
        $id = $_GET['id'] ?? null;

        if (!$id) {
            $this->flash('error', 'ID batch tidak ditemukan.');
            return $this->redirect('/admin/barang/batch');
        }

        $ruangan = $this->ruangan->getRuanganByBatch($id);

        if (!$ruangan) {
            $this->flash('error', 'Ruangan tidak ditemukan.');
            return $this->redirect('/admin/barang/batch');
        }

        $barang = $this->detailTransaksi->getBatchDetail($id);

        $data['title'] = 'Ruangan Batch';
        $data['barang'] = $barang;
        $data['ruangan'] = $ruangan;
        return $this->view('barang/batch-ruangan', $data);
    }
}