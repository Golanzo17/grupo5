<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Rol;

class AuthController extends Controller
{
    /**
     * Mostrar formulario de registro.
     */
    public function formularioRegistro()
    {
        return view('Backend.usuarios.registro');
    }

    /**
     * Mostrar formulario de login.
     */
    public function formularioLogin()
    {
        return view('Backend.usuarios.login');
    }

    /**
     * Procesar el registro de un nuevo usuario.
     */
    public function registrar(Request $request)
    {
        $request->validate([
            'nombre'   => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:usuarios',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Obtener el rol de cliente por defecto
        $rolCliente = Rol::where('nombre', 'cliente')->first();
        $rolId = $rolCliente ? $rolCliente->id : 2;

        // Crear el usuario
        $user = Usuario::create([
            'nombre'  => $request->nombre,
            'email'   => $request->email,
            'password' => $request->password, // Hasheado automáticamente por el cast del modelo
            'rol_id'  => $rolId,
        ]);

        // Iniciar sesión automáticamente después del registro
        Auth::login($user);

        // Redirigir según el rol
        return redirect('/cliente');
    }

    /**
     * Procesar el login (autenticación).
     */
    public function autenticar(Request $request)
    {
        $credenciales = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credenciales)) {
            $request->session()->regenerate();

            // Redirigir según el rol del usuario
            if (Auth::user()->rol->nombre === 'admin') {
                return redirect('/admin');
            }

            return redirect('/cliente');
        }

        return back()->withErrors([
            'email' => 'Email o contraseña incorrectos.',
        ])->onlyInput('email');
    }

    /**
     * Cerrar sesión.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
