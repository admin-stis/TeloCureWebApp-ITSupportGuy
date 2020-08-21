<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    protected $table = 'districts';

    protected $fillable = [
        'active','bn_name','discount',
        'division_id','est_price','id','lat',
        'lon','max_price','min_price','name'
    ];

    public $timestamp = false;
}
