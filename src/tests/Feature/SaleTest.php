<?php

namespace Tests\Feature;

use App\Models\Sale;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SaleTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->artisan('migrate:fresh');

        $this->artisan('db:seed');
    }

    public function test_get_all_products()
    {
        $response = $this->get('/api/products');

        $response->assertStatus(200);
    }

    public function test_create_sale()
    {
        $data = [
            // Add your test data here for creating a sale
        ];

        $data = [
            'products' => [
                [
                    'product_id' => 1,
                    'amount' => 2
                ],
                [
                    'product_id' => 2,
                    'amount' => 3
                ]
            ]
        ];

        $response = $this->post('/api/sales', $data);

        $response->assertStatus(201);
    }

    public function test_get_all_sales()
    {
        $response = $this->get('/api/sales');

        $response->assertStatus(200);
    }

    public function test_get_sale()
    {
        $sale = Sale::query()->inRandomOrder()->first();

        $response = $this->get('/api/sales/' . $sale->sales_id);

        $response->assertStatus(200);
    }

    public function test_canceled_specific_sale()
    {
        $sale = Sale::query()->where('sales_id', 2)->first();

        $response = $this->delete('/api/sales/' . $sale->sales_id);

        $response->assertStatus(200);
    }

    public function test_update_specific_sale()
    {
        $sale = Sale::query()->where('sales_id', 2)->first();

        $data = [
            'products' => [
                [
                    'product_id' => 23,
                    'amount' => 5
                ],
                [
                    'product_id' => 40,
                    'amount' => 1
                ]
            ]
        ];

        $response = $this->patch('/api/sales/' . $sale->sales_id, $data);

        $response->assertStatus(200);
    }
}
