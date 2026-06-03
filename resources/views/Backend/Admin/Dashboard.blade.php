@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <!-- Stats Cards -->
    <div class="admin-stats-grid">
        <a href="{{ route('admin.usuarios.index') }}" class="stat-card" style="text-decoration: none; color: inherit;">
            <div class="stat-icon stat-icon-users">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
            </div>
            <div class="stat-info">
                <span class="stat-number">{{ $totalUsuarios }}</span>
                <span class="stat-label">Usuarios</span>
            </div>
        </a>

        <a href="{{ route('admin.productos.index') }}" class="stat-card" style="text-decoration: none; color: inherit;">
            <div class="stat-icon stat-icon-products">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
            </div>
            <div class="stat-info">
                <span class="stat-number">{{ $totalProductos }}</span>
                <span class="stat-label">Productos</span>
            </div>
        </a>

        <a href="{{ route('admin.categorias.index') }}" class="stat-card" style="text-decoration: none; color: inherit;">
            <div class="stat-icon stat-icon-categories">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 20h16a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2h-7.93a2 2 0 0 1-1.66-.9l-.82-1.2A2 2 0 0 0 7.93 3H4a2 2 0 0 0-2 2v13c0 1.1.9 2 2 2Z"/></svg>
            </div>
            <div class="stat-info">
                <span class="stat-number">{{ $totalCategorias }}</span>
                <span class="stat-label">Categorías</span>
            </div>
        </a>

        <a href="{{ route('admin.consultas.index') }}" class="stat-card" style="text-decoration: none; color: inherit;">
            <div class="stat-icon stat-icon-messages" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
            </div>
            <div class="stat-info">
                <span class="stat-number">{{ $totalConsultas }} <span style="font-size: 0.7em; color: #e74c3c;">{{ $consultasNuevas ? '(+' . $consultasNuevas . ')' : '' }}</span></span>
                <span class="stat-label">Consultas</span>
            </div>
        </a>
    </div>

    <!-- Quick Actions -->
    <div class="admin-section">
        <h2 class="admin-section-title">Acciones Rápidas</h2>
        <div class="admin-actions-grid">
            <a href="{{ route('admin.productos.create') }}" class="action-card">
                <span class="action-icon">+</span>
                <span>Nuevo Producto</span>
            </a>
            <a href="{{ route('admin.categorias.create') }}" class="action-card">
                <span class="action-icon">+</span>
                <span>Nueva Categoría</span>
            </a>
            <a href="{{ route('admin.usuarios.index') }}" class="action-card">
                <span class="action-icon">👥</span>
                <span>Ver Usuarios</span>
            </a>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="admin-grid-2">
        <!-- Últimos Usuarios -->
        <div class="admin-section">
            <h2 class="admin-section-title">Últimos Usuarios</h2>
            <div class="admin-table-wrapper">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Rol</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($ultimosUsuarios as $usuario)
                            <tr>
                                <td>{{ $usuario->nombre }}</td>
                                <td>{{ $usuario->email }}</td>
                                <td>
                                    <span class="badge badge-{{ $usuario->rol->nombre === 'admin' ? 'admin' : 'cliente' }}">
                                        {{ ucfirst($usuario->rol->nombre) }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="3" class="text-center">No hay usuarios registrados.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Últimos Productos -->
        <div class="admin-section">
            <h2 class="admin-section-title">Últimos Productos</h2>
            <div class="admin-table-wrapper">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Categoría</th>
                            <th>Precio</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($ultimosProductos as $producto)
                            <tr>
                                <td>{{ $producto->nombre }}</td>
                                <td>{{ $producto->categoria->nombre ?? '—' }}</td>
                                <td>${{ number_format($producto->precio, 2, ',', '.') }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="3" class="text-center">No hay productos cargados.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Últimas Consultas -->
        <div class="admin-section">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                <h2 class="admin-section-title" style="margin: 0;">Últimas Consultas</h2>
                <a href="{{ route('admin.consultas.index') }}" style="color: #667eea; font-size: 0.9em; text-decoration: none;">Ver todas →</a>
            </div>
            <div class="admin-table-wrapper">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Mensaje</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($ultimasConsultas as $consulta)
                            <tr style="background-color: #f0f4ff;">
                                <td><strong>{{ $consulta->nombre }}</strong></td>
                                <td>{{ $consulta->email }}</td>
                                <td style="max-width: 200px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">{{ $consulta->mensaje }}</td>
                                <td>{{ $consulta->created_at->format('d/m/Y') }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="text-center">No hay consultas sin leer.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
