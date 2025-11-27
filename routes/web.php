<?php
require_once __DIR__ . '/../app/Controllers/HomeController.php';
require_once __DIR__ . '/../app/Controllers/AuthController.php';

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