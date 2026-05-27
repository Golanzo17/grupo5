<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;

class HomeController extends Controller
{
    /**
     * Página principal de la tienda
     */
    public function index()
    {
        // Obtenemos todos los productos activos y destacados para la vista principal
        // Por ahora traemos los últimos 15 destacados
        $productos = Producto::with(['categoria', 'talles'])
                            ->whereHas('categoria', function ($query) {
                                $query->where('slug', '!=', 'barberia');
                            })
                            ->where('activo', true)
                            ->orderBy('created_at', 'desc')
                            ->take(15)
                            ->get();

        // Ordenar: primero con stock, luego agotados
        $productos = $productos->sortByDesc(function ($producto) {
            return $producto->stock_total > 0 ? 1 : 0;
        })->values();

        return view('Principal', compact('productos'));
    }

    /**
     * Catálogo completo
     */
    public function catalogo(Request $request)
    {
        // Podemos implementar filtros más adelante, por ahora traemos todos paginados
        $productos = Producto::with(['categoria', 'talles'])
                            ->whereHas('categoria', function ($query) {
                                $query->where('slug', '!=', 'barberia');
                            })
                            ->where('activo', true)
                            ->orderBy('created_at', 'desc')
                            ->get(); // Sin paginación por ahora, para mantener el mismo diseño estático
                            
        // Ordenar para mostrar primero los que tienen stock y al final los agotados
        $productos = $productos->sortByDesc(function ($producto) {
            return $producto->stock_total > 0 ? 1 : 0;
        })->values();

        $categorias = Categoria::all();

        return view('Catalogo', compact('productos', 'categorias'));
    }
}
