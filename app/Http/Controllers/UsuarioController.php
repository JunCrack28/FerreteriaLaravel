<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\ImagenProducto;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UsuarioController extends Controller
{
    public function index()
    {
        $imagenes = ImagenProducto::all(); 
        $categorias = Categoria::all(); 
        return view('usuarios.index', compact('imagenes', 'categorias'));
    }


    public function lista()
    {
        $usuarios = Usuario::all();
        return view('usuarios.lista', compact('usuarios'));
    }

    public function create()
    {
        return view('usuarios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'contrasena' => 'required|string|min:6',
            'telefono' => 'required|string|max:20',
            'fecha_registro' => 'required|date',
            'correo' => 'required|email|unique:usuarios,correo',
            'tipo_usuario' => 'required|in:1,2', // Solo permite 1 o 2
            'ruta_imagen_usuario' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Cambiado a image
        ]);

        $data = $request->all();
        $data['contrasena'] = Hash::make($data['contrasena']); // Hashear la contraseña

        if ($request->hasFile('ruta_imagen_usuario')) {
            $file = $request->file('ruta_imagen_usuario');
            $destinationPath = storage_path('app/public/usuarios');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            try {
                $path = $file->store('usuarios', 'public');
                $data['ruta_imagen_usuario'] = '/storage/' . $path; // Guarda la ruta relativa
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['ruta_imagen_usuario' => 'Error al guardar la imagen: ' . $e->getMessage()]);
            }
        }

        Usuario::create($data);
        return redirect()->route('usuarios.lista')->with('success', 'Usuario creado exitosamente.');
    }

    public function show(Usuario $usuario)
    {
        return view('usuarios.show', compact('usuario'));
    }

    public function edit(Usuario $usuario)
    {
        return view('usuarios.edit', compact('usuario'));
    }

    public function update(Request $request, Usuario $usuario)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'contrasena' => 'required|string|min:6',
            'telefono' => 'required|string|max:20',
            'fecha_registro' => 'required|date',
            'correo' => 'required|email|unique:usuarios,correo,' . $usuario->id,
            'tipo_usuario' => 'required|in:1,2', // Solo permite 1 o 2
            'ruta_imagen_usuario' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Opcional en actualización
        ]);

        $data = $request->all();
        $data['contrasena'] = Hash::make($data['contrasena']); // Hashear la contraseña

        if ($request->hasFile('ruta_imagen_usuario')) {
            // Eliminar la imagen anterior si existe
            if ($usuario->ruta_imagen_usuario) {
                Storage::delete(str_replace('/storage', 'public', $usuario->ruta_imagen_usuario));
            }
            $file = $request->file('ruta_imagen_usuario');
            $destinationPath = storage_path('app/public/usuarios');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            try {
                $path = $file->store('usuarios', 'public');
                $data['ruta_imagen_usuario'] = '/storage/' . $path; // Guarda la ruta relativa
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['ruta_imagen_usuario' => 'Error al guardar la imagen: ' . $e->getMessage()]);
            }
        }

        $usuario->update($data);
        return redirect()->route('usuarios.lista')->with('success', 'Usuario actualizado exitosamente.');
    }

    public function destroy(Usuario $usuario)
    {
        // Eliminar la imagen asociada
        if ($usuario->ruta_imagen_usuario) {
            Storage::delete(str_replace('/storage', 'public', $usuario->ruta_imagen_usuario));
        }
        $usuario->delete();
        return redirect()->route('usuarios.lista')->with('success', 'Usuario eliminado exitosamente.');
    }
}