<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
            
            $request['filename']->move(public_path('images/profilepic'), $fileName);
            $url = "http://helodoc.com/api/download/".$fileName;

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

            $url = "http://helodoc.com/api/download/".$fileName;

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

