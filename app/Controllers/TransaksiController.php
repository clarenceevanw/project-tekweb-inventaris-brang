<?php

require_once __DIR__ . '/../Models/Transaksi.php';
require_once __DIR__ . '/../Models/DetailTransaksi.php';

class TransaksiController extends BaseController {
    protected $detailTransaksi;
    
    public function __construct() {
        parent::__construct(new Transaksi());
        $this->detailTransaksi = new DetailTransaksi();
    }

    public function index() {
        $data['title'] = 'Transaksi';
        $data['dataTransaksi'] = $this->model->getByGudang($_SESSION['gudang']['id_gudang']);
        return $this->view('transaksi/index', $data);
    }

    public function detail() {
        $id_transaksi = $_GET['id'] ?? null;

        if (!$id_transaksi) {
            $this->flash('error', 'ID transaksi tidak ditemukan.');
            return $this->redirect('/admin/transaksi');
        }

        $transaksi = $this->model->getDetailById($id_transaksi);

        if (!$transaksi) {
            $this->flash('error', 'Transaksi tidak ditemukan.');
            return $this->redirect('/admin/transaksi');
        }

        $detailItems = $this->detailTransaksi->getByTransaksi($id_transaksi);

        $data['title'] = 'Detail Transaksi';
        $data['transaksi'] = $transaksi;
        $data['detailItems'] = $detailItems;
        return $this->view('transaksi/detail', $data);
    }
}
