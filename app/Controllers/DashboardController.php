<?php

class DashboardController extends BaseController {
    
    public function adminDashboard() {
        $data['title'] = 'Dashboard Admin';
        return $this->view('admin/dashboard', $data);
    }

    public function mitraDashboard() {
        $data['title'] = 'Dashboard Mitra';
        return $this->view('mitra/dashboard', $data);
    }
}
