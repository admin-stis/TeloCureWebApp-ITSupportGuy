<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $table = "doctors";

    protected $fillable = [
        'uid', 'name', 'email', 'phone', 'gender', 'doctorType', 'dateOfBirth', 'regNo',
        'hospitalized', 'hospitalName', 'hospitalUid', 'password', 'photoUrl', 'districtId',
        'active', 'rejected', 'totalCount', 'totalRating', 'price', 'createdAt', 'online',
        'balance', 'bank_info', 'documents', 'others'
    ];

    public $timestamp = false;
}
