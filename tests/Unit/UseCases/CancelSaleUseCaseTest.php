<?php

namespace Tests\Unit;

use App\Database\Repositories\Eloquent\EloquentProductsRepository;
use App\Database\Repositories\Eloquent\EloquentSalesRepository;
use App\Models\Product;
use App\Models\ProductSale;
use App\Models\Sale;
use Domain\UseCases\CancelSaleUseCase;
use Domain\UseCases\CreateSaleUseCase;
use Domain\UseCases\ShowSaleUseCase;
use Tests\TestCase;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CancelSaleUseCaseTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     */
    public function test_cancel_completed_sale_use_case(): void
    {
        $sale = Sale::create([
            'amount' => 500,
            'status' => Sale::STATUS_COMPLETED,
        ]);

        $salesRepository = new EloquentSalesRepository();

        $cancelSalesUseCase = new CancelSaleUseCase(
            $salesRepository,
        );

        $result = $cancelSalesUseCase->execute($sale->id);

        $this->assertNotNull($result['id']);
        $this->assertEquals($result['status'], Sale::STATUS_CANCELLED);
    }

}
