<?php

use Illuminate\Support\Facades\Route;
use App\Models\Producto; // Le decimos al portero dónde está tu modelo

Route::get('/', function () {
    // 1. Buscamos TODOS los productos en la base de datos
    $productos = Producto::all();
    
    // 2. Se los enviamos a tu vista 'Principal'
    return view('Principal', compact('productos'));
});
