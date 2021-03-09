<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\sendEmail;
use Illuminate\Support\Facades\Session;
use Mail;
use App\User;

use Illuminate\Support\Facades\Validator;

class AdminPatientController extends Controller
{
    public function index()
    {
        /*$firestore = app('firebase.firestore');
        $db = $firestore->database();
        $usersRef = $db->collection('users');
        
        $data['users'] = $usersRef->documents();
        */
        $data['users'] = User::get()->toArray();
        $data['usersList'] = array();

        $data['totalUser'] = 0;
        foreach ($data['users'] as $key => $user) {
            array_push($data['usersList'], $user);
            $data['totalUser']++;
        }
        $data['totalUser'] = User::count();

        //dd($data['usersList']);
        /*
        $query = $usersRef->where('active','=',true);
        $active_doctors = $query->documents();
        $number_of_active_doctor = 0;
        foreach ($active_doctors as $key => $value) {
            $number_of_active_doctor++;
        }

        $data['activeUser'] = $number_of_active_doctor;
        */

        $data['activeUser'] = User::where('active', 'true')->count();

        $number_of_deactive_doctor = 0;
        //$query = $usersRef->where('active','=',false)->where('active','=','');
        /*
        $query = $usersRef->where('active','=',false);
        $deactive_doctors = $query->documents();
        foreach ($deactive_doctors as $key => $value) {
            $number_of_deactive_doctor++;
        }

        $data['deactiveUser'] = $number_of_deactive_doctor;
        */
        $data['deactiveUser'] = User::where('active', 'false')->count();

        /*
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
        */

        /*
        $data['noOfPendingUser'] = User::count();

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
        */






        //// for online users count, it is coming from realtime database 17/11/20 
        $database = app('firebase.database');
        $reference = $database->getReference('usersStatus');

        $allValue = array();
        $filteredVal = array();
        $data['online'] = 0;
        //get user id list from realtime db
        if ($reference->getSnapshot()->exists()) {
            $allValue = $reference->getValue();
            foreach ($allValue as $x => $x_value) {
                if (is_array($x_value)) { //dd($x);
                    foreach ($x_value as $y => $y_value) {
                        array_push($filteredVal, $y);
                    }
                }
            }
            $data['online'] = count($filteredVal);
        } else {
        }


        return view('admin.adminPatient')->with($data);
    }

    public function patientStatus($status_name)
    {
        // $firestore = app('firebase.firestore');
        // $db = $firestore->database();
        // $patientRef = $db->collection('users');


        // if ($status_name=='approve'){
        // 	$query = $patientRef->where('approve','=',true);
        // 	$approvePatient = $query->documents();
        // 	// return $approvePatient;
        // 	//return all approve doctor
        // 	return view('admin.pendingPatient')->with('pending_patient',$approvePatient);
        // }
        if ($status_name == 'active') {
            // $query = $patientRef->where('active','=',true);
            //$approvePatient = $query->documents();
            $approvePatient = array();
            $data['approvePatient'] = User::where('active', 1)->get()->toArray();
            foreach ($data['approvePatient'] as $patient) {
                array_push($approvePatient, $patient);
            }
            
            $approvePatient['status'] = 'active';
            // return $approvePatient;
            //return all approve doctor
            return view('admin.pendingPatient')->with('pending_patient', $approvePatient);
        }
        // else if($status_name=='reject'){
        // 	$query = $patientRef->where('approve','=',false);
        // 	$rejectPatient = $query->documents();
        // 	// return $rejectPatient;
        // 	return view('admin.pendingPatient')->with('pending_patient',$rejectPatient);
        // 	//return all rejected docotr

        // }
        else if ($status_name == 'deactive') {
            $pending_patient = array();
            // $query = $patientRef->where('active','=',false);
            // $deactivePatient = $query->documents();
            $deactivePatient =  User::where('active', 0)->get()->toArray();
            foreach ($deactivePatient as $patient) {
                array_push($pending_patient, $patient);
            }
            $pending_patient['status'] = 'deactive';
            return view('admin.pendingPatient')->with('pending_patient', $pending_patient);
        } else if ($status_name == 'online') {
            $pending_patient = array();
            /*    		    // $query = $patientRef->where('active','=',false);
   		    // $deactivePatient = $query->documents();
   		    $deactivePatient =  User::where('active',0)->get()->toArray();
   		    foreach ($deactivePatient as $patient) {
   		        array_push($pending_patient, $patient);
   		    } */

            $firestore = app('firebase.firestore');
            $db = $firestore->database();

            $database = app('firebase.database');
            $reference = $database->getReference('usersStatus');

            $allValue = array();
            $filteredVal = array();
            //get user id list from realtime db
            if ($reference->getSnapshot()->exists()) {
                $allValue = $reference->getValue();
                foreach ($allValue as $x => $x_value) {
                    if (is_array($x_value)) { //dd($x);
                        foreach ($x_value as $y => $y_value) {
                            array_push($filteredVal, $y);
                        }
                    }
                }
            } else {
            }

            //now get all user documents
            $usersRef = $db->collection('users');
            $data['users'] = $usersRef->documents();

            $data['pendingUser'] = array();
            foreach ($data['users'] as $key => $user) {
                array_push($data['pendingUser'], $user->data());
            }

            //now get all profile of users whose id matches with ids got from realtime db
            //$new_array  = array();
            for ($i = 0; $i < count($filteredVal); $i++) {
                $input = $filteredVal[$i];
                foreach ($data['pendingUser'] as $key => $item) {
                    if (isset($item["uid"])) {
                        if ($input == $item["uid"]) {
                            array_push($pending_patient, $item);
                            continue;
                        }
                    } else {
                        continue;
                    }
                }
            }

            $pending_patient['status'] = 'online';
            return view('admin.pendingPatient')->with('pending_patient', $pending_patient);
        }
    }

