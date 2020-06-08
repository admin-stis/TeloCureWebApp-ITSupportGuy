@extends('frontend.layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8" style="padding: 45px;">
                <div class="row col-md-12 col-sm-12">
                    <div class="row col-md-12 col-sm-12 registerpage">
                        <div class="col-md-6">
                            <img class="img-responsive img-thumbnail" src="{{asset('images/product/patient.jpg')}}" />
                            <br>
                            <div class="col-md-12 col-sm-12"><h4>Sign Up To Patient</h4></div>
                        </div>
                        <div class="col-md-5" style="margin-top:20px;">
                            <a class="hospital btn btn-dark" href="{{url('register/patient')}}">GET STARTED</a>
                        </div>
                    </div>

                    <div class="row col-md-12 col-sm-12 registerpage">
                        <div class="col-md-6">
                            <img class="img-responsive img-thumbnail" src="{{asset('images/product/doctor_group.jpg')}}" />
                            <br>
                            <div class="col-md-12 col-sm-12"><h4>Sign Up To Doctor</h4></div>
                        </div>
                        <div class="col-md-5" style="margin-top:20px;">
                            <a class="hospital btn btn-dark" href="{{url('register/doctor')}}">GET STARTED</a>
                        </div>
                    </div>

                    <div class="row col-md-12 col-sm-12 registerpage">
                        <div class="col-md-6">
                            <img class="img-responsive img-thumbnail" src="{{asset('images/product/hospital.jpg')}}" />
                            <br>
                            <div class="col-md-12 col-sm-12"><h4>Sign Up To Hospital</h4></div>
                        </div>
                        <div class="col-md-5" style="margin-top:20px;">
                            <a class="hospital btn btn-dark" href="{{url('register/hospital')}}">GET STARTED</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



