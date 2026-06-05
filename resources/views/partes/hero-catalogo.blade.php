{{-- Hero del Catálogo: título, buscador y filtros de categoría --}}
<header class="cat-header">
    <div class="cat-header-inner">
        <span class="section-badge">Colección actual</span>
        <h1 class="cat-title">Catálogo</h1>
        <p class="cat-sub">Streetwear seleccionado para los que saben.</p>

        <form method="GET" action="{{ route('catalogo.index') }}" id="catalogForm">
            <!-- Buscador con lupa -->
            <div class="cat-search-wrap">
                <svg class="cat-search-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                <input type="text" name="search" value="{{ request('search') }}" id="productSearch" class="cat-search-field" placeholder="Buscar producto...">
                <span id="productCount" class="cat-count"></span>
            </div>

            <!-- Filtros de categoría -->
            <div class="cat-filters">
                <input type="hidden" name="category" id="categoryInput" value="{{ request('category', 'all') }}">
                @php
                    $currentCat = request('category', 'all');
                @endphp
                <button type="button" class="filter-chip {{ $currentCat == 'all' ? 'active' : '' }}" data-filter="all">Todos</button>
                @foreach($categorias as $cat)
                    <button type="button" class="filter-chip {{ $currentCat == $cat->slug ? 'active' : '' }}" data-filter="{{ $cat->slug }}">{{ $cat->nombre }}</button>
                @endforeach
            </div>
        </form>
    </div>
</header>
