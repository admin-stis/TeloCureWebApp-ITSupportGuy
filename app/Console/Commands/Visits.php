<?php

namespace App\Console\Commands;

use App\Visits as AppVisits;
use Illuminate\Console\Command;

class Visits extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'visits:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync visits data';

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
   		$visitsRef = $database->collection('visits');
        $snapshot = $visitsRef->documents();

        $visits = array();
        foreach($snapshot as $item){
            array_push($visits,$item->data());
        }

        foreach($visits as $item){
            $visits = AppVisits::updateOrCreate(
                ['id' => $item['visitId']],
                [
                    'id' => $item['visitId'], 'doctor' => json_encode($item['doctor']), 'doctorUid' => $item['doctorUid'],'doctorType' => $item['doctorType'], 'doctorRated' => $item['doctorRated'],'doctorRatingByPat' => $item['doctorRatingByPat'],
                    'latitudePatient' => $item['latitudePatient'], 'longitudePatient' => $item['longitudePatient'],'patient' => json_encode($item['patient']), 'patientRated' => $item['patientRated'],'patientRatingByDoc' => $item['patientRatingByDoc'],'patientUid' => $item['patientUid'],
                    'prescriptionId' => $item['prescriptionId'], 'prescriptionUpdated' => $item['prescriptionUpdated'], 'transactionHistory' => json_encode($item['transactionHistory']),'callEndTime' => $item['callEndTime'], 'callStartTime' => $item['callStartTime']
                ]
            );
        }

    }
}
