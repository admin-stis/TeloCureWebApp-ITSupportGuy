<?php

namespace App\Console\Commands;

use App\Disease;
use App\District;
use Illuminate\Console\Command;
use Log;

class Districts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'district:sync';

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
        Log::info("cron job - district:sync handle method entered: ");
        
        $firestore = app('firebase.firestore');
        $database = $firestore->database();

        $districtsRef = $database->collection('districts');

        $disDoc = $districtsRef->documents();

        $districts = array();

        foreach($disDoc as $item){
            array_push($districts,$item->data());
        }

        foreach($districts as $item){
            District::updateOrCreate(
                ['id' => $item['id']],
                ['active' => $item['active'],'bn_name' => $item['bn_name'],'discount' => $item['discount'],
                'division_id' => $item['division_id'],'est_price' => $item['est_price'],'id' => $item['id'],
                'lat' => $item['lat'],'lon' => $item['lon'],'max_price' => $item['max_price'],
                'min_price' => $item['min_price'],'name' => $item['name']
                ]
            );
        }

    }
}
