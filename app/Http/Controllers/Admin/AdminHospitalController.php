<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth\MailSendController;
use Illuminate\Support\Facades\Session;

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

        $approve = $hosRefe->where('active','=',true);
        $approvedUser = $approve->documents();
        $totalApproved = 0;
        foreach($approvedUser as $item)
        {
            $totalApproved++;
        }
        array_push($data['approvedHospitalUser'],$totalApproved);

        $reject = $hosRefe->where('approve','=',true);
        $rejectedUser = $reject->documents();
        $totalRejected = 0;
        foreach($rejectedUser as $item)
        {
            $totalRejected++;
        }
        array_push($data['rejectHospitalUser'],$totalRejected);

        $pending = $hosRefe->where('active','=',false);
        $pendingUser = $pending->documents();
        $totalPending = 0;
        foreach($pendingUser as $item)
        {
            $totalPending++;
        }
        array_push($data['pendingHospitalUser'],$totalPending);

        return view('admin/adminHospital')->with($data);

    }

    public function hosStatus($status_name)
    {
      // dd($status_name);
    	//this status_name should be approve or reject or pending
    	$firestore = app('firebase.firestore');
   		$db = $firestore->database();
   		$doctorRef = $db->collection('hospital_users');
   		if ($status_name =='approve'){
   			$query = $doctorRef->where('active','=',true);
   			$approveDOctor = $query->documents();
            $approveHospital = array();
        foreach ($approveDOctor as $doctor) {
            if($doctor->exists()){
                $data = $doctor->data();
                if($data['active']){
                    array_push($approveHospital, $doctor->data());
                }
            }
        }

        $approveHospital['status'] = 'active' ;

   		return view('admin.approveHospital')->with('pending_hospital',$approveHospital);

   		}
    		else if($status_name=='reject'){
   			$query = $doctorRef->where('approve','=',true);
   			$rejectHospital = $query->documents();

            $reject_hospital = array();
            foreach ($rejectHospital as $doctor) {

                  array_push($reject_hospital, $doctor->data());

              }
            $reject_hospital['status'] = 'Rejected' ;
        return view('admin.approveHospital')->with('pending_hospital',$reject_hospital);


   		}
   		else if($status_name == 'pending'){
   			$pending_hospital = array();

            $query = $doctorRef->where('active','=',false);
            $allDoctor = $query->documents();

	   		foreach ($allDoctor as $doctor) {
                array_push($pending_hospital, $doctor->data());
	   		}
            $pending_hospital['status'] = 'pending' ;
	   		return view('admin.approveHospital')->with('pending_hospital',$pending_hospital);
	   		//return pending docotr
   		}

    }

    public function approveHospitalUser($id){
        $firestore = app('firebase.firestore');
        $database = $firestore->database();
        $info = $database->collection('hospital_users');
        $hospital_user = $info->document($id);
        $userinfo = $hospital_user->snapshot();

        $hospital_user->update([
            ['path' => 'active', 'value' => true]
        ]);

        $name = $userinfo['name'];
        $phone = $userinfo['phone'];
        $email = $userinfo['email'];
        $temp_pass = 'telocure'.''.mt_rand(1000000,99999999);

        //password encryption.....
        $method = "AES-128-CBC";
        $key = 'SECRETOFTELOCURE';
        //$iv = openssl_random_pseudo_bytes(16);
        $iv = "1234567812345678" ;
        $password = openssl_encrypt($temp_pass,$method,$key,0,$iv);

        $hospital_user->update([
            ['path' => 'password', 'value' => $password]
        ]);

        $MailSend = new MailSendController();

        $urllink = 'link' ;

        $link = [
            'id' => $id,
            'name' => $name,
            'phone' => $phone,
            'pass' => $temp_pass
        ];

        $val = $MailSend->sendlink($link,$email);

        return redirect()->back();
    }

    //reject a hospital user

    public function planFrom($id){
        $data['uid'] = $id ;
        return view('admin/plan')->with($data);
    }

    public function changePlan(Request $request)
    {
        $id = $request->uid;

        $firestore = app('firebase.firestore');
        $database = $firestore->database();
        $info = $database->collection('hospital_users');
        $hospital_user = $info->document($id);

        // dd($userinfo['phone']);
        $plan = $request->plan ;
        $hospital_user->update([
            ['path' => 'plan', 'value' => $plan]
        ]);

        Session::flash('notifyplan','Plan changed successfully.');
        return redirect('admin/hospital') ;
    }

    

}
