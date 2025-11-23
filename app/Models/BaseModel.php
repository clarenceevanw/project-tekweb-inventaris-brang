<?php
require_once __DIR__ . '/../../config/Database.php';

class BaseModel {
    protected $db;
    protected $table;

    public function __construct() {
        $this->db = Database::getConnection();
    }

    public function all() {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table}");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
