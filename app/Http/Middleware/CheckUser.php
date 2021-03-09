<?php

namespace App\Http\Middleware;

use closure;
use Symfony\Component\HttpFoundation\Request;
use Log;

class checkUser
{

	public function handle($request, Closure $next)
	{

		if ($request->session()->get('user') === null || $request->session()->get('title') != 'admin') {
			return redirect('/login/admin');
		}



		//for role and permissions 
		$type = "";
		$permission_name = "";
		$action = $request->route()->getAction();

		if (isset($action)) {

			if (isset($action['view_perm'])) {
				$type = "view";
				$permission_name = $action['view_perm'];
			} else {
				if (isset($action['edit_perm'])) {
					$type = "edit";
					$permission_name = $action['edit_perm'];
				} else {
					if (isset($action['delete_perm'])) {
						$type = "delete";
						$permission_name = $action['delete_perm'];
					} else {
						if (isset($action['approve_perm'])) {
							$type = "approve";
							$permission_name = $action['approve_perm'];
						} else {
							if (isset($action['user_perm'])) {
								$type = "super";
								$permission_name = $action['user_perm'];
							}
						}
					}
				}
			}

			//Log::info("permissions - ".$type.$permission_name);

			if (($type != "") && ($permission_name != "")) {
				//check if it's authorization page routes by checking action name and type variable and allow only super user
				if ($type == "super") {
					$admin = $request->session()->get('user');
					if (isset($admin)) {
						if ($admin[0]["user_name"] != "super") {
							return redirect("perm_error");
						}
					} else {
						return redirect("perm_error");
					}
				} else {

					$has_permission = false; //SET false at first 

					$current_user = $request->session()->get('user_roles'); //get user roles and perm array from sesion
					//now get current user permissions in array 
					if (isset($current_user)) {
						$cur_user_perms = $current_user["perms"];
					}
					//check if current user has the permission same as which set in route 
					if (isset($cur_user_perms)) {
						if (in_array($permission_name, $cur_user_perms)) {
							$has_permission = true;
						}
					}
					//Log::info("permission true - ".$has_permission);
					//if user has view_all_pages perm:, set has_permission value to true irrevant of what view permission set in route for this user
					if ($has_permission == false) {
						if ($type == "view") {
							if (in_array("view_all_pages", $cur_user_perms)) {
								$has_permission = true;
							}
						}
					}
					//now finally check if this user has that permission for this route else redirect to error page
					if ($has_permission == false) {
						//Log::info("permission true - ".$has_permission); 	            
						return redirect("perm_error");
					}
				}
			}
		}

		return $next($request);
	}
}