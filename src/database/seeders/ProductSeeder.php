<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

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
            ['product_id' => Uuid::uuid4()->toString(), 'name' => 'Celular 1', 'price' => 1800, 'description' => 'Lorenzo Ipsulum'],
            ['product_id' => Uuid::uuid4()->toString(), 'name' => 'Celular 2', 'price' => 3200, 'description' => 'Lorem ipsum dolor'],
            ['product_id' => Uuid::uuid4()->toString(), 'name' => 'Celular 3', 'price' => 9800, 'description' => 'Lorem ipsum dolor sit amet']
        ];

        foreach($products as $product)
        {
            DB::table('products')->insert($products);
        }
    }
}
