<?php

namespace Tests\Feature;

use App\Models\Sale;
use Database\Factories\CellphoneFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Cellphone;
use Tests\TestCase;
class SalesTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        Cellphone::factory(10)->create();


    }

    public function testCreateSale():void
    {
        $payload = $this->payload();

        $response = $this->postJson(route('sale.create'), $payload);
        $response->assertStatus(200);

        $this->assertDatabaseCount('sales', 1);
        $this->assertDatabaseCount('sale_products', 3);

    }

    public function testShowSale()
    {
        $this->createSale();

        $sale = Sale::first();

        $response = $this->get(route('sale.show',$sale->id));

        $response->assertStatus(200);
    }

    public function testSaleAddProduct(): void
    {
        $response = $this->createSale();
        $sale = Sale::first();

        $response = $this->patch(route('sale.add.product',$sale->id), $this->payload());
        $response->assertStatus(200);

        $this->assertDatabaseCount('sale_products', 6);

        $this->assertDatabaseHas('sales',[
            'amount' => 2*$sale->amount
        ]);

    }

    public function createSale(): \Illuminate\Testing\TestResponse
    {
        $payload = $this->payload();

        return $this->postJson(route('sale.create'), $payload);
    }

    public function payload(): array
    {
        return [
            'products' => [
                [
                    'id' => 1,
                    'quantity' => 1
                ],
                [
                    'id' => 2,
                    'quantity' => 2
                ],
                [
                    'id' => 4,
                    'quantity' => 1
                ]
            ]
        ];

    }
}
