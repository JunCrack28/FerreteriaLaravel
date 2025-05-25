<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleOrden extends Model
{
    use HasFactory;

    protected $table = 'detalles_ordenes'; 

    protected $fillable = [
        'cantidad',
        'precio_unitario',
        'id_orden',
        'id_producto',
    ];

 
    public function orden()
    {
        return $this->belongsTo(Orden::class, 'id_orden');
    }

    
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto');
    }
}
