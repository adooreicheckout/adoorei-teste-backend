<?php

namespace Database\Seeders;

use App\Models\Produtos;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                "name" => "iPhone 13",
                "price" => 3499.99,
                "description" => "O mais recente modelo da Apple, com câmera avançada e desempenho rápido."
            ],
            [
                "name" => "Samsung Galaxy S21",
                "price" => 2999.99,
                "description" => "Um smartphone Android de última geração com tela AMOLED e recursos poderosos."
            ],
            [
                "name" => "Google Pixel 6",
                "price" => 2799.99,
                "description" => "Conhecido por sua incrível qualidade de câmera e experiência pura do Android."
            ],
            [
                "name" => "OnePlus 9 Pro",
                "price" => 3999.99,
                "description" => "Um dispositivo Android premium com tela fluida e carregamento ultrarrápido."
            ],
            [
                "name" => "Xiaomi Mi 11",
                "price" => 2499.99,
                "description" => "Um smartphone com especificações impressionantes e preço acessível."
            ],
            [
                "name" => "Sony Xperia 1 III",
                "price" => 4599.99,
                "description" => "O carro-chefe da Sony, conhecido por sua qualidade de tela e recursos multimídia."
            ],
            [
                "name" => "Huawei P40 Pro",
                "price" => 3299.99,
                "description" => "Um smartphone com câmera poderosa e design elegante."
            ],
            [
                "name" => "Motorola Moto G Power",
                "price" => 1999.99,
                "description" => "Destacando-se pela impressionante vida útil da bateria e desempenho sólido."
            ],
            [
                "name" => "LG Velvet",
                "price" => 2799.99,
                "description" => "Um smartphone elegante com design inovador e tela OLED."
            ],
            [
                "name" => "Nokia 8.3",
                "price" => 2299.99,
                "description" => "Um smartphone Android robusto com foco em atualizações rápidas e durabilidade."
            ],
        ];

        foreach ($products as $prod) {
            Produtos::firstOrCreate(['name' => $prod['name']], $prod);
        }

    }
}
