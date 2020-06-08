<?php

namespace App\Http\Middleware;

use closure;
use Symfony\Component\HttpFoundation\Request;

class CheckHospital{

	public function handle($request,Closure $next){
		if($request->session()->get('user') === null || $request->session()->get('title') != 'hospital'){
			return redirect('/login/hospital');
		}
		return $next($request);
	}
}