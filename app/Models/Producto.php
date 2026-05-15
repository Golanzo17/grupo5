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
}
