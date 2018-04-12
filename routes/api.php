<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
/*Route::post('/redirect', function (Request $request) {
    $query = http_build_query([
        'client_id' => $request->id,
        'redirect_uri' => $request->red,
        'response_type' => $request->response,
        'scope' => $request->scope,
    ]);
    return redirect('/oauth/authorize?'.$query);
});*/
	Route::namespace('Cruds')->group(function () {
		//Rotas Adicionais
			//ControlleAcesso
		Route::get('/controle-acesso/guard', 'ControleAcessoController@guard')->middleware('auth:api')->name('contole-acesso.guard');

			//AreConhecimento
		Route::get('/area-conhecimento/categorias', 'AreaConhecimentoController@categorias')->name('area-conhecimento.categorias');
	    Route::get('/area-conhecimento/sub-categorias/{area_conhecimento}', 'AreaConhecimentoController@subCategorias')->name('area-conhecimento.subCategorias');
	    Route::get('/area-conhecimento/areas-encadeadas', 'AreaConhecimentoController@getAreasEncadeadas')->name('area-conhecimento.getAreasEncadeadas');
	    Route::post('/area-conhecimento/getQntdQuestao', 'AreaConhecimentoController@getQntdQuestao')->name('area-conhecimento.getQntdQuestao');
	    Route::post('/area-conhecimento/getQuestoesProva', 'AreaConhecimentoController@getQuestoesProva')->name('area-conhecimento.getQuestoesProva');
	    	//Questao
	    

	    	//Professor
	    	
	    // Controllers Within The "App\Http\Controllers\Cruds" Namespace
	    Route::apiResources([
			'questao' => 'QuestaoController',
			'professor' => 'ProfessorController',
			'area-conhecimento' => 'AreaConhecimentoController',
			'usuario' => 'UserController'
		]);
	});