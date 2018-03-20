<?php

namespace App\Http\Controllers\Cruds;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCrud\StoreAreaConhecimento;
use App\Http\Requests\UpdateCrud\UpdateAreaConhecimento;
use App\AreaConhecimento;

class AreaConhecimentoController extends Controller
{

	function __construct()
	{
		$this->middleware('auth:api');
        $this->middleware('scope:carvalho')->only('index');
        $this->middleware('scope:areaconhecimento,carvalho,get-areaconhecimento')->only('categorias');
        $this->middleware('scope:areaconhecimento,carvalho,get-areaconhecimento')->only('subCategorias');
        $this->middleware('scope:areaconhecimento,carvalho,get-areaconhecimento')->only('show');
        $this->middleware('scope:areaconhecimento,carvalho,store-areaconhecimento')->only('store');
        $this->middleware('scope:areaconhecimento,carvalho,update-areaconhecimento')->only('update');
        $this->middleware('scope:areaconhecimento,carvalho,destroy-areaconhecimento')->only('destroy');

	}

    public function index()
    {
        return AreaConhecimento::all();
    }

    public function categorias()
    {
        return AreaConhecimento::where('sub_categoria_id')->get();
    }

    public function subCategorias($sub_categoria_id)
    {
        if(AreaConhecimento::findOrFail($sub_categoria_id)->sub_categoria_id == NULL)
            return AreaConhecimento::where('sub_categoria_id',$sub_categoria_id)->get();
        return response()->json(['Categoria informada inexistente!'],200);
    }

    public function show($area_id)
    {
    	return AreaConhecimento::findOrFail($area_id);
    }

    public function store(StoreAreaConhecimento $request)
    {
        if(!isset($request['sub_categoria']) && (string) $request->user()['role'] === (string) 'admin'){
            $request['sub_categoria'] = NULL;
            return AreaConhecimento::create([
                    'area_de_conhecimento' => $request['area'],
                    'sub_categoria_id'     => $request['sub_categoria'],
            ]);
        }else if(isset($request['sub_categoria']) && $request->user()['role'] != 'usuario'){
        	return AreaConhecimento::create([
                    'area_de_conhecimento' => $request['area'],
                    'sub_categoria_id'     => $request['sub_categoria'],
            ]);
        }else{
            return response()->json(['Usuario não autorizado!'],403);
        }
    }

    public function update(UpdateAreaConhecimento $request,$area_id)
    {
    	$area = AreaConhecimento::findOrFail($area_id);

        if(isset($request['area']))
                $area->area_de_conhecimento = $request['area'];
        if(isset($request['sub_categoria']))
                $area->sub_categoria_id = $request['sub_categoria'];

        $area->save();

        return $area;
    }

    public function destroy($area_id)
    {
    	$area = AreaConhecimento::findOrFail($area_id);

        $area->delete();

        return $area;
    }
}
