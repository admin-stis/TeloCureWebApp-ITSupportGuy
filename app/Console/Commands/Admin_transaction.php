<?php

namespace App\Console\Commands;

use App\AdminUserTransactions;
use App\AdminUserTransactionsAdvancedPaid;
use Illuminate\Console\Command;

class Admin_transaction extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin_transaction:sync';

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

        $adminRef = $database->collection('admin');

        $patientRef = $database->collection('users');
   		$patients = $patientRef->documents();

        $snapshot = $adminRef->documents();
        $data['transactionId'] = array();
        $data['transaction'] = array();
        $advanced = array();

        foreach ($snapshot as $document) {

            $id = $document->id();

            foreach($patients as $patient){
                $super = $adminRef->document($id)->collection('userTransactions')
                    ->document($patient->id())->collection('transactions')
                    ->documents();

                $advancedPaid = $adminRef->document($id)->collection('userTransactions')
                    ->document($patient->id())->collection('advancedPaid')
                    ->documents();

                foreach($super as $item){
                    array_push($data['transaction'],$item->data());
                    array_push($data['transactionId'],$item->id());
                }

                foreach($advancedPaid as $item){
                    array_push($advanced,$item->data());
                }

                foreach($advanced as $item){
                    AdminUserTransactionsAdvancedPaid::updateOrCreate(
                        ['id' => $patient->id()],
                        [
                            'id' => $patient->id(), 'balance' => $item['balance'],'updatedTime'=>$item['updatedTime']
                        ]
                    );
                }
            }
        }

        $counter = count($data['transactionId']);


        for($i = 0; $i < $counter; $i++){
            print_r($data['transaction'][0]);

            if(isset($aPIConnect)){
                $aPIConnect =$data['transaction'][$i]['aPIConnect'];
            }else{
                $aPIConnect = '';
            }

            if(isset($data['transaction'][$i]['valid'])){
                $data['transaction'][$i]['valid'] =$data['transaction'][0]['valid'];
            }else{
                $data['transaction'][$i]['valid'] = '';
            }

            if(isset($data['transaction'][$i]['patientUid'])){
                $data['transaction'][$i]['patientUid'] = $data['transaction'][$i]['patientUid'];
            }else{
                $data['transaction'][$i]['patientUid'] = '';
            }

            AdminUserTransactions::updateOrCreate(
                ['id' => $data['transactionId'][$i]],
                [
                    'id' => $data['transactionId'][$i], 'aPIConnect'=> $aPIConnect, 'amount' => $data['transaction'][$i]['amount'],
                    'bankTranId' => $data['transaction'][$i]['bankTranId'], 'baseFair' => $data['transaction'][$i]['baseFair'], 'cardBrand' => $data['transaction'][$i]['cardBrand'], 'cardIssuer'=>$data['transaction'][0]['cardIssuer'],
                    'cardIssuerCountry' => $data['transaction'][$i]['cardIssuerCountry'], 'cardIssuerCountryCode' => $data['transaction'][$i]['cardIssuerCountryCode'], 'cardNo' => $data['transaction'][$i]['cardNo'], 'cardType' => $data['transaction'][$i]['cardType'], 'currencyAmount'=>$data['transaction'][$i]['currencyAmount'],
                    'currencyRate' => $data['transaction'][$i]['currencyRate'], 'currencyType' => $data['transaction'][$i]['currencyType'], 'gwVersion' => $data['transaction'][$i]['gwVersion'], 'riskLevel' => $data['transaction'][$i]['riskLevel'], 'riskTitle' => $data['transaction'][$i]['riskTitle'], 'sessionkey'=>$data['transaction'][$i]['sessionkey'],
                    'status' => $data['transaction'][$i]['status'], 'storeAmount' => $data['transaction'][$i]['storeAmount'], 'tranDate' => $data['transaction'][$i]['tranDate'], 'tranId' => $data['transaction'][$i]['amount'], 'valid' => $data['transaction'][$i]['valid'], 'validatedOn' => $data['transaction'][$i]['validatedOn'], 'valueA'=>$data['transaction'][$i]['valueA'],
                    'valueB' => $data['transaction'][$i]['valueB'], 'valueC' => $data['transaction'][$i]['valueC'], 'valueD' => $data['transaction'][$i]['valueD'],
                    'patientUid' => $data['transaction'][$i]['patientUid']
                ]
            );


        }

    }
}
