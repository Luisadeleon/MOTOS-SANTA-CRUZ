<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Actividad;
use App\Models\Categoria;

class ActividadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $actividades = Actividad::with('categoria')->latest()->paginate(10);
        return view('actividades.index', compact('actividades'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categorias = Categoria::orderBy('nombre')->get();
        return view('actividades.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'titulo' => 'required|string|max:250',
            'fecha' => 'required|date',
            'categoria_id' => 'required|exists:categorias,id',
        ]);
        Actividad::create($request->only('titulo','fecha','categoria_id'));
        return redirect()-> route('actividades.index')->with('exito','Actividad creada.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Actividad $actividad)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Actividad $actividad)
    {
        //
        $categorias = Categoria::orderBy('nombre')->get();
        return view('actividades.edit', compact('actividad', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Actividad $actividad)
    {
        //
        $request->validate([
            'titulo' => 'required|string|max:250',
            'fecha' => 'required|date',
            'categoria_id' => 'required|exists:categorias,id',
        ]);
        $actividad->update($request->only('titulo', 'fecha', 'categoria_id'));
        return redirect()->route('actividades.index')->with('exito', 'actividad actualizada');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Actividad $actividad)
    {
        //
        $actividad->delete();
        return redirect()->route('actividades.index')->with('exito', 'Actividad eliminada');

    }
}
