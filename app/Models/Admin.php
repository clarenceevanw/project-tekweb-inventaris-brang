<?php

class Admin extends BaseModel {
    protected $table = 'admin';

    public function __construct() {
        return parent::__construct();
    }

    public function login($username) {
        return $this->find('username_admin', $username);
    }
}