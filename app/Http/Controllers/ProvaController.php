<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProvaController extends Controller
{
    //
    function __construct()
	{
		$this->middleware('auth:api')->except('store');
	}
}
