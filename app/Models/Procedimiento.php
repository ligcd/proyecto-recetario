<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Procedimiento extends Model
{
    use HasFactory;
    protected $fillable = ['procedimiento', 'archivo_ubicacion', 'recetas_id'];

    public function receta()
    {
        return $this->belongsTo(Recetas::class);
    }

}
