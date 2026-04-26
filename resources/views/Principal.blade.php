<!DOCTYPE html>
<html lang="es-AR">
@include('partes.head')
<body>

    @include('partes.nav')

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

    <!-- STATS -->
    <section class="stats-section">
        <div class="container stats-grid">
            <div class="stat-item">
                <span class="stat-number">+625</span>
                <span class="stat-label">Clientes atendidos</span>
            </div>
            <div class="stat-item">
                <span class="stat-number">2024</span>
                <span class="stat-label">Año de fundación</span>
            </div>
            <div class="stat-item">
                <span class="stat-number">2</span>
                <span class="stat-label">Líneas de negocio</span>
            </div>
            <div class="stat-item">
                <span class="stat-number">∞</span>
                <span class="stat-label">Estilo sin límites</span>
            </div>
        </div>
    </section>

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
                    
                    

                    <!-- PRODUCTOS ESTÁTICOS -->
                    @include('partes.productos_estaticos')

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

    @include('partes.formulario_contacto')

    @include('partes.footer')
    <style>
        /* El overlay y badges son exclusivos del Catálogo — ocultarlos en el carrusel */
        #product-carousel .product-overlay,
        #product-carousel .product-cat-tag,
        #product-carousel .product-new-tag {
            display: none !important;
        }
    </style>

</body>
</html>
