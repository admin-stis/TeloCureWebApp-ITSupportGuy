<?php

namespace App\Http\Controllers\Hospital;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\MailSendController;
use Illuminate\Support\Facades\Session;

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
        $uid = $data['hospitalUser'][0]['uid'];
        $hospital_user = $info->document($uid);
        $userinfo = $hospital_user->snapshot();

        if($userinfo['login_attempt'] == false){

            $hospital_user->update([
                ['path' => 'login_attempt', 'value' => true]
            ]);
            return view('frontend/new_pass')->with($data) ;
        }else{
            return view('hospital.index')->with($data);
        }
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

    public function addHospital($id)
    {
        $data['uid'] = $id;
        return view('hospital/addHospital')->with($data);
    }

    public function addHospitalAction(Request $request)
    {
        $firestore = app('firebase.firestore');
        $database = $firestore->database();
        $info = $database->collection('hospitals')->newDocument();

        $data = [
            'uid' => $info->id(),
            'name' => $request->name
        ] ;

        $hos = $info->set($data);

        $branch = $database->collection('hospitalBranch')->newDocument();


        $branchData = [
            'hospitalName' => $request->name,
            'hospitalUserId' => $request->hospitalUserId,
            'hospitaluid' => $info->id(),
            'branchuid' => $branch->id(),
            'branch' => $request->branchName,
            'address' => $request->address,
            'phone' => $request->phone
        ];

        $branch->set($branchData);

        return view('hospital/index');
    }

    public function addDoctor($uid)
    {
        $data['hosUid'] = $uid ;
        $data['districtlist'] = AdminController::district();
        $data['hospitalInfo'] = AdminController::hospital();
        $data['branchInfo'] = AdminController::branchByUser();
        return view('hospital/addDoctor')->with($data);
    }

    public function addDoctorAction(Request $request)
    {
        //dd($request->all());
        $firestore = app('firebase.firestore');
        $database = $firestore->database();

        $brId = $request->branchuid ;

        $branchRef = $database->collection('hospitalBranch');

        $brInfo = $branchRef->where('branchuid','=',$brId);
        $branchDoc = $brInfo->documents();

        $branch = array();

        foreach($branchDoc as $item){
            array_push($branch,$item->data());
        }

        $hosCode = strtoupper(substr($branch[0]['hospitalName'],0,2));
        $email = $request->email;
        $temp_pass = mt_rand(10000,99999);

        $docRef = $database->collection('doctors')->newDocument();
        $uid = $hosCode.''.$docRef->id();

        $data = [
            'uid' => $hosCode.''.$docRef->id(),
            'password' => '',
            'hospitalUserId' => $request->hospitalUserId,
            'branchId' => $request->branchuid,
            'name' => $request->name,
            'hospitalName' => $branch[0]['hospitalName'],
            'lastname' => $request->lastname,
            'phone' => $request->phone,
            'email' => $request->email,
            'district' => $request->district,
            'approve' => '',
            'online' => '',
            'active'=> '',
            'role' => '',
            'password' => $temp_pass
        ];

        $docRef->set($data);

        // $dochRef = $database->collection('doctors');
        // $docInfo = $branchRef->where('email','=',$email);

        $branchDoc = $brInfo->documents();

        $MailSend = new MailSendController();

        $link = $uid.'/'.$email.'/'.$temp_pass ;
        $val = $MailSend->sendlink($link,$email);
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

    public function deletehos($id)
    {
        $firestore = app('firebase.firestore');
        $database = $firestore->database();
        $info = $database->collection('hospitals')->document($id)->delete();
        return true ;
    }
}
