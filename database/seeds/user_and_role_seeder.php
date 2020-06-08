<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
class user_and_role_seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         	// $super_admin_role = ['name' => 'superadmin', 'display_name' => 'Super Admin', 'description' => 'Full Permission'];
          // $superadminrole = Role::create($super_admin_role);
					//create all role
          $admin_role = ['name' => 'admin', 'display_name' => 'Admin', 'description' => 'Full Permission'];
          $adminrole = Role::create($admin_role);
					
					$doctor_role = ['name' => 'doctor', 'display_name' => 'Doctor', 'description' => 'Full Permission'];
					$doctorrole = Role::create($doctor_role);

					$patient_role = ['name' => 'patient', 'display_name' => 'Patient', 'description' => 'Full Permission'];
					$patientrole = Role::create($patient_role);

					$hospital_role = ['name' => 'hospital', 'display_name' => 'Hospital', 'description' => 'Full Permission'];
					$hospitalrole = Role::create($hospital_role);


        	// $superAdmin = ['name' => 'superAdmin User', 'email' => 'superadmin@test.com', 'password' => Hash::make('123456')];
	        // 	$user = User::create($superAdmin);
	        // 	$user->attachRole($superadminrole);

	        $doctor = ['name' => 'Doctor user', 'email' => 'doctor@gmail.com', 'password' => Hash::make('123456')];
	        	$doctor = User::create($doctor);
	        	$doctor->attachRole($doctorrole);

	        $patient = ['name' => ' Patient User', 'email' => 'patient@gmail.com', 'password' => Hash::make('123456')];
	        	$patient = User::create($patient);
	        	$patient->attachRole($patientrole);

	        $hospital = ['name' => ' Hospital User', 'email' => 'hospital@gmail.com', 'password' => Hash::make('123456')];
	        	$hospital = User::create($hospital);
	        	$hospital->attachRole($hospitalrole);
	        	
	        $admin = ['name' => ' Admin User', 'email' => 'admin@gmail.com', 'password' => Hash::make('123456')];
        		$admin = User::create($admin);
	        	$admin->attachRole($adminrole);
         
       
    }
}
