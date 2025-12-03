<?php

require_once __DIR__ . '/Ruangan.php';

class DetailRuangan extends BaseModel
{
    protected $table = 'detail_ruangan';
    public function __construct()
    {
        return parent::__construct();
    }

    public function getBarangByRuangan($id_ruangan) {
        $sql = "SELECT b.id_barang, b.nama_barang, SUM(dr.kuantitas_ruangan) as total_stok
                FROM detail_ruangan dr
                JOIN detail_transaksi dt ON dr.id_detail_transaksi = dt.id_detail_transaksi
                JOIN barang b ON dt.id_barang = b.id_barang
                WHERE dr.id_ruangan = ?
                GROUP BY b.id_barang, b.nama_barang";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id_ruangan]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getActiveBarangByRuangan($id_ruangan) {
        $sql = "SELECT b.id_barang, b.nama_barang, SUM(dr.kuantitas_ruangan) as total_stok
                FROM detail_ruangan dr
                JOIN detail_transaksi dt ON dr.id_detail_transaksi = dt.id_detail_transaksi
                JOIN barang b ON dt.id_barang = b.id_barang
                WHERE dr.id_ruangan = ?
                GROUP BY b.id_barang, b.nama_barang
                HAVING SUM(dr.kuantitas_ruangan) > 0";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id_ruangan]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getBatchByRuanganBarang($id_ruangan, $id_barang) {
        $sql = "SELECT dr.*, dt.expired_date, dt.id_detail_transaksi, b.nama_barang
                FROM detail_ruangan dr
                JOIN detail_transaksi dt ON dr.id_detail_transaksi = dt.id_detail_transaksi
                JOIN barang b ON dt.id_barang = b.id_barang
                WHERE dr.id_ruangan = ? AND dt.id_barang = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id_ruangan, $id_barang]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function moveBarang($id_detail_ruangan, $id_ruangan_tujuan, $kuantitas) {
        try {
            $this->db->beginTransaction();
            
            // Get current detail
            $current = $this->find('id_detail_ruangan', $id_detail_ruangan);
            if (!$current || $current['kuantitas_ruangan'] < $kuantitas) {
                throw new Exception('Kuantitas tidak mencukupi');
            }
            
            // Update source room quantity or delete if becomes 0
            $newQty = $current['kuantitas_ruangan'] - $kuantitas;
            if ($newQty == 0) {
                $this->delete('id_detail_ruangan', $id_detail_ruangan);
            } else {
                $this->update(['kuantitas_ruangan' => $newQty], 'id_detail_ruangan', $id_detail_ruangan);
            }
            
            // Check if batch exists in destination room
            $existing = $this->db->prepare("SELECT * FROM detail_ruangan WHERE id_ruangan = ? AND id_detail_transaksi = ?");
            $existing->execute([$id_ruangan_tujuan, $current['id_detail_transaksi']]);
            $existingBatch = $existing->fetch(PDO::FETCH_ASSOC);
            
            if ($existingBatch) {
                // Add to existing batch
                $newQty = $existingBatch['kuantitas_ruangan'] + $kuantitas;
                $this->update(['kuantitas_ruangan' => $newQty], 'id_detail_ruangan', $existingBatch['id_detail_ruangan']);
            } else {
                // Create new batch in destination room
                $this->insert([
                    'id_ruangan' => $id_ruangan_tujuan,
                    'id_detail_transaksi' => $current['id_detail_transaksi'],
                    'kuantitas_ruangan' => $kuantitas
                ]);
            }
            
            $this->db->commit();
            return true;
        } catch (Exception $e) {
            $this->db->rollBack();
            throw $e;
        }
    }
}