<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\sendEmail;
use Illuminate\Support\Facades\Session;
use Google\Cloud\Core\Timestamp;
use DateTime;
use Mail;
use Illuminate\Support\Facades\Validator;

// morshed 28/07/2020
use App\Doctor;
use App\Hospital;
use App\User;
use App\Visits;
use App\HospitalBranch;
use App\Hospital_users;
// end

// include composer autoload
require 'custom_vendor/autoload.php';

// import the Intervention Image Manager Class
use Intervention\Image\ImageManager;

class AdminDoctorController extends Controller
{
    public function index()
    {
      /*
      $firestore = app('firebase.firestore');
      $db = $firestore->database();
      $doctorRef = $db->collection('doctors');

      $data['doctors'] = $doctorRef->documents();
      $data['doctorList'] = array();

      $data['totalDoctor'] = 0 ;
      foreach($data['doctors'] as $key=>$doctor){
        array_push($data['doctorList'],$doctor->data());
        $data['totalDoctor']++;
      }
      */
      $data['doctorList'] = Doctor::get()->toArray();
      
      $data['totalDoctor'] = Doctor::count();

      $data['pendingDoctor'] = array() ;
      $data['noOfPendingDoctor'] = 0 ;
      //$pendingDoctor = $doctorRef->where('active','=',false)->where('rejected','=',false)->documents();
      $pendingDoctor = Doctor::where('active','false')->where('rejected','false')->get();
      $data['noOfPendingDoctor'] = Doctor::where('active','false')->where('rejected','false')->count();
      foreach($pendingDoctor as $key=>$doctor){
        //$data['noOfPendingDoctor']++;
        array_push($data['pendingDoctor'],$doctor);
      }
//
      //$data['noOfPendingDoctor'] = count($data['pendingDoctor']);

      //$data['noOfPendingDoctor'] = 0 ;
      foreach($data['pendingDoctor'] as $key=>$pending){
       //   $data['noOfPendingDoctor']++;
      }

      // $approvedDoctor = $doctorRef->where('active','=',true)->where('rejected','=',false)->documents();
      $approvedDoctor = Doctor::where('active','true')->where('rejected','false')->get();
      $data['approvedDoctor'] = Doctor::where('active','true')->where('rejected','false')->count(); ;

      foreach($approvedDoctor as $key=>$doctor){
        //$data['approvedDoctor']++;
      }

      //$rejectDoctor = $doctorRef->where('rejected','=',true)->documents();
      $rejectDoctor = Doctor::where('rejected','true')->get();
      $data['rejectDoctor'] = Doctor::where('rejected','true')->count();
      foreach($rejectDoctor as $key=>$doctor){
        //$data['rejectDoctor']++;
      }

      return view('admin.adminDoctor')->with($data);
    }
    public function doctorProfileEditAction(Request $request)
    {
        //image file save/download link check for test site and prod site telocure.com
        
        /////////////////////////////////
        
        $validator = Validator::make($request->all(), [
            
            'nid' => ['nullable','regex:/^[0-9]+$/'] ,
            //'dateOfBirth' => 'required',
            //'gender' => 'required',
            'name' => 'required',
            'regNo' => 'required',
            //'acadeimcDegree' => 'required',
            'phone' => ['required','regex:/^[0-9]+$/'] ,
            'email' => 'required|email',
            //'presentAddress' => 'required',
            'district' => 'required',
            'doctorType' => 'required',
            
            'degreeCertificate' => 'sometimes|image',
            'photoUrl' => 'sometimes|image',
            'nidFront' => 'sometimes|image',
            'nidBack' => 'sometimes|image',
        ]);
        
        /* When using the regex / not_regex patterns, it may be necessary to specify
         rules in an array instead of using pipe delimiters, especially if the regular
         expression contains a pipe character. */
        
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {
            
            $firestore = app('firebase.firestore');
            $db = $firestore->database();
            //$doctorRef = $db->collection('doctors');
            
            $uid = $request->uid ;
            $url = ""; $durl = ""; $nid_front_url="";  $nid_back_url = '';
            
            /////////////////////////////////////////
            
            
            //need to set telocuretest and telocure urls when used in respective sites
            //in the following process_intv... function
            
            
            ///////////////////////////////////////////
            
            if(isset($request['photoUrl'])){
                /* $fileName = $request['photoUrl']->getClientOriginalName();
                
                $fileName = $uid.''.$fileName;
                $request['photoUrl']->move(public_path('images/profilepic'), $fileName);
                $url = "http://telocuretest.com/api/download/".$fileName; */
                
                $url = $this->process_intv_images($request['photoUrl'], $uid,"profile");
            }
            
            if(isset($request['degreeCertificate'])){
                /*$fileName = $request['degreeCertificate']->getClientOriginalName();
                
                $fileName = $uid.''.$fileName;
                $request['degreeCertificate']->move(public_path('images/profilepic'), $fileName);
                $durl = "http://telocuretest.com/api/download/".$fileName;*/
                $durl = $this->process_intv_images($request['degreeCertificate'], $uid,"degree");
            }
            
            //nid front
            if(isset($request['nidFront'])){
                /* $fileName = $request['nidFront']->getClientOriginalName();
                
                $fileName = $uid.'_nid_front_'.$fileName; //addition
                $request['nidFront']->move(public_path('images/profilepic'), $fileName);
                $nid_front_url = "https://telocuretest.com/api/download/".$fileName;*/
                $nid_front_url = $this->process_intv_images($request['nidFront'], $uid,"nidfront");
            }
            //nid back
            if(isset($request['nidBack'])){
                /* $fileName = $request['nidBack']->getClientOriginalName();
                
                $fileName = $uid.'_nid_back_'.$fileName; //addition
                $request['nidBack']->move(public_path('images/profilepic'), $fileName);
                $nid_back_url = "https://telocuretest.com/api/download/".$fileName; */
                $nid_back_url = $this->process_intv_images($request['nidBack'], $uid,"nidback");
            }
            
            /////////////////////////////////////////
            
            
            //need correction on dateofbirth display and catch form value
            
            
            ///////////////////////////////////////////
            
            if($request->dateOfBirth == '')
                $dob = $request->old_dateOfBirth;
                else $dob = $request->dateOfBirth;
                
                $docRef = $db->collection('doctors')->document($uid);
                //set basic profile info array
                $basicInfo = [
                    'dateOfBirth' => $request->dateOfBirth,
                    'gender' => $request->gender,
                    'name' => $request->name,
                    'regNo' => $request->regNo,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    //'presentAddress' => $request->presentAddress,
                    'district' => $request->district,
                    'doctorType' => $request->doctorType,
                    // Documents
                    //'photoUrl' => $url,
                    
                ];
                //push photourl only if set
                if($url!=""){
                    $basicInfo['photoUrl'] = $url;
                }
                //set doctor others collection data array
                $others = [
                    'nid' => $request->nid,
                    'presentAddress' => $request->presentAddress,
                    'acadeimcDegree' => $request->acadeimcDegree,
                    'otherDegree' => $request->otherDegree,
                    //'branchId' => null
                ];
                
                //set doctor documents collection array
                $docInfo = array();
                if($durl!=""){
                    $docInfo['academicCertificate'] = $durl;
                }
                
                if($nid_front_url!=""){
                    $docInfo['nidFront'] = $nid_front_url;
                }
                if($nid_back_url!=""){
                    $docInfo['nidBack'] = $nid_back_url;
                }
                
                if(count($basicInfo)>0) { $db->collection('doctors')->document($uid)->set($basicInfo,['merge' => 'true']); }
                if(count($docInfo)>0) { $docRef->collection('documents')->document($uid)->set($docInfo,['merge' => 'true']); }
                if(count($others)>0) { $docRef->collection('others')->document($uid)->set($others,['merge' => 'true']); }
                
                Session::flash('update_msg','Profile Updated Successfully.');
                return redirect()->back();
                
        }
    }
    public function doctorProfileEdit($id)
    {
        $firestore = app('firebase.firestore');
        $db = $firestore->database();
        
        /* $doctorRef = $db->collection('doctors');
         $query = $doctorRef->where('uid','=',$id);
         $documents = $query->documents();
         
         $docData = array();
         foreach ($documents as $key => $value) {
         array_push($docData,$value->data());
         }
         
         foreach ($docData as $key => $value) {
         $uid = $value['uid'];
         $hospitalized = $value['hospitalized'];
         } */
        
        $did = $id;
        
        $docRef = $db->collection('doctors')->document($did);
        $data['doctorProfile'] = $docRef->snapshot()->data();
        $data['documents'] = $docRef->collection('documents')->document($did)->snapshot()->data();
        $data['others'] = $docRef->collection('others')->document($did)->snapshot()->data();
        
        
        return view('admin.doctorProfileEdit')->with($data);
    }

