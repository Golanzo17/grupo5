@extends('layouts.app')

@section('title', 'Tu Carrito')

@section('content')
<div class="hero-section" style="height: 30vh; min-height: 250px;">
    <div class="hero-bg" style="background-color: var(--bg-darker);"></div>
    <div class="hero-overlay"></div>
    <div class="hero-content" style="z-index: 10;">
        <h1 class="title-impact" style="font-size: clamp(3rem, 6vw, 5rem);">TU CARRITO</h1>
    </div>
</div>

<div class="container" style="padding-top: 40px; padding-bottom: 80px;">
    @if(session('success'))
        <div style="background: rgba(0, 255, 0, 0.1); color: #4ade80; padding: 15px 20px; border-radius: var(--radius-sm); border: 1px solid rgba(74, 222, 128, 0.2); margin-bottom: 30px;">
            ✓ {{ session('success') }}
        </div>
    @endif

    @if($items->count())
        <div style="display: grid; grid-template-columns: 1fr; gap: 30px;">
            
            <div style="background-color: var(--bg-card); border: 1px solid var(--border-color); border-radius: var(--radius-md); padding: 30px;">
                
                @foreach($items as $item)
                    <div style="display: flex; align-items: center; justify-content: space-between; padding: 20px 0; border-bottom: 1px solid var(--border-color); flex-wrap: wrap; gap: 20px;">
                        
                        <!-- Producto info -->
                        <div style="display: flex; align-items: center; gap: 20px; flex: 1; min-width: 250px;">
                            @if(isset($item->producto))
                                <img src="{{ Str::startsWith($item->producto->imagen_ruta, ['http', '/', 'images/']) ? asset($item->producto->imagen_ruta) : asset('storage/' . $item->producto->imagen_ruta) }}" alt="{{ $item->producto->nombre }}" style="width: 80px; height: 80px; object-fit: cover; border-radius: var(--radius-sm); border: 1px solid var(--border-color);">
                                <div>
                                    <h3 style="font-size: 1.1rem; margin-bottom: 5px;">{{ $item->producto->nombre }}</h3>
                                    <p style="color: var(--text-muted); font-size: 0.9rem;">Precio unitario: ${{ number_format($item->producto->precio, 2, ',', '.') }}</p>
                                </div>
                            @else
                                <div style="width: 80px; height: 80px; background: var(--bg-dark); display: flex; align-items: center; justify-content: center; border-radius: var(--radius-sm); color: var(--text-muted);">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m2 2 20 20"/><path d="M10.41 10.41a2 2 0 1 1-2.83-2.83"/><line x1="10.5" x2="5.5" y1="13.5" y2="8.5"/><path d="M20.5 2h-3"/><path d="M5.27 5.27 2 20.5h15.23"/><line x1="14" x2="14" y1="2" y2="7"/></svg>
                                </div>
                                <div>
                                    <h3 style="font-size: 1.1rem; color: #ef4444;">Producto eliminado</h3>
                                    <p style="color: var(--text-muted); font-size: 0.9rem;">Este producto ya no está disponible.</p>
                                </div>
                            @endif
                        </div>

                        <!-- Acciones -->
                        <div style="display: flex; align-items: center; gap: 30px;">
                            <form action="{{ route('carrito.update', $item->id) }}" method="POST" style="display: flex; align-items: center; gap: 10px;">
                                @csrf
                                <div style="display: flex; align-items: center; border: 1px solid var(--border-color); border-radius: var(--radius-sm); overflow: hidden; background: var(--bg-dark);">
                                    <input type="number" name="cantidad" value="{{ $item->cantidad }}" min="1" style="width: 60px; background: transparent; border: none; color: var(--text-main); text-align: center; padding: 8px 5px; font-family: var(--font-base);">
                                </div>
                                <button type="submit" class="btn-ghost" style="padding: 8px 15px; font-size: 0.8rem;">Actualizar</button>
                            </form>

                            <div style="font-size: 1.2rem; font-weight: bold; min-width: 100px; text-align: right;">
                                ${{ number_format(($item->producto->precio ?? 0) * $item->cantidad, 2, ',', '.') }}
                            </div>

                            <form action="{{ route('carrito.remove', $item->id) }}" method="POST">
                                @csrf
                                <button type="submit" style="background: none; border: none; color: #ef4444; cursor: pointer; display: flex; align-items: center; justify-content: center; padding: 5px; transition: transform 0.2s;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'" title="Eliminar producto">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"/><path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/><path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/><line x1="10" x2="10" y1="11" y2="17"/><line x1="14" x2="14" y1="11" y2="17"/></svg>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach

                <!-- Footer Total -->
                <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 30px; padding-top: 20px;">
                    <a href="{{ route('catalogo.index') }}" class="btn-ghost" style="display: flex; align-items: center; gap: 8px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                        Seguir comprando
                    </a>
                    <div style="text-align: right;">
                        <span style="color: var(--text-muted); font-size: 1.1rem; margin-right: 15px;">Total a pagar:</span>
                        <span style="font-size: 2rem; font-weight: bold; color: var(--accent-color);">${{ number_format($items->sum(fn($i) => ($i->producto->precio ?? 0) * $i->cantidad), 2, ',', '.') }}</span>
                    </div>
                </div>

                <div style="display: flex; justify-content: flex-end; margin-top: 25px;">
                    @php
                        $wspNumber = env('WSP_NUMBER', '5493795193973');
                        $wspText = "Hola! Quiero finalizar mi compra:%0A%0A";
                        $total = 0;
                        foreach($items as $item) {
                            if($item->producto) {
                                $subtotal = $item->producto->precio * $item->cantidad;
                                $total += $subtotal;
                                $wspText .= "- " . $item->cantidad . "x " . $item->producto->nombre . " ($" . number_format($subtotal, 0, ',', '.') . ")%0A";
                            }
                        }
                        $wspText .= "%0ATotal a pagar: $" . number_format($total, 0, ',', '.');
                    @endphp
                    <a href="https://wa.me/{{ $wspNumber }}?text={{ $wspText }}" target="_blank" class="btn-primary btn-large" style="display: flex; align-items: center; gap: 10px; text-decoration: none;">
                        Finalizar Compra
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                    </a>
                </div>

            </div>
        </div>
    @else
        <div style="text-align: center; padding: 100px 20px; background: var(--bg-card); border-radius: var(--radius-md); border: 1px solid var(--border-color);">
            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="var(--text-muted)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="margin-bottom: 20px;"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
            <h2 style="font-size: 2rem; margin-bottom: 15px;">Tu carrito está vacío</h2>
            <p style="color: var(--text-muted); margin-bottom: 30px; font-size: 1.1rem;">¡Parece que todavía no agregaste nada a tu carrito de compras!</p>
            <a href="{{ route('catalogo.index') }}" class="btn-primary btn-large">Ir al catálogo</a>
        </div>
    @endif
</div>
@endsection
