<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Recetas extends Model
{
    use HasFactory;
    protected $fillable =['titulo','tipoComida','descripcion','archivo_ubicacion','user_id'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ingredientes()
    {
        return $this->hasMany(Ingredientes::class);
    }

    public function procedimientos()
    {
        return $this->hasMany(Procedimiento::class);
    }

    public function comentarios(): HasMany
    {
        return $this->hasMany(Comentarios::class);
    }

    public function etiquetas()
    {
        return $this->belongsToMany(Etiqueta::class);
    }
    public function menus()
    {
        //If your pivot table contains extra attributes, you must specify them when defining the relationship       
        return $this->belongsToMany(Menu::class)->withPivot('dia', 'tipo_comida');;
    }
}
