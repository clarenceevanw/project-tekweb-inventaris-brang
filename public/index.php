<?php
require_once __DIR__ . "/../config/Database.php";
require_once __DIR__ . "/../app/Models/BaseModel.php";
require_once __DIR__ . "/../app/Controllers/BaseController.php";
require_once __DIR__ . "/../app/Middleware/Middleware.php";
require_once __DIR__ . "/../app/Router.php";

require_once __DIR__ . "/../routes/web.php";

Router::run();
