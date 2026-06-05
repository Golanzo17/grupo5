@extends('layouts.app')

@section('title', '¡Compra Exitosa!')

@section('content')
<div style="max-width: 600px; margin: 60px auto; text-align: center; padding: 40px; background: var(--bg-card); border-radius: var(--radius-lg); border: 1px solid var(--border-color);">
    <div style="color: var(--accent-color); margin-bottom: 20px;">
        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><path d="m9 11 3 3L22 4"/></svg>
    </div>
    
    <h1 style="font-size: 2rem; margin-bottom: 10px;">¡Gracias por tu compra!</h1>
    <p style="color: var(--text-muted); font-size: 1.1rem; margin-bottom: 30px;">
        Tu pedido ha sido registrado con éxito.<br>
        Número de Orden: <strong>#{{ str_pad($order->id, 5, '0', STR_PAD_LEFT) }}</strong>
    </p>

    <div style="background: var(--bg-dark); padding: 20px; border-radius: var(--radius-sm); border: 1px solid var(--border-color); text-align: left; margin-bottom: 30px;">
        <h3 style="font-size: 1.2rem; margin-bottom: 15px; border-bottom: 1px solid var(--border-color); padding-bottom: 10px;">Detalles</h3>
        
        <p style="margin-bottom: 8px;"><strong>Nombre:</strong> {{ $order->nombre }} {{ $order->apellido }}</p>
        <p style="margin-bottom: 8px;"><strong>Método de Pago:</strong> {{ ucfirst($order->metodo_pago) }}</p>
        <p style="margin-bottom: 8px;">
            <strong>Entrega:</strong> 
            @if($order->tipo_entrega === 'local')
                Retiro por el local (Hipólito Yrigoyen 2418, Corrientes)
            @else
                Envío a {{ $order->direccion }}, {{ $order->ciudad }} (CP: {{ $order->codigo_postal }})
            @endif
        </p>
        <p style="margin-bottom: 8px; font-size: 1.2rem; margin-top: 15px;"><strong>Total a Pagar:</strong> ${{ number_format($order->total, 0, ',', '.') }}</p>
    </div>

    @if($order->metodo_pago === 'transferencia')
        <div style="background: rgba(34, 197, 94, 0.1); border-left: 4px solid #22c55e; padding: 15px; text-align: left; margin-bottom: 30px; border-radius: var(--radius-sm);">
            <h4 style="color: #22c55e; margin-bottom: 10px;">Siguiente Paso: Transferencia</h4>
            <p style="font-size: 0.95rem;">Por favor, realiza la transferencia a la siguiente cuenta:</p>
            {{-- ⚠️ IMPORTANTE: Reemplazar con el CBU real de Westside antes de producción --}}
            <p style="font-family: monospace; font-size: 1.1rem; margin: 10px 0;">CBU: <strong>0000000000000000000000</strong></p>
            <p style="font-size: 0.95rem;">Alias: <strong>WESTSIDE.CORRIENTES</strong></p>
            <p style="font-size: 0.95rem; margin-top: 10px; color: var(--text-muted);">Envianos el comprobante por WhatsApp con tu número de orden.</p>
        </div>
    @endif

    <div style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap;">
        <a href="{{ route('orden.comprobante', $order->id) }}" target="_blank" class="product-overlay-btn" style="text-decoration: none; padding: 12px 25px; border: 1px solid var(--border-color); color: var(--text-main); background: var(--bg-card); display: inline-flex; align-items: center; gap: 8px;">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect width="12" height="8" x="6" y="14"/></svg>
            Imprimir Comprobante
        </a>
        <a href="{{ route('home') }}" class="product-overlay-btn" style="text-decoration: none; padding: 12px 25px; border: 1px solid var(--border-color); color: var(--text-main); background: var(--bg-dark);">Volver al Inicio</a>
        
        @php
            $wspText = "Hola! Acabo de realizar un pedido.%0A";
            $wspText .= "Orden: #" . str_pad($order->id, 5, '0', STR_PAD_LEFT) . "%0A";
            $wspText .= "Total: $" . number_format($order->total, 0, ',', '.');
        @endphp
        <a href="https://wa.me/5493795193973?text={{ $wspText }}" target="_blank" class="btn-primary" style="text-decoration: none; padding: 12px 25px; display: inline-flex; align-items: center; gap: 10px;">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
            Avisar por WhatsApp
        </a>
    </div>
</div>
@endsection
