<?php

namespace Tests\Unit;

use App\Database\Repositories\Eloquent\EloquentSalesRepository;
use App\Models\Sale;
use Domain\UseCases\ListSalesUseCase;
use Tests\TestCase;

use Illuminate\Foundation\Testing\RefreshDatabase;

class ListSalesUseCaseTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     */
    public function test_list_sales_use_case(): void
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

        $showSalesUseCase = new ListSalesUseCase(
            $salesRepository,
        );

        $result = $showSalesUseCase->execute();

        $this->assertEquals(3, count($result));
    }
}
