<?php

namespace Tests\Unit;

use App\Database\Repositories\Eloquent\EloquentSalesRepository;
use App\Models\Product;
use App\Models\ProductSale;
use App\Models\Sale;
use Domain\UseCases\ShowSaleUseCase;
use Tests\TestCase;

use Illuminate\Foundation\Testing\RefreshDatabase;

class ShowSaleUseCaseTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     */
    public function test_show_sale_use_case(): void
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
            'product_id' => $product1->id,
            'sale_id' => $sale->id,
            'amount' => 2,
            'price' => 200,
        ]);

        $salesRepository = new EloquentSalesRepository();

        $showSalesUseCase = new ShowSaleUseCase(
            $salesRepository,
        );

        $result = $showSalesUseCase->execute($sale->id);

        $this->assertNotNull($result['id']);
        $this->assertNotNull($result['products']);
        $this->assertEquals(2, count($result['products']));
    }
}
