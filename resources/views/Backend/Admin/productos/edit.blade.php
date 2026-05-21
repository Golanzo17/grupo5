@extends('layouts.admin')

@section('title', 'Editar Producto')

@section('content')
    <div class="admin-section">
        <h2 class="admin-section-title">Editar: {{ $producto->nombre }}</h2>

        <form method="POST" action="{{ route('admin.productos.update', $producto) }}" enctype="multipart/form-data" class="admin-form">
            @csrf
            @method('PUT')

            <div class="form-grid">
                <div class="form-group">
                    <label for="nombre">Nombre del Producto</label>
                    <input type="text" id="nombre" name="nombre" value="{{ old('nombre', $producto->nombre) }}" required
                           class="form-input @error('nombre') form-input-error @enderror">
                    @error('nombre')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="categoria_id">Categoría</label>
                    <select id="categoria_id" name="categoria_id" required class="form-input @error('categoria_id') form-input-error @enderror">
                        <option value="">Seleccionar categoría</option>
                        @foreach($categorias as $cat)
                            <option value="{{ $cat->id }}" {{ old('categoria_id', $producto->categoria_id) == $cat->id ? 'selected' : '' }}>
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
                    <input type="number" id="precio" name="precio" value="{{ old('precio', $producto->precio) }}" required step="0.01" min="0"
                           class="form-input @error('precio') form-input-error @enderror">
                    @error('precio')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="stock">Stock</label>
                    <input type="number" id="stock" name="stock" value="{{ old('stock', $producto->stock) }}" min="0"
                           class="form-input @error('stock') form-input-error @enderror">
                    @error('stock')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea id="descripcion" name="descripcion" rows="4"
                          class="form-input @error('descripcion') form-input-error @enderror">{{ old('descripcion', $producto->descripcion) }}</textarea>
                @error('descripcion')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>Imagen actual</label>
                <div class="current-image">
                    <img src="{{ asset('storage/' . $producto->imagen_ruta) }}" alt="{{ $producto->nombre }}" class="preview-img">
                </div>
            </div>

            <div class="form-group">
                <label for="imagen">Cambiar Imagen (opcional)</label>
                <input type="file" id="imagen" name="imagen" accept="image/*"
                       class="form-input form-input-file @error('imagen') form-input-error @enderror">
                @error('imagen')
                    <span class="form-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-row-checkboxes">
                <label class="form-checkbox">
                    <input type="hidden" name="es_nuevo" value="0">
                    <input type="checkbox" name="es_nuevo" value="1" {{ old('es_nuevo', $producto->es_nuevo) ? 'checked' : '' }}>
                    <span>Marcar como nuevo</span>
                </label>

                <label class="form-checkbox">
                    <input type="hidden" name="activo" value="0">
                    <input type="checkbox" name="activo" value="1" {{ old('activo', $producto->activo) ? 'checked' : '' }}>
                    <span>Activo (visible en catálogo)</span>
                </label>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-primary">Guardar Cambios</button>
                <a href="{{ route('admin.productos.index') }}" class="btn-ghost">Cancelar</a>
            </div>
        </form>
    </div>
@endsection
