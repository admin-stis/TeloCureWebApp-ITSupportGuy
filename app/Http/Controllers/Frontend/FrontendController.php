<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;



use App\District;
use App\Doctor;
use App\Hospital;
use App\User;
use App\Visits;
use App\HospitalBranch;
use App\Hospital_users;





class FrontendController extends Controller
{
    protected $data = [];

    public function index()
    {
        $this->data['title'] = 'Home';
        return view('frontend.index', $this->data);
    }

    public function services($title = '')
    {
        $this->data['title'] = $title;
        return view('frontend.services', $this->data);
    }

    public function profile($title = '')
    {
        $this->data['title'] = $title;
        return view('frontend.profile', $this->data);
    }

    public function about()
    {
        return view('frontend.about-us');
    }

    public function ourDoctor()
    {

        $firestore = app('firebase.firestore');
        $db = $firestore->database();
        $doctorRef = $db->collection('doctors');

        $data['doctors'] = $doctorRef->documents();
        $data['doctorList'] = array();

        $data['totalDoctor'] = 0;


        foreach ($data['doctors'] as $key => $doctor) {
            $item = $doctor->data(); // dd($item);
            $did = $item["uid"]; //dd($did);
            $docDegrees = array();
            $docDegrees["degree"] = $db->collection('doctors')->document($did)->collection('others')->document($did)->snapshot()->data();

            $item_main = array_merge($item, $docDegrees);
            array_push($data['doctorList'], $item_main);
            //array_push($data['doctorList'], $doctor->data());
            $data['totalDoctor']++;
        }


        return view('frontend.ourDoctor')->with($data);
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
        return view('frontend.help', $this->data);
    }

    public function registerArea()
    {
        return view('frontend.registerpage');
    }

    public function loginArea()
    {
        return view('frontend.loginpage');
    }

    public function loginUser($title = '')
    {
        $this->data['title'] = $title;
        return view('frontend.login', $this->data);
    }

    public function registerUser($title = '')
    {
        $this->data['title'] = $title;
        if ($title == 'doctor') {
            //for district dropdown
            /*   $firestore = app('firebase.firestore');
            $database = $firestore->database();

            $districtRef = $database->collection('districts');

            $db_districts = $districtRef->where('active', '=', true)->documents();
            $districtList = array();
         */

            $districtList  = District::where('active', 1)->get();



            /* foreach ($districtList as $key => $item) {
             array_push($districtList, $item->data());
             } */
            // dd($districtList);

            $this->data['district'] = $districtList;

            $this->data['role'] = 2;
        } elseif ($title == 'patient') {
            //for district dropdown
            /* $firestore = app('firebase.firestore');
            $database = $firestore->database();

            $districtRef = $database->collection('districts');

            $db_districts = $districtRef->where('active', '=', true)->documents();
            $districtList = array();
 */

            $districtList  = District::where('active', 1)->get();


            /*  foreach ($db_districts as $key => $item) {
                array_push($districtList, $item->data());
            }
 */


            $this->data['district'] = $districtList;
            $this->data['role'] = 3;
        } elseif ($title == 'hospital') {
            $this->data['role'] = 4;
        }




        // return view('frontend.register', $this->data);
        return view('frontend.register')->with($this->data);
    }

    public function refund()
    {
        return view('frontend/refund');
    }

    public function terms()
    {
        return view('frontend/terms');
    }
}