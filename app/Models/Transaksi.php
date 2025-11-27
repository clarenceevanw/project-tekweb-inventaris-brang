<?php

require_once __DIR__ . '/DetailTransaksi.php';

class Transaksi extends BaseModel {
    protected $table = 'transaksi';

    public function __construct()
    {
        return parent::__construct();
    }

    public function createFullTransaction($dataTransaksi, $items) {
        try {
            $this->db->beginTransaction();

            $transaksiId = generate_uuid(); 

            $sqlTrans = "INSERT INTO transaksi (id_transaksi, jenis_transaksi, id_mitra, id_admin) VALUES (?, ?, ?, ?)";
            $stmt = $this->db->prepare($sqlTrans);
            $stmt->execute([
                $transaksiId, 
                $dataTransaksi['jenis_transaksi'], 
                $dataTransaksi['id_mitra'], 
                $dataTransaksi['id_admin']
            ]);

            // 4. Insert Detail Transaksi (Looping items)
            $sqlDetail = "INSERT INTO detail_transaksi (id_detail_transaksi, kuantitas_transaksi, sisa_kuantitas, expired_date, id_transaksi, id_barang) VALUES (?, ?, ?, ?, ?, ?)";
            $stmtDetail = $this->db->prepare($sqlDetail);

            foreach($items as $item) {
                $stmtDetail->execute([
                    generate_uuid(),
                    $item['qty'],
                    $item['qty'],
                    $item['expired_date'],
                    $transaksiId,
                    $item['id_barang']
                ]);
            }

            $this->db->commit();
            return true;

        } catch (Exception $e) {
            $this->db->rollBack();
            return false;
        }
    }
}