    public function docStatus($status_name)
    {
      // dd($status_name);
    	//this status_name should be approve or reject or pending
    	// $firestore = app('firebase.firestore');
   		// $db = $firestore->database();
   		// $doctorRef = $db->collection('doctors');

   		if ($status_name=='approve'){
   			// $query = $doctorRef->where('active','=',true)->where('rejected','=',false);
   			// $approveDOctor = $query->documents();
        $approveDOctor = Doctor::where('active','true')->where('rejected','false')->get();
        $approveDoctor = array();
        foreach ($approveDOctor as $doctor) {
            /*if($doctor->exists()){
                $data = $doctor->data();*/
                //if($data['active']){
                    //array_push($approveDoctor, $doctor->data());
                  array_push($approveDoctor, $doctor);
                //}
            //}
        }

        $approveDoctor['status'] = 'active';

        // echo '<pre>';
        // print_r($approveDoctor);
        // dd(1);

   			return view('admin.approveDoctor')->with('pending_doctor',$approveDoctor);
   			//return all approve doctor
   		}
   		elseif($status_name=='reject'){
   			// $query = $doctorRef->where('rejected','=',true);
   			// $rejectDoctors = $query->documents();
        $rejectDoctors = Doctor::where('rejected','true')->get();
        $reject_doctor = array();
        foreach ($rejectDoctors as $doctor) {
          /*if($doctor->exists()){
            $data = $doctor->data();
            if($data['rejected']==true){*/
              // array_push($reject_doctor, $doctor->data());
              array_push($reject_doctor, $doctor);
            //}
          //}
        }

        $reject_doctor['status'] = 'false';

        return view('admin.approveDoctor')->with('pending_doctor',$reject_doctor);

   			// return $rejectDoctors;
   			//return all rejected docotr

   		}
   		else if($status_name == 'pending'){
            $pending_doctor = array();
      //       $query = $doctorRef->where('active','=',false)->where('rejected','=',false);
   			// $allDoctor = $query->documents();
        $allDoctor = Doctor::where('active','false')->where('rejected','false')->get();
	   		foreach ($allDoctor as $doctor) {
	   			/*if($doctor->exists()){
	   				$data = $doctor->data();*/
	   				// array_push($pending_doctor, $doctor->data());
            array_push($pending_doctor, $doctor);
	   			//}
	   		}
        // return $pending_doctor;
	   		return view('admin.pendingdoctor')->with('pending_doctor',$pending_doctor);
	   		//return pending docotr
   		}

    }

