<!DOCTYPE html>
<html lang="es-AR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Westside - Streetwear & Barbería</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;800&family=Impact&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

    <!-- Navegación -->
    <nav class="navbar">
        <div class="nav-container">
            <div class="logo">WESTSIDE</div>
            <ul class="nav-links">
                <li><a href="#principal">Principal</a></li>
                <li><a href="#quienes-somos">Quienes Somos</a></li>
                <li><a href="#comercializacion">Comercialización</a></li>
                <li><a href="#catalogo">Catálogo</a></li>
                <li><a href="#consultas" class="btn-primary">Consultas</a></li>
            </ul>
        </div>
    </nav>

    <!-- 1. Principal -->
    <section id="principal" class="hero-section">
        <div class="hero-overlay"></div>
        <img src="/images/baners/banner2.png" alt="Westside Hero" class="hero-bg">
        <div class="hero-content gs-reveal">
            <h1 class="title-impact">WESTSIDE</h1>
            <p>Streetwear & Premium Barber</p>
            <a href="#catalogo" class="btn-primary btn-large">Ver Colección</a>
        </div>
    </section>

    <!-- 2. Quienes Somos -->
    <section id="quienes-somos" class="about-section">
        <div class="container dual-grid">
            <div class="text-content gs-slide-left">
                <h2>Cultura & Estilo</h2>
                <p>Nacidos en la calle, elevados por el detalle. Westside no es solo una marca de ropa ni solo una barbería. Somos el punto de encuentro donde nacen las tendencias de la ciudad. Combinamos estética urbana moderna con la atención premium de una barbería clásica.</p>
                <div class="image-box">
                    <img src="/images/barberia/WestSide Barber.jpg" alt="logo Barbería Westside">
                </div>
            </div>
            <div class="image-content gs-slide-right">
                <img src="/images/barberia/Barber1.jpeg" alt="Westside Barbería">
            </div>
        </div>
    </section>

    <!-- 3. Comercialización -->
    <section id="comercializacion" class="comercial-section">
        <div class="container text-center">
            <h2 class="gs-fade-up">Cómo Trabajamos</h2>
            <div class="steps-grid">
                <div class="step-card gs-fade-up">
                    <div class="step-icon">1</div>
                    <h3>Venta Minorista</h3>
                    <p>Adquiere nuestras prendas exclusivas directamente desde nuestra sucursal o con envío a todo el país.</p>
                </div>
                
                <div class="step-card gs-fade-up">
                    <div class="step-icon">2</div>
                    <h3>Barbería</h3>
                    <p>Turnos presenciales con profesionales de primer nivel. Experiencia premium asegurada.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- 6. Catálogo de Productos -->
    <section id="catalogo" class="catalog-section">
        <div class="container text-center">
            <h2 class="gs-fade-up">Catálogo Visual</h2>
            <div class="product-grid">
                        
                
                @foreach ($productos as $producto)
                    <div class="product-card gs-fade-up">
                        <!-- Mostramos la imagen (Si no hay foto, ponemos la de tu web por defecto) -->
                        @if($producto->imagen_frente)
                            <img src="{{ $producto->imagen_frente }}" alt="{{ $producto->nombre }}">
                        @else
                            <div class="placeholder-img">Falta Foto</div>
                        @endif

                        <div class="product-info">
                            <!-- Mostramos el Título y ahora sumamos el Precio! -->
                            <h4>{{ $producto->nombre }}</h4>
                            <p class="product-price" style="font-weight: bold; margin-top: 5px;">
                                $ {{ number_format($producto->precio, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    </section>

    <!-- 7. Consultas -->
    <section id="consultas" class="contact-section">
        <div class="form-container gs-reveal">
            <h2>Dejanos tu Consulta</h2>
            <form action="#" method="POST" class="contact-form">
                <div class="input-group">
                    <label for="name">Nombre Completo</label>
                    <input type="text" id="name" name="name" placeholder="Tu nombre">
                </div>
                <div class="input-group">
                    <label for="email">Correo Electrónico</label>
                    <input type="email" id="email" name="email" placeholder="tucorreo@ejemplo.com">
                </div>
                <div class="input-group">
                    <label for="message">Mensaje</label>
                    <textarea id="message" name="message" rows="4" placeholder="Escribe tu consulta aquí..."></textarea>
                </div>
                <!-- Botón de submit sin validación js requerida por usuario -->
                <button type="submit" class="btn-primary btn-full">Enviar Consulta</button>
            </form>
        </div>
    </section>

    <!-- Footer: 4. Contactos y 5. Términos -->
    <footer class="footer">
        <div class="container footer-grid gs-fade-up">
            <div class="footer-col">
                <h3>Información de Contacto</h3>
                <ul>
                    <li>📍Yrigoyen 2418,Ctes. Cap.</li>
                    <li>📱 +54 9 3795 193973 </li>
                    <li>✉️ westside.ctes@gmail.com</li>
                </ul>
            </div>
            <div class="footer-col">
                <h3>Enlaces Legales</h3>
                <ul>
                    <li><a href="#">Términos y Usos</a></li>
                    <li><a href="#">Política de Privacidad</a></li>
                    <li><a href="#">Políticas de Devolución</a></li>
                </ul>
            </div>
            <div class="footer-col brand-col">
                <h2 class="title-impact">WESTSIDE</h2>
                <p>Est. 2026</p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2026 Westside. Todos los derechos reservados.</p>
        </div>
    </footer>

</body>
</html>
