<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recetas;
use App\Models\Etiqueta;
use App\Models\Ingredientes;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class RecetasController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function __construct()
     {
         $this->middleware(['auth','verified'])->except('index','show');
     }
     
     public function index(Request $request)
     {
         $query = Recetas::query();
 
         // Aplicar filtro por título si se ha enviado un valor en la solicitud
         if ($request->filled('titulo')) {
             $titulo = $request->input('titulo');
             $query->where('titulo', 'LIKE', "%$titulo%");
         }
 
         // Aplicar filtro por tipo de comida si se ha enviado un valor en la solicitud
         if ($request->filled('tipoComida')) {
             $tipoComida = $request->input('tipoComida');
             $query->where('tipoComida', $tipoComida);
         }
 
         $recetas = $query->get();
         $noResultados = $recetas->isEmpty();
 
         return view('recetas.listadoRecetas', compact('recetas','noResultados'));
     }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $etiquetas = Etiqueta::all();
        $recetaId = Ingredientes::all(); // O asigna el valor adecuado según tus necesidades.
    
        return view('recetas/formularioRecetas', compact('etiquetas', 'recetaId'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|regex:/^[\pL\s\-]+$/u|max:150',
            'tipoComida' => 'required|regex:/^[\pL\s\-]+$/u|max:100',
            'descripcion' => 'required|string|max:1000',
            'procedimiento' => 'required|string|max:10000', // Ajusta el número según tus necesidades
            'archivo' => 'required|mimes:jpeg,png,jpg,gif,svg|max:10000',
        ]);
    
        $etiquetasSeleccionadas = $request->input('etiqueta_id', []); //etiquetas creadas y existentes
    
        //Regresa los id de las etiquetas seleccionadas diferentes a las que ya existen y las guarda en un array
        $nuevasEtiquetas = array_diff($etiquetasSeleccionadas, Etiqueta::pluck('id')->toArray()); 
    
        //Se crea un array para huardar los id de las etiquetas que se van guardando en el for 
        $etiquetasCreadas = [];
        foreach ($nuevasEtiquetas as $nuevaEtiqueta) {
            $etiqueta = Etiqueta::create(['etiqueta' => $nuevaEtiqueta]);
            $etiquetasCreadas[] = $etiqueta->id;
        }
    
        $archivoUbicacion = $request->file('archivo')->store('public/img_recetas');
    
        $receta = Recetas::create([
            'titulo' => $request->titulo,
            'tipoComida' => $request->tipoComida,
            'descripcion' => $request->descripcion,
            'procedimiento' => $request->procedimiento,
            'archivo_ubicacion' => $archivoUbicacion,
            'user_id' => Auth::id(),
        ]);

        // Array de etiquetas creadas y existentes.
        $etiquetasReceta = array_merge($etiquetasCreadas, Etiqueta::whereIn('id', $etiquetasSeleccionadas)->pluck('id')->toArray());
        $receta->etiquetas()->attach($etiquetasReceta);

        $ingredientesNombres = $request->input('nombre', []);
        $ingredientesCantidades = $request->input('cantidad', []);
        $ingredientesUnidades = $request->input('unidadMedida', []);

        $numeroIngredientes = is_array($ingredientesNombres) ? count($ingredientesNombres) : 0;

        $ingredientes = [];

        // Imprime o registra el valor de $receta->id
        //Log::info("ID de la receta: {$receta->id}");
        //dd($receta->id);

        for ($i = 0; $i < $numeroIngredientes; $i++) {
            $ingrediente = new Ingredientes();

            $validator = Validator::make([
                'nombre' => $ingredientesNombres[$i],
                'cantidad' => $ingredientesCantidades[$i],
                'unidadMedida' => $ingredientesUnidades[$i],
            ], [
                'nombre' => 'required|regex:/^[\pL\s\-]+$/u|max:150',
                'cantidad' => 'required|numeric|min:0',
                'unidadMedida' => 'nullable', // Acepta un valor nulo (opcional)
            ]);

            if ($validator->fails()) {
                // Manejar la validación fallida aquí
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $ingrediente = $receta->ingredientes()->create([
                'nombre' => $ingredientesNombres[$i],
                'cantidad' => $ingredientesCantidades[$i],
                'unidadMedida' => $ingredientesUnidades[$i],
            ]);

            $ingrediente->save();

            $ingredientes[] = $ingrediente;
        }
        

        return redirect()->route('recetas.index');
    
        //return redirect()->route('ingredientes.create', ['recetaId' => $receta->id]);
    }
    
    public function show(Recetas $receta)
    {
        return view('recetas.receta-show', compact('receta'));
        //$recetas = Recetas::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Recetas $receta)
    {
        // Obtener todas las etiquetas existentes
        $etiquetas = Etiqueta::all();

        // Obtener los ingredientes de la receta
        $ingredientes = $receta->ingredientes;

        return view('recetas.recetas-edit', compact('receta', 'etiquetas', 'ingredientes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Recetas $receta)
    {
        $receta->titulo = $request->titulo;
        $receta->descripcion = $request->descripcion;
        $receta->tipoComida = $request->tipoComida;

        if ($request->hasFile('archivo')) {
            $receta->archivo_ubicacion = $request->file('archivo')->store('public/img_recetas');
        }
        
        $receta->save();

        // Actualizar las etiquetas de la receta
        $etiquetasSeleccionadas = $request->input('etiqueta_id', []);

        $nuevasEtiquetas = array_diff($etiquetasSeleccionadas, Etiqueta::pluck('id')->toArray());

        $etiquetasCreadas = [];
        foreach ($nuevasEtiquetas as $nuevaEtiqueta) {
            $etiqueta = Etiqueta::create(['etiqueta' => $nuevaEtiqueta]);
            $etiquetasCreadas[] = $etiqueta->id;
        }

        $etiquetasReceta = array_merge($etiquetasCreadas, Etiqueta::whereIn('id', $etiquetasSeleccionadas)->pluck('id')->toArray());
        $receta->etiquetas()->sync($etiquetasReceta);

        // Actualizar ingredientes
        $ingredientesNombres = $request->input('nombre', []);
        $ingredientesCantidades = $request->input('cantidad', []);
        $ingredientesUnidades = $request->input('unidadMedida', []);

        foreach ($ingredientesNombres as $index => $nombre) {
            $receta->ingredientes()->create([
                'nombre' => $nombre,
                'cantidad' => $ingredientesCantidades[$index],
                'unidadMedida' => $ingredientesUnidades[$index],
            ]);
        }

        
        return redirect()->route('recetas.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Recetas $receta)
    {
        // Eliminar manualmente los ingredientes relacionados
        $receta->ingredientes()->delete();
        $receta->delete();
        return redirect()->route('recetas.index');
    }

    public function descargar(Recetas $receta)
    {
        return Storage::download($receta->archivo_ubicacion);
    }

}

