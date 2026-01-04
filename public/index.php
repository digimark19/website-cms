<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// PRODUCCION : Descomentar las lineas de abajo para producción
// Register the Composer autoloader...
require __DIR__.'/../mycms_core/vendor/autoload.php';
$app = require __DIR__.'/../mycms_core/bootstrap/app.php';

// require __DIR__.'/../vendor/autoload.php';
// $app = require_once __DIR__.'/../bootstrap/app.php';

// Bootstrap Laravel and handle the request...
$app->handleRequest(Request::capture());
