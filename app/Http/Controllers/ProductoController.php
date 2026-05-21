<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
    /**
     * Listar todos los productos.
     */
    public function index()
    {
        $productos = Producto::with('categoria')->latest()->paginate(15);
        return view('Backend.Admin.productos.index', compact('productos'));
    }

    /**
     * Formulario para crear un producto.
     */
    public function create()
    {
        $categorias = Categoria::all();
        return view('Backend.Admin.productos.create', compact('categorias'));
    }

    /**
     * Guardar un nuevo producto.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre'       => 'required|string|max:255',
            'categoria_id' => 'required|exists:categorias,id',
            'precio'       => 'required|numeric|min:0',
            'descripcion'  => 'nullable|string',
            'imagen'       => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'es_nuevo'     => 'nullable|boolean',
            'activo'       => 'nullable|boolean',
            'stock'        => 'nullable|integer|min:0',
        ]);

        // Guardar imagen
        $imagenRuta = $request->file('imagen')->store('productos', 'public');

        Producto::create([
            'nombre'       => $request->nombre,
            'slug'         => Str::slug($request->nombre),
            'categoria_id' => $request->categoria_id,
            'precio'       => $request->precio,
            'descripcion'  => $request->descripcion,
            'imagen_ruta'  => $imagenRuta,
            'es_nuevo'     => $request->boolean('es_nuevo'),
            'activo'       => $request->boolean('activo', true),
            'stock'        => $request->stock ?? 0,
        ]);

        return redirect()->route('admin.productos.index')->with('exito', 'Producto creado correctamente.');
    }

    /**
     * Mostrar un producto específico.
     */
    public function show(Producto $producto)
    {
        return redirect()->route('admin.productos.edit', $producto);
    }

    /**
     * Formulario para editar un producto.
     */
    public function edit(Producto $producto)
    {
        $categorias = Categoria::all();
        return view('Backend.Admin.productos.edit', compact('producto', 'categorias'));
    }

    /**
     * Actualizar un producto existente.
     */
    public function update(Request $request, Producto $producto)
    {
        $request->validate([
            'nombre'       => 'required|string|max:255',
            'categoria_id' => 'required|exists:categorias,id',
            'precio'       => 'required|numeric|min:0',
            'descripcion'  => 'nullable|string',
            'imagen'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'es_nuevo'     => 'nullable|boolean',
            'activo'       => 'nullable|boolean',
            'stock'        => 'nullable|integer|min:0',
        ]);

        $datos = [
            'nombre'       => $request->nombre,
            'slug'         => Str::slug($request->nombre),
            'categoria_id' => $request->categoria_id,
            'precio'       => $request->precio,
            'descripcion'  => $request->descripcion,
            'es_nuevo'     => $request->boolean('es_nuevo'),
            'activo'       => $request->boolean('activo', true),
            'stock'        => $request->stock ?? $producto->stock,
        ];

        // Si se sube una nueva imagen, reemplazar la anterior
        if ($request->hasFile('imagen')) {
            // Borrar imagen anterior si existe
            if ($producto->imagen_ruta && Storage::disk('public')->exists($producto->imagen_ruta)) {
                Storage::disk('public')->delete($producto->imagen_ruta);
            }
            $datos['imagen_ruta'] = $request->file('imagen')->store('productos', 'public');
        }

        $producto->update($datos);

        return redirect()->route('admin.productos.index')->with('exito', 'Producto actualizado correctamente.');
    }

    /**
     * Eliminar un producto (soft delete).
     */
    public function destroy(Producto $producto)
    {
        // Borrar imagen del storage
        if ($producto->imagen_ruta && Storage::disk('public')->exists($producto->imagen_ruta)) {
            Storage::disk('public')->delete($producto->imagen_ruta);
        }

        $producto->delete();

        return redirect()->route('admin.productos.index')->with('exito', 'Producto eliminado correctamente.');
    }
}
