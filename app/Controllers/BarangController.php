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
        $data['dataStok'] = $this->detailTransaksi->getAllActiveBatches($_SESSION['gudang']['id_gudang']);
        return $this->view('barang/index', $data);
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