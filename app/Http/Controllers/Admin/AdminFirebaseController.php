<?php

namespace App\Http\Controllers\Admin;

use Kreait\Firebase\Database;
// use Kreait\Firebase\Firestore;
use Google\Cloud\Firestore\FirestoreClient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth\MailSendController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Google\Cloud\Core\Timestamp;
use DateTime;
use App\Doctor;
use App\Hospital;
use App\User;
use App\District;
use App\Admin;
use App\Settings;
use DB;
use Log;

use Illuminate\Database\QueryException;
// include composer autoload
require 'custom_vendor/autoload.php';
// import the Intervention Image Manager Class
use Intervention\Image\ImageManager;

class AdminFirebaseController extends Controller
{

    public function index()
    {
        $database = app('firebase.database');
        $reference = $database->getReference('COMILLA');
        $value = $reference->getValue();
        dd($value);
    }

    public function index2()
    {
        $firestore = app('firebase.firestore');
        $database = $firestore->database();
        $collectionReference = $database->collection('doctors');
        $documents = $collectionReference->documents();
        // $snapshot = $documentReference->snapshot();
        // $reference = $database->getReference('users');
        // $value = $database->getValue();
        // foreach ($documents as  $document) {
        // 	if ($document->exists()){
        // 		print_r($document->data());
        // 	}
        // 	print_r('----------------------------------------------------------\r\n');
        // }
        dd($documents);
    }

    // Doctor Registration
    /*
    public function setdoctors()
   	{
   		$firestore = app('firebase.firestore');
   		$database = $firestore->database();
   		$doctorRef = $database->collection('doctors');
   		$doctorRef->add([
   			'active'=>false,
   			'dateOfBirth'=>'2/2/2020',
   			'district'=>'dhaka',
   			'districtId'=>1,
   			'doctorType'=>'general',
   			'email'=>'amit@gmail.com',
   			'gender'=>'Male',
   			'name'=>'amit kumar2',
   			'online'=>true,
   			'photoUrl'=>'www.photo.com',
   			'price'=>300,
   			'regNo'=>'00011',
   			'totalCount'=>2,
   			'totalRating'=>8
   		]);
   		dd('Doctor add successfully');


       }
    */

    public function getDoctor()
    {
        $firestore = app('firebase.firestore');
        $database = $firestore->database();
        $doctorsRef = $database->collection('doctors');
        $query = $doctorsRef->where('active', '=', true);
        $snapshot = $query->documents();
        dd($snapshot);
    }

    public function editDoctor()
    {
        $firestore = app('firebase.firestore');
        $database = $firestore->database();
        $doctorRef = $database->collection('doctors')->document('AmitKumar');
        // dd($doctorRef);
        $doctorRef->update([
            ['path' => 'active', 'value' => true],
            ['path' => 'dateOfBirth', 'value' => '20/20/2020']

        ]);
        dd('doctor update sccessfully');
    }

    public function districtDoctor()
    {
        $firestore = app('firebase.firestore');
        $database = $firestore->database();
        print_r("<pre>");
        //district wise total number doctor

        $districtRef = $database->collection('districts');
        $districts = $districtRef->documents();
        $dis_val = array_fill(0, 65, 0);
        foreach ($districts as $district) {
            if ($district->exists()) {
                $temp = array('id' => $district['id'], 'name' => $district['name'], 'bn_name' => $district['bn_name'], 'count' => 0);
                $dis_val[$district['id']] = $temp;
            }
        }
        $doctorRef = $database->collection('doctors');
        $doctors = $doctorRef->documents();
        foreach ($doctors as $doctor) {
            if ($doctor->exists()) {
                $dis_val[$doctor['districtId']]['count']++;
            }
        }

        print_r($dis_val);
        print_r("<pre>");
        return $dis_val;
    }

    public function docoreGender()
    {
        $firestore = app('firebase.firestore');
        $db = $firestore->database();
        $doctorRef = $db->collection('doctors');
        $doctors = $doctorRef->documents();
        $doctor_gender = array('Male' => 0, 'Female' => 0);
        foreach ($doctors as $doctor) {
            if ($doctor->exists()) {
                if ($doctor['gender'] == "Male") {

                    $doctor_gender['Male']++;
                } else {
                    $doctor_gender['Female']++;
                }
            }
        }
        print_r("<pre>");
        print_r($doctor_gender);
        print_r("<pre>");

        return $doctor_gender;
    }

