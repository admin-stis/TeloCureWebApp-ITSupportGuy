<?php

namespace App\Http\Controllers\Patient;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

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

        $patientVisit = $database->collection('visits');

        $query = $patientVisit->where('patientUid','=',$data['patientData'][0]['uid']) ;
        $patient = $query->documents();

        $prescription = $database->collection('prescription')
                ->document($data['patientData'][0]['uid']);

        $data['visits'] = array();
        foreach ($patient as $value){
            array_push($data['visits'],$value->data());
        }

        //echo '<pre>';
        // print_r($data['visits']);
        // dd(1);

        $presInfo = array();

        foreach($data['visits'] as $visitInfo){
            //echo $visitInfo['doctorUid'];
            $docId = $prescription->collection($visitInfo['doctorUid'])
            ->orderBy('createdDate', 'DESC')->limit(5);
            $presId = $docId->documents();
            //print_r($presId);

            // $presId = $docId->document($visitInfo['prescriptionId']);
            // foreach ($presId as $key => $value) {
            // array_push($prescriptionDetail, $value->data());
            // }
        }
        //dd(1);
        if(isset($presId)){
            $data['pres'] = array();
            foreach ($presId as $key => $value) {
                array_push($data['pres'],$value->data());
            }
        }else{
            $data['pres'] = array();
        }

        return view('patient.index')->with($data);
    }

    public function profile()
    {
        $firestore = app('firebase.firestore');
        $database = $firestore->database();

        $data['userProfileData'] = session::get('user');

        $docRef = $database->collection('users');

        if(isset($data['userProfileData']) && $data['userProfileData'] != null){
            $uid = $data['userProfileData'][0]['uid'];
        }

        $data['userProfile'] = $docRef->document($uid)->snapshot()->data();

        return view('patient/profile')->with($data);
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
        $firestore = app('firebase.firestore');
        $database = $firestore->database();

        $patientData = $database->collection('users');
        $doctorData = $database->collection('doctors');

        $queryPatient = $patientData->where('uid','=',$uid);
        $patient = $queryPatient->documents();
        $data['patient'] = array();

        foreach($patient as $key=>$value){
            array_push($data['patient'],$value->data());
        }

        // new
        $patientVisit = $database->collection('visits');

        $query = $patientVisit->where('patientUid','=',$uid) ;
        $patient = $query->documents();

        $prescription = $database->collection('prescription')
                ->document($uid);

        $data['visits'] = array();
        foreach ($patient as $value){
            array_push($data['visits'],$value->data());
        }

        $presInfo = array();
        foreach($data['visits'] as $visitInfo){
            $docId = $prescription->collection($visitInfo['doctorUid']);
            $presId = $docId->documents();
            $queryDoctor = $doctorData->where('uid','=',$visitInfo['doctorUid']);
            $doctor = $queryDoctor->documents();
        }

        if(isset($doctor)){
            $data['doctor'] = array();
            foreach($doctor as $key=>$value){
                array_push($data['doctor'],$value->data());
            }
        }else{
            $data['doctor'] = array();
        }

        if(isset($presId)){
            $data['pres'] = array();
            foreach ($presId as $key => $value) {
                array_push($data['pres'],$value->data());
            }
        }else{
            $data['pres'] = array();
        }
        // end

        return view('patient.e-prescription_list')->with($data);
    }

    function edit($uid){
        $firestore = app('firebase.firestore');
        $database = $firestore->database();

        $patientData = $database->collection('users');

        $district = $database->collection('districts');

        $queryPatient = $patientData->where('uid','=',$uid);
        $patient = $queryPatient->documents();
        $data['patient'] = array();

        foreach($patient as $key=>$value){
            array_push($data['patient'],$value->data());
        }

        $querydistrict = $district->where('active','=',true);
        $districtData = $querydistrict->documents();
        $data['district'] = array();

        foreach($districtData as $key=>$value){
            array_push($data['district'],$value->data());
        }
        //dd($data);
        return view('patient/edit')->with($data);
    }

    function editAction(Request $request){

        $firestore = app('firebase.firestore');
        $database = $firestore->database();

        $uid =  $request->uid ;
        $docRef = $database->collection('users')->document($uid);

        if(isset($request['photoUrl'])){
            $fileName = $request['photoUrl']->getClientOriginalName();

            $fileName = $uid.''.$fileName;
            $request['photoUrl']->move(public_path('images/profilepic'), $fileName);
            $url = "http://telocure.com/api/download/".$fileName;
        }else{
            $url = $request->old_photoUrl;
        }

        $docRef->update([
                ['path' => 'uid' , 'value' => $uid],
                ['path' => 'name' , 'value' => $request->name],
                ['path' => 'dateOfBirth' , 'value' => $request->dateOfBirth],
                ['path' => 'gender' , 'value' => $request->gender],
                ['path' => 'bloodGroup' , 'value' => $request->bloodGroup],
                ['path' => 'weight' , 'value' => $request->weight],
                ['path' => 'height' , 'value' => $request->height],
                ['path' => 'district' , 'value' => $request->district],
                ['path' => 'email' , 'value' => $request->email],
                ['path' => 'phone' , 'value' => $request->phone],
                ['path' => 'photoUrl', 'value' => $url]
            ]);
        Session::flash('edit-success','Profile updated Successfully.');
        return redirect('patient');

    }

    public function ePrescriptionDetails($uId,$dId,$pId){
        $firestore = app('firebase.firestore');
        $database = $firestore->database();

        $patientData = $database->collection('users');
        $doctorData = $database->collection('doctors');

        $queryPatient = $patientData->where('uid','=',$uId);
        $patient = $queryPatient->documents();
        $data['patient'] = array();

        foreach($patient as $key=>$value){
            array_push($data['patient'],$value->data());
        }

        // new
        $patientVisit = $database->collection('visits');

        $query = $patientVisit->where('patientUid','=',$uId) ;
        $patient = $query->documents();

        $prescription = $database->collection('prescription')
                ->document($uId);

        $data['visits'] = array();
        foreach ($patient as $value){
            array_push($data['visits'],$value->data());
        }

        $presInfo = array();
        foreach($data['visits'] as $visitInfo){
            $docId = $prescription->collection($dId);
            $presId = $docId->documents();

            $queryDoctor = $doctorData->where('uid','=',$dId);
            $doctor = $queryDoctor->documents();

        }

        $data['doctor'] = array();
        foreach($doctor as $key=>$value){
            array_push($data['doctor'],$value->data());
        }

        $data['prescriptionData'] = array();
        foreach ($presId as $key => $value) {
            array_push($data['prescriptionData'],$value->data());
        }
        // end

        // echo '<pre>';
        $data['pres'] = array();
        // dd($data['prescriptionData'][0]['prescriptionId']);
        foreach($data['prescriptionData'] as $key => $val){
            if($data['prescriptionData'][$key]['prescriptionId'] == $pId){
                array_push($data['pres'],$val);
            }
        }

        return view('patient/prescription')->with($data);
    }

    public function diagnosis($uId,$dId,$pId){
        $firestore = app('firebase.firestore');
        $database = $firestore->database();

        $patientData = $database->collection('users');
        $doctorData = $database->collection('doctors');

        $queryPatient = $patientData->where('uid','=',$uId);
        $patient = $queryPatient->documents();
        $data['patient'] = array();

        foreach($patient as $key=>$value){
            array_push($data['patient'],$value->data());
        }

        // new
        $patientVisit = $database->collection('visits');

        $query = $patientVisit->where('patientUid','=',$uId) ;
        $patient = $query->documents();

        $prescription = $database->collection('prescription')
                ->document($uId);

        $data['visits'] = array();
        foreach ($patient as $value){
            array_push($data['visits'],$value->data());
        }

        $presInfo = array();
        foreach($data['visits'] as $visitInfo){
            $docId = $prescription->collection($dId);
            $presId = $docId->documents();

            $queryDoctor = $doctorData->where('uid','=',$dId);
            $doctor = $queryDoctor->documents();

        }

        $data['doctor'] = array();
        foreach($doctor as $key=>$value){
            array_push($data['doctor'],$value->data());
        }

        $data['prescriptionData'] = array();
        foreach ($presId as $key => $value) {
            array_push($data['prescriptionData'],$value->data());
        }
        // end

        // echo '<pre>';
        $data['pres'] = array();
        // dd($data['prescriptionData'][0]['prescriptionId']);
        foreach($data['prescriptionData'] as $key => $val){
            if($data['prescriptionData'][$key]['prescriptionId'] == $pId){
                array_push($data['pres'],$val);
            }
        }

        return view('patient/diagnosis')->with($data);
    }

    public function help(){
        return view('patient/help');
    }
}
