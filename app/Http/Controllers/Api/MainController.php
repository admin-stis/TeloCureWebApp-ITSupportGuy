<?php

namespace App\Http\Controllers\Api;

use App\Doctor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Prescription;
use App\Refund;
use App\TreatmentRequest;
use App\User;
use App\Visits;
use App\Vital;
use DB;
use Google\Cloud\Core\Timestamp;
use DateTime;

class MainController extends Controller
{
    public function vitals(Request $request)
    {
        $date = date('Y-m-d h:i:s',strtotime($request->measureTime)); 

        $data = [
           'id' => $request->pId,
           'bpm' => $request->bpm,
           'measureTime' => $date,
           'pId' => $request->pId,
           'resp' => $request->resp,
           'temp' => $request->temp,
        ];

        if(Vital::updateOrCreate(['id' => $request->pId],$data)){
            return response()->json([
                "error" => "false",
                "message" => "vital information added or updated successfully" ],200);
        }else{
            return response()->json([
                "error" => "true",
                "message" => "Can't add vital information. Something went wrong."],200);
        }
    }

    public function refund(Request $request)
    {
        $date = strtotime($request->updatedTime);
        $dt = date('Y-m-d h:i:s',$date);

        $data = [
            'id' => $request->patientId,
            'balance' => $request->balance,
            'updatedTime' => $dt
        ];

        if(Refund::updateOrCreate(['id' => $request->patientId],$data)){
            return response()->json([
                "error" => "false",
                "message" => "refund information added or updated successfully" ],200);
        }else{
            return response()->json([
                "error" => "true",
                "message" => "Can't add refund information. Something went wrong."],200);
        }

    }

    public function treatmentRequest(Request $request)
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
            'id' => $request->doctor_uid,
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
            'id'=> $request->patient_uid,
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

        $district = [
            'active' => $request->dis_active,
            'bn_name' => $request->dis_bn_name,
            'discount' =>$request->dis_discount,
            'division_id' =>$request->dis_division_id,
            'est_price' =>$request->dis_est_price,
            'id' =>$request->dis_id,
            'lat' =>$request->dis_lat,
            'lon' =>$request->dis_lon,
            'max_price'=>$request->dis_max_price,
            'min_price'=>$request->dis_min_price,
            'name'=>$request->dis_name
        ];

        $callStartTime = date('Y-m-d h:i:s',strtotime($request->callStartTime));
        $callEndTime = date('Y-m-d h:i:s',strtotime($request->callEndTime));

        $data = [
            'id' => $request->patientId,
            'callEndTime' => $callEndTime,
            'callStartTime' => $callStartTime,
            'cardType' => $request->cardType,
            'doctorId' => $request->dId,
            'doctorType' => $request->doctorType,
            'latitudePatient' => $request->latitudePatient,
            'longitudePatient' => $request->longitudePatient,
            'newZoneRequest' => $request->newZoneRequest,
            'paidAmount' => $request->paidAmount,
            'patientId' => $request->patientId,
            'prescriptionId' => $request->prescriptionId,
            'prescriptionUpdated' => $request->prescriptionUpdated,
            'roomId'=> $request->roomId ,
            'stat' => $request->stat,
            'surge' => $request->surge,
            'treatmentId' => $request->treatmentId,
            'visitId' => $request->visitId,
            'vitalUpdate' => $request->vitalUpdate,
            'doctor' => json_encode($doctor),
            'patient' => json_encode($patient),
            'district' => json_encode($district),
        ];

        //dd($data);

        if(TreatmentRequest::updateOrCreate(['id' => $request->patientId],$data)){
            return response()->json([
                "error" => "false",
                "message" => "TreatmentRequest information added or updated successfully" ],200);
        }else{
            return response()->json([
                "error" => "true",
                "message" => "Can't add treatment request information. Something went wrong."],200);
        }
    }

    public function prescription(Request $request)
    {
        $mDate = date('Y-m-d h:i:s',strtotime($request->measureTime));

        $vital = [
           'bpm' => $request->bpm,
           'measureTime' => $mDate,
           'pId' => $request->pId,
           'resp' => $request->resp,
           'temp' => $request->temp,
        ];

        $createdDate = date('Y-m-d h:i:s',strtotime($request->createdDate));

        //
        $data = [
            'comment' => $request->comment, //check field added n mysql new
            'createdDate' => $createdDate,
            'doctorId' => $request->doctorId,
            'medicineMap' => $request->medicineMap,
            'patientId' => $request->patientId,
            'prescriptionId' => $request->prescriptionId,
            'visitId' => $request->visitId,
            'vital' => json_encode($vital)
        ];

        // echo '<pre>';
        // print_r($request->medicineMap);
        // print_r(json_encode($vital));
        // dd(1);

        $presData = Prescription::where('prescriptionId',$request->prescriptionId)->get()->toArray();
        
        if(!empty($presData)){
            if(Prescription::where('prescriptionId' , $request->prescriptionId)->update($data)){
                return response()->json([
                    "error" => "false",
                    "message" => "Prescription information updated successfully" ],200);
            }else{
                return response()->json([
                    "error" => "true",
                    "message" => "Can't update Prescription information. Something went wrong."],200);
            }
        }

        else{
            // dd($request->prescriptionId);
            if(DB::insert('insert into prescriptions ( doctorId,medicineMap,patientId,prescriptionId,visitId,vital,createdDate) values (?,?,?,?,?,?,?)', [ $request->doctorId,json_encode($request->medicineMap),$request->patientId,$request->prescriptionId,$request->visitId,json_encode($vital),$createdDate])){
                return response()->json([
                    "error" => "false",
                    "message" => "Prescription information added successfully" ],200);
            }else{
                return response()->json([
                    "error" => "true",
                    "message" => "Can't add Prescription information. Something went wrong."],200);
            }
        }

        // if(Prescription::updateOrCreate(['prescriptionId' => $request->prescriptionId],$data)){
        //     return response()->json([
        //         "error" => "false",
        //         "message" => "Prescription information added or updated successfully" ],200);
        // }else{
        //     return response()->json([
        //         "error" => "true",
        //         "message" => "Can't add Prescription information. Something went wrong."],200);
        // }
    }
}
