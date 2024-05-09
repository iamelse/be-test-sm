<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vehicle>
 */
class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'brand' => $this->faker->randomElement(['Toyota', 'Honda', 'Ford', 'Chevrolet']),
            'model' => $this->faker->word,
            'year' => $this->faker->numberBetween(2000, 2022),
            'color' => $this->faker->safeColorName,
        ];
    }
}
