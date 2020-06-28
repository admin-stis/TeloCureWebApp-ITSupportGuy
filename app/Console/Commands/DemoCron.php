<?php

namespace App\Console\Commands;

use App\Doctor;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class DemoCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'demo:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Log::info("Cron is working fine!");

        /*
           Write your database logic we bellow:
           Item::create(['name'=>'hello new']);
        */

        $firestore = app('firebase.firestore');
   		$database = $firestore->database();
   		$doctorsRef = $database->collection('doctors');
   		$snapshot = $doctorsRef->documents();
           //dd($snapshot);
        $doctor = array();
        foreach($snapshot as $val){
            array_push($doctor,$val->data());
        }

        foreach($doctor as $item){
            $balance = $doctorsRef->document($item['uid'])->collection('balance')
                        ->document($item['uid'])->snapshot()->data();

            if(!empty($balance))$item['balance'] = json_encode($balance);
            else $item['balance'] = json_encode('');

            $documents = $doctorsRef->document($item['uid'])->collection('documents')
                        ->document($item['uid'])->snapshot()->data();

            if(!empty($documents))$item['documents'] = json_encode($documents);
            else $item['documents'] = json_encode('');

            $others = $doctorsRef->document($item['uid'])->collection('others')
                        ->document($item['uid'])->snapshot()->data();

            if(!empty($others))$item['others'] = json_encode($documents);
            else $item['others'] = json_encode('');

            $bank_info = $doctorsRef->document($item['uid'])->collection('others')
                        ->document($item['uid'])->snapshot()->data();

            if(!empty($bank_info))$item['bank_info'] = json_encode($bank_info);
            else $item['bank_info'] = json_encode('');

            $doctor = Doctor::updateOrCreate(
                ['id' =>  $item['uid']],
                ['id' => $item['uid'] , 'name' => $item['name'] , 'email' => $item['email'] ,
                'phone' => $item['phone'] , 'gender' => $item['gender'] , 'doctorType' => $item['doctorType'] ,
                'dateOfBirth' => $item['dateOfBirth'] , 'regNo' => $item['regNo'] ,
                'hospitalized' => $item['hospitalized'] , 'hospitalName' => $item['hospitalName'] , 'hospitalUid' => $item['hospitalUid'] ,
                'password' => $item['password'] , 'photoUrl' => $item['photoUrl'] , 'districtId' => $item['districtId'] ,
                'active' => $item['active'] , 'rejected' => $item['rejected'] , 'totalCount' => $item['totalCount'] ,
                'totalRating' => $item['totalRating'] , 'price' => $item['price'] , 'createdAt' => $item['createdAt'] ,
                'online' => $item['online'] ,'balance' => $item['balance'] , 'bank_info' => $item['bank_info'] ,
                'documents' => $item['documents'] , 'others' => $item['others']]
            );
        }

    }
}
