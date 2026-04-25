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
                <li><strong>Teléfono / WhatsApp:</strong> +54 9 3795 193973</li>
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

    <!-- FORMULARIO DE CONSULTAS (Copiado de Principal) -->
    <section id="consultas" class="contact-section" style="padding-top: 0;">
        <div class="form-container">
            <h2 style="text-align: center; margin-bottom: 30px; font-family: var(--font-impact); letter-spacing: 1px; font-size: 2rem;">Dejanos tu Consulta</h2>
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

        /* Estilos del formulario de contacto para asegurar que se vea bien aquí */
        .contact-section {
            position: relative;
            z-index: 1;
            padding-bottom: 100px;
        }
        
        .form-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: var(--bg-dark);
            padding: 40px;
            border-radius: 10px;
            border: 1px solid var(--border-color);
        }

        .input-group {
            margin-bottom: 20px;
        }

        .input-group label {
            display: block;
            margin-bottom: 8px;
            color: var(--text-main);
            font-weight: 500;
        }

        .input-group input,
        .input-group textarea {
            width: 100%;
            padding: 12px 15px;
            background-color: #1a1a1a;
            border: 1px solid #333;
            border-radius: 6px;
            color: #fff;
            font-family: inherit;
            transition: border-color 0.3s ease;
        }

        .input-group input:focus,
        .input-group textarea:focus {
            outline: none;
            border-color: #fff;
        }

        .btn-full {
            width: 100%;
        }

        @media (max-width: 768px) {
            .legal-container {
                padding: 30px 20px;
                margin: 0 15px;
            }
            .legal-container h1 {
                font-size: 2rem;
            }
            .form-container {
                margin: 0 15px;
                padding: 30px 20px;
            }
        }
    </style>
</body>
</html>
