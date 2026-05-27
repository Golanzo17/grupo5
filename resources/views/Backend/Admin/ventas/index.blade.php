@extends('layouts.admin')

@section('title', 'Historial de Ventas')

@section('content')
    <div class="admin-section-header">
        <h2 class="admin-section-title">Historial de Ventas</h2>
    </div>

    <div class="admin-table-wrapper">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Orden #</th>
                    <th>Fecha</th>
                    <th>Cliente</th>
                    <th>Método de Pago</th>
                    <th>Entrega</th>
                    <th>Total</th>
                    <th>Estado</th>
                    <th>Detalles</th>
                </tr>
            </thead>
            <tbody>
                @forelse($ordenes as $orden)
                    <tr>
                        <td><strong>#{{ str_pad($orden->id, 5, '0', STR_PAD_LEFT) }}</strong></td>
                        <td>{{ $orden->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            {{ $orden->nombre }} {{ $orden->apellido }}
                            <br>
                            <small style="color: var(--text-muted)">{{ $orden->telefono }}</small>
                        </td>
                        <td>{{ ucfirst($orden->metodo_pago) }}</td>
                        <td>
                            @if($orden->tipo_entrega === 'local')
                                <span class="badge badge-inactive">Local</span>
                            @else
                                <span class="badge badge-active">Envío</span>
                            @endif
                        </td>
                        <td><strong>${{ number_format($orden->total, 0, ',', '.') }}</strong></td>
                        <td>
                            <form action="{{ route('admin.ventas.estado', $orden->id) }}" method="POST" style="margin: 0;">
                                @csrf
                                @method('PATCH')
                                <select name="estado" onchange="this.form.submit()" class="form-input" style="padding: 4px; font-size: 0.85rem; border-radius: 4px; border: 1px solid var(--border-color); background: var(--bg-dark); color: var(--text-main); cursor: pointer;">
                                    <option value="pendiente" {{ $orden->estado === 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                    <option value="completado" {{ $orden->estado === 'completado' ? 'selected' : '' }}>Completado</option>
                                    <option value="cancelado" {{ $orden->estado === 'cancelado' ? 'selected' : '' }}>Cancelado</option>
                                </select>
                            </form>
                        </td>
                        <td style="display: flex; gap: 5px; flex-direction: column;">
                            <button type="button" class="btn-sm btn-edit" onclick="toggleDetails({{ $orden->id }})">Ver Ítems</button>
                            <a href="{{ route('orden.comprobante', $orden->id) }}" target="_blank" class="btn-sm" style="background: var(--text-main); color: var(--bg-main); text-align: center; text-decoration: none;">Imprimir</a>
                        </td>
                    </tr>
                    <tr id="details-{{ $orden->id }}" style="display: none; background: var(--bg-dark);">
                        <td colspan="8" style="padding: 15px;">
                            <h4 style="margin-bottom: 10px; font-size: 0.95rem;">Productos Comprados:</h4>
                            <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 8px;">
                                @foreach($orden->items as $item)
                                    <li style="display: flex; gap: 15px; border-bottom: 1px solid var(--border-color); padding-bottom: 8px;">
                                        @if($item->producto)
                                            <img src="{{ Str::startsWith($item->producto->imagen_ruta, ['http', '/', 'images/']) ? asset($item->producto->imagen_ruta) : asset('storage/' . $item->producto->imagen_ruta) }}" style="width: 40px; height: 40px; object-fit: cover; border-radius: 4px;">
                                            <div>
                                                <strong>{{ $item->cantidad }}x</strong> {{ $item->producto->nombre }}
                                                @if($item->talle) <span style="color: var(--text-muted);">(Talle: {{ $item->talle->nombre }})</span> @endif
                                                - ${{ number_format($item->precio_unitario * $item->cantidad, 0, ',', '.') }}
                                            </div>
                                        @else
                                            <span>Producto Eliminado (ID: {{ $item->producto_id }})</span>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                            @if($orden->tipo_entrega === 'envio')
                                <div style="margin-top: 15px; font-size: 0.9rem; color: var(--text-muted);">
                                    <strong>Dirección de Envío:</strong> {{ $orden->direccion }}, {{ $orden->ciudad }} (CP: {{ $orden->codigo_postal }})
                                </div>
                            @endif
                            @if($orden->notas)
                                <div style="margin-top: 10px; font-size: 0.9rem; color: var(--text-muted);">
                                    <strong>Notas:</strong> {{ $orden->notas }}
                                </div>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center" style="padding: 30px;">Aún no hay ventas registradas.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($ordenes->hasPages())
        <div class="admin-pagination">
            {{ $ordenes->links() }}
        </div>
    @endif

    <script>
        function toggleDetails(id) {
            const el = document.getElementById('details-' + id);
            if (el.style.display === 'none') {
                el.style.display = 'table-row';
            } else {
                el.style.display = 'none';
            }
        }
    </script>
@endsection
