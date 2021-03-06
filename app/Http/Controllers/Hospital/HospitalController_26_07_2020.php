<?php

namespace App\Http\Controllers\Hospital;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\MailSendController;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Google\Cloud\Core\Timestamp;
use DateTime;


class HospitalController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {

        $data['hospitalUser'] = Session::get('user');

        $firestore = app('firebase.firestore');
        $database = $firestore->database();
        $info = $database->collection('hospital_users');
        //dd($data);
        /*
        $uid = $data['hospitalUser'][0]['uid'];
        $hospital_user = $info->document($uid);
        $userinfo = $hospital_user->snapshot();

        if($userinfo['login_attempt'] == false){

            $hospital_user->update([
                ['path' => 'login_attempt', 'value' => true]
            ]);
            return view('frontend/new_pass')->with($data) ;
        }else{
        */
        // 11-05-2020
        // $docRef = $database->collection('doctors');
        // $doctors = $docRef->documents();

        //dd($data['hospitalUser']);

        if(isset($data['hospitalUser'][0]['hospitalUid']) && $data['hospitalUser'][0]['hospitalUid'] == true)
        $id = $data['hospitalUser'][0]['hospitalUid'];

        $docRef = $database->collection('doctors');
        //$q = $docRef->where('hospitalized','=',true);
        $q = $docRef->where('hospitalUid','=', $id);
        $doctors = $q->documents();

        $data['hospitalsDoctor'] = array();

        foreach($doctors as $key=>$item){
            array_push($data['hospitalsDoctor'],$item->data());
            //$hospitalData = $info->where('hospitalUid','=',$item->data()['hospitalUid']);
            //$info->where
        }

        $data['rev'] = $this->totalRevenue($id);

        //dd($data);

