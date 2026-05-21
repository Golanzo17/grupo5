<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoriaController extends Controller
{
    /**
     * Listar todas las categorías.
     */
    public function index()
    {
        $categorias = Categoria::withCount('productos')->latest()->get();
        return view('Backend.Admin.categorias.index', compact('categorias'));
    }

    /**
     * Formulario para crear una categoría.
     */
    public function create()
    {
        return view('Backend.Admin.categorias.create');
    }

    /**
     * Guardar una nueva categoría.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100|unique:categorias',
        ]);

        Categoria::create([
            'nombre' => $request->nombre,
            'slug'   => Str::slug($request->nombre),
        ]);

        return redirect()->route('admin.categorias.index')->with('exito', 'Categoría creada correctamente.');
    }

    /**
     * Mostrar una categoría.
     */
    public function show(Categoria $categoria)
    {
        return redirect()->route('admin.categorias.edit', $categoria);
    }

    /**
     * Formulario para editar una categoría.
     */
    public function edit(Categoria $categoria)
    {
        return view('Backend.Admin.categorias.edit', compact('categoria'));
    }

    /**
     * Actualizar una categoría existente.
     */
    public function update(Request $request, Categoria $categoria)
    {
        $request->validate([
            'nombre' => 'required|string|max:100|unique:categorias,nombre,' . $categoria->id,
        ]);

        $categoria->update([
            'nombre' => $request->nombre,
            'slug'   => Str::slug($request->nombre),
        ]);

        return redirect()->route('admin.categorias.index')->with('exito', 'Categoría actualizada correctamente.');
    }

    /**
     * Eliminar una categoría.
     */
    public function destroy(Categoria $categoria)
    {
        // Verificar que no tenga productos asociados
        if ($categoria->productos()->count() > 0) {
            return redirect()->route('admin.categorias.index')
                ->with('error', 'No se puede eliminar una categoría con productos asociados.');
        }

        $categoria->delete();

        return redirect()->route('admin.categorias.index')->with('exito', 'Categoría eliminada correctamente.');
    }
}
