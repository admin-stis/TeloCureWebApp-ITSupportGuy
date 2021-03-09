<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = "admins";
    protected $fillable = [
        'sl','user_name','advancedPaid','balance','email','password'
    ];
    public $timestamp = false;
}
