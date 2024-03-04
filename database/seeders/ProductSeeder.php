<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $faker = fake();
        for ($i = 0; $i < 100; $i++) {
            $products[] = [
                'name' => "Produto {$i}",
                'price' =>  rand(1, 100) + (rand(0, 99) / 100),
                'description' => $faker->text(50),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('product')->insert($products);
    }
}
