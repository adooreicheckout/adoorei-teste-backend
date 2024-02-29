<?php

namespace App\Domain\Product\Validators;

use Illuminate\Support\Facades\Validator;

class ProductValidator
{
    /**
     * Valida os dados de criação de produto.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public static function validateCreate(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
        ]);
    }

    /**
     * Valida os dados de atualização de produto.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public static function validateUpdate(array $data)
    {
        return Validator::make($data, [
            'name' => 'string|max:255',
            'price' => 'numeric|min:0',
            'description' => 'string',
        ]);
    }
}
