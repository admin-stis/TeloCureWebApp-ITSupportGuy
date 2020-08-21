<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TreatmentRequest extends Model
{
    protected $table = "treatment_requests" ;

    protected $fillable = [
        'id', 'doctor', 'doctorUid', 'doctorType',
        'latitudePatient', 'longitudePatient',
        'patient', 'patientUid', 'prescriptionId',
        'prescriptionUpdated', 'callEndTime', 'callStartTime',
        'cardType', 'district','newZoneRequest',
        'paidAmount', 'stat', 'surge', 'vitalUpdate'
    ];
}
