{{--
    ============================================================
    PARTIAL: turnos-servicios.blade.php
    Uso: @include('partes.turnos-servicios')
    Descripción: Tarjetas de servicios de la barbería (Corte, Barba, Color)
                 y divider decorativo. CSS incluido.
    ============================================================
--}}

<!-- SERVICIOS -->
<section class="servicios-section">
    <div class="servicios-container">
        <h2 class="section-label">Nuestros Servicios</h2>
        <div class="servicios-grid">
            <div class="servicio-card" data-servicio="Corte de cabello">
                <div class="servicio-icon">💈</div>
                <h3 class="servicio-nombre">Corte de Cabello</h3>
                <p class="servicio-desc">Fade, undercut, clásico o lo que tengas en mente. Lo trabajamos con detalle y precisión.</p>
                <div class="servicio-tag">Desde $11.000</div>
            </div>
            <div class="servicio-card" data-servicio="Arreglo de barba">
                <div class="servicio-icon">🪒</div>
                <h3 class="servicio-nombre">Arreglo de Barba</h3>
                <p class="servicio-desc">Perfilado, diseño o afeitado completo. Dejá que los detalles hablen por vos.</p>
                <div class="servicio-tag">Desde $3.500</div>
            </div>
            <div class="servicio-card" data-servicio="Coloración">
                <div class="servicio-icon">🎨</div>
                <h3 class="servicio-nombre">Coloración</h3>
                <p class="servicio-desc">Mechas, decoloración, tintes y más. Dale un giro a tu imagen con color.</p>
                <div class="servicio-tag">Consultar precio</div>
            </div>
        </div>
    </div>
</section>

<!-- DIVIDER -->
<div class="seccion-divider">
    <div class="divider-line"></div>
    <span class="divider-icon">✦</span>
    <div class="divider-line"></div>
</div>

<style>
    .servicios-section { padding: 70px 20px; }
    .servicios-container { max-width: 1100px; margin: 0 auto; }
    .section-label {
        font-family: var(--font-impact);
        font-size: 0.8rem;
        letter-spacing: 4px;
        text-transform: uppercase;
        color: var(--text-muted);
        margin-bottom: 40px;
        text-align: center;
    }
    .servicios-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 24px;
    }
    .servicio-card {
        background: var(--bg-card);
        border: 1px solid var(--border-color);
        border-radius: 20px;
        padding: 36px 28px;
        text-align: center;
        cursor: pointer;
        transition: transform 0.35s ease, border-color 0.35s ease, box-shadow 0.35s ease;
    }
    .servicio-card:hover { transform: translateY(-6px); border-color: rgba(255,255,255,0.3); box-shadow: 0 20px 50px rgba(0,0,0,0.5); }
    .servicio-card.selected { border-color: #25D366; box-shadow: 0 0 0 2px rgba(37,211,102,0.25), 0 20px 50px rgba(0,0,0,0.5); transform: translateY(-6px); }
    .servicio-icon { font-size: 2.8rem; margin-bottom: 16px; }
    .servicio-nombre { font-family: var(--font-impact); font-size: 1.3rem; letter-spacing: 1px; text-transform: uppercase; color: var(--text-main); margin: 0 0 10px; }
    .servicio-desc { font-size: 0.88rem; color: var(--text-muted); line-height: 1.6; margin: 0 0 18px; }
    .servicio-tag { display: inline-block; padding: 5px 14px; border-radius: 50px; background: rgba(255,255,255,0.05); border: 1px solid var(--border-color); font-size: 0.78rem; color: var(--text-muted); }
    .seccion-divider { display: flex; align-items: center; gap: 16px; max-width: 600px; margin: 0 auto; padding: 0 20px; }
    .divider-line { flex: 1; height: 1px; background: var(--border-color); }
    .divider-icon { color: var(--text-muted); font-size: 0.9rem; }
    @media (max-width: 900px) {
        .servicios-grid { grid-template-columns: 1fr; max-width: 420px; margin: 0 auto; }
    }
</style>
