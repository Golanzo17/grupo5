<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Rol;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    /**
     * Listar todos los usuarios.
     */
    public function index()
    {
        $usuarios = Usuario::with('rol')->latest()->paginate(15);
        return view('Backend.Admin.usuarios.index', compact('usuarios'));
    }

    /**
     * Formulario para crear un nuevo usuario (desde admin).
     */
    public function create()
    {
        $roles = Rol::all();
        return view('Backend.Admin.usuarios.create', compact('roles'));
    }

    /**
     * Guardar un nuevo usuario.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre'   => 'required|string|max:100',
            'email'    => 'required|email|unique:usuarios',
            'password' => 'required|min:8|confirmed',
            'rol_id'   => 'required|exists:roles,id',
        ]);

        Usuario::create($request->only(['nombre', 'email', 'password', 'rol_id']));

        return redirect()->route('admin.usuarios.index')->with('exito', 'Usuario creado correctamente.');
    }

    /**
     * Mostrar un usuario.
     */
    public function show(Usuario $usuario)
    {
        return redirect()->route('admin.usuarios.edit', $usuario);
    }

    /**
     * Formulario para editar un usuario.
     */
    public function edit(Usuario $usuario)
    {
        $roles = Rol::all();
        return view('Backend.Admin.usuarios.edit', compact('usuario', 'roles'));
    }

    /**
     * Actualizar un usuario.
     */
    public function update(Request $request, Usuario $usuario)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'email'  => 'required|email|unique:usuarios,email,' . $usuario->id,
            'rol_id' => 'required|exists:roles,id',
            'password' => 'nullable|min:8|confirmed',
        ]);

        $usuario->nombre = $request->nombre;
        $usuario->email  = $request->email;
        $usuario->rol_id = $request->rol_id;

        if ($request->filled('password')) {
            $usuario->password = $request->password;
        }

        $usuario->save();

        return redirect()->route('admin.usuarios.index')->with('exito', 'Usuario actualizado correctamente.');
    }

    /**
     * Eliminar un usuario (soft delete).
     */
    public function destroy(Usuario $usuario)
    {
        $usuario->delete();
        return redirect()->route('admin.usuarios.index')->with('exito', 'Usuario eliminado correctamente.');
    }
}
