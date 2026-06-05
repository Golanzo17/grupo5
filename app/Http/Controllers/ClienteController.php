<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ClienteController extends Controller
{
    /**
     * Dashboard del cliente.
     */
    public function dashboard()
    {
        $usuario = Auth::user();
        return view('Backend.usuarios.cliente', compact('usuario'));
    }

    /**
     * Mostrar perfil del cliente.
     */
    public function perfil()
    {
        $usuario = Auth::user();
        return view('Backend.usuarios.perfil', compact('usuario'));
    }

    /**
     * Actualizar perfil del cliente.
     */
    public function actualizarPerfil(Request $request)
    {
        $usuario = Auth::user();

        $request->validate([
            'nombre'        => 'required|string|max:255',
            'apellido'      => 'nullable|string|max:255',
            'email'         => 'required|email|unique:usuarios,email,' . $usuario->id,
            'telefono'      => 'nullable|string|max:20',
            'direccion'     => 'nullable|string|max:255',
            'ciudad'        => 'nullable|string|max:255',
            'codigo_postal' => 'nullable|string|max:20',
            'password'      => 'nullable|string|min:8|confirmed',
        ]);

        $usuario->nombre        = $request->nombre;
        $usuario->apellido      = $request->apellido;
        $usuario->email         = $request->email;
        $usuario->telefono      = $request->telefono;
        $usuario->direccion     = $request->direccion;
        $usuario->ciudad        = $request->ciudad;
        $usuario->codigo_postal = $request->codigo_postal;

        if ($request->filled('password')) {
            $usuario->password = $request->password;
        }

        $usuario->save();

        return redirect()->route('cliente.perfil')->with('exito', 'Perfil actualizado correctamente.');
    }

    /**
     * Historial de compras del cliente.
     */
    public function compras()
    {
        $ordenes = \App\Models\Order::with(['items.producto', 'items.talle'])
                        ->where('user_id', Auth::id())
                        ->orderBy('created_at', 'desc')
                        ->get();
                        
        return view('Backend.usuarios.compras', compact('ordenes'));
    }
}
