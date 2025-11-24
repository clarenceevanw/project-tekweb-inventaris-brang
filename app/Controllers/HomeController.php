<?php

class HomeController extends BaseController {
    public function index() {
        $data["title"] = "Home";
        $this->flash('success', 'Welcome to the home page!');
        return $this->view("home", $data);
    }
}