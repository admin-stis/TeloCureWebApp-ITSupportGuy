<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Auth\MailSendController;
use Mail;
use Log;

/* require_once 'dompdf/autoload.php';
use Dompdf\Dompdf; */
//include mpdf
require_once 'mpdf/autoload.php';

class PrescriptionDownloadController extends Controller
{
    public function prescriptiondownload(Request $request)
    {
        /////////////// reminder //////////////////
        
        ////for test changes like telocure will be telocuretest.com and public path to be changed too 
        
        //////////////////////////////////////////
        try{
            //dd(public_path("prescription\doc.png"));
            //visit id test 8mG2Z2d9sAFjPTDaBFip
            $resp = "";
            $temp = "";
            $bpm = ""; $comment = ""; $disease=""; $frb_date = ""; $medicines = "";
            $frb_tz = new \DateTimeZone('Asia/Dhaka');
            
            //dd($date_prs_create);
            //dd($date_prs_create->format('d-m-y'));
            
            $visit_id = $request->visit_id;
            //for test visit id
            //$visit_id = "8mG2Z2d9sAFjPTDaBFip";
            //$data['bank_info'] = $docCollection->document($value["doctor"]['uid'])->collection('bank_info')->document($value["doctor"]['uid'])->snapshot()->data();
            $firestore = app('firebase.firestore');
            $database = $firestore->database();
            
            $visits = $database->collection('visits');
            $data['visit_doc'] = $visits->document($visit_id)->snapshot()->data();
            //dd($data['visit_doc']['doctor']['email']);
            if(isset($data['visit_doc']) && $data['visit_doc'] != null){
                //get ids to get data
                $doctor_id = $data['visit_doc']['doctorUid'];
                $patient_id = $data['visit_doc']['patientUid'];
                $pres_id = $data['visit_doc']['prescriptionId'];
                //get doctor info
                $doctor_name = $data['visit_doc']['doctor']['name'];
                $doctor_type = $data['visit_doc']['doctor']['doctorType'];
                $doctor_type_ext = "";
                if($doctor_type=="GENERAL"){
                    $doctor_type_ext = "General Practitioner";
                }
                if($doctor_type=="PEDIATRIC"){
                    $doctor_type_ext = "Pediatrician";
                }
                
                $doctor_reg = $data['visit_doc']['doctor']['regNo'];
                //get patient info
                $patient_name = $data['visit_doc']['patient']['name'];
                $patient_phone = $data['visit_doc']['patient']['phone'];
                $patient_gender = $data['visit_doc']['patient']['gender'];
                $patient_blood = $data['visit_doc']['patient']['bloodGroup'];
                $patient_dobirth = $data['visit_doc']['patient']['dateOfBirth']; //it's a string in firebase! so no need to format
                //no prescription id so prescription not given or initiated
                //check if no prescrtion then whether pdf will be created or not
                //ask for prescription id for that
                if(isset($data['visit_doc']['prescriptionId'])) {
                    //
                    $prescriptions = $database->collection('prescription');
                    $data['pres_doc'] = $prescriptions->document($patient_id)->collection($doctor_id)->document($pres_id)->snapshot()->data();
                    //dd($data['pres_doc']);
                    $frb_date = new \DateTime($data['pres_doc']['createdDate']);
                    $frb_date->setTimezone($frb_tz);
                    
                    //check if pdf file already exists or not
                    
                    $pres_file_name_chk = $frb_date->format('d-m-Y')."-pr-".$visit_id.".pdf";
                    //$url = "https://telocure.com/api/downloadprc/".$pres_file_name."";
                    
                    //$image_name = substr($profile_pic,(((int)strpos($profile_pic,"/api/download/"))+14));
                    $file_path_chk = public_path('prescription/'.$pres_file_name_chk.'');
                    if(\Illuminate\Support\Facades\File::exists($file_path_chk)) {
                        $url = "https://telocuretest.com/api/downloadprc/".$pres_file_name_chk."";
                        //// \Illuminate\Support\Facades\File::delete($file_path);
                        
                        Log::info("prescription download api call and pres exists and sent, visit id -".$visit_id);
                        
                        return response()->json([
                            'error'=> 'false',
                            'message' => 'prescription link generated successfully',
                            'prescription_url' => $url],200);
                        
                    }
                    
                    //dd($frb_date->format('d-m-y')); //echo $frb_date->format('d-m-y  h:i:s A');
                    //following fields are there even if null so isset checks not required
                    $disease = $data['pres_doc']['disease'];
                    if(isset($disease)){} else { $disease = "N/A"; }
                    
                    if(isset($data['pres_doc']['diagnosis'])) { $diagnosis = $data['pres_doc']['diagnosis']; if(isset($diagnosis)){} else { $diagnosis = "N/A"; } }
                    else { $diagnosis = "N/A"; }
                    //make isset condition before putting content in html
                    if(isset($data['pres_doc']['vital'])){
                        $resp = ($data['pres_doc']['vital']['resp']==null || $data['pres_doc']['vital']['resp']=="") ? "N/A" : $data['pres_doc']['vital']['resp'] ;
                        $temp = ($data['pres_doc']['vital']['temp']==null || $data['pres_doc']['vital']['temp']=="") ? "N/A" : $data['pres_doc']['vital']['temp'] ;
                        $bpm =  ($data['pres_doc']['vital']['bpm']==null || $data['pres_doc']['vital']['bpm']=="") ? "N/A" : $data['pres_doc']['vital']['bpm'];
                    }
                    if(isset($data['pres_doc']['comment'])) { $comment = $data['pres_doc']['comment']; }
                    //dd($data['pres_doc']['vital']['bpmm']);//it throws undefined index bpmm error
                    //medicine data
                    //following fields are there even if null so isset checks not required
                    $medicines = "";
                    if(isset($data['pres_doc']['medicineMap'])){
                        for($i=0; $i<count($data['pres_doc']['medicineMap']); $i++){
                            $med_comment = "";
                            if(isset($data['pres_doc']['medicineMap']["".($i+1).""]['comment'])) {
                                $med_comment = "<br/>&nbsp;&nbsp;&nbsp;&nbsp;".$data['pres_doc']['medicineMap']["".($i+1).""]['comment'];
                            }
                            
                            $medicines.= "<div class='info_part_med_div'>".($i+1).". ".$data["pres_doc"]["medicineMap"]["".($i+1).""]["name"]." ".
                                $data['pres_doc']['medicineMap']["".($i+1).""]['morning']."+".$data['pres_doc']['medicineMap']["".($i+1).""]['noon']."+".$data['pres_doc']['medicineMap']["".($i+1).""]['night']." ".$med_comment."</div>";
                        }}
                }
                //check can be made earlier before getting visit data
                else {
                    Log::error("Error : prescription id not exists on prescription download api call");
                    return response()->json(['error'=> 'true', 'message' => 'prescription id not exists'],201);
                }
                
                $mpdf = new \Mpdf\Mpdf([
                    'mode' => 'utf-8', 'format' => 'A4-P'
                ]);
                
                $mpdf->SetProtection(array('print'));
                $mpdf->SetTitle("Telocure Prescription");
                $mpdf->SetAuthor("Telocure");
                $mpdf->SetDisplayMode('fullpage');
                
                $html = '<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <title>Telocure Prescription</title>
</head>
<body>
<style>
body {font-family: freeserif, arial; font-size: 15px; margin:0; padding:0; line-height: 1.15;
  color: black;
  text-align: left;
  background-color: #fff;
}
p {	margin: 0px; }
.info_part_div {
margin-top:3px;
}
.info_part_med_div {
margin-top:6px;
}
</style>
                    
<div style="text-align: right;margin:10px 0 10px 0;">Date: '.$frb_date->format('d-m-y  h:i:s A').'</div>
    
<div style="border-top:2px solid gray; border-right:2px solid gray; border-bottom:1px solid gray; border-left:2px solid gray;">
<div width="45%" style="float:left;text-align:left;"><div style="margin:10px 0 10px 8px;"><div style="font-size:16px;font-weight:bold;font-family: freeserif, nikosh_bangla;">Dr. '. $doctor_name .'</div><div class="info_part_div">'.$doctor_type_ext.'</div><div class="info_part_div">BMDC Reg No: '. $doctor_reg .'</div></div></div>
<div width="55%" style="float:left; text-align:left;"><div style="margin:10px 0 10px 8px;"><div style="font-size:16px;font-weight:bold;">Patient\'s Info :</div><div class="info_part_div" style="font-size:16px; text-transform: capitalize;font-family: freeserif, nikosh_bangla;">'.$patient_name.'</div><div class="info_part_div">Gender: '.$patient_gender.'</div><div class="info_part_div">Date of Birth: '.$patient_dobirth.'</div><div class="info_part_div">Blood Group: '.$patient_blood.'</div></div> </div>
</div>
    
<div style="clear:both;"></div>
    
<div style="border-top:1px solid gray; border-right:2px solid gray; border-bottom:2px solid gray; border-left:2px solid gray;">
<div width="45%" style="margin: 0;float:left;text-align:left;">
<div style="padding:10px 4px 0 8px; border-right:2px solid gray;">
    
<div style="margin:0 0 10px 0;font-size:18px;">Disease name</div>
<div class="info_part_div" style="font-family: freeserif, nikosh_bangla;">'.$disease.'</div>
<hr/>

<div style="margin:0 0 10px 0;font-size:18px;">Advice for investigations</div>
<div class="info_part_div" style="font-family: freeserif, nikosh_bangla;">'.$diagnosis.'</div>
<hr/>

<div style="margin:4px 0 10px 0;">
<div style="font-size:18px; margin:0 0 10px 0;">Vital Test Report</div>
<div>BPM &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; '.$bpm .' <br /><br />
Respiratory Rate &nbsp;&nbsp; '.$resp.' <br /><br />
Temperature &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; '.$temp.' <br />
</div>
</div>
<hr/>
    
<div style="margin:4px 0 10px 0; font-family: freeserif, nikosh_bangla;">
<div style="margin:0 0 10px 0;font-size:18px;">Doctor\'s Comment</div>
<div>'.$comment.'
</div>
</div>
</div></div>
    
<div width="55%" style="margin:0;float:left;text-align:left;">
<div style="padding:10px 4px 0 8px;">
    
<div style="margin:0 0 10px 0; font-size:26px; color:black;">Rx</div>
<div style="margin:0 0 10px 0;font-size:18px;">Prescribed Medicine</div>
<div style="font-family: freeserif, nikosh_bangla;">
'.$medicines.'
<!-- 1 mood on 10mg 1 + 1 + 1<br/><br/>
2 napa 500mg 1 + 0 + 1<br/><br/> -->
</div>
</div></div>
    
<div style="clear:both"></div> </div>
    
<div style="text-align: center; font-style: italic; font-size:16px; margin-top:20px; color:red;">N:B This Prescription will be expired after 30 days from noted date.</div>
    
  </body>
</html>';
                
                $mpdf->WriteHTML($html);
                //include date and pres id in pres pdf file
                //here date format to be put in name, Y should be capital Y $frb_date->format('d-m-y')
                $pres_file_name = $frb_date->format('d-m-Y')."-pr-".$visit_id.".pdf";
                $url = "https://telocuretest.com/api/downloadprc/".$pres_file_name."";
                ////file_put_contents(public_path('prescription\\'.$pres_file_name.''), $output); //// for local
                //file_put_contents(public_path('prescription/'.$pres_file_name.''), $output); //for server look for / not \\ as in local
                
                //$mpdf->Output();
                $mpdf->Output(public_path('prescription/'.$pres_file_name.''),'F');
                
                //following shows error
                //$output->move(public_path('prescription'), "pres.pdf");
                //$url = "https://telocure.com/api/download/".$fileName;
                
                Log::info("prescription download api call and pres generated, visit id -".$visit_id);
                
                return response()->json([
                    'error'=> 'false',
                    'message' => 'prescription link generated successfully',
                    'prescription_url' => $url],200);
                
                //return response()->json(['error'=> 'true', 'message' => 'File uploaded unsuccess'],201);
                
            } else {
                Log::error("Errors in prescription download api call as visit data not exists");
                return response()->json(['error'=> 'true', 'message' => 'visit not exists'],201);
            }
        } catch(\Exception $e){
            Log::error("Errors in prescription download api call for visit id: ".$e);
            return response()->json(['error'=> 'true', 'message' => 'Error found while generating prescription link'],201);
        }
        
        
    }
    
}
