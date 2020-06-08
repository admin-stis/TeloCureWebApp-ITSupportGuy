<?php

namespace App\Http\Controllers\Doctor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class DoctorController extends Controller
{
    public function __construct()
    {

    }

    public function index()
    {
        // $query = $userRef->where('email','=',$email)->where('password','=',$request->password);
        // $userInfo = $query->documents();
        $firestore = app('firebase.firestore');
        $db = $firestore->database();

        // $docRef = $db->collection('doctors')->documents();

        // $data['doctorProfile'] = $docRef->snapshot()->data();
        // return view('doctor.profile')->with($data);
        $doctorData = Session::get('user');

        $uid = $doctorData[0]['uid'];

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
            array_push($data['tRev'],$totalAmountRev);

            $data['revenueByDate'] = array('id' => $uid ,'title' => $sortingValue[$i].'Tk','start' => $sortingDate[$i],'end' => '');
            array_push($data['rev'] , $data['revenueByDate']);
        }

        return view('doctor.index')->with($data);

    }

    public function completeProfile()
    {
        return view('doctor.complete-profile');
    }

    public function profile($id)
    {
        $firestore = app('firebase.firestore');
        $db = $firestore->database();

        $docRef = $db->collection('doctors')->document($id);
        //   $snapshot = $docRef->snapshot();
        //   return $snapsot->data();

        $data['doctorProfile'] = $docRef->snapshot()->data();
        return view('doctor.profile')->with($data);
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
}
