<?php

namespace App\Http\Controllers\Admin;


use Kreait\Firebase\Database;
// use Kreait\Firebase\Firestore;
use Google\Cloud\Firestore\FirestoreClient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth\MailSendController;

class AdminFirebaseController extends Controller
{
    public function index()
   	{
   		$database = app('firebase.database');
   		$reference = $database->getReference('COMILLA');
   		$value = $reference->getValue();
   		dd($value);
   	}

   	public function index2()
   	{
   		$firestore = app('firebase.firestore');
   		$database = $firestore->database();
   		$collectionReference = $database->collection('doctors');
   		$documents = $collectionReference->documents();
   		// $snapshot = $documentReference->snapshot();
   		// $reference = $database->getReference('users');
   		// $value = $database->getValue();
   		// foreach ($documents as  $document) {
   		// 	if ($document->exists()){
   		// 		print_r($document->data());
   		// 	}
   		// 	print_r('----------------------------------------------------------\r\n');
   		// }
   		dd($documents);


   	}

    // Doctor Registration
    /*
    public function setdoctors()
   	{
   		$firestore = app('firebase.firestore');
   		$database = $firestore->database();
   		$doctorRef = $database->collection('doctors');
   		$doctorRef->add([
   			'active'=>false,
   			'dateOfBirth'=>'2/2/2020',
   			'district'=>'dhaka',
   			'districtId'=>1,
   			'doctorType'=>'general',
   			'email'=>'amit@gmail.com',
   			'gender'=>'Male',
   			'name'=>'amit kumar2',
   			'online'=>true,
   			'photoUrl'=>'www.photo.com',
   			'price'=>300,
   			'regNo'=>'00011',
   			'totalCount'=>2,
   			'totalRating'=>8
   		]);
   		dd('Doctor add successfully');


       }
    */

   	public function getDoctor()
   	{
   		$firestore = app('firebase.firestore');
   		$database = $firestore->database();
   		$doctorsRef = $database->collection('doctors');
   		$query = $doctorsRef->where('active','=',true);
   		$snapshot = $query->documents();
   		dd($snapshot);
   	}

   	public function editDoctor()
   	{
   		$firestore = app('firebase.firestore');
   		$database = $firestore->database();
   		$doctorRef = $database->collection('doctors')->document('AmitKumar');
   		// dd($doctorRef);
		$doctorRef->update([
   			['path' => 'active', 'value' => true],
   			['path' => 'dateOfBirth', 'value' => '20/20/2020']

		]);
   		dd('doctor update sccessfully');
   	}


   	public function districtDoctor()
   	{
   		$firestore = app('firebase.firestore');
   		$database = $firestore->database();
   		print_r("<pre>");
   		//district wise total number doctor

   		$districtRef = $database->collection('districts');
   		$districts = $districtRef->documents();
   		$dis_val = array_fill(0, 65,0);
   		foreach ($districts as $district) {
   			if ($district->exists()){
   				$temp = array('id' => $district['id'],'name'=>$district['name'],'bn_name'=>$district['bn_name'],'count'=>0);
   				$dis_val[$district['id']] = $temp;
   			}
   		}
   		$doctorRef = $database->collection('doctors');
   		$doctors = $doctorRef->documents();
   		foreach ($doctors as $doctor) {
   			if($doctor->exists()){
   				$dis_val[$doctor['districtId']]['count']++;
   			}
   		}

   		print_r($dis_val);
   		print_r("<pre>");
   		return $dis_val;
   	}

   	public function docoreGender()
   	{
   		$firestore = app('firebase.firestore');
   		$db = $firestore->database();
   		$doctorRef = $db->collection('doctors');
   		$doctors = $doctorRef->documents();
   		$doctor_gender = array('Male' => 0,'Female'=>0);
   		foreach ($doctors as $doctor) {
   			if($doctor->exists()){
	   			if($doctor['gender']=="Male"){

	   				$doctor_gender['Male']++;
	   			}else{
	   				$doctor_gender['Female']++;
	   			}

   			}
   		}
   			print_r("<pre>");
   			print_r($doctor_gender);
   			print_r("<pre>");

   		return $doctor_gender;
   	}

   	public function numberOfPatient()
   	{
   		$firestore = app('firebase.firestore');
   		$db = $firestore->database();
   		$patientRef = $db->collection('users');
   		$patients = $patientRef->documents();

   		$total_patient = 0;
   		// return count($patients);
   		print_r("<pre>");
   		foreach ($patients as $patient) {
   			// print_r($patient->data());
   			$total_patient++;
   		}
   		print_r("<pre>");

   		return $total_patient;

    }

    // new code 20-04-2020
    public function setdoctors(Request $request)
    {
        $firestore = app('firebase.firestore');
        $database = $firestore->database();
        $doctorRef = $database->collection('doctors')->newDocument();
        $doctorRef->set([
            'uid' => $doctorRef->id(),
            'approve' => '',
            'online' => '',
            'active'=> '',
            'email'=> $request->email,
            'name'=> $request->name,
            'lastname' => $request->lastname,
            'phone' => $request->phone,
            'password' => $request->password,
            'role' => ''
        ]);

        return redirect('login/doctor');
    }

    public function loggedIn(Request $request)
    {
        $email = $request->email;

        $firestore = app('firebase.firestore');
        $database = $firestore->database();

        if($request->title =='doctor'){
            $userRef = $database->collection('doctors');
        }
        else if($request->title =='patient'){
            $userRef = $database->collection('users');
        }
        else if ($request->title =='hospital'){
            $userRef = $database->collection('hospitals');
        }
        else if($request->title =='admin'){
            $userRef = $database->collection('admin');
        }

        $query = $userRef->where('email','=',$email)->where('password','=',$request->password);
        $userInfo = $query->documents();

        $userArr = array();

        foreach ($userInfo as $user) {
            if($user->exists()){
                array_push($userArr, $user->data());
            }
        }

        if(!empty($userArr)){
            $districtRef = $database->collection('districts');

            $data['district'] = $districtRef->documents();
            $data['districtList'] = array();

            foreach($data['district'] as $key=>$item){
                array_push($data['districtList'],$item->data());
            }

            $request->session()->put('user',$userArr);
            $request->session()->put('district',$data['districtList']);

            //Edit from mafiz vai
            $MailSend = new MailSendController();
            $otp = mt_rand(10000,99999);
            $val = $MailSend->sendOtp($otp,$email);

            $helodoc2fa = array(
                'title'	=> $request->title,
                'opt'	=> $otp,
                'status'=> false
            );

            $request->session()->put('helodoc2fa', $helodoc2fa);

            if ($val){
                return redirect('/2fa')->with($helodoc2fa);
            }

        }else{
            return redirect()->back();
        }
    }
    //End

}
