<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\sendEmail;
use Mail;

class AdminServiceController extends Controller
{
    public function index()
    {
        return view('service.index');
    }

}
