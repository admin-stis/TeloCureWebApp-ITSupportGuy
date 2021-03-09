<?php

namespace App\Http\Controllers\Api;

use App\Doctor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Visits;
use Google\Cloud\Core\Timestamp;
use DateTime;
use DB;
use Log;

class TransactionController extends Controller
{
    public function transaction(Request $request)
    {
        
        
        $doctor_createdAt = date('Y-m-d h:i:s',strtotime($request->doctor_createdAt));

        if($request->doctor_active == true && $request->doctor_active == 'true'){
            $doctor_active = 1;
        }else{
            $doctor_active = 0;
        }

        if($request->doctor_hospitalized == true && $request->doctor_hospitalized == 'true'){
            $doctor_hospitalized = 1;
        }else{
            $doctor_hospitalized = 0;
        }

        if($request->doctor_online == true && $request->doctor_online == 'true'){
            $doctor_online = 1;
        }else{
            $doctor_online = 0;
        }

        if($request->doctor_rejected == true && $request->doctor_rejected == 'true'){
            $doctor_rejected = 1;
        }else{
            $doctor_rejected = 0;
        }

        if($request->doctor_welcomed == true && $request->doctor_welcomed == 'true'){
            $doctor_welcomed = 1;
        }else{
            $doctor_welcomed = 0;
        }

        $doctor = [
            'uid' => $request->doctor_uid,
            'dateOfBirth' => $request->doctor_dateOfBirth,
            'district' => $request->doctor_district,
            'districtId' => $request->doctor_districtId,
            'active'=> $doctor_active,
            'doctorType' => $request->doctor_doctorType,
            'email'=> $request->doctor_email,
            'gender' => $request->doctor_gender,
            'name'=> $request->doctor_name.' '.$request->lastname,
            'phone' => $request->doctor_phone,
            'password' => $request->doctor_password,
            "totalRating" => $request->doctor_totalRating,
            "price" => $request->doctor_price,
            "totalCount" => $request->doctor_totalCount,
            "hospitalUid" => $request->doctor_hospitalUid,
            "hospitalized" => $doctor_hospitalized,
            "online" => $doctor_online,
            "rejected" => $doctor_rejected,
            "createdAt" => $doctor_createdAt,
            "hospitalName"=> $request->doctor_hospitalName,
            "photoUrl"=>$request->doctor_photoUrl,
            "regNo" => $request->doctor_regNo,
            "registrationStat" => $request->doctor_registrationStat,
            "welcomed" => $doctor_welcomed
        ];




        $patient_createdAt = date('Y-m-d h:i:s',strtotime($request->patient_createdAt));

        if($request->patient_active == true && $request->patient_active == 'true'){
            $patient_active = 1;
        }else{
            $patient_active = 0;
        }

        if($request->patient_hospitalized == true && $request->patient_hospitalized == 'true'){
            $patient_hospitalized = 1;
        }else{
            $patient_hospitalized = 0;
        }

        if($request->patient_online == true && $request->patient_online == 'true'){
            $patient_online = 1;
        }else{
            $patient_online = 0;
        }

        $patient = [
            'uid'=> $request->patient_uid,
            //'approve' => '',
            'online' => $patient_online,
            'active'=> $patient_active,
            'email'=> $request->patient_email,
            'name'=> $request->patient_name.' '.$request->lastname,
            //'lastname' => $request->lastname,
            'phone' => $request->patient_phone,
            'password' => $request->patient_password,
            'gender' => $request->patient_gender,
            'weight' => $request->patient_weight,
            'height' => $request->patient_height,
            'bloodGroup' => $request->patient_bloodGroup,
            'totalCount' => $request->patient_totalCount,
            'totalRating' => $request->patient_totalRating,
            'price' => $request->patient_price,
            'regNo' => $request->patient_regNo,
            'medication' => $request->patient_medication,
            'smoke' => $request->patient_smoke,
            'photoUrl' => $request->patient_photoUrl,
            'hospitalUid' => $request->patient_hospitalUid,
            'hospitalized' => $patient_hospitalized,
            'doctorType' => $request->patient_doctorType,
            'district' => $request->patient_district,
            'districtId' => $request->patient_districtId,
            'createdAt' => $patient_createdAt,
        ];



        $callStartTime = date('Y-m-d h:i:s',strtotime($request->callStartTime));
        $callEndTime = date('Y-m-d h:i:s',strtotime($request->callEndTime));
        
        $transaction_createdDate = date('Y-m-d h:i:s',strtotime($request->transaction_createdDate));


        if($request->patientRated == true && $request->patientRated == 'true'){
            $patientRated = 1;
        }else{
            $patientRated = 0;
        }

        if($request->doctorRated == true && $request->doctorRated == 'true'){
            $doctorRated = 1;
        }else{
            $doctorRated = 0;
        }

        if($request->prescriptionUpdated == true && $request->prescriptionUpdated == 'true'){
            $prescriptionUpdated = 1;
        }else{
            $prescriptionUpdated = 0;
        }


        $transactionHistory = [
            'createdDate' => $transaction_createdDate,
            'discountPercentage' => $request->transaction_discountPercentage,
            'discountedValue' => $request->transaction_discountedValue,
            'refundAmount' => $request->transaction_refundAmount,
            'serviceFee' => $request->transaction_serviceFee,
            'subTotal' => $request->transaction_subTotal,
            'subTotalRounded' => $request->transaction_subTotalRounded,
            'surgeValue' => $request->transaction_surgeValue,
            'timeCost' => $request->transaction_timeCost,
            'totalTimeInSeconds' => $request->transaction_totalTimeInSeconds,
            'visitFee' => $request->transaction_visitFee
        ];


        $data = [
            
            'doctor' => json_encode($doctor),
            'patient' => json_encode($patient),
            'transactionHistory' => json_encode($transactionHistory),

            'callEndTime' => $callEndTime,
            'callStartTime' => $callStartTime,
            
            'doctorRated' => $doctorRated,
            'doctorRatingByPat' => $request->doctorRatingByPat,
            'doctorType' => $request->doctorType,
            'doctorUid' => $request->doctorUid,
            
            'latitudePatient' => $request->latitudePatient,
            'longitudePatient' => $request->longitudePatient,
            
            'patientUid' => $request->patientUid,
            'patientRated' => $patientRated,
            'patientRatingByDoc' => $request->patientRatingByDoc,
            
            'prescriptionId' => $request->prescriptionId,
            'prescriptionUpdated' => $prescriptionUpdated,
            
            'visitId' => $request->visitId
        ];



        if(Visits::create($data)){
            return response()->json([
                "error" => "false",
                "message" => "Transaction information added successfully" ],200);
        }else{
            return response()->json([
                "error" => "true",
                "message" => "Can't add transaction information. Something went wrong."],200);
        }
        
    }

