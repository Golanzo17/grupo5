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
        $query = Producto::with(['categoria', 'talles'])
            ->whereHas('categoria', function ($q) {
                $q->where('slug', '!=', 'barberia');
            })
            ->where('activo', true);

        if ($request->filled('search')) {
            $query->where('nombre', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category') && $request->category !== 'all') {
            $query->whereHas('categoria', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        $productos = $query->withSum('talles as stock_total_sum', 'producto_talle.stock')
            ->orderByDesc('stock_total_sum')
            ->orderBy('created_at', 'desc')
            ->paginate(12)
            ->withQueryString();

        $categorias = Categoria::where('slug', '!=', 'barberia')->get();

        return view('Catalogo', compact('productos', 'categorias'));
    }
}
