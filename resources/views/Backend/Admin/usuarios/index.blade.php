@extends('layouts.admin')

@section('title', 'Usuarios')

@section('content')
    <div class="admin-section-header">
        <h2 class="admin-section-title">Gestión de Usuarios</h2>
    </div>

    <div class="admin-table-wrapper">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Registrado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($usuarios as $usuario)
                    <tr>
                        <td>{{ $usuario->id }}</td>
                        <td><strong>{{ $usuario->nombre }}</strong></td>
                        <td>{{ $usuario->email }}</td>
                        <td>
                            <span class="badge badge-{{ $usuario->rol->nombre === 'admin' ? 'admin' : 'cliente' }}">
                                {{ ucfirst($usuario->rol->nombre) }}
                            </span>
                        </td>
                        <td>{{ $usuario->created_at->format('d/m/Y') }}</td>
                        <td>
                            <div class="table-actions">
                                <a href="{{ route('admin.usuarios.edit', $usuario) }}" class="btn-sm btn-edit">Editar</a>
                                @if($usuario->id !== auth()->id())
                                    <form method="POST" action="{{ route('admin.usuarios.destroy', $usuario) }}" onsubmit="return confirm('¿Eliminar este usuario?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-sm btn-delete">Eliminar</button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No hay usuarios registrados.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($usuarios->hasPages())
        <div class="admin-pagination">
            {{ $usuarios->links() }}
        </div>
    @endif
@endsection
