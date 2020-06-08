@extends('frontend.layouts.app')

@section('content')
    
    <!-- <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8" style="padding: 45px;">
                <div class="row col-md-12 col-sm-12">
                    <div class="row col-md-12 col-sm-12 loginpage">
                        <div class="col-md-6">
                            <img class="img-responsive img-thumbnail" src="{{asset('images/product/patient.jpg')}}" />
                            <a style="width:100%;margin:5px;" class="hospital btn btn-dark" href="{{url('login/patient')}}">PATIENT LOGIN</a>


                        </div>
                        <div class="col-md-6"  style="margin-top:20px;">
                            <p>FORGET PASSWORD</p>
                            <p>FORGET USERNAME </p>
                        </div>
                    </div>

                    <div class="row col-md-12 col-sm-12 loginpage">
                        <div class="col-md-6">
                            <img class="img-responsive img-thumbnail" src="{{asset('images/product/doctor_group.jpg')}}" />
                            <a style="width:100%;margin:5px;"  class="hospital btn btn-dark" href="{{url('login/doctor')}}">DOCTOR LOGIN</a>

                        </div>
                        <div class="col-md-6" style="margin-top:20px;">
                            <p>FORGET PASSWORD</p>
                            <p>FORGET USERNAME </p>
                        </div>
                    </div>

                    <div class="row col-md-12 col-sm-12 loginpage">
                        <div class="col-md-6">
                            <img class="img-responsive img-thumbnail" src="{{asset('images/product/hospital.jpg')}}" />
                            <a style="width:100%;margin:5px;"  class="hospital btn btn-dark" href="{{url('login/hospital')}}">HOSPITAL LOGIN</a>


                        </div>
                        <div class="col-md-6" style="margin-top:20px;">
                            <p>FORGET PASSWORD</p>
                            <p>FORGET USERNAME </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <!-- About -->
        <div class="login-area about-area pt-100 pb-70">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 loginpage-grid">
                        <i class="icofont-stretcher"></i>
                        <div class="loginpage">
                            <h6 class="">
                                <a href="{{url('/register/patient')}}">
                                    Patient Register
                                    <i class="icofont-hand-drawn-right"></i>
                                </a>
                                
                            </h6>
                            <hr>
                        </div>
                        <!-- <hr> -->
                    </div>
                    <div class="col-lg-6  loginpage-grid">
                        <i class="icofont-doctor-alt"></i>
                        <div class="loginpage">
                            <h6 class="">
                                <a href="{{url('/register/doctor')}}">Doctor Register
                                <i class="icofont-hand-drawn-right"></i></a>
                            </h6>
                            <hr>
                        </div>
                        <!-- <hr> -->
                    </div>
                    <!-- <div class="col-lg-4  loginpage-grid">
                        <i class="icofont-hospital"></i>
                        <div class="loginpage">
                            <h6 class="">
                                <a href="{{url('/register/hospital')}}">Hospital Register</a>
                                <i class="icofont-hand-drawn-right"></i>
                            </h6>
                        </div>
                        <hr>
                    </div> -->
                </div>
            </div>
        </div>
        <div class="pb-100"></div>
        <!-- End About -->
@endsection

