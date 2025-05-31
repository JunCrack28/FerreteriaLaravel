<?php

namespace App\Http\Controllers;

use App\Models\ImagenProducto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImagenProductoController extends Controller
{
    public function index()
    {
        $imagenes = ImagenProducto::all();
        return view('imagenes.index', compact('imagenes'));
    }

    public function create()
    {
        return view('imagenes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tipo' => 'nullable|integer',
            'ruta_imagen' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Cambiado a image
        ]);

        $data = $request->all();

        if ($request->hasFile('ruta_imagen')) {
            $file = $request->file('ruta_imagen');
            $destinationPath = storage_path('app/public/imagenes_productos');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            try {
                $path = $file->store('imagenes_productos', 'public');
                $data['ruta_imagen'] = '/storage/' . $path; // Guarda la ruta relativa
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['ruta_imagen' => 'Error al guardar la imagen: ' . $e->getMessage()]);
            }
        }

        ImagenProducto::create($data);
        return redirect()->route('imagenes.index')->with('success', 'Imagen guardada exitosamente.');
    }

    public function show(string $id)
    {
        $imagen = ImagenProducto::findOrFail($id);
        return view('imagenes.show', compact('imagen'));
    }

    public function edit(string $id)
    {
        $imagen = ImagenProducto::findOrFail($id);
        return view('imagenes.edit', compact('imagen'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'tipo' => 'nullable|integer',
            'ruta_imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Opcional en actualización
        ]);

        $imagen = ImagenProducto::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('ruta_imagen')) {
            // Eliminar la imagen anterior si existe
            if ($imagen->ruta_imagen) {
                Storage::delete(str_replace('/storage', 'public', $imagen->ruta_imagen));
            }
            $file = $request->file('ruta_imagen');
            $destinationPath = storage_path('app/public/imagenes_productos');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            try {
                $path = $file->store('imagenes_productos', 'public');
                $data['ruta_imagen'] = '/storage/' . $path; // Guarda la ruta relativa
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['ruta_imagen' => 'Error al guardar la imagen: ' . $e->getMessage()]);
            }
        }

        $imagen->update($data);
        return redirect()->route('imagenes.index')->with('success', 'Imagen actualizada exitosamente.');
    }

    public function destroy(string $id)
    {
        $imagen = ImagenProducto::findOrFail($id);
        // Eliminar la imagen asociada
        if ($imagen->ruta_imagen) {
            Storage::delete(str_replace('/storage', 'public', $imagen->ruta_imagen));
        }
        $imagen->delete();
        return redirect()->route('imagenes.index')->with('success', 'Imagen eliminada exitosamente.');
    }
}