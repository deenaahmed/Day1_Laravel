<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use App\Traits\CommentableTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    use CommentableTrait;
    use HasApiTokens, Notifiable;

    public function accounts(){
        return $this->hasMany('App\LinkedSocialAccount');
    }
    public function findForPassport($identifier)
    {
        return $this->orWhere('email', $identifier)->orWhere('name', $identifier)->first();
    }
    // public function accounts(){
    //     return $this->hasMany('App\LinkedSocialAccount');
    // }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
