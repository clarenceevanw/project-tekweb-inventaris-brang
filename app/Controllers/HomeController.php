<?php

require_once __DIR__ . "/../Models/Gudang.php";

class HomeController extends BaseController {
    public function __construct() {
        parent::__construct(new Gudang());
    }

    public function index() {
        $data["title"] = "Home";
        $data["gudang"] = $this->model->all();
        $this->flash('success', 'Welcome to the home page!');
        return $this->view("home", $data);
    }
}