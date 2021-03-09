<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
// morshed 28/07/2020
use App\Doctor;
use App\Hospital;
use App\User;
use App\Visits;
use App\District;
use App\Admin;

use App\CustomPermission;
use App\CustomRole;

use App\CustomRolePermission;
use App\CustomUserRole;
// end

class AdminController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {

        /* $firestore = app('firebase.firestore');
        $database = $firestore->database();
        $docRefe = $database->collection('doctors');
        $patientRefe = $database->collection('users');
        $hosRefe = $database->collection('hospital_users'); */

        //$doctors = $docRefe->documents();
        // $patients = $patientRefe->documents();
        // $hosUser = $hosRefe->documents();

        /*
        $doctor_count = 0;
        foreach ($doctors as $key => $value) {
            $doctor_count++;
        }
        */

        $doctor_count = Doctor::count();


        /*
        $patient = $patientRefe->documents();
        $patient_count=0;
        foreach ($patients as $key => $value) {
            $patient_count++;
        }

        $data['totalPatient'] = $patient_count;
        */

        $data['totalPatient'] = User::count();

        /*
        $query = $docRefe->where('active','=',true);
        $active_doctors = $query->documents();
        $number_of_active_doctor = 0;
        foreach ($active_doctors as $key => $value) {
            $number_of_active_doctor++;
        }
        */
        $data['activeDoctor'] = Doctor::where('active', 'true')->count();

        // $data['activeDoctor'] = $number_of_active_doctor;

        /* temporary commented visit info in admin dashboard

        $visits = $database->collection('visits');
        $visitData = $visits->documents();
        $data['visited'] = array();

        foreach($visitData as $key => $value){
            array_push($data['visited'],$value->data());
        }
        */

        $visits = Visits::get();
        $total = 0;
        foreach ($visits as $visit) {
            if (isset($visit['transactionHistory'])) {
                $transactionHistory = json_decode($visit['transactionHistory'], TRUE);
                $total += $transactionHistory['subTotalRounded'];
            }
        }
        $data['totalRevenue'] = $total;
        //dd($data['totalRevenue']);


        // hospital add
        /*
        $data['userList'] = array();
        $data['totalHospitalUser'] = array();
        $totalUser = $hosRefe->documents();

        $total = 0;
        foreach($totalUser as $item)
        {
            $total++;
            array_push($data['userList'],$item->data());
        }
        $data['totalHospitalUser'] = $total;
        */

        $data['totalHospitalUser'] = Hospital::count();

        // end

        // new code

        // end

        /*
        $counter = count($data['visited']);
        $total = 0;

        $data['totalRevenue'] = array();

        for($i = 0; $i < $counter; $i++){
            if(isset($data['visited'][$i]['transactionHistory'])){
                $total += $data['visited'][$i]['transactionHistory']['subTotalRounded'];

            }
        }

        array_push($data['totalRevenue'],$total);
        */

