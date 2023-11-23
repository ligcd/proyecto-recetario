<?php

namespace App\Http\Controllers;

use App\Models\Ingredientes;
use Illuminate\Http\Request;

class IngredientesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified'])->except('index','show');
    }

    public function index()
    {
        $ingredientes = Ingredientes::all(); //recupera todo lo de la tabla

        //dd($ingredientes);
        //Ingrediente::where ('nombre','Pepino')->get();
        return view('recetas.listadoRecetas', compact('ingredientes'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $recetaId = $request->input('recetaId');
        return view('recetas/formularioRecetas', compact('recetaId'));
    }
    
    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|regex:/^[\pL\s\-]+$/u|max:150',
            'cantidad' => 'required|numeric|min:0',
            'unidadMedida' => 'nullable' // Acepta un valor nulo (opcional)
        ]);
        
        Ingredientes::create($request->all());
    
        $recetaId = $request->input('recetas_id');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ingredientes $ingrediente)
    {
        return view('ingredientes/ingrediente-show', compact('ingrediente'));
        //$imngrediente= Ingredientes::find($id);
        //dd($ingredientes); para probar que funciona
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ingredientes $ingrediente)
    {
        //se envia un formulario con los campos llenos
        return view('ingredientes/ingrediente-edit', compact('ingrediente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ingredientes $ingrediente)
    {
        Ingredientes::where('id', $ingrediente->id)->update($request->except('_token','_method'));
        //se actualizan los cambios del edit
        //$ingrediente->nombre=$request->nombre;
        //$ingrediente->cantidad=$request->cantidad;
        //$ingrediente->unidadMedida=$request->unidadMedida;
        //$ingrediente->save();
        return redirect()->route('ingredientes.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ingredientes $ingrediente)
    {
        $ingrediente->delete();
        return redirect()->route('ingredientes.index');

    }
}
