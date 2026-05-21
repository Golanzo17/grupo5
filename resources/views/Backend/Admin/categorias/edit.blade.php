@extends('layouts.admin')

@section('title', 'Editar Categoría')

@section('content')
    <div class="admin-section">
        <h2 class="admin-section-title">Editar: {{ $categoria->nombre }}</h2>

        <form method="POST" action="{{ route('admin.categorias.update', $categoria) }}" class="admin-form">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nombre">Nombre de la Categoría</label>
                <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $categoria->nombre) }}" required
                       class="form-input @error('nombre') form-input-error @enderror">
                @error('nombre')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-primary">Guardar Cambios</button>
                <a href="{{ route('admin.categorias.index') }}" class="btn-ghost">Cancelar</a>
            </div>
        </form>
    </div>
@endsection
