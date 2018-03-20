<?php

namespace App\Http\Controllers\Cruds;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCrud\StoreProfessor;
use App\Http\Requests\UpdateCrud\UpdateProfessor;
use App\Professor;

use Illuminate\Support\Facades\Auth;

class ProfessorController extends Controller
{

	function __construct()
	{
		$this->middleware('auth:api');
        $this->middleware('scope:carvalho')->only('index');
        $this->middleware('scope:professor,carvalho,get-professor')->only('show');
        $this->middleware('scope:professor,carvalho,store-professor')->only('store');
        $this->middleware('scope:professor,carvalho,update-professor')->only('update');
        $this->middleware('scope:professor,carvalho,destroy-professor')->only('destroy');
	}

    public function index()
    {
        return response()->json('Page Not Faund',404);
    }

    public function show($professor_id)
    {
    	return Professor::findOrFail($professor_id);
    }

    public function store(StoreProfessor $request)
    {
    	return Professor::create([
                'nome_prof'             => $request['nome'],
                'matricula_prof'        => $request['matricula'],
                'cpf'                   => $request['cpf'],
                'user_id'               => $request['id_user'],
                'documento_comprovante' => $request['documento_de_comprovacao']
        ]);
    }

    public function update(UpdateProfessor $request,$professor_id)
    {
    	$professor = Professor::findOrFail($professor_id);

        if(isset($request['nome']))
                $professor->nome_prof = $request['nome'];
        if(isset($request['matricula']))    
                $professor->matricula_prof = $request['matricula'];
        if(isset($request['documento_de_comprovacao']))
                $professor->documento_comprovante = $request['documento_de_comprovacao'];

        $professor->save();
        
        return $professor;

    }

    public function destroy($professor_id)
    {
    	$professor = Professor::findOrFail($professor_id);

        $professor->delete();

        return true;
    }
}
