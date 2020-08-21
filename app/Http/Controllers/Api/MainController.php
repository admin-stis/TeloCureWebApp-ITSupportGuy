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
        $data = [
           'id' => $request->pId,
           'bpm' => $request->bpm,
           'measureTime' => $request->measureTime,
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
        $data = [
            'id' => $request->patientId,
            'balance' => $request->balance,
            'updatedTime' => $request->updatedTime
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
        $doctor = [
            'id' => $request->doctor_uid,
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
            'id'=> $request->patient_uid,
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

        $district = [
            'active' => $request->active,
            'bn_name' => $request->bn_name,
            'discount' =>$request->discount,
            'division_id' =>$request->division_id,
            'est_price' =>$request->est_price,
            'id' =>$request->id,
            'lat' =>$request->lat,
            'lon' =>$request->lon,
            'max_price'=>$request->max_price,
            'min_price'=>$request->min_price,
            'name'=>$request->name
        ];

        $data = [
            'id' => $request->patientId,
            'callEndTime' => $request->callEndTime,
            'callStartTime' => $request->callStartTime,
            'cardType' => $request->cardType,
            'dId' => $request->dId,
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
        $vital = [
           'bpm' => $request->bpm,
           'measureTime' => $request->measureTime,
           'pId' => $request->pId,
           'resp' => $request->resp,
           'temp' => $request->temp,
        ];

        $createdDate = $request->createdDate;

//
        $data = [
            //'comment' => $request->comment,
            //'createdDate' => $createdDate,
            'doctorId' => $request->doctorId,
            'medicineMap' => json_encode($request->medicineMap),
            'patientId' => $request->patientId,
            'prescriptionId' => $request->prescriptionId,
            'visitId' => $request->visitId,
            'vital' => json_encode($vital)
        ];

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
            if(DB::insert('insert into prescriptions ( doctorId,medicineMap,patientId,prescriptionId,visitId,vital) values (?,?,?,?,?,?)', [ $request->doctorId,json_encode($request->medicineMap),$request->patientId,$request->prescriptionId,$request->visitId,json_encode($vital)])){
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
