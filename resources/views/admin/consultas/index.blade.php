@extends('layouts.admin')

@section('title', 'Consultas')

@section('content')

    @if(session('success'))
        <div class="admin-alert admin-alert-success" style="margin-bottom: 20px;">
            ✓ {{ session('success') }}
        </div>
    @endif

    <div class="admin-section-header" style="margin-bottom: 28px;">
        <div>
            <h2 class="admin-section-title">Todas las Consultas</h2>
            <p style="color: var(--text-muted); margin-top: 4px;">Total: <strong>{{ $consultas->total() }}</strong> consultas</p>
        </div>
    </div>

    @if($consultas->count() > 0)
        <div class="admin-section">
            <div class="admin-table-wrapper">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th style="width: 120px;">Estado</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Mensaje</th>
                            <th style="width: 140px;">Fecha</th>
                            <th style="width: 200px;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($consultas as $consulta)
                            <tr style="@if(!$consulta->leida) background: rgba(255,255,255,0.06); @endif">
                                <td>
                                    @if($consulta->leida)
                                        <span class="badge badge-active">✓ Leída</span>
                                    @else
                                        <span class="badge" style="background: rgba(241, 196, 15, 0.15); color: #f1c40f; border: 1px solid rgba(241, 196, 15, 0.3);">
                                            ● Nueva
                                        </span>
                                    @endif
                                </td>
                                <td style="font-weight: 600;">{{ $consulta->nombre }}</td>
                                <td>
                                    <a href="mailto:{{ $consulta->email }}" style="color: #3498db; text-decoration: none;">
                                        {{ $consulta->email }}
                                    </a>
                                </td>
                                <td style="max-width: 250px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                    {{ strlen($consulta->mensaje) > 50 ? substr($consulta->mensaje, 0, 50) . '...' : $consulta->mensaje }}
                                </td>
                                <td style="font-size: 0.85rem; color: var(--text-muted);">
                                    {{ $consulta->created_at->format('d/m/Y H:i') }}
                                </td>
                                <td>
                                    <div class="table-actions">
                                        <button type="button" class="btn-sm btn-ver-detalle"
                                            style="background: rgba(52, 152, 219, 0.15); color: #3498db; border: 1px solid rgba(52, 152, 219, 0.3);"
                                            data-id="{{ $consulta->id }}"
                                            data-nombre="{{ e($consulta->nombre) }}"
                                            data-email="{{ e($consulta->email) }}"
                                            data-mensaje="{{ e($consulta->mensaje) }}">
                                            Ver
                                        </button>
                                        
                                        @if(!$consulta->leida)
                                            <form action="{{ route('admin.consultas.leida', $consulta) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn-sm" style="background: rgba(46, 204, 113, 0.15); color: #2ecc71; border: 1px solid rgba(46, 204, 113, 0.3);" title="Marcar como leída">
                                                    Marcar leída
                                                </button>
                                            </form>
                                        @endif
                                        
                                        <form action="{{ route('admin.consultas.destroy', $consulta) }}" method="POST" style="display: inline;" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta consulta?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-delete">
                                                Eliminar
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
            <div class="admin-pagination" style="margin-top: 20px;">
                {{ $consultas->links() }}
            </div>
        </div>
    @else
        <div class="admin-section" style="text-align: center; padding: 60px 40px;">
            <svg style="width: 60px; height: 60px; color: var(--text-muted); margin: 0 auto 16px; display: block; opacity: 0.5;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
            </svg>
            <h3 style="font-size: 1.1rem; font-weight: 700; color: var(--text-main); margin-bottom: 8px;">No hay consultas</h3>
            <p style="color: var(--text-muted);">Aún no has recibido ninguna consulta de los clientes.</p>
        </div>
    @endif

@endsection

<!-- Modal para ver detalles -->
<div id="detallesModal" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.7); z-index: 2000; align-items: center; justify-content: center; padding: 20px;">
    <div style="background: var(--bg-card); border: 1px solid var(--border-color); border-radius: var(--radius-md); max-width: 600px; width: 100%; padding: 32px; max-height: 80vh; overflow-y: auto;">
        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 20px;">
            <div>
                <h2 id="modalNombre" style="font-size: 1.4rem; font-weight: 700; color: var(--text-main); margin: 0 0 8px;"></h2>
                <p id="modalEmail" style="color: #3498db; margin: 0; font-size: 0.9rem;"></p>
            </div>
            <button type="button" onclick="cerrarDetalles()" style="background: none; border: none; color: var(--text-muted); font-size: 1.4rem; cursor: pointer; line-height: 1;">×</button>
        </div>
        
        <div style="background: rgba(255,255,255,0.04); border: 1px solid var(--border-color); border-radius: var(--radius-sm); padding: 20px; margin-bottom: 24px;">
            <p id="modalMensaje" style="color: var(--text-main); margin: 0; line-height: 1.6; white-space: pre-wrap; word-break: break-word;"></p>
        </div>

        <div style="display: flex; justify-content: flex-end; gap: 12px;">
            <button type="button" onclick="cerrarDetalles()" class="btn-sm" style="background: rgba(255,255,255,0.08); border: 1px solid var(--border-color); color: var(--text-muted);">
                Cerrar
            </button>
        </div>
    </div>
</div>

<script>
    // Delegated event listener para botones "Ver" (usa data-* attributes, seguro contra XSS)
    document.querySelectorAll('.btn-ver-detalle').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            const nombre = this.dataset.nombre;
            const email = this.dataset.email;
            const mensaje = this.dataset.mensaje;

            document.getElementById('modalNombre').textContent = nombre;
            document.getElementById('modalEmail').textContent = email;
            document.getElementById('modalMensaje').textContent = mensaje;
            document.getElementById('detallesModal').style.display = 'flex';

            // Marcar como leída automáticamente
            fetch('{{ route("admin.consultas.leida", ":id") }}'.replace(':id', id), {
                method: 'PATCH',
                headers: {
                    'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json'
                }
            }).catch(error => console.error('Error:', error));
        });
    });

    function cerrarDetalles() {
        document.getElementById('detallesModal').style.display = 'none';
    }

    // Cerrar modal al hacer clic fuera
    document.getElementById('detallesModal').addEventListener('click', function(e) {
        if (e.target === this) {
            cerrarDetalles();
        }
    });

    // Cerrar modal con tecla ESC
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && document.getElementById('detallesModal').style.display === 'flex') {
            cerrarDetalles();
        }
    });
</script>