        return view('hospital.index')->with($data);
        //}
    }

    public function profile($uid)
    {
        $firestore = app('firebase.firestore');
        $database = $firestore->database();
        $info = $database->collection('hospital_users');
        $hospital_user = $info->document($uid);
        $data['userProfile'] = $hospital_user->snapshot();
        return view('hospital/userProfile')->with($data);
    }

    public function branch($id){
        $firestore = app('firebase.firestore');
        $database = $firestore->database();
        $docRef = $database->collection('hospitalBranch')->where('hospitalUserId','=',$id)->documents();
        $data['branch'] = array();
        foreach($docRef as $val){
            array_push($data['branch'],$val->data());
        }
        return view('hospital/branch')->with($data);
    }

    public function addHospital($id)
    {
        $firestore = app('firebase.firestore');
        $database = $firestore->database();
        $hospital = $database->collection('hospital_users')->where('hospitalUid','=',$id)->documents();

        $data['uid'] = $id;

        $data['hospital'] = array();
        foreach ($hospital as $key => $value) {
            array_push($data['hospital'],$value->data());
        }

        return view('hospital/addHospital')->with($data);
    }

    public function addHospitalAction(Request $request)
    {
        $firestore = app('firebase.firestore');
        $database = $firestore->database();

        //dd($request->all());

        $v = validator::make($request->all(),[
            'name' => 'required|alpha|max:20',
            'hospitalName' => 'required|alpha|max:25',
            'hospitalUserId' => 'required',
            'hospitaluid' => 'required',
            'address' => 'required|alpha|max:100',
            'phone' =>  'required|digits:11|min:14',
            'plan' => 'required',
        ]);

        $hosRef = $database->collection('hospital_users');
        $hosData = $hosRef->documents();

        $hospital = array();
        foreach($hosData as $item){
            array_push($hospital,$item->data());
        }

        $flag = false;
        foreach($hospital as $key=>$item){
            if(isset($item['phone']) && $item['phone'] == $request->phone){
                $flag = true ;
                break;
            }
        }

        if($v->fails()){
            if($flag == true){
                Session::put('msg','phone number already exits.');
                return redirect()->back()->withErrors($v->errors())->with('msg','Contact number already exits.');
            }
            return redirect()->back()->withErrors($v->errors());
        }

        $info = $database->collection('hospitals')->newDocument();

        $data = [
            'uid' => $info->id(),
            'name' => $request->name,
            'hospitalUserid' => $info->id(),
            'hospitalName' => $request->hospitalName,
            'address' => $request->address,
            'plan' => $request->plan,
            'phone' => $request->phone
        ] ;

        $hos = $info->set($data);

        // $branch = $database->collection('hospitalBranch')->newDocument();

        /*
        $branchData = [
            'hospitalName' => $request->name,
            'hospitalUserId' => $request->hospitalUserId,
            'hospitaluid' => $info->id(),
            'branchuid' => $branch->id(),
            'branch' => $request->branchName,
            'address' => $request->address,
            'phone' => $request->phone
        ];
        */

        return view('hospital/index');
    }

    public function addBranchAction(Request $request){
        $firestore = app('firebase.firestore');
        $database = $firestore->database();
        $branchRef = $database->collection('hospitalBranch')->newDocument();

        $v = validator::make($request->all(),[
            'branch' => 'required',
            'address' => 'required'
        ]);

        // if($v->errors()){
        //     return redirect()->back()->with($v->errors());
        // }else{
            $hid = $request->hospitalUserId ;
            $data = [
                'hospitalName' => $request->hospitalName,
                'branch' => $request->branchName,
                'address' => $request->address,
                'hospitalUserId' =>  $request->hospitalUserId,
                'branchUid' => $branchRef->id()
            ];

            $branchRef->set($data);

            return  $this->branch($hid);

        // }

    }

    public function delBranch($id){
        $firestore = app('firebase.firestore');
        $database = $firestore->database();
        $branchRef = $database->collection('hospitalBranch')->document($id)->delete();
        return redirect('admin/hospital/branch/'.$id);
    }

    public function addDoctor($uid)
    {
        $firestore = app('firebase.firestore');
        $database = $firestore->database();
        $data['hosUid'] = $uid ;
        $data['districtlist'] = AdminController::district();
        //$data['hospitalInfo'] = AdminController::hospital();
        $data['hospitalInfo'] = $database->collection('hospital_users')->document($uid)->snapshot();
        //$data['branchInfo'] = AdminController::branchByUser();
        $branchInfo  = $database->collection('hospitalBranch')->where('hospitalUserId','=',$uid)->documents();
        $data['branchInfo'] = array();

        foreach ($branchInfo as $key => $value) {
            array_push($data['branchInfo'],$value->data());
        }

        return view('hospital/addDoctor')->with($data);
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


    public function addDoctorAction(Request $request)
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
          if(isset($item['phone']) && $item['phone'] == $request->phone){
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
            'firstname' => 'required|regex:/^[\p{L} ]+$/u|max:20',
            'lastname' => 'required|alpha|max:10',
            'dateOfBirth' => 'required',
            'gender' => 'required',
            'phone' =>  'required|digits:11',
            'email' =>  'required',
            'district' => 'required',
            'type' => 'required',
            'hospitalName' => 'required'
            //'registration' => 'required|min:5',

        ]);

        if($v->fails()){
            return redirect()->back()
                        ->withInput()
                        ->withErrors($v->errors());
        }

        if($flag == true && $emailFlag == true){
          return redirect()->back()->withInput();
        }elseif($flag == true && $emailFlag == false){
          return redirect()->back()->withInput();
        }elseif($flag == false && $emailFlag == true){
          return redirect()->back()->withInput();
        }

        $brId = $request->branchuid ;

        $branchRef = $database->collection('hospitalBranch');

        $hosRef = $database->collection('hospital_users');

        $brInfo = $branchRef->where('branchUid','=',$brId);

        $branchDoc = $brInfo->documents();

        $branch = array();

        foreach($branchDoc as $item){
            array_push($branch,$item->data());
        }

        if(empty($branch)){
            // $brInfo = $hosRef->where('hospitalUserId','=',$brId);
            //print_r($branch);
            //dd(1);

            $brInfo = $hosRef->where('hospitalUid','=',$brId);

            $branchDoc = $brInfo->documents();

            $branch = array();

            foreach($branchDoc as $item){
                array_push($branch,$item->data());
            }

            //$hosCode = strtoupper(substr($branch[0]['hospitalName'],0,2));

        }else{
            //$hosCode = strtoupper(substr($branch[0]['hospitalName'],0,2));
        }

        //dd($branch);

        // add bank-info to doctor
        $hospitalUser = Session::get('user');
        if(isset($hospitalUser[0]['hospitalUid'])) $id = $hospitalUser[0]['hospitalUid'];

        $hos = $database->collection('hospital_users')->document($id);
        $hosBankInfo = $hos->collection('bank_info')->document($id)->snapshot()->data();

        //dd($hosBankInfo);

        if($hosBankInfo == null ){
            Session::flash('bank_info-check','Please add your bank information.');
            return redirect()->back()->withInput();
        }
        //end

        $email = $request->email;
        $temp_pass = 'telocure'.mt_rand(10000,99999);

        $pass = $temp_pass ;
        // $method = "AES-128-CBC";
        // $key = 'SECUREOFTELOCURE';
        //   //$iv = openssl_random_pseudo_bytes(16);
        // $iv = "1234567812345678" ;
        // $password = openssl_encrypt($pass,$method,$key,0,$iv);

        $method = "AES-128-CBC";
        $key = 'SECRETOFTELOCURE';
        $iv = "1234567812345678" ;
        $password = openssl_encrypt($pass,$method,$key,0,$iv);

        $docRef = $database->collection('doctors')->newDocument();

        //$uid = $hosCode.''.$docRef->id();
        $uid = $docRef->id();
        $name = $request->firstname.' '.$request->lastname ;

        /*********test*****************/
        $doc_user = $database->collection('doctors')->document($docRef->id());
        /******end***************/

        if(isset($request['photoUrl'])){

            $fileName = $request['photoUrl']->getClientOriginalName();

            $request['photoUrl']->move(public_path('images/profilepic'), $fileName);
            $url = "https://telocure.com/api/download/".$fileName;
        }else{
            $url = '';
        }

        $data = [
            //'uid' => $hosCode.''.$docRef->id(),
            'uid' => $docRef->id(),
            'password' => '',
            //'hospitalUserId' => $request->hospitalUserId,
            'hospitalUid' => $request->hospitalUserId,
            'hospitalized' => true,
            'name' => $name,
            //'regNo' => $request->registration,
            //'hospitalName' => $branch[0]['hospitalName'],
            'phone' => $request->phone,
            'email' => $request->email,
            'district' => $request->district,
            'districtId' => '',
            'photoUrl' => $url,
            'online' => false,
            'active'=> false,
            'rejected' => false,
            //'role' => '',
            'password' => $password,
            'doctorType' => $request->type,
            'dateOfBirth' => $request->dateOfBirth,
            'createdAt' => new Timestamp(new DateTime()),
            'gender' => $request->gender,
            'price' => 0,
            'totalRating' => 0,
            'totalCount' => 0,
            'hospitalName' => $request->hospitalName
        ];

        $docRef->set($data);

        $doc_user->collection('balance')->document($docRef->id())->set([
            'balance' => 0,
            'updatedTime' => new Timestamp(new DateTime())
        ]);

        /*$doc_user->collection('documents')->document($docRef->id())->set([
            'did' => $docRef->id()
        ]);*/

        //dd($data['info']);

        if(isset($hosBankInfo['accountName'])) $acName = $hosBankInfo['accountName'];
        else $acName = "";

        if(isset($hosBankInfo['bankName'])) $bank = $hosBankInfo['bankName'];
        else $bank = "";

        if(isset($hosBankInfo['accountNumber'])) $acNo = $hosBankInfo['accountNumber'];
        else $acNo = "";

        if(isset($hosBankInfo['swiftCode'])) $scode = $hosBankInfo['swiftCode'];
        else $scode = "";

        $doc_user->collection('bank_info')->document($docRef->id())->set([
            'accountName' => $acName,
            'bankName' => $bank,
            'accountNumber' => $acNo,
            'swiftCode' => $scode,
        ]);

        $doc_user->collection('others')->document($docRef->id())->set([
            'branchId' => $request->branchuid, //Hospital Branch ID
            //'nid' => ""
        ]);

        // $dochRef = $database->collection('doctors');
        // $docInfo = $branchRef->where('email','=',$email);

        // $branchDoc = $brInfo->documents();

        $MailSend = new MailSendController();

        //$link = $uid.'/'.$email.'/'.$temp_pass ;
        //$link = 'ID :'.$uid.' \nLogin with'.$request->phone.' Your temporary password : '.$temp_pass;

        $link = [
            'name' => $name,
            'uid' => $uid,
            'phone' => $request->phone,
            'pass' => $temp_pass
        ];

        $val = $MailSend->sendDoc($link,$email); //email

        /*
            send through mobile
            --------------------------------
            */
            $msisdn = $request->phone;
            $messageBody = " Your temporary password : ".$temp_pass." \nVisit : https://telocure.com/login/doctor";
            $csmsId = uniqid(); // csms id must be unique

            /********temporary commented will comment out for client****************/
            echo $this->singleSms($msisdn, $messageBody, $csmsId);
            /********end*********/

        return redirect('/hospital');
    }

    public function hosRev($hosId){
        $firestore = app('firebase.firestore');
        $database = $firestore->database();
        $visits = $database->collection('visits')->documents();

        $revInfo = array() ;
        foreach($visits as $item){
            array_push($revInfo,$item->data());
        }

        foreach($revInfo as $item){
            if(isset($item['doctor']['hospitalUid'])){
                $hospitalId = $item['doctor']['hospitalUid'] ;
                $tansactionInfo = $item['transactionHistory'];
            }
        }

        dd($revInfo);
    }

    public function linkForDoctor(Request $request, $uid,$email,$otp){

        $firestore = app('firebase.firestore');
        $database = $firestore->database();
        $userRef = $database->collection('doctors');

        $uid = $uid;
        $email = $email;
        $password = $otp;

        $query = $userRef->where('email','=',$email)
                ->where('password','=',$password);

        $userInfo = $query->documents();

        $userArr = array();

        foreach ($userInfo as $user) {
            if($user->exists()){
                array_push($userArr, $user->data());
            }
        }

        if(!empty($userArr)){
            $districtRef = $database->collection('districts');

            $data['district'] = $districtRef->documents();
            $data['districtList'] = array();

            foreach($data['district'] as $key=>$item){
                array_push($data['districtList'],$item->data());
            }

            $request->session()->put('user',$userArr);
            $request->session()->put('district',$data['districtList']);

            //Edit from mafiz vai
            $MailSend = new MailSendController();
            $otp = mt_rand(10000,99999);
            $val = $MailSend->sendOtp($otp,$email);

            $helodoc2fa = array(
                'title'	=> 'doctor',
                'opt'	=> $otp,
                'status'=> false
            );

            $request->session()->put('helodoc2fa', $helodoc2fa);

            if ($val){
                return redirect('/2fa')->with($helodoc2fa);
            }
        }else{
        }
    }

    public function link($uid,$email,$otp){
        $firestore = app('firebase.firestore');
        $database = $firestore->database();
        $userRef = $database->collection('hospital_users');

        $hospital_user = $userRef->document($uid);
        $userinfo = $hospital_user->snapshot();

        $uid = $uid;
        $email = $email;
        $password = $otp;

        // $query = $userRef->where('phone','=',$email);

        $hospital_user->update([
            ['path' => 'password', 'value' => $password]
        ]);

        $data['data'] = [
            'uid' => $uid,
            'email' => $email,
            'password' => $otp
        ];

        return view('admin/hospital/newPass')->with($data);

    }

    public function deletehos($id)
    {
        $firestore = app('firebase.firestore');
        $database = $firestore->database();
        $info = $database->collection('hospitals')->document($id)->delete();
        return true ;
    }

    public function deleteDoctor($uid){
        //dd($uid);
        $firestore = app('firebase.firestore');
        $database = $firestore->database();

        /*if($hUid != ''){
            $hospitalUid = substr($uid, 2);
            $docRef = $doctorRef
                ->document($hospitalUid);
        }else{
            $docRef = $doctorRef
                ->document($uid);
        }*/

        //$uid = substr($uid, 2);
        //dd($uid);
        $info = $database->collection('doctors')->document($uid)->delete();

        return redirect()->back()->with('success','Doctor deleted successfully');
    }

    public function totalRevenue($uid){
        //dd($uid);
        $firestore = app('firebase.firestore');
        $database = $firestore->database();
        $visits = $database->collection('visits')->documents();

        $revInfo = array() ;
        foreach($visits as $item){
            array_push($revInfo,$item->data());
        }

        $subTotal = 0;
        $data['rev'] = array();
        $array = array();

        foreach($revInfo as $item){
            if(isset($item['doctor']['hospitalUid'])){
                $hospitalId = $item['doctor']['hospitalUid'] ;
                
                if($hospitalId != null && $hospitalId == $uid){

                    // echo '<pre>';
                    // print_r($hospitalId);


                    if(isset($item['transactionHistory'])){

                        $subTotal += $item['transactionHistory']['subTotalRounded'];
                        $val = $item['transactionHistory']['subTotalRounded'];
                        $key = $item['transactionHistory']['createdDate']->get()->format('d-m-Y');
                        $array = [
                            'id' =>  $item['doctor']['hospitalUid'],
                            'date' => $key,
                            'amount' => $val
                        ];
                        array_push($data['rev'] , $array);
                        // array_push($created_date,$item['transactionHistory']['subTotalRounded']);
                        // array_push($amount,$item['transactionHistory']['createdDate']->get()->format('d-m-Y'));
                    }
                }

                //new 05-07-2020
                else{
                	// $subTotal = 0;
                	//$val = 0;
                	//$key = 0;
                }
                
                //array_push($data['rev'] , $array);
                //end

            }
        }

        // dd(1);

        $data['total'] =  $subTotal;

        //dd($data);

        return $data ;

    }

    public function viewDoctor($id)
    {
      $firestore = app('firebase.firestore');
      $db = $firestore->database();
      //$uid = substr($id, 2);
      $uid = $id ;
      $docRef = $db->collection('doctors')->document($uid);
      $data['doctorProfile'] = $docRef->snapshot()->data();
      $data['documents'] = $docRef->collection('documents')->document($uid)->snapshot()->data();
      $data['bank_info'] = $docRef->collection('bank_info')->document($uid)->snapshot()->data();
      $data['others'] = $docRef->collection('others')->document($uid)->snapshot()->data();

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

      //dd($data['hinfo']);

      return view('hospital.doctorProfile')->with($data);
    }

    public function portalHelp(){
        return view('hospital/help');
    }

    // Hospital Bank information feature

    public function bank_info(){

        $firestore = app('firebase.firestore');
        $database = $firestore->database();

        $hospitalUser = Session::get('user');
        if(isset($hospitalUser[0]['hospitalUid'])) $id = $hospitalUser[0]['hospitalUid'];

        $hos = $database->collection('hospital_users')->document($id);
        $data['info'] = $hos->collection('bank_info')->document($id)->snapshot()->data();
        $data['attr'] = "disabled";

        if($data['info'] != null ){
            return view('hospital/bank_info')->with($data);
        }else{
            return view('hospital/bank_info');
        }

    }


    public function addBank_infoAction(Request $request){

        $firestore = app('firebase.firestore');
        $database = $firestore->database();

        $hospitalUser = Session::get('user');

        if(isset($hospitalUser[0]['hospitalUid'])) $id = $hospitalUser[0]['hospitalUid'];

        $info = $database->collection('hospital_users');

        $v = validator::make($request->all(),[
            'accountName' => 'required',
            'bankName' => 'required',
            'accountNumber' => 'required'
        ]);

        if($v->fails()){
            return redirect()->back()
                        ->withInput()
                        ->withErrors($v->errors());
        }

        $data['info'] = $info->document($id)->collection('bank_info')->document($id)
            ->snapshot()->data();

        /**************Temporary commented*********************/
        /*
        if($data['info'] != null ){
            Session::flash('add-bank-info-warn','You are not allowed to add multiple account.');
        }else{
            $info->document($id)->collection('bank_info')->document($id)->set([
                'accountName' => $request->accountName,
                'bankName' => $request->bankName,
                'accountNumber' => $request->accountNumber,
                'swiftCode' => $request->swiftCode,
            ],['merge' => true]);
            Session::flash('add-bank-info','Bank information added.');
        }
        */
        /*****************End*************************************/
        $email = $hospitalUser[0]['email'];

        $adminInfo = $database->collection('admin')
            ->document('super')->snapshot()->data();

        $receiver = $adminInfo['email'];

        if($request->edit == 'edit' ){
            $data = [
                'name' => $hospitalUser[0]['hospitalName'],
                'accountName' => $request->accountName,
                'bankName' => $request->bankName,
                'accountNumber' => $request->accountNumber,
                'swiftCode' => $request->swiftCode
            ];

            $MailSend = new MailSendController();
            $MailSend->sendRequest($data,$email,$receiver);

            $updateBankFlag = $info->document($id);

            $updateBankFlag->update([
                ['path' => 'bankInfoUpdateRequest', 'value' => true ]
            ]);

            Session::flash('add-bank-info','Request sent successfully.');
        }else{
            $info->document($id)->collection('bank_info')->document($id)->set([
                'accountName' => $request->accountName,
                'bankName' => $request->bankName,
                'accountNumber' => $request->accountNumber,
                'swiftCode' => $request->swiftCode,
            ],['merge' => true]);

            Session::flash('add-bank-info','Bank information added.');
        }

        return redirect()->back();

    }

    //new revenue code
    public function revenueById($id){

        $firestore = app('firebase.firestore');
        $database = $firestore->database();

        $visits = $database->collection('visits');
        //$query = $visits->where('doctorUid','=',$id);
        $visitDataArr = $visits->documents();

        $visitArr = array();
        foreach($visitDataArr as $item){
            array_push($visitArr,$item->data());
        }

        $visitData = array();
        foreach($visitArr as $item){
            if($item['doctor']['hospitalUid'] == $id){
                array_push($visitData,$item);
            }
            /*else{
                $null = 'null';
                array_push($visitData,$null);
            }*/
        }

        //echo '<pre>';
        $test['date'] = array();
        $test['rev'] = array();
        $data['trans'] = array();
        $test['doctorUid'] = array();
        $data['doctorName'] = array();
        $data['doctorPhone'] = array();
        $data['call'] = array();
        $data['total'] = array();
        $data['summary'] = array();
        $totalRev = 0;

        foreach($visitData as $val){
            if($val != null){
                $totalRev = $totalRev + $val['transactionHistory']['subTotalRounded'];
                array_push($test['date'],$val['callStartTime']->get()->format('Y-m-d'));
                array_push($test['rev'],$val['transactionHistory']['subTotalRounded']);
                // array_push($data['doctorName'],$val['doctor']['name']);
                // array_push($data['doctorPhone'],$val['doctor']['phone']);
                array_push($test['doctorUid'],$val['doctorUid']);
            }
        }

        $visitDoc = array_count_values($test['doctorUid']);

        // print_r($data['doctorUid'][0]);
        // dd(1);
        $docKey = array_keys($visitDoc);

        $call = 0;
        $total = 0 ;
        /*
        foreach($visitData as $val){
            if($val != null){
                for($i = 0;$i < count($docKey); $i++){
                    if($docKey[$i] == $val['doctorUid']){
                        $call += 1 ;
                        $total = $total + $val['transactionHistory']['subTotalRounded'];
                        array_push($data['call'],$call);
                		array_push($data['total'],$total);
                    }else{
                        $call = 0;
                        $total = 0;
                    }
                }
                array_push($data['doctorUid'],$val['doctorUid']);
                array_push($data['doctorName'],$val['doctor']['name']);
                array_push($data['doctorPhone'],$val['doctor']['phone']);

            }

        }*/


        /********************************new***************************************************/

        $docArr = array();
        $test['doctorName'] = array();
        $test['doctorPhone'] = array();
        $test['total'] = array();
        $test['call'] = array();
        $test['info'] = array();

        // echo '<pre>';

        foreach($visitDoc as $key => $value){

            $query = $visits->where('doctorUid','=',$key);
            $docData = $query->documents();

            foreach($docData as $data){
                array_push($docArr,$data->data());
            }
            
            $i = 0; $val = 0; $count = 0;

            foreach($docArr as $data1){

                // print_r($data1);

                if($key == $data1['doctorUid']){
                    $val = $val + $data1['transactionHistory']['subTotalRounded'];
                    $count ++ ;
                    $doctorName = $data1['doctor']['name'];
                    $doctorPhone = $data1['doctor']['phone'];
                }else{
                    $val = 0 ;
                    $count = 0;
                }
            }

            array_push($test['doctorName'],$doctorName);
            array_push($test['doctorPhone'],$doctorPhone);
            // array_push($test['dinfo']['doctorUid'],$key);
            array_push($test['total'],$val); // total income of each doctor
            array_push($test['call'],$count);
        }

        // array_push($data['call'],$call);
        // array_push($data['total'],$total);
        //$docCounter = count(array_count_values($data['doctorUid']));
        
        $test['summary'] = array();

        for($i = 0; $i < count($visitDoc); $i++){
            $arr1 = array(
                'doctor' => $test['doctorName'][$i],
                'phone' => $test['doctorPhone'][$i],
                // 'revenue' => $data['total'][$i],
                // 'calls' => $data['call'][$i],
                'revenue' => $test['total'][$i],
                'calls' => $test['call'][$i],
            );
            array_push($test['summary'],$arr1);
        }

        $counter = count($test['doctorUid']);

        //dd($counter);

        $test['info'] = array();
        $arr = array();

        for($i = 0; $i < $counter; $i++){
            $arr = array(
                'id' => $id,
                'date' => $test['date'][$i],
                //'doctor' => $test['doctorName'][$i],
                //'phone' => $test['doctorPhone'][$i],
                'revenue' => $test['rev'][$i],
                'totalRev' => $totalRev,
                'calls' => $counter
            );
            array_push($test['info'],$arr);
        }

        /*echo json_encode($data['info']);

        dd(1);

        $counter = count($data['visited']);
        $data['revenueByDate'] = array();
        $data['revenueKey'] = array();
        $data['revenueVal'] = array();
        $data['rev'] = array();

        $sortingDate = array('date');
        $sortingValue = array('value');

        for($i = 0; $i < $counter; $i++){
            if(isset($data['visited'][$i]['transactionHistory'])){
                $rVal = $data['visited'][$i]['transactionHistory']['subTotalRounded'];
                $rKey = $data['visited'][$i]['transactionHistory']['createdDate']->get()->format('Y-m-d');

                $sresult=array_search($rKey,$sortingDate);
                if($sresult == null){
                    array_push($sortingDate,$rKey);
                    array_push($sortingValue,$rVal);
                }else{
                    $total=$sortingValue[$sresult]+$rVal;
                    $replacements = array($sresult => $total);
                    $sortingValue=array_replace($sortingValue, $replacements);
                }
            }
        }

        $counter1 = count($sortingDate);
        for($i = 1; $i < $counter1; $i++){
            $data['revenueByDate'] = array('id' => $id ,'title' => $sortingValue[$i].'Tk','start' => $sortingDate[$i],'end' => '');
            array_push($data['rev'] , $data['revenueByDate']);
        }

        */
        return $test;
        //return view('hospital/hospitalrev')->with($data);

    }

    public function revForHospital(){

        $data['hospitalUser'] = array();
        $data['hospitalUser'] = Session::get('user');
        $id = $data['hospitalUser'][0]['hospitalUid'];

        $data = $this->revenueById($id);

        //dd($data);

        return view('hospital/hospitalrev')->with($data);
    }

    public function revByDate(Request $request){
        $data['hospitalUser'] = array();
        $data['hospitalUser'] = Session::get('user');
        $id = $data['hospitalUser'][0]['hospitalUid'];
        $date = $request->date ;
        $data = $this->revenueById($id);
        //$counter = sizeof($data['info']);
        $res = array();
        $result = array();
        $rev = 0 ;
        foreach($data['info'] as $val){
            if($val['date'] == $date){
                $rev = $rev + $val['revenue'] ;
            }
            $res = array(
                    'date' => $date,
                    'rev' => $rev
            );
        }

        array_push($result,$res);
        return $result;
    }
    //end

    //Revenue By Month
    public function revByMonth($date){
        $data['hospitalUser'] = array();
        $data['hospitalUser'] = Session::get('user');
        $id = $data['hospitalUser'][0]['hospitalUid'];
        //$date = $request->date ;
        $data = $this->revenueById($id);
        //$counter = sizeof($data['info']);
        $res = array();
        $result = array();
        $rev = 0 ;


        $yrdata= strtotime($date);

        $month = date('Y-m', $yrdata);

        foreach($data['info'] as $val){
            $curmonth = strtotime($val['date']);
            $curmonth1 = date('Y-m', $curmonth);

            if($curmonth1 == $month){
                $rev = $rev + $val['revenue'] ;
            }
            $res = array(
                'date' => $date,
                'rev' => $rev
            );
        }

        array_push($result,$res);
        return $result;
    }

    //revenue by year
    public function revByYear($year){
        $data['hospitalUser'] = array();
        $data['hospitalUser'] = Session::get('user');
        $id = $data['hospitalUser'][0]['hospitalUid'];
        //$date = $request->date ;
        $data = $this->revenueById($id);
        //$counter = sizeof($data['info']);
        $res = array();
        $result = array();
        $rev = 0 ;

        foreach($data['info'] as $val){
            $curmonth = strtotime($val['date']);
            $curmonth1 = date('Y', $curmonth);
            if($curmonth1 == $year){
                $rev = $rev + $val['revenue'] ;
            }else{
                $rev = 0;
            }
            $res = array(
                'date' => $year,
                'rev' => $rev
            );
        }

        array_push($result,$res);
        return $result;
    }



}
