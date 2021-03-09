<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomRole extends Model
{
    protected $table = 'custom_roles';

    protected $fillable = [
        'id','name','display_name','description'
    ];

    public $timestamp = false;
}
