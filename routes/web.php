<?php
require_once __DIR__ . '/../app/Controllers/HomeController.php';

Router::get("/", "HomeController@index");