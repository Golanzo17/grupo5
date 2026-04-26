<!DOCTYPE html>
<html lang="es-AR">
@include('partes.head')
<body class="catalog-bg">

    <div class="bg-watermark">WESTSIDE</div>
    @include('partes.nav')

    <!-- HEADER DEL CATÁLOGO -->
    <header class="cat-header">
        <div class="cat-header-inner">
            <span class="section-badge">Colección actual</span>
            <h1 class="cat-title">Catálogo</h1>
            <p class="cat-sub">Streetwear seleccionado para los que saben.</p>

            <!-- Buscador con lupa -->
            <div class="cat-search-wrap">
                <svg class="cat-search-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                <input type="text" id="productSearch" class="cat-search-field" placeholder="Buscar producto...">
                <span id="productCount" class="cat-count">10 productos</span>
            </div>

            <!-- Filtros -->
            <div class="cat-filters">
                <button class="filter-chip active" data-filter="all">Todos</button>
                <button class="filter-chip" data-filter="remeras">Remeras</button>
                <button class="filter-chip" data-filter="pantalones">Pantalones</button>
                <button class="filter-chip" data-filter="buzos">Buzos</button>
                <button class="filter-chip" data-filter="chaquetas">Chaquetas</button>
                <button class="filter-chip" data-filter="chombas">Chombas</button>
            </div>
        </div>
    </header>

    <!-- GRILLA -->
    <section class="cat-grid-section">
        <div class="cat-grid-container">
            <div class="products-grid" id="catalog-products">
                @include('partes.productos_estaticos')
            </div>
            <div id="noProductsMessage" class="cat-empty">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" width="48" height="48"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                <h4>No encontramos productos</h4>
                <p>Probá con otro término o quitá el filtro activo.</p>
            </div>
        </div>
    </section>

    @include('partes.footer')

    <style>
        .cat-header {
            padding-top: calc(var(--nav-height) + 60px);
            padding-bottom: 50px;
            text-align: center;
        }
        .cat-header-inner { max-width: 680px; margin: 0 auto; padding: 0 20px; }
        .cat-title {
            font-family: var(--font-impact);
            font-size: clamp(3.5rem, 9vw, 6.5rem);
            text-transform: uppercase;
            letter-spacing: 6px;
            color: var(--text-main);
            line-height: 1;
            margin: 4px 0 12px;
        }
        .cat-sub { font-size: 0.95rem; color: var(--text-muted); letter-spacing: 1px; margin-bottom: 36px; }

        /* Buscador */
        .cat-search-wrap {
            position: relative;
            display: flex;
            align-items: center;
            background: rgba(255,255,255,0.04);
            border: 1px solid var(--border-color);
            border-radius: 50px;
            padding: 0 18px;
            max-width: 480px;
            margin: 0 auto 28px;
            transition: border-color 0.3s ease;
        }
        .cat-search-wrap:focus-within { border-color: rgba(255,255,255,0.3); }
        .cat-search-icon { width: 18px; height: 18px; color: var(--text-muted); flex-shrink: 0; }
        .cat-search-field {
            flex: 1; background: transparent; border: none; outline: none;
            padding: 14px 12px; color: var(--text-main); font-size: 0.92rem; font-family: inherit;
        }
        .cat-search-field::placeholder { color: var(--text-muted); }
        .cat-count { font-size: 0.75rem; color: var(--text-muted); letter-spacing: 1px; white-space: nowrap; flex-shrink: 0; }

        /* Chips */
        .cat-filters { display: flex; gap: 10px; justify-content: center; flex-wrap: wrap; }
        .filter-chip {
            padding: 7px 18px; border-radius: 50px;
            border: 1px solid var(--border-color);
            background: transparent; color: var(--text-muted);
            font-size: 0.78rem; letter-spacing: 1px; text-transform: uppercase;
            cursor: pointer; transition: all 0.25s ease; font-family: inherit;
        }
        .filter-chip:hover { border-color: rgba(255,255,255,0.35); color: var(--text-main); }
        .filter-chip.active { background: var(--text-main); color: var(--bg-dark); border-color: var(--text-main); font-weight: 700; }

        /* Grid */
        .cat-grid-section { padding: 0 20px 100px; }
        .cat-grid-container { max-width: 1300px; margin: 0 auto; }
        #catalog-products.products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 24px;
        }

        /* Cards — animación via IntersectionObserver */
        #catalog-products .product-card {
            position: relative;
            border-radius: var(--radius-lg);
            overflow: hidden;
            border: 1px solid var(--border-color);
            background: var(--bg-card);
            /* Override gs-fade-up visibility:hidden */
            visibility: visible !important;
            opacity: 0;
            transform: translateY(18px);
            transition: opacity 0.38s ease, transform 0.38s ease,
                        box-shadow 0.35s ease, border-color 0.35s ease;
        }
        #catalog-products .product-card.card-visible {
            opacity: 1;
            transform: translateY(0);
        }
        #catalog-products .product-card.card-visible:hover {
            transform: translateY(-6px);
            box-shadow: var(--shadow-hover);
            border-color: rgba(255,255,255,0.15);
        }

        #catalog-products .product-card img {
            width: 100%; height: 360px; object-fit: cover; display: block; transition: transform 0.5s ease;
        }
        #catalog-products .product-card:hover img { transform: scale(1.06); }

        /* Overlay */
        .product-overlay {
            position: absolute; top: 0; left: 0; right: 0;
            bottom: 100px; /* encima de la info */
            background: rgba(0,0,0,0.55);
            display: flex; align-items: center; justify-content: center;
            opacity: 0; transition: opacity 0.35s ease;
        }
        #catalog-products .product-card:hover .product-overlay { opacity: 1; }
        .product-overlay-btn {
            display: inline-flex; align-items: center; gap: 8px;
            padding: 11px 22px; background: #25D366; color: #fff;
            font-weight: 700; font-size: 0.82rem; letter-spacing: 0.5px;
            border-radius: var(--radius-sm); text-decoration: none;
            transform: translateY(10px); transition: transform 0.35s ease, box-shadow 0.35s ease;
        }
        #catalog-products .product-card:hover .product-overlay-btn { transform: translateY(0); box-shadow: 0 8px 24px rgba(37,211,102,0.4); }

        /* Badges */
        .product-cat-tag {
            position: absolute; top: 14px; left: 14px;
            background: rgba(0,0,0,0.75); backdrop-filter: blur(6px);
            border: 1px solid rgba(255,255,255,0.1); color: var(--text-muted);
            font-size: 0.68rem; letter-spacing: 2px; text-transform: uppercase;
            padding: 4px 10px; border-radius: 50px; z-index: 2;
        }
        .product-new-tag {
            position: absolute; top: 14px; right: 14px;
            background: var(--text-main); color: var(--bg-dark);
            font-size: 0.65rem; font-weight: 800; letter-spacing: 2px; text-transform: uppercase;
            padding: 4px 10px; border-radius: 50px; z-index: 2;
        }

        /* Info */
        #catalog-products .product-info { padding: 18px 20px; display: flex; justify-content: space-between; align-items: center; }
        #catalog-products .product-info h4 { font-size: 0.95rem; font-weight: 600; color: var(--text-main); margin: 0; }
        #catalog-products .product-price { font-size: 0.9rem; font-weight: 700; color: var(--text-main); margin: 0; white-space: nowrap; }

        /* Empty state */
        .cat-empty { display: none; text-align: center; padding: 80px 20px; color: var(--text-muted); }
        .cat-empty svg { margin: 0 auto 16px; display: block; color: #444; }
        .cat-empty h4 { font-size: 1.3rem; color: var(--text-main); margin-bottom: 8px; }
        .cat-empty p { font-size: 0.9rem; }

        @media (max-width: 600px) {
            #catalog-products.products-grid { grid-template-columns: repeat(2, 1fr); gap: 12px; }
            #catalog-products .product-card img { height: 200px; }
            #catalog-products .product-info { flex-direction: column; align-items: flex-start; gap: 4px; }
        }
    </style>

    <script>
        const WSP_CAT = '5493795193973';

        // === Animación de entrada escalonada con IntersectionObserver ===
        const cardObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('card-visible');
                    cardObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0, rootMargin: '0px' });

        const cards = document.querySelectorAll('#catalog-products .product-card');
        cards.forEach(card => cardObserver.observe(card));

        // Links de WhatsApp dinámicos en cada overlay
        document.querySelectorAll('.product-overlay-btn').forEach(btn => {
            const name = btn.closest('.product-card').querySelector('h4').innerText;
            btn.href = `https://wa.me/${WSP_CAT}?text=${encodeURIComponent('Hola! Me interesa el producto: ' + name + '. ¿Tienen disponibilidad?')}`;
        });

        // Filtros
        document.querySelectorAll('.filter-chip').forEach(chip => {
            chip.addEventListener('click', () => {
                document.querySelectorAll('.filter-chip').forEach(c => c.classList.remove('active'));
                chip.classList.add('active');
                filterProducts();
            });
        });

        document.getElementById('productSearch').addEventListener('input', filterProducts);

        function filterProducts() {
            const search = document.getElementById('productSearch').value.toLowerCase().trim();
            const active = document.querySelector('.filter-chip.active').getAttribute('data-filter');
            const cards  = document.querySelectorAll('#catalog-products .product-card');
            let visible  = 0;

            cards.forEach(card => {
                const title    = card.querySelector('h4')?.innerText.toLowerCase() || '';
                const category = card.getAttribute('data-category') || '';
                const matchS   = !search || title.includes(search);
                const matchF   = active === 'all' || category === active;

                if (matchS && matchF) {
                    card.style.display = '';
                    card.style.animationDelay = (visible * 0.05) + 's';
                    visible++;
                } else {
                    card.style.display = 'none';
                }
            });

            document.getElementById('productCount').textContent = visible + ' producto' + (visible !== 1 ? 's' : '');
            document.getElementById('noProductsMessage').style.display = visible === 0 ? 'block' : 'none';
        }
    </script>

</body>
</html>
