<?php

namespace Database\Seeders;

use App\Models\Products;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            ['name' => 'Celular 1', 'price' => 1800, 'description' => 'Lorenzo Ipsulum'],
            ['name' => 'Celular 2', 'price' => 3200, 'description' => 'Lorem ipsum dolor'],
            ['name' => 'Celular 3', 'price' => 9800, 'description' => 'Lorem ipsum dolor sit amet']
        ];

        foreach($products as $product)
        {
            Products::firstOrCreate($product);
        }
    }
}
