@extends('layouts.admin')

@section('title', 'Editar Usuario')

@section('content')
    <div class="admin-section">
        <h2 class="admin-section-title">Editar: {{ $usuario->nombre }}</h2>

        <form method="POST" action="{{ route('admin.usuarios.update', $usuario) }}" class="admin-form">
            @csrf
            @method('PUT')

            <div class="form-grid">
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $usuario->nombre) }}" required
                           class="form-input @error('nombre') form-input-error @enderror">
                    @error('nombre')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $usuario->email) }}" required
                           class="form-input @error('email') form-input-error @enderror">
                    @error('email')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="rol_id">Rol</label>
                    <select id="rol_id" name="rol_id" required class="form-input @error('rol_id') form-input-error @enderror">
                        @foreach($roles as $rol)
                            <option value="{{ $rol->id }}" {{ old('rol_id', $usuario->rol_id) == $rol->id ? 'selected' : '' }}>
                                {{ ucfirst($rol->nombre) }}
                            </option>
                        @endforeach
                    </select>
                    @error('rol_id')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="password">Nueva Contraseña <small>(dejar vacío para mantener la actual)</small></label>
                <input type="password" id="password" name="password"
                       class="form-input @error('password') form-input-error @enderror"
                       placeholder="Nueva contraseña (opcional)">
                @error('password')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirmar Contraseña</label>
                <input type="password" id="password_confirmation" name="password_confirmation"
                       class="form-input"
                       placeholder="Confirmar nueva contraseña">
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-primary">Guardar Cambios</button>
                <a href="{{ route('admin.usuarios.index') }}" class="btn-ghost">Cancelar</a>
            </div>
        </form>
    </div>
@endsection
