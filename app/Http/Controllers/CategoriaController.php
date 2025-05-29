<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::all();
        return view('categorias.index', compact('categorias'));
    }

    public function create()
    {
        return view('categorias.create');
    }

public function store(Request $request)
{
    $request->validate([
        'nombre_categoria' => 'required|string|max:255',
        'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $data = $request->all();

    if ($request->hasFile('logo')) {
        $file = $request->file('logo');
        $destinationPath = storage_path('app/public/categorias');
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }
        try {
            $path = $file->store('categorias', 'public');
            $data['logo'] = Storage::disk('public')->url($path);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['logo' => 'Error al guardar la imagen: ' . $e->getMessage()]);
        }
    }

    Categoria::create($data);
    return redirect()->route('categorias.index')->with('success', 'Categoría creada exitosamente.');
}


    public function show(Categoria $categoria)
    {
        return view('categorias.show', compact('categoria')); 
    }

    public function edit(Categoria $categoria)
    {
        return view('categorias.edit', compact('categoria')); 
    }

   public function update(Request $request, Categoria $categoria)
{
    $request->validate([
        'nombre_categoria' => 'required|string|max:255',
        'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
    ]);

    $data = $request->all();

    
    if ($request->hasFile('logo')) {
        if ($categoria->logo) {
            Storage::delete(str_replace('/storage', 'public', $categoria->logo));
        }
        $path = $request->file('logo')->store('categorias', 'public');
        $data['logo'] = '/storage/' . $path;
    }

    $categoria->update($data);
    return redirect()->route('categorias.index')->with('success', 'Categoría actualizada exitosamente.');
}

    public function destroy(Categoria $categoria)
    {
    
        if ($categoria->logo) {
            Storage::delete(str_replace('/storage', 'public', $categoria->logo));
        }
        $categoria->delete();
        return redirect()->route('categorias.index')->with('success', 'Categoría eliminada exitosamente.');
    }
}