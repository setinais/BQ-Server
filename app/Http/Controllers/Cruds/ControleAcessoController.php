<?php

namespace App\Http\Controllers\Cruds;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ControleAcesso;
use App\User;
use App\Professor;

class ControleAcessoController extends Controller
{
    private $scopes_retorno;

	function __construct()
	{
		$this->middleware('auth:api')->only('index');
	}

	public function index(Request $request)
	{
		if(!$request->user()->info_client == 'api')
			return response()->json(['message' => 'Acesso não Autorizado'],403);
		$this->filtrarScopesRetorno($request);
		return response()->json($this->scopes_retorno,200);
	}

    public function store($request,$atributes)
    {
    	//$scope_formatado_verificado = $this->formatScope($atributes['scope'],$scopes_direto_do_client);
    	$scope_formatado_verificado = $atributes['scope'];

    	return ControleAcesso::create([
    		'user_id' => $atributes['user_id'],
    		'scope' => $scope_formatado_verificado,
    	]);
    }

    public function formatScope($scopes,$allScopes)
    {
    	$scope = explode(" ", $scopes);
    	$retorno = "[";
    	$status= ['professor' => 0,'usuario' => 0,'areaconhecimento' => 0,'questao' => 0];
    	if(is_null($allScopes['scopes']['scopes_globais_acesso']))
    	{
	    	foreach ($scope as $key => $scope_name) {
	    		switch ($scope_name) {
	    			case 'professor':
	    				if(isset($allScopes['scopes']['scopes_globais_acesso'][$scope_name])){
		    				$retorno .= "professor ";
		    				$status['professor'] = 1;
		    				unset($scope[$key]);
		    			}
	    				break;
	    			case 'usuario' :
		    			if(isset($allScopes['scopes']['scopes_globais_acesso'][$scope_name])){
		    				$retorno .= "usuario ";
		    				$status['usuario'] = 1;
		    				unset($scope[$key]);
		    			}
	    				break;
	    			case 'questao':
		    			if(isset($allScopes['scopes']['scopes_globais_acesso'][$scope_name])){
		    				$retorno .= "questao ";
		    				$status['questao'] = 1;
		    				unset($scope[$key]);
		    			}
	    				break;
	    			case 'areaconhecimento':
		    			if(isset($allScopes['scopes']['scopes_globais_acesso'][$scope_name])){
		    				$retorno .= "areaconhecimento ";
		    				$status['areaconhecimento'] = 1;
		    				unset($scope[$key]);
		    			}
	    				break;
	    			default:
	    				# code...
	    				break;
	    		}
    		}
    	}
    	$retorno .= "[";
    	if(is_null($allScopes['scopes']['scopes_especificos_acesso']))
    	{
    		foreach ($scope as $key => $value) {
    			$test = explode("-", $value);
    			if(isset($test[1])){
	    			if($status[$test[1]] == 0 && !isset($allScopes['scopes']['scopes_globais_acesso'][$test[1]])){
	    				$retorno .= $value." ";
	    			}
    			}
    		}
    	}
    	return $retorno;
    }

    private function filtrarScopesRetorno(Request $request)
    {
    	$scopes_user = $request->user()->acesso->scope;
    	$scopes_user = explode("[", $scopes_user);
    	$scopes_globais = explode(" ",$scopes_user[1]);
    	$scopes_especificos = explode(" ", $scopes_user[2]);
    	$this->scopes_retorno['scopes']['message'] = 'Com os scopes globais, voce tera acesso a todas as operacões nele listadas!';

    	if(!empty($scopes_globais) || !is_null($scopes_globais))
    	{
    		$this->scopes_retorno['scopes']['scopes_globais_acesso'] = $this->switchScopesGlobais($scopes_globais);
    	}

    	if(!empty($scopes_especificos) || is_null($scopes_especificos))
    	{
    		$this->scopes_retorno['scopes']['scopes_especificos_acesso'] = $this->switchScopesEspecificos($scopes_especificos);
    	}
    }