    public function numberOfPatient()
    {
        $firestore = app('firebase.firestore');
        $db = $firestore->database();
        $patientRef = $db->collection('users');
        $patients = $patientRef->documents();

        $total_patient = 0;
        // return count($patients);
        print_r("<pre>");
        foreach ($patients as $patient) {
            // print_r($patient->data());
            $total_patient++;
        }
        print_r("<pre>");

        return $total_patient;
    }
    public function process_intv_images($file_input, $uid, $type)
    {
        $image_size = $file_input->getSize();
        //$fileName = $uid.''.$fileName;

        if ($image_size >= 1024) {
            $image_size_kb = (int)($image_size / 1024);
        } else {
            $image_size_kb = 1;
        }

        if ($image_size_kb > 700) {
            // create an image manager instance with favored driver
            $manager = new ImageManager(array('driver' => 'imagick')); //array('driver' => 'imagick')
            $image_make = $manager->make($file_input, $type);

            $mime = $image_make->mime();
            //some checks more with width and height
            //$width = $image_make->width();
            //$height = $image_make->height();

            // to finally create image instances
            $image = $image_make->resize(900, 900, function ($constraint) {
                $constraint->aspectRatio();
            });

            /************************** without resize method call, if less quality given in save
                 method then it reduces size too like imagejpeg *****************************/
            $img_ext = ".jpg";
            //////////by default image is saved according to ext in path, Alternatively it is possible to define the image format by passing one of the image format extension as a third parameters
            if (($mime == "image/jpeg") || ($mime == "image/jpg")) {
                $img_ext = ".jpg";
            }
            if ($mime == "image/png") {
                $img_ext = ".png";
            }
            if ($mime == "image/bmp") {
                $img_ext = ".bmp";
            }
            if ($mime == "image/gif") {
                $img_ext = ".gif";
            }
            $fileName = $uid . '_' . $type . $img_ext;
            $image->save(public_path('images/profilepic') . '/' . $fileName . '', 100);
            $url = "https://telocuretest.com/api/download/" . $fileName;
        } else { //image size less than we defined so just use laravel move as bef4
            //set file name with extension
            $img_ext = "." . $file_input->getClientOriginalExtension();
            $fileName = $uid . '_' . $type . $img_ext;
            $file_input->move(public_path('images/profilepic'), $fileName);
            $url = "https://telocuretest.com/api/download/" . $fileName;
        }
        return $url;
    }
    public function setdoctors(Request $request)
    {
        //dd(123);

        $firestore = app('firebase.firestore');
        $database = $firestore->database();

        $doctorRef = $database->collection('doctors');
        $docData = $doctorRef->documents();

        $doctor = array();
        foreach ($docData as $item) {
            array_push($doctor, $item->data());
        }

        $flag = false;
        $emailFlag = false;

        foreach ($doctor as $key => $item) {
            if (isset($item['phone']) && $item['phone'] == $request->mobile) {
                Session::flash('phonemsg', 'Contact number already exists.');
                $flag = true;
                break;
            }
        }

        foreach ($doctor as $key => $item) {
            if (isset($item['email']) && $item['email'] == $request->email) {
                Session::flash('emailmsg', 'Email already exists.');
                $emailFlag = true;
                break;
            }
        }

        // new code 26/07/2020

        $userInformation = Doctor::all();

        foreach ($userInformation as $item) {
            if (isset($item['phone']) && $item['phone'] == $request->mobile) {
                Session::flash('phonemsg', 'Contact number already exits.');
                $flag = true;
                break;
            }
        }

        foreach ($userInformation as $item) {
            if (isset($item['email']) && $item['email'] == $request->email) {
                Session::flash('emailmsg', 'Email already exits.');
                $flag = true;
                break;
            }
        }

        // end

        $v = validator::make($request->all(), [
            'name' => 'required|regex:/^[\p{L} ]+$/u|max:20',
            'lastname' => 'required|regex:/^[\p{L} ]+$/u|max:15',
            'email' => 'required',
            'password' => 'required|min:8|regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/|confirmed',
            'mobile' =>  'required|digits:11',
            'district' => 'required',
            'photoUrl' => 'required|image',
            'regNo' => 'required',
            'doctorType' => 'required',
        ]);

        if ($v->fails()) {
            return redirect()->back()->withInput()->withErrors($v->errors());
        }

        if ($flag == true && $emailFlag == true) {
            return redirect()->back()->withInput();
        } elseif ($flag == true && $emailFlag == false) {
            return redirect()->back()->withInput();
        } elseif ($flag == false && $emailFlag == true) {
            return redirect()->back()->withInput();
        }

        $doctorRef = $database->collection('doctors')->newDocument();
        //mridul 25-7-20 
        if (isset($request['photoUrl'])) {
            $url = $this->process_intv_images($request['photoUrl'], $doctorRef->id(), "profile");
        } else {
            //////////////////////// but in edit profile there will be old value not ""
            $url = ""; //for edit profile $request->old_degreeCertificate
        }


        //encrypted password...
        /***********temporary commented***********/
        $pass = $request->password;
        $method = "AES-128-CBC";
        $key = 'SECRETOFTELOCURE';
        $iv = "1234567812345678";
        $password = openssl_encrypt($pass, $method, $key, 0, $iv);
        /*****************end**********************/


        //testing
        //$password = encrypt($request->password);

        //mridul 25-7-20 photoUrl, district, districtId added
        $dis_temp = explode('_', $request->district, 2);
        if (count($dis_temp) > 0) {
            $district = trim($dis_temp[1]);
            $districtId = (int)trim($dis_temp[0]);
        } else {
            $district = "";
            $districtId = 0;
        }

        $doctorRef->set([
            'uid' => $doctorRef->id(),
            'active' => false,
            'email' => $request->email,
            'name' => $request->name . ' ' . $request->lastname,
            'phone' => $request->mobile,

            'photoUrl' => $url,
            'registrationStat' => 1,
            'district' => $district,
            'districtId' => $districtId,
            'regNo' => $request->regNo,
            'doctorType' => $request->doctorType,

            'password' => $password,
            "totalRating" => 0,
            "price" => 0,
            "totalCount" => 0,
            "hospitalUid" => null,
            "hospitalized" => false,
            "online" => false,
            "rejected" => false,
            "createdAt" => new Timestamp(new DateTime()),
            "hospitalName" => ""
        ]);

        // new code 26/07/2020
        $data = [
            'uid' => $doctorRef->id(),
            'active' => false,
            'email' => $request->email,
            'name' => $request->name . ' ' . $request->lastname,
            'phone' => $request->mobile,

            //mridul added 13-8-20 //new fields on doctor registration 
            'photoUrl' => $url,
            'registrationStat' => 1,
            'district' => $district,
            'districtId' => $districtId,
            'regNo' => $request->regNo,
            'doctorType' => $request->doctorType,

            'password' => $password,
            "totalRating" => 0,
            "price" => 0,
            "totalCount" => 0,
            "hospitalUid" => null,
            "hospitalized" => false,
            "online" => false,
            "rejected" => false,
            "createdAt" => new Timestamp(new DateTime()),
            "hospitalName" => ""
        ];

        Doctor::create($data);
        //end

        //return redirect('login/doctor');
        //mridul 25-7-20
        Session::flash('update_msg', 'Your Registration completed successfully!, Please complete your profile through the App or Website.');
        return redirect()->back();
    }

    //29-04-2020
    public function setpatients(Request $request)
    {
        // dd(session_cache_expire());
        // dd(1);
        $firestore = app('firebase.firestore');
        $database = $firestore->database();

        $patientColl = $database->collection('users');
        $patientDoc = $patientColl->documents();

        $flag = false;
        $emailFlag = false;
        $patient = array();

        foreach ($patientDoc as $item) {
            array_push($patient, $item->data());
        }

        foreach ($patient as $key => $item) {
            if (isset($item['phone']) && $item['phone'] == $request->mobile) {
                Session::flash('phonemsg', 'Contact number already exists.');
                $flag = true;
                break;
            }
        }

        foreach ($patient as $key => $item) {
            if (isset($item['email']) && $item['email'] == $request->email) {
                Session::flash('emailmsg', 'Email already exists.');
                $emailFlag = true;
                break;
            }
        }

        // new added 26/07/2020
        $userInformation = User::all();

        foreach ($userInformation as $item) {
            if (isset($item['phone']) && $item['phone'] == $request->mobile) {
                Session::flash('phonemsg', 'Contact number already exits.');
                $flag = true;
                break;
            }
        }

        foreach ($userInformation as $item) {
            if (isset($item['email']) && $item['email'] == $request->email) {
                Session::flash('emailmsg', 'Email already exits.');
                $flag = true;
                break;
            }
        }
        // end

        $v = validator::make($request->all(), [
            'name' => 'required|regex:/^[\p{L} ]+$/u|max:20',
            'lastname' => 'required|regex:/^[\p{L} ]+$/u|max:15',
            'email' => 'required',
            'password' => 'required|min:8|regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/|confirmed',
            'mobile' =>  'required|digits:11',
            'photoUrl' => 'required|image',
            'district' => 'required',
        ]);

        // if($v->fails()){
        //     return redirect()->back()->withErrors($v->errors());
        // }

        if ($v->fails()) {
            return redirect()->back()->withInput()->withErrors($v->errors());
        }

        if ($flag == true && $emailFlag == true) {
            return redirect()->back()->withInput();
        } elseif ($flag == true && $emailFlag == false) {
            return redirect()->back()->withInput();
        } elseif ($flag == false && $emailFlag == true) {
            return redirect()->back()->withInput();
        }

        $pass = $request->password;
        $method = "AES-128-CBC";
        $key = 'SECRETOFTELOCURE';
        $iv = "1234567812345678";
        $password = openssl_encrypt($pass, $method, $key, 0, $iv);

        //end
        $patientRef = $database->collection('users')->newDocument();

        if (isset($request['photoUrl'])) {
            $url = $this->process_intv_images($request['photoUrl'], $patientRef->id(), "patient_profile");
        } else {
            //////////////////////// but in edit profile there will be old value not ""
            $url = "";
        }

        //mridul 31-7-20 photoUrl, district, districtId added
        $dis_temp = explode('_', $request->district, 2);
        if (count($dis_temp) > 0) {
            $district = trim($dis_temp[1]);
            $districtId = (int)trim($dis_temp[0]);
        } else {
            $district = "";
            $districtId = 0;
        }

        // new code 26/07/2020
        //first save to mysql because mysql errors are happening quite now
        $data = [
            'uid' => $patientRef->id(), //mridul fix from id to uid 5-11-20
            //'approve' => '',
            'online' => false,
            'active' => true,
            'email' => $request->email,
            'name' => $request->name . ' ' . $request->lastname,
            //'lastname' => $request->lastname,
            'phone' => $request->mobile,
            'password' => $password,
            'gender' => '',
            'weight' => '',
            'height' => '',
            'bloodGroup' => '',
            'totalCount' => 0,
            'totalRating' => 0,
            'price' => 0,
            'regNo' => null,
            'medication' => '',
            'smoke' => '',

            'photoUrl' => $url,
            'district' => $district,
            'districtId' => $districtId,

            'hospitalUid' => null,
            'hospitalized' => false,
            'doctorType' => null,
            'createdAt' => new Timestamp(new DateTime()),
        ];

        try {  //mridul added 13-8-20

            User::create($data);
        } catch (QueryException $e) {
            //var_dump($e->errorInfo);

            dd($e->errorInfo);
        }

        $patientRef->set([
            'uid' => $patientRef->id(),
            //'approve' => '',
            'online' => false,
            'active' => true,
            'email' => $request->email,
            'name' => $request->name . ' ' . $request->lastname,
            //'lastname' => $request->lastname,
            'phone' => $request->mobile,

            'photoUrl' => $url,
            'district' => $district,
            'districtId' => $districtId,

            'password' => $password,
            'gender' => '',
            'weight' => '',
            'height' => '',
            'bloodGroup' => '',
            'totalCount' => 0,
            'totalRating' => 0,
            'price' => 0,
            'regNo' => null,
            'medication' => '',
            'smoke' => '',
            'hospitalUid' => null,
            'hospitalized' => false,
            'doctorType' => null,
            'createdAt' => new Timestamp(new DateTime()),
            'dateOfBirth' => ''
        ]);

        // end

        return redirect('login/patient');
    }

