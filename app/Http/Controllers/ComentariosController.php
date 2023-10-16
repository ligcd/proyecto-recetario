<?php

namespace App\Http\Controllers;

use App\Models\Comentarios;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ComentariosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allcomentarios = Comentarios::all(); #Para recuperar los datos de la tabla
        #dd($allcomentarios);
        #allcomentarios lo nombré para quefueran todos los comentarios
        #>>   Comentarios::where('nombre', 'Lili')->get(); 
        #Ese tiene la misma función pero es más para una selección
        #Por ejemplo si quiero que aparezcan solo nombres o calificaciones específicass

        return view('nueva-pagina-comentarios', compact('allcomentarios'));
        #return view('pagina-principal');
     
    }



    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        $allcomentarios = Comentarios::all();
        #return view('formulario-comentarios');  
        return view('formulario-comentarios', compact('allcomentarios')); 
        
    }  #CON ESTO ESPERO QUE REGISTRE PERO AÚN NO SÉ CÓMO 

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) #CON ESTO SE GUARDA TODO A LA BASE DE DATOS
    {
            $comentarios = new Comentarios(); #Lo que viene del request lo asignamos acá 
            $comentarios->comentario = $request->comentario;  #Comentarios es por el nombre de la tabla ve en migrations
            $comentarios->calificacion=$request->calificacion;
            $comentarios->save();
            
            return redirect()->route('comentarios.index');
            
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
        return redirect()->route('comentarios.index');
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comentarios $comentario)
    {
        $comentario->DELETE(); 
        return redirect()->route('comentarios.index');
        //
    }
}
