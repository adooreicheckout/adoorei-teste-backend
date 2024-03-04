<?php

namespace Tests\Unit;

use App\Database\Repositories\Eloquent\EloquentProductsRepository;
use App\Database\Repositories\Eloquent\EloquentSalesRepository;
use App\Models\Product;
use App\Models\ProductSale;
use App\Models\Sale;
use Domain\UseCases\CreateSaleUseCase;
use Domain\UseCases\ShowSaleUseCase;
use Tests\TestCase;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\Response;

class addProductsToExistingSaleFeatureTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     */
    public function test_add_product_to_completed_existing_sale_feature(): void
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
            'status' => Sale::STATUS_COMPLETED,
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

        $response = $this->post('/api/sales/'.$sale->id.'/add-products', [
            'products' => [
                [
                    'id' => $product1->id,
                    'amount' => 1,
                ],
            ],
        ]);

        $response->assertStatus(Response::HTTP_CREATED);
        $response->assertJson([
            'sale_id' => $sale->id,
            'amount' => 600,
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
                [
                    'amount' => 1,
                    'price' => 100,
                ],
            ],
        ]);
    }

    public function test_add_product_to_canceled_existing_sale_feature(): void
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
            'status' => Sale::STATUS_CANCELLED,
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

        $response = $this->post('/api/sales/'.$sale->id.'/add-products', [
            'products' => [
                [
                    'id' => $product1->id,
                    'amount' => 1,
                ],
            ],
        ]);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_add_product_to_unexisting_sale_feature(): void
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
            'status' => Sale::STATUS_CANCELLED,
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

        $response = $this->post('/api/sales/100/add-products', [
            'products' => [
                [
                    'id' => $product1->id,
                    'amount' => 1,
                ],
            ],
        ]);

        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }

    public function test_add_unexisting_product_to_existing_sale_feature(): void
    {
        $sale = Sale::create([
            'amount' => 0,
            'status' => Sale::STATUS_COMPLETED,
        ]);

        $response = $this->post('/api/sales/'.$sale->id.'/add-products', [
            'products' => [
                [
                    'id' => 100,
                    'amount' => 1,
                ],
            ],
        ]);

        $this->assertTrue($response->exception->status === Response::HTTP_UNPROCESSABLE_ENTITY);
    }

}
