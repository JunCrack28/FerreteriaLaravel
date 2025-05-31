<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('contrasena');
            $table->string('telefono'); 
            $table->date('fecha_registro');
            $table->string('correo')->unique();
            $table->integer('tipo_usuario')->unsigned()->comment('1 = Administrador, 2 = Cliente');
            $table->string('ruta_imagen_usuario');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};