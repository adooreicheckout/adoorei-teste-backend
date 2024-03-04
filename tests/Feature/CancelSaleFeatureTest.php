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
use Illuminate\Http\Response;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CancelSaleFeatureTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     */
    public function test_cancel_completed_sale_feature(): void
    {
        $sale = Sale::create([
            'amount' => 500,
            'status' => Sale::STATUS_COMPLETED,
        ]);

        $response = $this->patch('/api/sales/'.$sale->id.'/cancel');
        $response->assertStatus(200);
        $response->assertJson([
            'id' => $sale->id,
            'status' => Sale::STATUS_CANCELLED,
        ]);
    }

    public function test_cancel_canceled_sale_feature(): void
    {
        $sale = Sale::create([
            'amount' => 500,
            'status' => Sale::STATUS_CANCELLED,
        ]);

        $response = $this->patch('/api/sales/'.$sale->id.'/cancel');

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_cancel_unexistent_sale_feature(): void
    {
        $sale = Sale::create([
            'amount' => 500,
            'status' => Sale::STATUS_CANCELLED,
        ]);

        $response = $this->patch('/api/sales/'.$sale->id.'/cancel');

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }


}
