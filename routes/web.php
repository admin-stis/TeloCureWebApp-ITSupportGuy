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

//localization
Route::get('lang/{locale}', function ($locale) {
    session()->put('locale', $locale);
    return redirect()->back();
});

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

Route::get('/refund','Frontend\FrontendController@refund');
Route::get('/terms','Frontend\FrontendController@terms');
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
Route::group(['namespace' => 'Admin' ,'middleware' => 'checkuser' ], function () {

    Route::get('admin','AdminController@index');
    Route::get('admin/doctor','AdminDoctorController@index')->name('/admin/doctor');
    Route::get('admin/rejactDoctor/{id}','AdminDoctorController@rejectDoctor')->name('rejectdoctor');
    Route::get('admin/doctor/{status}','AdminDoctorController@docStatus');
    Route::get('admin/approveDocotr/{id}','AdminDoctorController@approveDoctor');
    Route::get('admin/activeDoctor/{id}','AdminDoctorController@activeDoctor');
    Route::get('admin/deactiveDoctor/{id}','AdminDoctorController@deactiveDoctor');
    Route::get('admin/dprofile/{id}','AdminDoctorController@doctorProfileById');

    Route::any('admin/updateBankInfo/{id}','AdminFirebaseController@updateBankInfo');

    Route::any('admin/district','AdminFirebaseController@manageDistrict');

    // Route::get('admin/')

    //patient
    Route::get('admin/patient','AdminPatientController@index')->name('/admin/patient');
    Route::get('admin/patient/{status}','AdminPatientController@patientStatus')->name('patientstatus');
    Route::get('admin/rejectPatient/{id}','AdminPatientController@rejectPatient');
    Route::get('admin/approvePatient/{id}','AdminPatientController@approvePtient');
    Route::get('admin/pprofile/{id}','AdminPatientController@patientProfileById');
    Route::get('admin/activeUser/{id}','AdminDoctorController@activeUser');
    Route::get('admin/deactiveUser/{id}','AdminDoctorController@deactiveUser');

    //Hospital
    Route::get('admin/hospital','AdminHospitalController@index');
    Route::get('admin/hospital/subscriptionplan','AdminHospitalController@subscription-plan');
    Route::get('admin/approveHospitalUser/{id}','AdminHospitalController@approveHospitalUser');
    Route::post('admin/hospital/newPass','AdminController@newPass');
    // Route::post('admin/hospital/newPass','AdminController@newPass');
    Route::get('area','AdminFirebaseController@index2')->name('area');
    // Route::get('setdoctor','AdminFirebaseController@setdoctors');
    Route::get('admin/hospitalUser/{status}','AdminHospitalController@hosStatus');

    Route::get('admin/servicenav','AdminServiceController@index');

});

// 27-04-2020

Route::get('doctor/rev/{id}','Doctor\DoctorController@revenueById');
//12-05-2020
Route::get('doctor/update/{uid}','Doctor\DoctorController@updateProfile');
Route::post('doctor/update-profileAction','Admin\AdminDoctorController@updateProfileAction');
Route::get('admin/hospital/revenueinfo/{id}','Hospital\HospitalController@hosRev');
Route::get('admin/hospital/branch/{id}','Hospital\HospitalController@branch');
Route::post('admin/hospital/addBranchAction','Hospital\HospitalController@addBranchAction');

Route::get('hospital/rev/{uid}','Hospital\HospitalController@totalRevenue');
Route::get('admin/hospital/delbranch/{id}','Hospital\HospitalController@delBranch');


// End

//Edited 20-04-2020

Route::group(['namespace' => 'Admin'], function () {
    Route::post('setdoctor','AdminFirebaseController@setdoctors');
    Route::post('setpatient','AdminFirebaseController@setpatients');
    Route::post('sethospitaluser','AdminFirebaseController@sethospitalusers');
});

Route::group(['namespace' => 'Admin'], function () {
    Route::post('loggedin','AdminFirebaseController@loggedIn');
});

Route::group(['prefix' => 'doctor','namespace' => 'Admin'], function () {
    Route::post('complete-profileAction','AdminDoctorController@completeProfileAction');
});

Route::group(['prefix' => 'doctor','namespace' => 'Doctor'], function () {
    Route::get('/profile/{id}','DoctorController@profile');
    Route::get('/fares/{id}', 'DoctorController@fares');
});

Route::get('admin/revenue','Admin\AdminController@revenue');
Route::get('admin/doctorInfo','Admin\AdminController@doctorInfo');
Route::get('admin/patientInfo','Admin\AdminController@patientInfo');
Route::get('admin/regUser','Admin\AdminController@regUser');
Route::get('admin/visitors','Admin\AdminController@visitors');
Route::get('admin/transaction/{visited}','Admin\AdminController@transactionHistory');
Route::get('admin/doctorTransactionData','Admin\AdminDoctorController@doctorTransactionInfo');
Route::get('admin/districtDoctor','Admin\AdminFirebaseController@districtDoctor');
//Route::get('admin/servicenav','Admin\AdminServiceController@index');

