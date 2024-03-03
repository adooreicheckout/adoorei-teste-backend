<?php

namespace App\Http\Requests\Sale;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'products' => 'bail|required|array',
            'products.*.product_id' => 'bail|required|exists:products,product_id',
            'products.*.amount' => 'bail|required|integer|min:1',
        ];
    }

    public function atrributes(): array
    {
        return [
            'products' => 'produtos',
            'products.*.product_id' => 'ID do produto',
            'products.*.amount' => 'quantidade',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'products.required' => 'Informe os produtos da venda',
            'products.array' => 'Os produtos devem ser um array de objetos',
            'products.*.product_id.required' => 'O ID do produto é obrigatório',
            'products.*.product_id.exists' => 'O produto informado não existe na base de dados',
            'products.*.amount.required' => 'Informe a quantidade do produto',
            'products.*.amount.integer' => 'A quantidade deve ser um número inteiro',
            'products.*.amount.min' => 'A quantidade mínima é 1',
        ];
    }
}
