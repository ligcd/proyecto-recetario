<?php

namespace App\Http\Controllers;

use App\Models\Comentarios;
use App\Models\Recetas;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComentariosController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function __construct()
     {
        $this->middleware(['auth','verified'])->except('index','show'); 
       #$this->middleware(['auth'])->except('index','show');
      } 

    
    public function index()
    {
        $allcomentarios = Comentarios::all(); 

        return view('nueva-pagina-comentarios', compact('allcomentarios'));
        #return view('pagina-principal');
     
    }



    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        $receta = Recetas::all();

        #return view('formulario-comentarios');  
        return view('formulario-comentarios', compact('receta')); 
        
    }  #CON ESTO ESPERO QUE REGISTRE PERO AÚN NO SÉ CÓMO 

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) #CON ESTO SE GUARDA TODO A LA BASE DE DATOS
    {

        $comentario = new Comentarios();
        $comentario->comentario = $request->comentario;
        $comentario->calificacion = $request->calificacion;
        $comentario->recetas_id = $request->recetas_id;
        $comentario->user_id = auth()->id();
      
        $comentario->save();
    
        return redirect()->route('recetas.show', ['receta' => $request->recetas_id])
                         ->with('success', 'Comentario agregado exitosamente');
            
    }

    /**
     * Display the specified resource.
     */
    public function show(Comentarios $comentario)
    {#se recibe un objeto del modelo que creamos, el objeto es una consulta select*from etc. 
        #dd($comentarios);

        return view('comentario-info', compact('comentario'));
        #$comentario= Comentarios::find($id);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comentarios $comentario)
    {
        #Aquí se puede editar el cometario, esperamos una instancia del registro, podemos agregar un 
        #enlace peo ahora apuntando al edit. 
        return view('comentario-editar', compact('comentario'));

        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comentarios $comentario)
    {
        $comentario->comentario=$request->comentario; 
        $comentario->calificacion=$request->calificacion; 
        $comentario->save();
        $recetaId = $comentario->receta->id;

        return redirect()->route('recetas.show', $recetaId);
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comentarios $comentario)
    {
        $recetaId = $comentario->receta->id;  // Asegúrate de que la relación esté definida correctamente

        $comentario->delete();  // Cambiado a minúscula
    
        return redirect()->route('recetas.show', $recetaId);
    }
}
