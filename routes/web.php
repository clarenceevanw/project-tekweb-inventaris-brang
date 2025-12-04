<?php
require_once __DIR__ . '/../app/Controllers/HomeController.php';
require_once __DIR__ . '/../app/Controllers/AuthController.php';
require_once __DIR__ . '/../app/Controllers/DashboardController.php';
require_once __DIR__ . '/../app/Controllers/ScanController.php';
require_once __DIR__ . '/../app/Controllers/BarangController.php';
require_once __DIR__ . '/../app/Controllers/RuanganController.php';
require_once __DIR__ . '/../app/Controllers/KategoriController.php';
require_once __DIR__ . '/../app/Controllers/TransaksiController.php';
require_once __DIR__ . '/../app/Controllers/AdminController.php';
require_once __DIR__ . '/../app/Controllers/SubscriptionController.php';

Router::get("/", "HomeController@index");

// Auth Routesd
// Auth select login/signup
Router::get("/auth/select/login", "AuthController@redirectSelectLogin");
Router::get("/auth/select/signup", "AuthController@redirectSelectSignup");
Router::get("/auth/select", "AuthController@showSelectAuthAdminMitra");

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

// Admin Management Routes
Router::get("/admin/manage-admin", "AdminController@index", "admin");
Router::post("/admin/manage-admin/store", "AdminController@store", "admin");
Router::post("/admin/manage-admin/update", "AdminController@update", "admin");
Router::post("/admin/manage-admin/delete", "AdminController@delete", "admin");
Router::get("/admin/pembayaran", "DashboardController@pembayaran", "admin");

Router::get("/admin/scan", "ScanController@index", "admin");
Router::get("/admin/generate-qr", "ScanController@generateQr", "admin");

Router::get("/admin/kategori", "KategoriController@index", "admin");
Router::post("/admin/kategori/store", "KategoriController@store", "admin");
Router::post("/admin/kategori/update", "KategoriController@update", "admin");
Router::post("/admin/kategori/delete", "KategoriController@delete", "admin");

Router::get("/admin/barang", "BarangController@index", "admin");
Router::post("/admin/barang/store", "BarangController@store", "admin");
Router::post("/admin/barang/update", "BarangController@update", "admin");
Router::post('/admin/barang/delete', 'BarangController@delete', 'admin');
Router::get("/admin/barang/batch", "BarangController@batch", "admin");
Router::get("/admin/barang/detail", "BarangController@detail", "admin");
Router::get("/admin/barang/batch/ruangan", "BarangController@batchRuangan", "admin");
Router::post("/admin/barang/move", "BarangController@moveBarang", "admin");

Router::get("/admin/ruangan", "RuanganController@index", "admin");
Router::post("/admin/ruangan/store", "RuanganController@store", "admin");
Router::post("/admin/ruangan/update", "RuanganController@update", "admin");
Router::post("/admin/ruangan/delete", "RuanganController@delete", "admin");
Router::get("/admin/ruangan/barang", "RuanganController@barang", "admin");
Router::get("/admin/ruangan/batch", "RuanganController@batch", "admin");

Router::get("/admin/transaksi", "TransaksiController@index", "admin");
Router::get("/admin/transaksi/create", "TransaksiController@create", "admin");
Router::post("/admin/transaksi/store", "TransaksiController@store", "admin");
Router::get("/admin/transaksi/detail", "TransaksiController@detail", "admin");

// Subscription Routes
// Router untuk memproses klik tombol bayar
Router::post("/subscription/pay", "SubscriptionController@pay");
// Router balik dari Midtrans (Callback Redirect)
Router::get("/subscription/finish", "SubscriptionController@finish");
// Router untuk menerima notifikasi dari Midtrans (Webhook)
Router::post("/subscription/notification", "SubscriptionController@notification");