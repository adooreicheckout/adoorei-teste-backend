<?php

namespace Database\Seeders\Sale;

use App\Models\Sale\SaleStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SaleStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['id' => 1, 'name' => 'Completo'],
            ['id' => 2, 'name' => 'Em andamento'],
            ['id' => 3, 'name' => 'Cancelado'],
        ];

        foreach ($data as $item) {
            SaleStatus::updateOrCreate(
                ['id' => $item['id']],
                $item
            );
        }
    }
}
