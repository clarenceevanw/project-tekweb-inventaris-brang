<?php

class Mitra extends BaseModel
{
    protected $table = 'mitra';

    public function __construct()
    {
        return parent::__construct();
    }

    public function signUp($data) {
        $data['password_mitra'] = password_hash($data['password_mitra'], PASSWORD_DEFAULT);
        return $this->insert($data);
    }

    public function historySupply($id) {
        $stmt = $this->db->prepare("
            SELECT t.*, b.nama_barang, d.kuantitas_transaksi, g.nama_gudang
            FROM transaksi t
            JOIN detail_transaksi d ON t.id_transaksi = d.id_transaksi
            JOIN barang b ON d.id_barang = b.id_barang
            JOIN admin a on t.id_admin = a.id_admin
            JOIN gudang g on a.id_gudang = g.id_gudang
            WHERE t.id_mitra = ? AND t.jenis_transaksi = 'supply'
            ORDER BY t.tanggal_transaksi DESC
        ");
        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function historyBuy($id) {
        $stmt = $this->db->prepare("
            SELECT t.*, b.nama_barang, d.kuantitas_transaksi, g.nama_gudang
            FROM transaksi t
            JOIN detail_transaksi d ON t.id_transaksi = d.id_transaksi
            JOIN barang b ON d.id_barang = b.id_barang
            JOIN admin a on t.id_admin = a.id_admin
            JOIN gudang g on a.id_gudang = g.id_gudang
            WHERE t.id_mitra = ? AND t.jenis_transaksi = 'buy'
            ORDER BY t.tanggal_transaksi DESC
        ");
        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}