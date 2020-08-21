<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HospitalBranch extends Model
{
    protected $table = 'hospitalbranch';

    protected $fillable = [
        'branchUid','hospitalUserId','hospitalName',
        'branch','address'
    ];

    public $timestamp = false;
}