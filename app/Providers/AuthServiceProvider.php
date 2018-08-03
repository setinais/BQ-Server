<?php

namespace App\Providers;

use Carbon\Carbon;
use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Passport::$revokeOtherTokens;
        Passport::$pruneRevokedTokens;
        //Passport::tokensExpireIn(Carbon::now()->addMinute(30));
        Passport::tokensExpireIn(Carbon::now()->addMinute(1));
        Passport::refreshTokensExpireIn(Carbon::now()->addHours(2));
        //
        
        Passport::tokensCan([

            //Bloco Store
            'store-areaconhecimento' => 'Adicionar Area de Conhecimento',
            'store-professor' => 'Adicionar Professor',
            'store-usuario' => 'Adicionar Usuario',
            'store-questao' => 'Adicionar Questão',

            //Bloco Update
            'update-areaconhecimento' => 'Alterar Area de Conhecimento',
            'update-professor' => 'Alterar Professor',
            'update-usuario' => 'Alterar Usuario',
            'update-questao' => 'Alterar Questão',

            //Bloco Get
            'get-areaconhecimento' => 'Selecionar Area de Conhecimento',
            'get-professor' => 'Selecionar Professor',
            'get-usuario' => 'Selecionar Usuario',
            'get-questao' => 'Selecionar Questão',

            //Bloco Destroy
            'destroy-areaconhecimento' => 'Deletar Area de Conhecimento',
            'destroy-professor' => 'Deletar Professor',
            'destroy-usuario' => 'Deletar Usuario',
            'destroy-questao' => 'Deletar Questão',

            //Bloco Semi-Supremo
            'professor' => 'Permissao de Crud dos Professores',
            'usuario' => 'Permissao de Crud dos Usuarios',
            'questao' => 'Permissao de Crud das Questões',
            'areaconhecimento' => 'Permissao de Crud das Area de Conehcimento',

            //Bloco Supremo
            'carvalho' => 'Permição do Senhor das Galaxias. Duvidas "vynny.cg@gmail.com"'
        ]);
    }
}
