<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductListRequest extends FormRequest
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
            'paginate' => 'nullable|integer',
            'qry' => 'nullable|string'
        ];
    }

    public function messages(): array
    {
        return [
            'paginate.integer' => 'The paginate info must be integer type!',
            'qry.string' => 'The query info must be string type!',
        ];
    }
}
