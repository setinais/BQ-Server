<?php

namespace App\Http\Requests\StoreCrud;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProfessor extends FormRequest
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
                'matricula'             => 'required|integer',
                'cpf'                   => 'required|string|numeric',
                //'documento_comprovante' => 'file',
                'name'      => 'required|string|max:255',
                'email'     => 'required|string|email|max:255|unique:users',
                'password'  => 'required|string|min:6|confirmed',
                'telefone'  => 'sometimes|numeric',
                'sexo'      => ['sometimes',Rule::in(['Masculino','Feminino']),]
        ];
    }

    public function messages()
    {
        return [

                'matricula.required'        => 'A :attribute é obrigatorio!',
                'matricula.integer'         => 'A :attribute deve conter somente numeros!',

                'cpf.required'                   => 'O :attribute é obrigatorio!',
                'cpf.numeric'                    => 'O :attribute deve conter somente numeros!',
                'cpf.size'                       => 'O :attribute tem que ter no 11 numeros!',

                'documento_comprovante.required' => 'O :attribute é obrigatorio!',
                'documento_comprovante.file'     => 'O :attribute não é um arquivo!',

                'name.required' => 'O :attribute é um campo Obrigatorio!',
                'name.string'   => 'O :attribute deve conter somente caracteries!',
                'name.max'      => 'O :attribute deve conter no maximo :max caracteries!',
                
                'email.required' => 'O :attribute é um campo Obrigatorio!',
                'email.email'    => 'Este :attribute não é valido!',
                'email.string'   => 'O :attribute deve conter somente caracteries!',
                'email.max'      => 'O :attribute deve conter no maximo :max caracteries!',
                'email.unique'   => 'Já existe um :attribute cadastro!',

                'password.required'  => 'A :attribute é obrigatoria',
                'password.string'    => 'A :attribute deve ser uma String!',
                'password.min'       => 'A :attribute deve ter no minimo :min caracteries!',
                'password.confirmed' => 'As :attribute não se coincidem!',

                'telefone.numeric' => 'O :attribute deve conter somente numeros!',

                'sexo.in' => 'Valor do :attribute invalido!'
        ];
    }
}
