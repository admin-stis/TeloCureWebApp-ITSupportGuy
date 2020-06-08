<?php

namespace App\Http\Middleware;

use closure;
use Symfony\Component\HttpFoundation\Request;

class CheckPatient{

	public function handle($request,Closure $next){
		if($request->session()->get('user') === null){
			return redirect('/login/patient');
		}
		return $next($request);
	}
}