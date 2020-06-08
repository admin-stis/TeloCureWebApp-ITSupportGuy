<?php

namespace App\Http\Controllers\Hospital;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HospitalController extends Controller
{
    public function __construct()
    {

    }
    
    public function index()
    {
        
        return view('hospital.index');
        
    }
}
