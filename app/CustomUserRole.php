<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomUserRole extends Model
{
    protected $table = 'custom_user_role';

    protected $fillable = [
        'user_id', 'user_name', 'role_id', 'role_name'
    ];

    public $timestamp = false;
}
