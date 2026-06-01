<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// --- TAMBAHKAN INI DI PALING ATAS UNTUK MEMAKSA ERROR MUNCUL ---
error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
// -------------------------------------------------------------

$storagePath = '/tmp/storage';
if (!is_dir($storagePath)) {
    mkdir($storagePath . '/framework/cache/data', 0755, true);
    mkdir($storagePath . '/framework/views', 0755, true);
    mkdir($storagePath . '/framework/sessions', 0755, true);
    mkdir($storagePath . '/bootstrap/cache', 0755, true);
}

if (file_exists($maintenance = __DIR__ . '/../storage/framework/maintenance.php')) {
    require $maintenance;
}

require __DIR__ . '/../vendor/autoload.php';

/** @var Application $app */
$app = require_once __DIR__ . '/../bootstrap/app.php';

$app->useStoragePath('/tmp/storage');

// --- BUNGKUS DENGAN TRY-CATCH UNTUK MENANGKAP ERROR LAIN ---
try {
    $app->handleRequest(Request::capture());
} catch (\Throwable $e) {
    echo "<div style='padding: 20px; background: #fee2e2; color: #991b1b; font-family: sans-serif; border: 1px solid #f87171;'>";
    echo "<h2>Terjadi Error Internal Laravel:</h2>";
    echo "<p><strong>Pesan:</strong> " . $e->getMessage() . "</p>";
    echo "<p><strong>File:</strong> " . $e->getFile() . " (Baris " . $e->getLine() . ")</p>";
    echo "<pre style='background: #fff; padding: 10px; border: 1px solid #e5e7eb; overflow: auto;'>" . $e->getTraceAsString() . "</pre>";
    echo "</div>";
}
// -----------------------------------------------------------