<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VendasControllerTest extends TestCase
{

    use DatabaseTransactions;


    public function testStoreMethodCreatesSale()
    {
        $data = [
            'products' => [
                ['product_id' => 1, 'price' => '100,50', 'amount' => 2],
                ['product_id' => 2, 'price' => '50,25', 'amount' => 3],
            ],
        ];

        $response = $this->postJson('/api/sales', $data);

        $response->assertStatus(201)
            ->assertJson(['msg' => 'criado com sucesso']);

        $this->assertDatabaseHas('vendas', ['amount' => "351.75"]);
        $this->assertDatabaseCount('vendas', 1);
        $this->assertDatabaseHas('vendas_has_produtos', ['product_id' => 1, 'amount' => 2]);
        $this->assertDatabaseHas('vendas_has_produtos', ['product_id' => 2, 'amount' => 3]);
    }

    public function testUpdateMethodUpdatesSaleDetails()
    {
        $data = [
            'products' => [
                ['product_id' => 1, 'price' => '150.75', 'amount' => 4],
            ],

        ];

        $response = $this->putJson('/api/vendas/1', $data);

        $response->assertStatus(204);

        $this->assertDatabaseHas('vendas', ['amount' => 603.00]);
        $this->assertDatabaseHas('produto_venda', ['produto_id' => 1, 'amount' => 4]);
    }


    public function testIndexMethodReturnsAllSales()
    {
        $response = $this->getJson('/api/sales');

        $response->assertStatus(200)
            ->assertJsonStructure([
                '*' => [
                    'sales_id',
                    'amount',
                    'status',
                    'products' => [
                        '*' => [
                            'product_id',
                            'nome',
                            'price',
                            'amount',
                        ],
                    ],
                ],
            ]);
    }

    public function testShowMethodReturnsSaleDetails()
    {
        $response = $this->getJson('/api/sales/8');

        $response->assertStatus(200)
            ->assertJson([
                'sales_id' => 8,
                'amount' => "8200.00",
                "status" => true,
                'products' => [
                    [
                        "product_id" => 2,
                        "nome" => "Samsung Galaxy S21",
                        "price" => "1800.00",
                        "amount" => 1
                    ],
                    [
                        "product_id" => 3,
                        "nome" => "Google Pixel 6",
                        "price" => "3200.00",
                        "amount" => 2
                    ],
                ],
            ]);
    }

    public function testCancelSaleMethodCancelsSale()
    {
        $response = $this->getJson('/api/sales/cancel/8');

        $response->assertStatus(200)
            ->assertJson(['msg' => 'Venda 8 cancelada!']);

        $this->assertDatabaseHas('vendas', ['id' => 8, 'status' => 0]);
    }

    public function testDestroyMethodDeletesSale()
    {
        $response = $this->deleteJson('/api/sales/8');

        $response->assertStatus(204);

        $this->assertDatabaseMissing('vendas', ['id' => 1]);
    }

}
