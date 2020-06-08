<?php

namespace App\Http\Controllers\Doctor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DoctorController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        // $query = $userRef->where('email','=',$email)->where('password','=',$request->password);
        // $userInfo = $query->documents();
        // $firestore = app('firebase.firestore');
        // $db = $firestore->database();

        // $docRef = $db->collection('doctors')->documents();

        // $data['doctorProfile'] = $docRef->snapshot()->data();
        // return view('doctor.profile')->with($data);
        return view('doctor.index');

    }

    public function completeProfile()
    {
        return view('doctor.complete-profile');
    }

    public function profile($id)
    {
        $firestore = app('firebase.firestore');
        $db = $firestore->database();

        $docRef = $db->collection('doctors')->document($id);
        //   $snapshot = $docRef->snapshot();
        //   return $snapsot->data();
        $data['doctorProfile'] = $docRef->snapshot()->data();
        return view('doctor.profile')->with($data);
    }
}
