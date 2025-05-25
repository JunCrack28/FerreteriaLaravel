<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ImagenProductoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\OrdenController;


Route::get('/', function () {
    return view('index');
});

Route::get('/usuarios/lista', [UsuarioController::class, 'lista'])->name('usuarios.lista');

Route::get('/usuarios', [UsuarioController::class, 'index'])->name('usuarios.index');

Route::resource('imagenes', ImagenProductoController::class);

Route::resource('categorias', CategoriaController::class);

Route::resource('ordenes', OrdenController::class);

