{{--
    ============================================================
    PARTIAL: turnos-formulario.blade.php
    Uso: @include('partes.turnos-formulario')
    Descripción: Formulario generador de mensaje de WhatsApp para
                 pedir turno. Incluye CSS y JS (WSP_NUMBER ya definido
                 en Turnos.blade.php antes de este include).
    ============================================================
--}}

<!-- FORMULARIO GENERADOR DE MENSAJE -->
<section class="wsp-form-section">
    <div class="wsp-form-container">
        <div class="wsp-form-header">
            <h2>Armá tu turno en segundos</h2>
            <p>Completá los datos y te generamos el mensaje listo para enviar por WhatsApp.</p>
        </div>
        <div class="wsp-form-card">
            <div class="form-row">
                <div class="input-group">
                    <label for="turno-nombre">Tu nombre</label>
                    <input type="text" id="turno-nombre" placeholder="Ej: Gonzalo">
                </div>
                <div class="input-group">
                    <label for="turno-servicio">Servicio</label>
                    <select id="turno-servicio">
                        <option value="">— Elegí un servicio —</option>
                        <option value="Corte de cabello">✂️ Corte de cabello</option>
                        <option value="Arreglo de barba">🪒 Arreglo de barba</option>
                        <option value="Corte + Barba">💈 Corte + Barba</option>
                        <option value="Coloración">🎨 Coloración</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="input-group">
                    <label for="turno-dia">Día preferido</label>
                    <input type="text" id="turno-dia" placeholder="Ej: Jueves 1 de Mayo">
                </div>
                <div class="input-group">
                    <label for="turno-hora">Horario preferido</label>
                    <input type="text" id="turno-hora" placeholder="Ej: 15:00 hs">
                </div>
            </div>
            <div class="input-group">
                <label for="turno-nota">Nota extra (opcional)</label>
                <textarea id="turno-nota" rows="3" placeholder="Ej: quiero un fade con diseño en los costados..."></textarea>
            </div>
            <button id="btn-generar-wsp" class="btn-wsp-turno btn-full-wsp">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="20"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12 0C5.373 0 0 5.373 0 12c0 2.127.555 4.124 1.528 5.855L0 24l6.335-1.51A11.945 11.945 0 0 0 12 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.818a9.818 9.818 0 0 1-5.007-1.37l-.36-.214-3.727.977.994-3.634-.234-.373A9.77 9.77 0 0 1 2.182 12C2.182 6.57 6.57 2.182 12 2.182S21.818 6.57 21.818 12 17.43 21.818 12 21.818z"/></svg>
                Pedir Turno por WhatsApp
            </button>
        </div>
    </div>
</section>

<style>
    .wsp-form-section { padding: 70px 20px; background: rgba(255,255,255,0.02); border-top: 1px solid var(--border-color); border-bottom: 1px solid var(--border-color); }
    .wsp-form-container { max-width: 1100px; margin: 0 auto; }
    .wsp-form-header { text-align: center; margin-bottom: 40px; }
    .wsp-form-header h2 { font-family: var(--font-impact); font-size: 2.2rem; letter-spacing: 2px; text-transform: uppercase; color: var(--text-main); margin: 0 0 10px; }
    .wsp-form-header p { font-size: 0.95rem; color: var(--text-muted); }
    .wsp-form-card { background: var(--bg-card); border: 1px solid var(--border-color); border-radius: 20px; padding: 40px; max-width: 720px; margin: 0 auto; }
    .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px; }
    .input-group { display: flex; flex-direction: column; gap: 8px; margin-bottom: 20px; }
    .input-group label { font-size: 0.8rem; letter-spacing: 1px; text-transform: uppercase; color: var(--text-muted); }
    .input-group input, .input-group select, .input-group textarea {
        background: rgba(255,255,255,0.05); border: 1px solid var(--border-color);
        border-radius: 10px; padding: 12px 16px; color: var(--text-main);
        font-size: 0.95rem; font-family: inherit; outline: none; transition: border-color 0.3s ease;
    }
    .input-group select option { background: #1a1a1a; }
    .input-group input:focus, .input-group select:focus, .input-group textarea:focus { border-color: #25D366; }
    .btn-full-wsp { width: 100%; justify-content: center; padding: 15px; font-size: 1rem; }
    @media (max-width: 900px) {
        .form-row { grid-template-columns: 1fr; }
    }
</style>

<script>
    // Generador de mensaje desde formulario
    document.getElementById('btn-generar-wsp').addEventListener('click', () => {
        const nombre   = document.getElementById('turno-nombre').value.trim();
        const servicio = document.getElementById('turno-servicio').value;
        const dia      = document.getElementById('turno-dia').value.trim();
        const hora     = document.getElementById('turno-hora').value.trim();
        const nota     = document.getElementById('turno-nota').value.trim();

        if (!nombre || !servicio) {
            alert('Por favor completá tu nombre y elegí un servicio.');
            return;
        }

        let msg = `Hola! Soy *${nombre}* y quiero sacar un turno en West Side Barber.`;
        msg += `\n\n✂️ *Servicio:* ${servicio}`;
        if (dia)  msg += `\n📅 *Día:* ${dia}`;
        if (hora) msg += `\n⏰ *Horario:* ${hora}`;
        if (nota) msg += `\n📝 *Nota:* ${nota}`;
        msg += `\n\n¿Tienen disponibilidad?`;

        window.open(`https://wa.me/${WSP_NUMBER}?text=${encodeURIComponent(msg)}`, '_blank');
    });
</script>
