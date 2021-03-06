<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\sendEmail;
use Mail;

class AdminPatientController extends Controller
{
    public function index()
    {

        $firestore = app('firebase.firestore');
        $db = $firestore->database();
        $usersRef = $db->collection('users');

        $data['users'] = $usersRef->documents();

        $data['usersList'] = array();

        $data['totalUser'] = 0 ;
        foreach($data['users'] as $key=>$user){
            array_push($data['usersList'],$user->data());
            $data['totalUser']++;
        }

        $query = $usersRef->where('active','=',true);
        $active_doctors = $query->documents();
        $number_of_active_doctor = 0;
        foreach ($active_doctors as $key => $value) {
            $number_of_active_doctor++;
        }

        $data['activeUser'] = $number_of_active_doctor;

        $number_of_deactive_doctor = 0 ;
        $query = $usersRef->where('active','=',false)->where('active','=','');
        $deactive_doctors = $query->documents();
        foreach ($active_doctors as $key => $value) {
            $number_of_deactive_doctor++;
        }

        $data['deactiveUser'] = $number_of_deactive_doctor;


        $data['pendingUser'] = array() ;
        foreach($data['users'] as $key=>$user){
            array_push($data['pendingUser'],$user->data());
        }

        $data['noOfPendingUser'] = 0 ;
        foreach($data['pendingUser'] as $key=>$pending){
            if(!isset($pending['approve'])){
                $data['noOfPendingUser']++;
            }
        }

        $approvedUser = $usersRef->where('approve','=',true)->documents();
        $data['approvedUser'] = 0 ;
        foreach($approvedUser as $key=>$user){
            $data['approvedUser']++;
        }

        $rejectUser = $usersRef->where('approve','=',false)->documents();
        $data['rejectUser'] = 0 ;
        foreach($rejectUser as $key=>$user){
            $data['rejectUser']++;
        }

        return view('admin.adminPatient')->with($data);
    }




    public function patientStatus($status_name)
    {
    	$firestore = app('firebase.firestore');
    	$db = $firestore->database();
    	$patientRef = $db->collection('users');


    	// if ($status_name=='approve'){
   		// 	$query = $patientRef->where('approve','=',true);
   		// 	$approvePatient = $query->documents();
   		// 	// return $approvePatient;
   		// 	//return all approve doctor
   		// 	return view('admin.pendingPatient')->with('pending_patient',$approvePatient);
           // }
           if ($status_name=='active'){
            $query = $patientRef->where('active','=',true);
            $approvePatient = $query->documents();
            // return $approvePatient;
            //return all approve doctor
            return view('admin.pendingPatient')->with('pending_patient',$approvePatient);
        }
   		// else if($status_name=='reject'){
   		// 	$query = $patientRef->where('approve','=',false);
   		// 	$rejectPatient = $query->documents();
   		// 	// return $rejectPatient;
   		// 	return view('admin.pendingPatient')->with('pending_patient',$rejectPatient);
   		// 	//return all rejected docotr

   		// }
   		else if($status_name == 'deactive'){
   			$pending_patient = array();
   			$allpatient = $patientRef->documents();
	   		foreach ($allpatient as $patient) {
	   			if($patient->exists()){
	   				$data = $patient->data();
	   				if(!array_key_exists('active',$data)){
	   					array_push($pending_patient, $patient->data());
	   				}
	   			}
	   		}

	   		return view('admin.pendingPatient')->with('pending_patient',$pending_patient);
	   		//return pending docotr
   		}
    }


    public function approvePtient($id)
    {
    	$firestore = app('firebase.firestore');
   		$db = $firestore->database();
   		$patientRef = $db->collection('users')->document($id);
      	$snapsot = $patientRef->snapshot();

   		$patientRef->set([
   			'approve'=>true
   		],['merge' => true]);

       $data = ['message' => 'This message is from hello doc','flag'=>true];
       $send_to = $snapsot['email'];

       Mail::to($send_to)->send(new sendEmail($data));

       //return "Update successfully";

       return redirect()->back();

    }

    public function rejectPatient($id)
    {
    	$firestore = app('firebase.firestore');
    	$db = $firestore->database();
    	$patientRef = $db->collection('users')->document($id);
        $snapsot = $patientRef->snapshot();
    	$patientRef->set([
   			'approve'=>false
   		],['merge' => true]);

      $data = ['message' => 'This message is from hello doc','flag'=>false];
      $send_to = $snapsot['email'];

      Mail::to($send_to)->send(new sendEmail($data));
      //return "update sucessfully";
      return redirect()->back();
    }


    public function approvePatientBylist(Request $request)
    {
    	$listofpatient = $request->input('patientlist');

      foreach ($listofpatient as $key => $value) {

        $this->approveDoctor($value->patientid);

      }

      return "All doctor update successfully";
    }

    public function rejectpatientBylist(Request $request)
    {
    	$listofpatient = $request->input('patientlist');
    	foreach ($listofpatient as $key => $value) {

        $this->rejectPatient($value->patientid);

      }

      return "All doctor update successfully";
    }

    public function patientProfileById($id)
    {
      $firestore = app('firebase.firestore');
      $db = $firestore->database();
      $userRef = $db->collection('users')->document($id);
      //   $snapshot = $docRef->snapshot();
      //   return $snapsot->data();
      $data['userProfile'] = $userRef->snapshot()->data();
    //   dd($data['userProfile']);
      return view('admin.patientProfile')->with($data);
    }

}
