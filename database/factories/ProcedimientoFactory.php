<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Procedimiento>
 */
class ProcedimientoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $imagePath = 'public/img_recetas/procedimientos/';
        return [
            'recetas_id' =>\App\Models\Recetas::all()->random()->id,
            'procedimiento' => $this->faker->paragraphs(3, true), 
            'archivo_ubicacion' => $imagePath . $this->faker->unique()->uuid . '.png',        ];
    }
}
