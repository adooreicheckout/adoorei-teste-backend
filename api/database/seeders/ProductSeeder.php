<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'name' => 'Celular 1',
            'price' => 199.99,
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec luctus molestie cursus. Vestibulum in cursus risus, ac facilisis ligula. In hac habitasse platea dictumst. ',
        ]);

        Product::create([
            'name' => 'Celular 2',
            'price' => 299.99,
            'description' => 'Fusce lacus mi, gravida id sem et, pellentesque maximus felis. Duis commodo turpis volutpat lorem luctus, vel dignissim massa sollicitudin.',
        ]);

        Product::create([
            'name' => 'Celular 3',
            'price' => 399.99,
            'description' => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. ',
        ]);

        Product::create([
            'name' => 'Celular 4',
            'price' => 499.99,
            'description' => 'Phasellus vel dui in orci lacinia posuere.',
        ]);

        Product::create([
            'name' => 'Celular 5',
            'price' => 599.99,
            'description' => 'Nunc semper turpis nec congue pellentesque.',
        ]);
    }
}
