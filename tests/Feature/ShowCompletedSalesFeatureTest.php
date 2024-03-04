<?php

namespace Tests\Unit;

use App\Models\Sale;
use Tests\TestCase;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;

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
        $response->assertStatus(Response::HTTP_OK);

        $completedSalesResponse = json_decode($response->getContent());

        $this->assertEquals(2, count($completedSalesResponse));
    }

    public function test_show_sale_that_dont_exists_feature(): void
    {
        $response = $this->get('/api/sales/100');

        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }
}
