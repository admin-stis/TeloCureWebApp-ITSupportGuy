<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// morshed 28/07/2020
use App\Doctor;
use App\Hospital;
use App\User;
use App\Visits;
use App\District;
// end

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

        //$doctors = $docRefe->documents();
        // $patients = $patientRefe->documents();
        // $hosUser = $hosRefe->documents();

        /*
        $doctor_count = 0;
        foreach ($doctors as $key => $value) {
            $doctor_count++;
        }
        */

        $doctor_count = Doctor::count();


        /*
        $patient = $patientRefe->documents();
        $patient_count=0;
        foreach ($patients as $key => $value) {
            $patient_count++;
        }

        $data['totalPatient'] = $patient_count;
        */

        $data['totalPatient'] = User::count();
        
        /*
        $query = $docRefe->where('active','=',true);
        $active_doctors = $query->documents();
        $number_of_active_doctor = 0;
        foreach ($active_doctors as $key => $value) {
            $number_of_active_doctor++;
        }
        */
        $data['activeDoctor'] = Doctor::where('active','true')->count();

        // $data['activeDoctor'] = $number_of_active_doctor;

        /* temporary commented visit info in admin dashboard

        $visits = $database->collection('visits');
        $visitData = $visits->documents();
        $data['visited'] = array();

        foreach($visitData as $key => $value){
            array_push($data['visited'],$value->data());
        }
        */

        $visits = Visits::get();
        $total = 0 ;
        foreach($visits as $visit)
        {
            if(isset($visit['transactionHistory']))
            {
                $transactionHistory = json_decode($visit['transactionHistory'],TRUE);
                $total += $transactionHistory['subTotalRounded'];

            }
        }
        $data['totalRevenue'] = $total;
        //dd($data['totalRevenue']);


        // hospital add
        /*
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
        */

        $data['totalHospitalUser'] = Hospital::count();

        // end

        // new code

        // end

        /*
        $counter = count($data['visited']);
        $total = 0;

        $data['totalRevenue'] = array();

        for($i = 0; $i < $counter; $i++){
            if(isset($data['visited'][$i]['transactionHistory'])){
                $total += $data['visited'][$i]['transactionHistory']['subTotalRounded'];

            }
        }

        array_push($data['totalRevenue'],$total);
        */

        /*
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
        */
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
        // $firestore = app('firebase.firestore');
        // $database = $firestore->database();
        // $visits = $database->collection('visits');
        // $visitData = $visits->documents();
        $visitData = Visits::all();
        $data['visited'] = array();

        foreach($visitData as $key => $value){
            array_push($data['visited'],$value);
        }

        //$counter = count($data['visited']);
        $counter = Visits::count();
        $data['revenueByDate'] = array();
        $data['revenueKey'] = array();
        $data['revenueVal'] = array();
        $data['rev'] = array();

        $sortingDate = array('date');
        $sortingValue = array('value');

        for($i = 0; $i < $counter; $i++){
            if(isset($data['visited'][$i]['transactionHistory'])){
                //$rVal = $data['visited'][$i]['transactionHistory']['subTotalRounded'];
                //$rKey = $data['visited'][$i]['transactionHistory']['createdDate']->get()->format('d-m-Y');
                $amount = json_decode($data['visited'][$i]['transactionHistory'],TRUE);
                $rVal = $amount['subTotalRounded'];
                $rKey = date('d-m-Y',strtotime($data['visited'][$i]['created_at']));

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


    // revenue by date
    public function revenueByDate(Request $request){
        // dd(1);
        // $firestore = app('firebase.firestore');
        // $database = $firestore->database();
        // $visits = $database->collection('visits');
        // $visitData = $visits->documents();
        $visitData = Visits::all();
        $data['visited'] = array();

        foreach($visitData as $key => $value){
            array_push($data['visited'],$value);
        }

        //$counter = count($data['visited']);
        $counter = Visits::count();
        $data['revenueByDate'] = array();
        $data['revenueKey'] = array();
        $data['revenueVal'] = array();
        $data['rev'] = array();

        $sortingDate = array('date');
        $sortingValue = array('value');

        for($i = 0; $i < $counter; $i++){
            if(isset($data['visited'][$i]['transactionHistory'])){
                //$rVal = $data['visited'][$i]['transactionHistory']['subTotalRounded'];
                //$rKey = $data['visited'][$i]['transactionHistory']['createdDate']->get()->format('d-m-Y');
                $amount = json_decode($data['visited'][$i]['transactionHistory'],TRUE);
                $rVal = $amount['subTotalRounded'];
                $rKey = date('d-m-Y',strtotime($data['visited'][$i]['created_at']));

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

        $date = date('d-m-Y',strtotime($request->date)) ;

            $res = array();
            $result = array();
            $rev = 0 ;
            foreach($data['rev'] as $val){
                if($val['date'] == $date){
                    $rev = $rev + $val['val'] ;
                }
                $res = array(
                        'date' => $date,
                        'rev' => $rev
                );
            }

            array_push($result,$res);
            return $result;
    }
    // revenue by week
    public function revenueByWeek(Request $request){
        
        $visitData = Visits::all();
        $data['visited'] = array();

        foreach($visitData as $key => $value){
            array_push($data['visited'],$value);
        }

        $counter = Visits::count();
        $data['revenueByDate'] = array();
        $data['revenueKey'] = array();
        $data['revenueVal'] = array();
        $data['rev'] = array();

        $sortingDate = array('date');
        $sortingValue = array('value');

        for($i = 0; $i < $counter; $i++){
            if(isset($data['visited'][$i]['transactionHistory'])){
                $amount = json_decode($data['visited'][$i]['transactionHistory'],TRUE);
                $rVal = $amount['subTotalRounded'];
                $rKey = date('W',strtotime($data['visited'][$i]['created_at']));

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
        //dd($data['rev']);
        $date = date('W',strtotime($request->week)) ;

        $res = array();
        $result = array();
        $rev = 0 ;
        foreach($data['rev'] as $val){

            //$revDate = date('Y-m-d',strtotime($val['date'])) ;
        
            if($val['date'] == $date){
                $rev = $rev + $val['val'] ;
            }
            $res = array(
                'date' => $date,
                'rev' => $rev
            );
        }

        array_push($result,$res);

        return $result;
    }
    // revenue by month
    public function revenueByMonth(Request $request){
        
        // $firestore = app('firebase.firestore');
        // $database = $firestore->database();
        // $visits = $database->collection('visits');
        // $visitData = $visits->documents();
        $visitData = Visits::all();
        $data['visited'] = array();

        foreach($visitData as $key => $value){
            array_push($data['visited'],$value);
        }

        //$counter = count($data['visited']);
        $counter = Visits::count();
        $data['revenueByDate'] = array();
        $data['revenueKey'] = array();
        $data['revenueVal'] = array();
        $data['rev'] = array();

        $sortingDate = array('date');
        $sortingValue = array('value');

        for($i = 0; $i < $counter; $i++){
            if(isset($data['visited'][$i]['transactionHistory'])){
                //$rVal = $data['visited'][$i]['transactionHistory']['subTotalRounded'];
                //$rKey = $data['visited'][$i]['transactionHistory']['createdDate']->get()->format('d-m-Y');
                $amount = json_decode($data['visited'][$i]['transactionHistory'],TRUE);
                $rVal = $amount['subTotalRounded'];
                $rKey = date('d-m-Y',strtotime($data['visited'][$i]['created_at']));

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

        $date = date('M Y',strtotime($request->month)) ;

            $res = array();
            $result = array();
            $rev = 0 ;
            foreach($data['rev'] as $val){

        $revDate = date('M Y',strtotime($val['date'])) ;
        
                if($revDate == $date){
                    $rev = $rev + $val['val'] ;
                }
                $res = array(
                        'date' => $date,
                        'rev' => $rev
                );
            }

            array_push($result,$res);
            return $result;
    }
    // revenue by year
    public function revenueByYear(Request $request){
        
        // $firestore = app('firebase.firestore');
        // $database = $firestore->database();
        // $visits = $database->collection('visits');
        // $visitData = $visits->documents();
        $visitData = Visits::all();
        $data['visited'] = array();

        foreach($visitData as $key => $value){
            array_push($data['visited'],$value);
        }

        //$counter = count($data['visited']);
        $counter = Visits::count();
        $data['revenueByDate'] = array();
        $data['revenueKey'] = array();
        $data['revenueVal'] = array();
        $data['rev'] = array();

        $sortingDate = array('date');
        $sortingValue = array('value');

        for($i = 0; $i < $counter; $i++){
            if(isset($data['visited'][$i]['transactionHistory'])){
                //$rVal = $data['visited'][$i]['transactionHistory']['subTotalRounded'];
                //$rKey = $data['visited'][$i]['transactionHistory']['createdDate']->get()->format('d-m-Y');
                $amount = json_decode($data['visited'][$i]['transactionHistory'],TRUE);
                $rVal = $amount['subTotalRounded'];
                $rKey = date('d-m-Y',strtotime($data['visited'][$i]['created_at']));

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

        $date = date('Y',strtotime($request->year)) ;

            $res = array();
            $result = array();
            $rev = 0 ;
            foreach($data['rev'] as $val){

        $revDate = date('Y',strtotime($val['date'])) ;
        
                if($revDate == $date){
                    $rev = $rev + $val['val'] ;
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

    public function regUser (){
        
        /*
        $firestore = app('firebase.firestore');
        $database = $firestore->database();
        $patRef = $database->collection('users');
        $patient = $patRef->documents();
        $patientInfo = array();
        foreach($patient as $key => $value){
            array_push($patientInfo,$value->data());
        }
        */

        $patient = User::all();
        $patientInfo = array();
        foreach($patient as $key => $value)
        {
            array_push($patientInfo,$value);
        }

        //dd($patientInfo);

        $regDate = array('date');
        $regVal = array('val');
        $data['rev'] = array();

        foreach($patientInfo as $i=>$item){
            //dd(substr($item['createdAt'],0,10));
            if(isset($item['createdAt'])){
                // $sresult=array_search($item['createdAt']->get()->format('d-m-Y'),$regDate);

                $sresult=array_search(date('d-m-Y',strtotime(substr($item['createdAt'],0,10))),$regDate);
                if($sresult == null){
                    // array_push($regDate,$item['createdAt']->get()->format('d-m-Y'));
                    array_push($regDate,date('d-m-Y',strtotime(substr($item['createdAt'],0,10))));
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


    public function regUserDateWise(Request $request){
        
        /*
        $firestore = app('firebase.firestore');
        $database = $firestore->database();
        $patRef = $database->collection('users');
        $patient = $patRef->documents();
        $patientInfo = array();
        foreach($patient as $key => $value){
            array_push($patientInfo,$value->data());
        }
        */

        $patient = User::all();
        $patientInfo = array();
        foreach($patient as $key => $value)
        {
            array_push($patientInfo,$value);
        }

        $regDate = array('date');
        $regVal = array('val');
        $data['rev'] = array();

        foreach($patientInfo as $i=>$item){
            //dd(substr($item['createdAt'],0,10));
            if(isset($item['createdAt'])){
                // $sresult=array_search($item['createdAt']->get()->format('d-m-Y'),$regDate);

                $sresult=array_search(date('d-m-Y',strtotime(substr($item['createdAt'],0,10))),$regDate);
                if($sresult == null){
                    // array_push($regDate,$item['createdAt']->get()->format('d-m-Y'));
                    array_push($regDate,date('d-m-Y',strtotime(substr($item['createdAt'],0,10))));
                    array_push($regVal,1);
                }else{
                    $total=$regVal[$sresult]+1;
                    $replacements = array($sresult => $total);
                    $regVal=array_replace($regVal, $replacements);
                }
            }
        }

        $date = date('d-m-Y',strtotime($request->date)) ;

        $counter1 = count($regDate);
        for($i = 1; $i < $counter1; $i++){

        array_push($data['rev'] , array('date' => $regDate[$i],'val' => $regVal[$i]));
        }

        $res = array();
        $result = array();
        $rev = 0 ;
        foreach($data['rev'] as $val){
            if($val['date'] == $date){
                $rev = $rev + $val['val'] ;
            }
            $res = array(
                    'date' => $date,
                    'rev' => $rev
            );
        }

        array_push($result,$res);
        return $result;

        //return $data['rev'];
    }


    public function visitors(){
        
        $visitData = Visits::all();

        $data['visited'] = array();
        foreach($visitData as $key => $value){
            array_push($data['visited'],$value);
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
            //dd($data['visited'][$i]['transactionHistory']);
            if(isset($data['visited'][$i]['transactionHistory'])){

                //new code 28/07/2020
                $transaction = json_decode($data['visited'][$i]['transactionHistory'],TRUE);
                //dd($transaction['createdDate']);
                //end 

                //$rKey = $data['visited'][$i]['transactionHistory']['createdDate']->get()->format('d-m-Y');
                
                //$rKey = $data['visited'][$i]['created_at'];

                //$date = date('d-m-Y',strtotime($rkey));

                //date('d-m-Y',strtotime($data['visited'][$i]['created_at']));

                if(isset($data['visited'][$i]['created_at']) && !empty($data['visited'][$i]['created_at']))
                {
                    //$rKey = date('d-m-Y',strtotime(substr($transaction['createdDate'],0,10)));
                    $rKey = date('d-m-Y',strtotime($data['visited'][$i]['created_at']));
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

    // visitor date/month/year wise
    public function visitorsByDate(Request $request){
        
        $visitData = Visits::all();

        $data['visited'] = array();
        foreach($visitData as $key => $value){
            array_push($data['visited'],$value);
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

        //$today=date('d-m-Y');

        $today = date('d-m-Y',strtotime($request->date)); 

        for($i = 0; $i < $counter; $i++){
            //dd($data['visited'][$i]['transactionHistory']);
            if(isset($data['visited'][$i]['transactionHistory'])){
                
                $transaction = json_decode($data['visited'][$i]['transactionHistory'],TRUE);
                
                if(isset($data['visited'][$i]['created_at']) && !empty($data['visited'][$i]['created_at']))
                {
                    $rKey = date('d-m-Y',strtotime($data['visited'][$i]['created_at']));
                    $rKeyDate=explode('-', $rKey);
                
                    if($rKey==$today){
                        $todayData=$todayData+1;
                    }

                }

            }
        }

        $data1 = array('date' => $today,'val' => $todayData);
        
        array_push($data['rev'] , $data1);

        return $data['rev'];

    }
    public function visitorsByWeek(Request $request){
        
        $visitData = Visits::all();

        $data['visited'] = array();
        foreach($visitData as $key => $value){
            array_push($data['visited'],$value);
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

        $today = date('W',strtotime($request->week)); 

        for($i = 0; $i < $counter; $i++){
            //dd($data['visited'][$i]['transactionHistory']);
            if(isset($data['visited'][$i]['transactionHistory'])){
                
                $transaction = json_decode($data['visited'][$i]['transactionHistory'],TRUE);
                
                if(isset($data['visited'][$i]['created_at']) && !empty($data['visited'][$i]['created_at']))
                {
                    $rKey = date('W',strtotime($data['visited'][$i]['created_at']));
                    $rKeyDate=explode('-', $rKey);
                
                    if($rKey==$today){
                        $todayData=$todayData+1;
                    }

                }

            }
        }

        $data1 = array('date' => $today,'val' => $todayData);
        
        array_push($data['rev'] , $data1);

        return $data['rev'];

    }
    public function visitorsByMonth(Request $request){
        
        $visitData = Visits::all();

        $data['visited'] = array();
        foreach($visitData as $key => $value){
            array_push($data['visited'],$value);
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

        //$today=date('d-m-Y');

        $today = date('M Y',strtotime($request->month)); 

        for($i = 0; $i < $counter; $i++){
            //dd($data['visited'][$i]['transactionHistory']);
            if(isset($data['visited'][$i]['transactionHistory'])){
                
                $transaction = json_decode($data['visited'][$i]['transactionHistory'],TRUE);
                
                if(isset($data['visited'][$i]['created_at']) && !empty($data['visited'][$i]['created_at']))
                {
                    $rKey = date('M Y',strtotime($data['visited'][$i]['created_at']));
                    $rKeyDate=explode('-', $rKey);
                
                    if($rKey==$today){
                        $todayData=$todayData+1;
                    }

                }

            }
        }

        $data1 = array('date' => $today,'val' => $todayData);
        
        array_push($data['rev'] , $data1);

        return $data['rev'];

    }
    public function visitorsByYear(Request $request){
        
        $visitData = Visits::all();

        $data['visited'] = array();
        foreach($visitData as $key => $value){
            array_push($data['visited'],$value);
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

        //$today=date('d-m-Y');

        $today = date('Y',strtotime($request->year)); 

        for($i = 0; $i < $counter; $i++){
            //dd($data['visited'][$i]['transactionHistory']);
            if(isset($data['visited'][$i]['transactionHistory'])){
                
                $transaction = json_decode($data['visited'][$i]['transactionHistory'],TRUE);
                
                if(isset($data['visited'][$i]['created_at']) && !empty($data['visited'][$i]['created_at']))
                {
                    $rKey = date('Y',strtotime($data['visited'][$i]['created_at']));
                    $rKeyDate=explode('-', $rKey);
                
                    if($rKey == $today){

                    
                        $todayData=$todayData+1;
                    }


                }

            }
        }

        

        $data1 = array('date' => $today,'val' => $todayData);
        
        array_push($data['rev'] , $data1);

        return $data['rev'];

    }
    // end

    public function doctorInfo(){
        // $firestore = app('firebase.firestore');
        // $database = $firestore->database();
        // $docRef = $database->collection('doctors');
        // $doctors = $docRef->documents();
        $doctors = Doctor::all();
        $doctorInfo = array();
        foreach($doctors as $key => $value){
            array_push($doctorInfo,$value);
        }

        return $doctorInfo;
    }

    public function patientInfo(){
        // $firestore = app('firebase.firestore');
        // $database = $firestore->database();
        // $patRef = $database->collection('users');
        // $patient = $patRef->documents();
        $patient = User::all();
        $patientInfo = array();
        foreach($patient as $key => $value){
            array_push($patientInfo,$value);
        }

        return $patientInfo;
    }

    public function transactionHistory($visitId){
        // dd($visitId);
        $firestore = app('firebase.firestore');
        $database = $firestore->database();
        $visits = $database->collection('visits');

        $query = $visits->where('visitId','=',$visitId);
        //$transectionInfo = $query->documents();

        $transectionInfo = Visits::where('visitId',$visitId)->get()->toArray();        

        $data['transaction'] = array();

        foreach ($transectionInfo as $value) {
            //if($value->exists()){
                array_push($data['transaction'], $value);
            //}
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

        //$query = $districtRef->where('active','=',true);
        //$data['district'] = $query->documents();

        $data['district'] = District::where('active','1')->get()->toArray();

        $districtList = array();

        foreach($data['district'] as $key=>$item){
            array_push($districtList,$item);
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

    public function doctorInfoByDistrict(){
        $firestore = app('firebase.firestore');
        $database = $firestore->database();
        // $docRef = $database->collection('doctors');
        // $doctors = $docRef->where('active','=',true)->documents();

        $doctors = Doctor::get()->toArray();

        $districtRef = $database->collection('districts');

        // $query = $districtRef->where('active','=',true);
        // $district = $query->documents();

        $district = District::where('active',1)->get()->toArray();
        
        $data['districtList'] = array();
		$activeDistrict = array();
        
        foreach($district as $key=>$item){
            array_push($data['districtList'],$item);
        }

        foreach($data['districtList'] as $key=>$item){
            array_push($activeDistrict,$item['name']);
        }

        $data['doctorInfo'] = array();
        foreach($doctors as $key => $value){
            array_push($data['doctorInfo'],$value);
        }

        $doctorDis = array();
        foreach ($data['doctorInfo'] as $key => $value) {
        	array_push($doctorDis,$value['district']);
        }

        // dd($doctorDis);

        $count = 0;
		$output = array();
		$temp_arr = array();

		for($i = 0; $i < count($activeDistrict); $i++)
		{
		     for($j = 0; $j < count($doctorDis); $j++)
		     {
		            if($doctorDis[$j] == $activeDistrict[$i])
		            {
		                array_push($output,$doctorDis[$j]);
		            }
		     }
		}

		$docByDis = array_count_values($output);
		return $docByDis;
    }

    public function visitInfoByDistrict(){
        $firestore = app('firebase.firestore');
        $database = $firestore->database();
        // $docRef = $database->collection('doctors');
        // $doctors = $docRef->where('active','=',true)->documents();

        $transactionHistorydoctors = Visits::get()->toArray();

        $districtRef = $database->collection('districts');

        // $query = $districtRef->where('active','=',true);
        // $district = $query->documents();

        $district = District::where('active',1)->get()->toArray();
        
        $data['districtList'] = array();
        $activeDistrict = array();
        
        foreach($district as $key=>$item){
            array_push($data['districtList'],$item);
        }

        foreach($data['districtList'] as $key=>$item){
            array_push($activeDistrict,$item['name']);
        }

        $doctorInfo = array();
        foreach($transactionHistorydoctors as $key => $value){
            array_push($doctorInfo,$value);
        }

        //dd($doctorInfo);

        // $doctorDis = array();
        // foreach ($data['doctorInfo'] as $key => $value) {
        //     array_push($doctorDis,$value['district']);
        // }

        $total = 0;
        $output = array();

        $sortingDate = array('date');
        $sortingValue = array('value');

        for($i = 0; $i < count($activeDistrict); $i++)
        {
             for($j = 0; $j < count($doctorInfo); $j++)
             {
                    $dis = json_decode($doctorInfo[$j]['doctor'],True);
                    if($dis['district'] == $activeDistrict[$i])
                    {   

                    
                        $rKey = $activeDistrict[$i]; 
                        $tHistory = json_decode($doctorInfo[$j]['transactionHistory'],True);
                        $rVal = $tHistory['subTotalRounded'];
                        
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

        }


        $data['rev'] = array();
        $counter1 = count($sortingDate);
        //dd($sortingValue);
        for($i = 1; $i < $counter1; $i++){
            $data['revenueByDate'] = array('date' => $sortingDate[$i],'val' => $sortingValue[$i]);
            array_push($data['rev'] , $data['revenueByDate']);
        }

        return $data['rev'];

        //$docByDis = $output ;
       // return $output;
    }

}
