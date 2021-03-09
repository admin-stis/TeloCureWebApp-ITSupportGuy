<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log; 

class PhotouploadController extends Controller
{
    public function upload(Request $request)
    {

        
        $fileName = $request->input('filename');

        //dd($request->all());

        /*if($filename='')
        {
            $fileName = $request->file->getClientOriginalName(); 
        }else{
            $fileName = $fileName.'.'.$request->file->extension();
        }*/

        //dd($fileName);

        if(isset($request['filename'])){

            $fileName = $request['filename']->getClientOriginalName();

            $uid = uniqid();
            $fileName = $uid.'t'.$fileName;
            
            $request['filename']->move(public_path('images/profilepic'), $fileName);
            $url = "https://telocuretest.com/api/download/".$fileName;

            //return response()->json(['downloadUrl'=>$url],200);
            return response()->json([
                'error'=> 'false', 
                'message' => 'File uploaded successfully',
                'image'=>$url],200);
            // return "upload success fully";
        }else{
            return response()->json(['error'=> 'true', 'message' => 'File uploaded unsuccess'],201);
        }
    }

    public function download($name)
    {
        $filepath = public_path('images/profilepic/').$name;

        return \Response::download($filepath);
    }
   
    public function downloadprc($name)
    {
        try{
            
            $filepath = public_path('prescription/').$name;
            //dd($filepath);
            
            $datepart = explode("-pr-", $name, 2);
            $frb_tz = new \DateTimeZone('Asia/Dhaka');
            $date_prs_create = date_create(trim($datepart[0]),$frb_tz);
            //$print = $date_prs_create->format('d-m-Y');
            //return $print;
            
            $date_today = new \DateTime("now", $frb_tz);
            $diff = $date_prs_create->diff($date_today);
            $days = $diff->days; //get days diff betwn two dates
            if($days<=30) { return \Response::download($filepath); }
            else { 
                //if(trim($datepart[1])=="8mG2Z2d9sAFjPTDaBFip.pdf")
                //{
                 //   return \Response::download($filepath);
                //} else { 
                return "Your prescription is 30 days period expired";
                //}
            
            }
        } catch(\Exception $e){
            Log::error("Errors when downloading prescription via api: ".$e);
            return "Errors found when downloading prescription file";
        }
    }
    
    public function docterCredential(Request $request)
    {

        
        $uid = $request->input('uid');
        $category = $request->input('category');
        $number = $request->input('number');
        //$fileName = '';
        // $fileName = $request->input('file');
        
        $fileName = $request['file'];

        if($uid){
            $fileName = $fileName.$uid;
        }else{
            return response()->json(['error'=> 'true', 'message' => 'File uploaded unsuccess'],201);
        }
       
        if($category){
            if($category=='nidf'){
             $fileName = $fileName.'_'.'1';
            }elseif ($category=='nidb'){
                $fileName = $fileName.'_'.'2';
            }elseif ($category=='certificate'){
                $fileName = $fileName.'_'.'3';
            }elseif ($category=='prescription'){
                $fileName = $fileName.'_'.'1';
            }
        }else{
            return response()->json(['error'=> 'true', 'message' => 'File uploaded unsuccess'],201);
        }
        if($number){
            $fileName = $fileName.'_'.$number;
        }else{
            return response()->json(['error'=> 'true', 'message' => 'File uploaded unsuccess'],201);
        }
        
        if(isset($request['file'])){

            // $fileName = $fileName.'.'.$request->file->extension();

            $fileName = $request['file']->getClientOriginalName();
            
            $request->file->move(public_path('images/profilepic'), $fileName);

            $url = "https://telocuretest.com/api/download/".$fileName;

        // return response()->json(['downloadUrl'=>$url],200);
        
            return response()->json([
                'error'=> 'false',
                'message' => 'File uploaded successfully',
                'image' => $url],200);
        }else{
            return response()->json(['error'=> 'true', 'message' => 'File uploaded unsuccess'],201);
        }

    }

}

