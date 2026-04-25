<?php

use Illuminate\Support\Facades\Route;
use App\Models\Producto; // Le decimos al portero dónde está tu modelo

Route::get('/', function () {
    // 1. Buscamos TODOS los productos en la base de datos (COMENTADO PARA USO ESTATICO)
    // $productos = Producto::all();
    
    $productos = []; // Arreglo vacío para que no falle el compact
    
    // 2. Se los enviamos a tu vista 'Principal'
    return view('Principal', compact('productos'));
});

Route::get('/catalogo', function () {
    return view('Catalogo');
});

Route::get('/principal', function () {
    return view('Principal');
});

Route::get('/quienes-somos', function () {
    return view('quienes-somos');
});

Route::get('/terminos-y-usos', function () {
    return view('partes.Terminos-y-usos');
});

Route::get('/comercializacion', function () {
    return view('partes.Comercializacion');
});

Route::get('/contacto', function () {
    return view('partes.Contacto');
});
