<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => 'Celular ' . $this->faker->unique()->word,
            'price' => $this->faker->randomFloat(2, 100, 7000),
            'description' => $this->faker->text,
            'is_available' => $this->faker->boolean,
        ];
    }
}
