<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','user_role','api_token','activate','social_id','user_name'  ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function profile(){
        return $this->hasOne('App\Models\profile','userid','id');
    }

    public function comments(){
        return $this->hasMany('App\Models\comment','ownerid','id');
    }

    public function isAdmin(){
        if ($this->user_role == 1){
            return true;
        }else{
            return false;
        }
    }
}
