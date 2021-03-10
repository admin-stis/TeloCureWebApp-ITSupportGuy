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



//use Illuminate\Support\Facades\Session;
//use Log;

//localization
Route::get('lang/{locale}', function ($locale) {
    session()->put('locale', $locale);
    return redirect()->back();
});

//just to test cron 
Route::get('/checkcron', function () {
    try {
        Artisan::call('schedule:run');
    } catch (\Exception $e) {
        /*              $err_output = "Errors - ";
            if (is_array($e->errorInfo)) {
                $err_output .=  implode(",", $e->errorInfo);
            } else {
                $err_output .= $e->errorInfo;
            }  */
        dd($e);
        //Session::flash('msg', $err_output);
        //Log::info("eee");
    }
});

Route::get('perm_error', function () {
    return view('errors.no_permission');
});

// Route for frontend

Route::get('/service/{title}', 'Frontend\FrontendController@services');
Route::get('/about', 'Frontend\FrontendController@about');
Route::get('/ourDoctor', 'Frontend\FrontendController@ourDoctor');



Route::get('/privacy', 'Frontend\FrontendController@privacy');
Route::get('/appsprivacy', 'Frontend\FrontendController@appsprivacy');
Route::get('/privacy/patientprivacy', 'Frontend\FrontendController@patientprivacy');
Route::get('/privacy/healthinfo', 'Frontend\FrontendController@healthinfo');
Route::get('/help/{title}', 'Frontend\FrontendController@help');
Route::get('/contact', 'Frontend\FrontendController@contact');

Route::get('/registerarea', 'Frontend\FrontendController@registerArea');
Route::get('/loginarea', 'Frontend\FrontendController@loginArea');

Route::get('/refund', 'Frontend\FrontendController@refund');
Route::get('/terms', 'Frontend\FrontendController@terms');
// End

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['namespace' => 'Frontend'], function () {
    Route::get('/', 'FrontendController@index');
    Route::get('/service/{title}', 'FrontendController@services');
    Route::get('/profile/{title}', 'FrontendController@profile');
    // Route::get('/privacy','FrontendController@privacy');
    // Route::get('/help/{title}','FrontendController@help');
    Route::get('/register/{title}', 'FrontendController@registerUser')->name('register');
    Route::get('/login/{title}', 'FrontendController@loginUser');
});


Auth::routes(['verify' => true]);
Route::get('/2fa', 'TwoFactorController@showTwoFactorForm')->name('2fa');
Route::post('/2fa', 'TwoFactorController@verifyTwoFactor')->name('2fa');
Route::get('hello', function () {
    return "This is a hello";
})->middleware('verified');

