@extends('layouts.app')

@section('content')
<div class="auth-page">
    <div class="auth-card">
        <div class="auth-header">
            <a href="/" class="auth-logo">WESTSIDE</a>
            <h2>Iniciar Sesión</h2>
            <p>Ingresá a tu cuenta</p>
        </div>

        <form method="POST" action="{{ route('login.post') }}" class="auth-form">
            @csrf

            <div class="form-group">
                <label for="email">Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
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
                    placeholder="Tu contraseña"
                    class="form-input @error('password') form-input-error @enderror"
                >
                @error('password')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn-primary btn-block">Ingresar</button>
        </form>

        <div class="auth-footer">
            <p>¿No tenés cuenta? <a href="{{ route('registro') }}">Registrate</a></p>
        </div>
    </div>
</div>
@endsection
