<?php

require_once __DIR__ . '/BaseModel.php';

class SuperAdmin extends BaseModel
{
    protected $table = 'superadmin';

    public function findByEmail($email)
    {
        return $this->find('email_superadmin', $email);
    }

    public function getDashboardStats()
    {
        $stats = [];
        
        $stmt = $this->db->prepare("SELECT COUNT(*) as total FROM gudang");
        $stmt->execute();
        $stats['total_gudang'] = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

        $stmt = $this->db->prepare("SELECT COUNT(*) as total FROM admin WHERE deleted_at IS NULL");
        $stmt->execute();
        $stats['total_admin'] = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

        $stmt = $this->db->prepare("SELECT COUNT(*) as total FROM mitra");
        $stmt->execute();
        $stats['total_mitra'] = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

        $stmt = $this->db->prepare("SELECT COUNT(*) as total FROM transaksi");
        $stmt->execute();
        $stats['total_transaksi'] = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

        return $stats;
    }

    public function getRecentGudang($limit = 5)
    {
        $stmt = $this->db->prepare("SELECT * FROM gudang ORDER BY id_gudang DESC LIMIT ?");
        $stmt->bindValue(1, $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getRecentAdmin($limit = 5)
    {
        $stmt = $this->db->prepare("
            SELECT a.*, g.nama_gudang as gudang_nama 
            FROM admin a 
            LEFT JOIN gudang g ON a.id_gudang = g.id_gudang 
            WHERE a.deleted_at IS NULL
            ORDER BY a.id_admin DESC 
            LIMIT ?
        ");
        $stmt->bindValue(1, $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getGudangChartData()
    {
        $data = [];
        for ($i = 1; $i <= 6; $i++) {
            $data[] = ['month' => $i, 'count' => rand(1, 10)];
        }
        return $data;
    }

    public function getAdminChartData()
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) as count FROM admin WHERE deleted_at IS NULL");
        $stmt->execute();
        $total = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
        
        $stmt = $this->db->prepare("SELECT COUNT(*) as count FROM admin WHERE id_gudang IS NULL AND deleted_at IS NULL");
        $stmt->execute();
        $belum = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
        
        return [$total - $belum, $belum];
    }

    // Gudang methods
    public function getAllGudangWithAdmin()
    {
        $stmt = $this->db->prepare("
            SELECT g.*, 
                   (SELECT a.nama_admin FROM admin a WHERE a.id_gudang = g.id_gudang AND a.deleted_at IS NULL LIMIT 1) as admin_nama
            FROM gudang g 
            ORDER BY g.nama_gudang ASC
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createGudang($data)
    {
        require_once __DIR__ . '/../Utils/UUID.php';
        
        $this->db->beginTransaction();
        try {
            $id_gudang = generate_uuid();
            $expired = date('Y-m-d H:i:s', strtotime('+7 days'));
            
            // Insert gudang dengan status trial
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
            
            // Insert admin untuk gudang ini
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
            $this->db->rollBack();
            return false;
        }
    }

    public function updateGudang($id, $namaGudang, $alamat)
    {
        $stmt = $this->db->prepare("UPDATE gudang SET nama_gudang = ?, lokasi_gudang = ? WHERE id_gudang = ?");
        return $stmt->execute([$namaGudang, $alamat, $id]);
    }

    public function deleteGudang($id)
    {
        $stmt = $this->db->prepare("DELETE FROM gudang WHERE id_gudang = ?");
        return $stmt->execute([$id]);
    }

    // Admin methods
    public function getAllAdminWithGudang()
    {
        $stmt = $this->db->prepare("
            SELECT a.*, g.nama_gudang as gudang_nama 
            FROM admin a 
            LEFT JOIN gudang g ON a.id_gudang = g.id_gudang 
            WHERE a.deleted_at IS NULL
            ORDER BY a.nama_admin ASC
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createAdmin($data)
    {
        require_once __DIR__ . '/../Utils/UUID.php';
        
        $stmt = $this->db->prepare("
            INSERT INTO admin (id_admin, nama_admin, email_admin, username_admin, password_admin, id_gudang) 
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        return $stmt->execute([
            generate_uuid(),
            $data['nama_admin'],
            $data['email'],
            $data['email'],
            password_hash($data['password'], PASSWORD_DEFAULT),
            $data['gudang_id'] ?: null
        ]);
    }

    public function deleteAdmin($id)
    {
        $stmt = $this->db->prepare("UPDATE admin SET deleted_at = NOW() WHERE id_admin = ?");
        return $stmt->execute([$id]);
    }

    // Mitra methods
    public function getAllMitraWithSubscription()
    {
        $stmt = $this->db->prepare("
            SELECT m.*
            FROM mitra m 
            ORDER BY m.nama_mitra ASC
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createMitra($data)
    {
        require_once __DIR__ . '/../Utils/UUID.php';
        
        $stmt = $this->db->prepare("
            INSERT INTO mitra (id_mitra, nama_mitra, email_mitra, username_mitra, password_mitra) 
            VALUES (?, ?, ?, ?, ?)
        ");
        return $stmt->execute([
            generate_uuid(),
            $data['nama_mitra'],
            $data['email'],
            $data['email'],
            password_hash($data['password'], PASSWORD_DEFAULT)
        ]);
    }

    public function deleteMitra($id)
    {
        $stmt = $this->db->prepare("DELETE FROM mitra WHERE id_mitra = ?");
        return $stmt->execute([$id]);
    }

    // Laporan methods
    public function getLaporanData()
    {
        $data = [];
        
        $stmt = $this->db->prepare("SELECT COUNT(*) as count FROM transaksi_subscription WHERE status_bayar = 'lunas'");
        $stmt->execute();
        $data['total_pendapatan'] = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
        
        $stmt = $this->db->prepare("SELECT COUNT(*) as count FROM transaksi_subscription");
        $stmt->execute();
        $data['transaksi_baru'] = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
        
        $stmt = $this->db->prepare("SELECT COUNT(*) as count FROM gudang");
        $stmt->execute();
        $data['gudang_baru'] = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
        
        $stmt = $this->db->prepare("SELECT COUNT(*) as count FROM mitra");
        $stmt->execute();
        $data['mitra_baru'] = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
        
        return $data;
    }

    public function getTopGudang()
    {
        $stmt = $this->db->prepare("
            SELECT g.nama_gudang, 
                   COUNT(DISTINCT a.id_admin) as total_admin,
                   0 as total_transaksi, 
                   0 as total_pendapatan
            FROM gudang g 
            LEFT JOIN admin a ON g.id_gudang = a.id_gudang AND a.deleted_at IS NULL
            GROUP BY g.id_gudang
            ORDER BY total_admin DESC 
            LIMIT 5
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getGudangAktifCount()
    {
        $stmt = $this->db->prepare("
            SELECT COUNT(*) as count 
            FROM gudang 
            WHERE status_gudang = 'active' 
            AND expired_date_gudang > NOW()
        ");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['count'];
    }

    public function getGudangAkanBerakhir()
    {
        $stmt = $this->db->prepare("
            SELECT COUNT(*) as count 
            FROM gudang 
            WHERE status_gudang = 'active' 
            AND expired_date_gudang > NOW()
            AND expired_date_gudang < DATE_ADD(NOW(), INTERVAL 30 DAY)
        ");
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)['count'];
    }
}