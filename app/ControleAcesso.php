<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ControleAcesso extends Model
{
    protected $fillable = [
        'user_id','role','scope'
    ];

    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
