<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etiqueta extends Model
{
    public $timestamps = false; 
    protected $fillable =['etiqueta'];

    use HasFactory;

    /*** Obtener las etiquetas asociadas a esta receta.*/
    public function recetas()
    {
        return $this->belongsToMany(Recetas::class);
    }
    public function setEtiquetaAttribute($value)
    {
        //Mutator 
        $this->attributes['etiqueta'] = strtoupper($value); // Convierte la etiqueta a mayúsculas antes de guardarla
    }
}
