<?php

namespace App\Http\Controllers;

use App\Models\Consulta;
use Illuminate\Http\Request;

class ConsultaController extends Controller
{
    /**
     * Guardar una nueva consulta
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:1000',
        ]);

        Consulta::create([
            'nombre' => $validated['nombre'],
            'email' => $validated['email'],
            'mensaje' => $validated['message'],
        ]);

        return response()->json(['success' => true, 'message' => '¡Consulta enviada correctamente!']);
    }

    /**
     * Obtener todas las consultas (para admin)
     */
    public function index()
    {
        $consultas = Consulta::latest()->paginate(15);
        return view('admin.consultas.index', compact('consultas'));
    }

    /**
     * Marcar como leída
     */
    public function marcarLeida(Consulta $consulta)
    {
        $consulta->update(['leida' => true]);
        return back()->with('success', 'Consulta marcada como leída');
    }

    /**
     * Eliminar una consulta
     */
    public function destroy(Consulta $consulta)
    {
        $consulta->delete();
        return back()->with('success', 'Consulta eliminada correctamente');
    }
}
