<?php

class DetailTransaksi extends BaseModel {
    protected $table = 'detail_transaksi';

    public function almostExpired($days=7) {
        return $this->db->query("
            SELECT * FROM detail_transaksi 
            WHERE expired_date <= DATE_ADD(CURDATE(), INTERVAL $days DAY)
            AND sisa_kuantitas > 0
        ")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function reduceStock($id_barang, $qty_diminta) {
        // Ambil detail_transaksi (Batch) yang digabung dengan detail_ruangan (Lokasi)
        // Diurutkan berdasarkan expired_date (FEFO)
        $sql = "SELECT 
                    dt.id_detail_transaksi,
                    dt.sisa_kuantitas as sisa_di_batch,
                    dt.expired_date,
                    dr.id_detail_ruangan,
                    dr.kuantitas_ruangan as sisa_di_ruangan
                FROM detail_transaksi dt
                JOIN detail_ruangan dr ON dt.id_detail_transaksi = dr.id_detail_transaksi
                WHERE dt.id_barang = ? 
                AND dt.sisa_kuantitas > 0 
                AND dr.kuantitas_ruangan > 0
                ORDER BY dt.expired_date ASC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id_barang]);
        $stok_tersedia = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $sisa_permintaan = $qty_diminta;

        $update_batch_tracking = []; 

        $this->db->beginTransaction();

        try {
            foreach ($stok_tersedia as $item) {
                if ($sisa_permintaan <= 0) break;

                // Logika: Ambil sebanyak mungkin dari Ruangan ini, 
                // tapi gak boleh lebih dari sisa permintaan
                $ambil = min($item['sisa_di_ruangan'], $sisa_permintaan);

                // Update Ruangan (Langsung eksekusi karena id_detail_ruangan unik per baris)
                $new_stok_ruangan = $item['sisa_di_ruangan'] - $ambil;
                $updRuang = $this->db->prepare("UPDATE detail_ruangan SET kuantitas_ruangan = ? WHERE id_detail_ruangan = ?");
                $updRuang->execute([$new_stok_ruangan, $item['id_detail_ruangan']]);

                // Simpan hutang update ke Batch (detail_transaksi)
                // Kita kumpulkan dulu pengurangannya, jangan langsung update DB berulang kali untuk ID Batch yang sama
                $id_batch = $item['id_detail_transaksi'];
                if (!isset($update_batch_tracking[$id_batch])) {
                    $update_batch_tracking[$id_batch] = $item['sisa_di_batch'];
                }
                $update_batch_tracking[$id_batch] -= $ambil;

                $sisa_permintaan -= $ambil;
            }

            // Update batch-nya sesuai total pengurangan
            $updBatch = $this->db->prepare("UPDATE detail_transaksi SET sisa_kuantitas = ? WHERE id_detail_transaksi = ?");
            foreach ($update_batch_tracking as $id_batch => $sisa_akhir) {
                $updBatch->execute([$sisa_akhir, $id_batch]);
            }

            if ($sisa_permintaan > 0) {
                $this->db->rollBack();
                return false; 
            }

            $this->db->commit();
            return true;

        } catch (Exception $e) {
            $this->db->rollBack();
            return false;
        }
    }

    public function getBatchDetail($id_detail_transaksi) {
        $sql = "SELECT 
                    dt.id_detail_transaksi,
                    dt.sisa_kuantitas,
                    dt.expired_date,
                    b.nama_barang,
                    b.id_barang,
                    k.nama_kategori,
                    g.nama_gudang,
                    g.lokasi_gudang
                FROM detail_transaksi dt
                JOIN barang b ON dt.id_barang = b.id_barang
                JOIN kategori k ON b.id_kategori = k.id_kategori
                JOIN gudang g ON k.id_gudang = g.id_gudang
                WHERE dt.id_detail_transaksi = ?";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id_detail_transaksi]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
   
    public function getAllActiveBatches($id_gudang) {
        $sql = "SELECT dt.*, b.nama_barang 
                FROM detail_transaksi dt
                JOIN barang b ON dt.id_barang = b.id_barang
                JOIN kategori k ON b.id_kategori = k.id_kategori
                WHERE k.id_gudang = ? AND dt.sisa_kuantitas > 0
                ORDER BY dt.expired_date ASC";
                
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id_gudang]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
