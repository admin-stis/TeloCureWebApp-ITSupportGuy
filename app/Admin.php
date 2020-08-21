<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = "admins";
    protected $fillable = [
        'id','advancedPaid','balance','email','password'
    ];
    public $timestamp = false;
}
