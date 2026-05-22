<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;
    protected $table    = 'usuarios';
    protected $fillable = ['nombre', 'email', 'password', 'rol_id'];
    protected $hidden   = ['password', 'remember_token']; // nunca expuestos en JSON

    protected function casts(): array {
        return [
            'password' => 'hashed',       // hashea automáticamente al asignar
        ];
    }

    // Relación: un Usuario pertenece a un Rol  →  se usa como $usuario->rol
    public function rol() {
        return $this->belongsTo(Rol::class, 'rol_id');
    }

    // Relación: un Usuario tiene un Carrito
    public function cart() {
        return $this->hasOne(Cart::class, 'user_id');
    }
}
