<?php

use Illuminate\Http\Request;

if (isset($_SERVER['HTTP_X_NOW_DEPLOY']) || env('APP_ENV') === 'production') {
    $_ENV['VIEW_COMPILED_PATH'] = '/tmp';
    $_ENV['APP_BASE_PATH'] = '/var/task/user';
}

define('LARAVEL_START', microtime(true));

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...
(require_once __DIR__.'/../bootstrap/app.php')
    ->handleRequest(Request::capture());
