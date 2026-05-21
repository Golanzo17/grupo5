@extends('layouts.app')

@section('content')
<div class="auth-page">
    <div class="auth-card">
        <div class="auth-header">
            <a href="/" class="auth-logo">WESTSIDE</a>
            <h2>Crear Cuenta</h2>
            <p>Unite a la comunidad WESTSIDE</p>
        </div>

        <form method="POST" action="{{ route('registro.post') }}" class="auth-form">
            @csrf

            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input
                    type="text"
                    id="nombre"
                    name="nombre"
                    value="{{ old('nombre') }}"
                    required
                    autofocus
                    placeholder="Tu nombre"
                    class="form-input @error('nombre') form-input-error @enderror"
                >
                @error('nombre')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    placeholder="tu@email.com"
                    class="form-input @error('email') form-input-error @enderror"
                >
                @error('email')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Contraseña</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    required
                    placeholder="Mínimo 8 caracteres"
                    class="form-input @error('password') form-input-error @enderror"
                >
                @error('password')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirmar Contraseña</label>
                <input
                    type="password"
                    id="password_confirmation"
                    name="password_confirmation"
                    required
                    placeholder="Repetí tu contraseña"
                    class="form-input"
                >
            </div>

            <button type="submit" class="btn-primary btn-block">Crear Cuenta</button>
        </form>

        <div class="auth-footer">
            <p>¿Ya tenés cuenta? <a href="{{ route('login') }}">Iniciá Sesión</a></p>
        </div>
    </div>
</div>
@endsection
