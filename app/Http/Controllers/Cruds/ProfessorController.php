<?php

namespace App\Http\Controllers\Cruds;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCrud\StoreProfessor;
use App\Http\Requests\UpdateCrud\UpdateProfessor;
use App\Professor;
use App\ControleAcesso;
use App\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class ProfessorController extends Controller
{

	function __construct()
	{
		$this->middleware('auth:api')->except('store');
        //$this->middleware('scope:carvalho')->only('index');
        /*$this->middleware('scope:professor,carvalho,get-professor')->only('show');
        $this->middleware('client')->only('store');
        $this->middleware('scope:professor,carvalho,update-professor')->only('update');
        $this->middleware('scope:professor,carvalho,destroy-professor')->only('destroy');*/
	}

    public function index()
    {
        $controle = ControleAcesso::where('role','pendente')->get();
        $professor = [];
        foreach ($controle as $key => $value) {
            $professor[$key] = Professor::find($value->user_id);
        }

        return response()->json($professor);
    }

    public function show($professor_id,Request $request)
    {
        $user = User::findOrFail($request->user()->token()['user_id']);
        $professor = $user->professor;
        $controle = $user->acesso;

        $data = [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'sexo' => $user->sexo,
            'telefone' => $user->telefone,
            'matricula_prof' => $professor->matricula_prof,
            'cpf'            => $professor->cpf,
            'role' => $controle->role
        ];

    	return $data;
    }

    public function store(StoreProfessor $request)
    {
        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'sexo' => $request['sexo'],
            'telefone' => $request['telefone'],
            'password' => bcrypt($request['password']),
            'info_client' => $request['info_client']
        ]);
        if(isset($user->id)){
            $controle_acesso = new ControleAcessoController;
            $retorno = $controle_acesso->store($request,[
                'user_id' => $user->id,
                'scope' => "[usuario professor questao[get-areaconhecimento"
            ]);
            $professor = Professor::create([
                'nome_prof'             => $request['name'],
                'matricula_prof'        => $request['matricula'],
                'cpf'                   => $request['cpf'],
                'user_id'               => $user->id,
                //'documento_comprovante' => $request['documento_comprovante']
            ]);
        }
    	return response()->json([$user,$professor,$retorno],200);
    }

    public function update(UpdateProfessor $request,$professor_id)
    {
    	$user = User::findOrFail($professor_id);
        $professor = $user->professor;

        if(isset($request['name']))
                $user->name = $request['name'];
        if(isset($request['telefone']))
                $user->telefone = $request['telefone'];
        if(isset($request['sexo']))
                $user->sexo = $request['sexo'];
        if(isset($request['email']))
                $user->email = $request['email'];
     
        $user->save();

        if(isset($request['cpf']))
                $professor->cpf = $request['cpf'];
        if(isset($request['matricula']))    
                $professor->matricula_prof = $request['matricula_prof'];

        $professor->save();

        $controle = $user->acesso;

        $data = [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'sexo' => $user->sexo,
            'telefone' => $user->telefone,
            'matricula_prof' => $professor->matricula_prof,
            'cpf'            => $professor->cpf,
            'role' => $controle->role
        ];

        return $data;
    }

    public function destroy($professor_id)
    {
    	$professor = Professor::findOrFail($professor_id);

        $professor->delete();

        return true;
    }
}
