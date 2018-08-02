<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreCrud\StoreProva;

class ProvaController extends Controller
{
    //
    function __construct()
	{
		$this->middleware('auth:api')->except('store');
	}

	public function elaborarProva(StoreProva $request){
		
	}
}
