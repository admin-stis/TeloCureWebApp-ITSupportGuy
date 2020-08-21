<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class DoctorController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {

        $firestore = app('firebase.firestore');
        $db = $firestore->database();

        $doctorData = Session::get('user');

        if($doctorData != null){

            /*
            if( isset($doctorData[0]['hospitalized']) && $doctorData[0]['hospitalized'] == true){
                $uid = substr($doctorData[0]['uid'],2);
            }else{
                $uid = $doctorData[0]['uid'];
            }
            */

            $uid = $doctorData[0]['uid'];

            $data['doctorInfo'] = $db->collection('doctors')->document($uid)->snapshot();
            $data['bank_info'] = $db->collection('doctors')->document($uid)->collection('bank_info')->document($uid)->snapshot();
            $data['others'] = $db->collection('doctors')->document($uid)->collection('others')->document($uid)->snapshot();
            $data['regNoInfo'] = $db->collection('doctors')->document($uid)->snapshot();

            $data['nid'] = $db->collection('doctors')->document($uid)->collection('others')->document($uid)->snapshot()->data();
            // if(empty($data['nid']))dd($data['nid']);
            // else dd(1);
            if($data['nid'] == null){
                return $this->completeProfile();
            }
            //new
            $visits = $db->collection('visits');
            $query = $visits->where('doctorUid','=',$uid);
            $visitData = $query->documents();

            $data['visited'] = array();

            foreach($visitData as $key => $value){
                array_push($data['visited'],$value->data());
            }

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
            $data['tRev'] = array();
            $totalAmountRev = 0 ;

            for($i = 1; $i < $counter1; $i++){
                $totalAmountRev += $sortingValue[$i];

                $data['revenueByDate'] = array('id' => $uid ,'title' => $sortingValue[$i].'Tk','start' => $sortingDate[$i],'end' => '');
                array_push($data['rev'] , $data['revenueByDate']);
            }

            array_push($data['tRev'],$totalAmountRev);

            $docArr = $data['doctorInfo']->data();

            $docArrInfo = $data['regNoInfo']->data();

            if(isset($docArrInfo['regNo'])){
                if($docArrInfo['regNo'] != null){
                	if($docArrInfo['hospitalized'] == false){
	                    return view('doctor.index')->with($data);
	                }else{
	                	return $this->fares($uid); // Because dashboard will not visible for hospital doctor
	                }
                }else{
                    return $this->completeProfile();
                }
            }else{
                return $this->completeProfile();
            }
        }else{
            return redirect('login/doctor');
        }
    }

    public function completeProfile()
    {

        $firestore = app('firebase.firestore');
        $db = $firestore->database();

        $doctorData = Session::get('user');

        if($doctorData != null){

            /*
            if( isset($doctorData[0]['hospitalized']) && $doctorData[0]['hospitalized'] == true){
                $id = substr($doctorData[0]['uid'],2);
            }else{
                $id = $doctorData[0]['uid'];
            }
            */
            $id = $doctorData[0]['uid'];
        }

        $docRef = $db->collection('doctors')->document($id);
        $bank_info = $docRef->collection('bank_info')->document($id)->snapshot()->data();

        if($bank_info != null){
        	return view('doctor.complete-profile')->with(['bank_info' => $bank_info]);
        }else{
        	return view('doctor.complete-profile');
        }
    }

    public function updateProfile($uid)
    {
        $firestore = app('firebase.firestore');
        $db = $firestore->database();

        //new code for hospital doctor
        /*if( $doctorData[0]['hospitalized'] == true){
            $uid = substr($doctorData[0]['uid'],2);
        }else{
            $uid = $doctorData[0]['uid'];
        }*/
        //end

        $docRef = $db->collection('doctors')
            ->where('uid','=',$uid)
            ->documents();

        $data['doctorProfile'] = array();

        foreach($docRef as $val){
            array_push($data['doctorProfile'],$val->data());
        }

        $data['districtlist'] = AdminController::district();

        return view('doctor.editProfile')->with($data);
    }

    public function profile(Request $r,$id)
    {
        $firestore = app('firebase.firestore');
        $db = $firestore->database();

        $sessData = session()->all();

        /******************************New Code used hospital doctor id**************/
        /*$doctorData = Session::get('user');
        if( isset($doctorData[0]['hospitalized']) && $doctorData[0]['hospitalized'] == true){
            $id = substr($doctorData[0]['uid'],2);
        }else{
            $id = $id;
        }*/
        /*******************end******************************/
        //dd($doctorData);


        if(isset($sessData['user'])){
            $docRef = $db->collection('doctors')->document($id);
            $data['others'] = $docRef->collection('others')->document($id)->snapshot()->data();
            $data['bank_info'] = $docRef->collection('bank_info')->document($id)->snapshot()->data();
            $data['documents'] = $docRef->collection('documents')->document($id)->snapshot()->data();
            $data['doctorProfile'] = $docRef->snapshot()->data();

            $data['nid'] = $db->collection('doctors')->document($id)->collection('others')->document($id)->snapshot()->data();
            // if(empty($data['nid']))dd($data['nid']);
            // else dd(1);
            if($data['nid'] == null){
                return $this->completeProfile();
            }

            //dd($data['others']);

            //for hospital doctor
            $hospitalBranchId = $data['others']['branchId'];
            $hospital = $db->collection('hospitalBranch');

            if($hospitalBranchId != ""){

                $data['hospitalDetails'] = $hospital->document($hospitalBranchId)->snapshot()->data() ;

                if($data['hospitalDetails'] != null){
                    $data['hinfo'] = $data['hospitalDetails'];
                }
                else{
                    $hospital = $db->collection('hospital_users');
                    $data['hinfo'] = $hospital->document($hospitalBranchId)->snapshot()->data() ;
                }
            }

            // print_r("expression");
            // dd($data['bank_info']);



            if(isset($data['doctorProfile']['regNo'])){
                if($data['doctorProfile']['regNo'] != null){
                    return view('doctor.profile')->with($data);
                }else{
                    //dd($data['bank_info']);
                    if(isset($data['bank_info']) && $data['bank_info'] != null){
                        return view('doctor.complete-profile')->with($data);
                    }else{
                        return view('doctor.complete-profile');
                    }
                }
            }else{
                if(isset($data['bank_info']) && $data['bank_info'] != null){
                        return view('doctor.complete-profile')->with($data);
                    }else{
                        return view('doctor.complete-profile');
                    }
            }
        }else{
            return redirect('login/doctor');
        }

    }

    //new revenue code
    public function revenueById($id){

        $firestore = app('firebase.firestore');
        $database = $firestore->database();

        $visits = $database->collection('visits');
        $query = $visits->where('doctorUid','=',$id);
        $visitData = $visits->documents();

        $data['visited'] = array();

        foreach($visitData as $key => $value){
            array_push($data['visited'],$value->data());
        }

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


        return $data['rev'];

    }
    //end

    public function fares($id){

        $firestore = app('firebase.firestore');
        $database = $firestore->database();

        $visits = $database->collection('visits');

        $id = $id;

        $data['nid'] = $database->collection('doctors')->document($id)->collection('others')->document($id)->snapshot()->data();
            // if(empty($data['nid']))dd($data['nid']);
            // else dd(1);
            if($data['nid'] == null){
                return $this->completeProfile();
            }

        $query = $visits->where('doctorUid','=',$id);
        $visitData = $query->documents();

        $data['fares'] = array();

        foreach($visitData as $val){
            array_push($data['fares'],$val->data());
        }


        /********11/07/202*********/
        // echo '<pre>';
        // $data['prescriptionDetails'] = array();
        // foreach ($data['fares'] as $key => $value) {
        //     print_r($value['prescriptionId']);
        // }
        //dd(1); 
        /**************************/



        $data['doctor'] = $database->collection('doctors')->document($id)->snapshot();

        $data['others'] = $database->collection('doctors')->document($id)
            ->collection('others')->document($id)->snapshot()->data();

        $docRef = $database->collection('doctors')->document($id);
        $data['bank_info'] = $docRef->collection('bank_info')->document($id)->snapshot()->data();

        $doctorArr = $data['doctor']->data();

        if(isset($data['doctor']['regNo'])){
            if($data['doctor']['regNo'] != null){
                return view('doctor.fares')->with($data);
            }else{
                //return view('doctor.complete-profile');
                if(isset($data['bank_info']) && $data['bank_info'] != null){
                        return view('doctor.complete-profile')->with($data);
                    }else{
                        return view('doctor.complete-profile');
                    }
            }
        }else{
            if(isset($data['bank_info']) && $data['bank_info'] != null){
                        return view('doctor.complete-profile')->with($data);
                    }else{
                        return view('doctor.complete-profile');
                    }
        }
    }

    public function edit($id)
    {
        $firestore = app('firebase.firestore');
        $db = $firestore->database();

        /******************************New Code used hospital doctor id**************/
        /*
        $doctorData = Session::get('user');
        if( isset($doctorData[0]['hospitalized']) && $doctorData[0]['hospitalized'] == true){
            $id = substr($doctorData[0]['uid'],2);
        }else{
            $id = $id;
        }
        */
        /*******************end******************************/

        $docRef = $db->collection('doctors')->document($id);
        $data['bank_info'] = $docRef->collection('bank_info')->document($id)->snapshot()->data();
        $data['documents'] = $docRef->collection('documents')->document($id)->snapshot()->data();
        $data['others'] = $docRef->collection('others')->document($id)->snapshot()->data();
        $data['doctorProfile'] = $docRef->snapshot()->data();

        return view('doctor.update-profile')->with($data);
    }

    public function editAction(Request $request){
        
        //{{-- mridul addition 11-7-20 --}}
        $validator = Validator::make($request->all(), [
            'degreeCertificate' => 'required|image',
            'photoUrl' => 'required|image',
            'prescriptionForm' => 'required|image'
        ]);
        
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {            
        

        $firestore = app('firebase.firestore');
        $db = $firestore->database();
        $doctorRef = $db->collection('doctors');

        $uid = $request->uid ;

        $doctorData = Session::get('user');

        if(isset($request['photoUrl'])){

            $fileName = $request['photoUrl']->getClientOriginalName();

            $fileName = $uid.''.$fileName;
            $request['photoUrl']->move(public_path('images/profilepic'), $fileName);
            $url = "http://telocure.com/api/download/".$fileName;
        }else{
            $url = $request->old_photoUrl;
        }

        if(isset($request['degreeCertificate'])){

            $fileName = $request['degreeCertificate']->getClientOriginalName();

            $fileName = $uid.''.$fileName;
            $request['degreeCertificate']->move(public_path('images/profilepic'), $fileName);
            $durl = "http://telocure.com/api/download/".$fileName;
        }else{
            $durl = $request->old_degreeCertificate;
        }

        if(isset($request['prescriptionForm'])){

            $fileName = $request['prescriptionForm']->getClientOriginalName();

            $fileName = $uid.''.$fileName;
            $request['prescriptionForm']->move(public_path('images/profilepic'), $fileName);
            $purl = "http://telocure.com/api/download/".$fileName;
        }else{
            //$purl = $request->old_prescriptionForm;
            $purl = '';
        }

        if($request->dateOfBirth == '')
            $dob = $request->old_dateOfBirth;
        else $dob = $request->dateOfBirth;

        $docRef = $db->collection('doctors')->document($uid);

        $basicInfo = [
            'dateOfBirth' => $dob,
            'gender' => $request->gender,
            'name' => $request->name,
            'regNo' => $request->regNo,
            'email' => $request->email,
            'phone' => $request->phone,
            'district' => $request->district,
            'doctorType' => $request->doctorType,
        ];

        $docInfo = [
            'acadeimcDegree' => $durl,
            'prescriptionForm' => $purl,
            // 'photoUrl' => $url,
        ];

        $bankInfo = [
            'accountName' =>  $request->accountName,
            'bankName' =>  $request->bankName,
            'accountNumber' => $request->accountNo,
            'swiftCode' =>  $request->swiftCode,

        ];

        $hosbranch = $docRef->collection('others')->document($uid)->snapshot()->data();

        if(!isset($hosbranch['branchId'])){

            $others = [
                'nid' => $request->nid,
                'presentAddress' => $request->presentAddress,
                'acadeimcDegree' => $request->acadeimcDegree,
                'otherDegree' => $request->otherDegree,
                'branchId' => null
            ];

        }else{

            $others = [
                'nid' => $request->nid,
                'presentAddress' => $request->presentAddress,
                'acadeimcDegree' => $request->acadeimcDegree,
                'otherDegree' => $request->otherDegree,
                'branchId' => $hosbranch['branchId']
            ];

        }

        $db->collection('doctors')->document($uid)->set($basicInfo,['merge' => 'true']);
        $docRef->collection('bank_info')->document($uid)->set($bankInfo,['merge' => 'true']);
        $docRef->collection('documents')->document($uid)->set($docInfo,['merge' => 'true']);
        $docRef->collection('others')->document($uid)->set($others,['merge' => 'true']);

        Session::flash('update_msg','Profile Updated.');
        return redirect()->back();
        
        }

    }

    public function video()
    {
        return view('doctor/video');
    }

    public function portalHelp()
    {
        return view('doctor/help');
    }

    public function prescription($uId,$dId,$pId)
    {
        $firestore = app('firebase.firestore');
        $db = $firestore->database();

        $presRef = $db->collection('prescription');
        $data['presDoc'] = $presRef->document($uId)->collection($dId)->document($pId)->snapshot()->data();

        return view('doctor/prescription')->with($data);
    }

}











