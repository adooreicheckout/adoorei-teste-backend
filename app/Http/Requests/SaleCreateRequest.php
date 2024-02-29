<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaleCreateRequest extends FormRequest
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
            'products' => 'required|array',
            'products.*.product_id' => 'required|integer|exists:products,id',
            'products.*.amount' => 'required|integer|min:1',
        ];
    }

    public function messages(): array
    {
        return [
            'products.required' => 'The products info is required!',
            'products.array' => 'The products info must be an array!',
            'products.*.product_id.required' => 'The "product_id" field is mandatory for all products.',
            'products.*.product_id.integer' => 'The "product_id" field must be an integer.',
            'products.*.product_id.exists' => 'The "product_id" not exists',
            'products.*.amount.required' => 'The "amount" field is mandatory for all products.',
            'products.*.amount.integer' => 'The "amount" field must be an integer.',
            'products.*.amount.min' => 'The "amount" field must be at least 1.'
        ];
    }
}
