<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Usuario;
use App\Models\Rol;

class ClienteSeeder extends Seeder
{
    /**
     * Crear un usuario cliente de prueba.
     */
    public function run(): void
    {
        $rolCliente = Rol::where('nombre', 'cliente')->first();

        if ($rolCliente) {
            Usuario::firstOrCreate(
                ['email' => 'cliente@westside.com'],
                [
                    'nombre'   => 'Cliente de Prueba',
                    'password' => 'password01',  // Hasheado automáticamente por el cast del modelo
                    'rol_id'   => $rolCliente->id,
                ]
            );
        }
    }
}
