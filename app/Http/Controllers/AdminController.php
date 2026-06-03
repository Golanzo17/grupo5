<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Consulta;
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
        $totalConsultas  = Consulta::count();
        $consultasNuevas = Consulta::where('leida', false)->count();

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

        // Últimas 5 consultas sin leer
        $ultimasConsultas = Consulta::where('leida', false)
            ->latest()
            ->take(5)
            ->get();

        return view('Backend.Admin.Dashboard', compact(
            'totalUsuarios',
            'totalProductos',
            'totalCategorias',
            'totalConsultas',
            'consultasNuevas',
            'ultimosUsuarios',
            'ultimosProductos',
            'ultimasConsultas'
        ));
    }

    /**
     * Mostrar historial de ventas.
     */
    public function ventas()
    {
        $ordenes = \App\Models\Order::with(['user', 'items.producto'])->orderBy('created_at', 'desc')->paginate(15);
        return view('Backend.Admin.ventas.index', compact('ordenes'));
    }

    /**
     * Actualizar estado de una venta.
     */
    public function actualizarEstadoVenta(Request $request, \App\Models\Order $order)
    {
        $request->validate([
            'estado' => 'required|in:pendiente,completado,cancelado'
        ]);

        $estadoAnterior = $order->estado;
        $order->estado = $request->estado;
        $order->save();

        // Devolver stock si se cancela
        if ($estadoAnterior !== 'cancelado' && $order->estado === 'cancelado') {
            foreach ($order->items as $item) {
                if ($item->producto && $item->talle_id) {
                    $pivot = $item->producto->talles()->where('talle_id', $item->talle_id)->first();
                    if ($pivot) {
                        $item->producto->talles()->updateExistingPivot($item->talle_id, [
                            'stock' => $pivot->pivot->stock + $item->cantidad
                        ]);
                    }
                }
            }
        } 
        // Descontar stock si se revierte la cancelación
        elseif ($estadoAnterior === 'cancelado' && $order->estado !== 'cancelado') {
            foreach ($order->items as $item) {
                if ($item->producto && $item->talle_id) {
                    $pivot = $item->producto->talles()->where('talle_id', $item->talle_id)->first();
                    if ($pivot) {
                        $item->producto->talles()->updateExistingPivot($item->talle_id, [
                            'stock' => $pivot->pivot->stock - $item->cantidad
                        ]);
                    }
                }
            }
        }

        return redirect()->back()->with('exito', 'Estado de la orden #' . str_pad($order->id, 5, '0', STR_PAD_LEFT) . ' actualizado a ' . ucfirst($order->estado) . '.');
    }
}
