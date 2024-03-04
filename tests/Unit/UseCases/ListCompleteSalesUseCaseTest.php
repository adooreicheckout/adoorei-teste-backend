<?php

namespace Tests\Unit;

use App\Database\Repositories\Eloquent\EloquentSalesRepository;
use App\Models\Sale;
use Domain\UseCases\ListCompleteSalesUseCase;
use Tests\TestCase;

use Illuminate\Foundation\Testing\RefreshDatabase;

class ListCompleteSalesUseCaseTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     */
    public function test_show_sale_use_case(): void
    {
        Sale::create([
            'amount' => 500,
            'status' => Sale::STATUS_COMPLETE,
        ]);

        Sale::create([
            'amount' => 500,
            'status' => Sale::STATUS_CANCELED,
        ]);

        Sale::create([
            'amount' => 500,
            'status' => Sale::STATUS_COMPLETE,
        ]);

        $salesRepository = new EloquentSalesRepository();

        $showSalesUseCase = new ListCompleteSalesUseCase(
            $salesRepository,
        );

        $result = $showSalesUseCase->execute();

        $this->assertEquals(2, count($result));
    }
}
