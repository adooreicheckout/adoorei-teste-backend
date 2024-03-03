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

class ShowCompletedSalesFeatureTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     */
    public function test_show_sale_that_exists_feature(): void
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

        $response = $this->get('/api/sales/status/completed');
        $response->assertStatus(200);

        $completedSalesResponse = json_decode($response->getContent());

        $this->assertEquals(2, count($completedSalesResponse));
    }

    public function test_show_sale_that_dont_exists_feature(): void
    {
        $response = $this->get('/api/sales/100');

        $response->assertStatus(404);
    }
}
