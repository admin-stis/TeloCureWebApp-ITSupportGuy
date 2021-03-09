<?php

namespace App\Http\Controllers\Patient;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Visits;
use App\Prescription;
use App\Doctor;
use App\District;

class PatientController extends Controller
{
    public function __construct()
    {
        $firestore = app('firebase.firestore');
        $database = $firestore->database();
        $patientData = $database->collection('users');
    }

    public function index()
    {

        $firestore = app('firebase.firestore');
        $database = $firestore->database();

        $data['patientData'] = session::get('user');

        // $patientVisit = $database->collection('visits');

        // $query = $patientVisit->where('patientUid','=',$data['patientData'][0]['uid']) ;
        // $patient = $query->documents();

        $patient = Visits::where('patientUid', $data['patientData'][0]['uid'])->get()->toArray();

        //dd($data['patientData']);

        // $prescription = $database->collection('prescription')
        //         ->document($data['patientData'][0]['uid']);

        $prescription = Prescription::where('patientId', $data['patientData'][0]['uid'])->get()->toArray();

        $data['visits'] = array();
        foreach ($patient as $value) {
            array_push($data['visits'], $value);
        }

        // dd($data['visits']);

        $presInfo = array();
        $data['pres'] = array();

        foreach ($data['visits'] as $visitInfo) {
            // $docId = $prescription->collection($visitInfo['doctorUid'])
            // ->orderBy('createdDate', 'ASC')->limit(5);
            // $presId = $docId->documents();

            $presId = Prescription::where('doctorId', $visitInfo['doctorUid'])
                ->orderBy('createdDate', 'ASC')
                ->limit(5)
                ->get()->toArray();

            // $presId = $docId->document($visitInfo['prescriptionId']);
            // foreach ($presId as $key => $value) {
            // array_push($prescriptionDetail, $value->data());
            // }
            if (isset($presId)) {
                foreach ($presId as $key => $value) {
                    array_push($data['pres'], $value);
                }
            } else {
                //$data['pres'] = array();
            }
        }


        if (empty($data['patientData'][0]['gender']) || empty($data['patientData'][0]['district']) || empty($data['patientData'][0]['height']) || empty($data['patientData'][0]['weight']) || empty($data['patientData'][0]['bloodGroup']) || empty($data['patientData'][0]['dateOfBirth'])) {
            return redirect('patient/edit/' . $data['patientData'][0]['uid']);
        } else {
            return view('patient.index')->with($data);
        }
    }

    public function profile()
    {
        $firestore = app('firebase.firestore');
        $database = $firestore->database();

        $data['userProfileData'] = session::get('user');

        $docRef = $database->collection('users');

        if (isset($data['userProfileData']) && $data['userProfileData'] != null) {
            $uid = $data['userProfileData'][0]['uid'];
        }

        //$data['userProfile'] = $docRef->document($uid)->snapshot()->data();
        $data['userProfile'] = User::where('uid', $uid)->get()->toArray();
        //dd($data);

        if (empty($data['userProfileData'][0]['gender']) || empty($data['userProfileData'][0]['district']) || empty($data['userProfileData'][0]['height']) || empty($data['userProfileData'][0]['weight']) || empty($data['userProfileData'][0]['bloodGroup']) || empty($data['userProfileData'][0]['dateOfBirth'])) {
            return redirect('patient/edit/' . $data['userProfileData'][0]['uid']);
        } else {
            return view('patient/profile')->with($data);
        }
    }

    // public function diagnosis($uid)
    // {
    //     $firestore = app('firebase.firestore');
    //     $database = $firestore->database();

    //     $patientData = $database->collection('users');
    //     $diagnosisData = $database->collection('vitals');

    //     $queryPatient = $patientData->where('uid','=',$uid);
    //     $patient = $queryPatient->documents();
    //     $data['patient'] = array();

    //     foreach($patient as $key=>$value){
    //         array_push($data['patient'],$value->data());
    //     }

