<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Support\Str;

class ProductosEstaticosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productos = [
            ['nombre' => 'Buzo Altered Black', 'precio' => 45000, 'imagen' => '/images/Catalogo/ropa/Buzo-Altered-black.webp', 'cat' => 'buzos', 'destacado' => true],
            ['nombre' => 'Remera TREWA Boxy', 'precio' => 24000, 'imagen' => '/images/Catalogo/ropa/Remera-Trewa-Boxy.webp', 'cat' => 'remeras', 'destacado' => false],
            ['nombre' => 'Remera Hendryx', 'precio' => 45000, 'imagen' => '/images/Catalogo/ropa/Remera-Hendrix.webp', 'cat' => 'remeras', 'destacado' => false],
            ['nombre' => 'Jean Golden Resilence', 'precio' => 55000, 'imagen' => '/images/Catalogo/ropa/Jean-Resilence.jpeg', 'cat' => 'pantalones', 'destacado' => false],
            ['nombre' => 'Remera VISIONS', 'precio' => 24000, 'imagen' => '/images/Catalogo/ropa/Remera-Visions.webp', 'cat' => 'remeras', 'destacado' => true],
            ['nombre' => 'Pantalon Wonder Blue', 'precio' => 69990, 'imagen' => '/images/Catalogo/ropa/Pant-Wonder-Blue.webp', 'cat' => 'pantalones', 'destacado' => true],
            ['nombre' => 'Chaqueta Wonder Blue', 'precio' => 129990, 'imagen' => '/images/Catalogo/ropa/Jacket-Wonder-Blue.webp', 'cat' => 'chaquetas', 'destacado' => true],
            ['nombre' => 'Chomba Ibiza Grey', 'precio' => 59990, 'imagen' => '/images/Catalogo/ropa/Chomba-Ibiza-Grey.webp', 'cat' => 'chombas', 'destacado' => false],
            ['nombre' => 'Pantalon Jagger Brown', 'precio' => 79990, 'imagen' => '/images/Catalogo/ropa/Pant-Jagger-Brown.webp', 'cat' => 'pantalones', 'destacado' => false],
            ['nombre' => 'Remera Oslo', 'precio' => 45000, 'imagen' => '/images/Catalogo/ropa/Remera-Oslo.webp', 'cat' => 'remeras', 'destacado' => false],
            ['nombre' => 'Jean 5202', 'precio' => 65000, 'imagen' => '/images/Catalogo/ropa/5202-Delante.jpeg', 'cat' => 'pantalones', 'destacado' => false],
            ['nombre' => 'Baggy Bangal', 'precio' => 65000, 'imagen' => '/images/Catalogo/ropa/Baggy-Bangal.jpeg', 'cat' => 'pantalones', 'destacado' => false],
            ['nombre' => 'Baggy Rockstar', 'precio' => 65000, 'imagen' => '/images/Catalogo/ropa/Baggy-Rockstar-.jpeg', 'cat' => 'pantalones', 'destacado' => false],
            ['nombre' => 'Baggy Rose', 'precio' => 65000, 'imagen' => '/images/Catalogo/ropa/Baggy-Rose.jpeg', 'cat' => 'pantalones', 'destacado' => false],
            ['nombre' => 'Buzo Coffee Black', 'precio' => 60000, 'imagen' => '/images/Catalogo/ropa/Buzo-Coffee-black.webp', 'cat' => 'buzos', 'destacado' => false],
            ['nombre' => 'Buzo Polo Zipper Chocolate', 'precio' => 70000, 'imagen' => '/images/Catalogo/ropa/Buzo-Polo-Zipper-Chocolate.webp', 'cat' => 'buzos', 'destacado' => false],
            ['nombre' => 'Buzo Viena Dark Green', 'precio' => 60000, 'imagen' => '/images/Catalogo/ropa/Buzo-Viena-Dark-Green.webp', 'cat' => 'buzos', 'destacado' => false],
            ['nombre' => 'Campera Chaos Oscura', 'precio' => 90000, 'imagen' => '/images/Catalogo/ropa/CAMPERA-CHAOS-OSCURA.jpeg', 'cat' => 'chaquetas', 'destacado' => false],
            ['nombre' => 'Pantalon Dust', 'precio' => 65000, 'imagen' => '/images/Catalogo/ropa/Pantalon-Dust.jpeg', 'cat' => 'pantalones', 'destacado' => false],
            ['nombre' => 'Remera Tee Madrid', 'precio' => 40000, 'imagen' => '/images/Catalogo/ropa/Remera-Tee-Madrid.webp', 'cat' => 'remeras', 'destacado' => false],
            ['nombre' => 'Remera Tee Metro', 'precio' => 40000, 'imagen' => '/images/Catalogo/ropa/Remera-Tee-Metro.webp', 'cat' => 'remeras', 'destacado' => false],
            ['nombre' => 'Remera Tee Slash', 'precio' => 40000, 'imagen' => '/images/Catalogo/ropa/Remera-Tee-Slash.webp', 'cat' => 'remeras', 'destacado' => false],
            ['nombre' => 'Jean Rulesstar', 'precio' => 65000, 'imagen' => '/images/Catalogo/ropa/Rulesstar-Frente-.jpeg', 'cat' => 'pantalones', 'destacado' => false],
            ['nombre' => 'Buzo Polo Zipper Negro', 'precio' => 70000, 'imagen' => '/images/Catalogo/ropa/Buzo-Polo-Zipper-Negro.webp', 'cat' => 'buzos', 'destacado' => false],
            ['nombre' => 'Buzo Varo Ivory', 'precio' => 60000, 'imagen' => '/images/Catalogo/ropa/Buzo-Varo-Ivory.webp', 'cat' => 'buzos', 'destacado' => false],
            ['nombre' => 'Buzo Varo Negro', 'precio' => 60000, 'imagen' => '/images/Catalogo/ropa/Buzo-Varo-Negro.webp', 'cat' => 'buzos', 'destacado' => false],
            ['nombre' => 'Buzo Viena Ivory', 'precio' => 60000, 'imagen' => '/images/Catalogo/ropa/Buzo-Viena-Ivory.webp', 'cat' => 'buzos', 'destacado' => false],
            ['nombre' => 'Camisa Edge Ivory', 'precio' => 55000, 'imagen' => '/images/Catalogo/ropa/Camisa-Edge-Ivory.webp', 'cat' => 'camisas', 'destacado' => false],
            ['nombre' => 'Camisa Edge Tan', 'precio' => 55000, 'imagen' => '/images/Catalogo/ropa/Camisa-Edge-Tan.webp', 'cat' => 'camisas', 'destacado' => false],
            ['nombre' => 'Camisa Londres Azul', 'precio' => 55000, 'imagen' => '/images/Catalogo/ropa/Camisa-Londres-Azul.webp', 'cat' => 'camisas', 'destacado' => false],
            ['nombre' => 'Camisa Londres Celeste', 'precio' => 55000, 'imagen' => '/images/Catalogo/ropa/Camisa-Londres-Celeste.webp', 'cat' => 'camisas', 'destacado' => false],
            ['nombre' => 'Chomba Milan Negra', 'precio' => 55000, 'imagen' => '/images/Catalogo/ropa/Chomba-Milan-Negra.webp', 'cat' => 'chombas', 'destacado' => false],
            ['nombre' => 'Chomba Milan Tan', 'precio' => 55000, 'imagen' => '/images/Catalogo/ropa/Chomba-Milan-Tan.webp', 'cat' => 'chombas', 'destacado' => false],
            ['nombre' => 'Chomba Milan Verde', 'precio' => 55000, 'imagen' => '/images/Catalogo/ropa/Chomba-Milan-Verde.webp', 'cat' => 'chombas', 'destacado' => false],
            ['nombre' => 'Remera Oslo Gris', 'precio' => 45000, 'imagen' => '/images/Catalogo/ropa/Remera-Oslo-Gris.webp', 'cat' => 'remeras', 'destacado' => false],
            ['nombre' => 'Remera Oslo Negra', 'precio' => 45000, 'imagen' => '/images/Catalogo/ropa/Remera-Oslo-Negra.webp', 'cat' => 'remeras', 'destacado' => false],
            ['nombre' => 'Remera Tee Barcelona Ivory', 'precio' => 45000, 'imagen' => '/images/Catalogo/ropa/Remera-Tee-Barcelona-Ivory.webp', 'cat' => 'remeras', 'destacado' => false],
            ['nombre' => 'Remera Tee Barcelona Tan', 'precio' => 45000, 'imagen' => '/images/Catalogo/ropa/Remera-Tee-Barcelona-Tan.webp', 'cat' => 'remeras', 'destacado' => false],
            ['nombre' => 'Remera Tee Morrison Black', 'precio' => 35000, 'imagen' => '/images/Catalogo/ropa/Remera-Tee-Morrison-Black.webp', 'cat' => 'remeras', 'destacado' => false],
            ['nombre' => 'Remera Tee Morrison Gris', 'precio' => 35000, 'imagen' => '/images/Catalogo/ropa/Remera-Tee-Morrison-Gris.webp', 'cat' => 'remeras', 'destacado' => false],
            ['nombre' => 'Remera Tee Primavera Bordeaux', 'precio' => 35000, 'imagen' => '/images/Catalogo/ropa/Remera-Tee-Primavera- Bordeaux.webp', 'cat' => 'remeras', 'destacado' => false],
            ['nombre' => 'Remera Tee Primavera Navy', 'precio' => 35000, 'imagen' => '/images/Catalogo/ropa/Remera-Tee-Primavera- navy.webp', 'cat' => 'remeras', 'destacado' => false],
            ['nombre' => 'Remera Tee Rio Navy', 'precio' => 35000, 'imagen' => '/images/Catalogo/ropa/Remera-Tee-Rio-Navy.jpg', 'cat' => 'remeras', 'destacado' => false],
            ['nombre' => 'Remera Tee Sky Ivory', 'precio' => 35000, 'imagen' => '/images/Catalogo/ropa/Remera-Tee-Sky-Ivory.webp', 'cat' => 'remeras', 'destacado' => false],
            ['nombre' => 'Remera Tee Stanley Tan', 'precio' => 40000, 'imagen' => '/images/Catalogo/ropa/Remera-Tee-Stanley-Tan.webp', 'cat' => 'remeras', 'destacado' => false],
        ];

        // Cache de IDs de categorías para no consultar la DB en cada iteración
        $categoriasIds = [];

        foreach ($productos as $prod) {
            if (!isset($categoriasIds[$prod['cat']])) {
                $categoria = Categoria::where('slug', $prod['cat'])->first();
                if ($categoria) {
                    $categoriasIds[$prod['cat']] = $categoria->id;
                }
            }

            if (isset($categoriasIds[$prod['cat']])) {
                Producto::firstOrCreate(
                    ['slug' => Str::slug($prod['nombre'])],
                    [
                        'nombre' => $prod['nombre'],
                        'precio' => $prod['precio'],
                        'imagen_ruta' => $prod['imagen'],
                        'categoria_id' => $categoriasIds[$prod['cat']],
                        'es_nuevo' => $prod['destacado'],
                        'stock' => 10,
                        'descripcion' => 'Descripción breve para ' . $prod['nombre']
                    ]
                );
            }
        }
        
        // Agregar productos de Barbería
        $productosBarberia = [
            ['nombre' => 'Hair Powder OBO', 'precio' => 20000, 'imagen' => '/images/Catalogo/barbershop/polvo-texturizador.jpg', 'cat' => 'barbería', 'destacado' => false],
            ['nombre' => 'Cera Mate OBO', 'precio' => 12000, 'imagen' => '/images/Catalogo/barbershop/cera-mate.jpg', 'cat' => 'barbería', 'destacado' => false],
            ['nombre' => 'Hair Spray SirFausto', 'precio' => 15000, 'imagen' => '/images/Catalogo/barbershop/gel-fijador.jpg', 'cat' => 'barbería', 'destacado' => false],
            ['nombre' => 'Pomada Clasica SirFausto', 'precio' => 12000, 'imagen' => '/images/Catalogo/barbershop/cera-brillante.jpg', 'cat' => 'barbería', 'destacado' => false],
            ['nombre' => 'Pomada Opaca SirFausto', 'precio' => 12000, 'imagen' => '/images/Catalogo/barbershop/mascara-matizadora.jpg', 'cat' => 'barbería', 'destacado' => false],
        ];
        
        $catBarberia = Categoria::where('slug', 'barberia')->first();
        if ($catBarberia) {
            foreach ($productosBarberia as $prod) {
                Producto::firstOrCreate(
                    ['slug' => Str::slug($prod['nombre'])],
                    [
                        'nombre' => $prod['nombre'],
                        'precio' => $prod['precio'],
                        'imagen_ruta' => $prod['imagen'],
                        'categoria_id' => $catBarberia->id,
                        'es_nuevo' => $prod['destacado'],
                        'stock' => 10,
                        'descripcion' => 'Descripción breve para ' . $prod['nombre']
                    ]
                );
            }
        }
    }
}