// Route::group(['namespace' => 'Admin','middleware' => ['role:admin','auth']], function () {
Route::group(['namespace' => 'Admin', 'middleware' => 'checkuser'], function () {

    Route::get('admin', 'AdminController@index');
    Route::get('admin/doctor', ['view_perm' => 'view_doctor', 'uses' => 'AdminDoctorController@index'])->name('/admin/doctor');
    Route::get('admin/ourDoctor', 'AdminDoctorController@ourDoctor')->name('/admin/ourDoctor');
    Route::get('admin/smsdocpat', 'AdminDoctorController@smsDocPat');
    Route::get('admin/rejactDoctor/{id}', ['approve_perm' => 'Approve', 'uses' => 'AdminDoctorController@rejectDoctor'])->name('rejectdoctor');
    Route::get('admin/doctor/{status}', ['view_perm' => 'view_doctor', 'uses' => 'AdminDoctorController@docStatus']);
    Route::get('admin/approveDocotr/{id}', ['approve_perm' => 'Approve', 'uses' => 'AdminDoctorController@approveDoctor']);
    Route::get('admin/activeDoctor/{id}', ['approve_perm' => 'Approve', 'uses' => 'AdminDoctorController@activeDoctor']);
    Route::get('admin/deactiveDoctor/{id}', ['approve_perm' => 'Approve', 'uses' => 'AdminDoctorController@deactiveDoctor']);
    Route::get('admin/dprofile/{id}', ['view_perm' => 'view_doctor', 'uses' => 'AdminDoctorController@doctorProfileById']);

    Route::get('admin/dprofileDelAction/{id}', ['delete_perm' => 'Delete', 'uses' => 'AdminDoctorController@doctorProfileDeleteId']);
    Route::get('admin/makedocoffline/{id}', ['edit_perm' => 'Edit', 'uses' => 'AdminDoctorController@MakeDoctorOffline']);

    //mridul 22-7-20
    Route::get('admin/dprofileEdit/{id}', ['edit_perm' => 'Edit', 'uses' => 'AdminDoctorController@doctorProfileEdit']);
    Route::post('admin/dprofileEditAction', ['edit_perm' => 'Edit', 'uses' => 'AdminDoctorController@doctorProfileEditAction']);
    Route::any('admin/updateBankInfo/{id}', ['edit_perm' => 'Edit', 'uses' => 'AdminFirebaseController@updateBankInfo']);
    //need to put logic for "any" http method else editable
    Route::any('admin/district', ['view_perm' => 'view_district', 'uses' => 'AdminFirebaseController@manageDistrict']);
    Route::any('admin/districtDiscount', ['view_perm' => 'view_district_discount', 'uses' => 'AdminFirebaseController@manageDistrictDiscount']);

    //patient
    Route::get('admin/patient', ['view_perm' => 'view_patient', 'uses' => 'AdminPatientController@index'])->name('/admin/patient');
    Route::get('admin/patient/{status}',  ['view_perm' => 'view_patient', 'uses' => 'AdminPatientController@patientStatus'])->name('patientstatus');
    Route::get('admin/rejectPatient/{id}', ['approve_perm' => 'Approve', 'uses' => 'AdminPatientController@rejectPatient']);
    Route::get('admin/approvePatient/{id}', ['approve_perm' => 'Approve', 'uses' => 'AdminPatientController@approvePtient']);
    Route::get('admin/pprofile/{id}',  ['view_perm' => 'view_patient', 'uses' => 'AdminPatientController@patientProfileById']);
    Route::get('admin/activeUser/{id}', ['approve_perm' => 'Approve', 'uses' => 'AdminPatientController@activeUser']);
    Route::get('admin/deactiveUser/{id}', ['approve_perm' => 'Approve', 'uses' => 'AdminPatientController@deactiveUser']);
    Route::get('admin/patientProfileDeleteId/{id}', ['delete_perm' => 'Delete', 'uses' => 'AdminPatientController@patientProfileDeleteId']);
    Route::get('admin/patientwallet', ['view_perm' => 'view_patient', 'uses' => 'AdminPatientController@PatientWallet']);
    Route::get('admin/pwalletEdit/{id}/{name}', ['edit_perm' => 'Edit', 'uses' => 'AdminPatientController@patientWalletEdit']);
    Route::post('admin/pwalletEditAction', ['edit_perm' => 'Edit', 'uses' => 'AdminPatientController@patientWalletEditAction']);

    //Hospital
    Route::get('admin/hospital',  ['view_perm' => 'view_hospital', 'uses' => 'AdminHospitalController@index']);
    Route::get('admin/hospital/subscriptionplan', ['edit_perm' => 'Edit', 'uses' => 'AdminHospitalController@subscription-plan']);
    Route::get('admin/approveHospitalUser/{id}', ['approve_perm' => 'Approve', 'uses' => 'AdminHospitalController@approveHospitalUser']);
    Route::post('admin/hospital/newPass', ['edit_perm' => 'Edit', 'uses' => 'AdminController@newPass']);
    // Route::post('admin/hospital/newPass','AdminController@newPass');
    Route::get('area', 'AdminFirebaseController@index2')->name('area');
    // Route::get('setdoctor','AdminFirebaseController@setdoctors');
    Route::get('admin/hospitalUser/{status}', ['view_perm' => 'view_hospital', 'uses' => 'AdminHospitalController@hosStatus']);

    Route::get('admin/chart', 'AdminServiceController@index');
    Route::get('admin/servicefinancial', ['view_perm' => 'view_service_finance', 'uses' => 'AdminServiceController@servicefinancial']);
    Route::get('admin/service', ['view_perm' => 'view_service_finance', 'uses' => 'AdminServiceController@serviceInfo']);
    Route::get('admin/finance', ['view_perm' => 'view_service_finance', 'uses' => 'AdminServiceController@financialInfo']);
    //10-2-21
    Route::get('admin/completecalls', ['view_perm' => 'view_service_finance', 'uses' => 'AdminServiceController@completecalls']);
    Route::get('admin/incompletecalls', ['view_perm' => 'view_service_finance', 'uses' => 'AdminServiceController@incompletecalls']);

    Route::get('admin/processManagePay', ['view_perm' => 'view_manage_payments', 'uses' => 'AdminDoctorController@processManagePay']);
    Route::post('admin/processManagePayPass', ['view_perm' => 'view_manage_payments', 'uses' => 'AdminDoctorController@processManagePayPass']);
    //Route::get('admin/processManagePay', ['view_perm'=>'view_manage_payments','uses'=>'AdminFirebaseController@ProcessManagePay']);
    Route::get('admin/settings', ['view_perm' => 'view_settings', 'uses' => 'AdminFirebaseController@ManageSettings']);
    //authorization routes start
    Route::get('admin/rolesettings', ['user_perm' => 'super', 'uses' => 'AdminController@rolesettings']);
    Route::get('admin/addrole', ['user_perm' => 'super', 'uses' => 'AdminController@addrole']);
    Route::post('admin/addroleaction', ['user_perm' => 'super', 'uses' => 'AdminController@addroleaction']);

    //here permission parameter added in routes to prevent access to it without the permission which route does
    Route::get('admin/editrole/{id}', ['user_perm' => 'super', 'uses' => 'AdminController@editrole']);
    Route::post('admin/editroleaction', ['user_perm' => 'super', 'uses' => 'AdminController@editroleaction']);

    Route::get('admin/adduser', ['user_perm' => 'super', 'uses' => 'AdminController@adduser']);
    Route::post('admin/adduseraction', ['user_perm' => 'super', 'uses' => 'AdminController@adduseraction']);

    Route::get('admin/edituser/{id}', ['user_perm' => 'super', 'uses' => 'AdminController@edituser']);
    Route::post('admin/edituseraction', ['user_perm' => 'super', 'uses' => 'AdminController@edituseraction']);

    Route::get('admin/deleterole/{id}', ['user_perm' => 'super', 'uses' => 'AdminController@deleterole']);

    Route::get('admin/deleteuser/{id}', ['user_perm' => 'super', 'uses' => 'AdminController@deleteuser']);
    //admin/rolesettings
});

