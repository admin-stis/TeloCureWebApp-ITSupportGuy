<?php

namespace App\Http\Controllers\Hospital;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class HospitalController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {

        $data['hospitalUser'] = Session::get('user');

        $firestore = app('firebase.firestore');
        $database = $firestore->database();
        $info = $database->collection('hospital_users');
        $uid = $data['hospitalUser'][0]['uid'];
        $hospital_user = $info->document($uid);
        $userinfo = $hospital_user->snapshot();

        if($userinfo['login_attempt'] == false){

            $hospital_user->update([
                ['path' => 'login_attempt', 'value' => true]
            ]);

            return view('frontend/new_pass')->with($data) ;
        }else{
            return view('hospital.index')->with($data);
        }

    }

    public function addHospital()
    {
        return view('hospital/addHospital');
    }

    public function addHospitalAction(Request $request)
    {
        $firestore = app('firebase.firestore');
        $database = $firestore->database();
        $info = $database->collection('hospitals')->newDocument();

        $data = [
            'name' => $request->name,
            'branch' => $request->branchName,
            'address' => $request->address,
            'phone' => $request->phone
        ] ;

        $info->set($data);

        return view('hospital');
    }

    public function addDoctor()
    {
        return view('hospital/addDoctor');
    }
}
