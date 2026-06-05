<!DOCTYPE html>
<html lang="es-AR">
@include('partes.head')
<body class="catalog-bg">

    @include('partes.bg-watermark')
    @include('partes.nav')

    @yield('content')

    @include('partes.footer')

    <script>
        // Re-scrollea al anchor después del renderizado completo en todo el sitio
        window.addEventListener('load', function () {
            if (window.location.hash) {
                const target = document.querySelector(window.location.hash);
                if (target) {
                    setTimeout(() => {
                        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    }, 80);
                }
            }
        });
    </script>
    <div id="toast-success" style="position: fixed; top: 100px; right: 20px; background: var(--bg-card); color: var(--text-main); padding: 15px 25px; border-left: 4px solid var(--accent-color); border-radius: var(--radius-sm); box-shadow: 0 10px 30px rgba(0,0,0,0.5); z-index: 9999; display: flex; align-items: center; gap: 15px; transform: translateX(150%); transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--accent-color)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
        <span id="toast-message" style="font-weight: 500;"></span>
    </div>

    <!-- Error Toast -->
    <div id="toast-error" style="position: fixed; top: 100px; right: 20px; background: var(--bg-card); color: var(--text-main); padding: 15px 25px; border-left: 4px solid var(--error-color, #ef4444); border-radius: var(--radius-sm); box-shadow: 0 10px 30px rgba(0,0,0,0.5); z-index: 9999; display: flex; align-items: center; gap: 15px; transform: translateX(150%); transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="var(--error-color, #ef4444)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
        <span id="toast-error-message" style="font-weight: 500;"></span>
    </div>
    <script>
        window.showToast = function(message) {
            const toast = document.getElementById('toast-success');
            const msgEl = document.getElementById('toast-message');
            if(toast && msgEl) {
                msgEl.textContent = message;
                toast.style.transform = 'translateX(0)';
                setTimeout(() => {
                    toast.style.transform = 'translateX(150%)';
                }, 3500);
            }
        };

        window.showErrorToast = function(message) {
            const toast = document.getElementById('toast-error');
            const msgEl = document.getElementById('toast-error-message');
            if(toast && msgEl) {
                msgEl.textContent = message;
                toast.style.transform = 'translateX(0)';
                setTimeout(() => {
                    toast.style.transform = 'translateX(150%)';
                }, 3500);
            }
        };

        // Escucha global para formularios de eliminación (AJAX)
        document.addEventListener('submit', function(e) {
            if (e.target.matches('.remove-from-cart-form')) {
                e.preventDefault();
                const form = e.target;
                const btn = form.querySelector('button');
                const originalHtml = btn.innerHTML;
                
                btn.innerHTML = '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="animation: spin 1s linear infinite;"><path d="M21 12a9 9 0 1 1-6.219-8.56"/></svg>';
                btn.disabled = true;

                fetch(form.action, {
                    method: 'POST',
                    body: new FormData(form),
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if(data.success) {
                        // Actualizar contadores globales
                        document.querySelectorAll('.cart-count-badge').forEach(badge => {
                            badge.textContent = data.cart_count;
                            badge.style.display = data.cart_count > 0 ? 'inline-block' : 'none';
                        });
                        
                        // Actualizar vista previa del mini carrito
                        if (data.mini_cart_html) {
                            const miniCartContainer = document.getElementById('mini-cart-container');
                            if (miniCartContainer) {
                                miniCartContainer.innerHTML = data.mini_cart_html;
                            }
                        }
                        
                        // Si estamos en la vista principal del carrito, recargarla para reflejar los cambios en la tabla
                        if (window.location.pathname.includes('/carrito')) {
                            window.location.reload();
                        }

                        if(typeof window.showToast === 'function') {
                            window.showToast(data.message);
                        }
                    }
                })
                .catch(err => {
                    btn.innerHTML = originalHtml;
                    btn.disabled = false;
                });
            }
        });

        @if(session('success'))
            setTimeout(() => {
                window.showToast("{{ session('success') }}");
            }, 100);
        @endif

        @if(session('error'))
            setTimeout(() => {
                window.showErrorToast("{{ session('error') }}");
            }, 100);
        @endif
    </script>
</body>
</html>
