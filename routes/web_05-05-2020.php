<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//section for fontend

// end section of fontend

// Route::get('/', function () {
//     return view('welcome');
// });

// Route for frontend

Route::get('/service/{title}', 'Frontend\FrontendController@services');
Route::get('/about', 'Frontend\FrontendController@about');
Route::get('/privacy','Frontend\FrontendController@privacy');
Route::get('/appsprivacy','Frontend\FrontendController@appsprivacy');
Route::get('/privacy/patientprivacy','Frontend\FrontendController@patientprivacy');
Route::get('/privacy/healthinfo','Frontend\FrontendController@healthinfo');
Route::get('/help/{title}','Frontend\FrontendController@help');
Route::get('/contact','Frontend\FrontendController@contact');

Route::get('/registerarea','Frontend\FrontendController@registerArea');
Route::get('/loginarea','Frontend\FrontendController@loginArea');

// End

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['namespace' => 'Frontend'], function () {
    Route::get('/','FrontendController@index');
    Route::get('/service/{title}', 'FrontendController@services');
    Route::get('/profile/{title}', 'FrontendController@profile');
    // Route::get('/privacy','FrontendController@privacy');
    // Route::get('/help/{title}','FrontendController@help');
    Route::get('/register/{title}','FrontendController@registerUser');
    Route::get('/login/{title}','FrontendController@loginUser');
});
Auth::routes(['verify' => true]);
Route::get('/2fa', 'TwoFactorController@showTwoFactorForm')->name('2fa');
Route::post('/2fa', 'TwoFactorController@verifyTwoFactor')->name('2fa');
Route::get('hello',function(){
    return "This is a hello";
})->middleware('verified');

// Route::group(['namespace' => 'Admin','middleware' => ['role:admin','auth']], function () {
Route::group(['namespace' => 'Admin'], function () {
    Route::get('admin','AdminController@index');
    Route::get('admin/doctor','AdminDoctorController@index')->name('/admin/doctor');
    Route::get('admin/rejactDoctor/{id}','AdminDoctorController@rejectDoctor')->name('rejectdoctor');
    Route::get('admin/doctor/{status}','AdminDoctorController@docStatus');
    Route::get('admin/approveDocotr/{id}','AdminDoctorController@approveDoctor');
    Route::get('admin/activeDoctor/{id}','AdminDoctorController@activeDoctor');
    Route::get('admin/deactiveDoctor/{id}','AdminDoctorController@deactiveDoctor');
    Route::get('admin/dprofile/{id}','AdminDoctorController@doctorProfileById');
    // Route::get('admin/')

    //patient
    Route::get('admin/patient','AdminPatientController@index')->name('/admin/patient');
    Route::get('admin/patient/{status}','AdminPatientController@patientStatus')->name('patientstatus');
    Route::get('admin/rejectPatient/{id}','AdminPatientController@rejectPatient');
    Route::get('admin/approvePatient/{id}','AdminPatientController@approvePtient');
    Route::get('admin/pprofile/{id}','AdminPatientController@patientProfileById');
    Route::get('admin/activeUser/{id}','AdminDoctorController@activeUser');
    Route::get('admin/deactiveUser/{id}','AdminDoctorController@deactiveUser');


    Route::get('area','AdminFirebaseController@index2')->name('area');
    // Route::get('setdoctor','AdminFirebaseController@setdoctors');


});

// 27-04-2020

Route::get('doctor/rev/{id}','Doctor\DoctorController@revenueById');
// End

//Edited 20-04-2020

Route::group(['namespace' => 'Admin'], function () {
    Route::post('setdoctor','AdminFirebaseController@setdoctors');
    Route::post('setpatient','AdminFirebaseController@setpatients');
});

Route::group(['namespace' => 'Admin'], function () {
    Route::post('loggedin','AdminFirebaseController@loggedIn');
});

Route::group(['prefix' => 'doctor','namespace' => 'Admin'], function () {
    Route::post('complete-profileAction','AdminDoctorController@completeProfileAction');
});

Route::group(['prefix' => 'doctor','namespace' => 'Doctor'], function () {
    Route::get('/profile/{id}','DoctorController@profile');
});

Route::get('admin/revenue','Admin\AdminController@revenue');
Route::get('admin/doctorInfo','Admin\AdminController@doctorInfo');
Route::get('admin/patientInfo','Admin\AdminController@patientInfo');
Route::get('admin/regUser','Admin\AdminController@regUser');
Route::get('admin/visitors','Admin\AdminController@visitors');
Route::get('admin/transaction/{visited}','Admin\AdminController@transactionHistory');

Route::get('admin/doctorTransactionData','Admin\AdminDoctorController@doctorTransactionInfo');

Route::get('admin/districtDoctor','Admin\AdminFirebaseController@districtDoctor');


Route::get('admin/servicenav','Admin\AdminServiceController@index');

//end

Route::group(['namespace' => 'Doctor','middleware' => ['role:doctor','auth']], function () {
    Route::get('doctor','DoctorController@index');
});

Route::get('doctor/profile','Doctor\DoctorController@completeProfile');

Route::group(['namespace'=>'Patient','middleware' => ['role:patient','auth']],function(){
    Route::get('patient','PatientController@index');
});

Route::group(['namespace'=>'Hospital','middleware' => ['role:hospital','auth']],function(){
    Route::get('hospital','HospitalController@index');
});

// Route::get('/admin', 'Admin\AdminController@index');
Route::get('/doctor', 'Doctor\DoctorController@index');
// Route::get('/hospital', 'Hospital\HospitalController@index');
Route::get('/patient', 'Patient\PatientController@index');

// Route::get('')
Route::get('/test',function() {

	return "i am returning";
})->middleware('role:admin','auth');


// 29-04-2020
Route::get('/patient', 'Patient\PatientController@index');
Route::group(['namespace'=>'Patient'],function(){
    Route::get('patient/diagnosis/{uid}','PatientController@diagnosis');
    Route::get('patient/eprescription/{uid}','PatientController@ePrescription');
    Route::get('patient/prescription/details/{pId}/{dId}/{prescriptionId}','PatientController@ePrescriptionDetails');
    Route::get('patient/diagnosis/{pId}/{dId}/{prescriptionId}','PatientController@diagnosis');
    Route::get('patient/edit/{id}','PatientController@edit');
    Route::POST('patient/editAction/{id}','PatientController@editAction');
    Route::get('patient/profile','PatientController@profile');
});
//end
