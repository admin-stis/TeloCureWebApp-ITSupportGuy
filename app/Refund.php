<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Refund extends Model
{
    protected $table = 'refunds' ;

    protected $fillable = [
        'id','balance','updatedTime'
    ];

    public $timestamp = false;
}
