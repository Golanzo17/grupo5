<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Talle;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

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
        $talles = Talle::all();
        return view('Backend.Admin.productos.create', compact('categorias', 'talles'));
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
            'talles'       => 'nullable|array',
            'talles.*'     => 'nullable|integer|min:0',
        ]);

        // Optimizar, redimensionar y convertir imagen a WebP
        $manager = new ImageManager(new Driver());
        $image = $manager->read($request->file('imagen'));
        $image->scaleDown(width: 1000); // Max width 1000px
        $encoded = $image->toWebp(quality: 80);
        
        $filename = 'productos/' . uniqid() . '.webp';
        Storage::disk('public')->put($filename, $encoded->toString());
        $imagenRuta = $filename;

        // Generar slug único
        $slug = Str::slug($request->nombre);
        $slugCount = Producto::withTrashed()->where('slug', 'like', $slug . '%')->count();
        $slugFinal = $slugCount ? "{$slug}-{$slugCount}" : $slug;

        $producto = Producto::create([
            'nombre'       => $request->nombre,
            'slug'         => $slugFinal,
            'categoria_id' => $request->categoria_id,
            'precio'       => $request->precio,
            'descripcion'  => $request->descripcion,
            'imagen_ruta'  => $imagenRuta,
            'es_nuevo'     => $request->boolean('es_nuevo'),
            'activo'       => $request->boolean('activo', true),
        ]);

        if ($request->has('talles')) {
            $tallesData = [];
            foreach ($request->talles as $talleId => $stock) {
                if ($stock !== null && $stock !== '') {
                    $tallesData[$talleId] = ['stock' => $stock];
                }
            }
            $producto->talles()->attach($tallesData);
        }

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
        $talles = Talle::all();
        return view('Backend.Admin.productos.edit', compact('producto', 'categorias', 'talles'));
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
            'talles'       => 'nullable|array',
            'talles.*'     => 'nullable|integer|min:0',
        ]);

        // Generar slug único (excluyendo el producto actual)
        $slug = Str::slug($request->nombre);
        $slugCount = Producto::withTrashed()->where('slug', 'like', $slug . '%')->where('id', '!=', $producto->id)->count();
        $slugFinal = $slugCount ? "{$slug}-{$slugCount}" : $slug;

        $datos = [
            'nombre'       => $request->nombre,
            'slug'         => $slugFinal,
            'categoria_id' => $request->categoria_id,
            'precio'       => $request->precio,
            'descripcion'  => $request->descripcion,
            'es_nuevo'     => $request->boolean('es_nuevo'),
            'activo'       => $request->boolean('activo', true),
        ];

        // Si se sube una nueva imagen, optimizarla y reemplazar la anterior
        if ($request->hasFile('imagen')) {
            // Borrar imagen anterior si existe
            if ($producto->imagen_ruta && Storage::disk('public')->exists($producto->imagen_ruta)) {
                Storage::disk('public')->delete($producto->imagen_ruta);
            }
            
            $manager = new ImageManager(new Driver());
            $image = $manager->read($request->file('imagen'));
            $image->scaleDown(width: 1000);
            $encoded = $image->toWebp(quality: 80);
            
            $filename = 'productos/' . uniqid() . '.webp';
            Storage::disk('public')->put($filename, $encoded->toString());
            
            $datos['imagen_ruta'] = $filename;
        }

        $producto->update($datos);

        if ($request->has('talles')) {
            $tallesData = [];
            foreach ($request->talles as $talleId => $stock) {
                if ($stock !== null && $stock !== '') {
                    $tallesData[$talleId] = ['stock' => $stock];
                }
            }
            $producto->talles()->sync($tallesData);
        }

        return redirect()->route('admin.productos.index')->with('exito', 'Producto actualizado correctamente.');
    }

    /**
     * Eliminar un producto (soft delete).
     */
    public function destroy(Producto $producto)
    {
        // Soft delete: NO borramos la imagen para poder restaurar el producto
        $producto->delete();

        return redirect()->route('admin.productos.index')->with('exito', 'Producto eliminado correctamente.');
    }
}
