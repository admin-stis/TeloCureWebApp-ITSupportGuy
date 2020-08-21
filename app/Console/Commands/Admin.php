<?php

namespace App\Console\Commands;

use App\Admin as AppAdmin;
use Illuminate\Console\Command;

class Admin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync admin data';

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
   		$adminRef = $database->collection('admin');
        $snapshot = $adminRef->documents();

        $admin = array();
        foreach($snapshot as $item){
            array_push($admin,$item->data());
            //array_push($adminId,$item->id());
        }

        foreach($admin as $item){

            $adminData = AppAdmin::updateOrCreate(
                ['id' => 'super'],
                [
                    'id' => 'super' ,'balance' => $item['balance'],
                    'email' => $item['email'],'advancedPaid' => $item['advancedPaid'],
                    'password' => $item['password'],
                ]
            );

        }
    }
}
