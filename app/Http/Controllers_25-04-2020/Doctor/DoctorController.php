<?php

namespace App\Http\Controllers\Doctor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DoctorController extends Controller
{
    public function __construct()
    {

    }
    
    public function index()
    {
        
        return view('doctor.index');
        
    }
}
