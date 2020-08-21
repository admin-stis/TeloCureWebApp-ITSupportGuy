<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vital extends Model
{
    protected $table = "vitals" ;

    protected $fillable = [
        'id','bpm','measureTime','pId','resp','temp'
    ];
}
