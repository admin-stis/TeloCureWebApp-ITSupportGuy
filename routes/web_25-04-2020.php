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

Route::group(['namespace' => 'Admin','middleware' => ['role:admin','auth']], function () {
    Route::get('admin','AdminController@index');
    Route::get('admin/doctor','AdminDoctorController@index')->name('/admin/doctor');
    Route::get('admin/rejactDoctor/{id}','AdminDoctorController@rejectDoctor')->name('rejectdoctor');
    Route::get('admin/doctor/{status}','AdminDoctorController@docStatus');
    Route::get('admin/approveDocotr/{id}','AdminDoctorController@approveDoctor');
    Route::get('admin/dprofile/{id}','AdminDoctorController@doctorProfileById');
    // Route::get('admin/')

    //patiet
    Route::get('admin/patient','AdminPatientController@index')->name('/admin/patient');
    Route::get('admin/patient/{status}','AdminPatientController@patientStatus')->name('patientstatus');
    Route::get('admin/rejectPatient/{id}','AdminPatientController@rejectPatient');
    Route::get('admin/approvePatient/{id}','AdminPatientController@approvePtient');
    Route::get('admin/pprofile/{id}','AdminPatientController@patientProfileById');


    Route::get('area','AdminFirebaseController@index2')->name('area');
    Route::get('setdoctor','AdminFirebaseController@setdoctors');

});

Route::group(['namespace' => 'Doctor','middleware' => ['role:doctor','auth']], function () {
    Route::get('doctor','DoctorController@index');
});

Route::group(['namespace'=>'Patient','middleware' => ['role:patient','auth']],function(){
    Route::get('patient','PatientController@index');
});

Route::group(['namespace'=>'Hospital','middleware' => ['role:hospital','auth']],function(){
    Route::get('hospital','HospitalController@index');
});

// Route::get('/admin', 'Admin\AdminController@index');
// Route::get('/doctor', 'Doctor\DoctorController@index');
// Route::get('/hospital', 'Hospital\HospitalController@index');
// Route::get('/patient', 'Patient\PatientController@index');
// Route::get('')
Route::get('/test',function() {

	return "i am returning";
})->middleware('role:admin','auth');
