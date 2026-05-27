@extends('layouts.app')

@section('title', 'Mis Compras')

@section('content')
<div class="cliente-page" style="min-height: calc(100vh - 80px); padding-bottom: 50px;">
    <div class="cliente-container" style="max-width: 900px;">
        
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
            <h1 style="font-size: 2rem; margin: 0;">Mis Compras</h1>
            <a href="{{ route('cliente.dashboard') }}" class="btn-sm" style="text-decoration: none; border: 1px solid var(--border-color); color: var(--text-main); background: var(--bg-dark); padding: 8px 15px; border-radius: 4px;">Volver al panel</a>
        </div>

        @if($ordenes->isEmpty())
            <div style="background: var(--bg-card); border-radius: var(--radius-md); border: 1px solid var(--border-color); padding: 40px; text-align: center;">
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="color: var(--text-muted); margin-bottom: 15px;"><path d="m2 7 4.41-4.41A2 2 0 0 1 7.83 2h8.34a2 2 0 0 1 1.42.59L22 7"/><path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8"/><path d="M15 22v-4a2 2 0 0 0-2-2h-2a2 2 0 0 0-2 2v4"/><path d="M2 7h20"/><path d="M22 7v3a2 2 0 0 1-2 2v0a2.7 2.7 0 0 1-1.59-.63.7.7 0 0 0-.82 0A2.7 2.7 0 0 1 16 12a2.7 2.7 0 0 1-1.59-.63.7.7 0 0 0-.82 0A2.7 2.7 0 0 1 12 12a2.7 2.7 0 0 1-1.59-.63.7.7 0 0 0-.82 0A2.7 2.7 0 0 1 8 12a2.7 2.7 0 0 1-1.59-.63.7.7 0 0 0-.82 0A2.7 2.7 0 0 1 4 12v0a2 2 0 0 1-2-2V7"/></svg>
                <h3 style="margin-bottom: 10px;">Aún no tienes compras</h3>
                <p style="color: var(--text-muted); margin-bottom: 20px;">Cuando realices un pedido, aparecerá aquí.</p>
                <a href="{{ route('catalogo.index') }}" class="btn-primary" style="text-decoration: none;">Ir al catálogo</a>
            </div>
        @else
            <div style="display: flex; flex-direction: column; gap: 20px;">
                @foreach($ordenes as $orden)
                    <div style="background: var(--bg-card); border-radius: var(--radius-md); border: 1px solid var(--border-color); overflow: hidden;">
                        
                        {{-- Header Orden --}}
                        <div style="background: var(--bg-dark); padding: 15px 20px; border-bottom: 1px solid var(--border-color); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;">
                            <div style="display: flex; gap: 20px;">
                                <div>
                                    <div style="font-size: 0.85rem; color: var(--text-muted);">Nº DE ORDEN</div>
                                    <div style="font-weight: 600;">#{{ str_pad($orden->id, 5, '0', STR_PAD_LEFT) }}</div>
                                </div>
                                <div>
                                    <div style="font-size: 0.85rem; color: var(--text-muted);">FECHA</div>
                                    <div style="font-weight: 600;">{{ $orden->created_at->format('d M Y') }}</div>
                                </div>
                                <div>
                                    <div style="font-size: 0.85rem; color: var(--text-muted);">TOTAL</div>
                                    <div style="font-weight: 600;">${{ number_format($orden->total, 0, ',', '.') }}</div>
                                </div>
                            </div>
                            <div style="display: flex; gap: 10px; align-items: center;">
                                <a href="{{ route('orden.comprobante', $orden->id) }}" target="_blank" style="text-decoration: none; font-size: 0.85rem; background: var(--bg-main); border: 1px solid var(--border-color); color: var(--text-main); padding: 4px 10px; border-radius: 4px; display: flex; align-items: center; gap: 5px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect width="12" height="8" x="6" y="14"/></svg>
                                    Imprimir
                                </a>
                                @if($orden->estado === 'pendiente')
                                    <span style="background: rgba(234, 179, 8, 0.2); color: #eab308; border: 1px solid rgba(234, 179, 8, 0.3); padding: 4px 10px; border-radius: 20px; font-size: 0.85rem; font-weight: 600;">Pendiente</span>
                                @elseif($orden->estado === 'completado')
                                    <span style="background: rgba(34, 197, 94, 0.2); color: #22c55e; border: 1px solid rgba(34, 197, 94, 0.3); padding: 4px 10px; border-radius: 20px; font-size: 0.85rem; font-weight: 600;">Completado</span>
                                @else
                                    <span style="background: rgba(239, 68, 68, 0.2); color: #ef4444; border: 1px solid rgba(239, 68, 68, 0.3); padding: 4px 10px; border-radius: 20px; font-size: 0.85rem; font-weight: 600;">Cancelado</span>
                                @endif
                            </div>
                        </div>

                        {{-- Body Orden --}}
                        <div style="padding: 20px;">
                            <h4 style="margin-bottom: 15px; font-size: 1rem;">Artículos comprados:</h4>
                            
                            <div style="display: flex; flex-direction: column; gap: 15px;">
                                @foreach($orden->items as $item)
                                    <div style="display: flex; gap: 15px; align-items: center;">
                                        @if($item->producto)
                                            <img src="{{ Str::startsWith($item->producto->imagen_ruta, ['http', '/', 'images/']) ? asset($item->producto->imagen_ruta) : asset('storage/' . $item->producto->imagen_ruta) }}" style="width: 60px; height: 60px; object-fit: cover; border-radius: 6px; border: 1px solid var(--border-color);">
                                            <div style="flex: 1;">
                                                <div style="font-weight: 500;">{{ $item->producto->nombre }}</div>
                                                <div style="font-size: 0.85rem; color: var(--text-muted); margin-top: 3px;">
                                                    Cant: {{ $item->cantidad }} 
                                                    @if($item->talle) | Talle: {{ $item->talle->nombre }} @endif
                                                </div>
                                            </div>
                                            <div style="font-weight: 500;">${{ number_format($item->precio_unitario * $item->cantidad, 0, ',', '.') }}</div>
                                        @else
                                            <div style="width: 60px; height: 60px; background: var(--bg-dark); border-radius: 6px; display: flex; align-items: center; justify-content: center; color: var(--text-muted);">?</div>
                                            <div style="flex: 1; color: var(--text-muted);">
                                                Producto Eliminado (ID: {{ $item->producto_id }})
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                            
                            <div style="margin-top: 20px; padding-top: 15px; border-top: 1px solid var(--border-color); display: flex; gap: 30px; font-size: 0.9rem;">
                                <div>
                                    <strong style="color: var(--text-muted); display: block; margin-bottom: 5px;">Método de Pago</strong>
                                    {{ ucfirst($orden->metodo_pago) }}
                                </div>
                                <div>
                                    <strong style="color: var(--text-muted); display: block; margin-bottom: 5px;">Entrega</strong>
                                    @if($orden->tipo_entrega === 'local')
                                        Retiro en Local
                                    @else
                                        Envío a {{ $orden->direccion }}, {{ $orden->ciudad }} (CP: {{ $orden->codigo_postal }})
                                    @endif
                                </div>
                            </div>

                        </div>
                        
                    </div>
                @endforeach
            </div>
        @endif
        
    </div>
</div>
@endsection
