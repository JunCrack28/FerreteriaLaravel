<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo');
            $table->boolean('estado'); 
            $table->integer('precio');
            $table->string('descripcion');
            $table->string('nombre_producto');
            $table->integer('cantidad');
            $table->foreignId('id_imagen')->constrained('imagenes_productos')->onDelete('cascade');
            $table->foreignId('id_categoria')->constrained('categorias')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
