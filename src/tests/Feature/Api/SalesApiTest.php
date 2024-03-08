<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Product;
use App\Models\Sale;
use Tests\TestCase;

class SalesApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test a successful request to get a list of sales.
     *
     * @return void
     */
    public function testGetSales()
    {
        Sale::factory()->count(5)->create();

        $response = $this->get('/api/sales');

        $response->assertStatus(200);
    }

    /**
     * Test a successful request to get a single sale by ID.
     *
     * @return void
     */
    public function testGetSingleSale()
    {
        $sale = Sale::factory()->create();

        $response = $this->get('/api/sales/' . $sale->id);

        $response->assertStatus(200);
    }

    /**
     * Test creating a new sale.
     *
     * @return void
     */
    public function testCreateSale()
    {
        $product1 = Product::factory()->create();
        $product2 = Product::factory()->create();

        $payload = [
            'is_active' => 1,
            'products' => [
                [
                    'product_id' => $product1->id,
                    'amount' => 2
                ],
                [
                    'product_id' => $product2->id,
                    'amount' => 1
                ]
            ]
        ];

        $response = $this->post('/api/sales', $payload);

        $response->assertStatus(201);
    }

    /**
     * Test updating a sale.
     *
     * @return void
     */
    public function testUpdateSale()
    {
        $product3 = Product::factory()->create();
        $sale = Sale::factory()->create();

        $payload = [
            'products' => [
                [
                    'product_id' => $product3->id,
                    'amount' => 1
                ]
            ]
        ];

        $response = $this->put('/api/sales/' . $sale->id, $payload);

        $response->assertStatus(200);
    }

    /**
     * Test canceling a sale.
     *
     * @return void
     */
    public function testCancelSale()
    {
        $sale = Sale::factory()->create();

        $response = $this->patch('/api/sales/' . $sale->id);

        $response->assertStatus(200);
    }
}
