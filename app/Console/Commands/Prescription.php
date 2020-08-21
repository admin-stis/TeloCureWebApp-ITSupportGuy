<?php

namespace App\Console\Commands;

use App\Prescription as AppPrescription;
use Illuminate\Console\Command;

class Prescription extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'prescription:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync rescription';

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

        $patRef = $database->collection('users');
        $docRef = $database->collection('doctors');

        $visitRef = $database->collection('visits');

        $prescriptionRef = $database->collection('prescription');

        $visits = $visitRef->documents();

        $visitDoc = array();
        foreach($visits as $val){
            array_push($visitDoc,$val->data());
        }

        $pData = array();
        foreach($visitDoc as $item){
            if($item['patientUid'] != NULL && $item['doctorUid'] != NULL && $item['prescriptionId'] != NULL){
                $prescriptionDoc = $prescriptionRef->document($item['patientUid'])
                    ->collection($item['doctorUid'])
                    ->document($item['prescriptionId'])->snapshot();

                array_push($pData,$prescriptionDoc);
            }
        }

        foreach($pData as $item){
            AppPrescription::updateOrCreate(
                ['id' => $item['prescriptionId']],
                [
                    'id'  => $item['prescriptionId'], 'doctorId'  => $item['doctorId'], 'medicineMap'  => json_encode($item['medicineMap']),
                    'patientId' => $item['patientId'], 'visitId' => $item['visitId'], 'vital' => json_encode($item['vital']),
                    'createdDate'  => $item['createdDate']
                ]
            );
        }

    }
}