    public function activeDoctor($id)
    {

    	$firestore = app('firebase.firestore');
   		$db = $firestore->database();
   		$docRef = $db->collection('doctors')->document($id);
        $snapsot = $docRef->snapshot();

   		$docRef->set([
   			'active'=>true
   		],['merge' => true]);

       $data = ['message' => 'This message is from hello doc','flag'=>true];
       $send_to = $snapsot['email'];

       Mail::to($send_to)->send(new sendEmail($data));

       //return "Update successfully";
       return redirect()->back();

    }

    public function deactiveDoctor($id)
    {

    	$firestore = app('firebase.firestore');
   		$db = $firestore->database();
   		$docRef = $db->collection('doctors')->document($id);
        $snapsot = $docRef->snapshot();

   		$docRef->set([
            'active'=>false,
            'rejected'=>true
   		],['merge' => true]);

       $data = ['message' => 'This message is from TeloCure','flag'=>true];
       $send_to = $snapsot['email'];

       Mail::to($send_to)->send(new sendEmail($data));

       //return "Update successfully";
       return redirect()->back();

    }

    public function activeUser($id)
    {

    	$firestore = app('firebase.firestore');
   		$db = $firestore->database();
   		$docRef = $db->collection('users')->document($id);
        $snapsot = $docRef->snapshot();

   		$docRef->set([
   			'active'=>true
   		],['merge' => true]);

       $data = ['message' => 'This message is from TeloCure','flag'=>true];
       $send_to = $snapsot['email'];

       Mail::to($send_to)->send(new sendEmail($data));

       //return "Update successfully";
       return redirect()->back();

    }

    public function deactiveUser($id)
    {

    	$firestore = app('firebase.firestore');
   		$db = $firestore->database();
   		$docRef = $db->collection('users')->document($id);
      $snapsot = $docRef->snapshot();

   		$docRef->set([
   			'active'=>false
   		],['merge' => true]);

       $data = ['message' => 'This message is from hello doc','flag'=>true];
       $send_to = $snapsot['email'];

       Mail::to($send_to)->send(new sendEmail($data));

       //return "Update successfully";
       return redirect()->back();

    }


    public function approveDoctor($id)
    {

    	$firestore = app('firebase.firestore');
   		$db = $firestore->database();

      $doctorRef = $db->collection('doctors');
      $query = $doctorRef->where('uid','=',$id);
      $documents = $query->documents();

      // dd($documents);

      $userId = "" ;

      $docData = array();
      foreach ($documents as $key => $value) {
        array_push($docData,$value->data());
      }

      foreach ($docData as $key => $value) {
        $uid = $value['uid'];
        $hospitalized = $value['hospitalized'];
      }

      //if(isset($hospitalized) && $hospitalized == true) $did = substr($uid,2);
      //else $did = $uid;
      $did = $uid;

   	  $docRef = $db->collection('doctors')->document($did);
      $snapsot = $docRef->snapshot();

   		$docRef->set([
   			'active'=>true
   		],['merge' => true]);

      Doctor::where('uid',$did)->update('active','true');

       $data = ['message' => 'This message is from TeloCure','flag'=>true];
       $send_to = $snapsot['email'];


       Mail::to($send_to)->send(new sendEmail($data));

       //return "Update successfully";
       return redirect()->back();

    }