// 27-04-2020

Route::get('doctor/rev/{id}', 'Doctor\DoctorController@revenueById');
//12-05-2020
Route::get('doctor/update/{uid}', 'Doctor\DoctorController@updateProfile');
Route::post('doctor/update-profileAction', 'Admin\AdminDoctorController@updateProfileAction');
Route::get('admin/hospital/revenueinfo/{id}', 'Hospital\HospitalController@hosRev');
Route::get('admin/hospital/branch/{id}', 'Hospital\HospitalController@branch');
Route::post('admin/hospital/addBranchAction', 'Hospital\HospitalController@addBranchAction');

Route::get('hospital/rev/{uid}', 'Hospital\HospitalController@totalRevenue');
Route::get('admin/hospital/delbranch/{id}', 'Hospital\HospitalController@delBranch');


// End

//Edited 20-04-2020

Route::group(['namespace' => 'Admin'], function () {
    Route::post('setdoctor', 'AdminFirebaseController@setdoctors');
    Route::post('setpatient', 'AdminFirebaseController@setpatients');
    Route::post('sethospitaluser', 'AdminFirebaseController@sethospitalusers');
});

Route::group(['namespace' => 'Admin'], function () {
    Route::post('loggedin', 'AdminFirebaseController@loggedIn');
});

