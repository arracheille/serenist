<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Tentukan jika aplikasi sedang dalam mode perbaikan...
if (file_exists($maintenance = __DIR__ . '/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Registrasi Composer autoloader...
require __DIR__ . '/../vendor/autoload.php';

// Jalankan Laravel...
/** @var Application $app */
$app = require_once __DIR__ . '/../bootstrap/app.php';

$app->handleRequest(Request::capture());