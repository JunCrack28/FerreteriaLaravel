<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGoogleIdToUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('usuarios', function (Blueprint $table) {
            $table->string('google_id')->nullable()->after('correo');
            $table->string('telefono')->nullable()->change();
            $table->date('fecha_registro')->nullable()->change();
            $table->string('ruta_imagen_usuario')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('usuarios', function (Blueprint $table) {
            $table->dropColumn('google_id');
            $table->string('telefono')->nullable(false)->change();
            $table->date('fecha_registro')->nullable(false)->change();
            $table->string('ruta_imagen_usuario')->nullable(false)->change();
        });
    }
}