Route::group(['prefix' => 'doctor', 'namespace' => 'Admin'], function () {
    Route::post('complete-profileAction', 'AdminDoctorController@completeProfileAction');
});

Route::group(['prefix' => 'doctor', 'namespace' => 'Doctor'], function () {
    Route::get('/profile/{id}', 'DoctorController@profile');
    Route::get('/fares/{id}', 'DoctorController@fares');
});

Route::get('admin/revenue', 'Admin\AdminController@revenue');

Route::any('admin/revenue1/{date}', 'Admin\AdminController@revenueByDate');
Route::any('admin/revenue2/{month}', 'Admin\AdminController@revenueByMonth');
Route::any('admin/revenue3/{year}', 'Admin\AdminController@revenueByYear');
Route::any('admin/revenue4/{week}', 'Admin\AdminController@revenueByWeek');

Route::any('admin/visitors1/{date}', 'Admin\AdminController@visitorsByDate');
Route::any('admin/visitors2/{month}', 'Admin\AdminController@visitorsByMonth');
Route::any('admin/visitors3/{year}', 'Admin\AdminController@visitorsByYear');
Route::any('admin/visitors4/{week}', 'Admin\AdminController@visitorsByWeek');

//testing route for paging
Route::get('admin/getNextVisits/{lastVisitId}', 'Admin\AdminServiceController@GetNextPageVisits');


Route::get('admin/doctorInfo', 'Admin\AdminController@doctorInfo');
Route::get('admin/patientInfo', 'Admin\AdminController@patientInfo');
Route::get('admin/regUser', 'Admin\AdminController@regUser');
Route::any('admin/regUserDateWise/{date}', 'Admin\AdminController@regUserDateWise');
Route::get('admin/visitors', 'Admin\AdminController@visitors');
Route::get('admin/transaction/{visited}', 'Admin\AdminController@transactionHistory');
////16/1/21
Route::get('admin/doctorTransactionData', ['view_perm' => 'perm_name', 'uses' => 'Admin\AdminDoctorController@doctorTransactionInfo']);

//)->middleware('checkuser');
Route::get('admin/districtDoctor', 'Admin\AdminFirebaseController@districtDoctor');
//Route::get('admin/servicenav','Admin\AdminServiceController@index');

//end
//new 20-07-2020
Route::get('admin/doctorInfoByDistrict', 'Admin\AdminController@doctorInfoByDistrict');
Route::get('admin/visitInfoByDistrict', 'Admin\AdminController@visitInfoByDistrict');


Route::group(['namespace' => 'Doctor', 'middleware' => 'checkDoctor'], function () {
    Route::get('doctor', 'DoctorController@index');
    Route::get('doctor/video', 'DoctorController@video');
    Route::get('doctor/help', 'DoctorController@portalHelp');
    Route::get('doctor/prescription/{uid}/{did}/{pid}', 'DoctorController@prescription');
});

Route::get('doctor/profile', 'Doctor\DoctorController@completeProfile');

Route::get('doctor/profile/edit/{id}', 'Doctor\DoctorController@edit');
Route::post('doctor/profile/editAction', 'Doctor\DoctorController@editAction');


Route::group(['namespace' => 'Patient', 'middleware' => ['role:patient', 'auth']], function () {
    Route::get('patient', 'PatientController@index');
});

Route::group(['namespace' => 'Hospital', 'middleware' => ['role:hospital', 'auth']], function () {
    Route::get('hospital', 'HospitalController@index');
});

// Route::get('/admin', 'Admin\AdminController@index');
//Route::get('/doctor', 'Doctor\DoctorController@index');
// Route::get('/hospital', 'Hospital\HospitalController@index');
Route::get('/patient', 'Patient\PatientController@index');

// Route::get('')
Route::get('/test', function () {

    return "i am returning";
})->middleware('role:admin', 'auth');


// 29-04-2020
//Route::get('/patient', 'Patient\PatientController@index');