    public function rejectDoctor($id)
    {
    	$firestore = app('firebase.firestore');
    	$db = $firestore->database();

      $doctorRef = $db->collection('doctors');
      $query = $doctorRef->where('uid','=',$id);
      $documents = $query->documents();
      
      $documents = Doctor::where('uid',$id)->get();

      $userId = "" ;

      $docData = array();
      foreach ($documents as $key => $value) {
        array_push($docData,$value);
      }

      foreach ($docData as $key => $value) {
        $uid = $value['uid'];
        $hospitalized = $value['hospitalized'];
      }

    //   if(isset($hospitalized) && $hospitalized == true) $did = substr($uid,2);
    //   else $did = $uid;

      $did = $uid;

      $docRef = $db->collection('doctors')->document($did);
      $snapsot = $docRef->snapshot();
    	$docRef->set([
               'active'=>false,
               'rejected' => true
   		],['merge' => true]);

      $docRefSql = Doctor::where('uid',$did)
                   ->update([
                      'active'=>'false',
                      'rejected' => 'true'
                   ]);

      $data = ['message' => 'This message is from Telocure','flag'=>false];
      $send_to = $snapsot['email'];

      Mail::to($send_to)->send(new sendEmail($data));
      //return "update sucessfully";
      return redirect()->back();
    }

    public function doctorProfileDeleteId($id)
    {
        $firestore = app('firebase.firestore');
        $db = $firestore->database();

        $uid = $id;
        
        $docRef = $db->collection('doctors')->document($uid);
        
        //get data for image urls
        $docRef_data = $docRef->snapshot()->data();
        $data["documents"] = $docRef->collection('documents')->document($uid)->snapshot()->data();
        
        if(isset($docRef_data) && $docRef_data != null){
            $profile_pic= $docRef_data["photoUrl"];
            
            if(($profile_pic!=null)||($profile_pic!="")) {
                $image_name = ""; $file_path="";
                $image_name = substr($profile_pic,(((int)strpos($profile_pic,"/api/download/"))+14));
                $file_path = public_path('images/profilepic/'.$image_name.'');
                if(\Illuminate\Support\Facades\File::exists($file_path)) { \Illuminate\Support\Facades\File::delete($file_path); }
            }
        }
        
        if(isset($data['documents']) && $data['documents'] != null){
            $degree = $data["documents"]["academicCertificate"];
            $nid_front = $data["documents"]["nidFront"];
            $nid_back = $data["documents"]["nidBack"];
            //https://telocuretest.com/api/download/a5403349635f416b8161_profile.jpg
            //dd(substr("https://telocuretest.com/api/download/4b4d6a3d56fd4540a8f8_profile.png",((int)strpos("https://telocuretest.com/api/download/4b4d6a3d56fd4540a8f8_profile.png","/api/download/")+14)));
            
            //use Illuminate\Support\Facades\File
            if(($degree!=null)||($degree!="")) {
                $image_name = ""; $file_path="";
                $image_name = substr($degree,(((int)strpos($degree,"/api/download/"))+14));
                $file_path = public_path('images/profilepic/'.$image_name.'');
                if(\Illuminate\Support\Facades\File::exists($file_path)) { \Illuminate\Support\Facades\File::delete($file_path); }
            }
            if(($nid_front!=null)||($nid_front!="")) {
                $image_name = ""; $file_path="";
                $image_name = substr($nid_front,(((int)strpos($nid_front,"/api/download/"))+14));
                $file_path = public_path('images/profilepic/'.$image_name.'');
                if(\Illuminate\Support\Facades\File::exists($file_path)) { \Illuminate\Support\Facades\File::delete($file_path); }
            }
            if(($nid_back!=null)||($nid_back!="")) {
                $image_name = ""; $file_path="";
                $image_name = substr($nid_back,(((int)strpos($nid_back,"/api/download/"))+14));
                $file_path = public_path('images/profilepic/'.$image_name.'');
                if(\Illuminate\Support\Facades\File::exists($file_path)) { \Illuminate\Support\Facades\File::delete($file_path); }
            }
        }
        
        //now delete all documents in all sub collections too, so taht sub collections gets deleted auto the way it is
        
        $docRef->collection('others')->document($uid)->delete();
        $docRef->collection('documents')->document($uid)->delete();
        $docRef->collection('bank_info')->document($uid)->delete();
        $docRef->collection('balance')->document($uid)->delete();
        $docRef->delete(); 
        
        Session::flash('update_msg','Doctor profile deleted successfully.');
        return redirect()->back();
    }
    public function doctorProfileById($id)
    {
      
      /*
      $firestore = app('firebase.firestore');
      $db = $firestore->database();

      $doctorRef = $db->collection('doctors');
      $query = $doctorRef->where('uid','=',$id);
      $documents = $query->documents();
      */

      $documents = Doctor::where('uid',$id)->get()->toArray();

      $userId = "" ;

      $docData = array();
      foreach ($documents as $key => $value) {
        array_push($docData,$value);
      }

      foreach ($docData as $key => $value) {
        $uid = $value['uid'];
        $hospitalized = $value['hospitalized'];
      }

    //   if(isset($hospitalized) && $hospitalized == true) $did = substr($uid,2);
    //   else $did = $uid;
      $did = $uid;

      /*
        $docRef = $db->collection('doctors')->document($did);
        $data['doctorProfile'] = $docRef->snapshot()->data();
        $data['documents'] = $docRef->collection('documents')->document($did)->snapshot()->data();
        $data['bank_info'] = $docRef->collection('bank_info')->document($did)->snapshot()->data();
        $data['others'] = $docRef->collection('others')->document($did)->snapshot()->data();
      */

      $doctorProfile = Doctor::where('uid',$id)->get();

      foreach ($doctorProfile as $key => $value) {
        $data['doctorProfile'] = $value;
        $data['balance'] = json_decode($value['balance'],TRUE);
        $data['documents'] = json_decode($value['documents'],TRUE);
        $data['bank_info'] = json_decode($value['bank_info'],TRUE);
        $data['others'] = json_decode($value['others'],TRUE);
      }
      
      //for hospital doctor
      //dd($data['others']['branchId']);
      if(isset( $data['others']['branchId']))
        $hospitalBranchId = $data['others']['branchId'];
      else $hospitalBranchId = "";
      //$hospital = $db->collection('hospitalBranch');
      $hospital = HospitalBranch::get()->toArray();

      if($hospitalBranchId != ""){

        //$data['hospitalDetails'] = $hospital->document($hospitalBranchId)->snapshot()->data() ;
        $data['hospitalDetails'] = HospitalBranch::where('branchUid',$hospitalBranchId)->get()->toArray();
        //dd($data['hospitalDetails']);
        if($data['hospitalDetails'] != null){
          
          $data['hinfo'] = $data['hospitalDetails'];
          //dd($data['hinfo']);
         }
        else{
            //dd(2);
            //$hospital = $db->collection('hospital_users');
            //$data['hinfo'] = $hospital->document($hospitalBranchId)->snapshot()->data() ;
            $data['hinfo'] = Hospital_users::where('hospitalUid',$hospitalBranchId)->get()->toArray();
            //dd($data['hosDetails']);
            //$hospitalInfo = $hospital->where('hospitalUserId','=',$hospitalBranchId);
            //  $hData = $hospitalInfo->documents();
            /*  $data['hinfo'] = array();
              foreach ($data['hosDetails'] as $key => $value) {
                  array_push($data['hinfo'], $value->data());
              }*/
        }
      }
      //end

      return view('admin.doctorProfile')->with($data);
    }

