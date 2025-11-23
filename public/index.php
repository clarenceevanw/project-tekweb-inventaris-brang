<?php
require_once __DIR__ . "/config/Database.php";
require_once __DIR__ . "/core/BaseModel.php";
require_once __DIR__ . "/core/BaseController.php";
require_once __DIR__ . "/core/Middleware.php";
require_once __DIR__ . "/core/Router.php";

require_once __DIR__ . "/routes/web.php";

// jalankan router
Router::run();
