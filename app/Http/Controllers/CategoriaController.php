<?php

namespace App\Http\Controllers;
use App\Models\Categoria;
use Illuminate\Http\Request;

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
            'nombre_categoria' => 'required',
            'logo' => 'required',
        ]);

        Categoria::create($request->all());
        return redirect()->route('categorias.index')->with('success', 'Categoria creada exitosamente.');
    }

    public function show(Categoria $categoria)
    {
        return view('categorias.show', compact('categorias'));

    }

    public function edit(Categoria $categoria)
    {
        return view('categorias.edit', compact('categorias'));
    }

    public function update(Request $request, Categoria $categoria)
    {
        {
         $request->validate([
            'nombre_categoria' => 'required',
            'logo' => 'required',
        ]);
        
        Categoria::create($request->all());
        return redirect()->route('categorias.index')->with('success', 'Categoria actualizada exitosamente.');
    }
    }

    public function destroy(Categoria $categoria)
    {
        $categoria->delete();
        return redirect()->route('categorias.index')->with('success', 'Categoria eliminada exitosamente.');
    }
}
