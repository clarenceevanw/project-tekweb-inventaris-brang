<?php

require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../Utils/MidtransConfig.php';
require_once __DIR__ . '/../Models/TransaksiSubscription.php';
require_once __DIR__ . '/../Models/PaketSubscription.php';
require_once __DIR__ . '/../Utils/UUID.php';
require_once __DIR__ . '/../Models/Gudang.php';

class SubscriptionController extends BaseController {
    protected $paketModel;
    protected $transaksiModel;
    protected $gudangModel;

    public function __construct() {
        parent::__construct();
        $this->paketModel = new PaketSubscription();
        $this->transaksiModel = new TransaksiSubscription();
        $this->gudangModel = new Gudang();
    }

    public function pay() {
        if (!isset($_SESSION['gudang']['id_gudang'])) {
            $this->flash('error', 'Session tidak valid');
            $this->redirect('/auth/select/login');
            return;
        }

        $id_paket = $_POST['id_paket'] ?? null;
        if (!$id_paket) {
            $this->flash('error', 'Paket tidak dipilih');
            $this->redirect('/admin/dashboard');
            return;
        }

        $id_gudang = $_SESSION['gudang']['id_gudang'];

        $paket = $this->paketModel->find('id_paket', $id_paket);
        
        if (!$paket) {
            $this->flash('error', 'Paket tidak ditemukan');
            $this->redirect('/admin/dashboard');
            return;
        }

        $harga = (int) $paket['harga'];
        $nama_paket = $paket['nama_paket'];

        $id_subscription = generate_uuid();

        $dataInsert = [
            'id_subscription' => $id_subscription,
            'id_gudang'       => $id_gudang,
            'id_paket'        => $id_paket,
            'status_bayar'    => 'pending' 
        ];
        
        try {
            $this->transaksiModel->insert($dataInsert);
        } catch (Exception $e) {
            $this->flash('error', 'Gagal membuat transaksi');
            $this->redirect('/admin/dashboard');
            return;
        }

        // Data yang dikirim ke midtrans
        $params = [
            'transaction_details' => [
                'order_id'     => $id_subscription,
                'gross_amount' => $harga,
            ],
            'customer_details' => [
                'first_name' => $_SESSION['gudang']['nama_admin'],
                'email'      => 'admin@gudang.com',
            ],
            'item_details' => [
                [
                    'id'       => $id_paket,
                    'price'    => $harga,
                    'quantity' => 1,
                    'name'     => $nama_paket
                ]
            ],
            'callbacks' => [
                'finish' => 'http://localhost:8000/subscription/finish'
            ]
        ];

        $server_key = MidtransConfig::getServerKey();
        $url = MidtransConfig::getSnapUrl();

        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
                'Accept: application/json',
                'Authorization: Basic ' . base64_encode($server_key . ':')
            ]);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

            $response = curl_exec($ch);
            $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            if ($response === false || $http_code !== 201) {
                throw new Exception('Gagal koneksi ke Midtrans');
            }

            $result = json_decode($response, true);

            if (isset($result['redirect_url'])) {
                header("Location: " . $result['redirect_url']);
                exit;
            } else {
                throw new Exception('Tidak ada redirect URL dari Midtrans');
            }
        } catch (Exception $e) {
            $this->flash('error', 'Gagal membuat pembayaran: ' . $e->getMessage());
            $this->redirect('/admin/dashboard');
        }
    }

    public function finish() {
        $order_id = $_GET['order_id'] ?? null;
        
        if (!$order_id) {
            $this->flash('error', 'Order ID tidak ditemukan');
            $this->redirect('/admin/dashboard');
            return;
        }
        
        $server_key = MidtransConfig::getServerKey();
        $base_api_url = MidtransConfig::isProduction()
            ? 'https://api.midtrans.com/v2' 
            : 'https://api.sandbox.midtrans.com/v2';
            
        $url_status = "$base_api_url/$order_id/status";

        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url_status);
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
                'Accept: application/json',
                'Authorization: Basic ' . base64_encode($server_key . ':')
            ]);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $response = curl_exec($ch);
            curl_close($ch);

            if ($response === false) {
                throw new Exception('Gagal mengecek status pembayaran');
            }

            $status_midtrans = json_decode($response, true);
        } catch (Exception $e) {
            $this->flash('error', 'Gagal mengecek status: ' . $e->getMessage());
            $this->redirect('/admin/dashboard');
            return;
        }
        
        $trx_status = $status_midtrans['transaction_status'] ?? 'failure';
        $this->processPaymentStatus($order_id, $trx_status);
        $this->redirect('/admin/dashboard');
    }

    public function notification() {
        $json = file_get_contents('php://input');
        $notification = json_decode($json, true);

        if (!$notification) {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Invalid JSON']);
            exit;
        }

        $order_id = $notification['order_id'] ?? null;
        $status_code = $notification['status_code'] ?? null;
        $gross_amount = $notification['gross_amount'] ?? null;
        $signature_key = $notification['signature_key'] ?? null;

        if (!$order_id || !$signature_key) {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Missing required fields']);
            exit;
        }

        // Validasi signature
        $server_key = MidtransConfig::getServerKey();
        $hashed = hash('sha512', $order_id . $status_code . $gross_amount . $server_key);

        if ($hashed !== $signature_key) {
            http_response_code(403);
            echo json_encode(['status' => 'error', 'message' => 'Invalid signature']);
            exit;
        }

        $trx_status = $notification['transaction_status'] ?? 'failure';
        $this->processPaymentStatus($order_id, $trx_status);

        http_response_code(200);
        echo json_encode(['status' => 'success']);
        exit;
    }

    private function processPaymentStatus($order_id, $trx_status) {
        // Cek apakah transaksi sudah diproses
        $transaksi = $this->transaksiModel->find('id_subscription', $order_id);
        
        if (!$transaksi) {
            return;
        }

        // Jika sudah lunas, jangan proses lagi (idempotency)
        if ($transaksi['status_bayar'] === 'lunas') {
            return;
        }

        if ($trx_status == 'settlement' || $trx_status == 'capture') {
            $this->transaksiModel->update(
                ['status_bayar' => 'lunas'], 
                'id_subscription', 
                $order_id
            );
            
            $detail = $this->transaksiModel->getDetailWithPaket($order_id);
            
            if ($detail) {
                $durasi = $detail['durasi_hari'];
                $id_gudang = $detail['id_gudang'];
                $this->gudangModel->perpanjangSewa($id_gudang, $durasi);
            }

            if (session_status() === PHP_SESSION_ACTIVE) {
                $this->flash('success', 'Pembayaran Lunas! Akun aktif.');
            }
        } else if ($trx_status == 'pending') {
            $this->transaksiModel->update(['status_bayar' => 'pending'], 'id_subscription', $order_id);
            if (session_status() === PHP_SESSION_ACTIVE) {
                $this->flash('warning', 'Menunggu pembayaran...');
            }
        } else {
            $this->transaksiModel->update(['status_bayar' => 'gagal'], 'id_subscription', $order_id);
            if (session_status() === PHP_SESSION_ACTIVE) {
                $this->flash('error', 'Pembayaran gagal.');
            }
        }
    }
}
