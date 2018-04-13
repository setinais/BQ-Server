<?php

namespace App\Http\Controllers\Cruds;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCrud\StoreQuestao;
use Illuminate\Http\Request;
use App\Questao;
use App\AreaConhecimento;
use App\Professor;
class QuestaoController extends Controller
{

	function __construct()
	{
		$this->middleware('auth:api');
        $this->middleware('scope:questao,carvalho, get-questao')->only('index');
        $this->middleware('scope:questao,carvalho, get-questao')->only('show');
        $this->middleware('scope:questao,carvalho, store-questao')->only('store');
        $this->middleware('scope:questao,carvalho, update-questao')->only('update');
        $this->middleware('scope:questao,carvalho, destroy-questao')->only('destroy');
	}

    public function index()
    {
       $questoes = Questao::paginate(10);
        $response = $questoes;
        foreach ($questoes as $key => $value) {
            $response[$key] = $questoes[$key];
            $response[$key]->disciplina_id = AreaConhecimento::find($questoes[$key]->disciplina_id);
            $response[$key]->professor_id = Professor::find($questoes[$key]->professor_id);
        }
        return $response;
    }

    public function show($questao_id, Request $request)
    {
        $id = $request->user()->token()['user_id'];
        $professor = Professor::where('user_id',$id)->get();
        $questoes = Questao::where('professor_id',$professor[0]->id)->paginate(10);
        $response = $questoes;
        foreach ($questoes as $key => $value) {
            $response[$key] = $questoes[$key];
            $response[$key]->sub_categoria = AreaConhecimento::find($questoes[$key]->sub_categoria);
            $response[$key]->professor_id = Professor::find($questoes[$key]->professor_id);
        }
    	return $response;
    }

    public function store(StoreQuestao $request)
    {
        $id = $request->user()->token()['user_id'];
        $professor = Professor::where('user_id',$id)->get();
    	return Questao::create([
                'enunciado'     => $request['enunciado'],
                'alternativas'  => json_encode($request['alternativas']),
                'alternativa_correta' => $request['alternativa_correta'],
                'nivel'         => $request['nivel'],
                'sub_categoria' => $request['sub_categoria'],
                'professor_id'  => $professor[0]->id
        ]);

        /* Parametros Envio
                "enunciado"     : "fewfewfewfwefwefwefwe",
                "alternativas"  : "[fewfew,fewfew,fewfwe,fewfwefwe]",
                "nivel"         : "5",
                "sub_categoria" : "[25,44,46,55]",
                "disciplina_id" : "1",
                "professor_id"  : "1"
        */
    }

    public function update(StoreQuestao $request,$questao_id)
    {
    	$questao = Questao::findOrFail($questao_id);

        if(isset($request['pergunta']))
                $questao->enunciado     = $request['pergunta'];
        if(isset($request['alternativas']))    
                $questao->alternativas  = $request['alternativas'];
        if(isset($request['dificuldade']))
                $questao->nivel         = $request['dificuldade'];
        if(isset($request['sub_categoria']))
                $questao->sub_categoria = $request['sub_categoria'];
        if(isset($request['disciplina_id']))
                $questao->disciplina_id = $request['disciplina_id'];
        if(isset($request['professor_id']))
                $questao->professor_id  = $request['professor_id'];

        $questao->save();

        return $questao;
    }

    public function destroy($questao_id)
    {
    	$questao = Questao::findOrFail($questao_id);

        $questao->delete();

        return $questao;
    }
}
