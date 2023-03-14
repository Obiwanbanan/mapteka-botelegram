<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PharmaciesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'organization_id' => fake()->numberBetween(1, 10),
            'name' => fake()->word(),
            'address' => fake()->address(),
            'coordinate_X_for_map' => fake()->numberBetween(1,100),
            'coordinate_Y_for_map' => fake()->numberBetween(1,100),
        ];
    }
}
