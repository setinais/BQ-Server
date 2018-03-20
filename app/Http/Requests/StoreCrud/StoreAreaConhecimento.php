<?php

namespace App\Http\Requests\StoreCrud;

use Illuminate\Foundation\Http\FormRequest;

class StoreAreaConhecimento extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()['role'] == 'admin' || $this->user()['role'] == 'professor';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'area'  => 'required|string',
            'sub_categoria' => ['sometimes',"exists:area_conhecimentos,id"]
        ];
    }

    public function messages()
    {
        return [
            'area.required' => 'Nome da :attribute obrigatorio!',
            'area.string'   => 'Não String!',

            'sub_categoria.exists'   => 'Não existe a Categoria informada!'
        ];
    }
}
