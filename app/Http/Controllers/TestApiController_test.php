<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Google\Cloud\Core\Timestamp;
use DateTime;
use Log;
use App\ipn_transaction_data;
use Illuminate\Database\QueryException;

class TestApiController_test extends Controller
{
    public function test(Request $request)
    {

    }
    public function processcron(Request $request)
    {
        Log::error("got cron request". $request->token);
    }
    public function testapi(Request $request)
    {
        Log::error("got test exec at request");
        return response()->json(['error'=> 'false','message' => 'done_hey'],200);
    }
    public function processipn_test(Request $request)
    {
        /* Log::error("IPN sent data in test - ". $request);
        
        $val_id = $request->val_id; 
        $store_id = $request->store_id; 
        $store_passwd = "mitso5f4d06a720f6d@ssl"; //my sandbox mitsol2 "mitso5f4d06a720f6d@ssl"; 
        
        $requested_url = ("https://sandbox.sslcommerz.com/validator/api/validationserverAPI.php?val_id=".$val_id."&store_id=".$store_id."&store_passwd=".$store_passwd."&v=1&format=json");
        
        $handle = curl_init();
        curl_setopt($handle, CURLOPT_URL, $requested_url);
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
        
        ////need to check further what to do with these following two fields.
        
        //curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false); # IF YOU RUN FROM LOCAL PC
       // curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false); # IF YOU RUN FROM LOCAL PC
       
        curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, 2);

        $result = curl_exec($handle);
        
        $code = curl_getinfo($handle, CURLINFO_HTTP_CODE);
        
        if($code == 200 && !( curl_errno($handle)))
        {
            
            # TO CONVERT AS ARRAY
            # $result = json_decode($result, true);
            # $status = $result['status'];
            
            # TO CONVERT AS OBJECT
            $result = json_decode($result);
            
            # TRANSACTION INFO
            $status = $result->status;
            $tran_date = $result->tran_date;
            $tran_id = $result->tran_id;
            $val_id = $result->val_id;
            $amount = $result->amount;
            $store_amount = $result->store_amount;
            $currency = $result->currency;
            $bank_tran_id = $result->bank_tran_id;
            $card_type = $result->card_type;
            
            # EMI INFO
            $emi_instalment = $result->emi_instalment;
            $emi_amount = $result->emi_amount;
            $emi_description = $result->emi_description;
            $emi_issuer = $result->emi_issuer;
            
            # ISSUER INFO
            $card_no = $result->card_no;
            $card_issuer = $result->card_issuer;
            $card_brand = $result->card_brand;
            $card_issuer_country = $result->card_issuer_country;
            $card_issuer_country_code = $result->card_issuer_country_code;
            
            # API AUTHENTICATION
            $APIConnect = $result->APIConnect;
            $validated_on = $result->validated_on;
            $gw_version = $result->gw_version;
            
            Log::error("validated return data = ". $result->status); 
            
             
        } else {
            
            //return response()->json(['error'=> 'true','message' => 'Failed to connect with SSLCOMMERZ'],200);
            Log::error("Failed to connect with SSLCOMMERZ");
        } */
        
    }

    
}
