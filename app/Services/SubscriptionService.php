<?php

require_once __DIR__ . '/../Models/PaketSubscription.php';

class SubscriptionService {
    private $paketModel;

    public function __construct(?PaketSubscription $paketModel = null) {
        $this->paketModel = $paketModel ?? new PaketSubscription();
    }

    public function getAllPaket() {
        return $this->paketModel->all();
    }
}
