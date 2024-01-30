<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'products' => 'required|array|min:1',
            'products.*.product_id' => 'required_without:products.*.name|integer',
            'products.*.name' => 'required_without:products.*.product_id|string',
            'products.*.amount' => 'required|integer',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'products.required' => 'O campo de produtos é obrigatório.',
            'products.array' => 'O campo de produtos deve ser um array.',
            'products.min' => 'Pelo menos um produto deve ser fornecido.',
            'products.*.product_id.required_without' => 'O ID do produto ou o nome do produto é obrigatório.',
            'products.*.product_id.integer' => 'O ID do produto deve ser um número inteiro.',
            'products.*.name.required_without' => 'O ID do produto ou o nome do produto é obrigatório.',
            'products.*.name.string' => 'O nome do produto deve ser uma string.',
            'products.*.amount.required' => 'O campo de quantidade é obrigatório.',
            'products.*.amount.integer' => 'A quantidade deve ser um número inteiro.',
        ];
    }
}
