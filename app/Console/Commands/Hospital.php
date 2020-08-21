<?php

namespace App\Console\Commands;

use App\Hospital as AppHospital;
use Illuminate\Console\Command;

class Hospital extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hospital:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync hospitals';

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
   		$hosRef = $database->collection('hospital_users');
        $snapshot = $hosRef->documents();

        $hospital_usersArr = array();
        foreach($snapshot as $item){
            array_push($hospital_usersArr,$item->data());
        }

        foreach($hospital_usersArr as $item){

            $balance = $hosRef->document($item['hospitalUid'])->collection('balance')
                        ->document($item['hospitalUid'])->snapshot()->data();

            if(!empty($balance)){
                $item['balance'] = json_encode($balance);
            }
            else $item['balance'] = json_encode('');

            $bank_info = $hosRef->document($item['hospitalUid'])->collection('bank_info')
                        ->document($item['hospitalUid'])->snapshot()->data();

            if(!empty($bank_info))$item['bank_info'] = json_encode($bank_info);
            else $item['bank_info'] = json_encode('');

            AppHospital::updateOrCreate(
                ['id' => $item['hospitalUid']],
                [
                    'id'  => $item['hospitalUid'], 'hospitalName' => $item['hospitalName'],
                    'hospitalAddress'  => $item['hospitalAddress'] , 'name'  => $item['name'],
                    'email'=> $item['email'], 'login_attempt' => $item['login_attempt'], 'comment' => $item['comment'],
                    'password' => $item['password'], 'online' => $item['online'], 'active' => $item['active'],
                    'approve'=> $item['approve'], 'balance'=> $item['balance'], 'bank_info'=> $item['bank_info']
                ]
            );
        }
    }
}
