<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orden extends Model
{
    use HasFactory;

    protected $table = 'ordenes'; 

    protected $fillable = [
        'cantidad_orden',
        'estado_pago',
        'fecha_orden',
        'telefono',
        'id_usuario',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario');
    }


     public function ordenes()
    {
        return $this->hasMany(Producto::class, 'id_orden');
    }

     public function productos()
    {
        return $this->hasMany(Producto::class, 'id_producto');
    }
}
