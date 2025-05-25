<?php

namespace App\Http\Controllers;

use App\Models\ImagenProducto;
use Illuminate\Http\Request;

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
            'ruta_imagen' => 'required|string|max:255',
        ]);

        ImagenProducto::create($request->all());
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
            'ruta_imagen' => 'required|string|max:255',
        ]);

        $imagen = ImagenProducto::findOrFail($id);
        $imagen->update($request->all());
        return redirect()->route('imagenes.index')->with('success', 'Imagen actualizada exitosamente.');
    }

    public function destroy(string $id)
    {
        $imagen = ImagenProducto::findOrFail($id);
        $imagen->delete();
        return redirect()->route('imagenes.index')->with('success', 'Imagen eliminada exitosamente.');
    }
}
