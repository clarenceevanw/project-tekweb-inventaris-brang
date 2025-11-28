<?php
require_once __DIR__ . '/../app/Controllers/HomeController.php';
require_once __DIR__ . '/../app/Controllers/AuthController.php';
require_once __DIR__ . '/../app/Controllers/DashboardController.php';
require_once __DIR__ . '/../app/Controllers/ScanController.php';
require_once __DIR__ . '/../app/Controllers/BarangController.php';

Router::get("/", "HomeController@index");

// Auth Routes
Router::get("/login/admin", "AuthController@showLoginAdmin");
Router::post("/login/admin", "AuthController@loginAdmin");
Router::get("/login/mitra", "AuthController@showLoginMitra");
Router::post("/login/mitra", "AuthController@loginMitra");

Router::get("/signup/admin", "AuthController@showSignupAdmin");
Router::post("/signup/admin", "AuthController@signupAdmin");
Router::get("/signup/mitra", "AuthController@showSignupMitra");
Router::post("/signup/mitra", "AuthController@signupMitra");

Router::get("/logout", "AuthController@logout");

//Mitra Routes
Router::get("/mitra/dashboard", "DashboardController@mitraDashboard", "auth");


//Admin Routes
Router::get("/admin/dashboard", "DashboardController@adminDashboard", "admin");

Router::get("/admin/scan", "ScanController@index", "admin");
Router::get("/admin/generate-qr", "ScanController@generateQr", "admin");

Router::get("/admin/barang", "BarangController@index", "admin");
Router::get("/admin/barang/batch", "BarangController@batch", "admin");
Router::get("/admin/barang/detail", "BarangController@detail", "admin");