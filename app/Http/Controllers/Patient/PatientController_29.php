<?php

namespace App\Http\Controllers\Patient;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class PatientController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        $firestore = app('firebase.firestore');
        $database = $firestore->database();

        $data['patientData'] = session::get('user');

        $patientVisit = $database->collection('visits');

        $query = $patientVisit->where('patientUid','=',$data['patientData'][0]['uid']) ;
        $patient = $query->documents();

        $data['visits'] = array();
        foreach ($patient as $value){
            array_push($data['visits'],$value->data());
        }

        $prescription = $database->collection('prescription');
        $query = $prescription->where('pId','=',$data['patientData'][0]['uid']);
        $pdata = $prescription->documents();

        $data['prescription'] = array();

        foreach($pdata as $key=>$value){
            array_push($data['prescription'],$value->data());
        }
        // dd($pdata);
        // dd($data['prescription']);

        return view('patient.index')->with($data);
    }

    public function diagnosis($uid)
    {
        $firestore = app('firebase.firestore');
        $database = $firestore->database();

        $patientData = $database->collection('users');
        $diagnosisData = $database->collection('vitals');

        $queryPatient = $patientData->where('uid','=',$uid);
        $patient = $queryPatient->documents();
        $data['patient'] = array();

        foreach($patient as $key=>$value){
            array_push($data['patient'],$value->data());
        }

        $query = $diagnosisData->where('pId','=',$uid);
        $diagnosis = $query->documents();

        $data['diagnosis'] = array();

        foreach($diagnosis as $key=>$value){
            array_push($data['diagnosis'],$value->data());
        }

        return view('patient.diagnosis')->with($data);
    }

    public function ePrescription($uid)
    {
        $firestore = app('firebase.firestore');
        $database = $firestore->database();

        $patientData = $database->collection('users');
        $doctorData = $database->collection('doctors');

        $queryPatient = $patientData->where('uid','=',$uid);
        $patient = $queryPatient->documents();
        $data['patient'] = array();

        $queryDoctor = $doctorData->where('uid','=',$uid);
        $doctor = $queryDoctor->documents();
        $data['doctor'] = array();

        foreach($doctor as $key=>$value){
            array_push($data['doctor'],$value->data());
        }

        $prescription = $database->collection('prescription');
        $query = $prescription->where('pId','=',$uid);
        $pdata = $prescription->documents();

        $data['prescription'] = array();

        foreach($pdata as $key=>$value){
            array_push($data['prescription'],$value->data());
        }

        return view('patient.prescription');
    }
}
