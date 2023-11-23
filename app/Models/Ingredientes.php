<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredientes extends Model
{
    use HasFactory;
    protected $fillable = ['nombre', 'cantidad', 'unidadMedida', 'recetas_id'];

    public function receta()
    {
        return $this->belongsTo(Recetas::class);
    }
}

    
