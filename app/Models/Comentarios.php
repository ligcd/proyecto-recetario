<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentarios extends Model
{
    use HasFactory;

    protected $fillable = ['comentario', 'calificacion', 'recetas_id', 'user_id'];
    public function receta()
    {
        return $this->belongsTo(Recetas::class, 'recetas_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
