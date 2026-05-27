@extends('layouts.admin')

@section('title', 'Nuevo Producto')

@section('content')
    <div class="admin-section">
        <h2 class="admin-section-title">Crear Producto</h2>

        <form method="POST" action="{{ route('admin.productos.store') }}" enctype="multipart/form-data" class="admin-form">
            @csrf

            <div class="form-grid">
                <div class="form-group">
                    <label for="nombre">Nombre del Producto</label>
                    <input type="text" id="nombre" name="nombre" value="{{ old('nombre') }}" required
                           class="form-input @error('nombre') form-input-error @enderror"
                           placeholder="Ej: Remera Oversize Negra">
                    @error('nombre')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="categoria_id">Categoría</label>
                    <select id="categoria_id" name="categoria_id" required class="form-input @error('categoria_id') form-input-error @enderror">
                        <option value="">Seleccionar categoría</option>
                        @foreach($categorias as $cat)
                            <option value="{{ $cat->id }}" {{ old('categoria_id') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('categoria_id')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="precio">Precio ($)</label>
                    <input type="number" id="precio" name="precio" value="{{ old('precio') }}" required step="0.01" min="0"
                           class="form-input @error('precio') form-input-error @enderror"
                           placeholder="0.00">
                    @error('precio')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group" style="grid-column: 1 / -1;">
                    <label>Stock por Talle</label>
                    <div style="display: flex; flex-wrap: wrap; gap: 15px;">
                        @foreach($talles as $talle)
                            <div style="background: var(--bg-dark); padding: 10px; border-radius: var(--radius-sm); border: 1px solid var(--border-color); flex: 1; min-width: 120px;">
                                <label style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 5px;">
                                    <span>Talle {{ $talle->nombre }}</span>
                                </label>
                                <input type="number" name="talles[{{ $talle->id }}]" min="0" placeholder="0" class="form-input" style="width: 100%;">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea id="descripcion" name="descripcion" rows="4"
                          class="form-input @error('descripcion') form-input-error @enderror"
                          placeholder="Descripción del producto...">{{ old('descripcion') }}</textarea>
                @error('descripcion')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="imagen">Imagen del Producto</label>
                <input type="file" id="imagen" name="imagen" required accept="image/*"
                       class="form-input form-input-file @error('imagen') form-input-error @enderror">
                @error('imagen')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-row-checkboxes">
                <label class="form-checkbox">
                    <input type="hidden" name="es_nuevo" value="0">
                    <input type="checkbox" name="es_nuevo" value="1" {{ old('es_nuevo') ? 'checked' : '' }}>
                    <span>Marcar como nuevo</span>
                </label>

                <label class="form-checkbox">
                    <input type="hidden" name="activo" value="0">
                    <input type="checkbox" name="activo" value="1" {{ old('activo', true) ? 'checked' : '' }}>
                    <span>Activo (visible en catálogo)</span>
                </label>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-primary">Crear Producto</button>
                <a href="{{ route('admin.productos.index') }}" class="btn-ghost">Cancelar</a>
            </div>
        </form>
    </div>
@endsection
