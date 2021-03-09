<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomRolePermission extends Model
{
    protected $table = 'custom_role_permission';

    protected $fillable = [
        'role_id','role_name','permission_id','permission_name'
    ];

    public $timestamp = false;
}
