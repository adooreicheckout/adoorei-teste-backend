<?php

namespace App\Http\Requests\Sale;

use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
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
            'perpage' => 'nullable|integer',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'perpage' => !empty(preg_replace('/[^0-9]/', '', $this->perpage)) ? preg_replace('/[^0-9]/', '', $this->perpage)  : null
        ]);
    }

    public function attribute()
    {
        return [
            'perpage' => 'por página'
        ];
    }

    public function messages(): array
    {
        return [
            'perpage.integer' => 'Informe um valor inteiro para a paginação!',
        ];
    }
}
