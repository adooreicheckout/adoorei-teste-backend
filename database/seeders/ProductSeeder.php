<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id' => 1,
                'name' => 'Apple iPhone 14 (128 GB) – Estelar',
                'price' => 4299.0,
                'description' => 'Reprodução de vídeo: até 20 horas Reprodução de vídeo (streaming): até 16 horas Reprodução de áudio'
            ],
            [
                'id' => 2,
                'name' => 'Apple iPhone 13 (128 GB) - Luz das estrelas',
                'price' => 3749.0,
                'description' => 'O modo cinematic adiciona profundidade de campo rasa e muda o foco automaticamente em seus vídeos'
            ],
            [
                'id' => 3,
                'name' => 'iPhone 11 Apple 64GB Preto 6,1” 12MP iOS',
                'price' => 2681.10,
                'description' => 'Grave vídeos 4K, faça belos retratos e capture paisagens inteiras com o novo sistema de câmera dupla.'
            ]
        ];

        foreach ($data as $item) {
            Product::updateOrCreate(
                ['id' => $item['id']],
                $item
            );
        }

    }
}
