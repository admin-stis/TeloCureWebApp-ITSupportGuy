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
   		$query = $doctorsRef->where('active','=',true);
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
   		$dis_val = array_fill(0, 65,0);
   		foreach ($districts as $district) {
   			if ($district->exists()){
   				$temp = array('id' => $district['id'],'name'=>$district['name'],'bn_name'=>$district['bn_name'],'count'=>0);
   				$dis_val[$district['id']] = $temp;
   			}
   		}
   		$doctorRef = $database->collection('doctors');
   		$doctors = $doctorRef->documents();
   		foreach ($doctors as $doctor) {
   			if($doctor->exists()){
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
   		$doctor_gender = array('Male' => 0,'Female'=>0);
   		foreach ($doctors as $doctor) {
   			if($doctor->exists()){
	   			if($doctor['gender']=="Male"){

	   				$doctor_gender['Male']++;
	   			}else{
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

    // new code 20-04-2020
    public function setdoctors(Request $request)
    {
        $firestore = app('firebase.firestore');
        $database = $firestore->database();

        $doctorRef = $database->collection('doctors');
        $docData = $doctorRef->documents();

        $doctor = array();
        foreach($docData as $item){
            array_push($doctor,$item->data());
        }

        $flag = false;
        $emailFlag = false;

        foreach($doctor as $key=>$item){
          if(isset($item['phone']) && $item['phone'] == $request->mobile){
            Session::flash('phonemsg','Contact number already exits.');
            $flag = true ;
            break;
          }
        }

        foreach($doctor as $key=>$item){
          if(isset($item['email']) && $item['email'] == $request->email){
                Session::flash('emailmsg','Email already exits.');
                $emailFlag = true ;
                break;
          }
        }

        $v = validator::make($request->all(),[
            'name' => 'required|alpha|max:15',
            'lastname' => 'required|alpha|max:10',
            'email' => 'required',
            'password' => 'required|min:8|regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/|confirmed',
            'mobile' =>  'required|digits:11',
        ]);


        if($v->fails()){
            return redirect()->back()->withInput()->withErrors($v->errors());
        }

        if($flag == true && $emailFlag == true){
          return redirect()->back()->withInput();
        }elseif($flag == true && $emailFlag == false){
          return redirect()->back()->withInput();
        }elseif($flag == false && $emailFlag == true){
          return redirect()->back()->withInput();
        }

        $doctorRef = $database->collection('doctors')->newDocument();

        //encrypted password...
        /***********temporary commented***********/
        $pass = $request->password ;
        $method = "AES-128-CBC";
        $key = 'SECRETOFTELOCURE';
        $iv = "1234567812345678" ;
        $password = openssl_encrypt($pass,$method,$key,0,$iv);
        /*****************end**********************/

        //testing
        //$password = encrypt($request->password);

        $doctorRef->set([
            'uid' => $doctorRef->id(),
            'active'=> false,
            'email'=> $request->email,
            'name'=> $request->name.' '.$request->lastname,
            'phone' => $request->mobile,
            'password' => $password,
            "totalRating" => 0,
            "price" => 0,
            "totalCount" => 0,
            "hospitalUid" => null,
            "hospitalized" => false,
            "online" => false,
            "rejected" => false,
            "createdAt" => new Timestamp(new DateTime()),
            "hospitalName"=> ""
        ]);

        return redirect('login/doctor');
    }

    //29-04-2020
    public function setpatients(Request $request)
    {

        $firestore = app('firebase.firestore');
        $database = $firestore->database();
        $patientRef = $database->collection('users')->newDocument();

        $v = validator::make($request->all(),[
            'name' => 'required|alpha|max:15',
            'lastname' => 'required|alpha|max:10',
            'email' => 'required',
            'password' => 'required|min:8|regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/|confirmed',
            'mobile' =>  'required|digits:11',
        ]);

        if($v->fails()){
            return redirect()->back()->withErrors($v->errors());
        }

        $pass = $request->password ;
        $method = "AES-128-CBC";
        $key = 'SECRETOFTELOCURE';
        $iv = "1234567812345678" ;
        $password = openssl_encrypt($pass,$method,$key,0,$iv);

        //end

        $patientRef->set([
            'uid' => $patientRef->id(),
            'approve' => '',
            'online' => '',
            'active'=> true,
            'email'=> $request->email,
            'name'=> $request->name,
            'lastname' => $request->lastname,
            'phone' => $request->phone,
            'password' => $password,
            'gender' => '',
            'weight' => '',
            'height' => '',
            'bloodGroup' => '',
            'totalCount' => '',
            'totalRating' => '',
            'medication' => '',
            'smoke' => '',
            'photoUrl' => ''
        ]);

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

        $firestore = app('firebase.firestore');
        $database = $firestore->database();

        $pass = $request->password ;

        //password encryption.....
        /************temporary***********/
        $method = "AES-128-CBC";
        $key = 'SECRETOFTELOCURE';
        $iv = "1234567812345678" ;
        $password = openssl_encrypt($pass,$method,$key,0,$iv);

        if($request->title =='doctor'){
          $v = validator::make($request->all(),[
              'password' => 'required|min:8|regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/',
              'common' =>  'required|max:14',
          ]);

          if($v->fails()){
              return redirect()->back()->withInput()->withErrors($v->errors());
          }
          $userRef = $database->collection('doctors');
        }
        else if($request->title =='patient'){
          $v = validator::make($request->all(),[
              'password' => 'required|min:8|regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/',
              'common' =>  'required|max:14',
          ]);

          if($v->fails()){
              return redirect()->back()->withInput()->withErrors($v->errors());
          }
          $userRef = $database->collection('users');
        }
        else if ($request->title =='hospital'){

            $userRef = $database->collection('hospital_users');

            $v = validator::make($request->all(),[
                'password' => 'required|min:8|regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/',
                'common' =>  'required',
            ]);

            $email = $request->common ;
            $query = $userRef->where('email','=',$email)->where('password','=',$password);

            if($v->fails()){
                return redirect()->back()
                  ->withInput()
                  ->withErrors($v->errors());
            }

            $userInfo = $query->documents();

            $userArr = array();

            foreach ($userInfo as $user) {
                if($user->exists()){
                    array_push($userArr, $user->data());
                }
            }

            if(!empty($userArr)){
                $request->session()->put('user',$userArr);
                //Edit from mafiz vai
                $MailSend = new MailSendController();
                $otp = mt_rand(10000,99999);
                $val = $MailSend->sendOtp($otp,$email);
                $helodoc2fa = array(
                    'title' => $request->title,
                    'opt' => $otp,
                    'status'=> false
                );
                $request->session()->put('helodoc2fa', $helodoc2fa);
                if ($val){
                    return redirect('/2fa')->with($helodoc2fa);
                }
            }

        }
        else if($request->title =='admin'){

            $userRef = $database->collection('admin');
            /*new code */
            //dd($userRef->documents());
            $password = $request->password;

            $v = validator::make($request->all(),[
                'password' => 'required|min:8|regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/',
                'common' =>  'required',
            ]);

            $email = $request->common ;
            $query = $userRef->where('email','=',$email)->where('password','=',$password);

            if($v->fails()){
                return redirect()->back()->withInput()->withErrors($v->errors());
            }

            $userInfo = $query->documents();

            $userArr = array();

            foreach ($userInfo as $user) {
                if($user->exists()){
                    array_push($userArr, $user->data());
                }
            }

            if(!empty($userArr)){

                $request->session()->put('user',$userArr);

                //Edit from mafiz vai
                $MailSend = new MailSendController();
                $otp = mt_rand(10000,99999);

                $val = $MailSend->sendOtp($otp,$email);

                $helodoc2fa = array(
                    'title'	=> $request->title,
                    'opt'	=> $otp,
                    'status'=> false
                );

                $request->session()->put('helodoc2fa', $helodoc2fa);

                if ($val){
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
        $phone = $request->common ;
        $query = $userRef->where('phone','=',$phone)->where('password','=',$password);
        // }

        $userInfo = $query->documents();

        $userArr = array();

        foreach ($userInfo as $user) {
            if($user->exists()){
                array_push($userArr, $user->data());
            }
        }

        if(!empty($userArr)){
            if(isset($userArr[0]['email']))$email = $userArr[0]['email'];
            /*$districtRef = $database->collection('districts');

            $data['district'] = $districtRef->documents();

            $data['districtList'] = array();

            foreach($data['district'] as $key=>$item){
                array_push($data['districtList'],$item->data());
            }*/

            $districtRef = $database->collection('districts');

            $data['district'] = $districtRef->where('active','=',true)->documents();
            $districtList = array();

            foreach($data['district'] as $key=>$item){
                array_push($districtList,$item->data());
            }

            $request->session()->put('user',$userArr);
            $request->session()->put('district',$districtList);

            //Edit from mafiz vai
            $MailSend = new MailSendController();
            $otp = mt_rand(10000,99999);

            $val = $MailSend->sendOtp($otp,$email);

            /*
            send through mobile
            --------------------------------
            */
            $msisdn = $phone;
            $messageBody = "Your otp : ".$otp;
            $csmsId = uniqid(); // csms id must be unique

            /********temporary commented will comment out for client****************/
            echo $this->singleSms($msisdn, $messageBody, $csmsId);
            /********end*********/

            $helodoc2fa = array(
                'title'	=> $request->title,
                'opt'	=> $otp,
                'status'=> false
            );

            $request->session()->put('helodoc2fa', $helodoc2fa);

            if($request->title == 'hospital'){
                if($userArr[0]['login_attempt'] == false){
                    $hospital_user = $userRef->document($userArr[0]['hospitalUid']);
                    $hospital_user->update([
                        ['path' => 'login_attempt', 'value' => true]
                    ]);
                    $data['hospitalUser'] = $userArr[0]['hospitalUid'];
                    return view('frontend/new_pass')->with($data) ;
                }else{
                    if ($val){
                        return redirect('/2fa')->with($helodoc2fa);
                    }
                }
            }

            elseif ($val){
                return redirect('/2fa')->with($helodoc2fa);
            }

        }else{
            return redirect()->back()->withInput()->withErrors($v->errors())->with('msg','Invalid email/mobile or password.');
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

        $v = validator::make($request->all(),[
            'name'     => 'required|regex:/^[\pL\s\-]+$/u',
            'hospitalName' => 'required|max:25|regex:/^[\pL\s\-]+$/u',
            'hospitalAddress' => 'required|max:100',
            'phone' =>  'required|max:14',
            'plan' => 'required',
            'email' => 'required'
        ]);

        $hosRef = $database->collection('hospital_users');
        $hosData = $hosRef->documents();

        $hospital = array();
        foreach($hosData as $item){
            array_push($hospital,$item->data());
        }

        //test
        $flag = false;
        $emailFlag = false;

        foreach($hospital as $key=>$item){
            if(isset($item['phone']) && $item['phone'] == $request->phone){
                Session::flash('phonemsg','Contact number already exits.');
                $flag = true ;
                break;
            }
        }

        foreach($hospital as $key=>$item){
          if(isset($item['email']) && $item['email'] == $request->email){
                Session::flash('emailmsg','Email already exits.');
                $emailFlag = true ;
                break;
          }
        }

        /*
        if($v->fails()){
            if($flag == true){
                Session::put('msg','Contact number already exist.');
                return redirect()->back()->withInput()->withErrors($v->errors())->with('msg','Contact number already exist.');
            }
            return redirect()->back()->withInput()->withErrors($v->errors());
        }
        */
        if($v->fails()){
            return redirect()->back()->withInput()->withErrors($v->errors());
        }

        if($flag == true && $emailFlag == true){
          return redirect()->back()->withInput();
        }elseif($flag == true && $emailFlag == false){
          return redirect()->back()->withInput();
        }elseif($flag == false && $emailFlag == true){
          return redirect()->back()->withInput();
        }

        $insertData = $hosRef->newDocument();

        $insertData->set([
            'hospitalUid' => $insertData->id(),
            'online' => '',
            'active'=> false,
            'approve' => false,
            'email'=> $request->email,
            'name'=> $request->name,
            'phone' => $request->phone,
            'password' => '',
            'plan' => $request->plan,
            'hospitalName' => $request->hospitalName,
            'hospitalAddress' => $request->hospitalAddress,
            'comment' => $request->comment,
            'login_attempt' => false
        ]);

        $balance = $hosRef->document($insertData->id())->collection('balance')
          ->document($insertData->id())->set([
            'balance' => 0,
            'updatedTime' => new Timestamp(new DateTime()),
        ]);

        Session::flash('notification','Please wait. After admin approve you, a email will sent to your mail.');
        //return redirect('login/hospital')->with('notification','A email will be sent to your email.');
        return redirect()->back();
    }

    public function manageDistrict(Request $r){

      $firestore = app('firebase.firestore');
      $database = $firestore->database();
      $disRef = $database->collection('districts');

      if(isset($r->submit) && $r->submit == 'active'){

        $data['distArr'] = $r->disId ;

        foreach($data['distArr'] as $key => $item){
            $district = $disRef->document($item);
            $district->update([
                ['path' => 'active' , 'value' => true]
            ]);
        }

        Session::flash('msg','District activated.');
        return redirect('/admin/district');

      }elseif(isset($r->submit) && $r->submit == 'deactive'){
        $data['distArr'] = $r->disId ;

        foreach($data['distArr'] as $key => $item){
            $district = $disRef->document($item);
            $district->update([
                ['path' => 'active' , 'value' => false]
            ]);
        }

        Session::flash('msg','District deactivated.');
        return redirect('/admin/district');
      }
      else{
        $districtRef = $database->collection('districts');
            $data['district'] = $districtRef->documents();
            $query = $districtRef->where('active','=',true);
            $data['activeDistrict'] = $query->documents();
            $data['districtList'] = array();

            foreach($data['district'] as $key=>$item){
                array_push($data['districtList'],$item->data());
            }
        return view('admin/district')->with($data);
      }

    }

    public function resetPasswordForm($title){
        $data['title'] = $title;
        return view('auth/passwords/email')->with($data);
    }

    public function sendTempOtp(Request $request,$title){

        $firestore = app('firebase.firestore');
        $database = $firestore->database();

        $reqData = $request->email ;

        if($title == 'admin') $ref = $database->collection('admin');

        if($title == 'doctor') $ref = $database->collection('doctors');

        if($title == 'hospital') $ref = $database->collection('hospital_users');

        $query = $ref->where('email','=',$reqData);
        $documents = $ref->documents();

        $data = array();
        foreach($documents as $item){
            array_push($data,$item->data());
        }

        $flag = false;
        foreach($data as $key=>$item){
            if(isset($item['email']) && $item['email'] == $reqData){
                $flag = true ;
                break;
            }
        }

        if($flag == false){
          Session::flash('error-notify-temporary','This email is not exists.');
          return redirect()->back();
        }else{
          $uid = '';
          foreach ($data as $key => $value) {
            if(isset($item['email']) && $item['email'] == $reqData){
              if($title == 'hospital'){
                $uid = $item['hospitalUid'];
              }else{
                //dd($item);
                if($title == 'admin'){
                  $uid = "super";
                }else{
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
          $temp_pass = 'telocure'.''.mt_rand(1000000,99999999);
          $val = $MailSend->sendResetPassword($temp_pass,$reqData);
          $userData = $ref->document($uid);

          //encrypted password...
          $pass = $temp_pass ;
          $method = "AES-128-CBC";
          $key = 'SECRETOFTELOCURE';
          //$iv = openssl_random_pseudo_bytes(16);
          $iv = "1234567812345678" ;
          $password = openssl_encrypt($pass,$method,$key,0,$iv);
          //end

          if($title == "admin") $password = $pass ;
          else $password = $password;

          $userData->update([
            ['path' => 'password' , 'value' => $password]
          ]);

          Session::flash('notify-temporary','Temporary password sent to your mail.');
          return redirect('login/'.$title);
        }
    }

    public function subscribe(Request $request)
    {
      $email = $request->email;
      $MailSend = new MailSendController();
      $link = 'You are subscribe successfully.';
      $val = $MailSend->subscribe($link,$email);
      return redirect()->back();
    }

    public function contactus(Request $request)
    {
      //$email = $request->email;
      $MailSend = new MailSendController();

      $name = $request->name;
      $userEmail = $request->email;
      $phone = $request->phone_number;
      $subject = $request->subject;
      $message = $request->message;

      $email = 'support@telocure.com';

      $val = $MailSend->contactusMail($name,$userEmail,$phone,$subject,$message,$email);

      Session::flash('notify-contactus','We will caontact with you very soon.');
      return redirect()->back();
    }

    public function changePassword($title,$id){
      $data['title'] = $title;
      $data['id'] = $id;
      if($title == 'admin'){
        return view('changepassword')->with($data);
      }elseif($title == 'doctor'){
        return view('doctor.changepassword')->with($data);
      }elseif($title == 'hospital'){
        return view('hospital.changepassword')->with($data);
      }
    }

    public function changePasswordAction(Request $r)
    {
      $data = $r->session()->get('user');
      //dd($data[0]['email']);
      $firestore = app('firebase.firestore');
      $database = $firestore->database();

      $email = $data[0]['email'];
      $title = $r->title;
      $id = $r->id;
      $password = $r->Password;

      $v = validator::make($r->all(),[
              'Password' => 'required|min:8|regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/'
          ]);

      if($v->fails()){
        Session::flash('error-changepassword','Password length must be 8');
            return redirect()->back()->withInput()->withErrors($v->errors());
        }

      if($title == 'admin') $userCollection = $database->collection('admin');
      elseif($title == 'hospital') $userCollection = $database->collection('hospital_users');
      elseif($title == 'doctor') {
        $userCollection = $database->collection('doctors');
        $query = $userCollection->where('email','=',$email);
        $doctorInfo = $query->documents();
        $doctorArr = array();

        foreach ($doctorInfo as $key => $value) {
          array_push($doctorArr,$value->data());
        }

        // if(isset($doctorArr[0]['hospitalized']) && $doctorArr[0]['hospitalized'] == true){
        //   //$uid = $doctorArr[0]['uid'];
        //   $id = substr($id,2);
        // }else{
        //   $id = $id;
        // }
      }

      $method = "AES-128-CBC";
      $key = 'SECRETOFTELOCURE';
      $iv = "1234567812345678" ;
      $enpassword = openssl_encrypt($password,$method,$key,0,$iv);

      if($title == 'admin') $pass = $r->Password;
      else $pass = $enpassword;

      $userData = $userCollection->document($id);

      $userData->update([
        ['path' => 'password','value' => $pass]
      ]);

      Session::flash('change-password','Your password changed.');
      return redirect()->back();

    }

    public function mobinotification($token,$senderName,$senderPhoto,$senderID){

      // $token = $_GET['token'];
      //     $senderName = $_GET['sender_name'];
      //     $senderPhoto = $_GET['sender_photo'];
      // $senderID = $_GET['sender_id'];
      //    $requestId = $_GET['request_id'];

      $api_key='AAAAYDr3JGI:APA91bFUyP7EVjDzi8l1HHvmFq_2JWw6BeBXd8E1Dg0Hds8S1hZkh4zbLQzXpPOc4SOC5_LhN4eI8-ETDPpVF-YBdcx04y0cZb4pgBwOTOeDQwjeYa0BueT44a8kBev8AoQvaxpzC5Gn';

      $url = 'https://fcm.googleapis.com/fcm/send';

      $notified = array(
        "title"=>"New request",
        "body"=>"New request from patient",
        "icon"=>"ic_request.png",
        "require_interaction"=>true);

          $message = array("sender_name" => $senderName,"sender_id" => $senderID,"sender_photo" => $senderPhoto);

        $fields = array(
          'to' => urlencode($token),
          'priority'=>'high',
          'data' => $message,
          'time_to_live'=>0,
          'message_type'=>'nack',
          'content_available'=>false
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
      echo "curl: ".$ch;
      echo "result: ".$result;
      return $result;
    }

}
