<?php

require_once __DIR__ . '/../Models/Gudang.php';
require_once __DIR__ . '/../Services/SubscriptionService.php';

class HomeController extends BaseController {
    private $subscriptionService;

    public function __construct() {
        parent::__construct(new Gudang());
        $this->subscriptionService = new SubscriptionService();
    }

    public function index() {
        $data["title"] = "Home";
        $data["gudang"] = $this->model->all();
        $data["paket_subscriptions"] = $this->subscriptionService->getAllPaket();

        $this->flash('success', 'Welcome to the home page!');
        return $this->view("home", $data);
    }
}