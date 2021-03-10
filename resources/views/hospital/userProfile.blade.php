@extends('hospital.layout')

@section('content')

@php
    if($userProfile['hospitalUid']) $uid = trim($userProfile['hospitalUid']); else $uid = 'N/A';

    if(isset($userProfile['name'])) $firstName = $userProfile['name'] ; else $firstname = 'N/A' ;

    if(isset($userProfile['lastname'])) $lastName = $userProfile['lastname'] ; else $lastName = 'N/A' ;

    if(isset($userProfile['phone'])) $phone = $userProfile['phone'] ; else $phone = 'N/A' ;

    if(isset($userProfile['email'])) $email = $userProfile['email'] ; else $email = 'N/A' ;

    if(isset($userProfile['hospitalName'])) $hospitalName = $userProfile['hospitalName'] ;
    else $hospitalName = 'N/A' ;

    if(isset($userProfile['hospitalAddress'])) $hospitalAddress = $userProfile['hospitalAddress'] ;
    else $hospitalAddress = 'N/A' ;

    if(isset($userProfile['plan'])) $plan = $userProfile['plan'] ;
    else $plan = 'N/A' ;
    
@endphp

<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark" style="float:left;">Hospital Information</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('hospital')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Profile</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>

  <section class="content">


    <div class="row col-md-12">
        <div class="col-md-9 m-0 m-auto d-table" >
            <div class="card" style="min-height: 460px;">
                <div class="card-body">

                    <div class="tab-content">
                        <div id="basic" class="tab-pane fade show active">
                            <div class="" style="margin-top:20px; margin-bottom:30px;">
                                <div class="row col-md-12">
                                    <label class="col-md-5">
                                        <h6>Hospital User ID</h6>
                                    </label>
                                    <span class="col-md-1"> : </span>
                                    <span class="col-md-5">
                                        {{$uid}}
                                    </span>
                                </div>
                                <div class="row col-md-12">
                                    <label class="col-md-5">
                                        <h6>Representative Name</h6>
                                    </label>
                                    <span class="col-md-1"> : </span>
                                    <span class="col-md-5">{{$firstName}}</span>
                                </div>
                                <div class="row col-md-12">
                                    <label class="col-md-5">
                                        <h6>Hospital Email</h6>
                                    </label>
                                    <span class="col-md-1"> : </span>
                                    <span class="col-md-5">{{$email}}</span>
                                </div>
                                <div class="row col-md-12">
                                    <label class="col-md-5">
                                        <h6>Hospital Phone</h6>
                                    </label>
                                    <span class="col-md-1"> : </span>
                                    <span class="col-md-5">{{$phone}}</span>
                                </div>
                                <div class="row col-md-12">
                                    <label class="col-md-5">
                                        <h6>Hospital Name</h6>
                                    </label>
                                    <span class="col-md-1"> : </span>
                                    <span class="col-md-5">{{$hospitalName}}</span>
                                </div>
                                <div class="row col-md-12">
                                    <label class="col-md-5">
                                        <h6>Hospital Address</h6>
                                    </label>
                                    <span class="col-md-1"> : </span>
                                    <span class="col-md-5">{{$hospitalAddress}}</span>
                                </div>
                                <div class="row col-md-12">
                                    <label class="col-md-5">
                                        <h6>Hospital Subscription Plan</h6>
                                    </label>
                                    <span class="col-md-1"> : </span>
                                    <span class="col-md-5">{{$plan}}</span>
                                </div>
                            </div>
                            <div>
                        {{-- <a target="_blank" href="#"> --}}
                        <a href="#">
                            <img src=
                            "
                           https://images.unsplash.com/photo-1538108149393-fbbd81895907?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80
                           
                           " 
                            alt="Lamp" style="width:50%; height=50%; margin-left: auto; margin-right: auto; display: block;" >
                        </a>
                    </div>
                        </div>
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
            </div>
    </div>
@endsection
