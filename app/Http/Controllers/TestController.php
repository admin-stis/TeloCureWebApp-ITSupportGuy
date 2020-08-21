<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Http\Controllers\Auth\MailSendController;
use App\Mail\sendLink;
use App\Mail\SendRequest;
use Mail;

// include composer autoload
require 'custom_vendor/autoload.php';

// import the Intervention Image Manager Class
use Intervention\Image\ImageManager;
//use Spatie\ImageOptimizer\OptimizerChainFactory;

class TestController extends Controller
{
    public function process_intv_images($file_input,$uid, $type){
        $image_size = $file_input->getSize();
        //$fileName = $uid.''.$fileName;
        //dd($image_size);
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
    public function test_form(Request $request)
    {
        //first input as png
        if(isset($request['fileinput1'])){
            $url = $this->process_intv_images($request['fileinput1'], "uid", "degree_test");
        }
        if(isset($request['fileinput2'])){
            $url = $this->process_intv_images($request['fileinput2'], "uid", "pro_test");
        }
       // dd($url);
        
        //following for complete profile, for edit profile check old_degree.. field populated as below in else condition
         if(isset($request['degreeCertificate'])){
         $durl = $this->process_intv_images($request['degreeCertificate'],$uid, "degree");
         }else{
         //////////////////////// but in edit profile there will be old value not ""
         $durl = ""; //for edit profile $request->old_degreeCertificate
         }
         
         if(isset($request['photoUrl'])){
         $url = $this->process_intv_images($request['photoUrl'], $uid,"profile");
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
    }
    public function test(Request $request)
    {             
        
        /*$MailSend = new MailSendController();
        
        $link = [
            'name' => "test name",
            'uid' => "77",
            'phone' => "345435",
            'pass' => "pass here"
        ];     
       
        try { 
            
            $objDemo = new \stdClass();
            $objDemo->code = $link ;
            //dd($objDemo->code);
            // $objDemo->code = 'Demo Two Value';
            $objDemo->sender = 'TeloCure Team';
            $objDemo->receiver = "mridulsdfdsfdsaf234324324234cs2012gmail.com";
            
            Mail::to('mridulcsdf435435fsadfsdfdsfs2012gmail.com')->send(new sendLink($objDemo));
            
           // if (Mail::failures()){
                
                if(count(Mail::failures()) > 0){
                    dd('Failedddd to send password reset email, please try again.');
                }
                //if (Mail::failures()==false){
                //    dd('here');
               // }
                //return false;
           // }else{
           //     dd('success mrd');
           // }
            //$val = $MailSend->sendDoc($link,"mridulcs2012@gmail.com"); //email
        } catch(\Exception $e){
            dd("ttt".$e->getMessage()); 
        }
        
        //dd($val);
        
        /*$factory = new \ImageOptimizer\OptimizerFactory();
        $optimizer = $factory->get();
        
        $filepath = public_path()."/test.jpg"; 
        
        $optimizer->optimize($filepath);*/
        
        //$optimizerChain = OptimizerChainFactory::create();        
       // $optimizerChain->optimize(public_path(). '/test.jpg', public_path(). '/test_resize.jpg');        
        return view('test');              
       
    }
}
