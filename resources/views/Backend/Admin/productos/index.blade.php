@extends('layouts.admin')

@section('title', 'Productos')

@section('content')
    <div class="admin-section-header">
        <h2 class="admin-section-title">Listado de Productos</h2>
        <a href="{{ route('admin.productos.create') }}" class="btn-primary">+ Nuevo Producto</a>
    </div>

    <div class="admin-table-wrapper">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Categoría</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($productos as $producto)
                    <tr>
                        <td>
                            <img src="{{ Str::startsWith($producto->imagen_ruta, ['http', '/', 'images/']) ? asset($producto->imagen_ruta) : asset('storage/' . $producto->imagen_ruta) }}" alt="{{ $producto->nombre }}" class="table-img">
                        </td>
                        <td>
                            <strong>{{ $producto->nombre }}</strong>
                            @if($producto->es_nuevo)
                                <span class="badge badge-new">NUEVO</span>
                            @endif
                        </td>
                        <td>{{ $producto->categoria->nombre ?? '—' }}</td>
                        <td>${{ number_format($producto->precio, 2, ',', '.') }}</td>
                        <td>{{ $producto->stock_total ?? 0 }}</td>
                        <td>
                            <span class="badge {{ $producto->activo ? 'badge-active' : 'badge-inactive' }}">
                                {{ $producto->activo ? 'Activo' : 'Inactivo' }}
                            </span>
                        </td>
                        <td>
                            <div class="table-actions">
                                <a href="{{ route('admin.productos.edit', $producto) }}" class="btn-sm btn-edit">Editar</a>
                                <form method="POST" action="{{ route('admin.productos.destroy', $producto) }}" onsubmit="return confirm('¿Eliminar este producto?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-sm btn-delete">Eliminar</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">No hay productos cargados. <a href="{{ route('admin.productos.create') }}">Creá el primero</a></td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($productos->hasPages())
        <div class="admin-pagination">
            {{ $productos->links() }}
        </div>
    @endif
@endsection
