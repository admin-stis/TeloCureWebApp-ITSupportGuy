<?php 
 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth\MailSendController;
use Log;
//use Artisan; //for artisan command execute without command line 

class CronController extends Controller
{
    public function test_form(Request $request)
    {
      
    }
    public function processcron(Request $request)
    {             

        //check if the request came from cron job or not
        if($request->token=="v12788")
        {
            
        try{
            
        $logdata = "request started, ";
        //Log::info("request came");
        $firestore = app('firebase.firestore');
        $realtime_db = app('firebase.database');
        
        $db = $firestore->database();
        $doctorRef = $db->collection('doctors');
        $frb_tz = new \DateTimeZone('Asia/Dhaka');
        
        $query = $doctorRef->where('online','=',true)->where('rejected','=',false);
        $onlineDoctor = $query->documents();
        $onlineDoctorList = array();
        foreach ($onlineDoctor as $doctor) {
            if($doctor->exists()){
                $data = $doctor->data();
                if($data['online']){  
                    //start processing if not engaged
                    if(isset($data['engaged']) && $data['engaged']==true)
                    { } else {                    
                    //array_push($onlineDoctorList, $doctor->data());                                   
                    //start processing                                         
                    if(isset($data['onlineTime']) && $data['onlineTime'] != null)
                    {
                    $onlinetime = new \DateTime($data['onlineTime']);                    
                    $onlinetime->setTimezone($frb_tz);                                        
                    $datenow = new \DateTime('now');
                    $datenow->setTimezone($frb_tz);
                    
                    $diff = $onlinetime->diff($datenow);                    
                    $hours = $diff->h;
                    $hours = $hours + ($diff->days*24); 
                    if($hours>=6){                         
                        $docUid = $data['uid'];
                        $docType = strtoupper($data['doctorType']);
                        $docDistrict = strtoupper($data['district']);
                        
                        //update online fields in firestore db
                        $docRefExec = $doctorRef->document($docUid);
                        //$snapsot = $docRef->snapshot();                        
                        $docRefExec->set([
                            'online'=>false, 'onlineTime'=>null
                        ],['merge' => true]);
                        
                        //now delete user in firebase realtime db 
                        if($realtime_db->getReference(''.$docDistrict.'/'.$docType.'/'.$docUid.'')->getSnapshot()->exists()) { 
                            //deletion code here
                            $realtime_db->getReference(''.$docDistrict.'/'.$docType.'/'.$docUid.'')->remove();                            
                        }  
                        
                        //now delete user in firebase realtime db in doctorstatus->all node
                        if($realtime_db->getReference('doctorsStatus/ALL/'.$docUid.'')->getSnapshot()->exists()) {
                            //deletion code here
                            $realtime_db->getReference('doctorsStatus/ALL/'.$docUid.'')->remove();
                        }
                        
                        //now delete user in firebase realtime db in doctorstatus->dhaka node
                        if($realtime_db->getReference('doctorsStatus/'.$docDistrict.'/'.$docUid.'')->getSnapshot()->exists()) {
                            //deletion code here
                            $realtime_db->getReference('doctorsStatus/'.$docDistrict.'/'.$docUid.'')->remove();
                        }
                        
                        $logdata.=" Doc offline-".$docUid;
                    }                                        
                    } //if onlineTime isset condition ends
                    else{
                        //still make them offline to make them contact and then force them to update latest fixed app
                        $docUid = $data['uid'];
                        $docType = strtoupper($data['doctorType']);
                        $docDistrict = strtoupper($data['district']);
                        
                        //update online fields in firestore db
                        $docRefExec = $doctorRef->document($docUid);
                        //$snapsot = $docRef->snapshot();
                        $docRefExec->set([
                            'online'=>false, 'onlineTime'=>null
                        ],['merge' => true]);
                        
                        //now delete user in firebase realtime db
                        if($realtime_db->getReference(''.$docDistrict.'/'.$docType.'/'.$docUid.'')->getSnapshot()->exists()) {
                            //deletion code here
                            $realtime_db->getReference(''.$docDistrict.'/'.$docType.'/'.$docUid.'')->remove();
                        }
                        
                        //now delete user in firebase realtime db in doctorstatus->all node
                        if($realtime_db->getReference('doctorsStatus/ALL/'.$docUid.'')->getSnapshot()->exists()) {
                            //deletion code here
                            $realtime_db->getReference('doctorsStatus/ALL/'.$docUid.'')->remove();
                        }
                        
                        //now delete user in firebase realtime db in doctorstatus->dhaka node
                        if($realtime_db->getReference('doctorsStatus/'.$docDistrict.'/'.$docUid.'')->getSnapshot()->exists()) {
                            //deletion code here
                            $realtime_db->getReference('doctorsStatus/'.$docDistrict.'/'.$docUid.'')->remove();
                        }
                        
                        $logdata.=" Doc offline onlinetime null or not exists -".$docUid;
                    }
                } //engaged field false condition ends
               } //if online = true condition ends 
            } //if doc exists condition ends
        } //foreach ends
        
        Log::info("cron job data: ".$logdata);
        
        } catch(\Exception $e){
            Log::error("Error in cron job: ".$e);
        }
        } 
        //dd($onlineDoctorList);                            
       
    }
}
