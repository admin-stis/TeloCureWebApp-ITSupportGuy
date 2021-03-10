<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('profileimage', 'PhotouploadController@upload');
Route::get('download/{name}', 'PhotouploadController@download');
//new pres 15-10-20
Route::get('downloadprc/{name}', 'PhotouploadController@downloadprc');
Route::post('doctorDetails', 'PhotouploadController@docterCredential');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('newpatients', 'Api\SetAllUserController@setPatient');
Route::post('newdoctors', 'Api\SetAllUserController@setDoctor');

Route::post('visits', 'Api\TransactionController@transaction');

Route::post('doctorrated', 'Api\TransactionController@rating');
//change prescription name as mew aapi added with same name
Route::post('prescriptionupdate', 'Api\TransactionController@PrescriptionUpdate');
Route::post('transactionhistory', 'Api\TransactionController@transactionHistory');

Route::post('vitals', 'Api\MainController@vitals');
Route::post('refunds', 'Api\MainController@refund');
Route::post('prescriptions', 'Api\MainController@prescription');
Route::post('treatmentRequest', 'Api\MainController@treatmentRequest');

//doctorNotification
Route::post('docNotification', 'doctorNotificationApi@docNotification');

//Ipn sslCommerce 
//Route::post('processipn', 'IpnApiController@processipn');

//for test
//Route::post('processipn_test','TestApiController_test@processipn_test');
//Route::post('processcron','TestApiController_test@processcron');

Route::get('testapi', 'TestApiController_test@testapi');

//twilio sms 
Route::get('twiliosms', 'TwilioController@twiliosms');

//cron-job
Route::post('processcron', 'CronController@processcron');

//prescription
Route::post('prescription', 'PrescriptionController@Prescription');

//prescr download api 
Route::post('prescriptiondownload', 'PrescriptionDownloadController@prescriptiondownload');

//instantSmsSentApi
Route::post('doctorinstantsms', 'DocSmsController@doctorinstantsms');