    public function approveDoctorList(Request $request)
    {

      $listofdoctor = $request->input('doctorlist');

      foreach ($listofdoctor as $key => $value) {

        $this->approveDoctor($value->doctorid);

      }

      //return "All doctor update successfully";

      return redirect()->back();
    }


    public function rejectDoctorList(Request $request)
    {
        $listofdoctor = $request->input('doctorlist');

        foreach ($listofdoctor as $key => $value) {

            $this->rejectDoctor($value->doctorid);

        }

        //   return "All doctor update successfully";

        return redirect()->back();

    }
    public function process_intv_images($file_input,$uid, $type){
        $image_size = $file_input->getSize();
        //$fileName = $uid.''.$fileName;
        
        if ($image_size >= 1024)
        {
            $image_size_kb = (int)($image_size / 1024);
        } else { $image_size_kb = 1; }
        
        if($image_size_kb>700)
        {
            // create an image manager instance with favored driver
            $manager = new ImageManager(array('driver' => 'imagick')); //array('driver' => 'imagick')
            $image_make = $manager->make($file_input, $type);
            
            $mime = $image_make->mime();
            //some checks more with width and height
            //$width = $image_make->width();
            //$height = $image_make->height();
            
            // to finally create image instances
            $image = $image_make->resize(900, 900, function ($constraint) {
                $constraint->aspectRatio();
            });
                
                /************************** without resize method call, if less quality given in save
                 method then it reduces size too like imagejpeg *****************************/
                $img_ext = ".jpg";
                //////////by default image is saved according to ext in path, Alternatively it is possible to define the image format by passing one of the image format extension as a third parameters
                if(($mime=="image/jpeg")||($mime=="image/jpg")) { $img_ext = ".jpg"; } if($mime=="image/png") { $img_ext = ".png"; } if($mime=="image/bmp") { $img_ext = ".bmp"; } if($mime=="image/gif") { $img_ext = ".gif"; }
                $fileName = $uid.'_'.$type.$img_ext;
                $image->save(public_path('images/profilepic').'/'.$fileName.'', 100);
                $url = "https://telocuretest.com/api/download/".$fileName;
        } else { //image size less than we defined so just use laravel move as bef4
            //set file name with extension
            $img_ext = ".".$file_input->getClientOriginalExtension();
            $fileName = $uid.'_'.$type.$img_ext;
            $file_input->move(public_path('images/profilepic'), $fileName);
            $url = "https://telocuretest.com/api/download/".$fileName;
        }
        return $url;
    }
    // 20-04-2020
    public function completeProfileAction(Request $request){
        //dd($request->all());
        
        $validator = Validator::make($request->all(), [
            'nid' => ['required','regex:/^[0-9]+$/'] ,
            'dateOfBirth' => 'required',
            'gender' => 'required',
            'name' => 'required',
            'regNo' => 'required',
            'acadeimcDegree' => 'required',
            'phone' => ['required','regex:/^[0-9]+$/'] ,
            'email' => 'required|email',
            'presentAddress' => 'required',
            'district' => 'required',
            'postalCode' => ['required','regex:/^[0-9]+$/'] ,
            'doctorType' => 'required',
            
            'degreeCertificate' => 'sometimes|image',
            'photoUrl' => 'sometimes|image',
            'prescriptionForm' => 'sometimes|image',
            'nidFront' => 'sometimes|image',
            'nidBack' => 'sometimes|image',
            
            'accountName' => 'required',
            'bankName' => 'required',
            'accountNo' => 'required',
        ]);
        
        /* When using the regex / not_regex patterns, it may be necessary to specify
         rules in an array instead of using pipe delimiters, especially if the regular
         expression contains a pipe character. */
        
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        } else {  
            
        
        $firestore = app('firebase.firestore');
        $database = $firestore->database();
        $doctorRef = $database->collection('doctors');

        $uid = $request->uid;
        
        $registrationStat = (int)$request->registrationStat;
        if(($registrationStat>2)||($registrationStat==3)) { $registrationStat = 3; } else { 
            $registrationStat = 2; //set stat field to 2 and update, means degree image uploaded in this method
            
        }

        $hUid = $request->hospitalUid ;

        /*
        if($hUid != false){
            $hospitalUid = substr($uid, 2);
            $docRef = $doctorRef
                ->document($hospitalUid);
        }else{
            $docRef = $doctorRef
                ->document($uid);
        }
        */

        $docRef = $doctorRef
                ->document($uid);

        $email = $request->email ;

        /*
        if(isset($request['photoUrl'])){

            $fileName = $request['photoUrl']->getClientOriginalName();

            $fileName = $uid.''.$fileName;
            $request['photoUrl']->move(public_path('images/profilepic'), $fileName);
            $url = "https://telocuretest.com/api/download/".$fileName;
        }else{
            $url = '';
        }
        */
        /******************08/07/2020*******************/
        /*if(isset($request['photoUrl'])){
            $fileName = $request['photoUrl']->getClientOriginalName();
            $fileName = $uid.''.$fileName;
            $request['photoUrl']->move(public_path('images/profilepic'), $fileName);
            $url = "https://telocuretest.com/api/download/".$fileName;
        }elseif($request->old_photoUrl){
            $url = $request->old_photoUrl;
        }else{
            $url = "";
        }
        /******************end**************************/
       /* 
        if(isset($request['degreeCertificate'])){

            $fileName = $request['degreeCertificate']->getClientOriginalName();

            $fileName = $uid.''.$fileName;
            $request['degreeCertificate']->move(public_path('images/profilepic'), $fileName);
            $durl = "https://telocuretest.com/api/download/".$fileName;
        }else{
            $durl = '';
        }

        if(isset($request['prescriptionForm'])){

            $fileName = $request['prescriptionForm']->getClientOriginalName();

            $fileName = $uid.''.$fileName;
            $request['prescriptionForm']->move(public_path('images/profilepic'), $fileName);
            $purl = "https://telocuretest.com/api/download/".$fileName;
        }else{
            $purl = '';
        }
        //nid front
        if(isset($request['nidFront'])){
            $registrationStat = 3;
            
            $fileName = $request['nidFront']->getClientOriginalName();
            
            $fileName = $uid.'_nid_front_'.$fileName; //addition
            $request['nidFront']->move(public_path('images/profilepic'), $fileName);
            $nid_front_url = "https://telocuretest.com/api/download/".$fileName;
        }else{
            $nid_front_url = '';
        }
        //nid back
        if(isset($request['nidBack'])){
            $registrationStat = 3;
            
            $fileName = $request['nidBack']->getClientOriginalName();
            
            $fileName = $uid.'_nid_back_'.$fileName; //addition
            $request['nidBack']->move(public_path('images/profilepic'), $fileName);
            $nid_back_url = "https://telocuretest.com/api/download/".$fileName;
        }else{
            $nid_back_url = '';
        } */ 
        
        //mridul 24-7-20 
        //following for complete profile, for edit profile check old_degree.. field populated as below in else condition
         if(isset($request['degreeCertificate'])){
            $durl = $this->process_intv_images($request['degreeCertificate'],$uid, "degree");
        }else{
            //////////////////////// but in edit profile there will be old value not ""
            $durl = ""; //for edit profile $request->old_degreeCertificate
        }
        
        if(isset($request['photoUrl'])){
            $url = $this->process_intv_images($request['photoUrl'], $uid,"profile");
        }elseif($request->old_photoUrl){
            $url = $request->old_photoUrl;
        }else{
            //////////////////////// but in edit profile there will be old value not ""
            $url = ""; //for edit profile $request->old_degreeCertificate
        }
        if(isset($request['nidFront'])){
            $registrationStat = 3;
            $nid_front_url = $this->process_intv_images($request['nidFront'],$uid, "nidfront");
        }else{
            //////////////////////// but in edit profile there will be old value not ""
            $nid_front_url = ""; //for edit profile $request->old_degreeCertificate
        }
        if(isset($request['nidBack'])){
            $registrationStat = 3;
            $nid_back_url = $this->process_intv_images($request['nidBack'],$uid, "nidback");
        }else{
            //////////////////////// but in edit profile there will be old value not ""
            $nid_back_url = ""; //for edit profile $request->old_degreeCertificate
        }

      $branch = $docRef->collection('others')->document($docRef->id())->snapshot()->data();

      $districtId = intval($request->postalCode);

    	$docRef->set([
            'uid' => $request->uid,
            'dateOfBirth' => $request->dateOfBirth,
            'gender' => $request->gender,
            'name' => $request->name.'  '.$request->lastname,
            'regNo' => $request->regNo,
            'email' => $request->email,
            'phone' => $request->phone,
            //'presentAddress' => $request->presentAddress,
            'district' => $request->district,
            'districtId' => $districtId,
            'doctorType' => $request->doctorType,
            // Documents
            'photoUrl' => $url,
            //end
            'createdAt' => new Timestamp(new DateTime()),
    	      'registrationStat' => $registrationStat

   		],['merge' => true]);

      $bank_info = $docRef->collection('bank_info')->document($docRef->id())->snapshot()->data();

      //dd($bank_info);

      // $branch = $docRef->collection('others')->document($docRef->id())->snapshot()->data();

      if(isset($branch['branchId'])) $brId = $branch['branchId'] ;
      else $brId = "" ;

        $docRef->collection('others')->document($docRef->id())->set([
            'nid' => $request->nid,
            'presentAddress' => $request->presentAddress,
            'acadeimcDegree' => $request->acadeimcDegree,
            'otherDegree' => $request->otherDegree,
            'branchId' => $brId // hospital branch
        ]);

        $othersArr = [
            'nid' => $request->nid,
            'presentAddress' => $request->presentAddress,
            'acadeimcDegree' => $request->acadeimcDegree,
            'otherDegree' => $request->otherDegree,
            'branchId' => $brId
        ];

        $othersData = json_encode($othersArr);

        $docRef->collection('balance')->document($docRef->id())->set([
            'balance' => 0,
            'updatedTime' => new Timestamp(new DateTime()),
        ]);

        $balanceArr = [
            'balance' => 0,
            'updatedTime' => date('d-m-Y h:i:s')
        ];

        $balanceData = json_encode($balanceArr);

        $docRef->collection('documents')->document($docRef->id())->set([
            //'degreeCertificate' => $durl,
            'academicCertificate' => $durl,
            //'prescriptionForm' => $purl,
            'nidFront' => $nid_front_url,
            'nidBack' => $nid_back_url 
        ],['merge' => true]);

        $documentsArr = [
            'academicCertificate' => $durl,
            'nidFront' => $nid_front_url,
            'nidBack' => $nid_back_url 
        ];

        $documentData = json_encode($documentsArr);

        $docRef->collection('bank_info')->document($docRef->id())->set([
            'accountName' => $request->accountName,
            'bankName' => $request->bankName,
            'accountNumber' => $request->accountNo,
            //'branchName' => $request->branchName,
            'swiftCode' => $request->swiftCode,
        ],['merge' => true]);

        $bank_infoArr = [
            'accountName' => $request->accountName,
            'bankName' => $request->bankName,
            'accountNumber' => $request->accountNo,
            //'branchName' => $request->branchName,
            'swiftCode' => $request->swiftCode,
        ];

        $bank_infoData = json_encode($bank_infoArr);

        $inputData = [
            'uid' => $request->uid,
            'dateOfBirth' => $request->dateOfBirth,
            'gender' => $request->gender,
            'name' => $request->name.'  '.$request->lastname,
            'regNo' => $request->regNo,
            'email' => $request->email,
            'phone' => $request->phone,
            //'presentAddress' => $request->presentAddress,
            'district' => $request->district,
            'districtId' => $districtId,
            'doctorType' => $request->doctorType,
            // Documents
            'photoUrl' => $url,
            //end
            'createdAt' => new Timestamp(new DateTime()),
            'registrationStat' => $registrationStat,

            'bank_info' => $bank_infoData,
            'documents' => $documentData,
            'others' => $othersData,
            'balance' => $balanceData

        ];

        Doctor::where('uid',$uid)->update($inputData);

        /*
        $query = $doctorRef->where('uid','=',$uid);
        $doctorInfo = $query->documents();
        */

        $doctorInfo = Doctor::where('uid',$uid)->get()->toArray();

        $doctorArr = array();

            foreach ($doctorInfo as $doctor) {
                // if($doctor->exists()){
                //     array_push($doctorArr, $doctor->data());
                // }
                  array_push($doctorArr, $doctor);
            }

        $request->session()->put('doctor', $doctorArr);

        $request->session()->put('user', $doctorArr);

        Session::flash('profile-success','Successfully submitted.');

        //dd($doctorArr);

        return redirect('doctor') ;
        
        } //validator condition ends
    }

    //end

    //26-04-2020
    public function doctorTransactionInfo(){
        $firestore = app('firebase.firestore');
        $database = $firestore->database();
        /*
          $visits = $database->collection('visits');
          $visitData = $visits->documents();
        */
        $visitData = Visits::get()->toArray();
        $data['visited'] = array();

        foreach($visitData as $key => $value){
            array_push($data['visited'],$value);
        }

        // dd($data['visited']);

        return view('admin/doctorTransaction')->with($data);
    }
    //end


    //12-05-2020
    public function updateProfileAction(Request $request){
        //dd($request->all());

        $firestore = app('firebase.firestore');
        $database = $firestore->database();

        $doctorRef = $database->collection('doctors');

        $uid = $request->uid;

        $hUid = $request->hospitalUid ;

        /*if($hUid != ''){
            $hospitalUid = substr($uid, 2);
            $docRef = $doctorRef
                ->document($hospitalUid);
        }else{
            $docRef = $doctorRef
                ->document($uid);
        }*/

        $docRef = $doctorRef->document($uid);

        // $snapsot = $docRef->snapshot();

        //dd($docRef);

        // $degreeCertificate = $request['degreeCertificate']->getClientOriginalName();
        // $profileImage = $request['profileImage']->getClientOriginalName();
        // $prescriptionForm = $request['prescriptionForm']->getClientOriginalName();

        // $request->degreeCertificate->move(public_path('images/profilepic'), $degreeCertificate);
        // $request->profileImage->move(public_path('images/profilepic'), $profileImage);
        // $request->prescriptionForm->move(public_path('images/profilepic'), $prescriptionForm);

        // $degreeCertificateUrl = "http://helodoc.com/api/download/".$degreeCertificate;
        // $profileImageUrl = "http://helodoc.com/api/download/".$profileImage;
        // $prescriptionFormUrl = "http://helodoc.com/api/download/".$prescriptionForm;

        // $email = $request->email ;

        if(isset($request['photoUrl'])){

            $fileName = $request['photoUrl']->getClientOriginalName();

            $request['photoUrl']->move(public_path('images/profilepic'), $fileName);
            $url = "https://telocuretest.com/api/download/".$fileName;
        }else{
            $url = $request->old_photoUrl;
        }


        $docRef->update([
            ['path' => 'uid', 'value' => $request->uid],
            ['path' =>'nid',  'value' => $request->nid],
            ['path' =>'dateOfBirth', 'value' => $request->dateOfBirth],
            ['path' =>'gender', 'value' => $request->gender],
            ['path' =>'name', 'value' => $request->name],
            ['path' =>'regNo', 'value' => $request->regNo],
            ['path' =>'email', 'value' => $request->email],
            ['path' =>'presentAddress', 'value' => $request->presentAddress],
            ['path' =>'district', 'value' => $request->district],
            // ['path' =>'postalCode' => $request->postalCode,
            ['path' =>'doctorType', 'value' => $request->doctorType],

            // Documents
            //'degreeCertificate' => $degreeCertificateUrl,
            ['path' => 'photoUrl', 'value' => $url]
            //'prescriptionForm' => $prescriptionFormUrl,
            //end

            /*'accountName' => $request->accountName,
            'bankName' => $request->bankName,
            'accountNo' => $request->accountNo,
            'branchName' => $request->branchName,
            'swiftCode' => $request->swiftCode,*/

            // 'online' => ' ',
            // 'active' => ' ',
            //'createdAt' => date('d/m/Y')
           ]);


           $validatedData = $request->validate([
            'nid' => 'required',
            'dateOfBirth' => 'required',
            'gender' => 'required',
            'name' => 'required',
            'regNo' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'presentAddress' => 'required',
            'district' => 'required',
            'doctorType' => 'required',

            // Documents
            // 'degreeCertificate' => 'require',
            'photoUrl' => '',
            // 'prescriptionForm' => 'require',
            //end

            /*
            'accountName' =>  'require',
            'bankName' =>  'require',
            'accountNo' => 'require',
            'branchName' =>  'require',
            'swiftCode' =>  'require',
            */
        ]);

        return redirect()->back();
    }
}
