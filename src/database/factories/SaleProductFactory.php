<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SaleProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'sales_id' => function () {
                return \App\Models\Sale::factory()->create()->id;
            },
            'product_id' => function () {
                return \App\Models\Product::factory()->create()->id;
            },
            'amount' => $this->faker->numberBetween(1, 10),
        ];
    }
}
