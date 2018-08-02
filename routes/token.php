<?php

Route::post('/oauth/token','\Laravel\Passport\Http\Controllers\AccessTokenController@issueToken')->middleware('throttle')->middleware('addscopes');
Route::get('/oauth/scopes','Cruds\ControleAcessoController@index');

Route::get('/credentials_client', function(){
	return response()->json(['client_id' => '3','client_secret' => "SCfLXW5LMB1fuSKbJI0ObbmFhpbBuOZbAUahLYaP"],200);
});