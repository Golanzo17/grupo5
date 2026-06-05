@extends('layouts.app')

@section('title', 'Acceso denegado')

@section('content')
<section style="min-height: 70vh; display: flex; align-items: center; justify-content: center;">
    <div style="text-align: center; max-width: 500px; padding: 40px 20px;">
        <div style="margin-bottom: 30px; opacity: 0.6;">
            <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="var(--error-color, #ef4444)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
            </svg>
        </div>

        <h1 style="font-family: var(--font-impact); font-size: 5rem; line-height: 1; margin-bottom: 10px; letter-spacing: 3px;">403</h1>
        <h2 style="font-size: 1.4rem; font-weight: 600; margin-bottom: 15px; color: var(--text-main);">Acceso denegado</h2>
        <p style="color: var(--text-muted); font-size: 1rem; margin-bottom: 35px; line-height: 1.6;">
            No tenés permiso para acceder a esta página.
        </p>

        <a href="{{ route('home') }}" class="btn-primary" style="text-decoration: none; padding: 12px 30px;">
            Volver al Inicio
        </a>
    </div>
</section>
@endsection
