<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RolMiddleware
{
    /**
     * Verifica que el usuario autenticado tenga el rol requerido.
     *
     * Uso en rutas: middleware('rol:admin') o middleware('rol:cliente')
     */
    public function handle(Request $request, Closure $next, string $rol): Response
    {
        // Si no está autenticado, redirigir al login
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'Debés iniciar sesión.');
        }

        // Verificar el rol del usuario
        if (Auth::user()->rol->nombre !== $rol) {
            // Si es admin intentando ir a cliente, o viceversa, redirigir a su panel
            if (Auth::user()->rol->nombre === 'admin') {
                return redirect('/admin')->with('error', 'No tenés acceso a esa sección.');
            }

            return redirect('/cliente')->with('error', 'No tenés acceso a esa sección.');
        }

        return $next($request);
    }
}
