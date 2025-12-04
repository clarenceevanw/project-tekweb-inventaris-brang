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

    public function find($field, $value) {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE $field = ?");
        $stmt->execute([$value]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insert(array $data) {
        $columns = implode(',', array_keys($data));
        $values  = ':' . implode(',:', array_keys($data));
        $sql = "INSERT INTO {$this->table} ($columns) VALUES ($values)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    public function update(array $data, $field, $value) {
        $set = '';
        foreach ($data as $key => $val) {
            $set .= "$key=:$key,";
        }
        $set = rtrim($set, ',');

        $sql = "UPDATE {$this->table} SET $set WHERE $field = :id";
        $data['id'] = $value;

        $stmt = $this->db->prepare($sql);
        return $stmt->execute($data);
    }

    public function delete($field, $value) {
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE $field=?");
        return $stmt->execute([$value]);
    }

    public function query($sql, $params = []) {
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
