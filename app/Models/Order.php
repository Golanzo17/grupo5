<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id', 'total', 'estado', 'metodo_pago', 'tipo_entrega',
        'nombre', 'apellido', 'telefono', 'direccion', 'ciudad',
        'codigo_postal', 'notas'
    ];

    public function user()
    {
        return $this->belongsTo(Usuario::class, 'user_id');
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
