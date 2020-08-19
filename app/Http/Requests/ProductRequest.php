<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => 'required',
            'price' => 'required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O nome do produto é obrigatório',
            'price.required' => 'O preço do produto é obrigatório',
            'price.numeric' => 'O preço do produto não é válido',
        ];
    }
}
