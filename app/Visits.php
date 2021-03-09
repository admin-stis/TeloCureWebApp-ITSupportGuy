<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visits extends Model
{
    protected $table = 'visits' ;

    protected $fillable = [
        'sl','visitId', 'doctor', 'doctorUid', 'doctorType', 'doctorRated',
        'doctorRatingByPat', 'latitudePatient', 'longitudePatient',
        'patient', 'patientRated', 'patientRatingByDoc', 'patientUid',
        'prescriptionId', 'prescriptionUpdated', 'transactionHistory',
        'callEndTime', 'callStartTime'
    ];

    //public $timestamp = false ;
}
