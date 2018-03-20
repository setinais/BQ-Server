<?php

Route::post('/oauth/token','\Laravel\Passport\Http\Controllers\AccessTokenController@issueToken')->middleware('throttle')->middleware('addscopes');
Route::get('/oauth/scopes','Cruds\ControleAcessoController@index');