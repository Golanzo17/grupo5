<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Categoria;
use App\Models\Producto;


class DatabaseSeeder extends Seeder
{


    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        // 1. Creamos las Categorías
        $catRemeras = Categoria::create(['nombre' => 'Remeras']);
        $catPantalones = Categoria::create(['nombre' => 'Pantalones']);
        $catBuzos = Categoria::create(['nombre' => 'Buzos']);
        
        // 2. Creamos los Productos

        // Agregamos un producto a la categoría de Buzos:
        Producto::create([
            'categoria_id' => $catBuzos->id, // << Aquí hacemos la conexión usando la variable
            
            'nombre' => 'Buzo Altered Black',
            'descripcion' => 'Diseñado para destacar, el buzo "ALTERED" combina estilo urbano con comodidad absoluta. Con un corte boxy fit que aporta un calce amplio y moderno, este buzo es ideal para quienes buscan un look relajado sin perder presencia.

Confeccionado en algodón frisado de alta calidad, ofrece abrigo suave por dentro, ideal para los días frescos. Presenta detalles gráficos imponentes: número "00" y texto "VISION" al frente, estampas en mangas tipo llamas y frase en el cuello para un plus de identidad visual.',
             'stock' => 15, // Aquí agregamos el stock
            'precio' => 45000.00, 
            'imagen_frente' => '/images/product.png',
            'imagen_espalda' => '/images/product-back.png', // Opcional, si la tienes
            'imagen_detalle' => null // Podemos poner 'null' si no tenemos foto de detalle aún
        ]);

         // ---- PRODUCTO 2: REMERAS ----
        Producto::create([
            'categoria_id' => $catRemeras->id, 
            'nombre' => 'Remera TREWA Boxy',
            'descripcion' => 'Una prenda de estilo ATHLETIC.

Confeccionada en jersey puro algodón, con calce Boxy y estampa en serigrafía en el pecho.',
            'stock' => 30, // Tenemos bastantes remeras
            'precio' => 24000.00, 
            
            'imagen_frente' => '/images/product.png',
            'imagen_espalda' => null, 
            'imagen_detalle' => null 
        ]);

        // ---- PRODUCTO 3: PANTALONES ----
        Producto::create([
            'categoria_id' => $catPantalones->id, 
            'nombre' => 'Golden Resilence',
            'descripcion' => 'Elevá tu estilo con este pantalón de jean de corte amplio (wide leg), ideal para quienes buscan un look urbano con personalidad. Su lavado gris oscuro con efecto desgastado le da un aire vintage único, mientras que el bordado trasero en tono dorado aporta un detalle distintivo y de alta calidad que no pasa desapercibido.',
            'stock' => 8, // Quedan pocos
            'precio' => 55000.00, 
            
            'imagen_frente' => '/images/product.png',
            'imagen_espalda' => '/images/product-back.png', 
            'imagen_detalle' => '/images/product-detail.png' 
        ]);
    }
}
