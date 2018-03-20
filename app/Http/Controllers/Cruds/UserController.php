<?php

namespace App\Http\Controllers\Cruds;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCrud\StoreUser;
use App\Http\Requests\UpdateCrud\UpdateUser;
use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Cruds\ControleAcessoController;

class UserController extends Controller
{
    function __construct()
	{
		$this->middleware('auth:api')->except('store');
        $this->middleware('scope:carvalho')->only('index');
        $this->middleware('scope:usuario,carvalho,get-usuario')->only('show');
        $this->middleware('client')->only('store');
        $this->middleware('scope:usuario,carvalho,update-usuario')->only('update');
        $this->middleware('scope:usuario,carvalho,destroy-usuario')->only('destroy');
	}

    public function index()
    {
        return User::all();	
    }

    public function show($user_id)
    {
        return User::findOrFail($user_id);
    }

    public function store(StoreUser $request)
    {
        
        $request['scope'] = '[[carvalho';
    	$user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'sexo' => $request['sexo'],
            'telefone' => $request['telefone'],
            'password' => bcrypt($request['password']),
            'info_client' => 'NULL'
        ]);
        if(isset($user->id))
            $controle_acesso = new ControleAcessoController;
            $retorno = $controle_acesso->store($request,[
                'user_id' => $user->id,
                'scope' => $request['scope']
            ]);
        return response()->json([$user],200); 
        /*Parametros de envio 
			
			"name" : "Vinnciyus carvalho",
			"email" : "vynny.cg@gmailc.om",
			"sexo" : "Masculino",
			"telefone" : "63999878410",
			"password" : "0v2m56gtf",
			"password_confirmation" : "0v2m56gtf"
            "scope" : store-usuario store-professor
		
        */
    }

    public function update(UpdateUser $request,$user_id)
    {
    	$user = User::findOrFail($user_id);

        if(isset($request['name']))
                $user->name = $request['name'];
        if(isset($request['password']))
                $user->password = bcrypt($request['password']);
        if(isset($request['celular']))
                $user->telefone = $request['telefone'];
		if(isset($request['sexo']))
                $user->sexo = $request['sexo'];
     
        $user->save();

        return $user;
    }

    public function destroy($user_id)
    {
    	$user = User::findOrFail($user_id);

        $user->delete();

        return true;
    }
}
