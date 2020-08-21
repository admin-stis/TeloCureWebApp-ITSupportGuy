<?php

namespace App\Console\Commands;

use App\Patient;
use App\Refund;
use App\Vital;
use Illuminate\Console\Command;

class UsersCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Users:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetching Users.';

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
        $firestore = app('firebase.firestore');
   		$database = $firestore->database();
   		$UsersRef = $database->collection('users');
        $snapshot = $UsersRef->documents();

        $refundRef = $database->collection('refund');
        $vitalsRef = $database->collection('vitals');

        $patient = array();
        foreach($snapshot as $val){
            array_push($patient,$val->data());
        }

        foreach($patient as $item){

            if(isset($item['districtId']))$item['districtId'] = $item['districtId'] ;
            else $item['districtId'] = 0;

            if(isset($item['hospitalName']))$item['hospitalName'] = $item['hospitalName'] ;
            else $item['hospitalName'] = " ";

            if(isset($item['lastName']))$item['lastName'] = $item['lastName'] ;
            else $item['lastName'] = " ";

            if(isset($item['gender']))$item['gender'] = $item['gender'] ;
            else $item['gender'] = " ";

            $patient = Patient::updateOrCreate(
                ['id' => $item['uid']],
                [
                    'id'=> $item['uid'],'name'=> $item['name'],'gender'=> $item['gender'],'height'=> $item['height'],'weight'=> $item['weight'],
                    'bloodGroup'=> $item['bloodGroup'],'district'=> $item['district'],'districtId'=> $item['districtId'],
                    'doctorType'=> $item['doctorType'],'photoUrl'=> $item['photoUrl'],'lastName'=> $item['lastName'],'hospitalName'=> $item['hospitalName'],'hospitalUid'=> $item['hospitalUid'],
                    'hospitalized'=> $item['hospitalized'],'medication'=> $item['medication'],'password'=> $item['password'],'phone'=> $item['phone'],
                    'email'=> $item['email'],'regNo'=> $item['regNo'],'smoke'=> $item['smoke'],'active'=> $item['active'],
                    'online'=> $item['online'],'totalCount'=> $item['totalCount'],'totalRating'=> $item['totalRating'],
                    'createdAt'=> $item['createdAt'],'price'=> $item['price']
                ]
            );

            $refundDoc = $refundRef->document($item['uid'])->snapshot()->data();

            if(isset($refundDoc) && !empty($refundDoc)){

                $refund = Refund::updateOrCreate(
                    ['id' => $item['uid']],
                    [
                        'id' => $item['uid'],'balance' => $refundDoc['balance'],
                        'updatedTime' => $refundDoc['updatedTime']
                    ]
                );
            }else{
                //echo '1';
            }

            $vitals = $vitalsRef->document($item['uid'])->snapshot()->data();

            if(isset($vitals) && !empty($vitals)){
                if(isset($vitals['bmp'])) $vitals['bmp'] = $vitals['bmp'];
                else $vitals['bmp'] = '';

                if(isset($vitals['resp'])) $vitals['resp'] = $vitals['resp'];
                else $vitals['resp'] = '';

                if(isset($vitals['temp'])) $vitals['temp'] = $vitals['temp'];
                else $vitals['temp'] = '';

                if(isset($vitals['measureTime'])) $vitals['measureTime'] = $vitals['measureTime'];
                else $vitals['measureTime'] = '';

                $vitals = Vital::updateOrCreate(
                    ['id' => $item['uid']],
                    [
                        'id' => $item['uid'],
                        'bpm' => $vitals['bmp'],'measureTime' => $vitals['measureTime'],
                        'pId' => $vitals['pId'],'resp' => $vitals['resp'],'temp' => $vitals['temp']
                    ]
                );
            }else{
                //echo '1';
            }
        }

    }
}
