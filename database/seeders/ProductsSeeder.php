<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $filepath = 'database/seeders/files/products.json';
        $data = json_decode(file_get_contents($filepath), true);

        foreach ($data as $line) {
            Product::insert($line);
        }
    }
}
