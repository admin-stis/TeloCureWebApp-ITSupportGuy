<?php 
 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Auth\MailSendController;

use App\Mail\sendLink;
use App\Mail\SendRequest;
use Mail;
use Log;
use Illuminate\Support\Facades\DB;
//use Artisan; //for artisan command execute without command line 

// include composer autoload
//require 'custom_vendor/autoload.php';

// import the Intervention Image Manager Class
//use Intervention\Image\ImageManager;
//use Spatie\ImageOptimizer\OptimizerChainFactory;

//require_once 'dompdf/autoload.php';
//use Dompdf\Dompdf;

require_once 'mpdf/autoload.php';

class TestController extends Controller
{
    public function test_form(Request $request)
    {
      
    }
    public function test(Request $request)
    {
        try {
            //firebase codes
            $firestore = app('firebase.firestore');
            $database = $firestore->database();
            $visitsRef = $database->collection('visits');
            
            $visitDoc = $visitsRef->document($request->vid)->snapshot()->data();

            dd($visitDoc);
            
        } catch(\Exception $e){
            dd($e);
        }
    }
}
