<?php

namespace App\Http\Requests\UpdateCrud;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfessor extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $professor = Professor::find((int) $this->route('professor'));
        if(is_null($professor) || empty($professor))
            return false;
        return (int) $this->user()->token()['user_id'] === (int) $professor['user_id'];

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
                'nome'             => 'somentimes|string',
                'matricula'        => 'somentimes|integer',
                'documento_de_comprovacao' => 'somentimes|file'
        ];
    }

    public function messages()
    {
        return [

                'nome.required'             => 'O :attribute é obrigatorio!',
                'nome.string'               => 'O :attribute deve ser uma Palavra!',

                'matricula.required'        => 'O :attribute é obrigatorio!',
                'matricula.integer'         => 'O :attribute deve conter somente numeros!',

                'documento_de_comprovacao.required' => 'O :attribute é obrigatorio!',
                'documento_de_comprovacao.file'     => 'O :attribute não é um arquivo!'
        ];
    }
}
