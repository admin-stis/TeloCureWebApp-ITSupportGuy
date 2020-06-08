<?php

namespace App\Http\Middleware;

use closure;
use Symfony\Component\HttpFoundation\Request;

class checkUser{

	public function handle($request,Closure $next){

		if($request->session()->get('user') === null || $request->session()->get('title') != 'admin'){
			return redirect('/login/admin');
		}
		return $next($request);
	}
}