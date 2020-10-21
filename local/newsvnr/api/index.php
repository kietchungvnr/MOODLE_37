<?php

require __DIR__ . '/../../../vendor/autoload.php';
require_once __DIR__ . '/../../../config.php';
require_once __DIR__ . '/../lib.php';

$settings = require __DIR__ . '../src/settings.php';
$app = new \Slim\App($settings);

require __DIR__ . '../src/dependencies.php';

require __DIR__ . '../src/middleware.php';
 
require __DIR__ . '../src/routes.php';

require __DIR__ . '../src/hrm/routes.php';

require __DIR__ . '../src/ebm/routes.php';


$app->run();