    // sms system

    /**
     * @param $msisdn
     * @param $messageBody
     * @param $csmsId (Unique)
     */
    public function singleSms($msisdn, $messageBody, $csmsId)
    {
        $api_token = "smartecch-23572135-15fc-459c-a718-4417c3537662"; //put ssl provided api_token here
        $sid = "SMARTTECHNON"; // put ssl provided sid here
        //const DOMAIN = "<API_DOMAIN>"; //api domain // example http://smsplus.sslwireless.com
        $params = [
            "api_token" => $api_token,
            "sid" => $sid,
            "msisdn" => $msisdn,
            "sms" => $messageBody,
            "csms_id" => $csmsId
        ];
        $url = "https://smsplus.sslwireless.com/api/v3/send-sms";
        $params = json_encode($params);

        echo $this->callApi($url, $params);
    }


    public function callApi($url, $params)
    {
        $ch = curl_init(); // Initialize cURL
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($params),
            'accept:application/json'
        ));

        $response = curl_exec($ch);

        curl_close($ch);

        return $response;
    }


    public function loggedIn(Request $request)
    {

        try {

            $firestore = app('firebase.firestore');
            $database = $firestore->database();

            $pass = $request->password;

            //password encryption.....
            /************temporary***********/
            $method = "AES-128-CBC";
            $key = 'SECRETOFTELOCURE';
            $iv = "1234567812345678";
            $password = openssl_encrypt($pass, $method, $key, 0, $iv);

            //dd($password);

            if ($request->title == 'doctor') {
                $v = validator::make($request->all(), [
                    'password' => 'required|min:8|regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/',
                    'common' =>  'required|max:14',
                ]);

                if ($v->fails()) {
                    return redirect()->back()->withInput()->withErrors($v->errors());
                }
                $userRef = $database->collection('doctors');
            } else if ($request->title == 'patient') {
                $v = validator::make($request->all(), [
                    'password' => 'required|min:8|regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/',
                    'common' =>  'required|max:14',
                ]);
                if ($v->fails()) {
                    return redirect()->back()->withInput()->withErrors($v->errors());
                }
                $userRef = $database->collection('users');
            } else if ($request->title == 'hospital') {

                $userRef = $database->collection('hospital_users');

                $v = validator::make($request->all(), [
                    'password' => 'required|min:8|regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/',
                    'common' =>  'required',
                ]);

                $email = $request->common;
                //$query = $userRef->where('email','=',$email)->where('password','=',$password);

                if ($v->fails()) {
                    return redirect()->back()
                        ->withInput()
                        ->withErrors($v->errors());
                }

                //$userInfo = $query->documents();

                $userInfo = Hospital::where('email', $email)->where('password', $password)->get()->toArray();

                $userArr = array();

                // foreach ($userInfo as $user) {
                //     if($user->exists()){
                //         array_push($userArr, $user->data());
                //     }
                // }

                foreach ($userInfo as $user) {
                    array_push($userArr, $user);
                }

                if (!empty($userArr)) {
                    $request->session()->put('user', $userArr);
                    //Edit from mafiz vai
                    $MailSend = new MailSendController();
                    $otp = mt_rand(10000, 99999);
                    $val = $MailSend->sendOtp($otp, $email);
                    $helodoc2fa = array(
                        'title' => $request->title,
                        'opt' => $otp,
                        'status' => false
                    );
                    $request->session()->put('helodoc2fa', $helodoc2fa);
                    if ($val) {
                        return redirect('/2fa')->with($helodoc2fa);
                    }
                }
            } else if ($request->title == 'admin') {

                $userRef = $database->collection('admin');
                /*new code */
                //dd($userRef->documents());
                $password = $request->password;

                $v = validator::make($request->all(), [
                    'password' => 'required|min:8|regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/',
                    'common' =>  'required',
                ]);

                $email = $request->common;
                $query = $userRef->where('email', '=', $email)->where('password', '=', $password);

                if ($v->fails()) {
                    return redirect()->back()->withInput()->withErrors($v->errors());
                }

                /*
            $userInfo = $query->documents();

            $userArr = array();

            foreach ($userInfo as $user) {
                if($user->exists()){
                    array_push($userArr, $user->data());
                }
            }
            */

                //new to make custom admin login for me and shefat 12/12/20 
                $userArr = array();
                ////my dev test code login
                /*             if (($email == "shama7ahmed@gmail.com") && ($password == "telocure12345")) {
                $tempoArrData = array("email" => $email);
                array_push($userArr, $tempoArrData);
            } else { */
                try {
                    $userInfo = Admin::where('email', $email)->where('password', $password)->get()->toArray();
                } catch (QueryException $e) {
                    //var_dump($e->errorInfo);
                    dd($e->errorInfo);
                }

                foreach ($userInfo as $user) {
                    array_push($userArr, $user);
                }

                //}

                if (!empty($userArr)) {

                    $user_permissions = DB::table('admins')
                        ->join('custom_user_role', 'admins.id', '=', 'custom_user_role.user_id')
                        ->join('custom_role_permission', 'custom_user_role.role_id', '=', 'custom_role_permission.role_id')
                        ->select('admins.id', 'admins.user_name', 'admins.email', 'custom_user_role.role_name', 'custom_role_permission.permission_name')
                        //->where('admins.id', '=', 2)
                        ->where('admins.email', '=', $email)
                        ->where('admins.password', '=', $password)
                        //->groupBy('custom_role_permission.permission_name')
                        ->get()->toArray();

                    //dd($user_permissions);

                    $roles = array();
                    $perms = array();
                    foreach ($user_permissions as $key => $item) {
                        array_push($roles, $item->role_name);
                        array_push($perms, $item->permission_name);
                    }

                    if (count($roles) > 0) {
                        $roles = array_unique($roles);
                    }
                    if (count($perms) > 0) {
                        $perms = array_unique($perms);
                    }

                    $roles2 = array();
                    $perms2 = array();
                    foreach ($roles as $key => $item) {
                        array_push($roles2, $item);
                    }
                    foreach ($perms as $key => $item) {
                        array_push($perms2, $item);
                    }

                    //create a new associative array and push roles and permissions array to it first
                    $roles_permissions = array();
                    $roles_permissions["roles"] = $roles2;
                    $roles_permissions["perms"] = $perms2;
                    $request->session()->put('user_roles', $roles_permissions);


                    $request->session()->put('user', $userArr);

                    //Edit from mafiz vai
                    $MailSend = new MailSendController();
                    $otp = mt_rand(10000, 99999);
                    //Log::info("for shefat otp - ".$otp);
                    $val = $MailSend->sendOtp($otp, $email);

                    $helodoc2fa = array(
                        'title'    => $request->title,
                        'opt'    => $otp,
                        'status' => false
                    );

                    $request->session()->put('helodoc2fa', $helodoc2fa);
                    if ($val) {
                        return redirect('/2fa')->with($helodoc2fa);
                    }
                }
                /* end */
            }
            /*$v = validator::make($request->all(),[
            'password' => 'required|min:8|alpha_num',
            'common' =>  'required|max:14',
        ]);

        if($v->fails()){
            return redirect()->back()->withErrors($v->errors());
        }*/

            /*
        if(filter_var($request->common, FILTER_VALIDATE_EMAIL)){
            $email = $request->common ;
            $query = $userRef->where('email','=',$email)->where('password','=',$request->password);
        }else{
        */
            $phone = $request->common;

            // $query = $userRef->where('phone','=',$phone)
            //    ->where('password','=',$password);

            // }

            //$userInfo = $query->documents();

            if ($request->title == 'doctor')
                $userInfo = Doctor::where('phone', $phone)
                    ->where('password', $password)->get()->toArray();

            if ($request->title == 'patient')
                $userInfo = User::where('phone', $phone)
                    ->where('password', $password)->get()->toArray();

            $userArr = array();
            // foreach ($userInfo as $user) {
            //     if($user->exists()){
            //         array_push($userArr, $user->data());
            //     }
            // }

            foreach ($userInfo as $user) {
                array_push($userArr, $user);
            }

            if (!empty($userArr)) {
                //mridul addition 21-7-20
                //dd($userArr[0]);
                if (empty($userArr[0]['registrationStat'])) {
                } else { //registrationstat field not there yet in the doc profile so need to add it

                    $regStatTemp = 0;
                    $duid = $userArr[0]['uid'];

                    if (isset($userArr[0]['photoUrl']) && $userArr[0]['photoUrl'] != "") {
                        $regStatTemp = 1; //photo set so value 1
                    }

                    $data['documentstemp'] = $database->collection('doctors')->document($duid)->collection('documents')->document($duid)->snapshot()->data();
                    if (isset($data['documentstemp']) && $data['documentstemp'] != null) { //documents exists
                        if (isset($data['documentstemp']['academicCertificate']) && $data['documentstemp']['academicCertificate'] != "") {
                            $regStatTemp = 2; //if degree set
                        }
                        if (isset($data['documentstemp']['nidFront']) && $data['documentstemp']['nidFront'] != "") {
                            $regStatTemp = 3; //of nid set
                        }
                        if (isset($data['documentstemp']['nidBack']) && $data['documentstemp']['nidBack'] != "") {
                            $regStatTemp = 3;
                        }
                        //$data['others']['branchId']
                    }

                    //now set the reg stat value
                    $regStatNew = [
                        'registrationStat' => $regStatTemp
                    ];
                    $database->collection('doctors')->document($userArr[0]['uid'])->set($regStatNew, ['merge' => 'true']);
                    $userArr[0]['registrationStat'] = $regStatTemp; // add reg stat field in doc user variable which will be used next pages
                }



                if (isset($userArr[0]['email'])) $email = $userArr[0]['email'];
                /*$districtRef = $database->collection('districts');

            $data['district'] = $districtRef->documents();

            $data['districtList'] = array();

            foreach($data['district'] as $key=>$item){
                array_push($data['districtList'],$item->data());
            }*/

                $districtRef = $database->collection('districts');

                $data['district'] = $districtRef->where('active', '=', true)->documents();
                $districtList = array();

                foreach ($data['district'] as $key => $item) {
                    array_push($districtList, $item->data());
                }

                $request->session()->put('user', $userArr);
                $request->session()->put('district', $districtList);

                //Edit from mafiz vai
                $MailSend = new MailSendController();
                $otp = mt_rand(10000, 99999);

                $val = $MailSend->sendOtp($otp, $email);

                /*
            send through mobile
            --------------------------------
            */
                $msisdn = $phone;
                $messageBody = "Your otp : " . $otp;
                $csmsId = uniqid(); // csms id must be unique

                /********temporary commented will comment out for client****************/
                echo $this->singleSms($msisdn, $messageBody, $csmsId);
                /********end*********/

                $helodoc2fa = array(
                    'title'    => $request->title,
                    'opt'    => $otp,
                    'status' => false
                );

                $request->session()->put('helodoc2fa', $helodoc2fa);

                if ($request->title == 'hospital') {
                    if ($userArr[0]['login_attempt'] == false) {
                        $hospital_user = $userRef->document($userArr[0]['hospitalUid']);
                        $hospital_user->update([
                            ['path' => 'login_attempt', 'value' => true]
                        ]);
                        $data['hospitalUser'] = $userArr[0]['hospitalUid'];
                        return view('frontend/new_pass')->with($data);
                    } else {
                        if ($val) {
                            return redirect('/2fa')->with($helodoc2fa);
                        }
                    }
                } elseif ($val) {
                    return redirect('/2fa')->with($helodoc2fa);
                }
            } else {
                return redirect()->back()->withInput()->withErrors($v->errors())->with('msg', 'Invalid email/mobile or password.');
            }
        } catch (\Exception $e) {
            //var_dump($e->errorInfo);
            dd($e);
        }
    }
    //End

    // 05-05-2020
    /*public function sethospitalusers(Request $request)
    {
        $firestore = app('firebase.firestore');
        $database = $firestore->database();
        $hosRef = $database->collection('hospital_users')->newDocument();
        $hosRef->set([
            'uid' => $hosRef->id(),
            'approve' => '',
            'online' => '',
            'active'=> '',
            'email'=> $request->email,
            'name'=> $request->name,
            'lastname' => $request->lastname,
            'phone' => $request->phone,
            'password' => $request->password,
            'plan' => ''
        ]);

        return redirect('login/hospital');
    }*/
    // End

    public function sethospitalusers(Request $request)
    {
        $firestore = app('firebase.firestore');
        $database = $firestore->database();


        /*  Validator::extend('valid_username', function ($attr, $value) {  //new used

            return preg_match('/^\S*$/u', $value);
        }); */
        // regex for alpha_spaces : /^[\pL\s]+$/u
        $v = validator::make(
            $request->all(),
            [
                'name'  => 'required|regex:/^[\p{L} ]+$/u',
                // 'hospitalName' => 'required|max:25|regex:/^[a-zA-Z0-9\s]+$/',
                'hospitalName' => 'bail|required|unique:hospitals|max:255',
                'hospitalAddress' => 'required|max:100',
                'phone' =>  'required|regex:/(01)[0-9]{9}/|numeric|min:11',
                'plan' => 'required',
                'email' => 'required|email',
                'comment' => 'required'
            ]

            // ['valid_username' => 'Your hospital Name already Exist.']       //new added 
        );

        //dd($request->all());

        /*

        $v = validator::make($request->all(),[
            'name' => 'required|alpha|max:15',
            'hospitalName' => 'required|regex:/^[\pL\s]+$/u|max:15',
            'hospitalAddress' => 'required|max:100',
            'email' => 'required',
            'plan' => 'required',
            'bankInfoUpdateRequest' => false,
            'phone' =>  'required|digits:11',
        ]);

        */

        $hosRef = $database->collection('hospital_users');
        $hosData = $hosRef->documents();

        $hospital = array();
        foreach ($hosData as $item) {
            array_push($hospital, $item->data());
        }

        //test
        $flag = false;
        $emailFlag = false;

        foreach ($hospital as $key => $item) {
            if (isset($item['phone']) && $item['phone'] == $request->phone) {
                Session::flash('phonemsg', 'Contact number already exits.');
                $flag = true;
                break;
            }
        }

        foreach ($hospital as $key => $item) {
            if (isset($item['email']) && $item['email'] == $request->email) {
                Session::flash('emailmsg', 'Email already exits.');
                $emailFlag = true;
                break;
            }
        }

        foreach ($hospital as $key => $item) {
            if (isset($item['hospitalName']) && $item['hospitalName'] == $request->hospitalName) {
                Session::flash('hospitalmsg', 'Hospital Name already exits.');
                $emailFlag = true;
                break;
            }
        }

        // new added 26/07/2020

        $userInformation = Hospital::all();

        //dd($userInformation);

        foreach ($userInformation as $item) {
            if (isset($item['phone']) && $item['phone'] == $request->phone) {
                Session::flash('phonemsg', 'Contact number already exits.');
                $flag = true;
                break;
            }
        }

        foreach ($userInformation as $item) {
            if (isset($item['email']) && $item['email'] == $request->email) {
                Session::flash('emailmsg', 'Email already exits.');
                $flag = true;
                break;
            }
        }

        foreach ($userInformation as $key => $item) {
            if (isset($item['hospitalName']) && $item['hospitalName'] == $request->hospitalName) {
                Session::flash('hospitalmsg', 'Hospital Name already exits.');
                $emailFlag = true;
                break;
            }
        }

        // end


        /*
        if($v->fails()){
            if($flag == true){
                Session::put('msg','Contact number already exist.');
                return redirect()->back()->withInput()->withErrors($v->errors())->with('msg','Contact number already exist.');
            }
            return redirect()->back()->withInput()->withErrors($v->errors());
        }
        */

        if ($v->fails()) {
            return redirect()->back()->withInput()->withErrors($v->errors());
        }


        if ($flag == true && $emailFlag == true) {
            return redirect()->back()->withInput();
        } elseif ($flag == true && $emailFlag == false) {
            return redirect()->back()->withInput();
        } elseif ($flag == false && $emailFlag == true) {
            return redirect()->back()->withInput();
        }

        $insertData = $hosRef->newDocument();

        $insertData->set([
            'hospitalUid' => $insertData->id(),
            'online' => '',
            'active' => false,
            'approve' => false,
            'email' => $request->email,
            'name' => $request->name,
            'phone' => $request->phone,
            'password' => '',
            'plan' => $request->plan,
            'hospitalName' => $request->hospitalName,
            'hospitalAddress' => $request->hospitalAddress,
            'comment' => $request->comment,
            'login_attempt' => false,
            'bankInfoUpdateRequest' => false
        ]);

        $balance = $hosRef->document($insertData->id())->collection('balance')
            ->document($insertData->id())->set([
                'balance' => 0,
                'updatedTime' => new Timestamp(new DateTime()),
            ]);


        // new code 26/07/2020

        $bal = [
            'balance' => 0,
            'updatedTime' => new Timestamp(new DateTime()),
        ];

        try { //mridul added 11-8-20

            $data = [
                //'id' => $insertData->id(),
                'hospitalUid' => $insertData->id(),
                'online' => '',
                'active' => 'false',
                'approve' => 'false',
                'email' => $request->email,
                'name' => $request->name,
                'phone' => $request->phone,
                'password' => '',
                'plan' => $request->plan,
                'hospitalName' => $request->hospitalName,
                'hospitalAddress' => $request->hospitalAddress,
                'comment' => $request->comment,
                'login_attempt' => 0,
                'bankInfoUpdateRequest' => 'false',
                'balance' => json_encode($bal)
            ];

            Hospital::create($data);
        } catch (QueryException $e) {
            //var_dump($e->errorInfo);
            dd($e);
        }

        // end 

        Session::flash('notification', 'Please wait. After admin approve you, a email will sent to your mail.');
        //return redirect('login/hospital')->with('notification','A email will be sent to your email.');
        return redirect()->back();
    }
    public function manageDistrictDiscount(Request $r)
    {

        try {

            $firestore = app('firebase.firestore');
            $database = $firestore->database();
            $disRef = $database->collection('districts');

            //$districtRef = District::get();

            if (isset($r->submit) && $r->submit == 'submit') {

                //check if current user has Edit permission to update things. This checking applies for this "any" http method route

                $has_permission = false; //SET false at first                
                $current_user = $r->session()->get('user_roles'); //get user roles and perm array from sesion
                //now get current user permissions in array
                if (isset($current_user)) {
                    $cur_user_perms = $current_user["perms"];
                }
                //check if current user has the permission same as which set in route
                if (isset($cur_user_perms)) {
                    if (in_array("Edit", $cur_user_perms)) {
                        $has_permission = true;
                    }
                }
                //now finally check if this user has that permission for this route else redirect to error page
                if ($has_permission == false) {
                    //Log::info("permission true - ".$has_permission);
                    return redirect("perm_error");
                }
                //roles check ends 

                $districtId = $r->disId;
                //no district selected 
                if ($districtId == "default") {
                    Session::flash('msg', 'Select a district first');
                    return redirect('/admin/districtDiscount');
                }
                if ($districtId == "") {
                    Session::flash('msg', 'District id is empty!');
                    return redirect('/admin/districtDiscount');
                }

                $disDoc = $disRef->document($districtId);

                //dd($districtId." break ". $disDiscount);
                //check if service form or dicount updating form submitted 
                if (isset($r->service_update) && $r->service_update == 'service') {  //for service charge update 

                    $variableService = "service" . $districtId;
                    $disService = (int)$r->$variableService; //this type casting is important else breaks in app

                    //dd($r->service_update); 
                    $disDoc->set([
                        'service_charges' => $disService
                    ], ['merge' => true]);

                    $d = District::where('id', $districtId)->update(['service_charges' => $disService]);

                    Session::flash('msg', 'District service charges updated successfully');
                } else { //for discount update 

                    if (isset($r->discount_update) && $r->discount_update == 'discount') {

                        $variable = "discount" . $districtId;
                        $disDiscount = (int)$r->$variable; //this type casting is important else breaks in app

                        $disDoc->set([
                            'discount' => $disDiscount
                        ], ['merge' => true]);

                        $d = District::where('id', $districtId)->update(['discount' => $disDiscount]);

                        Session::flash('msg', 'District discount value updated successfully');
                    }
                }


                return redirect('admin/districtDiscount');
            } else {

                $query = $disRef->where('active', '=', true);
                $data['activeDistrict'] = $query->documents();
                //mysql codes disabled as it will be fetched from firebase right now 
                //$data['activeDistrict'] = District::where('active',1)->get()->toArray();

                return view('admin/district_discount')->with($data);
            }
        } catch (\Exception $e) {
            $err_output = "Errors - ";
            if (is_array($e->errorInfo)) {
                $err_output .=  implode(",", $e->errorInfo);
            } else {
                $err_output .= $e->errorInfo;
            }
            Session::flash('msg', $err_output);
            return redirect('/admin/districtDiscount');
            //dd($e->errorInfo);
        }
    }

    public function manageDistrict(Request $r)
    {

        // if(isset($r->submit) && $r->submit == 'active'){ dd($r->disDiscount[4]); }

        $firestore = app('firebase.firestore');
        $database = $firestore->database();
        $disRef = $database->collection('districts');

        $districtRef = District::get();

        if (isset($r->submit) && $r->submit == 'active') {

            //check if current user has Edit permission to update things. This checking applies for this "any" http method route

            $has_permission = false; //SET false at first
            $current_user = $r->session()->get('user_roles'); //get user roles and perm array from sesion
            //now get current user permissions in array
            if (isset($current_user)) {
                $cur_user_perms = $current_user["perms"];
            }
            //check if current user has the permission same as which set in route
            if (isset($cur_user_perms)) {
                if (in_array("Edit", $cur_user_perms)) {
                    $has_permission = true;
                }
            }
            //now finally check if this user has that permission for this route else redirect to error page
            if ($has_permission == false) {
                //Log::info("permission true - ".$has_permission);
                return redirect("perm_error");
            }
            //roles check ends

            $data['distArr'] = $r->disId; //it will catch which were checked only  //dd($data['distArr']);

            foreach ($data['distArr'] as $key => $item) {
                $district = $disRef->document($item);
                $district->update([
                    ['path' => 'active', 'value' => true]
                ]);

                $d = District::where('id', $item)->update(['active' => 1]);
            }

            Session::flash('msg', 'District activated.');
            return redirect('/admin/district');
        } elseif (isset($r->submit) && $r->submit == 'deactive') {
            //check if current user has Edit permission to update things. This checking applies for this "any" http method route             
            $has_permission = false; //SET false at first
            $current_user = $r->session()->get('user_roles'); //get user roles and perm array from sesion
            //now get current user permissions in array
            if (isset($current_user)) {
                $cur_user_perms = $current_user["perms"];
            }
            //check if current user has the permission same as which set in route
            if (isset($cur_user_perms)) {
                if (in_array("Edit", $cur_user_perms)) {
                    $has_permission = true;
                }
            }
            //now finally check if this user has that permission for this route else redirect to error page
            if ($has_permission == false) {
                //Log::info("permission true - ".$has_permission);
                return redirect("perm_error");
            }
            //roles check ends

            $data['distArr'] = $r->disId;

            foreach ($data['distArr'] as $key => $item) {
                $district = $disRef->document($item);
                $district->update([
                    ['path' => 'active', 'value' => false]
                ]);

                $d = District::where('id', $item)->update(['active' => 0]);
            }

            Session::flash('msg', 'District deactivated.');
            return redirect('/admin/district');
        } else {
            // $districtRef = $database->collection('districts');
            // $data['district'] = $districtRef->documents();
            // $query = $districtRef->where('active','=',true);
            // $data['activeDistrict'] = $query->documents();
            $data['district'] = District::get();
            $data['activeDistrict'] = District::where('active', 1)->get()->toArray();
            $data['districtList'] = array();

            foreach ($data['district'] as $key => $item) {
                array_push($data['districtList'], $item);
            }
            return view('admin/district')->with($data);
        }
    }


    public function ManageSettings(Request $r)
    {
        /* try {
            /*$firestore = app('firebase.firestore');
        $database = $firestore->database();
        $disRef = $database->collection('districts'); 

            //$districtRef = District::get();

            if (isset($r->submit) && $r->submit == 'submit') {
                try {
                    $smsId = $r->smsApi;
                    //no district selected
                    if ($smsId == "default") {
                        Session::flash('msg', 'Select a sms api first');
                        return redirect('/admin/settings');
                    }
                    if ($smsId == "") {
                        Session::flash('msg', 'setting id is empty!');
                        return redirect('/admin/settings');
                    }

                    if ($smsId == "twilio") {
                        $smsApiVal = "twilio";
                    }
                    if ($smsId == "ssl") {
                        $smsApiVal = "sslcommerz";
                    }

                    $d = Settings::where(["id" => 1])->update(['SmsApi' => $smsApiVal]);

                    Session::flash('msg', 'Settings updated successfully');
                    return redirect('admin/settings');
                } catch (\Exception $e) {
                    dd($e->errorInfo);
                }
            } else {

                $data['settingList'] = Settings::get()->toArray();

                return view('admin/settings')->with($data);
            }
        } catch (\Exception $e) {
            dd($e);
        } */








        try {
            /*$firestore = app('firebase.firestore');
             $database = $firestore->database();
             $disRef = $database->collection('districts');*/

            //$districtRef = District::get();

            if (isset($r->submit) && $r->submit == 'submit') {
                try {
                    $smsId = $r->smsApi;
                    //no district selected
                    if ($smsId == "default") {
                        Session::flash('msg', 'Select a sms gateway api first');
                        return redirect('/admin/settings');
                    }
                    if (
                        $smsId == ""
                    ) {
                        Session::flash('msg', 'Something went wrong, setting id is empty!');
                        return redirect('/admin/settings');
                    }

                    $smsApiVal = "";
                    if ($smsId == "twilio") {
                        $smsApiVal = "twilio";
                    }
                    if ($smsId == "ssl") {
                        $smsApiVal = "sslcommerz";
                    }
                    if ($smsApiVal == "") {
                        $smsApiVal = "twilio";
                    }

                    $d = Settings::where(["id" => 1])->update(['SmsApi' => $smsApiVal]);

                    Session::flash('msg', 'Settings updated successfully');
                    return redirect('admin/settings');
                } catch (\Exception $e) {
                    dd($e->errorInfo);
                }
            } else {

                $data['settingList'] = Settings::get()->toArray();

                return view('admin/settings')->with($data);
            }
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function resetPasswordForm($title)
    {
        $data['title'] = $title;
        return view('auth/passwords/email')->with($data);
    }

    public function sendTempOtp(Request $request, $title)
    {

        try {

            $firestore = app('firebase.firestore');
            $database = $firestore->database();

            $reqData = $request->email;

            //admin data will only be in mysql //26-01-21
            /* if ($title == 'admin') {
            $ref = $database->collection('admin');
        } */

            if ($title == 'doctor') {
                $ref = $database->collection('doctors');
            }

            if ($title == 'hospital') {
                $ref = $database->collection('hospital_users');
            }

            if ($title == 'patient') {
                $ref = $database->collection('users');
            }

            //new edit
            if ($title == 'hospital') {
                //$query = $ref->where('email', '=', $reqData)->where('active', '=', 'true');
                //$documents = $query->documents();
                // sql
                $docSql = Hospital::where('email', $reqData)->where('active', 'true')->get()->toArray();
                // end
            } elseif ($title == 'doctor') {
                //$query = $ref->where('email', '=', $reqData);
                //$documents = $ref->documents();
                $docSql = Doctor::where('email', '=', $reqData)->get()->toArray();
            } elseif ($title == 'patient') {
                // $query = $ref->where('email', '=', $reqData);
                //$documents = $ref->documents();
                $docSql = User::where('email', '=', $reqData)->get()->toArray();
            } elseif ($title == 'admin') {
                //$query = $ref->where('email', '=', $reqData);
                //$documents = $ref->documents();
                $docSql = Admin::where('email', '=', $reqData)->get()->toArray();
            }
            //dd($documents);
            //end

            /* $data = array();
        foreach ($documents as $item) {
            array_push($data, $item->data());
        } */

            $dataSql = array();
            foreach ($docSql as $item) {
                array_push($dataSql, $item);
            }

            $flag = false;
            $flag1 = false;

            //new
            //if (empty($data) || empty($dataSql)) {
            if (empty($dataSql)) {
                Session::flash('error-notify-temporary', 'Please contact with support team.');
                return redirect()->back();
            } else {

                //no checking in firebase 26-01-21 
                /* foreach ($data as $key => $item) {

                if (isset($item['email']) && $item['email'] == $reqData) {
                    $flag = true;
                    break;
                }
            } */

                foreach ($dataSql as $key => $item) {

                    if (isset($item['email']) && $item['email'] == $reqData) {
                        $flag1 = true;
                        break;
                    }
                }

                if ($flag1 == false || $flag1 == false) {
                    Session::flash('error-notify-temporary', 'This email is not exists.');
                    return redirect()->back();
                } else {
                    $uid = '';
                    //firebase code 26-1-21
                    /*                 foreach ($data as $key => $item) {

                    if (isset($item['email']) && $item['email'] == $reqData) {
                        if ($title == 'hospital') {
                            $uid = $item['hospitalUid'];
                        } else {
                            //dd($item);
                            if ($title == 'admin') {
                                $uid = "super";
                            } else {
                                $uid = $item['uid'];
                                $hospitalized = $item['hospitalized'];
                                //   if($hospitalized == false){
                                //     $uid = $uid ;
                                //   }elseif($hospitalized == true){
                                //     $uid = substr($uid, 2);
                                //   }
                            }
                        }
                    }
                } */

                    foreach ($dataSql as $key => $item) {

                        if (isset($item['email']) && $item['email'] == $reqData) {
                            if ($title == 'hospital') {
                                $uid = $item['hospitalUid'];
                            } else {
                                //dd($item);
                                if ($title == 'admin') {
                                    //$uid = "super";
                                    $uid = $item['id'];
                                } else {
                                    $uid = $item['uid'];
                                    $hospitalized = $item['hospitalized'];
                                    //   if($hospitalized == false){
                                    //     $uid = $uid ;
                                    //   }elseif($hospitalized == true){
                                    //     $uid = substr($uid, 2);
                                    //   }
                                }
                            }
                        }
                    }

                    $MailSend = new MailSendController();
                    $temp_pass = 'telocure' . '' . mt_rand(1000000, 99999999);
                    $val = $MailSend->sendResetPassword($temp_pass, $reqData);

                    //encrypted password...
                    $pass = $temp_pass;
                    $method = "AES-128-CBC";
                    $key = 'SECRETOFTELOCURE';
                    //$iv = openssl_random_pseudo_bytes(16);
                    $iv = "1234567812345678";
                    $password = openssl_encrypt($pass, $method, $key, 0, $iv);
                    //end

                    if ($title == "admin") $password = $pass;
                    else $password = $password;

                    //no data will be added in firebase for admins 26-01-21
                    if ($title != "admin") {
                        //get user data from firebase for update
                        $userData = $ref->document($uid);
                        $userData->update([
                            ['path' => 'password', 'value' => $password]
                        ]);
                    }

                    // code for sql
                    if ($title == 'doctor') {
                        Doctor::where('uid', $uid)->update(['password' => $password]);
                    }
                    if ($title == 'patient') {
                        User::where('uid', $uid)->update(['password' => $password]);
                    }
                    if ($title == 'hospital') {
                        Hospital::where('hospitalUid', $uid)->update(['password' => $password]);
                    }
                    if ($title == 'admin') {
                        Admin::where('id', $uid)->update(['password' => $password]);
                    }
                    // end

                    Session::flash('notify-temporary', 'Temporary password sent to your mail.');
                    return redirect('login/' . $title);
                }
            }
        } catch (\Exception $e) {
            dd($e);
        }
    }

    public function subscribe(Request $request)
    {
        $email = $request->email;
        $MailSend = new MailSendController();
        $captFlag = false;
        if (isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])) {
            $secret = '6Lc82kMaAAAAAPjnIJ1iI2KcOBvGQVu2_BKN66A1';
            $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=6Lc82kMaAAAAAGEpq98e5U7Ys6AHls7brhDxwqox&response=' . $_POST['g-recaptcha-response']);
            $responseData = json_decode($verifyResponse);
            if ($responseData->success) {
                //$captchMsg = 'Your contact request have submitted successfully.';
                //dd($responseData);

            } else {
                $captchMsg = 'Robot verification failed, please try again.';
                $captFlag = true;
            }
        } else {
            $captchMsg = 'Robot verification failed, no g-recaptcha-response field, please try again.';
            $captFlag = true;
        }
        if ($captFlag) {
            Session::flash('notify-subscribe', $captchMsg);
            return redirect()->back();
        }


        $link = 'Your subscription received successfully.';
        $val = $MailSend->subscribe($link, $email);

        Session::flash('notify-subscribe', 'Your subscribe request has been received, Thanks.');
        return redirect()->back();
        
    }

    public function contactus(Request $request)
    {
        //$email = $request->email;
        $MailSend = new MailSendController();

        $msg_number_chk = (int)$request->msg_number_chk;
        $msg_number = (int)$request->msg_number;
        $captchMsg = "";
        $captFlag = false;
        $flag = false;

        if ($msg_number_chk ==  $msg_number) {
            $flag = true;
        }

        if (isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])) {
            $secret = '6Lc82kMaAAAAAPjnIJ1iI2KcOBvGQVu2_BKN66A1';
            $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=6Lc82kMaAAAAAGEpq98e5U7Ys6AHls7brhDxwqox&response=' . $_POST['g-recaptcha-response']);
            $responseData = json_decode($verifyResponse);
            if ($responseData->success) {
                //$captchMsg = 'Your contact request have submitted successfully.';
                //dd($responseData);

            } else {
                $captchMsg = 'Robot verification failed, please try again.';
                $captFlag = true;
            }
        } else {
            $captchMsg = 'Robot verification failed, no g-recaptcha-response field, please try again.';
            $captFlag = true;
        }
        if ($captFlag) {
            Session::flash('notify-contactus', $captchMsg);
            return redirect()->back();
        }
        if ($flag) {
            $name = $request->name;
            $userEmail = $request->email;
            $phone = $request->phone_number;
            $subject = $request->subject;
            $message = $request->message;

            $email = 'dev.telocure@gmail.com';

            $val = $MailSend->contactusMail($name, $userEmail, $phone, $subject, $message, $email);

            Session::flash('notify-contactus', 'Your Contact request has been received, We will contact with you very soon.');
            return redirect()->back();
        } else {
            Session::flash('notify-contactus', 'your entered summation or substraction of two numbers is incorrect');
            return redirect()->back();
        }
    }

    public function changePassword($title, $id)
    {
        $data['title'] = $title;
        $data['id'] = $id;
        if ($title == 'admin') {
            return view('changepassword')->with($data);
        } elseif ($title == 'doctor') {
            return view('doctor.changepassword')->with($data);
        } elseif ($title == 'hospital') {
            return view('hospital.changepassword')->with($data);
        } elseif ($title == 'patient') {
            return view('patient.changepassword')->with($data);
        }
    }

    public function changePasswordAction(Request $r)
    {
        try {

            $data = $r->session()->get('user');
            //dd($data);
            $email = $data[0]['email'];
            $title = $r->title;
            $id = $r->id;
            $password = $r->Password;

            $v = validator::make($r->all(), [
                'Password' => 'required|min:8|regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/'
            ]);

            if ($v->fails()) {
                //Session::flash('error-changepassword','Password length must be 8');
                return redirect()->back()->withInput()->withErrors($v->errors());
            }
            //check if same password entered //mridul 20-9-20
            if ($title != 'admin') {
                $current_pass = $data[0]['password'];

                $method = "AES-128-CBC";
                $key = 'SECRETOFTELOCURE';
                $iv = "1234567812345678";
                $pass_encrypted = openssl_encrypt($password, $method, $key, 0, $iv);
                //dd($enpassword);
                if ($current_pass == $pass_encrypted) {
                    Session::flash('error-changepassword', 'Please enter a new password other than your current password');
                    return redirect()->back()->withInput();
                }
            }
            //same pass check ends 

            $firestore = app('firebase.firestore');
            $database = $firestore->database();

            if ($title == 'admin') $userCollection = $database->collection('admin');
            elseif ($title == 'hospital') $userCollection = $database->collection('hospital_users');
            elseif ($title == 'doctor') {
                $userCollection = $database->collection('doctors');
                $query = $userCollection->where('email', '=', $email);
                $doctorInfo = $query->documents();
                $doctorArr = array();

                foreach ($doctorInfo as $key => $value) {
                    array_push($doctorArr, $value->data());
                }


                /***for sql***/
                $doctorInfoSql = Doctor::where('email', $email)->get()->toArray();
                $doctorArrSql = array();

                foreach ($doctorInfoSql as $key => $value) {
                    array_push($doctorArrSql, $value);
                }
                /*****end*****/
            } elseif ($title == 'patient') {
                $userCollection = $database->collection('users');
                $query = $userCollection->where('email', '=', $email);
                $doctorInfo = $query->documents();
                $doctorArr = array();

                foreach ($doctorInfo as $key => $value) {
                    array_push($doctorArr, $value->data());
                }

                /***for sql***/
                $doctorInfoSql = Doctor::where('email', $email)->get()->toArray();
                $doctorArrSql = array();

                foreach ($doctorInfoSql as $key => $value) {
                    array_push($doctorArrSql, $value);
                }
                /*****end*****/
            }

            $method = "AES-128-CBC";
            $key = 'SECRETOFTELOCURE';
            $iv = "1234567812345678";
            $enpassword = openssl_encrypt($password, $method, $key, 0, $iv);

            if ($title == 'admin') {
                $pass = $r->Password;
                Admin::where('id', $id)->update(['password' => $pass]);
            } else $pass = $enpassword;

            // code for sql
            if ($title == 'doctor') {
                Doctor::where('uid', $id)->update(['password' => $pass]);
            }
            if ($title == 'patient') {
                User::where('uid', $id)->update(['password' => $pass]);
            }
            if ($title == 'hospital') {
                Hospital::where('hospitalUid', $id)->update(['password' => $pass]);
            }
            // end

            //20/01/21 - no update to firebase db for admin user as for roles all admin data will be in mysql table
            /*          $userData = $userCollection->document($id);

            $userData->update([
                ['path' => 'password', 'value' => $pass]
            ]); */
            ////20-9-20
            //now put updated pass back in user array password field in session 
            //if($title != 'admin') {
            foreach ($data as $key => $value) {
                if ($key == 0) {
                    $data[$key]['password'] = $pass;
                }
            }
            $r->session()->put('user', $data);
            //}
            //dd($data);

            Session::flash('change-password', 'Your password changed.');
            return redirect()->back();
        } catch (\Exception $e) {
            dd($e);
        }
    }


    public function updateBankInfo(Request $request, $id)
    {
        $firestore = app('firebase.firestore');
        $database = $firestore->database();

        $hosInfo = $database->collection('hospital_users');

        $ref = $hosInfo->document($id)->snapshot()->data();

        if ($request->update == 'update') {
            if ($ref['bankInfoUpdateRequest'] == true) {
                $updateInfo = $hosInfo->document($id)
                    ->collection('bank_info')->document($id);

                $updateInfo->update([
                    ['path' => 'accountName', 'value' => $request->accountName],
                    ['path' => 'bankName', 'value' => $request->bankName],
                    ['path' => 'accountNumber', 'value' => $request->accountNumber],
                    ['path' => 'swiftCode', 'value' => $request->swiftCode],
                ]);


                // $doctor = $database->collection('doctors');
                // $queryForDoctor = $doctor->

                /******new 26/07/2020******/
                $bArr = [
                    'accountName' => $request->accountName,
                    'bankName' => $request->bankName,
                    'accountNumber' => $request->accountNumber,
                    'swiftCode' => $request->swiftCode
                ];
                $bdata = json_encode($bArr);

                Hospital::where('hospitalUid', $id)->update(['bank_info' => $bdata]);
                // Doctor::where('hospitalUid',$id)->update(['bank_info' => $bdata]);
                /****end****/

                /* temporary commented */
                /*
                $statusChange = $hosInfo->document($id);
                $statusChange->update([
                    ['path' => 'bankInfoUpdateRequest', 'value' => false]
                ]);
                */

                // 26/07/2020
                /* Hospital::where('hospitalUid',$id)->update(['bankInfoUpdateRequest' => 'false']); */
                /****end****/

                $docInfo = $database->collection('doctors');
                // $query = $docInfo->where('hospitalUid','=',$id);
                // $docRef = $query->documents();

                $docRef = Doctor::where('hospitalUid', '=', $id)->get()->toArray();

                $doctorInfo = array();
                foreach ($docRef as $item) {
                    array_push($doctorInfo, $item);
                }

                if (isset($doctorInfo) && !empty($doctorInfo)) {

                    foreach ($doctorInfo as $item) {

                        $docData = $docInfo->document($item['uid'])
                            ->collection('bank_info')->document($item['uid']);

                        $docData->update([
                            ['path' => 'accountName', 'value' => $request->accountName],
                            ['path' => 'bankName', 'value' => $request->bankName],
                            ['path' => 'accountNumber', 'value' => $request->accountNumber],
                            ['path' => 'swiftCode', 'value' => $request->swiftCode],
                        ]);

                        /******new 26/07/2020******/

                        $bArr = [
                            'accountName' => $request->accountName,
                            'bankName' => $request->bankName,
                            'accountNumber' => $request->accountNumber,
                            'swiftCode' => $request->swiftCode
                        ];

                        $bdata = json_encode($bArr);

                        Doctor::where('uid', $item['uid'])->update(['bank_info' => $bdata]);

                        Hospital::where('hospitalUid', $item['hospitalUid'])->update(['bank_info' => $bdata]);
                        // dd($bdata);

                        /****end****/
                    }
                }
            }

            Session::flash('add-bank-info', 'Bank information updated successfully.');
            $data['id'] = $id;
            return view('admin/updateBankInfo')->with($data);
        } else {
            $data['id'] = $id;
            return view('admin/updateBankInfo')->with($data);
        }
    }

    public function mobinotification($token, $senderName, $senderPhoto, $senderID)
    {

        // $token = $_GET['token'];
        //     $senderName = $_GET['sender_name'];
        //     $senderPhoto = $_GET['sender_photo'];
        // $senderID = $_GET['sender_id'];
        //    $requestId = $_GET['request_id'];

        $api_key = 'AAAAYDr3JGI:APA91bFUyP7EVjDzi8l1HHvmFq_2JWw6BeBXd8E1Dg0Hds8S1hZkh4zbLQzXpPOc4SOC5_LhN4eI8-ETDPpVF-YBdcx04y0cZb4pgBwOTOeDQwjeYa0BueT44a8kBev8AoQvaxpzC5Gn';

        $url = 'https://fcm.googleapis.com/fcm/send';

        $notified = array(
            "title" => "New request",
            "body" => "New request from patient",
            "icon" => "ic_request.png",
            "require_interaction" => true
        );

        $message = array("sender_name" => $senderName, "sender_id" => $senderID, "sender_photo" => $senderPhoto);

        $fields = array(
            'to' => urlencode($token),
            'priority' => 'high',
            'data' => $message,
            'time_to_live' => 0,
            'message_type' => 'nack',
            'content_available' => false
            // 'notification'=>$notified,
        );


        $jsondata = json_encode($fields);

        //      dd($jsondata);

        $headers = array(
            'Authorization: key=' . $api_key,
            'Content-Type: application/json'
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsondata);

        $result = curl_exec($ch);

        if ($result === FALSE) {
            die('Problem occurred: ' . curl_error($ch));
        }

        curl_close($ch);
        echo "curl: " . $ch;
        echo "result: " . $result;
        return $result;
    }
}