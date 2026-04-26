<!DOCTYPE html>
<html lang="es-AR">
@include('partes.head')
<body class="catalog-bg">

    <!-- MARCA DE AGUA DE FONDO -->
    <div class="bg-watermark">WESTSIDE</div>

    @include('partes.nav')

    <!-- SECCIÓN QUIÉNES SOMOS - STORYTELLING -->
    <section class="storytelling-section">
        <div class="story-container">
            
            <!-- Columna Izquierda: Textos que scrollean -->
            <div class="story-text-column">
                <div class="story-step" data-step="1">
                    <p>West Side nace en 2024 entre amigos, con una idea clara: crear algo propio dentro de la cultura urbana. Empezamos como un proyecto online enfocado en accesorios y ropa, buscando ofrecer productos que realmente representen estilo, identidad y actitud.</p>
                </div>
                
                <div class="story-step" data-step="2">
                    <p>Con el tiempo, esa visión creció. No solo queríamos que te vistas bien, queríamos que te sientas bien. Así fue como en 2025 dimos un paso más y abrimos nuestro primer espacio físico, incorporando el servicio de barbería como parte esencial de la experiencia West Side.</p>
                </div>
                
                <div class="story-step" data-step="3">
                    <p>Hoy somos más que una marca. Somos un punto de encuentro entre estilo, cuidado personal y cultura urbana. Creemos en el detalle, en la evolución constante y en ayudarte a potenciar tu imagen en todos los aspectos.</p>
                </div>
                
                <div class="story-step" data-step="4">
                    <p>West Side no es solo lo que usás, es cómo te mostrás al mundo.</p>
                </div>
            </div>

            <!-- Columna Derecha: Imágenes fijas (Sticky) que cambian -->
            <div class="story-visual-column">
                <div class="visual-wrapper">
                    <!-- Imagen 1 -->
                    <div class="story-image active" id="story-img-1">
                        <img src="/images/Quienes-somos/Grupal.jpeg" alt="Historia West Side"> 
                    </div>
                    <!-- Imagen 2 -->
                    <div class="story-image" id="story-img-2">
                        <img src="/images/Quienes-somos/Progreso.jpeg" alt="Historia West Side">
                    </div>
                    <!-- Imagen 3 -->
                    <div class="story-image" id="story-img-3">
                        <img src="/images/Quienes-somos/Barberia.jpeg" alt="Historia West Side">
                    </div>
                    <!-- Imagen 4 -->
                    <div class="story-image" id="story-img-4">
                        <img src="/images/Quienes-somos/Actitud.jpeg" alt="Historia West Side">
                    </div>
                </div>
            </div>

        </div>
    </section>

    @include('partes.ig-cards')

    @include('partes.footer')

    <!-- ESTILOS ESPECÍFICOS PARA ESTA PÁGINA -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;1,400&display=swap');

        .storytelling-section {
            background-color: transparent; /* Permite ver el fondo y la marca de agua */
            padding-top: calc(var(--nav-height) + 60px);
            padding-bottom: 150px;
        }

        .story-container {
            display: flex;
            max-width: 1200px;
            margin: 0 auto;
            position: relative;
            gap: 60px;
        }

        /* Lado Izquierdo: Textos */
        .story-text-column {
            width: 50%;
            padding: 0 20px;
        }

        .story-step {
            min-height: 80vh; /* Altura grande para forzar el scroll y dar respiro */
            display: flex;
            align-items: center;
            opacity: 0.2;
            transition: opacity 0.5s ease, transform 0.5s ease;
            transform: translateY(30px);
        }

        .story-step.is-active {
            opacity: 1;
            transform: translateY(0);
        }

        .story-step p {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            line-height: 1.7;
            color: var(--text-main);
            font-weight: 400;
            letter-spacing: 0.5px;
        }

        /* Lado Derecho: Imágenes Sticky */
        .story-visual-column {
            width: 50%;
        }

        .visual-wrapper {
            position: sticky;
            top: calc(var(--nav-height) + 10vh); /* Se queda pegado a esta distancia del top */
            height: 70vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .story-image {
            position: absolute;
            width: 100%;
            height: 100%;
            opacity: 0;
            transition: opacity 0.8s ease, transform 0.8s ease;
            transform: scale(0.95) translateY(20px);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.6);
            background-color: var(--bg-card);
        }

        .story-image.active {
            opacity: 1;
            transform: scale(1) translateY(0);
            z-index: 2;
        }

        .placeholder-story {
            width: 100%;
            height: 100%;
            background-color: #1a1a1a;
            border: 2px dashed #444;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #666;
            font-family: var(--font-impact);
            font-size: 2rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            text-align: center;
            padding: 20px;
        }

        /* Para cuando el usuario agregue la etiqueta img real */
        .story-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Responsive para celulares */
        @media (max-width: 900px) {
            .story-container {
                flex-direction: column-reverse; /* Imagen arriba, texto abajo */
            }
            .story-text-column, .story-visual-column {
                width: 100%;
            }
            
            .visual-wrapper {
                position: sticky;
                top: var(--nav-height);
                height: 40vh;
                margin-bottom: 20px;
                z-index: 10;
            }
            
            .story-step {
                min-height: 50vh;
                margin-bottom: 20px;
            }
            
            .story-step p {
                font-size: 1.4rem;
            }
        }

    

        /* Encabezado de sección */
        .ig-section-header {
            margin-bottom: 60px;
        }

        .ig-icon-svg {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 52px;
            height: 52px;
            border-radius: 14px;
            background: linear-gradient(135deg, #f09433, #e6683c, #dc2743, #cc2366, #bc1888);
            margin-bottom: 16px;
            color: #fff;
        }

        .ig-icon-svg svg {
            width: 28px;
            height: 28px;
        }

        .ig-title {
            font-size: 2.6rem;
            font-family: var(--font-impact);
            letter-spacing: 2px;
            text-transform: uppercase;
            margin: 0 0 10px;
            color: var(--text-main);
        }

        .ig-subtitle {
            font-size: 1rem;
            color: var(--text-muted);
            letter-spacing: 1px;
        }

        /* Grid de tarjetas */
        .ig-profiles-grid {
            display: flex;
            justify-content: center;
            gap: 40px;
            max-width: 960px;
            margin: 0 auto;
        }

        /* Tarjeta principal */
        .ig-profile-card {
            flex: 1;
            background-color: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 20px;
            overflow: hidden;
            transition: transform 0.4s ease, box-shadow 0.4s ease, border-color 0.4s ease;
        }

        .ig-profile-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 24px 60px rgba(0, 0, 0, 0.5);
            border-color: rgba(220, 39, 67, 0.5);
        }

        /* Cabecera: avatar + info */
        .ig-profile-header {
            display: flex;
            align-items: center;
            gap: 20px;
            padding: 28px 24px 20px;
        }

        /* Aro degradado tipo Stories */
        .ig-avatar-ring {
            flex-shrink: 0;
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: linear-gradient(135deg, #f09433, #e6683c, #dc2743, #cc2366, #bc1888);
            padding: 3px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .ig-avatar {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            overflow: hidden;
            border: 3px solid var(--bg-card); /* Separación entre aro y foto */
            background-color: #111;
        }

        .ig-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        /* Texto del perfil */
        .ig-profile-info {
            flex: 1;
            text-align: left;
        }

        .ig-username {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--text-main);
            margin: 0 0 6px;
            letter-spacing: 0.5px;
        }

        .ig-bio {
            font-size: 0.82rem;
            color: var(--text-muted);
            line-height: 1.5;
            margin: 0 0 12px;
        }

        .ig-follow-btn {
            display: inline-block;
            padding: 7px 20px;
            border-radius: 8px;
            background: linear-gradient(135deg, #e6683c, #dc2743, #bc1888);
            color: #fff;
            font-size: 0.82rem;
            font-weight: 700;
            text-decoration: none;
            letter-spacing: 0.5px;
            transition: opacity 0.3s ease, transform 0.3s ease;
        }

        .ig-follow-btn:hover {
            opacity: 0.85;
            transform: scale(1.04);
        }

        /* Estadísticas */
        .ig-stats {
            display: flex;
            justify-content: space-around;
            padding: 16px 24px;
            border-top: 1px solid var(--border-color);
            border-bottom: 1px solid var(--border-color);
        }

        .ig-stat {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 3px;
        }

        .ig-stat-number {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--text-main);
            letter-spacing: 0.5px;
        }

        .ig-stat-label {
            font-size: 0.72rem;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Mini grilla de fotos */
        .ig-mini-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 3px;
            background-color: var(--bg-dark);
        }

        .ig-mini-photo {
            position: relative;
            aspect-ratio: 1 / 1;
            overflow: hidden;
            cursor: pointer;
            background-color: #111;
        }

        .ig-mini-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform 0.4s ease;
        }

        /* Overlay con ícono al pasar el mouse */
        .ig-mini-overlay {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.45);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .ig-mini-photo:hover .ig-mini-overlay {
            opacity: 1;
        }

        .ig-mini-photo:hover img {
            transform: scale(1.08);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .ig-profiles-grid {
                flex-direction: column;
                max-width: 420px;
            }
            .ig-profile-header {
                gap: 14px;
                padding: 20px 18px 16px;
            }
            .ig-avatar-ring {
                width: 64px;
                height: 64px;
            }
        }
    </style>

    <!-- SCRIPT PARA EL EFECTO DE SCROLL ("Scrollytelling") -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const steps = document.querySelectorAll('.story-step');
            const images = document.querySelectorAll('.story-image');

            // Usamos IntersectionObserver para detectar cuándo un párrafo llega al medio de la pantalla
            const observerOptions = {
                root: null,
                rootMargin: '-40% 0px -40% 0px', // Se activa cuando el elemento cruza el 40% central de la pantalla
                threshold: 0
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        // Obtener el número del párrafo actual
                        const stepIndex = entry.target.getAttribute('data-step');

                        // 1. Iluminar el texto actual y apagar los demás
                        steps.forEach(s => s.classList.remove('is-active'));
                        entry.target.classList.add('is-active');

                        // 2. Mostrar la imagen correspondiente y ocultar las demás con efecto fade
                        images.forEach(img => img.classList.remove('active'));
                        const currentImg = document.getElementById('story-img-' + stepIndex);
                        if(currentImg) {
                            currentImg.classList.add('active');
                        }
                    }
                });
            }, observerOptions);

            // Empezar a observar todos los párrafos
            steps.forEach(step => observer.observe(step));
            
            // Activar el primer elemento manualmente al cargar
            if(steps.length > 0) {
                steps[0].classList.add('is-active');
            }
        });
    </script>
</body>
</html>
