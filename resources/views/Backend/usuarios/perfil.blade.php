@extends('layouts.app')

@section('content')
<div class="auth-page">
    <div class="auth-card auth-card-wide">
        <div class="auth-header">
            <h2>Mi Perfil</h2>
            <p>Editá tus datos personales</p>
        </div>

        @if(session('exito'))
            <div class="admin-alert admin-alert-success">
                ✓ {{ session('exito') }}
            </div>
        @endif

        <form method="POST" action="{{ route('cliente.perfil.update') }}" class="auth-form">
            @csrf
            @method('PUT')

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

            <hr class="form-divider">

            <p class="form-hint">Dejá los campos de contraseña vacíos si no querés cambiarla.</p>

            <div class="form-group">
                <label for="password">Nueva Contraseña</label>
                <input type="password" id="password" name="password"
                       class="form-input @error('password') form-input-error @enderror"
                       placeholder="Mínimo 8 caracteres">
                @error('password')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirmar Contraseña</label>
                <input type="password" id="password_confirmation" name="password_confirmation"
                       class="form-input"
                       placeholder="Repetí la nueva contraseña">
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-primary btn-block">Guardar Cambios</button>
            </div>
        </form>

        <div class="auth-footer">
            <a href="{{ route('cliente.dashboard') }}">← Volver al panel</a>
        </div>
    </div>
</div>
@endsection
