<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminHospitalController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        $firestore = app('firebase.firestore');
        $database = $firestore->database();
        $hosRefe = $database->collection('hospital_users');

        $data['userList'] = array();
        $data['totalHospitalUser'] = array();
        $data['approvedHospitalUser'] = array();
        $data['pendingHospitalUser'] = array();
        $data['rejectHospitalUser'] = array();

        $totalUser = $hosRefe->documents();

        $total = 0;
        foreach($totalUser as $item)
        {
            $total++;
            array_push($data['userList'],$item->data());
        }
        array_push($data['totalHospitalUser'],$total);

        $approve = $hosRefe->where('approve','=',true);
        $approvedUser = $approve->documents();
        $totalApproved = 0;
        foreach($approvedUser as $item)
        {
            $totalApproved++;
        }
        array_push($data['approvedHospitalUser'],$totalApproved);

        $reject = $hosRefe->where('approve','=',false);
        $rejectedUser = $reject->documents();
        $totalRejected = 0;
        foreach($rejectedUser as $item)
        {
            $totalRejected++;
        }
        array_push($data['rejectHospitalUser'],$totalRejected);

        $pending = $hosRefe->where('approve','=','');
        $pendingUser = $pending->documents();
        $totalPending = 0;
        foreach($pendingUser as $item)
        {
            $totalPending++;
        }
        array_push($data['pendingHospitalUser'],$totalPending);

        return view('admin/adminHospital')->with($data);

    }

    public function docStatus($status_name)
    {
      // dd($status_name);
    	//this status_name should be approve or reject or pending
    	$firestore = app('firebase.firestore');
   		$db = $firestore->database();
   		$doctorRef = $db->collection('doctors');
   		if ($status_name=='approve'){
   			$query = $doctorRef->where('approve','=',true);
   			$approveDOctor = $query->documents();
            $approveDoctor = array();
        foreach ($approveDOctor as $doctor) {
            if($doctor->exists()){
                $data = $doctor->data();
                if($data['approve']){
                    array_push($approveDoctor, $doctor->data());
                }
            }
        }

   		return view('admin.approveDoctor')->with('pending_doctor',$approveDoctor);
   	
   		}
   		else if($status_name=='reject'){
   			$query = $doctorRef->where('approve','=',false);
   			$rejectDoctors = $query->documents();

        $reject_doctor = array();
        foreach ($rejectDoctors as $doctor) {
          if($doctor->exists()){
            $data = $doctor->data();
            if($data['approve']==false){
              array_push($reject_doctor, $doctor->data());
            }
          }
        }
        return view('admin.approveDoctor')->with('pending_doctor',$reject_doctor);
   		}
   		else if($status_name == 'pending'){
   			$pending_doctor = array();
   			$allDoctor = $doctorRef->documents();

	   		foreach ($allDoctor as $doctor) {
	   			if($doctor->exists()){
	   				$data = $doctor->data();
	   				if(!array_key_exists('approve',$data)){
	   					array_push($pending_doctor, $doctor->data());
	   				}
	   			}
	   		}

	   		return view('admin.pendingdoctor')->with('pending_doctor',$pending_doctor);
	   		//return pending docotr
   		}

    }

}
