<?php

namespace Tests\Feature;

use App\Database\Repositories\Eloquent\EloquentProductsRepository;
use App\Models\Product;
use Domain\UseCases\ListProductsUseCase;
use Tests\TestCase;
use Illuminate\Http\Response;

use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateSaleFeatureTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     */
    public function test_create_sales_single_product_feature(): void
    {
        $product1 = Product::create([
            'name' => 'Product 1',
            'description' => 'Product 1 description',
            'price' => 100,
        ]);

        $this->post('/api/sales', [
            'products' => [
                [
                    'id' => $product1->id,
                    'amount' => 2
                ],
            ]
        ])->assertStatus(Response::HTTP_CREATED);
    }

    public function test_create_sales_multiple_products_feature(): void
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

        $response = $this->post('/api/sales', [
            'products' => [
                [
                    'id' => $product1->id,
                    'amount' => 2
                ],
                [
                    'id' => $product2->id,
                    'amount' => 3
                ],
            ]
        ]);

        $response->assertStatus(Response::HTTP_CREATED);
        $this->assertTrue($response['amount'] === 800);
    }

    public function test_create_sales_no_products_feature(): void
    {

        $product1 = Product::create([
            'name' => 'Product 1',
            'description' => 'Product 1 description',
            'price' => 100,
        ]);

        $response = $this->post('/api/sales');

        $this->assertTrue($response->exception->status === Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_create_sales_with_products_which_dont_exist_feature(): void
    {

        $product1 = Product::create([
            'name' => 'Product 1',
            'description' => 'Product 1 description',
            'price' => 100,
        ]);

        $response = $this->post('/api/sales', [
            'products' => [
                [
                    'id' => 999,
                    'amount' => 2
                ],
            ]
        ]);

        $this->assertTrue($response->exception->status === Response::HTTP_UNPROCESSABLE_ENTITY);
    }

}
