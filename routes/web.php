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
require_once __DIR__ . '/../app/Controllers/GudangController.php';
require_once __DIR__ . '/../app/Controllers/ProfileController.php';

Router::get("/", "HomeController@index");

// Auth Routesd
// Auth select login/signup
Router::get("/auth/select/login", "AuthController@redirectSelectLogin");
Router::get("/auth/select/signup", "AuthController@redirectSelectSignup");
Router::get("/auth/select", "AuthController@showSelectAuthAdminMitra");
Router::get("/auth/subscribe-redirect", "AuthController@subscribeRedirect");

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

// Profile Routes
Router::get("/profile", "ProfileController@index", "auth");
Router::post("/profile/update-username", "ProfileController@updateUsername", "auth");
Router::post("/profile/update-email", "ProfileController@updateEmail", "auth");

//Mitra Routes
Router::get("/mitra/dashboard", "DashboardController@mitraDashboard", "auth");

Router::get("/mitra/transaksi", "TransaksiController@historyMitra", "auth");
Router::get("/mitra/transaksi/detail", "TransaksiController@detailMitra", "auth");

//Admin Routes
Router::get("/admin/dashboard", "DashboardController@adminDashboard", "subscription");

// Admin Management Routes
Router::get("/admin/manage-admin", "AdminController@index", "subscription");
Router::post("/admin/manage-admin/store", "AdminController@store", "subscription");
Router::post("/admin/manage-admin/update", "AdminController@update", "subscription");
Router::post("/admin/manage-admin/delete", "AdminController@delete", "subscription");

Router::get("/admin/scan", "ScanController@index", "subscription");
Router::get("/admin/generate-qr", "ScanController@generateQr", "subscription");

Router::get("/admin/kategori", "KategoriController@index", "subscription");
Router::post("/admin/kategori/store", "KategoriController@store", "subscription");
Router::post("/admin/kategori/update", "KategoriController@update", "subscription");
Router::post("/admin/kategori/delete", "KategoriController@delete", "subscription");

Router::get("/admin/barang", "BarangController@index", "subscription");
Router::post("/admin/barang/store", "BarangController@store", "subscription");
Router::post("/admin/barang/update", "BarangController@update", "subscription");
Router::post('/admin/barang/delete', 'BarangController@delete', 'subscription');
Router::get("/admin/barang/batch", "BarangController@batch", "subscription");
Router::get("/admin/barang/detail", "BarangController@detail", "subscription");
Router::get("/admin/barang/batch/ruangan", "BarangController@batchRuangan", "subscription");
Router::post("/admin/barang/move", "BarangController@moveBarang", "subscription");

Router::get("/admin/ruangan", "RuanganController@index", "subscription");
Router::post("/admin/ruangan/store", "RuanganController@store", "subscription");
Router::post("/admin/ruangan/update", "RuanganController@update", "subscription");
Router::post("/admin/ruangan/delete", "RuanganController@delete", "subscription");
Router::get("/admin/ruangan/barang", "RuanganController@barang", "subscription");
Router::get("/admin/ruangan/batch", "RuanganController@batch", "subscription");

Router::get("/admin/transaksi", "TransaksiController@index", "subscription");
Router::get("/admin/transaksi/create", "TransaksiController@create", "subscription");
Router::post("/admin/transaksi/store", "TransaksiController@store", "subscription");
Router::get("/admin/transaksi/detail", "TransaksiController@detail", "subscription");

Router::get('/admin/gudang', "GudangController@index", "admin");
Router::post('/admin/gudang/update', "GudangController@update", "subscription");
Router::get("/admin/gudang/pembayaran", "DashboardController@pembayaran", "admin");

// Subscription Routes
// Router untuk memproses klik tombol bayar
Router::post("/subscription/pay", "SubscriptionController@pay", "admin");
// Router balik dari Midtrans (Callback Redirect)
Router::get("/subscription/finish", "SubscriptionController@finish", "admin");
// Router untuk menerima notifikasi dari Midtrans (Webhook)
Router::post("/subscription/notification", "SubscriptionController@notification", "admin");