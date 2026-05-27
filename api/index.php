<?php

// 1. Jalankan autoloader Composer agar semua library terbaca
require __DIR__ . '/../vendor/autoload.php';

// 2. Ambil instansiasi aplikasi langsung dari bootstrap/app.php yang sudah kita perbaiki
$app = require_once __DIR__ . '/../bootstrap/app.php';

// 3. Jalankan aplikasi Laravel untuk menangani permintaan yang masuk
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);