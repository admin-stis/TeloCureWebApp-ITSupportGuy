<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    protected $table = 'Settings';

    protected $fillable = [
        'id','SmsApi'
    ];

    public $timestamps = false;
}
