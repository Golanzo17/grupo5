<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$producto = \App\Models\Producto::first();
if($producto) { 
    try {
        $pivot = $producto->talles()->where('talle_id', 1)->first(); 
        echo 'ok'; 
    } catch (\Exception $e) {
        echo 'error: ' . $e->getMessage();
    }
} else {
    echo 'no products';
}
