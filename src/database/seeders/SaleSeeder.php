<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleProduct;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        foreach (range(1, 50) as $i) {
            $this->createSale();
        }
    }

    public function createSale(): void
    {
        try {
            DB::beginTransaction();
            $total = 0;
            $sale = new Sale();
            $sale->amount = $total;
            $sale->status = 'pending';
            $sale->save();

            $range = rand(1, 5);
            $products = Product::factory($range)->create();
            foreach ($products as $product) {
                $salesProducts = new SaleProduct();
                $quantity = rand(1, 5);
                $total += floatval($product->price) * $quantity;
                $salesProducts->products()->associate($product);
                $salesProducts->sale()->associate($sale);
                $salesProducts->amount = $quantity;
                $salesProducts->save();
            }

            $sale->amount = $total;
            $sale->status = 'completed';
            $sale->save();

            DB::commit();
        } catch (\Exception $e) {
            echo $e->getMessage();
            DB::rollBack();
        }
    }
}
