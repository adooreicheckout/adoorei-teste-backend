<?php

namespace Tests\Unit;

use App\Models\Sale;
use Tests\TestCase;
use Illuminate\Http\Response;

use Illuminate\Foundation\Testing\RefreshDatabase;

class CancelSaleFeatureTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     */
    public function test_cancel_complete_sale_feature(): void
    {
        $sale = Sale::create([
            'amount' => 500,
            'status' => Sale::STATUS_COMPLETE,
        ]);

        $response = $this->patch('/api/sales/'.$sale->id.'/cancel');
        $response->assertStatus(Response::HTTP_OK);
        $response->assertJson([
            'id' => $sale->id,
            'status' => Sale::STATUS_CANCELED,
        ]);
    }

    public function test_cancel_canceled_sale_feature(): void
    {
        $sale = Sale::create([
            'amount' => 500,
            'status' => Sale::STATUS_CANCELED,
        ]);

        $response = $this->patch('/api/sales/'.$sale->id.'/cancel');

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function test_cancel_unexistent_sale_feature(): void
    {
        $sale = Sale::create([
            'id' => 1000,
            'amount' => 500,
            'status' => Sale::STATUS_CANCELED,
        ]);

        $response = $this->patch('/api/sales/'.$sale->id.'/cancel');

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

}
