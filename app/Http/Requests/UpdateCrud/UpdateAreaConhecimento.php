<?php

namespace App\Http\Requests\UpdateCrud;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAreaConhecimento extends FormRequest
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
            'area'  => 'sometimes|string',
            'sub_categoria'      => ['sometimes',"exists:area_conhecimentos,id"]
        ];
    }

    public function messages()
    {
        return [
            'area.string'   => 'Não é uma palavra!',

            'sub_categoria.integer'  => 'Valor não inteiro!',
            'sub_categoria.exists'   => 'Não existe a Categoria informada!'
        ];
    }
}
