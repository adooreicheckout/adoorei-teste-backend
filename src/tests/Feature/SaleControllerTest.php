<?php

namespace Tests\Feature;

use App\Models\Products;
use App\Models\Sales;
use Tests\TestCase;
use Ramsey\Uuid\Uuid;

class SaleControllerTest extends TestCase
{

    /**
     * @test
     * @story cria nova venda
     * @return void
     */
    public function create_sale()
    {
        $product = $this->createProducts();

        $data['products'][] = array('product_id' => $product->product_id);

        $response = $this->post(route('sales.store', $data));

        $response->assertJsonStructure($this->expectedData());
        $response->assertStatus(200);
    }

    /**
     * @test
     * @story lista todas as vendas
     * @return void
     */
    public function get_all_sales()
    {
        $this->createProducts();

        $response = $this->get(route('sales.all'));

        $response->assertJsonStructure($this->expectedDataList());
        $response->assertStatus(200);
    }

    /**
     * @test
     * @story retorna venda pelo ID
     * @return void
     */
    public function get_sale_by_id()
    {
        $sale = $this->createSale();

        $response = $this->get(route('sales.getById', [
            'sale_id' => $sale->sale_id
        ]));

        $response->assertStatus(200);
    }

    /**
     * @test
     * @story cancela venda pelo ID
     * @return void
     */
    public function cancel_sale_by_id()
    {
        $sale = $this->createSale();

        $response = $this->delete(route('sales.cancel', [
            'sale_id' => $sale->sale_id
        ]));

        $response->assertStatus(200);
    }

     /**
     * @test
     * @story insere novo produto à uma venda existente
     * @return void
     */
    public function new_product_in_an_sale_by_id()
    {
        $sale = $this->createSale();
        $product = $this->createProducts();

        $data[] = array('product_id' => $product->product_id);

        $uri = route('sales.newProduct', ['sale_id' => $sale->sale_id]);

        $response = $this->put($uri, [
            'products' => $data,
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure($this->expectedDataList());
    }

    /**
     * @return object
     */
    private function createProducts(): object
    {
        $product = new Products();
        $product->product_id = Uuid::uuid4()->toString();
        $product->name = 'Celular 1';
        $product->price = 1800;
        $product->description = 'Lorenzo Ipsulum';
        $product->save();

        return $product;
    }

    private function createSale(): object
    {
        $product = $this->createProducts();

        $sale = new Sales();
        $sale->amount = $product->price;
        $sale->status = 'created';
        $sale->save();

        return $sale;
    }
    /**
     * @return array
     */
    private function expectedDataList(): array
    {
        return [
            [
                'sale_id',
                'amount',
                'status',
                'sale_item' => []
            ]
        ];
    }

    /**
     * @return array
     */
    private function expectedData(): array
    {
        return [
            'amount',
            'sale_id',
            'updated_at',
            'created_at',
        ];
    }
}
