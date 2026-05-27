@extends('layouts.app')

@section('content')
<div class="cliente-page">
    <div class="cliente-container">
        <div class="cliente-header">
            <h1>¡Hola, {{ $usuario->nombre }}! 👋</h1>
            <p>Bienvenido a tu panel de WESTSIDE</p>
        </div>

        <div class="cliente-cards">
            <a href="{{ route('cliente.perfil') }}" class="cliente-card">
                <div class="cliente-card-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                </div>
                <h3>Mi Perfil</h3>
                <p>Ver y editar tus datos personales</p>
            </a>

            <a href="{{ route('cliente.compras') }}" class="cliente-card">
                <div class="cliente-card-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m2 7 4.41-4.41A2 2 0 0 1 7.83 2h8.34a2 2 0 0 1 1.42.59L22 7"/><path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8"/><path d="M15 22v-4a2 2 0 0 0-2-2h-2a2 2 0 0 0-2 2v4"/><path d="M2 7h20"/><path d="M22 7v3a2 2 0 0 1-2 2v0a2.7 2.7 0 0 1-1.59-.63.7.7 0 0 0-.82 0A2.7 2.7 0 0 1 16 12a2.7 2.7 0 0 1-1.59-.63.7.7 0 0 0-.82 0A2.7 2.7 0 0 1 12 12a2.7 2.7 0 0 1-1.59-.63.7.7 0 0 0-.82 0A2.7 2.7 0 0 1 8 12a2.7 2.7 0 0 1-1.59-.63.7.7 0 0 0-.82 0A2.7 2.7 0 0 1 4 12v0a2 2 0 0 1-2-2V7"/></svg>
                </div>
                <h3>Mis Compras</h3>
                <p>Historial de tus pedidos realizados</p>
            </a>

            <a href="/catalogo" class="cliente-card">
                <div class="cliente-card-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                </div>
                <h3>Catálogo</h3>
                <p>Explorá nuestra colección completa</p>
            </a>

            <a href="/turnos" class="cliente-card">
                <div class="cliente-card-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                </div>
                <h3>Turnos</h3>
                <p>Reservá tu turno en la barbería</p>
            </a>
        </div>

        <div class="cliente-info">
            <h3>Tu Información</h3>
            <div class="info-grid">
                <div class="info-item">
                    <span class="info-label">Nombre</span>
                    <span class="info-value">{{ $usuario->nombre }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Email</span>
                    <span class="info-value">{{ $usuario->email }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Miembro desde</span>
                    <span class="info-value">{{ $usuario->created_at->format('d/m/Y') }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
