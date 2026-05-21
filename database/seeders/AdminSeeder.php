<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Usuario;
use App\Models\Rol;

class AdminSeeder extends Seeder
{
    /**
     * Crear el usuario administrador por defecto.
     */
    public function run(): void
    {
        $rolAdmin = Rol::where('nombre', 'admin')->first();

        if ($rolAdmin) {
            Usuario::firstOrCreate(
                ['email' => 'admin@westside.com'],
                [
                    'nombre'   => 'Administrador',
                    'password' => 'password',  // Hasheado automáticamente por el cast del modelo
                    'rol_id'   => $rolAdmin->id,
                ]
            );
        }
    }
}
