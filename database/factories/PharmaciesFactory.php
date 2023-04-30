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
            'address' => fake()->streetAddress(),
            'latitude' => 55.753215,
            'longitude' => 37.622504,
        ];
    }
}
