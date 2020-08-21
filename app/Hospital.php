<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    protected $table = 'hospitals';

    protected $fillable = ['hospitalUid', 'hospitalName', 'hospitalAddress', 'name','phone',
     'email', 'login_attempt', 'comment', 'password', 'online', 'active','plan',
     'approve', 'balance', 'bank_info'];

    public $timestamp = false ;
}
