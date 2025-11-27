<?php
require_once __DIR__ . '/../Utils/UUID.php';

class Admin extends BaseModel {
    protected $table = 'admin';

    public function __construct() {
        return parent::__construct();
    }

    public function login($username) {
        return $this->find('username_admin', $username);
    }

    public function signUpWithGudang($adminData, $gudangData) {
        $this->db->beginTransaction();
        try {
            $id_gudang = generate_uuid();
            $stmtGudang = $this->db->prepare("INSERT INTO gudang (id_gudang, nama_gudang, lokasi_gudang) VALUES (?, ?, ?)");
            $stmtGudang->execute([$id_gudang, $gudangData['nama_gudang'], $gudangData['lokasi_gudang']]);
            
            $adminData['id_admin'] = generate_uuid();
            $adminData['id_gudang'] = $id_gudang;
            $adminData['password_admin'] = password_hash($adminData['password_admin'], PASSWORD_DEFAULT);
            $this->insert($adminData);
            
            $this->db->commit();
            return true;
        } catch (Exception $e) {
            $this->db->rollBack();
            return false;
        }
    }

    public function addAdminToGudang($adminData) {
        $adminData['password_admin'] = password_hash($adminData['password_admin'], PASSWORD_DEFAULT);
        return $this->insert($adminData);
    }
}