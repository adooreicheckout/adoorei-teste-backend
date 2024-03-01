<?php

namespace Tests\Feature;

use App\Models\Cellphone;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CellphoneTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @return void
     */
    public function testGetAllCellphones(): void
    {
        Cellphone::factory(3)->create();

        $response = $this->get(route('cellphones.index'));

        $response->assertStatus(200);

        $response->assertJsonStructure([
            '*' => [
                'id',
                'name',
                'price',
                'description',
            ],
        ]);

        $response->assertJsonCount(3);
    }
}
