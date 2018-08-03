<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Questao extends Model
{
    use SoftDeletes;
    
    protected $guarded = [];
    protected $dates = ['deleted_at'];

    public function areaConhecimento(){
    	return $this->belongsTo('App\AreaConhecimento', 'sub_categoria');
    }
}
