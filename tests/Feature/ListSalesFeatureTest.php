<?php

namespace Tests\Unit;

use App\Models\Sale;
use Tests\TestCase;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;

class ListSalesFeatureTest extends TestCase
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
            'status' => Sale::STATUS_CANCELED,
        ]);

        Sale::create([
            'amount' => 500,
            'status' => Sale::STATUS_COMPLETE,
        ]);

        $response = $this->get('/api/sales');
        $response->assertStatus(Response::HTTP_OK);

        $completeSalesResponse = json_decode($response->getContent());

        $this->assertEquals(3, count($completeSalesResponse));
    }
}
