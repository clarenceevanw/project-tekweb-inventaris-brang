<?php

class HomeController extends BaseController {
    public function index() {
        $data["title"] = "Home";
        return $this->view("home", $data);
    }
}