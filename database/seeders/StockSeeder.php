<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Producto;
use App\Models\Talle;

class StockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Limpiamos la tabla primero para evitar duplicados al correr el seeder varias veces
        DB::table('producto_talle')->truncate();

        // Obtenemos los talles y los primeros 15 productos
        $talles = Talle::all();
        $productos = Producto::take(15)->get();

        if ($talles->isEmpty() || $productos->isEmpty()) {
            return;
        }

        $inserts = [];
        foreach ($productos as $producto) {
            foreach ($talles as $talle) {
                // Asignamos un stock aleatorio entre 5 y 25 unidades por talle
                $inserts[] = [
                    'producto_id' => $producto->id,
                    'talle_id' => $talle->id,
                    'stock' => rand(5, 25),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        DB::table('producto_talle')->insert($inserts);
    }
}
