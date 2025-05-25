<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrdenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $odernes = Orden::all();
        return view ('ordenes.index', compact('ordenes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ordenes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $request->validate([
        'cantidad_orden' => 'required|integer|min:1',
        'estado_pago' => 'required|string',
        'fecha_orden' => 'requiered|date',
        'telefono' => 'required|string',
        'id_usuario' => 'required|exists:usuarios,id',
           ]);

        Orden::create($request->all());
        return redirect()->route('ordenes.index')->with('success', 'Orden creada exitosamente.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Orden $orden)
    {
        return view ('ordenes.show', compact('orden'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Orden $orden)
    {
         return view ('ordenes.edit', compact('orden'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Orden $orden)
    {
         $request->validate([
            'cantidad_orden' => 'required|integer|min:1',
            'estado_pago' => 'required|string',
            'fecha_orden' => 'required|date',
            'telefono' => 'required|string',
            'id_usuario' => 'required|exists:usuarios,id',
        ]);

        $orden->update($request->all());
        return redirect()->route('ordenes.index')->with('success', 'Orden actualizada exitosamente.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Orden $orden)
    {
        $orden -> delete();
        return redirect()->route('ordenes.index')->with('success', 'Orden eliminada exitosamente.');
    }
}
