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
                <label for="apellido">Apellido</label>
                <input type="text" id="apellido" name="apellido" value="{{ old('apellido', $usuario->apellido) }}"
                       class="form-input @error('apellido') form-input-error @enderror">
                @error('apellido')
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
                <label for="telefono">Teléfono / WhatsApp</label>
                <input type="text" id="telefono" name="telefono" value="{{ old('telefono', $usuario->telefono) }}"
                       class="form-input @error('telefono') form-input-error @enderror">
                @error('telefono')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            <hr class="form-divider" style="margin: 20px 0;">
            <h4 style="margin-bottom: 15px; color: var(--text-main);">Datos de Envío (Opcional)</h4>

            <div class="form-group">
                <label for="direccion">Dirección</label>
                <input type="text" id="direccion" name="direccion" value="{{ old('direccion', $usuario->direccion) }}"
                       class="form-input @error('direccion') form-input-error @enderror">
                @error('direccion')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 15px;">
                <div class="form-group">
                    <label for="ciudad">Ciudad</label>
                    <input type="text" id="ciudad" name="ciudad" value="{{ old('ciudad', $usuario->ciudad) }}"
                           class="form-input @error('ciudad') form-input-error @enderror">
                    @error('ciudad')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="codigo_postal">Código Postal</label>
                    <input type="text" id="codigo_postal" name="codigo_postal" value="{{ old('codigo_postal', $usuario->codigo_postal) }}"
                           class="form-input @error('codigo_postal') form-input-error @enderror">
                    @error('codigo_postal')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>
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
