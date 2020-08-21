<?php

namespace App\Console\Commands;

use App\TreatmentRequest;
use Illuminate\Console\Command;

class TreamentRequest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tc:sync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync treatment request information';

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
   		$trRef = $database->collection('treatment_requests');
        $snapshot = $trRef->documents();

        $tcData = array();
        foreach($snapshot as $item){
            array_push($tcData,$item->data());
        }

        foreach($tcData as $val){
           
            $tc = TreatmentRequest::updateOrCreate(
                ['id' => $val['treatmentId']],
                [
                    'id' => $val['treatmentId'], 'doctor' => json_encode($val['doctor']), 'doctorId' => $val['doctorId'], 'doctorType' => $val['doctorType'],
                    'latitudePatient' => $val['latitudePatient'], 'longitudePatient' => $val['longitudePatient'],
                    'patient' => json_encode($val['patient']), 'patientId' => $val['patientId'], 'prescriptionId' => $val['prescriptionId'],
                    'prescriptionUpdated' => $val['prescriptionUpdated'], 'callEndTime' => $val['callEndTime'], 'callStartTime' => $val['callStartTime'],
                    'cardType' => $val['cardType'], 'district' => json_encode($val['district']),'newZoneRequest' => $val['newZoneRequest'],
                    'paidAmount' => $val['paidAmount'], 'stat' => $val['stat'], 'surge' => $val['surge'], 'vitalUpdate' => $val['vitalUpdate']
                ]
            );
        }

    }
}
