<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Questao;

class AreaConhecimento extends Model
{
    use SoftDeletes;
    
    protected $guarded = [];
    protected $dates = ['deleted_at'];

    public function questaos()
    {
    	return $this->hasMany('App\Questao', 'sub_categoria');
    }

    public function subCategorias()
    {
        return $this->belongsToMany('App\AreaConhecimento');
    }
}

/*1º nível - Grande Área: aglomeração de diversas áreas do conhecimento, em virtude da afinidade de seus objetos, métodos cognitivos e recursos instrumentais refletindo contextos sociopolíticos específicos;
2º nível – Área do Conhecimento (Área Básica): conjunto de conhecimentos inter-relacionados, coletivamente construído, reunido segundo a natureza do objeto de investigação com finalidades de ensino, pesquisa e aplicações práticas;
3º nível - Subárea: segmentação da área do conhecimento (ou área básica) estabelecida em função do objeto de estudo e de procedimentos metodológicos reconhecidos e amplamente utilizados;
4º nível - Especialidade: caracterização temática da atividade de pesquisa e ensino. Uma mesma especialidade pode ser enquadrada em diferentes grandes áreas, áreas básicas e subáreas.*/
