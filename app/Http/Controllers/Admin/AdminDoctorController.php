<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\sendEmail;
use Illuminate\Support\Facades\Session;
use Google\Cloud\Core\Timestamp;
use DateTime;
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
      $pendingDoctor = $doctorRef->where('active','=','')->documents();
      foreach($pendingDoctor as $key=>$doctor){
        array_push($data['pendingDoctor'],$doctor->data());
      }

      $data['noOfPendingDoctor'] = count($data['pendingDoctor']);
      
      //$data['noOfPendingDoctor'] = 0 ;
      foreach($data['pendingDoctor'] as $key=>$pending){
       //   $data['noOfPendingDoctor']++;
      }

      $approvedDoctor = $doctorRef->where('active','=',true)->documents();
      $data['approvedDoctor'] = 0 ;
      foreach($approvedDoctor as $key=>$doctor){
        $data['approvedDoctor']++;
      }

      $rejectDoctor = $doctorRef->where('active','=',false)->documents();
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
   			$query = $doctorRef->where('active','=',true);
   			$approveDOctor = $query->documents();
            $approveDoctor = array();
        foreach ($approveDOctor as $doctor) {
            if($doctor->exists()){
                $data = $doctor->data();
                if($data['active']){
                    array_push($approveDoctor, $doctor->data());
                }
            }
        }

        $approveDoctor['status'] = 'active';

        // echo '<pre>';
        // print_r($approveDoctor);
        // dd(1);

   			return view('admin.approveDoctor')->with('pending_doctor',$approveDoctor);
   			//return all approve doctor
   		}
   		else if($status_name=='reject'){
   			$query = $doctorRef->where('active','=',false);
   			$rejectDoctors = $query->documents();

        $reject_doctor = array();
        foreach ($rejectDoctors as $doctor) {
          if($doctor->exists()){
            $data = $doctor->data();
            if($data['active']==false){
              array_push($reject_doctor, $doctor->data());
            }
          }
        }

        $reject_doctor['status'] = 'false';


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
	   				if(!array_key_exists('active',$data)){
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

       $data = ['message' => 'This message is from TeloCure','flag'=>true];
       $send_to = $snapsot['email'];

       Mail::to($send_to)->send(new sendEmail($data));

       //return "Update successfully";
       return redirect()->back();

    }

    public function activeUser($id)
    {

    	$firestore = app('firebase.firestore');
   		$db = $firestore->database();
   		$docRef = $db->collection('users')->document($id);
        $snapsot = $docRef->snapshot();

   		$docRef->set([
   			'active'=>true
   		],['merge' => true]);

       $data = ['message' => 'This message is from TeloCure','flag'=>true];
       $send_to = $snapsot['email'];

       Mail::to($send_to)->send(new sendEmail($data));

       //return "Update successfully";
       return redirect()->back();

    }

    public function deactiveUser($id)
    {

    	$firestore = app('firebase.firestore');
   		$db = $firestore->database();
   		$docRef = $db->collection('users')->document($id);
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


    public function approveDoctor($id)
    {

    	$firestore = app('firebase.firestore');
   		$db = $firestore->database();

      $doctorRef = $db->collection('doctors');
      $query = $doctorRef->where('uid','=',$id);
      $documents = $query->documents();

      $userId = "" ;

      $docData = array();
      foreach ($documents as $key => $value) {
        array_push($docData,$value->data());
      }

      foreach ($docData as $key => $value) {
        $uid = $value['uid'];
        $hospitalized = $value['hospitalized'];
      }

      if(isset($hospitalized) && $hospitalized == true) $did = substr($uid,2);
      else $did = $uid;

   		$docRef = $db->collection('doctors')->document($did);
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

    public function rejectDoctor($id)
    {
    	$firestore = app('firebase.firestore');
    	$db = $firestore->database();

      $doctorRef = $db->collection('doctors');
      $query = $doctorRef->where('uid','=',$id);
      $documents = $query->documents();

      $userId = "" ;

      $docData = array();
      foreach ($documents as $key => $value) {
        array_push($docData,$value->data());
      }

      foreach ($docData as $key => $value) {
        $uid = $value['uid'];
        $hospitalized = $value['hospitalized'];
      }

      if(isset($hospitalized) && $hospitalized == true) $did = substr($uid,2);
      else $did = $uid;

      $docRef = $db->collection('doctors')->document($did);
      $snapsot = $docRef->snapshot();
    	$docRef->set([
   			'active'=>false
   		],['merge' => true]);

      $data = ['message' => 'This message is from Telocure','flag'=>false];
      $send_to = $snapsot['email'];

      Mail::to($send_to)->send(new sendEmail($data));
      //return "update sucessfully";
      return redirect()->back();
    }

    public function doctorProfileById($id)
    {
      $firestore = app('firebase.firestore');
      $db = $firestore->database();

      $doctorRef = $db->collection('doctors');
      $query = $doctorRef->where('uid','=',$id);
      $documents = $query->documents();

      $userId = "" ;

      $docData = array();
      foreach ($documents as $key => $value) {
        array_push($docData,$value->data());
      }

      foreach ($docData as $key => $value) {
        $uid = $value['uid'];
        $hospitalized = $value['hospitalized'];
      }

      if(isset($hospitalized) && $hospitalized == true) $did = substr($uid,2);
      else $did = $uid;

      $docRef = $db->collection('doctors')->document($did);
      $data['doctorProfile'] = $docRef->snapshot()->data();
      $data['documents'] = $docRef->collection('documents')->document($did)->snapshot()->data();
      $data['bank_info'] = $docRef->collection('bank_info')->document($did)->snapshot()->data();
      $data['others'] = $docRef->collection('others')->document($did)->snapshot()->data();
      //for hospital doctor
      $hospitalBranchId = $data['others']['branchId'];
      $hospital = $db->collection('hospitalBranch');
      if($hospitalBranchId != ""){

        $data['hospitalDetails'] = $hospital->document($hospitalBranchId)->snapshot()->data() ;
        if($data['hospitalDetails'] != null){
          //$hospitalInfo = $hospital->where('hospitalUserId','=',$hospitalBranchId);
          //$hData = $hospitalInfo->documents();
          $data['hinfo'] = $data['hospitalDetails'];
          /*foreach ($data['hosDetails'] as $key => $value) {
              array_push($data['hinfo'], $value->data());
          }*/
        }
        else{
            $hospital = $db->collection('hospital_users');
            $data['hinfo'] = $hospital->document($hospitalBranchId)->snapshot()->data() ;
            //dd($data['hosDetails']);
            //$hospitalInfo = $hospital->where('hospitalUserId','=',$hospitalBranchId);
            //  $hData = $hospitalInfo->documents();
            /*  $data['hinfo'] = array();
              foreach ($data['hosDetails'] as $key => $value) {
                  array_push($data['hinfo'], $value->data());
              }*/
        }
      }
      //end

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
        //dd($request->all());
        $firestore = app('firebase.firestore');
        $database = $firestore->database();
        $doctorRef = $database->collection('doctors');

        $uid = $request->uid;

        $hUid = $request->hospitalUid ;

        if($hUid != false){
            $hospitalUid = substr($uid, 2);
            $docRef = $doctorRef
                ->document($hospitalUid);
        }else{
            $docRef = $doctorRef
                ->document($uid);
        }
        
        $email = $request->email ;

        if(isset($request['photoUrl'])){

            $fileName = $request['photoUrl']->getClientOriginalName();

            $fileName = $uid.''.$fileName;
            $request['photoUrl']->move(public_path('images/profilepic'), $fileName);
            $url = "https://telocure.com/api/download/".$fileName;
        }else{
            $url = '';
        }

        if(isset($request['degreeCertificate'])){

            $fileName = $request['degreeCertificate']->getClientOriginalName();

            $fileName = $uid.''.$fileName;
            $request['degreeCertificate']->move(public_path('images/profilepic'), $fileName);
            $durl = "https://telocure.com/api/download/".$fileName;
        }else{
            $durl = '';
        }

        if(isset($request['prescriptionForm'])){

            $fileName = $request['prescriptionForm']->getClientOriginalName();

            $fileName = $uid.''.$fileName;
            $request['prescriptionForm']->move(public_path('images/profilepic'), $fileName);
            $purl = "https://telocure.com/api/download/".$fileName;
        }else{
            $purl = '';
        }



      $branch = $docRef->collection('others')->document($docRef->id())->snapshot()->data();

      $districtId = intval($request->postalCode);

    	$docRef->set([
            'uid' => $request->uid,
            'dateOfBirth' => $request->dateOfBirth,
            'gender' => $request->gender,
            'name' => $request->name.'  '.$request->lastname,
            'regNo' => $request->regNo,
            'email' => $request->email,
            'phone' => $request->phone,
            //'presentAddress' => $request->presentAddress,
            'district' => $request->district,
            'districtId' => $districtId,
            'doctorType' => $request->doctorType,
            // Documents
            'photoUrl' => $url,
            //end
            'createdAt' => new Timestamp(new DateTime())

   		],['merge' => true]);

      $bank_info = $docRef->collection('bank_info')->document($docRef->id())->snapshot()->data();

      //dd($bank_info);

      // $branch = $docRef->collection('others')->document($docRef->id())->snapshot()->data();

      if(isset($branch['branchId'])) $brId = $branch['branchId'] ;
      else $brId = "" ;

        $docRef->collection('others')->document($docRef->id())->set([
            'nid' => $request->nid,
            'presentAddress' => $request->presentAddress,
            'acadeimcDegree' => $request->acadeimcDegree,
            'otherDegree' => $request->otherDegree,
            'branchId' => $brId // hospital branch
        ]);

        $docRef->collection('balance')->document($docRef->id())->set([
            'balance' => 0,
            'updatedTime' => new Timestamp(new DateTime()),
        ]);

        $docRef->collection('documents')->document($docRef->id())->set([
            //'degreeCertificate' => $durl,
            'academicCertificate' => $durl,
            'prescriptionForm' => $purl,
        ],['merge' => true]);

        $docRef->collection('bank_info')->document($docRef->id())->set([
            'accountName' => $request->accountName,
            'bankName' => $request->bankName,
            'accountNumber' => $request->accountNo,
            //'branchName' => $request->branchName,
            'swiftCode' => $request->swiftCode,
        ],['merge' => true]);

        $query = $doctorRef->where('uid','=',$uid);
            $doctorInfo = $query->documents();
            $doctorArr = array();

            foreach ($doctorInfo as $doctor) {
                if($doctor->exists()){
                    array_push($doctorArr, $doctor->data());
                }
            }

            // $validatedData = $request->validate([
            //     'nid' => 'required',
            //     'dateOfBirth' => 'required',
            //     'gender' => 'required',
            //     'name' => 'required',
            //     'lastname' => 'required',
            //     'regNo' => 'required',
            //     'email' => 'required',
            //     'phone' => 'required',
            //     'presentAddress' => 'required',
            //     'district' => 'required',
            //     'postalCode' => 'required',
            //     'doctorType' => 'required',
            //     'acadeimcDegree' => 'required',


            //     // Documents
            //     'degreeCertificate' => 'required',
            //     'profileImage' => 'required',
            //     'prescriptionForm' => 'required',
            //     //end

            //     'accountName' =>  'required',
            //     'bankName' =>  'required',
            //     'accountNo' => 'required',
            //     'branchName' =>  'required',
            // ]);

        $request->session()->put('doctor', $doctorArr);

        $request->session()->put('user', $doctorArr);

        Session::flash('profile-success','Successfully submitted.');

        //dd($doctorArr);

        return redirect('doctor') ;
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


    //12-05-2020
    public function updateProfileAction(Request $request){
        //dd($request->all());

        $firestore = app('firebase.firestore');
        $database = $firestore->database();

        $doctorRef = $database->collection('doctors');

        $uid = $request->uid;

        $hUid = $request->hospitalUid ;

        if($hUid != ''){
            $hospitalUid = substr($uid, 2);
            $docRef = $doctorRef
                ->document($hospitalUid);
        }else{
            $docRef = $doctorRef
                ->document($uid);
        }
        // $snapsot = $docRef->snapshot();

        //dd($docRef);

        // $degreeCertificate = $request['degreeCertificate']->getClientOriginalName();
        // $profileImage = $request['profileImage']->getClientOriginalName();
        // $prescriptionForm = $request['prescriptionForm']->getClientOriginalName();

        // $request->degreeCertificate->move(public_path('images/profilepic'), $degreeCertificate);
        // $request->profileImage->move(public_path('images/profilepic'), $profileImage);
        // $request->prescriptionForm->move(public_path('images/profilepic'), $prescriptionForm);

        // $degreeCertificateUrl = "http://helodoc.com/api/download/".$degreeCertificate;
        // $profileImageUrl = "http://helodoc.com/api/download/".$profileImage;
        // $prescriptionFormUrl = "http://helodoc.com/api/download/".$prescriptionForm;

        // $email = $request->email ;

        if(isset($request['photoUrl'])){

            $fileName = $request['photoUrl']->getClientOriginalName();

            $request['photoUrl']->move(public_path('images/profilepic'), $fileName);
            $url = "https://telocure.com/api/download/".$fileName;
        }else{
            $url = $request->old_photoUrl;
        }


        $docRef->update([
            ['path' => 'uid', 'value' => $request->uid],
            ['path' =>'nid',  'value' => $request->nid],
            ['path' =>'dateOfBirth', 'value' => $request->dateOfBirth],
            ['path' =>'gender', 'value' => $request->gender],
            ['path' =>'name', 'value' => $request->name],
            ['path' =>'regNo', 'value' => $request->regNo],
            ['path' =>'email', 'value' => $request->email],
            ['path' =>'presentAddress', 'value' => $request->presentAddress],
            ['path' =>'district', 'value' => $request->district],
            // ['path' =>'postalCode' => $request->postalCode,
            ['path' =>'doctorType', 'value' => $request->doctorType],

            // Documents
            //'degreeCertificate' => $degreeCertificateUrl,
            ['path' => 'photoUrl', 'value' => $url]
            //'prescriptionForm' => $prescriptionFormUrl,
            //end

            /*'accountName' => $request->accountName,
            'bankName' => $request->bankName,
            'accountNo' => $request->accountNo,
            'branchName' => $request->branchName,
            'swiftCode' => $request->swiftCode,*/

            // 'online' => ' ',
            // 'active' => ' ',
            //'createdAt' => date('d/m/Y')
           ]);


           $validatedData = $request->validate([
            'nid' => 'required',
            'dateOfBirth' => 'required',
            'gender' => 'required',
            'name' => 'required',
            'regNo' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'presentAddress' => 'required',
            'district' => 'required',
            'doctorType' => 'required',

            // Documents
            // 'degreeCertificate' => 'require',
            'photoUrl' => '',
            // 'prescriptionForm' => 'require',
            //end

            /*
            'accountName' =>  'require',
            'bankName' =>  'require',
            'accountNo' => 'require',
            'branchName' =>  'require',
            'swiftCode' =>  'require',
            */
        ]);

        return redirect()->back();
    }
}
