<?php

namespace App\Http\Requests\StoreCrud;

use Illuminate\Foundation\Http\FormRequest;

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
                'nome'             => 'required|string',
                'matricula'        => 'required|integer',
                'cpf'                   => 'required|string|numeric|size:11',
                'id_user'               => 'required|integer',
                'documento_de_comprovacao' => 'required|file'
        ];
    }

    public function messages()
    {
        return [

                'nome.required'             => 'O :attribute é obrigatorio!',
                'nome.string'               => 'O :attribute deve ser uma Palavra!',

                'matricula.required'        => 'O :attribute é obrigatorio!',
                'matricula.integer'         => 'O :attribute deve conter somente numeros!',

                'cpf.required'                   => 'O :attribute é obrigatorio!',
                'cpf.numeric'                    => 'O :attribute deve conter somente numeros!',
                'cpf.size'                       => 'O :attribute tem que ter no 11 numeros!',

                'id_user.required'               => 'O :attribute é obrigatorio!',

                'documento_de_comprovacao.required' => 'O :attribute é obrigatorio!',
                'documento_de_comprovacao.file'     => 'O :attribute não é um arquivo!'
        ];
    }
}
