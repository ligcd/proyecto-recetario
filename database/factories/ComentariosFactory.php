<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comentarios>
 */
class ComentariosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'comentario' => $this->faker->sentence,
            'calificacion' => $this->faker->randomFloat(2, 1, 5), 
            'recetas_id' =>\App\Models\Recetas::all()->random()->id,
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
