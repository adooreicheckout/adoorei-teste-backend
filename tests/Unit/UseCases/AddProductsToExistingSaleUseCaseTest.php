<?php

namespace Tests\Unit;

use App\Database\Repositories\Eloquent\EloquentProductsRepository;
use App\Database\Repositories\Eloquent\EloquentSalesRepository;
use App\Models\Product;
use App\Models\ProductSale;
use App\Models\Sale;
use Domain\UseCases\AddProductsToExistingSaleUseCase;
use Tests\TestCase;

use Illuminate\Foundation\Testing\RefreshDatabase;

class addProductsToExistingSaleUseCaseTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     */
    public function test_add_product_to_existing_use_case(): void
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

        $salesRepository = new EloquentSalesRepository();
        $productsRepository = new EloquentProductsRepository();

        $addProductsToExistingSalesUseCase = new AddProductsToExistingSaleUseCase(
            $salesRepository,
            $productsRepository
        );

        $result = $addProductsToExistingSalesUseCase->execute([
            'products' => [
                [
                    'id' => $product1->id,
                    'amount' => 2
                ],
            ]
        ], $sale->id);

        $this->assertNotNull($result['id']);
        $this->assertEquals($result['amount'], 700);
        $this->assertEquals(count($result['products']), 3);
    }
}
