<?php

class Admin extends BaseModel {
    protected $table = 'admin';

    public function __construct() {
        return parent::__construct();
    }

    public function login($username) {
        return $this->find('username_admin', $username);
    }

    public function signUp($data) {
        $data['password_admin'] = password_hash($data['password_admin'], PASSWORD_DEFAULT);
        return $this->insert($data);
    }
}