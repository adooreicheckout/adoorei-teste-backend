<?php


namespace Tests\Feature;

use Tests\TestCase;

class ProductsControllerTest extends TestCase
{
    /**
     * @test
     * @story Quando acessar listagem de produtos
     *        a estrutura esperada deve retornar
     *
     * @return void
     */
    public function verify_response_data_structure(): void
    {
        $response = $this->get(route('products.all'));

        $response->assertStatus(200);
        $response->assertJsonStructure($this->expectedData());
    }

    /**
     * @return array
     */
    private function expectedData(): array
    {
        return [
            [
                'product_id',
                'name',
                'price',
                'description',
                'created_at',
                'updated_at',
            ],
        ];
    }
}
