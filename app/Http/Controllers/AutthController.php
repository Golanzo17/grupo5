<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Usuario;
use App\Models\Rol;

class AutthController extends Controller
{


    public function formularioRegistro() {
        return view('Backend.usuarios.registro');
    }

    public function formularioLogin() {
        return view('Backend.usuarios.login');
    }

    public function registrar(Request $request) {
        // Validar los datos del formulario
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:usuarios',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Obtener el rol de cliente por defecto
        $rolCliente = Rol::where('nombre', 'cliente')->first();
        $rolId = $rolCliente ? $rolCliente->id : 2;


        public function autenticar(Request $request)
{
    // Valida que lleguen el email y la password
    $credenciales = $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);
    // Auth::attempt() busca el usuario en la BD por email y compara la contraseña
    if (Auth::attempt($credenciales)) {
        $request->session()->regenerate();
        // Accedemos al nombre del rol a través de la relación
        if (Auth::user()->rol->nombre === 'admin') {
            return redirect('/admin');
        }
        return redirect('/cliente'); // Si no es admin, es cliente
    }
    // Si las credenciales son incorrectas, vuelve al login con error
    return back()->withErrors([
        'email' => 'Email o contraseña incorrectos',
    ]);
}

        // Crear el usuario
        $user = Usuario::create([
            'nombre' => $request->name,
            'email' => $request->email,
            'password' => $request->password, // Hasheado automáticamente por el cast del modelo Usuario
            'rol_id' => $rolId,
        ]);

        // Iniciar sesión automáticamente después del registro
        auth()->login($user);

        // Redirigir a la página principal
        return redirect('/');
    }
}