    public function PatientWallet(Request $request)
    {
        ////data update and display should come from firebase else app will not get updated data 

        try {

            $firestore = app('firebase.firestore');
            $database = $firestore->database();

            $visits = $database->collection('visits');
            $usersRef = $database->collection('users');

            $query = $visits->orderBy('callStartTime', 'DESC');
            $visitData = $query->documents();

            $data['visited'] = array();
            $balances = array();
            $i = 0;

            foreach ($visitData as $key => $value) {
                if (isset($value["transactionHistory"]) && $value["transactionHistory"] != null) {
                    if (isset($value["transactionHistory"]["refundAmount"]) && $value["transactionHistory"]["refundAmount"] != null && $value["transactionHistory"]["refundAmount"] != 0) {
                        array_push($data['visited'], $value->data());

                        if (array_key_exists($value["patientUid"], $balances)) {
                            //no need to do anyting as this patient's balance value already in the balances array 

                        } else { //add this patient's balance value in balances array 

                            //now get advancedpaid cllection balance field value
                            $tempPatId = $value["patientUid"];
                            $patientWallet = $usersRef->document($tempPatId)->collection("advancedPaid")->document($tempPatId)->snapshot()->data();
                            if (isset($patientWallet["balance"])) {
                                $balances[$value["patientUid"]] = $patientWallet["balance"];
                            } else {
                                $balances[$value["patientUid"]] = "Not Set";
                            }
                        }
                    }
                }
            }

            $data['balances'] = $balances;
            //dd($data['balances']);
            return view('admin/patientWallet')->with($data);
        } catch (\Exception $e) {
            dd($e);
        }
    }
    public function patientWalletEdit($id, $name)
    {
        $firestore = app('firebase.firestore');
        $db = $firestore->database();

        /* $doctorRef = $db->collection('doctors');
         $query = $doctorRef->where('uid','=',$id);
         $documents = $query->documents();
         
         $docData = array();
         foreach ($documents as $key => $value) {
         array_push($docData,$value->data());
         }
         
         foreach ($docData as $key => $value) {
         $uid = $value['uid'];
         $hospitalized = $value['hospitalized'];
         } */

        $pid = $id;
        $data['uid'] = $pid;
        $data['name'] = $name;
        $data['patientWallet'] = $db->collection('users')->document($pid)->collection("advancedPaid")->document($pid)->snapshot()->data();
        //$data['doctorProfile'] = $docRef->snapshot()->data();
        //$data['documents'] = $docRef->collection('documents')->document($pid)->snapshot()->data();


        return view('admin.patientWalletEdit')->with($data);
    }

