<?php

namespace App\Http\Middleware;

use closure;
use Symfony\Component\HttpFoundation\Request;

class CheckDoctor{

	public function handle($request,Closure $next){
		if($request->session()->get('user') === null || $request->session()->get('title') != 'doctor'){
			return redirect('/login/doctor');
		}
		return $next($request);
	}
}