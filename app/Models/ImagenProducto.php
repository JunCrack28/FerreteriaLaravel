<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagenProducto extends Model
{
    use HasFactory;

    protected $table = 'imagenes_productos';
    protected $fillable = [
        'tipo',
        'ruta_imagen',
    ];

    public function productos()
    {
        return $this->hasMany(Producto::class, 'id_imagen');
    }
}
