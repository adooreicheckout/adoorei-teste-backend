<?php

namespace Tests\Unit;

use App\Models\Sale;
use Tests\TestCase;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;

class ListCompleteSalesFeatureTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     */
    public function test_show_sale_that_exists_feature(): void
    {
        Sale::create([
            'amount' => 500,
            'status' => Sale::STATUS_COMPLETE,
        ]);

        Sale::create([
            'amount' => 500,
            'status' => Sale::STATUS_CANCELLED,
        ]);

        Sale::create([
            'amount' => 500,
            'status' => Sale::STATUS_COMPLETE,
        ]);

        $response = $this->get('/api/sales/status/complete');
        $response->assertStatus(Response::HTTP_OK);

        $completeSalesResponse = json_decode($response->getContent());

        $this->assertEquals(2, count($completeSalesResponse));
    }

    public function test_show_sale_that_dont_exists_feature(): void
    {
        $response = $this->get('/api/sales/100');

        $response->assertStatus(Response::HTTP_NOT_FOUND);
    }
}
