<?php

namespace App\Console\Commands;

use App\HospitalBranch as AppHospitalBranch;
use Illuminate\Console\Command;

class hospitalBranch extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hospitalBranch:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Backup hospital branch';

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

        $branchRef = $database->collection('hospitalBranch');

        $branchDoc = array();
        $hospitalBranch = '';

        foreach($hospital_usersArr as $item){
            //echo $item['id'];
            if(isset($item['hospitalUid']) && !empty($item['hospitalUid'])){
                $query = $branchRef->where('hospitalUserId','=',$item['hospitalUid']);
                $hospitalBranch = $query->documents();
                foreach($hospitalBranch as $item){
                    array_push($branchDoc,$item->data());
                }
            }
            // else{
            //     array_push($branchDoc,$hospitalBranch);
            // }

            //array_push($hospitalUid,$item['id']);
        }

        $branch = array();
        foreach($branchDoc as $item){
            AppHospitalBranch::updateOrCreate(
                ['id' => $item['branchUid']],
                [
                    'id' => $item['branchUid'],'hospitalUserId' => $item['hospitalUserId'],
                    'hospitalName'=> $item['hospitalName'],
                    'branch' => $item['branch'] ,'address' => $item['address']
                ]
            );
        }

    }
}
