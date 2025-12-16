<?php
require_once __DIR__ . '/../Utils/UUID.php';

class Gudang extends BaseModel {
    protected $table = 'gudang';

    public function __construct() {
        return parent::__construct();
    }

    public function perpanjangSewa($id_gudang, $durasi_hari) {
        $gudang = $this->find('id_gudang', $id_gudang);
        
        $sekarang = time();
        $expired_lama = strtotime($gudang['expired_date_gudang']);
        
        if ($expired_lama > $sekarang) {
            $tanggal_baru = date('Y-m-d H:i:s', strtotime("+$durasi_hari days", $expired_lama));
        } else {
            $tanggal_baru = date('Y-m-d H:i:s', strtotime("+$durasi_hari days"));
        }

        return $this->update([
            'expired_date_gudang' => $tanggal_baru,  
            'status_gudang' => 'active'
        ], 'id_gudang', $id_gudang);
    }

    public function getAllWithAdmin() {
        $stmt = $this->db->prepare("
            SELECT g.*, 
                   (SELECT a.nama_admin FROM admin a WHERE a.id_gudang = g.id_gudang AND a.deleted_at IS NULL LIMIT 1) as admin_nama
            FROM gudang g 
            ORDER BY g.nama_gudang ASC
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createWithAdmin($data) {
        
        try {
            $this->db->beginTransaction();
            
            $id_gudang = generate_uuid();
            $expired = date('Y-m-d H:i:s', strtotime('+7 days'));
            
            $stmt = $this->db->prepare("
                INSERT INTO gudang (id_gudang, nama_gudang, lokasi_gudang, status_gudang, expired_date_gudang) 
                VALUES (?, ?, ?, 'trial', ?)
            ");
            $stmt->execute([
                $id_gudang,
                $data['nama_gudang'],
                $data['alamat'],
                $expired
            ]);
            
            $id_admin = generate_uuid();
            $stmt = $this->db->prepare("
                INSERT INTO admin (id_admin, nama_admin, email_admin, username_admin, password_admin, id_gudang) 
                VALUES (?, ?, ?, ?, ?, ?)
            ");
            $stmt->execute([
                $id_admin,
                $data['nama_admin'],
                $data['email_admin'],
                $data['username_admin'],
                password_hash($data['password_admin'], PASSWORD_DEFAULT),
                $id_gudang
            ]);
            
            $this->db->commit();
            return true;
        } catch (Exception $e) {
            if ($this->db->inTransaction()) {
                $this->db->rollBack();
            }
            error_log("Error createWithAdmin: " . $e->getMessage());
            return false;
        }
    }

    public function updateGudang($id, $namaGudang, $alamat) {
        $stmt = $this->db->prepare("UPDATE gudang SET nama_gudang = ?, lokasi_gudang = ? WHERE id_gudang = ?");
        return $stmt->execute([$namaGudang, $alamat, $id]);
    }

    public function deleteGudang($id) {
        $stmt = $this->db->prepare("DELETE FROM gudang WHERE id_gudang = ?");
        return $stmt->execute([$id]);
    }

    public function getAktifCount() {
        $stmt = $this->db->prepare("
            SELECT COUNT(*) as count 
            FROM gudang 
            WHERE status_gudang = 'active' 
            AND expired_date_gudang > NOW()
        ");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['count'];
    }

    public function getAkanBerakhir() {
        $stmt = $this->db->prepare("
            SELECT g.nama_gudang, g.expired_date_gudang,
                   DATEDIFF(g.expired_date_gudang, NOW()) as sisa_hari
            FROM gudang g
            WHERE g.expired_date_gudang > NOW()
            AND g.expired_date_gudang <= DATE_ADD(NOW(), INTERVAL 30 DAY)
            ORDER BY g.expired_date_gudang ASC
            LIMIT 10
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateExpiredStatus() {
        try {
            // Update status menjadi expired jika sudah melewati tanggal berakhir
            $stmt = $this->db->prepare("
                UPDATE gudang 
                SET status_gudang = 'expired' 
                WHERE expired_date_gudang <= NOW() 
                AND status_gudang != 'expired'
            ");
            $stmt->execute();
            return true;
        } catch (Exception $e) {
            error_log("Error updateExpiredStatus: " . $e->getMessage());
            return false;
        }
    }
}
