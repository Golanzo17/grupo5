<!DOCTYPE html>
<html lang="es-AR">
@include('partes.head')
<body class="catalog-bg">

    <!-- MARCA DE AGUA DE FONDO -->
    <div class="bg-watermark">WESTSIDE</div>

    @include('partes.nav')

    <!-- SECCIÓN COMERCIALIZACIÓN -->
    <section class="legal-section">
        <div class="legal-container">
            <h1 class="title-impact text-center">Comercialización</h1>
            <p class="last-update"><strong>Información sobre Envíos, Entregas y Pagos</strong></p>
            
            <p>En West Side queremos que tu experiencia de compra sea lo más simple, rápida y transparente posible. A continuación te detallamos todas las opciones disponibles para que elijas la que mejor se adapte a tus necesidades.</p>

            <hr>

            <h3>1. Tipos de Entregas</h3>
            <p>Si preferís retirar tu pedido en persona o querés conocer nuestro espacio, te esperamos en nuestro local físico.</p>
            <ul>
                <li><strong>Retiro presencial:</strong> Podés pasar a buscar tu compra por nuestro local una vez que te confirmemos que el pedido está listo.</li>
                <li><strong>Horarios de atención:</strong> Consultá nuestros horarios habituales en nuestras redes sociales o contactanos directamente.</li>
                <li><strong>Ubicación:</strong> Estamos ubicados en Yrigoyen 2418, Ctes. Cap.</li>
            </ul>

            <hr>

            <h3>2. Formas de Envíos</h3>
            <p>Llevamos la experiencia West Side a cualquier punto del país. Trabajamos con logística confiable para que tus prendas y accesorios lleguen de forma segura.</p>
            <ul>
                <li><strong>Correo Argentino:</strong> Realizamos envíos a todo el país. Al momento de confirmar tu compra, se calculará el costo de envío dependiendo de tu ubicación.</li>
                <li><strong>Tiempos de entrega:</strong> Los tiempos estimados varían según la provincia y localidad, habitualmente entre 3 y 7 días hábiles tras el despacho.</li>
                <li><strong>Seguimiento:</strong> Una vez despachado el paquete, te enviaremos el código de seguimiento para que puedas rastrear tu pedido en tiempo real.</li>
            </ul>

            <hr>

            <h3>3. Medios de Pago</h3>
            <p>Ofrecemos diferentes métodos de pago para facilitar tu compra. Seleccioná el que prefieras al finalizar el pedido:</p>
            <ul>
                <li><strong>Efectivo:</strong> Disponible únicamente para compras presenciales o retiros en el local físico.</li>
                <li><strong>Transferencia Bancaria:</strong> Podés abonar desde cualquier cuenta bancaria o billetera virtual. Una vez realizada la compra, te brindaremos los datos (CBU/CVU y Alias) para realizar la transferencia. Es importante enviar el comprobante de pago para procesar tu pedido.</li>
            </ul>

            <hr>

            <h3>4. Información Adicional</h3>
            <p>Para tener en cuenta antes de finalizar tu compra:</p>
            <ul>
                <li>Todos los pedidos realizados mediante transferencia bancaria tienen un plazo máximo de 24 horas para ser abonados. Pasado ese tiempo, la orden se cancelará automáticamente y los productos volverán al stock.</li>
                <li>Si tenés dudas sobre el talle o las medidas de una prenda, no dudes en consultarnos a través de WhatsApp o Instagram antes de comprar.</li>
                <li>Los despachos por correo se realizan en días hábiles (lunes a viernes).</li>
            </ul>

            <hr class="section-divider">

            <div class="text-center">
                <p>¿Tenés alguna consulta específica?</p>
                <a href="/contacto" class="btn-primary" style="display: inline-block; margin-top: 15px;">Contactanos</a>
            </div>
        </div>
    </section>

    @include('partes.footer')

    <!-- ESTILOS ESPECÍFICOS PARA ESTA PÁGINA -->
    <style>
        .legal-section {
            padding-top: calc(var(--nav-height) + 60px);
            padding-bottom: 100px;
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
            margin-bottom: 40px;
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

        .legal-container hr.section-divider {
            height: 3px;
            background: #555;
            margin: 60px 0;
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
