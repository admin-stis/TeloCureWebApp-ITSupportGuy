<?php

namespace App\Console\Commands;

use App\Disease as AppDisease;
use Illuminate\Console\Command;

class Disease extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'disease';

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
        $firestore = app('firebase.firestore');
        $database = $firestore->database();

        $disRef = $database->collection('disease');

        $disDoc = $disRef->documents();

        $d = array();
        $dId = array();

        foreach($disDoc as $item){
            array_push($d,$item->data());
            array_push($dId,$item->id());
        }

        for($i = 0; $i < count($dId); $i++){
            if(isset($d[$i]['name']) && !empty($d[$i]['name']) ){
                $d[$i]['name'] = $d[$i]['name'];
            }else{
                $d[$i]['name'] = '';
            }
            if(isset($d[$i]['details']) && !empty($d[$i]['details']) ){
                $d[$i]['details'] = $d[$i]['details'];
            }else{
                $d[$i]['details'] = '';
            }

            AppDisease::updateOrCreate(
                ['id' => $dId[$i]],
                [
                    'id' => $dId[$i],
                    'name' => $d[$i]['name'],
                    'details' => $d[$i]['details']
                ]
            );

        }

    }
}
