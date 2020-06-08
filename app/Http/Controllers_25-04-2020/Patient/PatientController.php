<?php

namespace App\Http\Controllers\Patient;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PatientController extends Controller
{
    public function __construct()
    {

    }
    
    public function index()
    {
        
        return view('patient.index');
        
    }
}
