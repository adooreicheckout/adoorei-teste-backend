<?php

namespace App\Http\Requests\Sale;

use Illuminate\Foundation\Http\FormRequest;

class ShowRequest extends FormRequest
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
            'id' => 'required|integer|exists:sales,sales_id',
        ];
    }

    public function attribute()
    {
        return [
            'id' => 'id da venda'
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'id' => !empty(preg_replace('/[^0-9]/', '', $this->id)) ? preg_replace('/[^0-9]/', '', $this->id)  : null
        ]);
    }

    public function messages(): array
    {
        return [
            'id.required' => 'Informe o id da venda.',
            'id.integer' => 'Informe um número inteiro para o id da venda.',
            'id.exists' => 'A venda informada não existe na base de dados.'
        ];
    }
}
