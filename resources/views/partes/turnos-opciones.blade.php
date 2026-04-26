{{--
    ============================================================
    PARTIAL: turnos-opciones.blade.php
    Uso: @include('partes.turnos-opciones')
    Descripción: Sección "¿Cómo querés sacar tu turno?" con las dos
                 opciones: WhatsApp y Presencial. CSS incluido.
    ============================================================
--}}

<!-- DOS OPCIONES -->
<section class="opciones-section">
    <div class="opciones-container">
        <h2 class="section-label">¿Cómo querés sacar tu turno?</h2>
        <div class="opciones-grid">

            <!-- Opción 1: WhatsApp -->
            <div class="opcion-card opcion-online">
                <div class="opcion-num">01</div>
                <div class="opcion-icon-wrap">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
                </div>
                <h3>Por WhatsApp</h3>
                <p>Mandanos un mensaje con el servicio que querés y el día/horario que te queda mejor. Te confirmamos en el momento.</p>
                <ul class="opcion-beneficios">
                    <li>✔ Respuesta inmediata</li>
                    <li>✔ Sin esperas</li>
                    <li>✔ Confirmación al instante</li>
                </ul>
                <a id="wsp-turno-btn" href="#" target="_blank" class="btn-wsp-turno">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="20"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12 0C5.373 0 0 5.373 0 12c0 2.127.555 4.124 1.528 5.855L0 24l6.335-1.51A11.945 11.945 0 0 0 12 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.818a9.818 9.818 0 0 1-5.007-1.37l-.36-.214-3.727.977.994-3.634-.234-.373A9.77 9.77 0 0 1 2.182 12C2.182 6.57 6.57 2.182 12 2.182S21.818 6.57 21.818 12 17.43 21.818 12 21.818z"/></svg>
                    Pedir Turno por WhatsApp
                </a>
            </div>

            <!-- Opción 2: Presencial -->
            <div class="opcion-card opcion-presencial">
                <div class="opcion-num">02</div>
                <div class="opcion-icon-wrap">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                </div>
                <h3>Presencial</h3>
                <p>Si preferís, pasate directo por el local. Atendemos por orden de llegada y siempre te vamos a recibir con buena onda.</p>
                <ul class="opcion-beneficios">
                    <li>📍 Hipólito Yrigoyen 2418, Corrientes</li>
                    <li>🕐 Lunes a Sábados</li>
                    <li>⏰ 9:00 a 22:00 hs</li>
                </ul>
                <a href="https://maps.google.com/?q=Hipólito+Yrigoyen+2418+Corrientes" target="_blank" class="btn-mapa">
                    Ver en Google Maps →
                </a>
            </div>

        </div>
    </div>
</section>

<style>
    .opciones-section { padding: 70px 20px; }
    .opciones-container { max-width: 1100px; margin: 0 auto; }
    .opciones-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 28px; }
    .opcion-card {
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 20px;
        padding: 40px 36px;
        position: relative;
        transition: transform 0.35s ease, box-shadow 0.35s ease;
    }
    .opcion-card:hover { transform: translateY(-5px); box-shadow: 0 20px 50px rgba(0,0,0,0.4); }
    .opcion-num { font-family: var(--font-impact); font-size: 4rem; color: rgba(255,255,255,0.04); position: absolute; top: 20px; right: 28px; line-height: 1; }
    .opcion-icon-wrap { width: 52px; height: 52px; border-radius: 14px; background: rgba(255,255,255,0.06); border: 1px solid var(--border-color); display: flex; align-items: center; justify-content: center; margin-bottom: 20px; color: var(--text-main); }
    .opcion-icon-wrap svg { width: 26px; height: 26px; }
    .opcion-card h3 { font-family: var(--font-impact); font-size: 1.5rem; letter-spacing: 1px; text-transform: uppercase; color: var(--text-main); margin: 0 0 12px; }
    .opcion-card p { font-size: 0.9rem; color: var(--text-muted); line-height: 1.65; margin: 0 0 22px; }
    .opcion-beneficios { list-style: none; padding: 0; margin: 0 0 28px; display: flex; flex-direction: column; gap: 8px; }
    .opcion-beneficios li { font-size: 0.87rem; color: var(--text-muted); }
    .btn-wsp-turno {
        display: inline-flex; align-items: center; gap: 10px;
        padding: 13px 26px; background: #25D366; color: #fff;
        font-weight: 700; font-size: 0.9rem; letter-spacing: 0.5px;
        border-radius: 12px; text-decoration: none; border: none;
        cursor: pointer; transition: background 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease;
    }
    .btn-wsp-turno:hover { background: #1ebe5a; transform: translateY(-2px); box-shadow: 0 8px 24px rgba(37,211,102,0.35); }
    .btn-mapa {
        display: inline-flex; align-items: center; gap: 6px;
        padding: 11px 22px; background: transparent; color: var(--text-main);
        font-size: 0.87rem; font-weight: 600; letter-spacing: 0.5px;
        border: 1px solid var(--border-color); border-radius: 10px;
        text-decoration: none; transition: border-color 0.3s ease, background 0.3s ease;
    }
    .btn-mapa:hover { border-color: rgba(255,255,255,0.4); background: rgba(255,255,255,0.05); }
    @media (max-width: 900px) {
        .opciones-grid { grid-template-columns: 1fr; }
    }
</style>
