<?php

namespace App\Http\Requests\StoreCrud;

use Illuminate\Foundation\Http\FormRequest;


class StoreQuestao extends FormRequest
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
            "enunciado"     => "required|",
            "alternativas"  => "required|",
            "nivel"         => "required|",
            "sub_categoria" => ["integer","exists:area_conhecimentos,id"],
            //"professor_id"  => ["integer","exists:professors,id"]
        ];
    }

    public function messages()
    {
        return [

            'sub_categoria.*' => "Não existe a Sub Categoria informada!"
        ];
    }
}
