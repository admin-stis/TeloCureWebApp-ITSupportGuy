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
Route::post('profileimage','PhotouploadController@upload');
Route::get('download/{name}','PhotouploadController@download');
Route::post('doctorDetails','PhotouploadController@docterCredential');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('newpatients','Api\SetAllUserController@setPatient');
Route::post('newdoctors','Api\SetAllUserController@setDoctor');

Route::post('visits','Api\TransactionController@transaction');

Route::post('vitals','Api\MainController@vitals');
Route::post('refunds','Api\MainController@refund');
Route::post('prescriptions','Api\MainController@prescription');
Route::post('treatmentRequest','Api\MainController@treatmentRequest');


Route::get('twilioSms','TwilioSmsController@twilio_sms');