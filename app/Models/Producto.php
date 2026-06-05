<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Producto extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'categoria_id', 'nombre', 'slug', 'descripcion', 
        'precio', 'imagen_ruta', 'es_nuevo', 'activo'
    ];

    // Accessor: URL completa de la imagen (centraliza la lógica de rutas)
    public function getImagenUrlAttribute()
    {
        if (Str::startsWith($this->imagen_ruta, ['http', '/', 'images/'])) {
            return asset($this->imagen_ruta);
        }
        return asset('storage/' . $this->imagen_ruta);
    }

    // Relación: Un producto pertenece a una categoría
    public function categoria() {
        return $this->belongsTo(Categoria::class);
    }

    // Relación: Un producto tiene muchos talles
    public function talles()
    {
        return $this->belongsToMany(Talle::class, 'producto_talle')
                    ->withPivot('stock')
                    ->withTimestamps();
    }

    // Obtener el stock total del producto
    public function getStockTotalAttribute()
    {
        return $this->talles->sum('pivot.stock');
    }
}