Route::group(['namespace' => 'Patient', 'middleware' => 'checkPatient'], function () {
    Route::get('patient', 'PatientController@index');
    Route::get('patient/diagnosis/{uid}', 'PatientController@diagnosis');
    Route::get('patient/eprescription/{uid}', 'PatientController@ePrescription');
    Route::get('patient/prescription/details/{pId}/{dId}/{prescriptionId}', 'PatientController@ePrescriptionDetails');
    Route::get('patient/diagnosis/{pId}/{dId}/{prescriptionId}', 'PatientController@diagnosis');
    Route::get('patient/edit/{id}', 'PatientController@edit');
    Route::POST('patient/editAction/{id}', 'PatientController@editAction');
    Route::get('patient/profile', 'PatientController@profile');
    Route::get('patient/help', 'PatientController@help');
});
//end

Route::group(['namespace' => 'Hospital', 'middleware' => 'checkHospital'], function () {
    Route::get('/hospital', 'HospitalController@index');
    Route::get('admin/hospital/addhospital/{id}', 'HospitalController@addHospital');
    Route::post('admin/hospital/addHospitalAction', 'HospitalController@addHospitalAction');
    Route::get('admin/hospital/profile/{uid}', 'HospitalController@profile');
    Route::get('hospital/addDoctor/{uid}', 'HospitalController@addDoctor');
    Route::post('admin/hospital/addDoctorAction', 'HospitalController@addDoctorAction');
    Route::get('hospital/deleteDoctor/{uid}', 'HospitalController@deleteDoctor');
    Route::get('admin/hospital/deletehos/{uid}', 'HospitalController@deletehos');
    Route::get('/hospital/viewDoctor/{uid}', 'HospitalController@viewDoctor');
    Route::get('hospital/help', 'HospitalController@portalHelp');
    Route::get('hospital/bankinfo', 'HospitalController@bank_info');
    Route::post('hospital/addBank_infoAction', 'HospitalController@addBank_infoAction');
});

Route::get('/hospital/revenue', 'Hospital\HospitalController@revForHospital');
Route::any('/hospital/revenue/{date}', 'Hospital\HospitalController@revByDate');
Route::get('/hospital/revenuebymonth/{month}', 'Hospital\HospitalController@revByMonth');
Route::get('/hospital/revenuebyyear/{year}', 'Hospital\HospitalController@revByYear');

Route::get('admin/gethospital', 'Admin\AdminController@hospital');
Route::get('admin/hospital/getBranch/{id}', 'Admin\AdminController@branch');
Route::get('linkdoctor/{uid}/{email}/{otp}', 'Hospital\HospitalController@linkForDoctor');

Route::get('link/{uid}/{email}/{otp}', 'Hospital\HospitalController@link');

// password reset link
Route::get('passwordreset/{title}', 'Admin\AdminFirebaseController@resetPasswordForm');
Route::post('sendTempOtp/{title}', 'Admin\AdminFirebaseController@sendTempOtp');

Route::post('subscribe', 'Admin\AdminFirebaseController@subscribe'); //subscribe

Route::post('contact', 'Admin\AdminFirebaseController@contactus'); //contactus mail

// plan
Route::get('hospital/planchange/{id}', 'Admin\AdminHospitalController@planFrom');

Route::post('hospital/planchangeaction', 'Admin\AdminHospitalController@changePlan');

//mobi-notification
Route::get('NotificationApi/mobidocnotification/{token}/{sender_name}/{sender_photo}/{sender_id}', 'Admin\AdminFirebaseController@mobinotification');

//change password
Route::get('changepassword/{title}/{id}', 'Admin\AdminFirebaseController@changePassword');
Route::post('changepassword', 'Admin\AdminFirebaseController@changePasswordAction');

//test controller 
Route::get('test2', 'TestController@test');
Route::post('testform', 'TestController@test_form');
//prescription test custom
Route::get('prestest', 'PrescriptionControllerMpdf@Prescription');
//test prescription download
Route::get('presdownload', 'PrescriptionDownloadController@prescriptiondownload');