//end

Route::group(['namespace' => 'Doctor','middleware' => 'checkDoctor'], function () {
    Route::get('doctor','DoctorController@index');
    Route::get('doctor/video','DoctorController@video');
    Route::get('doctor/help','DoctorController@portalHelp');
});

Route::get('doctor/profile','Doctor\DoctorController@completeProfile');

Route::get('doctor/profile/edit/{id}','Doctor\DoctorController@edit');
Route::post('doctor/profile/editAction','Doctor\DoctorController@editAction');


Route::group(['namespace'=>'Patient','middleware' => ['role:patient','auth']],function(){
    Route::get('patient','PatientController@index');
});

Route::group(['namespace'=>'Hospital','middleware' => ['role:hospital','auth']],function(){
    Route::get('hospital','HospitalController@index');
});

// Route::get('/admin', 'Admin\AdminController@index');
//Route::get('/doctor', 'Doctor\DoctorController@index');
// Route::get('/hospital', 'Hospital\HospitalController@index');
Route::get('/patient', 'Patient\PatientController@index');

// Route::get('')
Route::get('/test',function() {

	return "i am returning";
})->middleware('role:admin','auth');


// 29-04-2020
//Route::get('/patient', 'Patient\PatientController@index');

Route::group(['namespace'=>'Patient', 'middleware' => 'checkPatient'],function(){
    Route::get('patient', 'PatientController@index');
    Route::get('patient/diagnosis/{uid}','PatientController@diagnosis');
    Route::get('patient/eprescription/{uid}','PatientController@ePrescription');
    Route::get('patient/prescription/details/{pId}/{dId}/{prescriptionId}','PatientController@ePrescriptionDetails');
    Route::get('patient/diagnosis/{pId}/{dId}/{prescriptionId}','PatientController@diagnosis');
    Route::get('patient/edit/{id}','PatientController@edit');
    Route::POST('patient/editAction/{id}','PatientController@editAction');
    Route::get('patient/profile','PatientController@profile');
});
//end

Route::group(['namespace'=>'Hospital', 'middleware' => 'checkHospital'],function(){
    Route::get('/hospital', 'HospitalController@index');
    Route::get('admin/hospital/addhospital/{id}','HospitalController@addHospital');
    Route::post('admin/hospital/addHospitalAction','HospitalController@addHospitalAction');
    Route::get('admin/hospital/profile/{uid}','HospitalController@profile');
    Route::get('hospital/addDoctor/{uid}','HospitalController@addDoctor');
    Route::post('admin/hospital/addDoctorAction','HospitalController@addDoctorAction');
    Route::get('hospital/deleteDoctor/{uid}','HospitalController@deleteDoctor');
    Route::get('admin/hospital/deletehos/{uid}','HospitalController@deletehos');
    Route::get('/hospital/viewDoctor/{uid}','HospitalController@viewDoctor');
    Route::get('hospital/help','HospitalController@portalHelp');
    Route::get('hospital/bankinfo','HospitalController@bank_info');
    Route::post('hospital/addBank_infoAction','HospitalController@addBank_infoAction');
});

Route::get('admin/gethospital','Admin\AdminController@hospital');
Route::get('admin/hospital/getBranch/{id}','Admin\AdminController@branch');
Route::get('linkdoctor/{uid}/{email}/{otp}','Hospital\HospitalController@linkForDoctor');

Route::get('link/{uid}/{email}/{otp}','Hospital\HospitalController@link');



// password reset link
Route::get('passwordreset/{title}','Admin\AdminFirebaseController@resetPasswordForm');
Route::post('sendTempOtp/{title}','Admin\AdminFirebaseController@sendTempOtp');

Route::post('subscribe','Admin\AdminFirebaseController@subscribe'); //subscribe

Route::post('contact','Admin\AdminFirebaseController@contactus'); //contactus mail

// plan
Route::get('hospital/planchange/{id}', 'Admin\AdminHospitalController@planFrom');

Route::post('hospital/planchangeaction', 'Admin\AdminHospitalController@changePlan');

//mobi-notification
Route::get('NotificationApi/mobidocnotification/{token}/{sender_name}/{sender_photo}/{sender_id}','Admin\AdminFirebaseController@mobinotification');

//change password
Route::get('changepassword/{title}/{id}','Admin\AdminFirebaseController@changePassword');
Route::post('changepassword','Admin\AdminFirebaseController@changePasswordAction');
