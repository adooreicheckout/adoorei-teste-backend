<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class SaleRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(Request $request): array
    {
        if (empty($request->id)) {
            $rules = ['is_active' => 'required|boolean'];
        } else {
            $rules = ['is_active' => 'prohibited'];
        }

        $rules = array_merge(
            $rules,
            [
                'products' => 'required|array',
                'products.*.product_id' => 'required|integer|exists:products,id|unique:sale_products,product_id,NULL,id,sales_id,' . $request->id,
                'products.*.amount' => 'required|integer|min:1'
            ]
        );

        return $rules;
    }

    public function messages(): array
    {
        return [
            'is_active.required' => 'O campo (is_active) é obrigatório.',
            'is_active.boolean' => 'O campo (is_active) deve ser um valor booleano.',
            'is_active.prohibited' => 'O campo (is_active) deve ser vazio nesta operação.',
            'products.required' => 'O campo (products) é obrigatório.',
            'products.array' => 'O campo (products) deve ser um array.',
            'products.*.product_id.required' => 'Cada produto deve ter um (product_id) especificado.',
            'products.*.product_id.integer' => 'O (product_id) de cada produto deve ser um número inteiro.',
            'products.*.product_id.exists' => 'O (product_id) informado não é válido.',
            'products.*.product_id.unique' => 'O (product_id) especificado já existe nesta venda.',
            'products.*.amount.required' => 'Cada produto deve ter uma quantidade (amount) especificada.',
            'products.*.amount.integer' => 'A quantidade (amount) de cada produto deve ser um número inteiro.',
            'products.*.amount.min' => 'A quantidade (amount) de cada produto deve ser pelo menos :min.',
        ];
    }
}
