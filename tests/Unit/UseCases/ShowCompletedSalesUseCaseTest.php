<?php

namespace Tests\Unit;

use App\Database\Repositories\Eloquent\EloquentSalesRepository;
use App\Models\Sale;
use Domain\UseCases\ShowCompletedSalesUseCase;
use Tests\TestCase;

use Illuminate\Foundation\Testing\RefreshDatabase;

class ShowCompletedSalesUseCaseTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     */
    public function test_show_sale_use_case(): void
    {
        Sale::create([
            'amount' => 500,
            'status' => Sale::STATUS_COMPLETED,
        ]);

        Sale::create([
            'amount' => 500,
            'status' => Sale::STATUS_CANCELLED,
        ]);

        Sale::create([
            'amount' => 500,
            'status' => Sale::STATUS_COMPLETED,
        ]);

        $salesRepository = new EloquentSalesRepository();

        $showSalesUseCase = new ShowCompletedSalesUseCase(
            $salesRepository,
        );

        $result = $showSalesUseCase->execute();

        $this->assertEquals(2, count($result));
    }
}
