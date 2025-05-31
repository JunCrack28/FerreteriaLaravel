<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Usuario extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    protected $table = 'usuarios'; 

    protected $fillable = [
        'nombre',
        'contrasena',
        'telefono',
        'fecha_registro',
        'correo',
        'tipo_usuario',
        'ruta_imagen_usuario',
    ];

    protected $hidden = [
        'contrasena',
    ];

    // Método para obtener las órdenes del usuario
    public function ordenes()
    {
        return $this->hasMany(Orden::class, 'id_usuario');
    }
    
    // Métodos requeridos por la interfaz JWTSubject
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [
            'nombre' => $this->nombre,
            'correo' => $this->correo,
            'tipo_usuario' => $this->tipo_usuario,
        ];
    }
}