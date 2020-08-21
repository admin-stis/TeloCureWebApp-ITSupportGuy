<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;


class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    use EntrustUserTrait;
    // use Notifiable, HasRoleAndPermission;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */


    public function identities() 
    {
         return $this->hasMany('App\SocialIdentity');
    }
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

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
