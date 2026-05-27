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
            'nombre'   => 'required|string|max:255',
            'email'    => 'required|email|unique:usuarios,email,' . $usuario->id,
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $usuario->nombre = $request->nombre;
        $usuario->email  = $request->email;

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
