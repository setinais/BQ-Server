<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable,HasApiTokens,SoftDeletes;

    
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'name', 'email', 'password','telefone','sexo','info_client'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function acesso()
    {
    	return $this->hasOne('App\ControleAcesso');
    }

    public function professor()
    {
        return $this->hasOne('App\Professor');
    }
}
