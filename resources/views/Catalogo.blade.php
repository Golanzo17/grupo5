@extends('layouts.app')

@section('content')
    @include('partes.hero-catalogo')

    <!-- GRILLA -->
    <section class="cat-grid-section">
        <div class="cat-grid-container">
            <div class="products-grid" id="catalog-products">
                @php
                    $wspIcon = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" width="16"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12 0C5.373 0 0 5.373 0 12c0 2.127.555 4.124 1.528 5.855L0 24l6.335-1.51A11.945 11.945 0 0 0 12 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.818a9.818 9.818 0 0 1-5.007-1.37l-.36-.214-3.727.977.994-3.634-.234-.373A9.77 9.77 0 0 1 2.182 12C2.182 6.57 6.57 2.182 12 2.182S21.818 6.57 21.818 12 17.43 21.818 12 21.818z"/></svg>';
                @endphp
                @foreach($productos as $producto)
                    <div class="product-card gs-fade-up" data-category="{{ $producto->categoria ? $producto->categoria->slug : '' }}">
                        @if($producto->categoria)
                            <span class="product-cat-tag">{{ $producto->categoria->nombre }}</span>
                        @endif
                        @if($producto->es_nuevo)
                            <span class="product-new-tag">Nuevo</span>
                        @endif
                        
                        <img src="{{ $producto->imagen_ruta }}" alt="{{ $producto->nombre }}">
                        
                        <div class="product-overlay">
                            <a href="https://wa.me/{{ env('WSP_NUMBER', '5493795193973') }}?text=Hola,%20me%20interesa%20el%20producto:%20{{ urlencode($producto->nombre) }}" class="product-overlay-btn" target="_blank">{!! $wspIcon !!} Consultar</a>
                        </div>
                        <div class="product-info">
                            <h4>{{ $producto->nombre }}</h4>
                            <p class="product-price">${{ number_format($producto->precio, 0, ',', '.') }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <div id="noProductsMessage" class="cat-empty">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" width="48" height="48"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                <h4>No encontramos productos</h4>
                <p>Probá con otro término o quitá el filtro activo.</p>
            </div>
        </div>
    </section>

    

    <script>
        const WSP_CAT = window.WSP;

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

        // Contador inicial real
        const totalCards = cards.length;
        document.getElementById('productCount').textContent = totalCards + ' producto' + (totalCards !== 1 ? 's' : '');

        // Links de WhatsApp dinámicos en cada overlay
        document.querySelectorAll('.product-overlay-btn').forEach(btn => {
            const name = btn.closest('.product-card').querySelector('h4').textContent.trim();
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
                const titleElement = card.querySelector('h4');
                const title    = (titleElement ? titleElement.textContent : '').toLowerCase();
                const category = card.getAttribute('data-category') || '';
                const matchS   = !search || title.includes(search);
                const matchF   = active === 'all' || category === active;

                if (matchS && matchF) {
                    card.style.display = '';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
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

@endsection
