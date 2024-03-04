<?php

namespace Tests\Unit;

use App\Database\Repositories\Eloquent\EloquentProductsRepository;
use App\Database\Repositories\Eloquent\EloquentSalesRepository;
use App\Models\Product;
use Domain\UseCases\CreateSaleUseCase;
use Tests\TestCase;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CreateSaleUseCaseTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     */
    public function test_create_sale_use_case(): void
    {
        $product = Product::create([
            'name' => 'Product 1',
            'description' => 'Product 1 description',
            'price' => 100,
        ]);

        $salesRepository = new EloquentSalesRepository();
        $productsRepository = new EloquentProductsRepository();

        $createSaleUseCase = new CreateSaleUseCase(
            $salesRepository,
            $productsRepository
        );

        $result = $createSaleUseCase->execute([
            'products' => [
                [
                    'id' => $product->id,
                    'amount' => 2
                ],
            ]
        ]);

        $this->assertNotNull($result['id']);
    }
}
