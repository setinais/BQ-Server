<?php

namespace App\Http\Requests\UpdateCrud;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Professor;

class UpdateUser extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return (int) $this->user()->token()['user_id'] === $this->route('usuario');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'      => 'sometimes|string|max:100',
            'password'  => 'sometimes|string|min:6|confirmed',
            'telefone'  => 'sometimes|numeric|max:14',
            'sexo'      => ['sometimes',Rule::in(['Masculino','Feminino'])],
            'user_id'   => 'required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O :attribute é um campo Obrigatorio!',
            'name.string'   => 'O :attribute deve conter somente caracteries!',
            'name.max'      => 'O :attribute deve conter no maximo :max caracteries!',

            'password.required'     => 'A :attribute é obrigatoria',
            'password.string'       => 'A :attribute deve ser uma String!',
            'password.min'          => 'A :attribute deve ter no minimo :min caracteries!',
            'password.confirmed'    => 'As :attribute não se coincidem!',

            'telefone.numeric' => 'O :attribute deve conter somente numeros!',
            'telefone.max' => 'O :attribute deve conter no maximo :max numeros!',

            'sexo.in' => 'Valor do :attribute invalido!',

            'user_id.required' => 'Usuario não informado!',
        ];
    }
}
