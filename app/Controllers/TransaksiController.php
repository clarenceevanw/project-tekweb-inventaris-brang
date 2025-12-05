<?php

require_once __DIR__ . '/../Models/Transaksi.php';
require_once __DIR__ . '/../Models/DetailTransaksi.php';
require_once __DIR__ . '/../Models/Mitra.php';
require_once __DIR__ . '/../Models/Barang.php';
require_once __DIR__ . '/../Models/Ruangan.php';
require_once __DIR__ . '/../Models/DetailRuangan.php';

class TransaksiController extends BaseController {
    protected $detailTransaksi;
    protected $mitra;
    protected $barang;
    protected $ruangan;
    protected $detailRuangan;
    
    public function __construct() {
        parent::__construct(new Transaksi());
        $this->detailTransaksi = new DetailTransaksi();
        $this->mitra = new Mitra();
        $this->barang = new Barang();
        $this->ruangan = new Ruangan();
        $this->detailRuangan = new DetailRuangan();
    }

    public function index() {
        $data['title'] = 'Transaksi';
        $data['dataTransaksi'] = $this->model->getByGudang($_SESSION['gudang']['id_gudang']);
        $data['mitra'] = $this->mitra->all();
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

    public function create() {
        $data['title'] = 'Tambah Transaksi';
        $data['mitra'] = $this->mitra->all();
        $data['barang'] = $this->barang->byGudang($_SESSION['gudang']['id_gudang']);
        $data['ruangan'] = $this->ruangan->byGudang($_SESSION['gudang']['id_gudang']);
        return $this->view('transaksi/create', $data);
    }

    public function store() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->json(['success' => false, 'message' => 'Method not allowed']);
            return;
        }

        try {
            if (empty($_POST['jenis_transaksi'])) throw new Exception('Jenis transaksi harus dipilih');
            if (empty($_POST['id_mitra'])) throw new Exception('Mitra harus dipilih');
            if (empty($_POST['items'])) throw new Exception('Minimal 1 item barang harus ditambahkan');

            // Cek stok untuk transaksi buy SEBELUM insert apapun
            if ($_POST['jenis_transaksi'] == 'buy') {
                foreach ($_POST['items'] as $item) {
                    $stok_tersedia = $this->detailTransaksi->getAvailableStock($item['id_barang']);
                    if ($stok_tersedia < $item['kuantitas']) {
                        $barang = $this->barang->find('id_barang', $item['id_barang']);
                        throw new Exception("Stok {$barang['nama_barang']} tidak mencukupi. Tersedia: {$stok_tersedia}, Diminta: {$item['kuantitas']}");
                    }
                }
            }

            $id_transaksi = generate_uuid();
            $total_harga = 0;

            foreach ($_POST['items'] as $item) {
                $total_harga += floatval($item['harga']);
            }

            $resultTransaksi = $this->model->insert([
                'id_transaksi' => $id_transaksi,
                'jenis_transaksi' => $_POST['jenis_transaksi'],
                'harga_transaksi' => $total_harga,
                'id_mitra' => $_POST['id_mitra'],
                'id_admin' => $_SESSION['user']['id_admin'],
                'id_gudang' => $_SESSION['gudang']['id_gudang']
            ]);

            if (!$resultTransaksi) throw new Exception('Gagal menyimpan transaksi');

            foreach ($_POST['items'] as $item) {
                if ($_POST['jenis_transaksi'] == 'buy') {
                    $reduced = $this->detailTransaksi->reduceStock($item['id_barang'], $item['kuantitas']);
                    if (!$reduced) throw new Exception('Gagal mengurangi stok barang');
                }
                
                $id_detail = generate_uuid();
                $dataDetail = [
                    'id_detail_transaksi' => $id_detail,
                    'kuantitas_transaksi' => $item['kuantitas'],
                    'sisa_kuantitas' => $_POST['jenis_transaksi'] == 'supply' ? $item['kuantitas'] : 0,
                    'expired_date' => !empty($item['expired_date']) ? $item['expired_date'] : null,
                    'harga_detail_transaksi' => $item['harga'],
                    'id_transaksi' => $id_transaksi,
                    'id_barang' => $item['id_barang']
                ];
                
                $resultDetail = $this->detailTransaksi->insert($dataDetail);
                if (!$resultDetail) throw new Exception('Gagal menyimpan detail transaksi');

                if ($_POST['jenis_transaksi'] == 'supply') {
                    $resultRuangan = $this->detailRuangan->insert([
                        'kuantitas_ruangan' => $item['kuantitas'],
                        'id_ruangan' => $item['id_ruangan'],
                        'id_detail_transaksi' => $id_detail
                    ]);
                    
                    if (!$resultRuangan) throw new Exception('Gagal menyimpan ke ruangan');
                }
            }

            $this->json(['success' => true, 'message' => 'Transaksi berhasil ditambahkan']);

        } catch (Exception $e) {
            $this->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function historyMitra() {
        $data['title'] = 'History Transaksi';
        $data['dataTransaksi'] = $this->model->getByMitra($_SESSION['user']['id_mitra']);
        return $this->view('mitra/transaksi', $data);
    }

    public function detailMitra() {
        $id_transaksi = $_GET['id'] ?? null;

        if (!$id_transaksi) {
            $this->flash('error', 'ID transaksi tidak ditemukan.');
            return $this->redirect('/mitra/transaksi');
        }

        $transaksi = $this->model->getDetailById($id_transaksi);

        if (!$transaksi || $transaksi['id_mitra'] != $_SESSION['user']['id_mitra']) {
            $this->flash('error', 'Transaksi tidak ditemukan.');
            return $this->redirect('/mitra/transaksi');
        }

        $detailItems = $this->detailTransaksi->getByTransaksi($id_transaksi);

        $data['title'] = 'Detail Transaksi';
        $data['transaksi'] = $transaksi;
        $data['detailItems'] = $detailItems;
        return $this->view('mitra/detail-transaksi', $data);
    }
}
