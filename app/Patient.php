<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $table = 'users';

    protected $fillable = [
        'id','name','gender','height','weight',
        'bloodGroup','district','districtId',
        'doctorType','photoUrl','hospitalName','hospitalUid',
        'hospitalized','medication','password','phone','email',
        'regNo','smoke','active','online','totalCount','totalRating',
        'createdAt','price'
    ];

    public $timestamp = false;
}