    private function switchScopesGlobais($scopes_user) {
    	$scopes_retorno = null;
    	$scopes = $this->scopesGlobais();
    	foreach ($scopes_user as $key => $value) {
    		
	    	switch ($value) 
	    	{
		    	case 'professor':
		    		$scopes_retorno['professor'] = $scopes['carvalho']['professor'];
		    		unset($scopes_user[$key]);
		    		break;
		    	case 'usuario':
		    		$scopes_retorno['usuario'] = $scopes['carvalho']['usuario'];
		    		unset($scopes_user[$key]);
		    		break;
		    	case 'areaconhecimento':
		    		$scopes_retorno['areaconhecimento'] = $scopes['carvalho']['areaconhecimento'];
		    		unset($scopes_user[$key]);
		    		break;
		    	case 'questao':
		    		$scopes_retorno['questao'] = $scopes['carvalho']['questao'];
		    		unset($scopes_user[$key]);
		    		break;
		    	default:
		    			
		    		break;
	    	}
    	}
    	return $scopes_retorno;
    }

    private function switchScopesEspecificos($scopes_user)
    {
    	$scope = $this->scopesGlobais();
    	$all_scopes_especificos = array_merge($scope['carvalho']['professor'],$scope['carvalho']['usuario'],$scope['carvalho']['areaconhecimento'],$scope['carvalho']['questao']);
    	$retorno;
    	foreach ($scopes_user as $key => $value) {
    		$retorno[$value] = $all_scopes_especificos[$value];
    	}
    	return $retorno;
    }

    private function scopesGlobais()
    {
        return [
            'carvalho' => [
                'professor'       => [
                    'get-professor' => 'Selecionar Professor',
                    'update-professor' => 'Alterar Professor',
                    'store-professor' => 'Adicionar Professor',
                    'destroy-professor' => 'Deletar Professor',
                ],
                'usuario'     => [
                    'get-usuario' => 'Selecionar Usuario',
                    'store-usuario' => 'Adicionar Usuario',
                    'update-usuario' => 'Alterar Usuario',
                    'destroy-usuario' => 'Deletar Usuario',
                ],
                'areaconhecimento'    => [
                	'get-areaconhecimento' => 'Selecionar Area de Conhecimento',
                	'store-areaconhecimento' => 'Adicionar Area de Conhecimento',
                    'update-areaconhecimento' => 'Alterar Area de Conhecimento',
                    'destroy-areaconhecimento' => 'Deletar Area de Conhecimento',
                ],
                'questao'   => [
                	'get-questao' => 'Selecionar Questão',
                	'store-questao' => 'Adicionar Questão',
                	'update-questao' => 'Alterar Questão',
                    'destroy-questao' => 'Deletar Questão',
                ]
            ]
        ];
    }

    public function guard(Request $request)
    {
        $user_id = $request->user()->token()['user_id'];
        $user_dado = User::find($user_id);
        $professor_dado = Professor::where('user_id', $user_id)->get();
        $acesso_dado = ControleAcesso::where('user_id', $user_id)->get();

        $professor = new \stdClass;
        $professor->cpf = $professor_dado[0]->cpf;
        $professor->matricula = $professor_dado[0]->matricula_prof;

        $acesso = new \stdClass;
        $acesso->role = $acesso_dado[0]->role;
        $acesso->scope = $acesso_dado[0]->scope;

        $user = new \stdClass;
        $user->id = $user_dado->id;
        $user->email = $user_dado->email;
        $user->name = $user_dado->name;
        $user->sexo = $user_dado->sexo;
        $user->telefone = $user_dado->telefone;
        $user->info_client = $user_dado->info_client;
        $user->professor = $professor;
        $user->acesso = $acesso;

       

        return response()->json([
            $user
        ]);
    }
}
