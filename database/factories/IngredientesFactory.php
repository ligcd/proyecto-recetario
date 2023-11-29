<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ingredientes>
 */
class IngredientesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'recetas_id' =>\App\Models\Recetas::all()->random()->id,
            'nombre' => $this->faker->word,
            'cantidad' => $this->faker->randomFloat(2, 1, 100), 
            'unidadMedida' => $this->faker->randomElement(['kg', 'g', 'ml', 'unidades']),
        ];
    }
}