        /*
        $data['revenueByDate'] = array();
        $data['revenueKey'] = array();
        $data['revenueVal'] = array();
        $data['rev'] = array();

        for($i = 0; $i < $counter; $i++){
            if(isset($data['visited'][$i]['transactionHistory'])){
                $rVal = $data['visited'][$i]['transactionHistory']['subTotalRounded'];
                $rKey = $data['visited'][$i]['transactionHistory']['createdDate']->get()->format('d-m-Y');
                $data['revenueByDate'] = array($rKey => $rVal);
                array_push($data['rev'] , $data['revenueByDate']);
            }
        }
        */
        return view('admin.index')->with($data);
    }

    public function rolesettings()
    {

        $data['roles'] = CustomRole::get();
        $data['roleList'] = array();

        //get all roles with permissions data
        foreach ($data['roles'] as $key => $item) {

            $rolePerms = CustomRolePermission::where('role_id', $item["id"])->get()->toArray();
            $finalPerms = "";
            foreach ($rolePerms as $key2 => $item2) {
                if (isset($item2["permission_name"])) $finalPerms .= $item2["permission_name"] . ", ";
            }
            $item["perms"] = $finalPerms;

            // dd($item["perms"]); 

            array_push($data['roleList'], $item);
        }

        //get all users with roles data
        //for user
        $data['users'] = Admin::get();
        $data['userList'] = array();
        foreach ($data['users'] as $key => $item) {

            $userRoles = CustomUserRole::where('user_id', $item["id"])->get()->toArray();
            $finalRoles = "";
            foreach ($userRoles as $key2 => $item2) {
                if (isset($item2["role_name"])) $finalRoles .= $item2["role_name"] . ", ";
            }
            $item["roles"] = $finalRoles;

            // dd($item["perms"]);

            array_push($data['userList'], $item);
        }

        //get all permissions 
        $data['permList'] = CustomPermission::get()->toArray();

        return view('admin.rolesettings')->with($data);
    }
    public function adduser()
    {

        $data['customrole'] = CustomRole::get();
        $data['customroleList'] = array();

        foreach ($data['customrole'] as $key => $item) {
            array_push($data['customroleList'], $item);
        }
        return view('admin/adduser')->with($data);
    }

    public function adduseraction(Request $request)
    {
        try {

            if (isset($request->submit) && $request->submit == 'submit') {

                $username = $request->username;
                $useremail = $request->useremail;
                $userpass = $request->userpass;

                //validations 
                $v = validator::make($request->all(), [
                    'username' => 'required|string|max:150|alpha_num',
                    'useremail' => 'required',
                    'userpass' => 'required|min:8|regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/',
                ]);

                if ($v->fails()) {
                    return redirect()->back()->withInput()->withErrors($v->errors());
                }

                if ($username == "super") {
                    Session::flash('usernamemsg', 'Please choose a different username other than super');
                    $flag = true;
                }

                $userInformation = Admin::all();
                $flag = false;
                foreach ($userInformation as $item) {
                    if (isset($item['user_name']) && $item['user_name'] == $username) {
                        Session::flash('usernamemsg', 'username already exists');
                        $flag = true;
                        break;
                    }
                }
                foreach ($userInformation as $item) {
                    if (isset($item['email']) && $item['email'] == $useremail) {
                        Session::flash('emailmsg', 'Email already exists.');
                        $flag = true;
                        break;
                    }
                }

                if ($flag == true) {
                    return redirect()->back()->withInput();
                }
                //validation ends 

                $data = [
                    'user_name' => $username,
                    'email' => $useremail,
                    'password' => $userpass
                ];

                $user = Admin::create($data);
                if (isset($user)) {
                    $insertedId = $user->id;

                    $data['roleName'] = $request->roleName;
                    $data['roleArr'] = $request->roleId;

                    if ($data['roleArr'] != null) {
                        foreach ($data['roleArr'] as $key => $item) {
                            $dataRole = array();
                            $dataRole = [
                                'user_id' => $insertedId,
                                'user_name' => $username,
                                'role_id' => $item,
                                'role_name' => $data['roleName'][$key]
                            ];

                            CustomUserRole::create($dataRole);
                        }
                    }
                } else {
                    Session::flash('msg', "Error found while adding user data in user table");
                    return redirect()->back();
                    // $errorMsg="";
                }

                Session::flash('msg', 'User has been added successfully');
                return redirect('admin/rolesettings');
            }
        } catch (\Exception $e) {
            $err_output = "Errors - ";
            if (is_array($e->errorInfo)) {
                $err_output .=  implode(",", $e->errorInfo);
            } else {
                $err_output .= $e->errorInfo;
            }
            Session::flash('msg', $err_output);
            return redirect()->back();
        }
    }
    public function edituser($id)
    {
        try {
            $userid = $id;
            //dd($id);
            $data['customuser'] = Admin::where("id", $userid)->get()->toArray();
            //dd($data['customuser']);

            //get all roles
            $data['customrole'] = CustomRole::get()->toArray();

            //get all user id based roles
            $userRoles1 = CustomUserRole::select('role_id')->where("user_id", $userid)->get()->toArray();
            $userRoles = array();
            foreach ($userRoles1 as $key => $item) {
                array_push($userRoles, $item["role_id"]);
            }
            //dd($userRoles);
            $data['customroleList'] = array();

            foreach ($data['customrole'] as $key => $item) {
                $isActivePerm = array();
                if (in_array($item["id"], $userRoles)) {
                    $isActivePerm["active"] = "true";
                } else {
                    $isActivePerm["active"] = "false";
                }

                $item_main = array_merge($item, $isActivePerm);
                //dd($item_main);

                array_push($data['customroleList'], $item_main);
            }

            return view('admin/edituser')->with($data);
        } catch (\Exception $e) {
            $err_output = "Errors - ";
            if (is_array($e->errorInfo)) {
                $err_output .=  implode(",", $e->errorInfo);
            } else {
                $err_output .= $e->errorInfo;
            }
            //dd($e);
            Session::flash('msg', $err_output);
            return redirect()->back();
        }
    }
    public function edituseraction(Request $request)
    {
        try {

            if (isset($request->submit) && $request->submit == 'submit') {

                $isSuperUser = $request->isSuperUser;
                if (isset($isSuperUser) && $isSuperUser == "1") {
                    $username = "super";
                } //dd($username.$isSuperUser);
                else {
                    $username = $request->username;
                }
                $useremail = $request->useremail;
                $userid = $request->user_id;
                $errorMsg = "User has been edited successfully";

                //validations
                $v = validator::make($request->all(), [
                    'username' => 'required|string|max:150|alpha_num',
                    'useremail' => 'required',/* 
                    'userpass' => 'required|min:8|regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/',
                    'userpass' => 'required|min:8|regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/', */
                ]);


                if ($v->fails()) {
                    return redirect()->back()->withInput()->withErrors($v->errors());
                }
                //update user data in admin table
                $userUpdated = Admin::where('id', $userid)->update(['user_name' => $username, 'email' => $useremail]);

                if (isset($userUpdated)) {
                    //get all roles of the user id
                    $userRoles1 = CustomUserRole::select('role_id')->where("user_id", $userid)->get()->toArray();
                    $userRoles = array();
                    if (isset($userRoles1)) {
                        foreach ($userRoles1 as $key => $item) {
                            array_push($userRoles, $item["role_id"]);
                        }
                    }

                    $roleName = $request->roleName;
                    $roleArr = $request->roleId;
                    $isActive = $request->isActive;

                    $roleSetDone = array();
                    $roleToBeDeleted = array();

                    /*** todo: if all checkboxes were unchecked ! ***/

                    //now start adding roles for the user in custom_User_role table
                    if (isset($roleArr)) {
                        foreach ($roleArr as $key => $item) {
                            $dataRole = array();
                            $dataRole = [
                                'user_id' => $userid,
                                'user_name' => $username,
                                'role_id' => $item,
                                'role_name' => $roleName[$key],
                            ];

                            //this role was not added before so add it in the custom_user_role table
                            if ($isActive[$key] == "false") {
                                CustomUserRole::create($dataRole);
                            }
                            //push to $roleSetDone array all role ids which this user id had before in custom_user_role table
                            if ($isActive[$key] == "true") {
                                array_push($roleSetDone, $item);
                            }
                        }
                    }
                    //now get all role ids which was unchecked (those are in the custom_user_role table for the user) 
                    $roleToBeDeleted = array_diff($userRoles, $roleSetDone);
                    //now delete all roles of the user which were unchecked
                    foreach ($roleToBeDeleted as $key => $item) {
                        CustomUserRole::where('user_id', $userid)->where('role_id', $item)->delete();
                    }

                    //dd($permToBeDeleted);
                    //dd($permSetDone);
                    //dd($userRoles1);
                } else {
                    $errorMsg = "Error found while updating users table";
                }

                Session::flash('msg', $errorMsg);
                return redirect('admin/rolesettings');
            }
        } catch (\Exception $e) {
            $err_output = "Errors - ";
            if (is_array($e->errorInfo)) {
                $err_output .=  implode(",", $e->errorInfo);
            } else {
                $err_output .= $e->errorInfo;
            }
            //dd($e);
            Session::flash('msg', $err_output);
            return redirect()->back();
        }
        //Session::flash('msg', 'District activated.');
        //return redirect('/admin/district');
    }
    public function deleteuser($id)
    {
        try {
            $msg = "User and user roles have been deleted successfully";

            $deletedUser = Admin::where('id', $id)->delete();
            if (isset($deletedUser)) {
                //mass delete roles of the user in user_role association table
                $deletedUserRoles = CustomUserRole::where('user_id', $id)->delete();
                if (isset($deletedUserRoles)) {
                } else {
                    $msg = "Error found while deleting user roles from user_role table";
                }
            } else {
                $msg = "Error found while deleting user from users table";
            }

            Session::flash('msg', $msg);
            return redirect('admin/rolesettings');
        } catch (\Exception $e) {
            $err_output = "Errors - ";
            if (is_array($e->errorInfo)) {
                $err_output .=  implode(",", $e->errorInfo);
            } else {
                $err_output .= $e->errorInfo;
            }
            //dd($e);
            Session::flash('msg', $err_output);
            return redirect()->back();
        }
        //Session::flash('msg', 'District activated.');
        //return redirect('/admin/district');
    }
    public function deleterole($id)
    {
        try {
            $msg = "Role and role permissions have been deleted successfully";

            $deletedRole = CustomRole::where('id', $id)->delete();
            if (isset($deletedRole)) {
                //mass delete permissions of the role in role_permisson association table
                $deletedRolePerms = CustomRolePermission::where('role_id', $id)->delete();
                if (isset($deletedRolePerms)) {
                } else {
                    $msg = "Error found while deleting role's permissions from role_permission table";
                }
            } else {
                $msg = "Error found while deleting role from roles table";
            }
            if (isset($deletedRole)) {
                //mass delete roles of users in user-role table
                $deletedRolesOfUsers = CustomUserRole::where('role_id', $id)->delete();
                if (isset($deletedRolesOfUsers)) {
                } else {
                    $msg = "Error found while deleting roles of users from user_role table";
                }
            } else {
                $msg = "Error found while deleting role from roles table";
            }

            Session::flash('msg', $msg);
            return redirect('admin/rolesettings');
        } catch (\Exception $e) {
            $err_output = "Errors - ";
            if (is_array($e->errorInfo)) {
                $err_output .=  implode(",", $e->errorInfo);
            } else {
                $err_output .= $e->errorInfo;
            }
            //dd($e);
            Session::flash('msg', $err_output);
            return redirect()->back();
        }
        //Session::flash('msg', 'District activated.');
        //return redirect('/admin/district');
    }
    public function addrole()
    {

        $data['custompermission'] = CustomPermission::get();
        $data['custompermissionList'] = array();

        foreach ($data['custompermission'] as $key => $item) {
            array_push($data['custompermissionList'], $item);
        }
        return view('admin/addrole')->with($data);
    }
    public function editrole($id)
    {
        try {
            $roleid = $id;

            $data['customrole'] = CustomRole::where("id", $roleid)->get()->toArray();
            //dd($data['customrole']);
            //get all permissins
            $data['custompermission'] = CustomPermission::get()->toArray();
            //get all role id based permissions  
            $rolePermissions1 = CustomRolePermission::select('permission_id')->where("role_id", $roleid)->get()->toArray();
            $rolePermissions = array();
            foreach ($rolePermissions1 as $key => $item) {
                array_push($rolePermissions, $item["permission_id"]);
            }
            //dd($rolePermissions);
            $data['custompermissionList'] = array();

            foreach ($data['custompermission'] as $key => $item) {
                $isActivePerm = array();
                if (in_array($item["id"], $rolePermissions)) {
                    $isActivePerm["active"] = "true";
                } else {
                    $isActivePerm["active"] = "false";
                }

                $item_main = array_merge($item, $isActivePerm);
                //dd($item_main);

                array_push($data['custompermissionList'], $item_main);
            }

            //dd($data['custompermissionList']);

            return view('admin/editrole')->with($data);
        } catch (\Exception $e) {
            $err_output = "Errors - ";
            if (is_array($e->errorInfo)) {
                $err_output .=  implode(",", $e->errorInfo);
            } else {
                $err_output .= $e->errorInfo;
            }
            Session::flash('msg', $err_output);
            return redirect()->back();
        }
    }
    public function editroleaction(Request $request)
    {
        try {

            if (isset($request->submit) && $request->submit == 'submit') {

                $rolename = $request->rolename;
                $roledesc = $request->roledesc;
                $roleid = $request->role_id;
                $errorMsg = "Role has been edited successfully";

                //update role data in roles table 
                $roleUpdated = CustomRole::where('id', $roleid)->update(['name' => $rolename, 'description' => $roledesc]);

                if (isset($roleUpdated)) {
                    //get all permissions of the role id
                    $rolePermissions1 = CustomRolePermission::select('permission_id')->where("role_id", $roleid)->get()->toArray();
                    $rolePermissions = array();
                    if (isset($rolePermissions1)) {
                        foreach ($rolePermissions1 as $key => $item) {
                            array_push($rolePermissions, $item["permission_id"]);
                        }
                    }

                    $permName = $request->permName;
                    $permArr = $request->permId;
                    $isActive = $request->isActive;
                    //dd($permArr);
                    $permSetDone = array();
                    $permToBeDeleted = array();

                    /*** todo: if all checkboxes were unchecked ! ***/
                    //now add permissions for the role in role_permission table 
                    if (isset($permArr)) {
                        foreach ($permArr as $key => $item) {
                            $dataPerm = array();
                            $dataPerm = [
                                'role_id' => $roleid,
                                'role_name' => $rolename,
                                'permission_id' => $item,
                                'permission_name' => $permName[$key],
                            ];

                            //this permission was not added before so add it in the table
                            if ($isActive[$key] == "false") {
                                CustomRolePermission::create($dataPerm);
                            }
                            //push to $permSetDone array all permissions ids which this role id had before
                            if ($isActive[$key] == "true") {
                                array_push($permSetDone, $item);
                            }
                        }
                    }
                    //now get all permission ids which was unchecked 
                    $permToBeDeleted = array_diff($rolePermissions, $permSetDone);
                    //now delete all permissions of the role id which were unchecked 
                    foreach ($permToBeDeleted as $key => $item) {
                        CustomRolePermission::where('role_id', $roleid)->where('permission_id', $item)->delete();
                    }
                } else {
                    $errorMsg = "Error found while updating role data in roles table";
                }

                Session::flash('msg', $errorMsg);
                return redirect('admin/rolesettings');
            }
        } catch (\Exception $e) {
            $err_output = "Errors - ";
            if (is_array($e->errorInfo)) {
                $err_output .=  implode(",", $e->errorInfo);
            } else {
                $err_output .= $e->errorInfo;
            }
            Session::flash('msg', $err_output);
            return redirect()->back();
            //dd($e);
        }
        //Session::flash('msg', 'District activated.');
        //return redirect('/admin/district');
    }
    public function addroleaction(Request $request)
    {
        try {

            if (isset($request->submit) && $request->submit == 'submit') {
                $rolename = $request->rolename;
                $roledesc = $request->roledesc;

                //validations
                $v = validator::make($request->all(), [
                    'rolename' => 'required|max:60',
                    'roledesc' => 'required'
                ]);

                if ($v->fails()) {
                    return redirect()->back()->withInput()->withErrors($v->errors());
                }

                $roleInformation = CustomRole::all();
                $flag = false;
                foreach ($roleInformation as $item) {
                    if (isset($item['name']) && $item['name'] == $rolename) {
                        Session::flash('rolenamemsg', 'role name already exists');
                        $flag = true;
                        break;
                    }
                }

                if ($flag == true) {
                    return redirect()->back()->withInput();
                }
                //validation ends 

                $data = [
                    'name' => $rolename,
                    'display_name' => $rolename,
                    'description' => $roledesc
                ];

                $user = CustomRole::create($data);

                if (isset($user)) {
                    $insertedId = $user->id;

                    //dd($insertedId);

                    $data['permName'] = $request->permName;
                    $data['permArr'] = $request->permId;
                    //dd($data['permArr']);
                    if ($data['permArr'] != null) {
                        foreach ($data['permArr'] as $key => $item) {
                            $dataPerm = array();
                            $dataPerm = [
                                'role_id' => $insertedId,
                                'role_name' => $rolename,
                                'permission_id' => $item,
                                'permission_name' => $data['permName'][$key],
                            ];

                            //dd($dataPerm);
                            CustomRolePermission::create($dataPerm);
                        }
                    }
                } else {
                    Session::flash('msg', "Error found while adding role data in roles table");
                    return redirect()->back();
                    // $errorMsg="";
                }

                Session::flash('msg', 'Role has been added successfully');
                return redirect('admin/rolesettings');
            }
        } catch (\Exception $e) {
            $err_output = "Errors - ";
            if (is_array($e->errorInfo)) {
                $err_output .=  implode(",", $e->errorInfo);
            } else {
                $err_output .= $e->errorInfo;
            }
            Session::flash('msg', $err_output);
            return redirect()->back();
        }
    }

    /*public function revenue(){
        $firestore = app('firebase.firestore');
        $database = $firestore->database();
        $visits = $database->collection('visits');
        $visitData = $visits->documents();
        $data['visited'] = array();

        foreach($visitData as $key => $value){
            array_push($data['visited'],$value->data());
        }

        $counter = count($data['visited']);
        $data['revenueByDate'] = array();
        $data['revenueKey'] = array();
        $data['revenueVal'] = array();
        // $data['rev'] = array();
        $rev = array();

        for($i = 0; $i < $counter; $i++){
            if(isset($data['visited'][$i]['transactionHistory'])){
                $rVal = $data['visited'][$i]['transactionHistory']['subTotalRounded'];
                $rKey = $data['visited'][$i]['transactionHistory']['createdDate']->get()->format('d-m-Y');
                $data['revenueByDate'] = array('date' => $rKey,'val' => $rVal);
                //array_push($data['rev'] , $data['revenueByDate']);
                array_push($rev , $data['revenueByDate']);

            }
        }

        // return $data['rev'];
        return $rev;

    }*/

    /*public function revenue(){
        $firestore = app('firebase.firestore');
        $database = $firestore->database();
        $visits = $database->collection('visits');
        $visitData = $visits->documents();
        $data['visited'] = array();

        foreach($visitData as $key => $value){
        array_push($data['visited'],$value->data());
        }

        $counter = count($data['visited']);
        $data['revenueByDate'] = array();
        $data['revenueKey'] = array();
        $data['revenueVal'] = array();
        $data['rev'] = array();

        $sortingDate = array();
        $sortingValue = array();

        for($i = 0; $i < $counter; $i++){
        if(isset($data['visited'][$i]['transactionHistory'])){
        $rVal = $data['visited'][$i]['transactionHistory']['subTotalRounded'];
        $rKey = $data['visited'][$i]['transactionHistory']['createdDate']->get()->format('d-m-Y');

        $sresult=array_search($rKey,$sortingDate);
        if($sresult == null){
        array_push($sortingDate,$rKey);
        array_push($sortingValue,$rVal);
        }else{
        $total=$sortingValue[$sresult]+$rVal;
        $replacements = array($sresult => $total);
        array_replace($sortingValue, $replacements);
        }
        }
        }

        $counter1 = count($sortingDate);
        for($i = 0; $i < $counter1; $i++){

        $data['revenueByDate'] = array('date' => $sortingDate[$i],'val' => $sortingValue[$i]);
        array_push($data['rev'] , $data['revenueByDate']);
        }

        // dd($data['rev']);

        return $data['rev'];

    }
    */

    public function getNextVisits($id)
    {
        
    }
    //new revenue code
    public function revenue()
    {
        // $firestore = app('firebase.firestore');
        // $database = $firestore->database();
        // $visits = $database->collection('visits');
        // $visitData = $visits->documents();
        $visitData = Visits::all();
        $data['visited'] = array();

        foreach ($visitData as $key => $value) {
            array_push($data['visited'], $value);
        }

        //$counter = count($data['visited']);
        $counter = Visits::count();
        $data['revenueByDate'] = array();
        $data['revenueKey'] = array();
        $data['revenueVal'] = array();
        $data['rev'] = array();

        $sortingDate = array('date');
        $sortingValue = array('value');

        for ($i = 0; $i < $counter; $i++) {
            if (isset($data['visited'][$i]['transactionHistory'])) {
                //$rVal = $data['visited'][$i]['transactionHistory']['subTotalRounded'];
                //$rKey = $data['visited'][$i]['transactionHistory']['createdDate']->get()->format('d-m-Y');
                $amount = json_decode($data['visited'][$i]['transactionHistory'], TRUE);
                $rVal = $amount['subTotalRounded'];
                $rKey = date('d-m-Y', strtotime($data['visited'][$i]['created_at']));

                $sresult = array_search($rKey, $sortingDate);
                if ($sresult == null) {
                    array_push($sortingDate, $rKey);
                    array_push($sortingValue, $rVal);
                } else {
                    $total = $sortingValue[$sresult] + $rVal;
                    $replacements = array($sresult => $total);
                    $sortingValue = array_replace($sortingValue, $replacements);
                }
            }
        }

        $counter1 = count($sortingDate);
        for ($i = 1; $i < $counter1; $i++) {

            $data['revenueByDate'] = array('date' => $sortingDate[$i], 'val' => $sortingValue[$i]);
            array_push($data['rev'], $data['revenueByDate']);
        }

        return $data['rev'];
    }


    // revenue by date
    public function revenueByDate(Request $request)
    {
        // dd(1);
        // $firestore = app('firebase.firestore');
        // $database = $firestore->database();
        // $visits = $database->collection('visits');
        // $visitData = $visits->documents();
        $visitData = Visits::all();
        $data['visited'] = array();

        foreach ($visitData as $key => $value) {
            array_push($data['visited'], $value);
        }

        //$counter = count($data['visited']);
        $counter = Visits::count();
        $data['revenueByDate'] = array();
        $data['revenueKey'] = array();
        $data['revenueVal'] = array();
        $data['rev'] = array();

        $sortingDate = array('date');
        $sortingValue = array('value');

        for ($i = 0; $i < $counter; $i++) {
            if (isset($data['visited'][$i]['transactionHistory'])) {
                //$rVal = $data['visited'][$i]['transactionHistory']['subTotalRounded'];
                //$rKey = $data['visited'][$i]['transactionHistory']['createdDate']->get()->format('d-m-Y');
                $amount = json_decode($data['visited'][$i]['transactionHistory'], TRUE);
                $rVal = $amount['subTotalRounded'];
                $rKey = date('d-m-Y', strtotime($data['visited'][$i]['created_at']));

                $sresult = array_search($rKey, $sortingDate);
                if ($sresult == null) {
                    array_push($sortingDate, $rKey);
                    array_push($sortingValue, $rVal);
                } else {
                    $total = $sortingValue[$sresult] + $rVal;
                    $replacements = array($sresult => $total);
                    $sortingValue = array_replace($sortingValue, $replacements);
                }
            }
        }

        $counter1 = count($sortingDate);
        for ($i = 1; $i < $counter1; $i++) {

            $data['revenueByDate'] = array('date' => $sortingDate[$i], 'val' => $sortingValue[$i]);
            array_push($data['rev'], $data['revenueByDate']);
        }

        $date = date('d-m-Y', strtotime($request->date));

        $res = array();
        $result = array();
        $rev = 0;
        foreach ($data['rev'] as $val) {
            if ($val['date'] == $date) {
                $rev = $rev + $val['val'];
            }
            $res = array(
                'date' => $date,
                'rev' => $rev
            );
        }

        array_push($result, $res);
        return $result;
    }
    // revenue by week
    public function revenueByWeek(Request $request)
    {

        $visitData = Visits::all();
        $data['visited'] = array();

        foreach ($visitData as $key => $value) {
            array_push($data['visited'], $value);
        }

        $counter = Visits::count();
        $data['revenueByDate'] = array();
        $data['revenueKey'] = array();
        $data['revenueVal'] = array();
        $data['rev'] = array();

        $sortingDate = array('date');
        $sortingValue = array('value');

        for ($i = 0; $i < $counter; $i++) {
            if (isset($data['visited'][$i]['transactionHistory'])) {
                $amount = json_decode($data['visited'][$i]['transactionHistory'], TRUE);
                $rVal = $amount['subTotalRounded'];
                $rKey = date('W', strtotime($data['visited'][$i]['created_at']));

                $sresult = array_search($rKey, $sortingDate);
                if ($sresult == null) {
                    array_push($sortingDate, $rKey);
                    array_push($sortingValue, $rVal);
                } else {
                    $total = $sortingValue[$sresult] + $rVal;
                    $replacements = array($sresult => $total);
                    $sortingValue = array_replace($sortingValue, $replacements);
                }
            }
        }

        $counter1 = count($sortingDate);
        for ($i = 1; $i < $counter1; $i++) {

            $data['revenueByDate'] = array('date' => $sortingDate[$i], 'val' => $sortingValue[$i]);
            array_push($data['rev'], $data['revenueByDate']);
        }
        //dd($data['rev']);
        $date = date('W', strtotime($request->week));

        $res = array();
        $result = array();
        $rev = 0;
        foreach ($data['rev'] as $val) {

            //$revDate = date('Y-m-d',strtotime($val['date'])) ;

            if ($val['date'] == $date) {
                $rev = $rev + $val['val'];
            }
            $res = array(
                'date' => $date,
                'rev' => $rev
            );
        }

        array_push($result, $res);

        return $result;
    }
    // revenue by month
    public function revenueByMonth(Request $request)
    {

        // $firestore = app('firebase.firestore');
        // $database = $firestore->database();
        // $visits = $database->collection('visits');
        // $visitData = $visits->documents();
        $visitData = Visits::all();
        $data['visited'] = array();

        foreach ($visitData as $key => $value) {
            array_push($data['visited'], $value);
        }

        //$counter = count($data['visited']);
        $counter = Visits::count();
        $data['revenueByDate'] = array();
        $data['revenueKey'] = array();
        $data['revenueVal'] = array();
        $data['rev'] = array();

        $sortingDate = array('date');
        $sortingValue = array('value');

        for ($i = 0; $i < $counter; $i++) {
            if (isset($data['visited'][$i]['transactionHistory'])) {
                //$rVal = $data['visited'][$i]['transactionHistory']['subTotalRounded'];
                //$rKey = $data['visited'][$i]['transactionHistory']['createdDate']->get()->format('d-m-Y');
                $amount = json_decode($data['visited'][$i]['transactionHistory'], TRUE);
                $rVal = $amount['subTotalRounded'];
                $rKey = date('d-m-Y', strtotime($data['visited'][$i]['created_at']));

                $sresult = array_search($rKey, $sortingDate);
                if ($sresult == null) {
                    array_push($sortingDate, $rKey);
                    array_push($sortingValue, $rVal);
                } else {
                    $total = $sortingValue[$sresult] + $rVal;
                    $replacements = array($sresult => $total);
                    $sortingValue = array_replace($sortingValue, $replacements);
                }
            }
        }

        $counter1 = count($sortingDate);
        for ($i = 1; $i < $counter1; $i++) {

            $data['revenueByDate'] = array('date' => $sortingDate[$i], 'val' => $sortingValue[$i]);
            array_push($data['rev'], $data['revenueByDate']);
        }

        $date = date('M Y', strtotime($request->month));

        $res = array();
        $result = array();
        $rev = 0;
        foreach ($data['rev'] as $val) {

            $revDate = date('M Y', strtotime($val['date']));

            if ($revDate == $date) {
                $rev = $rev + $val['val'];
            }
            $res = array(
                'date' => $date,
                'rev' => $rev
            );
        }

        array_push($result, $res);
        return $result;
    }
    // revenue by year
    public function revenueByYear(Request $request)
    {

        // $firestore = app('firebase.firestore');
        // $database = $firestore->database();
        // $visits = $database->collection('visits');
        // $visitData = $visits->documents();
        $visitData = Visits::all();
        $data['visited'] = array();

        foreach ($visitData as $key => $value) {
            array_push($data['visited'], $value);
        }

        //$counter = count($data['visited']);
        $counter = Visits::count();
        $data['revenueByDate'] = array();
        $data['revenueKey'] = array();
        $data['revenueVal'] = array();
        $data['rev'] = array();

        $sortingDate = array('date');
        $sortingValue = array('value');

        for ($i = 0; $i < $counter; $i++) {
            if (isset($data['visited'][$i]['transactionHistory'])) {
                //$rVal = $data['visited'][$i]['transactionHistory']['subTotalRounded'];
                //$rKey = $data['visited'][$i]['transactionHistory']['createdDate']->get()->format('d-m-Y');
                $amount = json_decode($data['visited'][$i]['transactionHistory'], TRUE);
                $rVal = $amount['subTotalRounded'];
                $rKey = date('d-m-Y', strtotime($data['visited'][$i]['created_at']));

                $sresult = array_search($rKey, $sortingDate);
                if ($sresult == null) {
                    array_push($sortingDate, $rKey);
                    array_push($sortingValue, $rVal);
                } else {
                    $total = $sortingValue[$sresult] + $rVal;
                    $replacements = array($sresult => $total);
                    $sortingValue = array_replace($sortingValue, $replacements);
                }
            }
        }

        $counter1 = count($sortingDate);
        for ($i = 1; $i < $counter1; $i++) {

            $data['revenueByDate'] = array('date' => $sortingDate[$i], 'val' => $sortingValue[$i]);
            array_push($data['rev'], $data['revenueByDate']);
        }

        $date = date('Y', strtotime($request->year));

        $res = array();
        $result = array();
        $rev = 0;
        foreach ($data['rev'] as $val) {

            $revDate = date('Y', strtotime($val['date']));

            if ($revDate == $date) {
                $rev = $rev + $val['val'];
            }
            $res = array(
                'date' => $date,
                'rev' => $rev
            );
        }

        array_push($result, $res);
        return $result;
    }
    //end

    public function regUser()
    {

        /*
        $firestore = app('firebase.firestore');
        $database = $firestore->database();
        $patRef = $database->collection('users');
        $patient = $patRef->documents();
        $patientInfo = array();
        foreach($patient as $key => $value){
            array_push($patientInfo,$value->data());
        }
        */

        $patient = User::all();
        $patientInfo = array();
        foreach ($patient as $key => $value) {
            array_push($patientInfo, $value);
        }

        //dd($patientInfo);

        $regDate = array('date');
        $regVal = array('val');
        $data['rev'] = array();

        foreach ($patientInfo as $i => $item) {
            //dd(substr($item['createdAt'],0,10));
            if (isset($item['createdAt'])) {
                // $sresult=array_search($item['createdAt']->get()->format('d-m-Y'),$regDate);

                $sresult = array_search(date('d-m-Y', strtotime(substr($item['createdAt'], 0, 10))), $regDate);
                if ($sresult == null) {
                    // array_push($regDate,$item['createdAt']->get()->format('d-m-Y'));
                    array_push($regDate, date('d-m-Y', strtotime(substr($item['createdAt'], 0, 10))));
                    array_push($regVal, 1);
                } else {
                    $total = $regVal[$sresult] + 1;
                    $replacements = array($sresult => $total);
                    $regVal = array_replace($regVal, $replacements);
                }
            }
        }

        $counter1 = count($regDate);
        for ($i = 1; $i < $counter1; $i++) {
            array_push($data['rev'], array('date' => $regDate[$i], 'val' => $regVal[$i]));
        }

        return $data['rev'];
    }


    public function regUserDateWise(Request $request)
    {

        /*
        $firestore = app('firebase.firestore');
        $database = $firestore->database();
        $patRef = $database->collection('users');
        $patient = $patRef->documents();
        $patientInfo = array();
        foreach($patient as $key => $value){
            array_push($patientInfo,$value->data());
        }
        */

        $patient = User::all();
        $patientInfo = array();
        foreach ($patient as $key => $value) {
            array_push($patientInfo, $value);
        }

        $regDate = array('date');
        $regVal = array('val');
        $data['rev'] = array();

        foreach ($patientInfo as $i => $item) {
            //dd(substr($item['createdAt'],0,10));
            if (isset($item['createdAt'])) {
                // $sresult=array_search($item['createdAt']->get()->format('d-m-Y'),$regDate);

                $sresult = array_search(date('d-m-Y', strtotime(substr($item['createdAt'], 0, 10))), $regDate);
                if ($sresult == null) {
                    // array_push($regDate,$item['createdAt']->get()->format('d-m-Y'));
                    array_push($regDate, date('d-m-Y', strtotime(substr($item['createdAt'], 0, 10))));
                    array_push($regVal, 1);
                } else {
                    $total = $regVal[$sresult] + 1;
                    $replacements = array($sresult => $total);
                    $regVal = array_replace($regVal, $replacements);
                }
            }
        }

        $date = date('d-m-Y', strtotime($request->date));

        $counter1 = count($regDate);
        for ($i = 1; $i < $counter1; $i++) {

            array_push($data['rev'], array('date' => $regDate[$i], 'val' => $regVal[$i]));
        }

        $res = array();
        $result = array();
        $rev = 0;
        foreach ($data['rev'] as $val) {
            if ($val['date'] == $date) {
                $rev = $rev + $val['val'];
            }
            $res = array(
                'date' => $date,
                'rev' => $rev
            );
        }

        array_push($result, $res);
        return $result;

        //return $data['rev'];
    }


    public function visitors()
    {

        $visitData = Visits::all();

        $data['visited'] = array();
        foreach ($visitData as $key => $value) {
            array_push($data['visited'], $value);
        }

        $counter = count($data['visited']);
        $data['revenueByDate'] = array();
        $data['revenueKey'] = array();
        $data['revenueVal'] = array();
        $data['rev'] = array();

        $sortingDate = array('date');
        $sortingValue = array('value');

        $todayData = 0;
        $curWeekData = 0;
        $curMonthData = 0;
        $curYearData = 0;

        $today = date('d-m-Y');

        $start_date = new \DateTime(date('Y-m-d'));
        $day_of_week = $start_date->format("w");
        $curWeek = date('Y-m-d', strtotime("-$day_of_week days", strtotime(date('Y-m-d'))));

        $curMonth = date('m-Y');

        $curYear = date('Y');

        $tday = '';
        $thisWeek = '';
        $mont = date('M Y');
        $year = '';


        for ($i = 0; $i < $counter; $i++) {
            //dd($data['visited'][$i]['transactionHistory']);
            if (isset($data['visited'][$i]['transactionHistory'])) {

                //new code 28/07/2020
                $transaction = json_decode($data['visited'][$i]['transactionHistory'], TRUE);
                //dd($transaction['createdDate']);
                //end 

                //$rKey = $data['visited'][$i]['transactionHistory']['createdDate']->get()->format('d-m-Y');

                //$rKey = $data['visited'][$i]['created_at'];

                //$date = date('d-m-Y',strtotime($rkey));

                //date('d-m-Y',strtotime($data['visited'][$i]['created_at']));

                if (isset($data['visited'][$i]['created_at']) && !empty($data['visited'][$i]['created_at'])) {
                    //$rKey = date('d-m-Y',strtotime(substr($transaction['createdDate'],0,10)));
                    $rKey = date('d-m-Y', strtotime($data['visited'][$i]['created_at']));
                    $rKeyDate = explode('-', $rKey);

                    if ($rKey == $today) {
                        $todayData = $todayData + 1;
                    }

                    if ($rKey >= $curWeek) {
                        $curWeekData = $curWeekData + 1;
                    }

                    if ($curMonth == ($rKeyDate[1] . '-' . $rKeyDate[2])) {
                        $curMonthData = $curMonthData + 1;
                    }

                    if ($curYear == $rKeyDate[2]) {
                        $curYearData = $curYearData + 1;
                    }
                }
            }
        }

        $data1 = array('date' => $today, 'val' => $todayData);
        $data2 = array('date' => $curWeek, 'val' => $curWeekData);
        $data3 = array('date' => $mont, 'val' => $curMonthData);
        $data4 = array('date' => $curYear, 'val' => $curYearData);

        /*
        temporary commented
        $data1 = array('date' => 'Today','val' => $todayData);
        $data2 = array('date' => 'Current Week','val' => $curWeekData);
        $data3 = array('date' => 'Current Mont','val' => $curMonthData);
        $data4 = array('date' => 'Current Year','val' => $curYearData);
        */

        array_push($data['rev'], $data1);
        array_push($data['rev'], $data2);
        array_push($data['rev'], $data3);
        array_push($data['rev'], $data4);

        return $data['rev'];
    }

    // visitor date/month/year wise
    public function visitorsByDate(Request $request)
    {

        $visitData = Visits::all();

        $data['visited'] = array();
        foreach ($visitData as $key => $value) {
            array_push($data['visited'], $value);
        }

        $counter = count($data['visited']);
        $data['revenueByDate'] = array();
        $data['revenueKey'] = array();
        $data['revenueVal'] = array();
        $data['rev'] = array();

        $sortingDate = array('date');
        $sortingValue = array('value');

        $todayData = 0;
        $curWeekData = 0;
        $curMonthData = 0;
        $curYearData = 0;

        //$today=date('d-m-Y');

        $today = date('d-m-Y', strtotime($request->date));

        for ($i = 0; $i < $counter; $i++) {
            //dd($data['visited'][$i]['transactionHistory']);
            if (isset($data['visited'][$i]['transactionHistory'])) {

                $transaction = json_decode($data['visited'][$i]['transactionHistory'], TRUE);

                if (isset($data['visited'][$i]['created_at']) && !empty($data['visited'][$i]['created_at'])) {
                    $rKey = date('d-m-Y', strtotime($data['visited'][$i]['created_at']));
                    $rKeyDate = explode('-', $rKey);

                    if ($rKey == $today) {
                        $todayData = $todayData + 1;
                    }
                }
            }
        }

        $data1 = array('date' => $today, 'val' => $todayData);

        array_push($data['rev'], $data1);

        return $data['rev'];
    }
    public function visitorsByWeek(Request $request)
    {

        $visitData = Visits::all();

        $data['visited'] = array();
        foreach ($visitData as $key => $value) {
            array_push($data['visited'], $value);
        }

        $counter = count($data['visited']);
        $data['revenueByDate'] = array();
        $data['revenueKey'] = array();
        $data['revenueVal'] = array();
        $data['rev'] = array();

        $sortingDate = array('date');
        $sortingValue = array('value');

        $todayData = 0;
        $curWeekData = 0;
        $curMonthData = 0;
        $curYearData = 0;

        $today = date('W', strtotime($request->week));

        for ($i = 0; $i < $counter; $i++) {
            //dd($data['visited'][$i]['transactionHistory']);
            if (isset($data['visited'][$i]['transactionHistory'])) {

                $transaction = json_decode($data['visited'][$i]['transactionHistory'], TRUE);

                if (isset($data['visited'][$i]['created_at']) && !empty($data['visited'][$i]['created_at'])) {
                    $rKey = date('W', strtotime($data['visited'][$i]['created_at']));
                    $rKeyDate = explode('-', $rKey);

                    if ($rKey == $today) {
                        $todayData = $todayData + 1;
                    }
                }
            }
        }

        $data1 = array('date' => $today, 'val' => $todayData);

        array_push($data['rev'], $data1);

        return $data['rev'];
    }
    public function visitorsByMonth(Request $request)
    {

        $visitData = Visits::all();

        $data['visited'] = array();
        foreach ($visitData as $key => $value) {
            array_push($data['visited'], $value);
        }

        $counter = count($data['visited']);
        $data['revenueByDate'] = array();
        $data['revenueKey'] = array();
        $data['revenueVal'] = array();
        $data['rev'] = array();

        $sortingDate = array('date');
        $sortingValue = array('value');

        $todayData = 0;
        $curWeekData = 0;
        $curMonthData = 0;
        $curYearData = 0;

        //$today=date('d-m-Y');

        $today = date('M Y', strtotime($request->month));

        for ($i = 0; $i < $counter; $i++) {
            //dd($data['visited'][$i]['transactionHistory']);
            if (isset($data['visited'][$i]['transactionHistory'])) {

                $transaction = json_decode($data['visited'][$i]['transactionHistory'], TRUE);

                if (isset($data['visited'][$i]['created_at']) && !empty($data['visited'][$i]['created_at'])) {
                    $rKey = date('M Y', strtotime($data['visited'][$i]['created_at']));
                    $rKeyDate = explode('-', $rKey);

                    if ($rKey == $today) {
                        $todayData = $todayData + 1;
                    }
                }
            }
        }

        $data1 = array('date' => $today, 'val' => $todayData);

        array_push($data['rev'], $data1);

        return $data['rev'];
    }
    public function visitorsByYear(Request $request)
    {

        $visitData = Visits::all();

        $data['visited'] = array();
        foreach ($visitData as $key => $value) {
            array_push($data['visited'], $value);
        }

        $counter = count($data['visited']);
        $data['revenueByDate'] = array();
        $data['revenueKey'] = array();
        $data['revenueVal'] = array();
        $data['rev'] = array();

        $sortingDate = array('date');
        $sortingValue = array('value');

        $todayData = 0;
        $curWeekData = 0;
        $curMonthData = 0;
        $curYearData = 0;

        //$today=date('d-m-Y');

        $today = date('Y', strtotime($request->year));

        for ($i = 0; $i < $counter; $i++) {
            //dd($data['visited'][$i]['transactionHistory']);
            if (isset($data['visited'][$i]['transactionHistory'])) {

                $transaction = json_decode($data['visited'][$i]['transactionHistory'], TRUE);

                if (isset($data['visited'][$i]['created_at']) && !empty($data['visited'][$i]['created_at'])) {
                    $rKey = date('Y', strtotime($data['visited'][$i]['created_at']));
                    $rKeyDate = explode('-', $rKey);

                    if ($rKey == $today) {


                        $todayData = $todayData + 1;
                    }
                }
            }
        }



        $data1 = array('date' => $today, 'val' => $todayData);

        array_push($data['rev'], $data1);

        return $data['rev'];
    }
    // end

    public function doctorInfo()
    {
        // $firestore = app('firebase.firestore');
        // $database = $firestore->database();
        // $docRef = $database->collection('doctors');
        // $doctors = $docRef->documents();
        $doctors = Doctor::all();
        $doctorInfo = array();
        foreach ($doctors as $key => $value) {
            array_push($doctorInfo, $value);
        }

        return $doctorInfo;
    }

    public function patientInfo()
    {
        // $firestore = app('firebase.firestore');
        // $database = $firestore->database();
        // $patRef = $database->collection('users');
        // $patient = $patRef->documents();
        $patient = User::all();
        $patientInfo = array();
        foreach ($patient as $key => $value) {
            array_push($patientInfo, $value);
        }

        return $patientInfo;
    }

    public function transactionHistory($visitId)
    {
        try {

            /*  $firestore = app('firebase.firestore');
                $database = $firestore->database();
                $visits = $database->collection('visits');

                $query = $visits->where('visitId', '=', $visitId); 
              //$transectionInfo = $query->documents(); */

            $transectionInfo = Visits::where('visitId', $visitId)->get()->toArray();

            $data['transaction'] = array();

            foreach ($transectionInfo as $value) {
                //if($value->exists()){
                array_push($data['transaction'], $value);
                //}
            }

            //dd($data['transaction']);
            return view('admin/transactionDetails')->with($data);
        } catch (\Exception $e) {
            $err_output = "Errors - ";
            if (is_array($e->errorInfo)) {
                $err_output .=  implode(",", $e->errorInfo);
            } else {
                $err_output .= $e->errorInfo;
            }
            Session::flash('error_msg', $err_output);
            return redirect()->back();
        }
    }



    //plz check mridul vi from here 
    public function newPass(Request $request)
    {
        $firestore = app('firebase.firestore');
        $database = $firestore->database();
        $info = $database->collection('hospital_users');
        $uid = $request->uid;
        $hospital_user = $info->document($uid);
        $userinfo = $hospital_user->snapshot();

        $hospital_user->update([
            ['path' => 'password', 'value' => $request->password]
        ]);

        return redirect('login/hospital');
    }

    public static function district()
    {

        /* $firestore = app('firebase.firestore');
        $database = $firestore->database();
        $districtRef = $database->collection('districts'); */

        //$query = $districtRef->where('active','=',true);
        //$data['district'] = $query->documents();

        $data['district'] = District::where('active', '1')->get()->toArray();

        $districtList = array();

        foreach ($data['district'] as $key => $item) {
            array_push($districtList, $item);
        }

        return $districtList;
    }

    public static function hospital()
    {
        $firestore = app('firebase.firestore');
        $database = $firestore->database();
        $hosref  = $database->collection('hospitals');
        $hosDoc = $hosref->documents();

        $hospitalName = array();

        foreach ($hosDoc as $item) {
            array_push($hospitalName, $item->data());
        }

        return $hospitalName;
    }

    public static function branch($id)
    {
        $hId = $id;
        $firestore = app('firebase.firestore');
        $database = $firestore->database();
        $branchref  = $database->collection('hospitalBranch');
        $query = $branchref->where('hospitalId', '=', $id);
        $branchDoc = $branchref->documents();

        $branchName = array();

        foreach ($branchDoc as $item) {
            array_push($branchName, $item->data());
        }
        return $branchName;
    }

    public static function branchByUser()
    {
        $firestore = app('firebase.firestore');
        $database = $firestore->database();
        $branchref  = $database->collection('hospitalBranch');
        $branchDoc = $branchref->documents();
        $branchInfo = array();

        foreach ($branchDoc as $item) {
            array_push($branchInfo, $item->data());
        }
        return $branchInfo;
    }

    public function doctorInfoByDistrict()
    {
        $firestore = app('firebase.firestore');
        $database = $firestore->database();
        // $docRef = $database->collection('doctors');
        // $doctors = $docRef->where('active','=',true)->documents();

        $doctors = Doctor::get()->toArray();

        $districtRef = $database->collection('districts');

        // $query = $districtRef->where('active','=',true);
        // $district = $query->documents();

        $district = District::where('active', 1)->get()->toArray();

        $data['districtList'] = array();
        $activeDistrict = array();

        foreach ($district as $key => $item) {
            array_push($data['districtList'], $item);
        }

        foreach ($data['districtList'] as $key => $item) {
            array_push($activeDistrict, $item['name']);
        }

        $data['doctorInfo'] = array();
        foreach ($doctors as $key => $value) {
            array_push($data['doctorInfo'], $value);
        }

        $doctorDis = array();
        foreach ($data['doctorInfo'] as $key => $value) {
            array_push($doctorDis, $value['district']);
        }

        // dd($doctorDis);

        $count = 0;
        $output = array();
        $temp_arr = array();

        for ($i = 0; $i < count($activeDistrict); $i++) {
            for ($j = 0; $j < count($doctorDis); $j++) {
                if ($doctorDis[$j] == $activeDistrict[$i]) {
                    array_push($output, $doctorDis[$j]);
                }
            }
        }

        $docByDis = array_count_values($output);
        return $docByDis;
    }

    public function visitInfoByDistrict()
    {
        $firestore = app('firebase.firestore');
        $database = $firestore->database();
        // $docRef = $database->collection('doctors');
        // $doctors = $docRef->where('active','=',true)->documents();

        $transactionHistorydoctors = Visits::get()->toArray();

        $districtRef = $database->collection('districts');

        // $query = $districtRef->where('active','=',true);
        // $district = $query->documents();

        $district = District::where('active', 1)->get()->toArray();

        $data['districtList'] = array();
        $activeDistrict = array();

        foreach ($district as $key => $item) {
            array_push($data['districtList'], $item);
        }

        foreach ($data['districtList'] as $key => $item) {
            array_push($activeDistrict, $item['name']);
        }

        $doctorInfo = array();
        foreach ($transactionHistorydoctors as $key => $value) {
            array_push($doctorInfo, $value);
        }

        //dd($doctorInfo);

        // $doctorDis = array();
        // foreach ($data['doctorInfo'] as $key => $value) {
        //     array_push($doctorDis,$value['district']);
        // }

        $total = 0;
        $output = array();

        $sortingDate = array('date');
        $sortingValue = array('value');

        for ($i = 0; $i < count($activeDistrict); $i++) {
            for ($j = 0; $j < count($doctorInfo); $j++) {
                $dis = json_decode($doctorInfo[$j]['doctor'], True);
                if ($dis['district'] == $activeDistrict[$i]) {


                    $rKey = $activeDistrict[$i];
                    $tHistory = json_decode($doctorInfo[$j]['transactionHistory'], True);
                    $rVal = $tHistory['subTotalRounded'];

                    $sresult = array_search($rKey, $sortingDate);
                    if ($sresult == null) {
                        array_push($sortingDate, $rKey);
                        array_push($sortingValue, $rVal);
                    } else {
                        $total = $sortingValue[$sresult] + $rVal;
                        $replacements = array($sresult => $total);
                        $sortingValue = array_replace($sortingValue, $replacements);
                    }
                }
            }
        }


        $data['rev'] = array();
        $counter1 = count($sortingDate);
        //dd($sortingValue);
        for ($i = 1; $i < $counter1; $i++) {
            $data['revenueByDate'] = array('date' => $sortingDate[$i], 'val' => $sortingValue[$i]);
            array_push($data['rev'], $data['revenueByDate']);
        }

        return $data['rev'];

        //$docByDis = $output ;
        // return $output;
    }
}