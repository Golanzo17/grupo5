@extends('layouts.admin')

@section('title', 'Nueva Categoría')

@section('content')
    <div class="admin-section">
        <h2 class="admin-section-title">Crear Categoría</h2>

        <form method="POST" action="{{ route('admin.categorias.store') }}" class="admin-form">
            @csrf

            <div class="form-group">
                <label for="nombre">Nombre de la Categoría</label>
                <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}" required
                       class="form-input @error('nombre') form-input-error @enderror"
                       placeholder="Ej: Remeras">
                @error('nombre')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-primary">Crear Categoría</button>
                <a href="{{ route('admin.categorias.index') }}" class="btn-ghost">Cancelar</a>
            </div>
        </form>
    </div>
@endsection
