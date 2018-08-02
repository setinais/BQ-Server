<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Laravel\Passport\Client;

class Scopes
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $controle = null;
        if(!empty($request['username'])){
            if($request['grant_type'] == "password"){
                $controle = User::where('email',$request['username'])->first();
            }
            if($request['grant_type'] == "client_credentials"){
                $client = Client::find($request['client_id']);
                $controle = User::find($client->user_id);
            }
            if(!empty($controle)){
                $scopes = "";
                if(!empty($controle->acesso->scope))
                    $scopes = $this->transformer($controle->acesso->scope);
                if(isset($request['api']) && !empty($request['api'])){
                    $status_role = false;
                    $message = "";
                    switch ($request['api']) {
                        case 'professor':
                            if($controle->acesso->role == "professor"){
                                $status_role = true;
                            }else if($controle->acesso->role == "pendente"){
                                $message = "Cadastro sujeito a validação!";
                            }else{
                                $message = "Este acesso não é permitido nesta aplicação";
                            }
                            break;
                        case 'aluno':
                            if($controle->acesso->role == "aluno"){
                                $status_role = true;
                            }else{
                                $message = "Este acesso não é permitido nesta aplicação";
                            }
                            break;
                        default:
                            # code...
                            break;
                    }
                    if(!$status_role){
                        return response()->json(['error' => 'Permissão de acesso negada!', 'message' => $message],422);
                    }
                }else{
                    return response()->json(['error' => "parametro 'api' não identificado", 'message' => "especifique a aplicação de acesso"],422);
                }
                if(!is_null($controle))
                    $request->request->add(['scope' => $scopes]);
            }
        }
        
       return $next($request);
    }
    private function transformer($scopes)
    {
        $scopes2 = explode("[", $scopes);

        return (string) $scopes2[1]." ".$scopes2[2];
    }

}
