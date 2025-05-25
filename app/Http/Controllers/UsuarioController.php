<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function index()
{
    $usuarios = Usuario::all();
    return view('usuarios.index', compact('usuarios'));
}
public function lista()
{
    $usuarios = Usuario::all();
    return view('usuarios.lista', compact('usuarios')); // Cambia a lista.blade.php
}


    public function create()
    {
        return view('usuarios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'contrasena' => 'required',
            'telefono' => 'required',
            'fecha_registro' => 'required|date',
            'correo' => 'required|email',
            'tipo_usuario' => 'required|integer',
            'ruta_imagen_usuario' => 'required',
        ]);

        Usuario::create($request->all());
        return redirect()->route('usuarios.lista')->with('success', 'Usuario creado exitosamente.');
    }

    public function show(Usuario $usuario)
    {
        return view('usuarios.lista', compact('usuario'));
    }

    public function edit(Usuario $usuario)
    {
        return view('usuarios.edit', compact('usuario'));
    }

    public function update(Request $request, Usuario $usuario)
    {
        $request->validate([
            'nombre' => 'required',
            'contrasena' => 'required',
            'telefono' => 'required',
            'fecha_registro' => 'required|date',
            'correo' => 'required|email',
            'tipo_usuario' => 'required|integer',
            'ruta_imagen_usuario' => 'required',
        ]);

        $usuario->update($request->all());
        return redirect()->route('usuarios.lista')->with('success', 'Usuario actualizado exitosamente.');
    }

    public function destroy(Usuario $usuario)
    {
        $usuario->delete();
        return redirect()->route('usuarios.lista')->with('success', 'Usuario eliminado exitosamente.');
    }
}
