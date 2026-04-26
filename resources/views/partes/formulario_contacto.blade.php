    <!-- FORMULARIO DE CONSULTAS -->
    <section id="consultas" class="contact-section" @if(isset($paddingTop)) style="padding-top: {{ $paddingTop }};" @endif>
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
