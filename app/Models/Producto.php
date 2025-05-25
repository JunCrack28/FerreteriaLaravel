<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';

    protected $fillable = [
        'codigo',
        'estado',
        'precio',
        'descripcion',
        'nombre_producto',
        'cantidad',
        'id_imagen',
        'id_categoria',
    ];

   
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria');
    }

 
    public function imagen()
    {
        return $this->belongsTo(ImagenProducto::class, 'id_imagen');
    }
}
