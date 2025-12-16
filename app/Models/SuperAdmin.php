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

    // Laporan Subscription methods
    public function getSubscriptionStats()
    {
        $data = [];
        
        // Total subscription aktif
        $stmt = $this->db->prepare("
            SELECT COUNT(*) as count 
            FROM gudang 
            WHERE expired_date_gudang > NOW()
        ");
        $stmt->execute();
        $data['total_aktif'] = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
        
        // Akan berakhir dalam 7 hari
        $stmt = $this->db->prepare("
            SELECT COUNT(*) as count 
            FROM gudang 
            WHERE expired_date_gudang > NOW()
            AND expired_date_gudang <= DATE_ADD(NOW(), INTERVAL 7 DAY)
        ");
        $stmt->execute();
        $data['akan_berakhir'] = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
        
        // Total gudang terdaftar
        $stmt = $this->db->prepare("SELECT COUNT(*) as count FROM gudang");
        $stmt->execute();
        $data['total_gudang'] = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
        
        return $data;
    }

    public function getPaketPopuler($startDate = null, $endDate = null)
    {
        if ($startDate && $endDate) {
            $stmt = $this->db->prepare("
                SELECT p.nama_paket, COUNT(ts.id_subscription) as total_pembelian
                FROM paket_subscription p
                LEFT JOIN transaksi_subscription ts ON p.id_paket = ts.id_paket
                WHERE p.nama_paket NOT LIKE '%trial%' 
                AND ts.status_bayar LIKE '%lunas%'
                AND DATE(ts.tanggal_bayar) BETWEEN ? AND ?
                GROUP BY p.id_paket
                ORDER BY total_pembelian DESC
                LIMIT 5
            ");
            $stmt->execute([$startDate, $endDate]);
        } else {
            $stmt = $this->db->prepare("
                SELECT p.nama_paket, COUNT(ts.id_subscription) as total_pembelian
                FROM paket_subscription p
                LEFT JOIN transaksi_subscription ts ON p.id_paket = ts.id_paket
                WHERE p.nama_paket NOT LIKE '%trial%' AND ts.status_bayar LIKE '%lunas%'
                GROUP BY p.id_paket
                ORDER BY total_pembelian DESC
                LIMIT 5
            ");
            $stmt->execute();
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSubscriptionBulanIni($startDate = null, $endDate = null)
    {
        if ($startDate && $endDate) {
            $stmt = $this->db->prepare("
                SELECT g.nama_gudang, p.nama_paket, ts.tanggal_bayar as tanggal_transaksi, ts.status_bayar
                FROM transaksi_subscription ts
                JOIN gudang g ON ts.id_gudang = g.id_gudang
                JOIN paket_subscription p ON ts.id_paket = p.id_paket
                WHERE DATE(ts.tanggal_bayar) BETWEEN ? AND ?
                ORDER BY ts.tanggal_bayar DESC
                LIMIT 10
            ");
            $stmt->execute([$startDate, $endDate]);
        } else {
            $stmt = $this->db->prepare("
                SELECT g.nama_gudang, p.nama_paket, ts.tanggal_bayar as tanggal_transaksi, ts.status_bayar
                FROM transaksi_subscription ts
                JOIN gudang g ON ts.id_gudang = g.id_gudang
                JOIN paket_subscription p ON ts.id_paket = p.id_paket
                WHERE MONTH(ts.tanggal_bayar) = MONTH(NOW())
                AND YEAR(ts.tanggal_bayar) = YEAR(NOW())
                ORDER BY ts.tanggal_bayar DESC
                LIMIT 10
            ");
            $stmt->execute();
        }
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

    public function getSubscriptionChartData($periode = 30, $startDate = null, $endDate = null)
    {
        if ($startDate && $endDate) {
            $stmt = $this->db->prepare("
                SELECT DATE(tanggal_bayar) as tanggal, COUNT(*) as total
                FROM transaksi_subscription
                WHERE DATE(tanggal_bayar) BETWEEN ? AND ?
                GROUP BY DATE(tanggal_bayar)
                ORDER BY tanggal ASC
            ");
            $stmt->execute([$startDate, $endDate]);
        } else {
            $stmt = $this->db->prepare("
                SELECT DATE(tanggal_bayar) as tanggal, COUNT(*) as total
                FROM transaksi_subscription
                WHERE tanggal_bayar >= DATE_SUB(NOW(), INTERVAL ? DAY)
                GROUP BY DATE(tanggal_bayar)
                ORDER BY tanggal ASC
            ");
            $stmt->execute([$periode]);
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllSubscriptions()
    {
        $stmt = $this->db->prepare("
            SELECT g.nama_gudang, p.nama_paket, ts.tanggal_bayar, ts.status_bayar, p.id_paket
            FROM transaksi_subscription ts
            JOIN gudang g ON ts.id_gudang = g.id_gudang
            JOIN paket_subscription p ON ts.id_paket = p.id_paket
            ORDER BY ts.tanggal_bayar DESC
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}