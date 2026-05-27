<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producto extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'categoria_id', 'nombre', 'slug', 'descripcion', 
        'precio', 'imagen_ruta', 'es_nuevo', 'activo'
    ];

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
