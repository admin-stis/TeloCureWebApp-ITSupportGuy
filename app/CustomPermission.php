<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomPermission extends Model
{
    protected $table = 'custom_permissions';

    protected $fillable = [
        'id','name','display_name','description'
    ];

    public $timestamp = false;
}
