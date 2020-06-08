<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FrontendController extends Controller
{
    protected $data = [];

    public function index()
    {
        $this->data['title'] = 'Home';
        return view('frontend.index',$this->data);
    }

    public function services($title = '')
    {
        $this->data['title'] = $title ;
        return view('frontend.services',$this->data);
    }

    public function profile($title = '')
    {
        $this->data['title'] = $title;
        return view('frontend.profile',$this->data);
    }

    public function about()
    {
        return view('frontend.about-us');
    }

    public function privacy()
    {
        return view('frontend.privacy');
    }

    public function contact()
    {
        return view('frontend.contact');
    }

    public function patientprivacy()
    {
        return view('frontend.patientprivacy');
    }

    public function healthinfo()
    {
        return view('frontend.healthinfo');
    }

    public function appsprivacy()
    {
        return view('frontend.apps-privacy');
    }


    public function help($title = '')
    {
        $this->data['title'] = $title;
        return view('frontend.help',$this->data);
    }

    public function registerArea(){
        return view('frontend.registerpage');
    }

    public function loginArea(){
        return view('frontend.loginpage');
    }

    public function loginUser($title = ''){
        $this->data['title'] = $title;
        return view('frontend.login',$this->data);
    }

    public function registerUser($title = ''){
        $this->data['title'] = $title;
        if($title=='doctor'){
            $this->data['role'] = 2;
        }elseif($title=='patient'){
            $this->data['role'] = 3;
        }elseif($title=='hospital'){
            $this->data['role'] = 4;
        }
        return view('frontend.register',$this->data);
    }
}
