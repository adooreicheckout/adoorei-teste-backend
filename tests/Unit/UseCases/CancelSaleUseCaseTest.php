<?php

namespace Tests\Unit;

use App\Database\Repositories\Eloquent\EloquentSalesRepository;
use App\Models\Sale;
use Domain\UseCases\CancelSaleUseCase;
use Tests\TestCase;

use Illuminate\Foundation\Testing\RefreshDatabase;

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
