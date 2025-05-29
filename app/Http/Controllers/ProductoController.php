<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\ImagenProducto;
use App\Models\Categoria;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::with(['imagen', 'categoria'])->get();
        return view('productos.index', compact('productos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'codigo' => 'required|string|max:255',
            'estado' => 'required|boolean',
            'precio' => 'required|integer',
            'descripcion' => 'required|string|max:255',
            'nombre_producto' => 'required|string|max:255',
            'cantidad' => 'required|integer',
            'id_imagen' => 'required|exists:imagenes_productos,id',
            'id_categoria' => 'required|exists:categorias,id',
        ]);

        Producto::create($request->all());
        return redirect()->route('productos.index')->with('success', 'Producto creado exitosamente.');
    }

    public function show(string $id)
    {
        $producto = Producto::with(['imagen', 'categoria'])->findOrFail($id);
        return view('productos.show', compact('producto'));
    }

    public function edit(string $id)
    {
        $producto = Producto::with(['imagen', 'categoria'])->findOrFail($id);
        $imagenes = ImagenProducto::all();
        $categorias = Categoria::all();
        return view('productos.edit', compact('producto', 'imagenes', 'categorias'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'codigo' => 'required|string|max:255',
            'estado' => 'required|boolean',
            'precio' => 'required|integer',
            'descripcion' => 'required|string|max:255',
            'nombre_producto' => 'required|string|max:255',
            'cantidad' => 'required|integer',
            'id_imagen' => 'required|exists:imagenes_productos,id',
            'id_categoria' => 'required|exists:categorias,id',
        ]);

        $producto = Producto::findOrFail($id);
        $producto->update($request->all());
        return redirect()->route('productos.index')->with('success', 'Producto actualizado exitosamente.');
    }

    public function destroy(string $id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();
        return redirect()->route('productos.index')->with('success', 'Producto eliminado exitosamente.');
    }
}