    public function patientWalletEditAction(Request $request)
    {
        //dd($request->uid);
        try {

            $validator = Validator::make($request->all(), [

                'balance' => 'required'

            ]);

            /* When using the regex / not_regex patterns, it may be necessary to specify
         rules in an array instead of using pipe delimiters, especially if the regular
         expression contains a pipe character. */

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            } else {

                $firestore = app('firebase.firestore');
                $db = $firestore->database();

                $uid = $request->uid;
                $name = $request->name;

                $patRef = $db->collection('users')->document($uid);

                $balanceInt = (int)$request->balance;

                $walletInfo = [
                    'balance' => $balanceInt,
                    'updatedTime' => new Timestamp(new DateTime())

                ];
                if (isset($patRef)) {
                    if (count($walletInfo) > 0) {
                        $patRef->collection('advancedPaid')->document($uid)->set($walletInfo, ['merge' => 'true']);
                    }
                }

                //need to update time too as currently datetime now saving in mysql 
                $walletInfo_mysql = [
                    'balance' => $balanceInt,
                    //'updatedTime'=>"". new Timestamp(new DateTime()). ""

                ];
                $bdata = json_encode($walletInfo_mysql);
                User::where('uid', $uid)->update(['advancedPaid' => $bdata]);

                Session::flash('update_msg', 'Patient Balance Updated Successfully.');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            dd($e);
        }
    }
    public function approvePtient($id)
    {
        $firestore = app('firebase.firestore');
        $db = $firestore->database();
        $patientRef = $db->collection('users')->document($id);
        $snapsot = $patientRef->snapshot();

        $patientRef->set([
            'approve' => true
        ], ['merge' => true]);

        User::where('uid', $id)->update(['approve' => 'true']);

        $data = ['message' => 'This message is from hello doc', 'flag' => true];
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
            'approve' => false
        ], ['merge' => true]);

        User::where('uid', $id)->update(['approve' => 0]);

        $data = ['message' => 'This message is from hello doc', 'flag' => false];
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
        // $firestore = app('firebase.firestore');
        // $db = $firestore->database();
        // $userRef = $db->collection('users')->document($id);
        //   $snapshot = $docRef->snapshot();
        //   return $snapsot->data();
        // $data['userProfile'] = $userRef->snapshot()->data();
        //   dd($data['userProfile']);

        $data['userProfile'] =  User::where('uid', $id)->get()->toArray();


        return view('admin.patientProfile')->with($data);
    }


    public function activeUser($id)
    {

        /* $firestore = app('firebase.firestore');
        $db = $firestore->database();
        $docRef = $db->collection('users')->document($id);
        $snapsot = $docRef->snapshot();

        $docRef->set([
            'active' => true
        ], ['merge' => true]); */

        User::where('uid', $id)->update(['active' => 1]);

        //$data = ['message' => 'This message is from TeloCure', 'flag' => true];
        //$send_to = $snapsot['email'];

        //Mail::to($send_to)->send(new sendEmail($data));

        //return "Update successfully";
        return redirect()->back();
    }


    public function deactiveUser($id)
    {

        /* $firestore = app('firebase.firestore');
        $db = $firestore->database();
        $docRef = $db->collection('users')->document($id);
        $snapsot = $docRef->snapshot();

        $docRef->set([
            'active' => false
        ], ['merge' => true]);
 */
        User::where('uid', $id)->update(['active' => 0]);

        //$data = ['message' => 'This message is from hello doc', 'flag' => true];
        //$send_to = $snapsot['email'];

        //Mail::to($send_to)->send(new sendEmail($data));

        //return "Update successfully";
        return redirect()->back();
    }



    public function patientProfileDeleteId($id)
    {
        try {
            $firestore = app('firebase.firestore');
            $db = $firestore->database();

            $uid = $id;

            $patientRef = $db->collection('users')->document($uid);

            //patient profile data
            $patientRef_data = $patientRef->snapshot()->data();





            if (isset($patientRef_data) && $patientRef_data != null) {


                $profile_pic = '';
                if (isset($patientRef_data["photoUrl"])) {
                    $profile_pic = $patientRef_data["photoUrl"];
                }


                // $profile_pic = $patientRef_data["photoUrl"];

                if (($profile_pic != null) || ($profile_pic != "")) {
                    $image_name = "";
                    $file_path = "";
                    //here 14 characters are /api/download/ from the start of this string
                    $image_name = substr($profile_pic, (((int)strpos($profile_pic, "/api/download/")) + 14));
                    $file_path = public_path('images/profilepic/' . $image_name . '');
                    if (\Illuminate\Support\Facades\File::exists($file_path)) {
                        \Illuminate\Support\Facades\File::delete($file_path);
                    }
                }
            }


            $patientRef->delete(); //now delete the main user document in firebase   

            //now delete from mysql 
            $user = User::where('uid', $uid);
            if (!is_null($user)) {
                //execute if exist
                $user->delete();
            }


            Session::flash('update_msg', 'Patient profile deleted successfully.');
            return redirect("admin/patient/deactive");
        } catch (\Exception $e) {
            dd($e);
        }
    }
}