<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PhotouploadController extends Controller
{
    public function upload(Request $request)
    {
    	$fileName = $request->input('filename');

    	dd($request->file);

    	if($filename='')
    	{
    		$fileName = $request->file->getClientOriginalName(); 
    	}else{
    		$fileName = $fileName.'.'.$request->file->extension();
    	}

        $request->file->move(public_path('images/profilepic'), $fileName);
        $url = "http://helodoc.com/api/download/".$fileName;

        return response()->json(['downloadUrl'=>$url],200);
        // return "upload success fully";
    }

    public function download($name)
    {
    	$filepath = public_path('images/profilepic/').$name;

        return \Response::download($filepath);
    }
   

    public function docterCredential(Request $request)
    {
        //dd($request->all());
        $uid = $request->input('uid');
        $category = $request->input('category');
        $number = $request->input('number');
        //$fileName = '';
        $fileName = $request->input('file');
        
        if($uid){
            $fileName = $fileName.$uid;
        }else{
            return Response::json(['error'=>'Something went wrong'],201);
        }
       
        if($category){
            if($category=='nidf'){
            $fileName = $fileName.'_'.'1';
            }elseif ($category=='nidb'){
                $fileName = $fileName.'_'.'2';
            }elseif ($category=='cartificate'){
                $fileName = $fileName.'_'.'3';
            }elseif ($category=='prescription'){
                $fileName = $fileName.'_'.'1';
            }
        }else{
            return Response::json(['error'=>'Something went wrong'],201);
        }
        if($number){
            $fileName = $fileName.'_'.$number;
        }else{
            return Response::json(['error'=>'Something went wrong'],201);
        }
        
        $fileName = $fileName.'.'.$request->file->extension();
        
        $request->file->move(public_path('images/profilepic'), $fileName);

        $url = "http://helodoc.com/api/download/".$fileName;

        return response()->json(['downloadUrl'=>$url],200);

    }

}

