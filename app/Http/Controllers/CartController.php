<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Producto;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);
        $items = $cart->items()->with(['producto', 'talle'])->get();
        return view('carrito.index', compact('cart', 'items'));
    }

    public function add(Request $request, $productoId)
    {
        $request->validate([
            'talle_id' => 'required|exists:talles,id',
            'cantidad' => 'nullable|integer|min:1',
        ]);
        
        $talleId = $request->input('talle_id');
        $cantidad = $request->input('cantidad', 1);
        
        // Validar que el producto existe y está activo
        $producto = Producto::where('activo', true)->findOrFail($productoId);
        
        // Validar stock disponible
        $pivot = $producto->talles()->where('talle_id', $talleId)->first();
        if (!$pivot || $pivot->pivot->stock <= 0) {
            $msg = 'Este producto está agotado en el talle seleccionado.';
            if ($request->wantsJson()) {
                return response()->json(['success' => false, 'message' => $msg], 422);
            }
            return redirect()->back()->with('error', $msg);
        }

        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);
        
        $item = $cart->items()
                     ->where('producto_id', $productoId)
                     ->where('talle_id', $talleId)
                     ->first();

        // Verificar que la cantidad total no exceda el stock
        $cantidadActual = $item ? $item->cantidad : 0;
        if (($cantidadActual + $cantidad) > $pivot->pivot->stock) {
            $msg = 'No hay suficiente stock. Disponible: ' . $pivot->pivot->stock;
            if ($request->wantsJson()) {
                return response()->json(['success' => false, 'message' => $msg], 422);
            }
            return redirect()->back()->with('error', $msg);
        }

        if ($item) {
            $item->cantidad += $cantidad;
            $item->save();
        } else {
            $cart->items()->create([
                'producto_id' => $productoId,
                'talle_id' => $talleId,
                'cantidad' => $cantidad,
            ]);
        }
        
        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Producto agregado al carrito',
                'cart_count' => $cart->items()->sum('cantidad'),
                'mini_cart_html' => view('partes.mini_cart', ['cart' => $cart])->render()
            ]);
        }
        
        return redirect()->back()->with('success', 'Producto agregado al carrito');
    }

    public function update(Request $request, $itemId)
    {
        $request->validate([
            'cantidad' => 'required|integer|min:1',
        ]);

        $cart = Cart::where('user_id', Auth::id())->firstOrFail();
        $item = $cart->items()->findOrFail($itemId);
        
        // Validar que no exceda el stock disponible
        if ($item->producto && $item->talle_id) {
            $pivot = $item->producto->talles()->where('talle_id', $item->talle_id)->first();
            if ($pivot && $request->input('cantidad') > $pivot->pivot->stock) {
                return redirect()->back()->with('error', 'Stock insuficiente. Disponible: ' . $pivot->pivot->stock);
            }
        }

        $item->cantidad = $request->input('cantidad');
        $item->save();
        return redirect()->back();
    }

    public function remove(Request $request, $itemId)
    {
        $cart = Cart::where('user_id', Auth::id())->firstOrFail();
        $item = $cart->items()->findOrFail($itemId);
        
        $item->delete();

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Producto eliminado',
                'cart_count' => $cart->items()->sum('cantidad'),
                'mini_cart_html' => view('partes.mini_cart', ['cart' => $cart])->render()
            ]);
        }

        return redirect()->back();
    }
}

