<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth'])->group(function () {
	//Token
	Route::post('/oauth/token/refresh','\Laravel\Passport\Http\Controllers\TransientTokenController@refresh');
	Route::get('/oauth/tokens','\Laravel\Passport\Http\Controllers\AuthorizedAccessTokenController@forUser');
	Route::delete('/oauth/tokens/{token_id}','\Laravel\Passport\Http\Controllers\AuthorizedAccessTokenController@destroy');

	//Authorize
	Route::post('/oauth/authorize','\Laravel\Passport\Http\Controllers\ApproveAuthorizationController@approve');
	Route::get('/oauth/authorize','\Laravel\Passport\Http\Controllers\AuthorizationController@authorize');
	Route::delete('/oauth/authorize','\Laravel\Passport\Http\Controllers\DenyAuthorizationController@deny');

	//Clients
	Route::get('/oauth/clients','\Laravel\Passport\Http\Controllers\ClientController@forUser');
	Route::post('/oauth/clients','\Laravel\Passport\Http\Controllers\ClientController@store');
	Route::put('/oauth/clients/{client_id}','\Laravel\Passport\Http\Controllers\ClientController@update');
	Route::delete('/oauth/clients/{client_id}','\Laravel\Passport\Http\Controllers\ClientController@destroy');

	//Personal
	Route::get('/oauth/personal-access-tokens','\Laravel\Passport\Http\Controllers\PersonalAccessTokenController@forUser');
	Route::post('/oauth/personal-access-tokens','\Laravel\Passport\Http\Controllers\PersonalAccessTokenController@store');
	Route::delete('/oauth/personal-access-tokens','\Laravel\Passport\Http\Controllers\PersonalAccessTokenController@destroy');

	//Scope
	
});
