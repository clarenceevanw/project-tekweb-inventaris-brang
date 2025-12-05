<?php
require_once __DIR__ . '/../Utils/UUID.php';

class Admin extends BaseModel {
    protected $table = 'admin';

    public function __construct() {
        return parent::__construct();
    }

    public function signUpWithGudang($adminData, $gudangData) {
        $this->db->beginTransaction();
        try {
            $id_gudang = generate_uuid();
            $expired_date = date('Y-m-d H:i:s', strtotime('+7 days'));
            $stmtGudang = $this->db->prepare("INSERT INTO gudang (id_gudang, nama_gudang, lokasi_gudang, expired_date_gudang) VALUES (?, ?, ?, ?)");
            $stmtGudang->execute([$id_gudang, $gudangData['nama_gudang'], $gudangData['lokasi_gudang'], $expired_date]);
            
            $adminData['id_admin'] = generate_uuid();
            $adminData['id_gudang'] = $id_gudang;
            $this->insert($adminData);
            
            $this->db->commit();
            return true;
        } catch (Exception $e) {
            $this->db->rollBack();
            return false;
        }
    }

    public function addAdminToGudang($adminData) {
        $adminData['id_admin'] = generate_uuid();
        return $this->insert($adminData);
    }

    public function updateAdmin($id, $data) {
        return $this->update($data, 'id_admin', $id);
    }

    public function deleteAdmin($id) {
        return $this->delete('id_admin', $id);
    }
}