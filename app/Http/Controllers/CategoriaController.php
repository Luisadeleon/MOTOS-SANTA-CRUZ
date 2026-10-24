<?php

namespace App\Http\Controllers;
use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // indice 
        $categorias = Categoria::latest()->paginate(10);
        return view('categorias.index', compact('categorias'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // crear 
        return view('categorias.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //almacenar
        $request->validate([
            'nombre' => 'required|string|max:100',
        ]);
        Categoria::create($request->only('nombre'));
        return redirect()->route('categorias.index')->with('exito', 'Categoria creada correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Categoria $categoria)
    {
        //ver 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categoria $categoria)
    {
        // editar 
        return view('categorias.edit', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categoria $categoria)
    {
        //actualizar 
        $request->validate([
            'nombre' => 'required|string|max:100',
        ]);
        $categoria->update($request->only('nombre'));
        return redirect()->route('categorias.index')->with('exito', 'Categoria actualizada correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categoria $categoria){
        if ($categoria->actividades()->exists()) {
            return redirect()->route('categorias.index')
                ->with('error', 'No se puede eliminar: tiene actividades asociadas.');
        }

        $categoria->delete();
        return redirect()->route('categorias.index')->with('exito', 'Categoría eliminada correctamente.');
    }
}
