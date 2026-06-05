@extends('layouts.app')

@section('title', 'Página no encontrada')

@section('content')
<section style="min-height: 70vh; display: flex; align-items: center; justify-content: center;">
    <div style="text-align: center; max-width: 500px; padding: 40px 20px;">
        {{-- Icono animado --}}
        <div style="margin-bottom: 30px; opacity: 0.6;">
            <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="var(--accent-color)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="animation: float 3s ease-in-out infinite;">
                <circle cx="12" cy="12" r="10"/>
                <path d="M16 16s-1.5-2-4-2-4 2-4 2"/>
                <line x1="9" y1="9" x2="9.01" y2="9"/>
                <line x1="15" y1="9" x2="15.01" y2="9"/>
            </svg>
        </div>

        <h1 style="font-family: var(--font-impact); font-size: 5rem; line-height: 1; margin-bottom: 10px; letter-spacing: 3px;">404</h1>
        <h2 style="font-size: 1.4rem; font-weight: 600; margin-bottom: 15px; color: var(--text-main);">Página no encontrada</h2>
        <p style="color: var(--text-muted); font-size: 1rem; margin-bottom: 35px; line-height: 1.6;">
            Lo que buscás no existe o fue movido.<br>
            Pero tranqui, podés volver al inicio o explorar nuestro catálogo.
        </p>

        <div style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap;">
            <a href="{{ route('home') }}" class="btn-primary" style="text-decoration: none; padding: 12px 30px;">
                Volver al Inicio
            </a>
            <a href="{{ route('catalogo.index') }}" class="btn-ghost" style="text-decoration: none; padding: 12px 30px;">
                Ver Catálogo
            </a>
        </div>
    </div>
</section>

<style>
    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }
</style>
@endsection
