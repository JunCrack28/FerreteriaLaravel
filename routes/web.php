<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ImagenProductoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\OrdenController;
use App\Http\Controllers\ProductoController;

Route::get('/', function () {
    return view('index');
});

Route::get('/usuarios/lista', [UsuarioController::class, 'lista'])->name('usuarios.lista');

Route::resource('usuarios', UsuarioController::class);

Route::resource('imagenes', ImagenProductoController::class);

Route::resource('categorias', CategoriaController::class);

Route::resource('ordenes', OrdenController::class);

Route::resource('productos', ProductoController::class);