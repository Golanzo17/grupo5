@extends('layouts.app')

@section('content')
    <section id="principal" class="hero-section">
        <div class="hero-overlay"></div>
        <img src="/images/baners/banner2.png" alt="Westside Hero" class="hero-bg">
        <div class="hero-content gs-reveal">
            <h1 class="title-impact">WESTSIDE</h1>
            <p>Streetwear &amp; Premium Barber</p>
            <div style="display:flex; gap:16px; justify-content:center; flex-wrap:wrap;">
                <a href="#catalogo" class="btn-primary btn-large">Ver Colección</a>
                <a href="/turnos" class="btn-ghost btn-large">Sacar Turno</a>
            </div>
        </div>
        <!-- Scroll indicator animado -->
        <div class="hero-scroll-indicator" onclick="document.getElementById('quienes-somos').scrollIntoView({behavior:'smooth'})">
            <div class="scroll-line"></div>
            <span>Scroll</span>
        </div>
    </section>

    <!-- SEPARADOR -->
    <div class="section-sep">
        <div class="section-sep-line"></div>
        <span class="section-sep-dot">• • •</span>
        <div class="section-sep-line"></div>
    </div>

    <!-- 2. Quienes Somos -->
    <section id="quienes-somos" class="about-section">
        <div class="container dual-grid">
            <div class="text-content gs-slide-left">
                <span class="section-badge">Nuestra historia</span>
                <h2>Cultura &amp; Estilo</h2>
                <p>En WESTSIDE combinamos streetwear + barbería 
para darte un cambio real.

Te ves mejor. Te sentís distinto.</p>
                <div class="image-box">
                    <img src="/images/barberia/Barber-logo-2.png" alt="logo Barbería Westside">
                </div>
            </div>
            <div class="image-content gs-slide-right">
                <img src="/images/barberia/Barber1.jpeg" alt="Westside Barbería" class="img-fluid">
            </div>
        </div>
    </section>

    @include('partes.stats')

    <!-- SEPARADOR -->
    <div class="section-sep">
        <div class="section-sep-line"></div>
        <span class="section-sep-dot">• • •</span>
        <div class="section-sep-line"></div>
    </div>

    <!-- 6. Catálogo de Productos -->
    <section id="catalogo" class="catalog-section">
        <div class="container text-center">
            <h2 class="gs-fade-up">Catálogo Visual</h2>
            
            <div class="carousel-wrapper">
                <button class="carousel-btn prev" onclick="document.getElementById('product-carousel').scrollBy({left: -330, behavior: 'smooth'})">❮</button>
                
                <div class="carousel-container" id="product-carousel">
                    <!-- PRODUCTOS DINÁMICOS DESDE BD -->
                    @php
                        $wspIcon = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="16"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12 0C5.373 0 0 5.373 0 12c0 2.127.555 4.124 1.528 5.855L0 24l6.335-1.51A11.945 11.945 0 0 0 12 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.818a9.818 9.818 0 0 1-5.007-1.37l-.36-.214-3.727.977.994-3.634-.234-.373A9.77 9.77 0 0 1 2.182 12C2.182 6.57 6.57 2.182 12 2.182S21.818 6.57 21.818 12 17.43 21.818 12 21.818z"/></svg>';
                    @endphp
                    @foreach($productos as $producto)
                        <div class="product-card gs-fade-up" data-category="{{ $producto->categoria ? $producto->categoria->slug : '' }}">
                            @if($producto->categoria)
                                <span class="product-cat-tag">{{ $producto->categoria->nombre }}</span>
                            @endif
                            @if($producto->es_nuevo)
                                <span class="product-new-tag">Nuevo</span>
                            @endif
                            
                            <img src="{{ $producto->imagen_url }}" alt="{{ $producto->nombre }}" loading="lazy">
                            
                            <div class="product-overlay">
                                <a href="https://wa.me/5493795193973?text=Hola,%20me%20interesa%20el%20producto:%20{{ urlencode($producto->nombre) }}" class="product-overlay-btn wsp-link" target="_blank">{!! $wspIcon !!} Consultar</a>
                            </div>
                            <div class="product-info">
                                <h4>{{ $producto->nombre }}</h4>
                                <p class="product-price">${{ number_format($producto->precio, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <button class="carousel-btn next" onclick="document.getElementById('product-carousel').scrollBy({left: 330, behavior: 'smooth'})">❯</button>
            </div>

            <!-- Botón hacia el catálogo completo -->
            <div class="btn-catalog-action gs-fade-up">
                <a href="/catalogo" class="btn-primary">VER CATÁLOGO COMPLETO</a>
            </div>
        </div>
    </section>

    <!-- 3. Comercialización -->
    <section id="comercializacion" class="comercial-section">
        <div class="container text-center">
            <span class="section-badge">Cómo funciona</span>
            <h2 class="gs-fade-up" style="margin-top:8px;">Cómo Trabajamos</h2>
            <div class="steps-grid" style="margin-top: 50px; text-align:left;">

                <div class="step-card gs-fade-up">
                    <div class="step-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                    </div>
                    <h3>Venta Minorista</h3>
                    <p>Adquirí nuestras prendas exclusivas directamente desde nuestra sucursal o con envío a todo el país.</p>
                </div>

                <div class="step-card gs-fade-up">
                    <div class="step-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
                    </div>
                    <h3>Barbería Premium</h3>
                    <p>Turnos presenciales con profesionales de primer nivel. Experiencia premium asegurada en cada visita.</p>
                </div>

            </div>
        </div>
    </section>

    @include('partes.ig-cards')


    

@endsection
