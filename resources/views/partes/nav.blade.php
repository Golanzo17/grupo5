    <!-- Navegación -->
    <nav class="navbar">
        <div class="nav-container">
            <a href="/" class="logo">WESTSIDE</a>

            <ul class="nav-links">
                <li><a href="/quienes-somos">Quienes Somos</a></li>
                <li><a href="/catalogo">Catálogo</a></li>
                <li><a href="/comercializacion">Comercialización</a></li>
                <li><a href="/terminos-y-usos">Términos y Usos</a></li>
                <li><a href="/contacto">Contacto</a></li>
                <li><a href="/consultas">Consultas</a></li>
                <li><a href="/turnos" class="btn-primary">Turnos</a></li>

                {{-- Botones de autenticación --}}
                <li class="nav-auth-group" style="position: relative; margin-left: 15px;">
                    @guest
                        <a href="{{ route('login') }}" style="background: none; border: none; color: var(--text-main); display: flex; align-items: center; gap: 8px; text-decoration: none; font-size: 0.95rem; font-weight: 500;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                            <span>Ingresar</span>
                        </a>
                    @endguest

                    @auth
                        <button id="user-menu-btn" aria-expanded="false" style="background: none; border: none; color: var(--text-main); cursor: pointer; display: flex; align-items: center; gap: 8px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                            <span style="font-size: 0.95rem; font-weight: 500;">{{ Auth::user()->nombre }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-top: 2px;"><path d="m6 9 6 6 6-6"/></svg>
                        </button>

                        <div class="user-dropdown-menu" id="user-dropdown-menu">
                            @if(Auth::user()->rol->nombre === 'admin')
                                <a href="{{ route('admin.dashboard') }}" class="dropdown-item">Panel Admin</a>
                            @else
                                <a href="{{ route('cliente.dashboard') }}" class="dropdown-item">Mi Cuenta</a>
                            @endif
                            <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                                @csrf
                                <button type="submit" class="dropdown-item" style="width: 100%; text-align: left; background: none; border: none; cursor: pointer; font-family: var(--font-base);">Salir</button>
                            </form>
                        </div>
                    @endauth
                </li>
            </ul>

            <!-- Botón hamburguesa — solo visible en mobile -->
            <button class="nav-hamburger" id="nav-hamburger" aria-label="Abrir menú de navegación">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </nav>

    <!-- Menú mobile — overlay de pantalla completa -->
    <div class="mobile-menu" id="mobile-menu" aria-hidden="true">
        <ul class="mobile-menu-links">
            <li><a href="/quienes-somos" class="mobile-menu-link">Quienes Somos</a></li>
            <li><a href="/catalogo" class="mobile-menu-link">Catálogo</a></li>
            <li><a href="/comercializacion" class="mobile-menu-link">Comercialización</a></li>
            <li><a href="/terminos-y-usos" class="mobile-menu-link">Términos y Usos</a></li>
            <li><a href="/contacto" class="mobile-menu-link">Contacto</a></li>
            <li><a href="/consultas" class="mobile-menu-link">Consultas</a></li>
            <li><a href="/turnos" class="mobile-menu-link mobile-menu-link--cta">Reservar Turno</a></li>

            {{-- Auth links mobile --}}
            @guest
                <li><a href="{{ route('login') }}" class="mobile-menu-link">Ingresar</a></li>
                <li><a href="{{ route('registro') }}" class="mobile-menu-link">Registrarse</a></li>
            @endguest

            @auth
                @if(Auth::user()->rol->nombre === 'admin')
                    <li><a href="{{ route('admin.dashboard') }}" class="mobile-menu-link">Panel Admin</a></li>
                @else
                    <li><a href="{{ route('cliente.dashboard') }}" class="mobile-menu-link">Mi Cuenta</a></li>
                @endif
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="mobile-menu-link mobile-logout-btn">Cerrar Sesión</button>
                    </form>
                </li>
            @endauth
        </ul>
    </div>

    <script>
        (function () {
            // Lógica Menú Hamburguesa
            const btn  = document.getElementById('nav-hamburger');
            const menu = document.getElementById('mobile-menu');

            function toggle() {
                const isOpen = menu.classList.toggle('is-open');
                btn.classList.toggle('is-open');
                document.body.classList.toggle('menu-open');
                menu.setAttribute('aria-hidden', String(!isOpen));
            }

            btn.addEventListener('click', toggle);

            menu.querySelectorAll('.mobile-menu-link').forEach(a =>
                a.addEventListener('click', () => {
                    menu.classList.remove('is-open');
                    btn.classList.remove('is-open');
                    document.body.classList.remove('menu-open');
                    menu.setAttribute('aria-hidden', 'true');
                })
            );

            // Lógica Dropdown Usuario (Desktop)
            const userBtn = document.getElementById('user-menu-btn');
            const userMenu = document.getElementById('user-dropdown-menu');

            if (userBtn && userMenu) {
                userBtn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    userMenu.classList.toggle('show');
                    userBtn.setAttribute('aria-expanded', userMenu.classList.contains('show'));
                });

                document.addEventListener('click', (e) => {
                    if (!userBtn.contains(e.target) && !userMenu.contains(e.target)) {
                        userMenu.classList.remove('show');
                        userBtn.setAttribute('aria-expanded', 'false');
                    }
                });
            }

            // Cerrar con tecla Escape
            document.addEventListener('keydown', e => {
                if (e.key === 'Escape') {
                    if (menu.classList.contains('is-open')) toggle();
                    if (userMenu && userMenu.classList.contains('show')) {
                        userMenu.classList.remove('show');
                        userBtn.setAttribute('aria-expanded', 'false');
                    }
                }
            });
        })();
    </script>
