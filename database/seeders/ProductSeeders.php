<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeders extends Seeder
{
    public function run()
    {
        $products = [
            [
                'name' => 'iPhone 13',
                'price' => 1099.99,
                'description' => 'The latest iPhone model with advanced features.',
            ],
            [
                'name' => 'Samsung Galaxy S21',
                'price' => 899.99,
                'description' => 'Powerful Android smartphone with a stunning display.',
            ],
            [
                'name' => 'Google Pixel 6',
                'price' => 699.99,
                'description' => 'Flagship Google smartphone known for its exceptional camera.',
            ],
            [
                'name' => 'OnePlus 9 Pro',
                'price' => 999.99,
                'description' => 'High-performance smartphone with a smooth user experience.',
            ],
            [
                'name' => 'Xiaomi Mi 11',
                'price' => 799.99,
                'description' => 'Feature-packed smartphone with a sleek design.',
            ],
            [
                'name' => 'Huawei P40 Pro',
                'price' => 899.99,
                'description' => 'Premium Huawei smartphone with a powerful camera system.',
            ],
            [
                'name' => 'Sony Xperia 1 III',
                'price' => 1199.99,
                'description' => 'Flagship Sony smartphone with a stunning 4K display.',
            ],
            [
                'name' => 'Motorola Edge+',
                'price' => 999.99,
                'description' => 'Motorola flagship with a large battery and excellent performance.',
            ],
            [
                'name' => 'LG Wing',
                'price' => 899.99,
                'description' => 'Innovative LG smartphone with a swiveling dual-screen design.',
            ],
            [
                'name' => 'Nokia 9 PureView',
                'price' => 699.99,
                'description' => 'Nokia smartphone with a unique five-camera setup for photography enthusiasts.',
            ],
            [
                'name' => 'ASUS ROG Phone 5',
                'price' => 1299.99,
                'description' => 'Gaming-oriented smartphone with high-refresh-rate display and powerful hardware.',
            ],
            [
                'name' => 'BlackBerry KEY2',
                'price' => 599.99,
                'description' => 'Modern BlackBerry smartphone with a physical keyboard and security features.',
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
