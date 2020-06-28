<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\sendEmail;
use Mail;


class AdminServiceController extends Controller
{
    public function index()
    {

        $firestore = app('firebase.firestore');
   		$database = $firestore->database();
        $visitsRef = $database->collection('visits');
        $userRef= $database->collection('users');

        $visitDoc = $visitsRef->documents();

        $data['visitArr'] = array();
        foreach($visitDoc as $item){
            array_push($data['visitArr'],$item->data());
        }

        $data['info'] = array();
        $vitalData = array();
        $vitalRef = $database->collection('vitals');

        $arr = array();
        $data['arr'] = array();

        $data['pInfo'] = array(
            'id' => array(),
            'name' => array(),
            'phone' => array(),
            'gender' => array(),
            'district' => array(),
            'diagnosis' => array()
        );

        $diagnosis = array();
        foreach($data['visitArr'] as $item){

            $vital = $vitalRef->document($item['patientUid'])->snapshot()->data();

            if(isset($vital) && !empty($vital)){
                array_push($diagnosis,$vital);
            }else{
                $temp = "Null";
                array_push($diagnosis,$temp);
            }

            array_push($data['pInfo']['name'],$item['patient']['name']);
            array_push($data['pInfo']['phone'],$item['patient']['phone']);
            array_push($data['pInfo']['gender'],$item['patient']['gender']);
            array_push($data['pInfo']['id'],$item['patient']['uid']);
            array_push($data['pInfo']['district'],$item['patient']['district']);
            array_push($data['pInfo']['diagnosis'],$diagnosis);

        }

        $counter = count($data['pInfo']['id']);
        //$data['arr'] = array();

        for($i = 0; $i < $counter; $i++ ){
            $arr = array(
                'name' => $data['pInfo']['name'][$i],
                'phone' => $data['pInfo']['phone'][$i],
                'gender' => $data['pInfo']['gender'][$i],
                'id' => $data['pInfo']['id'][$i],
                'district' => $data['pInfo']['district'][$i],
                'diagnosis' => $data['pInfo']['diagnosis'][$i]
            );
            array_push($data['arr'],$arr);
        }
        //dd($data);
        return view('service.index')->with($data);
    }

    public function calculateTime($time1, $time2) {
        $time1 = date('H:i:s',strtotime($time1));
        $time2 = date('H:i:s',strtotime($time2));
        $times = array($time1, $time2);
        $seconds = 0;
        foreach ($times as $time)
        {
          list($hour,$minute,$second) = explode(':', $time);
          $seconds += $hour*3600;
          $seconds += $minute*60;
          $seconds += $second;
        }
        $hours = floor($seconds/3600);
        $seconds -= $hours*3600;
        $minutes  = floor($seconds/60);
        $seconds -= $minutes*60;
        if($seconds < 9)
        {
        $seconds = "0".$seconds;
        }
        if($minutes < 9)
        {
        $minutes = "0".$minutes;
        }
          if($hours < 9)
        {
        $hours = "0".$hours;
        }
        return "{$hours}:{$minutes}:{$seconds}";
    }


