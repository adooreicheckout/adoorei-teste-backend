<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'name' => 'Mac 13',
            'description' => 'Um computador adoorável - Mac 13',
            'price' => 10000,
        ]);

        Product::create([
            'name' => 'Mac 14',
            'description' => 'Um computador adoorável - Mac 14',
            'price' => 12000,
        ]);

        Product::create([
            'name' => 'iPhone 13',
            'description' => 'Um celular adoorável - iPhone 13',
            'price' => 4000,
        ]);

        Product::create([
            'name' => 'iPhone 14',
            'description' => 'Um celular adoorável - iPhone 14',
            'price' => 5000,
        ]);

        Product::create([
            'name' => 'iPhone 15',
            'description' => 'Um celular adoorável - iPhone 15',
            'price' => 6000.15,
        ]);
    }
}
