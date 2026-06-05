<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = Cart::with(['items.producto', 'items.talle'])->where('user_id', Auth::id())->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('carrito.index')->with('error', 'Tu carrito está vacío.');
        }

        return view('checkout.index', compact('cart'));
    }

    public function process(Request $request)
    {
        $cart = Cart::with(['items.producto', 'items.talle'])->where('user_id', Auth::id())->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('carrito.index')->with('error', 'Tu carrito está vacío.');
        }

        $request->validate([
            'nombre'       => 'required|string|max:255',
            'apellido'     => 'required|string|max:255',
            'telefono'     => 'required|string|max:20',
            'metodo_pago'  => 'required|in:transferencia,tarjeta',
            'tipo_entrega' => 'required|in:envio,local',
            'direccion'    => 'required_if:tipo_entrega,envio|nullable|string|max:255',
            'ciudad'       => 'required_if:tipo_entrega,envio|nullable|string|max:255',
            'codigo_postal'=> 'required_if:tipo_entrega,envio|nullable|string|max:20',
            'notas'        => 'nullable|string',
        ]);

        try {
            DB::beginTransaction();

            $total = 0;
            // Validar stock primero
            foreach ($cart->items as $item) {
                if (!$item->producto) continue;
                
                $pivot = $item->producto->talles()->where('talle_id', $item->talle_id)->first();
                if (!$pivot || $pivot->pivot->stock < $item->cantidad) {
                    throw new \Exception("Stock insuficiente para: " . $item->producto->nombre . ($item->talle ? " (Talle {$item->talle->nombre})" : ""));
                }
                
                $total += $item->producto->precio * $item->cantidad;
            }

            // Crear orden
            $order = Order::create([
                'user_id'       => Auth::id(),
                'total'         => $total,
                'estado'        => 'pendiente',
                'metodo_pago'   => $request->metodo_pago,
                'tipo_entrega'  => $request->tipo_entrega,
                'nombre'        => $request->nombre,
                'apellido'      => $request->apellido,
                'telefono'      => $request->telefono,
                'direccion'     => $request->tipo_entrega === 'envio' ? $request->direccion : null,
                'ciudad'        => $request->tipo_entrega === 'envio' ? $request->ciudad : null,
                'codigo_postal' => $request->tipo_entrega === 'envio' ? $request->codigo_postal : null,
                'notas'         => $request->notas,
            ]);

            // Procesar items, crear OrderItems y restar stock atómicamente
            foreach ($cart->items as $item) {
                if (!$item->producto) continue;

                OrderItem::create([
                    'order_id'        => $order->id,
                    'producto_id'     => $item->producto_id,
                    'talle_id'        => $item->talle_id,
                    'cantidad'        => $item->cantidad,
                    'precio_unitario' => $item->producto->precio,
                ]);

                // Restar stock de forma atómica (previene race conditions)
                DB::table('producto_talle')
                    ->where('producto_id', $item->producto_id)
                    ->where('talle_id', $item->talle_id)
                    ->decrement('stock', $item->cantidad);
            }

            // Vaciar carrito
            $cart->items()->delete();

            DB::commit();

            return redirect()->route('checkout.success', $order->id);

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function success(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        return view('checkout.success', compact('order'));
    }

    public function comprobante(Order $order)
    {
        // Solo el dueño de la orden o un admin pueden ver el comprobante
        if ($order->user_id !== Auth::id() && Auth::user()->rol->nombre !== 'admin') {
            abort(403);
        }

        return view('checkout.comprobante', compact('order'));
    }
}