    public function serviceInfo()
    {
        $firestore = app('firebase.firestore');
   		$database = $firestore->database();
        $visitsRef = $database->collection('visits');
        $doctorUser = $database->collection('doctors');

        $visitDoc = $visitsRef->documents();
        $visitArr = array();
        foreach($visitDoc as $item){
            array_push($visitArr,$item->data());
        }

        $general = 0 ;
        $pediatric = 0 ;

        $out = array();
        $pediatric = 0 ;

        $newArr = array();
        $arr['newArr1'] = array();

        $arr['dName'] = array();
        $arr['did'] = array();
        $arr['hosName'] = array();
        $arr['phone'] = array();
        $arr['timeDurationSum'] = array();
        $arr['timeInterVal'] = array();
        $arr['date'] = array();
        $arr['general'] = array();
        $arr['pediatric'] = array();

        $time = '00:00:00';

        foreach ($visitArr as $key => $value){
            //print_r($value['doctorUid']);
            array_push($out,$value['doctorUid']);
            foreach ($value as $key2 => $value2){
            }
            if($value['doctorType'] == 'GENERAL'){
                $general++ ;
            }
            elseif($value['doctorType'] == 'PEDIATRIC'){
                $pediatric++ ;
            }

            array_push($arr['dName'],$value['doctor']['name']);
            array_push($arr['phone'],$value['doctor']['phone']);
            array_push($arr['did'],$value['doctorUid']);

            if(isset($value['doctor']['hospitalName'])){
                array_push($arr['hosName'],$value['doctor']['hospitalName']);
            }else{
                $na = 'N/A';
                array_push($arr['hosName'],$na);
            }

            $strTime = new \DateTime($value['callStartTime']);
            $endTime = new \DateTime($value['callEndTime']);

            $date = $value['callStartTime']->get()->format('d-m-Y');
            array_push($arr['date'],$date);
            $interval = date_diff($endTime,$strTime);
            array_push($arr['timeInterVal'],$interval->format("%H:%I:%S"));
            $time = $this->calculateTime($interval->format("%H:%I:%S"),$time);
        }

        array_push($arr['timeDurationSum'],$time); // Sum of service duration
        array_push($arr['general'],$general);
        array_push($arr['pediatric'],$pediatric);

        $counter = array_count_values($out);

        $docArr = array();
        $val = 0 ;
        $count = 0 ;

        $test['dinfo']['doctorName'] = array();
        $test['dinfo']['doctorUid'] = array();
        $test['dinfo']['total'] = array();
        $test['dinfo']['noOfCall'] = array();
        $test['dinfo']['doctorType'] = array();
        $test['dinfo']['doctorPhone'] = array();
        $test['dinfo']['duration'] = array();

        $doctorName = '';
        $doctorType = '';
        $doctorPhone = '';

        foreach($counter as $key => $value){
            $query = $visitsRef->where('doctorUid','=',$key);
            $docData = $query->documents();

            foreach($docData as $data){
                array_push($docArr,$data->data());
            }

            $i = 0;
            $duration = '00:00:00';
            foreach($docArr as $data1){

                if($key == $data1['doctorUid']){
                    $val += $data1['transactionHistory']['subTotalRounded'];
                    $count ++ ;
                    $doctorType = $data1['doctorType'];
                    $doctorName = $data1['doctor']['name'];
                    $doctorPhone = $data1['doctor']['phone'];

                    //total service duration of a doctor
                    $strTime = new \DateTime($data1['callStartTime']);
                    $endTime = new \DateTime($data1['callEndTime']);

                    $interval = date_diff($endTime,$strTime);
                    array_push($arr['timeInterVal'],$interval->format("%H:%I:%S"));
                    $duration = $this->calculateTime($interval->format("%H:%I:%S"),$duration);
                    //end

                }else{
                    $val = 0 ;
                    $count = 0;
                    $duration = '00:00:00';
                }
            }

            array_push($test['dinfo']['doctorName'],$doctorName);
            array_push($test['dinfo']['doctorType'],$doctorType);
            array_push($test['dinfo']['doctorPhone'],$doctorPhone);
            array_push($test['dinfo']['doctorUid'],$key);
            array_push($test['dinfo']['total'],$val); // total income of each doctor
            array_push($test['dinfo']['noOfCall'],$count);
            array_push($test['dinfo']['duration'],$duration);
        }

        $docdata['docinfo'] = array();

        for($i = 0; $i < count($test['dinfo']['doctorUid']); $i++){
            $newArr = array(
                'doctorUid' => $test['dinfo']['doctorUid'][$i],
                'doctorName'=> $test['dinfo']['doctorName'][$i],
                'doctorType'=> $test['dinfo']['doctorType'][$i],
                'doctorPhone'=> $test['dinfo']['doctorPhone'][$i],
                'noOfCall' => $test['dinfo']['noOfCall'][$i],
                'total' => $test['dinfo']['total'][$i],
                'duration' => $test['dinfo']['duration'][$i]
            );
            array_push($arr['newArr1'],$newArr);
        }

        $arr['newArr2'] = array();

        for($i = 0; $i < count($arr['did']); $i++){
            $newArr2 = array(
                'did' => $arr['did'][$i],
                'dName' => $arr['dName'][$i],
                'phone' => $arr['phone'][$i],
                'hosName' => $arr['hosName'][$i],
                'timeInterVal' => $arr['timeInterVal'][$i],
                'date' => $arr['date'][$i]
            );
            array_push($arr['newArr2'],$newArr2);
        }

        return view('service/serviceInfo')->with($arr);
    }

    public function financialInfo()
    {
        $firestore = app('firebase.firestore');
   		$database = $firestore->database();
        $visitsRef = $database->collection('visits');

        $visitDoc = $visitsRef->documents();
        $data['visitArr'] = array();

        foreach($visitDoc as $item){
            array_push($data['visitArr'],$item->data());
        }

        $dateArr = array();
        foreach($data['visitArr'] as $item){
            $datef = $item['callStartTime']->get()->format('d-m-Y');
            array_push($dateArr,$datef);
        }
        ksort($dateArr);
        $data['dateArr'] = array_count_values($dateArr);

        return view('service/financialInfo')->with($data);
    }

    public function pInfo(){
        // $firestore = app('firebase.firestore');
   		// $database = $firestore->database();
        // $visitsRef = $database->collection('visits');
        // $userRef= $database->collection('users');

        // $visitDoc = $visitsRef->documents();

        // $data['visitArr'] = array();
        // foreach($visitDoc as $item){
        //     array_push($data['visitArr'],$item->data());
        // }

        // $data['info'] = array();
        // $vitalData = array();
        // $vitalRef = $database->collection('vitals');

        // $arr = array();
        // $data['arr'] = array();

        // foreach($data['visitArr'] as $item){

        //     $vital = $vitalRef->document($item['patientUid'])->snapshot()->data();

        //     if(isset($vital) && !empty($vital)){
        //         foreach($vital as $item){
        //             array_push($data['pInfo']['vital'],$item->data());
        //         }
        //     }else{
        //         $temp = "Null";
        //         array_push($data['pInfo']['vital'],$temp);
        //     }

        //     array_push($data['pInfo']['name'],$item['patient']['name']);
        //     array_push($data['pInfo']['phone'],$item['patient']['phone']);
        //     array_push($data['pInfo']['gender'],$item['patient']['gender']);
        //     array_push($data['pInfo']['id'],$item['patient']['uid']);
        //     array_push($data['pInfo']['district'],$item['patient']['district']);

        // }

        // $counter = count($data['pInfo']['id']);
        // //$data['arr'] = array();

        // for($i = 0; $i < $counter; $i++ ){
        //     $arr = array(
        //         'name' => $data['pInfo']['name'][$i],
        //         'phone' => $data['pInfo']['phone'][$i],
        //         'gender' => $data['pInfo']['gender'][$i],
        //         'id' => $data['pInfo']['id'][$i],
        //         'district' => $data['pInfo']['district'][$i]
        //     );
        //     array_push($data['arr'],$arr);
        // }


    }
}
