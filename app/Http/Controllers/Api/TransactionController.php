<?php

namespace App\Http\Controllers\Api;

use App\Doctor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Visits;
use Google\Cloud\Core\Timestamp;
use DateTime;

class TransactionController extends Controller
{
    public function transaction(Request $request)
    {
        $doctor = [
            'uid' => $request->doctor_uid,
            'dateOfBirth' => $request->doctor_dateOfBirth,
            'district' => $request->doctor_district,
            'districtId' => $request->doctor_districtId,
            'active'=> $request->doctor_active,
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
            "hospitalized" => $request->doctor_hospitalized,
            "online" => $request->doctor_online,
            "rejected" => $request->doctor_rejected,
            "createdAt" => $request->doctor_createdAt,
            "hospitalName"=> $request->doctor_hospitalName,
            "photoUrl"=>$request->doctor_photoUrl,
            "regNo" => $request->doctor_regNo,
            "registrationStat" => $request->doctor_registrationStat,
            "welcomed" => $request->doctor_welcomed
        ];

        $patient = [
            'uid'=> $request->patient_uid,
            //'approve' => '',
            'online' => $request->patient_online,
            'active'=> $request->patient_active,
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
            'hospitalized' => $request->patient_hospitalized,
            'doctorType' => $request->patient_doctorType,
            'district' => $request->patient_district,
            'districtId' => $request->patient_districtId,
            'createdAt' => $request->patient_createdAt,
        ];

        $transactionHistory = [
            'createdDate' => $request->transaction_createdDate,
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
            'callEndTime' => $request->callEndTime,
            'callStartTime' => $request->callStartTime,
            'doctorRated' => $request->doctorRated,
            'doctorRatingByPat' => $request->doctorRatingByPat,
            'doctorType' => $request->doctorType,
            'doctorUid' => $request->doctorUid,
            'latitudePatient' => $request->latitudePatient,
            'longitudePatient' => $request->longitudePatient,
            'patientUid' => $request->patientUid,
            'patientRated' => $request->patientRated,
            'patientRatingByDoc' => $request->patientRatingByDoc,
            'prescriptionId' => $request->prescriptionId,
            'prescriptionUpdated' => $request->prescriptionUpdated,
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
}
