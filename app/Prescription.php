<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    protected $table = 'prescriptions';

    protected $fillable = [
        'id', 'doctorId', 'medicineMap', 'patientId', 'visitId', 'vital', 'createdDate'
    ];

    public $timestamp = false ;
}
