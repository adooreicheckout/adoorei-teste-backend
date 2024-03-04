<?php

namespace Tests\Unit;

use App\Models\Product;
use App\Models\ProductSale;
use App\Models\Sale;
use Tests\TestCase;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;

class ShowSaleFeatureTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     */
    public function test_show_sale_that_exists_feature(): void
    {
        $product1 = Product::create([
            'name' => 'Product 1',
            'description' => 'Product 1 description',
            'price' => 100,
        ]);

        $product2 = Product::create([
            'name' => 'Product 2',
            'description' => 'Product 2 description',
            'price' => 200,
        ]);

        $sale = Sale::create([
            'amount' => 500,
            'status' => Sale::STATUS_COMPLETE,
        ]);

        ProductSale::create([
            'product_id' => $product1->id,
            'sale_id' => $sale->id,
            'amount' => 1,
            'price' => 100,
        ]);

        ProductSale::create([
            'product_id' => $product2->id,
            'sale_id' => $sale->id,
            'amount' => 2,
            'price' => 200,
        ]);

        $response = $this->get('/api/sales/'.$sale->id);
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJson([
            'sale_id' => $sale->id,
            'amount' => 500,
            'products' => [
                [
                    'product_id' => $product1->id,
                    'amount' => 1,
                    'price' => 100,
                ],
                [
                    'product_id' => $product2->id,
                    'amount' => 2,
                    'price' => 200,
                ],
            ],
        ]);
    }

    public function test_show_sale_that_dont_exists_feature(): void
    {
        $response = $this->get('/api/sales/100');

        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }
}
