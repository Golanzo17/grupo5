@extends('layouts.admin')

@section('title', 'Categorías')

@section('content')
    <div class="admin-section-header">
        <h2 class="admin-section-title">Listado de Categorías</h2>
        <a href="{{ route('admin.categorias.create') }}" class="btn-primary">+ Nueva Categoría</a>
    </div>

    <div class="admin-table-wrapper">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Slug</th>
                    <th>Productos</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categorias as $categoria)
                    <tr>
                        <td>{{ $categoria->id }}</td>
                        <td><strong>{{ $categoria->nombre }}</strong></td>
                        <td><code>{{ $categoria->slug }}</code></td>
                        <td>{{ $categoria->productos_count }}</td>
                        <td>
                            <div class="table-actions">
                                <a href="{{ route('admin.categorias.edit', $categoria) }}" class="btn-sm btn-edit">Editar</a>
                                <form method="POST" action="{{ route('admin.categorias.destroy', $categoria) }}" onsubmit="return confirm('¿Eliminar esta categoría?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-sm btn-delete">Eliminar</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No hay categorías. <a href="{{ route('admin.categorias.create') }}">Creá la primera</a></td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
