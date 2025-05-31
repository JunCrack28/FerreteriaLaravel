<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ImagenProductoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\OrdenController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\AuthController;


Route::get('/', function () {
    return view('index');
});

Route::get('/usuarios/lista', [UsuarioController::class, 'lista'])->name('usuarios.lista');

Route::resource('usuarios', UsuarioController::class);

Route::resource('imagenes', ImagenProductoController::class);

Route::resource('categorias', CategoriaController::class);

Route::resource('ordenes', OrdenController::class);

Route::resource('productos', ProductoController::class);




Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback']);

// Mantén /me con el middleware jwt si necesitas que esté protegido
Route::middleware('jwt')->group(function () {
    Route::get('/me', [AuthController::class, 'me'])->name('me');
});

// Ruta para logout sin middleware jwt
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::resource('usuarios', UsuarioController::class);


