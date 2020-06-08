<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {

        $firestore = app('firebase.firestore');
        $database = $firestore->database();
        $docRefe = $database->collection('doctors');
        $patientRefe = $database->collection('users');
        $hosRefe = $database->collection('hospital_users');

        $doctors = $docRefe->documents();
        $patients = $patientRefe->documents();
        $hosUser = $hosRefe->documents();

        $doctor_count = 0;
        foreach ($doctors as $key => $value) {
            $doctor_count++;
        }

        $patient = $patientRefe->documents();
        $patient_count=0;
        foreach ($patients as $key => $value) {
            $patient_count++;
        }

        $data['totalPatient'] = $patient_count;
        // $doctorsRef = $database->collection('doctors');
        $query = $docRefe->where('active','=',true);
        $active_doctors = $query->documents();
        $number_of_active_doctor = 0;
        foreach ($active_doctors as $key => $value) {
            $number_of_active_doctor++;
        }

        $data['activeDoctor'] = $number_of_active_doctor;

        $visits = $database->collection('visits');
        $visitData = $visits->documents();
        $data['visited'] = array();

        foreach($visitData as $key => $value){
            array_push($data['visited'],$value->data());
        }

        // hospital add
        $data['userList'] = array();
        $data['totalHospitalUser'] = array();
        $totalUser = $hosRefe->documents();

        $total = 0;
        foreach($totalUser as $item)
        {
            $total++;
            array_push($data['userList'],$item->data());
        }
        $data['totalHospitalUser'] = $total;

        // end

        $counter = count($data['visited']);
        $total = 0;

        $data['totalRevenue'] = array();

        for($i = 0; $i < $counter; $i++){
            if(isset($data['visited'][$i]['transactionHistory'])){
                $total += $data['visited'][$i]['transactionHistory']['subTotalRounded'];

            }
        }

        array_push($data['totalRevenue'],$total);

        $data['revenueByDate'] = array();
        $data['revenueKey'] = array();
        $data['revenueVal'] = array();
        $data['rev'] = array();

        for($i = 0; $i < $counter; $i++){
            if(isset($data['visited'][$i]['transactionHistory'])){
                $rVal = $data['visited'][$i]['transactionHistory']['subTotalRounded'];
                $rKey = $data['visited'][$i]['transactionHistory']['createdDate']->get()->format('d-m-Y');
                $data['revenueByDate'] = array($rKey => $rVal);
                array_push($data['rev'] , $data['revenueByDate']);
            }
        }
        return view('admin.index')->with($data);
    }

    /*public function revenue(){
        $firestore = app('firebase.firestore');
        $database = $firestore->database();
        $visits = $database->collection('visits');
        $visitData = $visits->documents();
        $data['visited'] = array();

        foreach($visitData as $key => $value){
            array_push($data['visited'],$value->data());
        }

        $counter = count($data['visited']);
        $data['revenueByDate'] = array();
        $data['revenueKey'] = array();
        $data['revenueVal'] = array();
        // $data['rev'] = array();
        $rev = array();

        for($i = 0; $i < $counter; $i++){
            if(isset($data['visited'][$i]['transactionHistory'])){
                $rVal = $data['visited'][$i]['transactionHistory']['subTotalRounded'];
                $rKey = $data['visited'][$i]['transactionHistory']['createdDate']->get()->format('d-m-Y');
                $data['revenueByDate'] = array('date' => $rKey,'val' => $rVal);
                //array_push($data['rev'] , $data['revenueByDate']);
                array_push($rev , $data['revenueByDate']);

            }
        }

        // return $data['rev'];
        return $rev;

    }*/

    /*public function revenue(){
        $firestore = app('firebase.firestore');
        $database = $firestore->database();
        $visits = $database->collection('visits');
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

        $sortingDate = array();
        $sortingValue = array();

        for($i = 0; $i < $counter; $i++){
        if(isset($data['visited'][$i]['transactionHistory'])){
        $rVal = $data['visited'][$i]['transactionHistory']['subTotalRounded'];
        $rKey = $data['visited'][$i]['transactionHistory']['createdDate']->get()->format('d-m-Y');

        $sresult=array_search($rKey,$sortingDate);
        if($sresult == null){
        array_push($sortingDate,$rKey);
        array_push($sortingValue,$rVal);
        }else{
        $total=$sortingValue[$sresult]+$rVal;
        $replacements = array($sresult => $total);
        array_replace($sortingValue, $replacements);
        }
        }
        }

        $counter1 = count($sortingDate);
        for($i = 0; $i < $counter1; $i++){

        $data['revenueByDate'] = array('date' => $sortingDate[$i],'val' => $sortingValue[$i]);
        array_push($data['rev'] , $data['revenueByDate']);
        }

        // dd($data['rev']);

        return $data['rev'];

    }
    */

    //new revenue code
    public function revenue(){
        $firestore = app('firebase.firestore');
        $database = $firestore->database();
        $visits = $database->collection('visits');
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
                $rKey = $data['visited'][$i]['transactionHistory']['createdDate']->get()->format('d-m-Y');

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

        $data['revenueByDate'] = array('date' => $sortingDate[$i],'val' => $sortingValue[$i]);
            array_push($data['rev'] , $data['revenueByDate']);
        }

        return $data['rev'];

    }
    //end

    public function regUser (){
        $firestore = app('firebase.firestore');
        $database = $firestore->database();
        $patRef = $database->collection('users');
        $patient = $patRef->documents();
        $patientInfo = array();
        foreach($patient as $key => $value){
            array_push($patientInfo,$value->data());
        }

        $regDate = array('date');
        $regVal = array('val');
        $data['rev'] = array();

        foreach($patientInfo as $i=>$item){
            //dd($item['createdAt']);
            if(isset($item['createdAt'])){
                $sresult=array_search($item['createdAt']->get()->format('d-m-Y'),$regDate);
                if($sresult == null){
                    array_push($regDate,$item['createdAt']->get()->format('d-m-Y'));
                    array_push($regVal,1);
                }else{
                    $total=$regVal[$sresult]+1;
                    $replacements = array($sresult => $total);
                    $regVal=array_replace($regVal, $replacements);
                }
            }
        }

        $counter1 = count($regDate);
        for($i = 1; $i < $counter1; $i++){

        array_push($data['rev'] , array('date' => $regDate[$i],'val' => $regVal[$i]));
        }

        return $data['rev'];
    }


    public function visitors(){
        $firestore = app('firebase.firestore');
        $database = $firestore->database();
        $visits = $database->collection('visits');
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

        $todayData=0;
        $curWeekData=0;
        $curMonthData=0;
        $curYearData=0;

        $today=date('d-m-Y');

        $start_date = new \DateTime(date('Y-m-d'));
        $day_of_week = $start_date->format("w");
        $curWeek=date('Y-m-d', strtotime("-$day_of_week days", strtotime(date('Y-m-d'))));

        $curMonth=date('m-Y');

        $curYear=date('Y');


        $tday = '';
        $thisWeek = '';
        $mont = date('M Y');
        $year = '';

        for($i = 0; $i < $counter; $i++){
            if(isset($data['visited'][$i]['transactionHistory'])){
                $rKey = $data['visited'][$i]['transactionHistory']['createdDate']->get()->format('d-m-Y');
                $rKeyDate=explode('-', $rKey);

                if($rKey==$today){
                    $todayData=$todayData+1;
                }

                if($rKey>=$curWeek){
                    $curWeekData=$curWeekData+1;
                }

                if($curMonth==($rKeyDate[1].'-'.$rKeyDate[2])){
                    $curMonthData=$curMonthData+1;
                }

                if($curYear==$rKeyDate[2]){
                    $curYearData=$curYearData+1;
                }

            }
        }

        $data1 = array('date' => $today,'val' => $todayData);
        $data2 = array('date' => $curWeek,'val' => $curWeekData);
        $data3 = array('date' => $mont,'val' => $curMonthData);
        $data4 = array('date' => $curYear,'val' => $curYearData);

        /*
        temporary commented
        $data1 = array('date' => 'Today','val' => $todayData);
        $data2 = array('date' => 'Current Week','val' => $curWeekData);
        $data3 = array('date' => 'Current Mont','val' => $curMonthData);
        $data4 = array('date' => 'Current Year','val' => $curYearData);
        */

        array_push($data['rev'] , $data1);
        array_push($data['rev'] , $data2);
        array_push($data['rev'] , $data3);
        array_push($data['rev'] , $data4);

        return $data['rev'];

    }

    public function doctorInfo(){
        $firestore = app('firebase.firestore');
        $database = $firestore->database();
        $docRef = $database->collection('doctors');
        $doctors = $docRef->documents();
        $doctorInfo = array();
        foreach($doctors as $key => $value){
            array_push($doctorInfo,$value->data());
        }

        return $doctorInfo;
    }

    public function patientInfo(){
        $firestore = app('firebase.firestore');
        $database = $firestore->database();
        $patRef = $database->collection('users');
        $patient = $patRef->documents();
        $patientInfo = array();
        foreach($patient as $key => $value){
            array_push($patientInfo,$value->data());
        }

        return $patientInfo;
    }

    public function transactionHistory($visitId){
        // dd($visitId);
        $firestore = app('firebase.firestore');
        $database = $firestore->database();
        $visits = $database->collection('visits');

        $query = $visits->where('visitId','=',$visitId);
        $transectionInfo = $query->documents();

        $data['transaction'] = array();

        foreach ($transectionInfo as $value) {
            if($value->exists()){
                array_push($data['transaction'], $value->data());
            }
        }

        //dd($data['transaction']);
        return view('admin/transactionDetails')->with($data);
    }

    public function newPass(Request $request){
        $firestore = app('firebase.firestore');
        $database = $firestore->database();
        $info = $database->collection('hospital_users');
        $uid = $request->uid;
        $hospital_user = $info->document($uid);
        $userinfo = $hospital_user->snapshot();

        $hospital_user->update([
            ['path' => 'password', 'value' => $request->password]
        ]);

        return redirect('login/hospital');

    }

    public static function district(){

        $firestore = app('firebase.firestore');
        $database = $firestore->database();
        $districtRef = $database->collection('districts');

        $query = $districtRef->where('active','=',true);
        $data['district'] = $query->documents();
        $districtList = array();

        foreach($data['district'] as $key=>$item){
            array_push($districtList,$item->data());
        }

        return $districtList;
    }

    public static function hospital(){
        $firestore = app('firebase.firestore');
        $database = $firestore->database();
        $hosref  = $database->collection('hospitals');
        $hosDoc = $hosref->documents();

        $hospitalName = array();

        foreach($hosDoc as $item){
            array_push($hospitalName,$item->data());
        }

        return $hospitalName ;
    }

    public static function branch($id){
        $hId = $id;
        $firestore = app('firebase.firestore');
        $database = $firestore->database();
        $branchref  = $database->collection('hospitalBranch');
        $query = $branchref->where('hospitalId','=',$id);
        $branchDoc = $branchref->documents();

        $branchName = array();

        foreach($branchDoc as $item){
            array_push($branchName,$item->data());
        }
        return $branchName ;
    }

    public static function branchByUser(){
        $firestore = app('firebase.firestore');
        $database = $firestore->database();
        $branchref  = $database->collection('hospitalBranch');
        $branchDoc = $branchref->documents();
        $branchInfo = array();

        foreach($branchDoc as $item){
            array_push($branchInfo,$item->data());
        }
        return $branchInfo ;

    }
}
