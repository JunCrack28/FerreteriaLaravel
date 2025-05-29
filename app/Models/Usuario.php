<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

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

     public function ordenes()
    {
        return $this->hasMany(Orden::class, 'id_usuario');
    }
    
}
