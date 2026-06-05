@php
    $items = (isset($cart) && $cart) ? $cart->items : (Auth::user()->cart ? Auth::user()->cart->items : collect());
    $total = 0;
@endphp

@if($items->count() > 0)
    <div style="max-height: 300px; overflow-y: auto; padding-right: 5px; margin-bottom: 10px;">
        @foreach($items as $item)
            @php 
                $subtotal = ($item->producto->precio ?? 0) * $item->cantidad;
                $total += $subtotal;
            @endphp
            <div style="display: flex; gap: 10px; align-items: center; border-bottom: 1px solid var(--border-color); padding: 10px 0;">
                @if($item->producto)
                    <img src="{{ $item->producto->imagen_url }}" style="width: 40px; height: 40px; object-fit: cover; border-radius: 4px;">
                    <div style="flex: 1; min-width: 0;">
                        <h5 style="margin: 0; font-size: 0.85rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; font-family: var(--font-base);">{{ $item->producto->nombre }}</h5>
                        <p style="margin: 0; font-size: 0.75rem; color: var(--text-muted);">{{ $item->cantidad }} x ${{ number_format($item->producto->precio, 0, ',', '.') }}</p>
                    </div>
                    <div style="font-weight: bold; font-size: 0.85rem; display: flex; flex-direction: column; align-items: flex-end; gap: 5px;">
                        ${{ number_format($subtotal, 0, ',', '.') }}
                        <form action="{{ route('carrito.remove', $item->id) }}" method="POST" class="remove-from-cart-form" style="margin: 0;">
                            @csrf
                            <button type="submit" style="background: none; border: none; color: #ff4d4d; cursor: pointer; padding: 2px;" title="Eliminar producto">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/></svg>
                            </button>
                        </form>
                    </div>
                @else
                    <div style="flex: 1;">Producto eliminado</div>
                @endif
            </div>
        @endforeach
    </div>
    
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; font-weight: bold; font-size: 1rem;">
        <span>Total:</span>
        <span style="color: var(--accent-color);">${{ number_format($total, 0, ',', '.') }}</span>
    </div>

    <a href="{{ route('carrito.index') }}" class="btn-primary" style="display: block; text-align: center; width: 100%; text-decoration: none; padding: 8px;">Ir al carrito</a>
@else
    <div style="text-align: center; padding: 20px 10px; color: var(--text-muted);">
        <p style="margin-bottom: 15px; font-size: 0.9rem;">Tu carrito está vacío</p>
        <a href="{{ route('catalogo.index') }}" class="btn-ghost" style="display: inline-block; width: 100%; text-decoration: none; padding: 8px; font-size: 0.85rem;">Ver catálogo</a>
    </div>
@endif
