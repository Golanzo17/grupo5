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
            'talle_id' => 'required|exists:talles,id'
        ]);
        
        $talleId = $request->input('talle_id');
        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);
        
        $item = $cart->items()
                     ->where('producto_id', $productoId)
                     ->where('talle_id', $talleId)
                     ->first();
                     
        if ($item) {
            $item->cantidad += $request->input('cantidad', 1);
            $item->save();
        } else {
            $cart->items()->create([
                'producto_id' => $productoId,
                'talle_id' => $talleId,
                'cantidad' => $request->input('cantidad', 1),
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
        $cart = Cart::where('user_id', Auth::id())->firstOrFail();
        $item = $cart->items()->findOrFail($itemId);
        
        $item->cantidad = $request->input('cantidad', 1);
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
