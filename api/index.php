<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// --- ADD THIS BLOCK FOR VERCEL STORAGE PERMISSIONS ---
$storagePath = '/tmp/storage';
if (!is_dir($storagePath)) {
    mkdir($storagePath . '/framework/cache/data', 0755, true);
    mkdir($storagePath . '/framework/views', 0755, true);
    mkdir($storagePath . '/framework/sessions', 0755, true);
    mkdir($storagePath . '/bootstrap/cache', 0755, true);
}
// -----------------------------------------------------

if (file_exists($maintenance = __DIR__ . '/../storage/framework/maintenance.php')) {
    require $maintenance;
}

require __DIR__ . '/../vendor/autoload.php';

/** @var Application $app */
$app = require_once __DIR__ . '/../bootstrap/app.php';

// --- ADD THIS LINE TO REDIRECT STORAGE ---
$app->useStoragePath('/tmp/storage');
// ----------------------------------------

$app->handleRequest(Request::capture());