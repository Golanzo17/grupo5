<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\UsuarioController;

use App\Http\Controllers\HomeController;

// ─────────────────────────────────────────────
// RUTAS PÚBLICAS (sin autenticación)
// ─────────────────────────────────────────────

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/catalogo', [HomeController::class, 'catalogo'])->name('catalogo.index');

Route::redirect('/principal', '/');

Route::get('/quienes-somos', function () {
    return view('quienes-somos');
});

Route::get('/terminos-y-usos', function () {
    return view('Terminos-y-usos');
});

Route::get('/comercializacion', function () {
    return view('Comercializacion');
});

Route::get('/contacto', function () {
    return view('Contacto');
});

Route::get('/consultas', function () {
    return view('Consultas');
});

Route::get('/turnos', function () {
    return view('Turnos');
});

// ─────────────────────────────────────────────
// RUTAS DE AUTENTICACIÓN (solo para invitados)
// ─────────────────────────────────────────────

Route::middleware('guest')->group(function () {
    Route::get('/login',     [AuthController::class, 'formularioLogin'])->name('login');
    Route::post('/login',    [AuthController::class, 'autenticar'])->name('login.post');
    Route::get('/registro',  [AuthController::class, 'formularioRegistro'])->name('registro');
    Route::post('/registro', [AuthController::class, 'registrar'])->name('registro.post');
});

// Logout (requiere estar autenticado)
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// ─────────────────────────────────────────────
// RUTAS DE ADMIN (requiere auth + rol admin)
// ─────────────────────────────────────────────

Route::middleware(['auth', 'rol:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');

    // CRUD Productos
    Route::resource('productos', ProductoController::class);

    // CRUD Categorías
    Route::resource('categorias', CategoriaController::class);

    // Gestión de Usuarios
    Route::resource('usuarios', UsuarioController::class);
});

// ─────────────────────────────────────────────
// RUTAS DE CLIENTE (requiere auth + rol cliente)
// ─────────────────────────────────────────────

Route::middleware(['auth', 'rol:cliente'])->prefix('cliente')->name('cliente.')->group(function () {
    Route::get('/',       [ClienteController::class, 'dashboard'])->name('dashboard');
    Route::get('/perfil', [ClienteController::class, 'perfil'])->name('perfil');
    Route::put('/perfil', [ClienteController::class, 'actualizarPerfil'])->name('perfil.update');
});
