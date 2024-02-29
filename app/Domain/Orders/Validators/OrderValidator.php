<?php

namespace App\Domain\Orders\Validators;

use Illuminate\Support\Facades\Validator;

class OrderValidator
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
            'amount' => 'required|numeric|min:0',
            'status' => 'required|in:pending,processing,completed,cancelled',
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
            'amount' => 'required|numeric|min:0',
            'status' => 'required|in:pending,processing,completed,cancelled',
        ]);
    }
}
