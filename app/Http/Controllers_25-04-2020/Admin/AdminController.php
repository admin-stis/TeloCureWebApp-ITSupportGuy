<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {

        $firestore = app('firebase.firestore');
   		$database = $firestore->database();
   		$docRefe = $database->collection('doctors');
   		$patientRefe = $database->collection('users');
   		$doctors = $docRefe->documents();
   		$patients = $patientRefe->documents();

   		$doctor_count = 0;
   		foreach ($doctors as $key => $value) {
   			$doctor_count++;
   		}


   		$patient = $patientRefe->documents();
   		$patient_count=0;
   		foreach ($patients as $key => $value) {
   			$patient_count++;
        }

        $data['totalPatient'] = $patient_count;

   		// $doctorsRef = $database->collection('doctors');
   		$query = $docRefe->where('active','=',true);
   		$active_doctors = $query->documents();
   		$number_of_active_doctor = 0;
   		foreach ($active_doctors as $key => $value) {
   			$number_of_active_doctor++;
        }

        $data['activeDoctor'] = $number_of_active_doctor;

        return view('admin.index')->with($data);

    }
}