    //     $query = $diagnosisData->where('pId','=',$uid);
    //     $diagnosis = $query->documents();

    //     $data['diagnosis'] = array();

    //     foreach($diagnosis as $key=>$value){
    //         array_push($data['diagnosis'],$value->data());
    //     }

    //     return view('patient.diagnosis')->with($data);
    // }

    public function ePrescription($uid)
    {
        $data['userProfileData'] = session::get('user');


        $firestore = app('firebase.firestore');
        $database = $firestore->database();

        $patientData = $database->collection('users');
        $doctorData = $database->collection('doctors');

        /*
        $queryPatient = $patientData->where('uid','=',$uid);
        $patient = $queryPatient->documents();
        */

        $patient = User::where('uid', $uid)->get()->toArray();



        $data['patient'] = array();

        foreach ($patient as $key => $value) {
            //array_push($data['patient'],$value->data());
            array_push($data['patient'], $value);
        }

        // new
        /*
        $patientVisit = $database->collection('visits');

        $query = $patientVisit->where('patientUid','=',$uid) ;
        $patient = $query->documents();
        */

        $patient = Visits::where('patientUid', $uid)->get()->toArray();

        /*
        $prescription = $database->collection('prescription')
                ->document($uid);
        */

        $prescription = Prescription::where('patientId', $uid)->get()->toArray();

        $data['visits'] = array();
        foreach ($patient as $value) {
            // array_push($data['visits'],$value->data());
            array_push($data['visits'], $value);
        }

        $presInfo = array();
        $pres = array();
        $data['pres'] = array();
        $data['doc'] = array();

        foreach ($data['visits'] as $visitInfo) {
            /*
            $docId = $prescription->collection($visitInfo['doctorUid']);
            $presId = $docId->documents();
            $queryDoctor = $doctorData->where('uid','=',$visitInfo['doctorUid']);
            $doctor = $queryDoctor->documents();
            */

            $presId = Prescription::where('patientId', $uid)->where('doctorId', $visitInfo['doctorUid'])->get()->toArray();

            $doctor = Doctor::where('uid', '=', $visitInfo['doctorUid'])->get()->toArray();

            if (isset($doctor)) {
                $data['doctor'] = array();
                foreach ($doctor as $key => $value) {
                    array_push($data['doctor'], $value);
                }
            } else {
                //$data['doctor'] = array();
            }

            // $pres = array();

            if (isset($presId)) {
                //new code
                foreach ($presId as $key => $value) {
                    array_push($pres, $value);
                }
                //dd($pres[0]['doctorId']);
                foreach ($pres as $key1 => $value) {
                    array_push($data['pres'], $value);
                    foreach ($data['doctor'] as $key1 => $value1) {
                        array_push($data['doc'], $value1);
                    }
                }
                //end

            } else {
                //$data['pres'] = array();
            }
            // end
        }

        // if(isset($doctor)){
        //     $data['doctor'] = array();
        //     foreach($doctor as $key=>$value){
        //         array_push($data['doctor'],$value->data());
        //     }
        // }else{
        //     $data['doctor'] = array();
        // }

        // $pres = array();

        // if(isset($presId)){
        //     $data['pres'] = array();
        //     $data['doc'] = array();

        //     //new code
        //     foreach ($presId as $key => $value) {
        //         array_push($pres,$value->data());
        //     }
        //     //dd($pres[0]['doctorId']);
        //     foreach ($pres as $key1 => $value) {
        //         array_push($data['pres'],$value);
        //         foreach($data['doctor'] as $key1=>$value1){
        //             array_push($data['doc'],$value1);
        //         } 
        //     }
        //     //end

        // }else{
        //     //$data['pres'] = array();
        // }
        // // end

        //new code
        $data['output'] = array();
        for ($i = 0; $i < count($pres); $i++) {
            $arr = array(
                'pres' => $data['pres'][$i],
                'doc' => $data['doc'][$i]
            );

            array_push($data['output'], $arr);
        }
        //end

        //dd($data['output']);


        if (empty($data['userProfileData'][0]['gender']) || empty($data['userProfileData'][0]['district']) || empty($data['userProfileData'][0]['height']) || empty($data['userProfileData'][0]['weight']) || empty($data['userProfileData'][0]['bloodGroup']) || empty($data['userProfileData'][0]['dateOfBirth'])) {
            return redirect('patient/edit/' . $data['userProfileData'][0]['uid']);
        } else {
            return view('patient.e-prescription_list')->with($data);
        }
    }

