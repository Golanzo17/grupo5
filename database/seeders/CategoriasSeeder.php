<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categoria;
use Illuminate\Support\Str;

class CategoriasSeeder extends Seeder
{
    /**
     * Crear categorías iniciales.
     */
    public function run(): void
    {
        $categorias = [
            'Remeras',
            'Buzos',
            'Pantalones',
            'Accesorios',
            'Barbería',
            'Chaquetas',
            'Chombas',
            'Camisas',
        ];

        foreach ($categorias as $nombre) {
            Categoria::firstOrCreate(
                ['slug' => Str::slug($nombre)],
                [
                    'nombre' => $nombre,
                    'slug'   => Str::slug($nombre),
                ]
            );
        }
    }
}
