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
                $scopes = $this->transformer($controle->acesso->scope);
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
