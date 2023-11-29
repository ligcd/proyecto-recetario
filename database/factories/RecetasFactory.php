<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Recetas;
use App\Models\Etiqueta;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Recetas>
 */
class RecetasFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'titulo' => $this->faker->sentence,
            'descripcion' => $this->faker->paragraph,
            'tipoComida' => $this->faker->randomElement(['Desayuno', 'Almuerzo','Comida', 'Cena','Postre','Bebida']), // Ejemplo de tipo de comida aleatorio
            'archivo_ubicacion' => 'img_recetas/' . $this->faker->unique()->uuid . '.png',
            'user_id' => \App\Models\User::factory(),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Recetas $receta) {
            // Obtener dos etiquetas existentes y asociarlas a la receta creada
            $etiquetasIds = Etiqueta::factory()->count(2)->create()->pluck('id');
            $receta->etiquetas()->attach($etiquetasIds);
        });
    }
}
