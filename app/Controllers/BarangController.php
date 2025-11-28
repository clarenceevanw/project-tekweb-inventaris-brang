<?php

require_once __DIR__ . '/../Models/DetailTransaksi.php';
require_once __DIR__ . '/../Models/Barang.php';
class BarangController extends BaseController {
    protected $detailTransaksi;
    public function __construct()
    {
        parent::__construct(new Barang());
        $this->detailTransaksi = new DetailTransaksi();
    }

    public function index() {
        $data['title'] = 'Barang';
        $data['dataBarang'] = $this->model->withKategoriAndStok($_SESSION['gudang']['id_gudang']);
        return $this->view('barang/index', $data);
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
        return $this->view('barang/detail', [
            'item' => $dataLengkap
        ]);
    }
}