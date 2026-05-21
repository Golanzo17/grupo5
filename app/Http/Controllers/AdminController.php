<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Mostrar el dashboard del administrador con estadísticas.
     */
    public function dashboard()
    {
        $totalUsuarios   = Usuario::count();
        $totalProductos  = Producto::count();
        $totalCategorias = Categoria::count();

        // Últimos 5 usuarios registrados
        $ultimosUsuarios = Usuario::with('rol')
            ->latest()
            ->take(5)
            ->get();

        // Últimos 5 productos creados
        $ultimosProductos = Producto::with('categoria')
            ->latest()
            ->take(5)
            ->get();

        return view('Backend.Admin.Dashboard', compact(
            'totalUsuarios',
            'totalProductos',
            'totalCategorias',
            'ultimosUsuarios',
            'ultimosProductos'
        ));
    }
}
