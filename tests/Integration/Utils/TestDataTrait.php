<?php

namespace Tests\Integration\Utils;

trait TestDataTrait
{
    public static function getProductTestData()
    {
        return [
            [
                "id" => 1,
                "name" => 'teste2',
                "description" => "teste 1",
                "price" => 10.1
            ],
            [
                'id' => 2,
                "name" => 'teste2',
                "description" => "teste 2",
                "price" => 12.1
            ]
        ];
    }
}
