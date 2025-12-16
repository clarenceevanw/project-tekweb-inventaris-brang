<?php

require_once __DIR__ . '/BaseModel.php';
require_once __DIR__ . '/../Utils/UUID.php';


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

    // Gudang methods - delegated to Gudang model

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
        $stmt = $this->db->prepare("
            INSERT INTO mitra (id_mitra, nama_mitra, email_mitra, username_mitra, password_mitra) 
            VALUES (?, ?, ?, ?, ?)
        ");
        return $stmt->execute([
            generate_uuid(),
            $data['nama_mitra'],
            $data['email_mitra'],
            $data['username_mitra'],
            password_hash($data['password_mitra'], PASSWORD_DEFAULT)
        ]);
    }

    public function updateMitra($id, $data)
    {
        $stmt = $this->db->prepare("
            UPDATE mitra 
            SET nama_mitra = ?, email_mitra = ?
            WHERE id_mitra = ?
        ");
        return $stmt->execute([
            $data['nama_mitra'],
            $data['email_mitra'],
            $id
        ]);
    }

    public function deleteMitra($id)
    {
        $stmt = $this->db->prepare("DELETE FROM mitra WHERE id_mitra = ?");
        return $stmt->execute([$id]);
    }

}