{{--
    ============================================================
    PARTIAL: ig-cards.blade.php
    Uso: @include('partes.ig-cards')
    Descripción: Tarjetas de perfil de Instagram para la sección
                 "Quiénes Somos". Incluye HTML + estilos CSS.
    ============================================================
--}}

<!-- SECCIÓN INSTAGRAM -->
<section class="instagram-section">
    <div class="ig-container">

        <div class="ig-section-header">
            <span class="ig-icon-svg">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="1" fill="currentColor" stroke="none"/></svg>
            </span>
            <h2 class="ig-title">Seguinos en Instagram</h2>
            <p class="ig-subtitle">Día a día, estilo y cultura urbana</p>
        </div>

        <div class="ig-profiles-grid">

            <!-- =============================================
                 TARJETA 1: ROPA / STREETWEAR  @westsid3club
                 ============================================= -->
            <div class="ig-profile-card">
                <!-- Cabecera del perfil -->
                <div class="ig-profile-header">
                    <!-- Avatar con aro de Stories -->
                    <div class="ig-avatar-ring">
                        <div class="ig-avatar">
                            <img src="/images/Quienes-somos/WestSide-logo.jpg" alt="Avatar westsid3club">
                        </div>
                    </div>
                    <!-- Info básica -->
                    <div class="ig-profile-info">
                        <h3 class="ig-username">@westsid3club</h3>
                        <p class="ig-bio">Ropa y accesorios urbanos 🧢<br>West Side Club — Argentina 🇦🇷</p>
                        <a href="https://www.instagram.com/westsid3club/" target="_blank" class="ig-follow-btn">
                            Ver perfil
                        </a>
                    </div>
                </div>

                <!-- Estadísticas -->
                <div class="ig-stats">
                    <div class="ig-stat">
                        <span class="ig-stat-number">6</span>
                        <span class="ig-stat-label">Publicaciones</span>
                    </div>
                    <div class="ig-stat">
                        <span class="ig-stat-number">268</span>
                        <span class="ig-stat-label">Seguidores</span>
                    </div>
                    <div class="ig-stat">
                        <span class="ig-stat-number">238</span>
                        <span class="ig-stat-label">Seguidos</span>
                    </div>
                </div>

                <!-- Mini grilla de fotos (últimas 3 publicaciones) -->
                <div class="ig-mini-grid">
                    <div class="ig-mini-photo">
                        <img src="/images/Quienes-somos/Post1-wstd.jpeg" alt="Post 1">
                        <div class="ig-mini-overlay"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="22"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg></div>
                    </div>
                    <div class="ig-mini-photo">
                        <img src="/images/Quienes-somos/Post2-wstd.jpeg" alt="Post 2">
                        <div class="ig-mini-overlay"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="22"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg></div>
                    </div>
                    <div class="ig-mini-photo">
                        <img src="/images/Quienes-somos/WestSide-logo.jpg" alt="Post 3">
                        <div class="ig-mini-overlay"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="22"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg></div>
                    </div>
                </div>
            </div>

            <!-- =============================================
                 TARJETA 2: BARBERÍA  @westsidebarberclub
                 ============================================= -->
            <div class="ig-profile-card">
                <!-- Cabecera del perfil -->
                <div class="ig-profile-header">
                    <!-- Avatar con aro de Stories -->
                    <div class="ig-avatar-ring">
                        <div class="ig-avatar">
                            <img src="/images/Quienes-somos/WestSide-Barber.jpg" alt="Avatar westsidebarberclub">
                        </div>
                    </div>
                    <!-- Info básica -->
                    <div class="ig-profile-info">
                        <h3 class="ig-username">@westsidebarberclub</h3>
                        <p class="ig-bio">Un espacio diseñado para redefinir tu imagen.<br>📍Hipólito Yrigoyen 2418, Corrientes</p>
                        <a href="https://www.instagram.com/westsidebarberclub/" target="_blank" class="ig-follow-btn">
                            Ver perfil
                        </a>
                    </div>
                </div>

                <!-- Estadísticas -->
                <div class="ig-stats">
                    <div class="ig-stat">
                        <span class="ig-stat-number">35</span>
                        <span class="ig-stat-label">Publicaciones</span>
                    </div>
                    <div class="ig-stat">
                        <span class="ig-stat-number">625</span>
                        <span class="ig-stat-label">Seguidores</span>
                    </div>
                    <div class="ig-stat">
                        <span class="ig-stat-number">54</span>
                        <span class="ig-stat-label">Seguidos</span>
                    </div>
                </div>

                <!-- Mini grilla de fotos (últimas 3 publicaciones) -->
                <div class="ig-mini-grid">
                    <div class="ig-mini-photo">
                        <img src="/images/Quienes-somos/Post1-Barber.jpeg" alt="Post 1">
                        <div class="ig-mini-overlay"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="22"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg></div>
                    </div>
                    <div class="ig-mini-photo">
                        <img src="/images/Quienes-somos/Post2-Barber.jpeg" alt="Post 2">
                        <div class="ig-mini-overlay"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="22"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg></div>
                    </div>
                    <div class="ig-mini-photo">
                        <img src="/images/Quienes-somos/Post3-Barber.jpeg" alt="Post 3">
                        <div class="ig-mini-overlay"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" width="22"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg></div>
                    </div>
                </div>
            </div>

        </div><!-- /ig-profiles-grid -->
    </div><!-- /ig-container -->
</section>

<!-- ============================================================
     ESTILOS CSS — Tarjetas de perfil Instagram
     ============================================================ -->
<style>
    /* ============================================
       SECCIÓN INSTAGRAM — TARJETAS DE PERFIL
       ============================================ */
    .instagram-section {
        padding: 40px 20px 120px 20px;
        text-align: center;
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
        border: 3px solid var(--bg-card);
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