    public function rating(Request $request)
    {
        try{ 
            
        if($request->doctorRated == true && $request->doctorRated == 'true'){
            $doctorRated = 1;
        }else{
            $doctorRated = 0;
        }

        $data = [
            'visitId' => $request->visitId,
            'doctorRated' => $doctorRated, //means patient rated
            'doctorRatingByPat' => $request->doctorRatingByPat,
        ];

        // dd($data);

        if(Visits::where('visitId',$request->visitId)->update($data)){
            return response()->json([
                "error" => "false",
                "message" => "Doctor rated successfully" ],200);
        }else{
            return response()->json([
                "error" => "true",
                "message" => "Can't add Doctor rated information. Something went wrong."],200);
        }
        
        } catch(\Exception $e){
            Log::info($e);
        }
    }

    public function PrescriptionUpdate(Request $request)
    {
      //try{
            
        if($request->prescriptionUpdated == true && $request->prescriptionUpdated == 'true'){
            $prescriptionUpdated = 1;
        }else{
            $prescriptionUpdated = 0;
        }

        $data = [
            'prescriptionId' => $request->prescriptionId,
            'prescriptionUpdated' => $prescriptionUpdated,
            'visitId' => $request->visitId
        ];

        if(Visits::where('visitId',$request->visitId)->update($data)){
            return response()->json([
                "error" => "false",
                "message" => "Prescription updated successfully" ],200);
        }else{
            return response()->json([
                "error" => "true",
                "message" => "Can't add prescription information. Something went wrong."],200);
        }
        
    /* } catch(\Exception $e){
        Log::info($e);
    } */
    }

    public function transactionHistory(Request $request)
    {
        $date = date('d-m-Y');

        $callStartTime = date('Y-m-d h:i:s',strtotime($request->callStartTime));
        $callEndTime = date('Y-m-d h:i:s',strtotime($request->callEndTime));

        if($request->patientRated == true && $request->patientRated == 'true'){
            $patientRated = 1;
        }else{
            $patientRated = 0;
        }
        
        $transactionHistory = [
            // 'createdDate' => $request->transaction_createdDate,
            'createdDate' => $date,
            'discountPercentage' => $request->discountPercentage,
            'discountedValue' => $request->discountedValue,
            'refundAmount' => $request->refundAmount,
            'serviceFee' => $request->serviceFee,
            'subTotal' => $request->subTotal,
            'subTotalRounded' => $request->subTotalRounded,
            'surgeValue' => $request->surgeValue,
            'timeCost' => $request->timeCost,
            'totalTimeInSeconds' => $request->totalTimeInSeconds,
            'visitFee' => $request->visitFee
        ];

        $data = [
            'transactionHistory' => json_encode($transactionHistory),
            'callEndTime' => $callEndTime,
            'patientRated' => $patientRated, //means doctor rated so is 
            'patientRatingByDoc' => $request->patientRatingByDoc,
            'visitId' => $request->visitId
        ];

        if(Visits::where('visitId',$request->visitId)->update($data)){
            return response()->json([
                "error" => "false",
                "message" => "Transaction history added successfully" ],200);
        }else{
            return response()->json([
                "error" => "true",
                "message" => "Can't add transaction history information. Something went wrong."],200);
        }
    }
}
