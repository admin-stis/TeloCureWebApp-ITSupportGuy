<?php

namespace App\Http\Controllers\Api;

use App\Doctor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

use Google\Cloud\Core\Timestamp;
use DateTime;
use Log;

class SetAllUserController extends Controller
{
    public function setPatient(Request $request)
    {
        ////17-8-20 mridul commented as firebase checks not required and it consumes api response time
        /*
        $firestore = app('firebase.firestore');
        $database = $firestore->database();

        $patientColl = $database->collection('users');
        $patientDoc = $patientColl->documents();

        $flag = false;
        $emailFlag = false;
        $patient = array();

        foreach($patientDoc as $item){
          array_push($patient,$item->data());
        }

        foreach($patient as $key=>$item){
          if(isset($item['phone']) && $item['phone'] == $request->phone){
            $flag = true ;
            break;
          }
        }

        foreach($patient as $key=>$item){
            if(isset($item['email']) && $item['email'] == $request->email){
                $emailFlag = true ;
                break;
            }
        } */

        $date = date('Y-m-d h:i:s');

        //dd($request->all());
        $data = [
            'uid'=> $request->uid,
            //'approve' => '',
            'online' => $request->online,
            'active'=> $request->active,
            'email'=> $request->email,
            'name'=> $request->name.' '.$request->lastname,
            //'lastname' => $request->lastname,
            'phone' => $request->phone,
            'password' => $request->password,
            'gender' => $request->gender,
            'weight' => $request->weight,
            'height' => $request->height,
            'bloodGroup' => $request->bloodGroup,
            'totalCount' => $request->totalCount,
            'totalRating' => $request->totalRating,
            'price' => $request->price,
            'regNo' => $request->regNo,
            'medication' => $request->medication,
            'smoke' => $request->smoke,
            'photoUrl' => $request->photoUrl,
            'hospitalUid' => $request->hospitalUid,
            'hospitalized' => $request->hospitalized,
            'doctorType' => $request->doctorType,
            'district' => $request->district,
            'districtId' => $request->districtId,
            'createdAt' => $date ,
        ];


        if(User::create($data)){
        	return response()->json([
                'error'=> 'false',
                'message' => 'Patient register successfully'],200);
        }else{
        	return response()->json([
                'error'=> 'true',
                'message' => 'Patient does not registered. Something went wrong.'],200);
        }

        /*
        if($flag == true && $emailFlag == true){
            return response()->json([
                'error'=> 'true',
                'message' => 'Mobile and email already exist.'],200);
        }elseif($flag == true && $emailFlag == false){
            return response()->json([
                'error'=> 'true',
                'message' => 'Mobile already exist.'],200);
        }elseif($flag == false && $emailFlag == true){
            return response()->json([
                'error'=> 'true',
                'message' => 'Email already exist.'],200);
        }elseif(User::create($data)){
            return response()->json([
                'error'=> 'false',
                'message' => 'Patient register successfully'],200);
        }else{
            return response()->json([
                'error'=> 'true',
                'message' => 'Patient can not register.'],200);
        }
        */

    }

    public function setDoctor(Request $request)
    {
        ////17-8-20 mridul commented as firebase checks not required and it consumes api response time
        /*
        $firestore = app('firebase.firestore');
        $database = $firestore->database();

        $patientColl = $database->collection('doctors');
        $patientDoc = $patientColl->documents();

        $flag = false;
        $emailFlag = false;
        $patient = array();

        foreach($patientDoc as $item){
          array_push($patient,$item->data());
        }

        foreach($patient as $key=>$item){
          if(isset($item['phone']) && $item['phone'] == $request->phone){
            $message = 'Contact number already exits.';
            $flag = true ;
            break;
          }
        }

        foreach($patient as $key=>$item){
          if(isset($item['email']) && $item['email'] == $request->email){
                $message = 'Email already exits.';
                $emailFlag = true ;
                break;
          }
        } */

        $date = date('Y-m-d h:i:s');

        if(isset($request->balance)){
            $balance = [
                'balance' => $request->balance,
                'updatedTime' => $date
            ];
        }else{
            $balance = [];
        }

        if(isset($request->accountNumber)){
            $bankAccount = [
                'accountName' => $request->accountName,
                'accountNumber'  => $request->accountNumber,
                'bankName' => $request->bankName,
                'swiftCode' => $request->swiftCode,
            ];
        }else{
            $bankAccount = [];
        }

        if(isset($request->academicCertificate)){
            $documents = [
                'academicCertificate' => $request->academicCertificate,
                'nidBack' => $request->nidBack,
                'nidFront' => $request->nidFront,
            ];
        }else{
            $documents = [];
        }

        // test
        // dd($request->all());
        // end

        $date = date('Y-m-d h:i:s');

        $data = [
            'uid' => $request->uid,
            'dateOfBirth' => $request->dateOfBirth,
            'district' => $request->district,
            'districtId' => $request->districtId,
            'active'=> $request->active,
            'doctorType' => $request->doctorType,
            'email'=> $request->email,
            'gender' => $request->gender,
            'name'=> $request->name.' '.$request->lastname,
            'phone' => $request->phone,
            'password' => $request->password,
            "totalRating" => $request->totalRating,
            "price" => $request->price,
            "totalCount" => $request->totalCount,
            "hospitalUid" => $request->hospitalUid,
            "hospitalized" => $request->hospitalized,
            "online" => $request->online,
            "rejected" => $request->rejected,
            "createdAt" => $date,
            "hospitalName"=> $request->hospitalName,
            "photoUrl"=>$request->photoUrl,
            "regNo" => $request->regNo,
            "registrationStat" => $request->registrationStat,
            "balance" => json_encode($balance),
            "documents" => json_encode($documents),
            "bank_info" => json_encode($bankAccount),
            "welcomed" => $request->welcomed
        ];

        //dd($data);

        if(Doctor::create($data)){
        	return response()->json([
                'error'=> 'false',
                'message' => 'Doctor register successfully'],200);
        }else{
        	return response()->json([
                'error'=> 'true',
                'message' => 'Doctor does not registered. Something went wrong.'],200);
        }

        /*
        if($flag == true && $emailFlag == true){
            return response()->json([
                'error'=> 'true',
                'message' => 'Mobile and email already exist.'],200);
        }elseif($flag == true && $emailFlag == false){
            return response()->json([
                'error'=> 'true',
                'message' => 'Mobile already exist.'],200);
        }elseif($flag == false && $emailFlag == true){
            return response()->json([
                'error'=> 'true',
                'message' => 'Email already exist.'],200);
        }elseif(Doctor::create($data)){
            return response()->json([
                'error'=> 'false',
                'message' => 'Doctor register successfully'],200);
        }else{
            return response()->json([
                'error'=> 'true',
                'message' => 'Doctor can not register.'],200);
        }
        */
    }


}
