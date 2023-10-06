<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class BrancheFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'  => fake()->name(),
            'address' => fake()->address(),
            'radius' => fake()->randomNumber(),
            'latitude' => fake()->latitude(),
            'longitude' => fake()->longitude(),
            'employer_id' => '1',
        ];
    }
}
