<?php

namespace Database\Seeders;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SaleSeeder extends Seeder
{
    use HasUuids;

    public function run(): void
    {
        $products = [];
        $sales = [];
        for ($i = 0; $i < 100; $i++) {
            $uuid = $this->newUniqueId();
            $sales[] = [
                'id' => $uuid
            ];
            for ($j = 0; $j < rand(1, 10); $j++) {
                $products[] = [
                    'product_id' => rand(1, 99),
                    'quantity' => rand(1, 100),
                    'sale_id' => $uuid
                ];
            }
        }
        DB::table('sale')->insert($sales);
        DB::table('product_sale')->insert($products);
    }
}