    function edit($uid)
    {

        $firestore = app('firebase.firestore');

        $database = $firestore->database();
        $patientData = $database->collection('users');
        $district = $database->collection('districts');
        // $queryPatient = $patientData->where('uid','=',$uid);
        // $patient = $queryPatient->documents();
        $patient = User::where('uid', $uid)->get()->toArray();
        $data['patient'] = array();

        foreach ($patient as $key => $value) {
            array_push($data['patient'], $value);
        }

        // $querydistrict = $district->where('active','=',true);
        // $districtData = $querydistrict->documents();

        $districtData = District::where('active', '1')->get()->toArray();

        $data['district'] = array();

        foreach ($districtData as $key => $value) {
            array_push($data['district'], $value);
        }
        //dd($data);
        return view('patient/edit')->with($data);
    }

    function editAction(Request $request)
    {

        $firestore = app('firebase.firestore');
        $database = $firestore->database();

        $uid =  $request->uid;
        $docRef = $database->collection('users')->document($uid);

        if (isset($request['photoUrl'])) {
            $v = validator::make($request->all(), [
                'photoUrl' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);

            if ($v->fails()) {
                return redirect()->back()->withInput()->withErrors($v->errors());
            }

            $fileName = $request['photoUrl']->getClientOriginalName();

            $fileName = $uid . '' . $fileName;
            $request['photoUrl']->move(public_path('images/profilepic'), $fileName);
            $url = "https://telocuretest.com/api/download/" . $fileName;
        } else {
            $url = $request->old_photoUrl;
        }

        $docRef->update([
            ['path' => 'uid', 'value' => $uid],
            ['path' => 'name', 'value' => $request->name],
            ['path' => 'dateOfBirth', 'value' => $request->dateOfBirth],
            ['path' => 'gender', 'value' => $request->gender],
            ['path' => 'bloodGroup', 'value' => $request->bloodGroup],
            ['path' => 'weight', 'value' => $request->weight],
            ['path' => 'height', 'value' => $request->height],
            ['path' => 'district', 'value' => $request->district],
            ['path' => 'email', 'value' => $request->email],
            ['path' => 'phone', 'value' => $request->phone],
            ['path' => 'photoUrl', 'value' => $url]
        ]);

        $inputs = [
            'uid' => $uid,
            'name' => $request->name,
            'dateOfBirth' => $request->dateOfBirth,
            'gender' => $request->gender,
            'bloodGroup'  => $request->bloodGroup,
            'weight' => $request->weight,
            'height' => $request->height,
            'district' => $request->district,
            'email' => $request->email,
            'phone' => $request->phone,
            'photoUrl' => $url
        ];

        User::where('uid', $uid)->update($inputs);


        session_unset();
        //$dt[0] = $database->collection('users')->document($uid)->snapshot()->data();
        $dt = User::where('uid', $uid)->get()->toArray();
        Session::put('user', $dt);
        $data['patientData'] = array();
        array_push($data['patientData'], Session::get('user'));
        //dd($data['patientData']);
        Session::flash('edit-success', 'Profile updated Successfully.');
        return redirect('patient');
    }

    public function ePrescriptionDetails($uId, $dId, $pId)
    {
        $firestore = app('firebase.firestore');
        $database = $firestore->database();

        $patientData = $database->collection('users');
        $doctorData = $database->collection('doctors');

        /*
        $queryPatient = $patientData->where('uid','=',$uId);
        $patient = $queryPatient->documents();
        */

        $patient = User::where('uid', $uId)->get()->toArray();

        $data['patient'] = array();

        foreach ($patient as $key => $value) {
            array_push($data['patient'], $value);
        }

        // new
        $patientVisit = $database->collection('visits');

        /*$query = $patientVisit->where('patientUid','=',$uId) ;
        $patient = $query->documents();*/

        $patient = Visits::where('patientUid', $uId)->get()->toArray();

        $prescription = $database->collection('prescription')
            ->document($uId);

        $data['visits'] = array();
        foreach ($patient as $value) {
            array_push($data['visits'], $value);
        }

        $presInfo = array();
        foreach ($data['visits'] as $visitInfo) {
            /*$docId = $prescription->collection($dId);
            $presId = $docId->documents();

            $queryDoctor = $doctorData->where('uid','=',$dId);
            $doctor = $queryDoctor->documents();*/

            $presId = Prescription::where('patientId', $uId)->where('doctorId', $visitInfo['doctorUid'])->get()->toArray();

            $doctor = Doctor::where('uid', $visitInfo['doctorUid'])->get()->toArray();
        }

        $data['doctor'] = array();
        foreach ($doctor as $key => $value) {
            array_push($data['doctor'], $value);
        }

        $data['prescriptionData'] = array();
        foreach ($presId as $key => $value) {
            array_push($data['prescriptionData'], $value);
        }
        // end

        // echo '<pre>';
        $data['pres'] = array();
        // dd($data['prescriptionData'][0]['prescriptionId']);
        foreach ($data['prescriptionData'] as $key => $val) {
            if ($data['prescriptionData'][$key]['prescriptionId'] == $pId) {
                array_push($data['pres'], $val);
            }
        }

        //dd($data);
        return view('patient/prescription')->with($data);
    }

    public function diagnosis($uId, $dId, $pId)
    {
        $firestore = app('firebase.firestore');
        $database = $firestore->database();

        $patientData = $database->collection('users');
        $doctorData = $database->collection('doctors');

        $queryPatient = $patientData->where('uid', '=', $uId);
        // $patient = $queryPatient->documents();

        $patient1 = User::where('uid', $uId)->get()->toArray();

        $data['patient'] = array();

        foreach ($patient1 as $key => $value) {
            array_push($data['patient'], $value);
        }

        // new
        $patientVisit = $database->collection('visits');

        $query = $patientVisit->where('patientUid', '=', $uId);
        //$patient = $query->documents();

        $patient = Visits::where('patientUid', $uId)->get()->toArray();

        // $prescription = $database->collection('prescription')
        //         ->document($uId);

        $prescription = Prescription::where('patientId', $uId)->get()->toArray();

        $data['visits'] = array();
        foreach ($patient as $value) {
            array_push($data['visits'], $value);
        }

        $presInfo = array();
        foreach ($data['visits'] as $visitInfo) {
            // $docId = $prescription->collection($dId);
            // $presId = $docId->documents();

            $presId = Prescription::where('patientId', $uId)->where('doctorId', $dId)->get()->toArray();

            // $queryDoctor = $doctorData->where('uid','=',$dId);
            // $doctor = $queryDoctor->documents();

            $doctor = Doctor::where('uid', $dId)->get()->toArray();
        }

        $data['doctor'] = array();
        foreach ($doctor as $key => $value) {
            array_push($data['doctor'], $value);
        }

        $data['prescriptionData'] = array();
        foreach ($presId as $key => $value) {
            array_push($data['prescriptionData'], $value);
        }
        // end

        // echo '<pre>';
        $data['pres'] = array();
        // dd($data['prescriptionData'][0]['prescriptionId']);
        foreach ($data['prescriptionData'] as $key => $val) {
            // dd($val);
            if ($data['prescriptionData'][$key]['prescriptionId'] == $pId) {
                array_push($data['pres'], $val);
            }
        }

        return view('patient/diagnosis')->with($data);
    }

    public function help()
    {
        return view('patient/help');
    }
}