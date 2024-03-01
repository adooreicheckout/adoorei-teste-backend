<?php

namespace Database\Factories;

use App\Models\Cellphone;
use Illuminate\Database\Eloquent\Factories\Factory;

class CellphoneFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = 'Celular ' . ($this->faker->unique()->numberBetween(1, 1000));
        return [
            'name' => $name,
            'price' => $this->faker->numberBetween(1000, 10000),
            'description' => substr($this->faker->paragraph, 0, 50)

        ];
    }
}
