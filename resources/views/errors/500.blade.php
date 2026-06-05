@extends('layouts.app')

@section('title', 'Error del servidor')

@section('content')
<section style="min-height: 70vh; display: flex; align-items: center; justify-content: center;">
    <div style="text-align: center; max-width: 500px; padding: 40px 20px;">
        <div style="margin-bottom: 30px; opacity: 0.6;">
            <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="var(--error-color, #ef4444)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/>
                <line x1="12" y1="9" x2="12" y2="13"/>
                <line x1="12" y1="17" x2="12.01" y2="17"/>
            </svg>
        </div>

        <h1 style="font-family: var(--font-impact); font-size: 5rem; line-height: 1; margin-bottom: 10px; letter-spacing: 3px;">500</h1>
        <h2 style="font-size: 1.4rem; font-weight: 600; margin-bottom: 15px; color: var(--text-main);">Algo salió mal</h2>
        <p style="color: var(--text-muted); font-size: 1rem; margin-bottom: 35px; line-height: 1.6;">
            Estamos trabajando para solucionarlo.<br>
            Por favor, intentá de nuevo en unos minutos.
        </p>

        <a href="{{ route('home') }}" class="btn-primary" style="text-decoration: none; padding: 12px 30px;">
            Volver al Inicio
        </a>
    </div>
</section>
@endsection
