<?php

namespace App\Domain\Product\DTO;

use App\Domain\Product\Validators\ProductValidator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateProductDTO
{
    public $name;
    public $price;
    public $description;

    public function __construct($name, $price, $description)
    {
        $this->name = $name;
        $this->price = $price;
        $this->description = $description;
    }

    /**
     * Valida os dados do DTO usando o ProductValidator.
     *
     * @return array
     * @throws \Illuminate\Validation\ValidationException
     */
    public function validate()
    {
        $data = [
            'name' => $this->name,
            'price' => $this->price,
            'description' => $this->description,
        ];

        $validator = ProductValidator::validateCreate($data);

        if ($validator->fails()) {
            throw new HttpResponseException(response()->json([
                'success'   => false,
                'data'      => $validator->errors()
            ],400));
        }

        return $data;
    }
}
