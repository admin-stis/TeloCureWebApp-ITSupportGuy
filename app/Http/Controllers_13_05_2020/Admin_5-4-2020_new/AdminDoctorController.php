<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\sendEmail;
use Mail;

class AdminDoctorController extends Controller
{
    public function index()
    {
      $firestore = app('firebase.firestore');
      $db = $firestore->database();
      $doctorRef = $db->collection('doctors');

      $data['doctors'] = $doctorRef->documents();
      $data['doctorList'] = array();

      $data['totalDoctor'] = 0 ;
      foreach($data['doctors'] as $key=>$doctor){
        array_push($data['doctorList'],$doctor->data());
        $data['totalDoctor']++;
      }

      $data['pendingDoctor'] = array() ;
      foreach($data['doctors'] as $key=>$doctor){
        array_push($data['pendingDoctor'],$doctor->data());
      }

      $data['noOfPendingDoctor'] = 0 ;
      foreach($data['pendingDoctor'] as $key=>$pending){
          if(!isset($pending['approve'])){
            $data['noOfPendingDoctor']++;
          }
      }

      $approvedDoctor = $doctorRef->where('approve','=',true)->documents();
      $data['approvedDoctor'] = 0 ;
      foreach($approvedDoctor as $key=>$doctor){
        $data['approvedDoctor']++;
      }

      $rejectDoctor = $doctorRef->where('approve','=',false)->documents();
      $data['rejectDoctor'] = 0 ;
      foreach($rejectDoctor as $key=>$doctor){
        $data['rejectDoctor']++;
      }

      return view('admin.adminDoctor')->with($data);
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

        // echo '<pre>';
        // print_r($approveDoctor);
        // dd(1);

   			return view('admin.approveDoctor')->with('pending_doctor',$approveDoctor);
   			//return all approve doctor
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

   			// return $rejectDoctors;
   			//return all rejected docotr

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

        // return $pending_doctor;

	   		return view('admin.pendingdoctor')->with('pending_doctor',$pending_doctor);
	   		//return pending docotr
   		}

    }

    public function activeDoctor($id)
    {

    	$firestore = app('firebase.firestore');
   		$db = $firestore->database();
   		$docRef = $db->collection('doctors')->document($id);
        $snapsot = $docRef->snapshot();

   		$docRef->set([
   			'active'=>true
   		],['merge' => true]);

       $data = ['message' => 'This message is from hello doc','flag'=>true];
       $send_to = $snapsot['email'];

       Mail::to($send_to)->send(new sendEmail($data));

       //return "Update successfully";
       return redirect()->back();

    }

    public function deactiveDoctor($id)
    {

    	$firestore = app('firebase.firestore');
   		$db = $firestore->database();
   		$docRef = $db->collection('doctors')->document($id);
        $snapsot = $docRef->snapshot();

   		$docRef->set([
   			'active'=>false
   		],['merge' => true]);

       $data = ['message' => 'This message is from hello doc','flag'=>true];
       $send_to = $snapsot['email'];

       Mail::to($send_to)->send(new sendEmail($data));

       //return "Update successfully";
       return redirect()->back();

    }


    public function approveDoctor($id)
    {

    	$firestore = app('firebase.firestore');
   		$db = $firestore->database();
   		$docRef = $db->collection('doctors')->document($id);
        $snapsot = $docRef->snapshot();

   		$docRef->set([
   			'approve'=>true
   		],['merge' => true]);

       $data = ['message' => 'This message is from hello doc','flag'=>true];
       $send_to = $snapsot['email'];


       Mail::to($send_to)->send(new sendEmail($data));

       //return "Update successfully";
       return redirect()->back();

    }

    public function rejectDoctor($id)
    {
    	$firestore = app('firebase.firestore');
    	$db = $firestore->database();
    	$docRef = $db->collection('doctors')->document($id);
        $snapsot = $docRef->snapshot();
    	$docRef->set([
   			'approve'=>false
   		],['merge' => true]);

      $data = ['message' => 'This message is from hello doc','flag'=>false];
      $send_to = $snapsot['email'];

      Mail::to($send_to)->send(new sendEmail($data));
      //return "update sucessfully";
      return redirect()->back();
    }

    public function doctorProfileById($id)
    {
      $firestore = app('firebase.firestore');
      $db = $firestore->database();
      $docRef = $db->collection('doctors')->document($id);
      //   $snapshot = $docRef->snapshot();
      //   return $snapsot->data();
      $data['doctorProfile'] = $docRef->snapshot()->data();
      return view('admin.doctorProfile')->with($data);
    }

    public function approveDoctorList(Request $request)
    {

      $listofdoctor = $request->input('doctorlist');

      foreach ($listofdoctor as $key => $value) {

        $this->approveDoctor($value->doctorid);

      }

      //return "All doctor update successfully";

      return redirect()->back();
    }


    public function rejectDoctorList(Request $request)
    {
        $listofdoctor = $request->input('doctorlist');

        foreach ($listofdoctor as $key => $value) {

            $this->rejectDoctor($value->doctorid);

        }

        //   return "All doctor update successfully";

        return redirect()->back();

    }

    // 20-04-2020
    public function completeProfileAction(Request $request){
        $firestore = app('firebase.firestore');
        $database = $firestore->database();
        $doctorRef = $database->collection('doctors');

        $uid = $request->uid;

        $degreeCertificate = $request['degreeCertificate']->getClientOriginalName();
        $profileImage = $request['profileImage']->getClientOriginalName();
        $prescriptionForm = $request['prescriptionForm']->getClientOriginalName();

        $request->degreeCertificate->move(public_path('images/profilepic'), $degreeCertificate);
        $request->profileImage->move(public_path('images/profilepic'), $profileImage);
        $request->prescriptionForm->move(public_path('images/profilepic'), $prescriptionForm);

        $degreeCertificateUrl = "http://helodoc.com/api/download/".$degreeCertificate;
        $profileImageUrl = "http://helodoc.com/api/download/".$profileImage;
        $prescriptionFormUrl = "http://helodoc.com/api/download/".$prescriptionForm;

        $data = [
            'nid' => $request->nid,
            'dateOfBirth' => $request->dateOfBirth,
            'gender' => $request->gender,
            'name' => $request->name,
            'lastname' => $request->lastname,
            'regNo' => $request->regNo,
            'email' => $request->email,
            'phone' => $request->phone,
            'presentAddress' => $request->presentAddress,
            'district' => $request->district,
            'postalCode' => $request->postalCode,
            'doctorType' => $request->doctorType,

            // Documents
            'degreeCertificate' => $degreeCertificateUrl,
            'profileImage' => $profileImageUrl,
            'prescriptionForm' => $prescriptionFormUrl,
            //end

            'accountName' => $request->accountName,
            'bankName' => $request->bankName,
            'accountNo' => $request->accountNo,
            'branchName' => $request->branchName,
            'swiftCode' => $request->swiftCode,
        ];

        $email = $request->email ;

        $docRef = $database->collection('doctors')->document($uid);
        // $snapsot = $docRef->snapshot();
    	$docRef->set([
            'uid' => $request->uid,
            'nid' => $request->nid,
            'dateOfBirth' => $request->dateOfBirth,
            'gender' => $request->gender,
            'name' => $request->name,
            'lastname' => $request->lastname,
            'regNo' => $request->regNo,
            'email' => $request->email,
            'phone' => $request->phone,
            'presentAddress' => $request->presentAddress,
            'district' => $request->district,
            'postalCode' => $request->postalCode,
            'doctorType' => $request->doctorType,

            // Documents
            'degreeCertificate' => $degreeCertificateUrl,
            'profileImage' => $profileImageUrl,
            'prescriptionForm' => $prescriptionFormUrl,
            //end

            'accountName' => $request->accountName,
            'bankName' => $request->bankName,
            'accountNo' => $request->accountNo,
            'branchName' => $request->branchName,
            'swiftCode' => $request->swiftCode,

            'online' => ' ',
            'active' => ' ',
            'createdAt' => date('d/m/Y')
   		]);

        // dd($doctorRef->document($email));

        // $doctorRef->document($uid)
        //     ->update($data);



    $query = $doctorRef->where('uid','=',$uid);
        $doctorInfo = $query->documents();
        $doctorArr = array();

        foreach ($doctorInfo as $doctor) {
            if($doctor->exists()){
                array_push($doctorArr, $doctor->data());
            }
        }

    $request->session()->put('doctor', $doctorArr);
    return redirect('/doctor') ;
    }

    //end

    //26-04-2020
    public function doctorTransactionInfo(){
        $firestore = app('firebase.firestore');
        $database = $firestore->database();
        $visits = $database->collection('visits');
        $visitData = $visits->documents();
        $data['visited'] = array();

        foreach($visitData as $key => $value){
            array_push($data['visited'],$value->data());
        }

        // dd($data['visited']);

        return view('admin/doctorTransaction')->with($data);
    }
    //end
}
