<!DOCTYPE html>
<html lang="es-AR">
@include('partes.head')
<body class="catalog-bg">

    <!-- MARCA DE AGUA DE FONDO -->
    <div class="bg-watermark">WESTSIDE</div>

    @include('partes.nav')

    <!-- SECCIÓN INFORMACIÓN DE CONTACTO -->
    <section class="legal-section">
        <div class="legal-container">
            <h1 class="title-impact text-center">Contacto</h1>
            <p class="last-update"><strong>Estamos para ayudarte</strong></p>
            
            <p class="text-center" style="margin-bottom: 40px;">Si tenés alguna duda sobre nuestros productos, servicios de barbería o querés dejarnos tu comentario, podés comunicarte con nosotros por cualquiera de los siguientes medios.</p>

            <hr>

            <h3>Información Legal y Comercial</h3>
            <ul>
                <li><strong>Titular de la Empresa / Razón Social:</strong> Westside S.A.S.</li>
                <li><strong>Domicilio Legal:</strong> Yrigoyen 2418, Corrientes Capital (Ctes. Cap.)</li>
            </ul>

            <hr>

            <h3>Vías de Comunicación</h3>
            <ul>
                <li style="margin-bottom: 20px;">
                    <strong>Teléfono / WhatsApp:</strong> +54 9 3795 193973
                    <br><br>
                    <!-- Agregamos el CDN de Bootstrap Icons temporalmente para que el ícono funcione -->
                    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
                    
                    <a href="https://wa.me/5493795193973" target="_blank" class="btn btn-success font-weight-bold" style="background-color: #25D366; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none; display: inline-flex; align-items: center; gap: 8px;">
                        <i class="bi bi-whatsapp"></i> Enviar WhatsApp
                    </a>
                </li>
                <li><strong>Correo Electrónico:</strong> westside.ctes@gmail.com</li>
            </ul>

            <hr>

            <h3>Redes Sociales</h3>
            <ul>
                <li><strong>Instagram Ropa:</strong> <a href="https://www.instagram.com/westsid3club/" target="_blank" style="color: #fff; text-decoration: underline;">@westsid3club</a></li>
                <li><strong>Instagram Barbería:</strong> <a href="https://www.instagram.com/westsidebarberclub/" target="_blank" style="color: #fff; text-decoration: underline;">@westsidebarberclub</a></li>
            </ul>
        </div>
    </section>

    @include('partes.formulario_contacto', ['paddingTop' => '0'])

    @include('partes.footer')

    <!-- ESTILOS ESPECÍFICOS PARA ESTA PÁGINA -->
    <style>
        .legal-section {
            padding-top: calc(var(--nav-height) + 60px);
            padding-bottom: 50px;
            position: relative;
            z-index: 1; /* Por encima de la marca de agua */
        }

        .legal-container {
            max-width: 800px;
            margin: 0 auto;
            background-color: var(--bg-card);
            padding: 50px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
            border: 1px solid var(--border-color);
            color: var(--text-main);
            font-family: 'Inter', sans-serif;
        }

        .legal-container h1 {
            font-size: 2.5rem;
            margin-bottom: 10px;
            letter-spacing: 1px;
            color: #fff;
            font-family: var(--font-impact);
            text-transform: uppercase;
        }

        .legal-container .text-center {
            text-align: center;
        }

        .legal-container .last-update {
            text-align: center;
            color: var(--text-muted);
            margin-bottom: 20px;
            font-size: 1.1rem;
        }

        .legal-container h3 {
            font-size: 1.5rem;
            color: #fff;
            margin-top: 30px;
            margin-bottom: 15px;
            font-family: var(--font-impact);
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .legal-container p {
            font-size: 1.1rem;
            line-height: 1.6;
            margin-bottom: 15px;
            color: #ccc;
        }

        .legal-container ul {
            margin-bottom: 20px;
            padding-left: 20px;
        }

        .legal-container li {
            font-size: 1.1rem;
            line-height: 1.6;
            color: #ccc;
            margin-bottom: 10px;
        }

        .legal-container strong {
            color: #fff;
        }

        .legal-container hr {
            border: 0;
            height: 1px;
            background: var(--border-color);
            margin: 30px 0;
        }

        @media (max-width: 768px) {
            .legal-container {
                padding: 30px 20px;
                margin: 0 15px;
            }
            .legal-container h1 {
                font-size: 2rem;
            }
        }
    </style>
</body>
</html>
