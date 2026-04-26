<!DOCTYPE html>
<html lang="es-AR">
@include('partes.head')
<body class="catalog-bg">

    <div class="bg-watermark">WESTSIDE</div>
    @include('partes.nav')

    <!-- HERO -->
    <section class="turnos-hero">
        <div class="turnos-hero-content">
            <span class="turnos-badge">Barbería West Side</span>
            <h1 class="turnos-hero-title">Reservá tu Turno</h1>
            <p class="turnos-hero-sub">Elegí tu servicio, mandanos un mensaje y te confirmamos en minutos.<br>También podés pasarte directo al local.</p>
        </div>
    </section>

    @include('partes.turnos-servicios')

    @include('partes.turnos-opciones')

    @include('partes.turnos-formulario')

    @include('partes.footer')

    <style>
        .turnos-hero {
            min-height: 46vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: calc(var(--nav-height) + 60px) 20px 60px;
        }
        .turnos-badge {
            display: inline-block;
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.12);
            border-radius: 50px;
            padding: 6px 18px;
            font-size: 0.85rem;
            letter-spacing: 1px;
            color: var(--text-muted);
            margin-bottom: 22px;
        }
        .turnos-hero-title {
            font-family: var(--font-impact);
            font-size: clamp(3rem, 8vw, 6rem);
            text-transform: uppercase;
            letter-spacing: 4px;
            color: var(--text-main);
            line-height: 1;
            margin: 0 0 20px;
        }
        .turnos-hero-sub {
            font-size: 1.05rem;
            color: var(--text-muted);
            line-height: 1.7;
            max-width: 520px;
            margin: 0 auto;
        }
    </style>

    <script>
    
        const WSP_NUMBER = '5493795193973';

        // Al hacer clic en una tarjeta de servicio, pre-selecciona en el formulario
        document.querySelectorAll('.servicio-card').forEach(card => {
            card.addEventListener('click', () => {
                document.querySelectorAll('.servicio-card').forEach(c => c.classList.remove('selected'));
                card.classList.add('selected');
                const servicio = card.getAttribute('data-servicio');
                const select = document.getElementById('turno-servicio');
                for (let opt of select.options) {
                    if (opt.value === servicio) { opt.selected = true; break; }
                }
                document.querySelector('.wsp-form-section').scrollIntoView({ behavior: 'smooth', block: 'start' });
            });
        });

        // Botón directo de la sección opciones
        document.getElementById('wsp-turno-btn').href =
            `https://wa.me/${WSP_NUMBER}?text=${encodeURIComponent('Hola! Quiero sacar un turno en West Side Barber. ¿Tienen disponibilidad?')}`;
    </script>

</body>
</html>
