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
