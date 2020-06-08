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
          <h1 class="m-0 text-dark" style="float:left;">Hospital</h1>
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
                            <div class="" style="margin-top:10px;">
                                <div class="row col-md-12">
                                    <label class="col-md-5">
                                        <h6>User ID.</h6>
                                    </label>
                                    <span class="col-md-1"> : </span>
                                    <span class="col-md-5">
                                        {{$uid}}
                                    </span>
                                </div>
                                <div class="row col-md-12">
                                    <label class="col-md-5">
                                        <h6>Name</h6>
                                    </label>
                                    <span class="col-md-1"> : </span>
                                    <span class="col-md-5">{{$firstName}}</span>
                                </div>
                                <div class="row col-md-12">
                                    <label class="col-md-5">
                                        <h6>Email</h6>
                                    </label>
                                    <span class="col-md-1"> : </span>
                                    <span class="col-md-5">{{$email}}</span>
                                </div>
                                <div class="row col-md-12">
                                    <label class="col-md-5">
                                        <h6>Phone</h6>
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
                                        <h6>Plan</h6>
                                    </label>
                                    <span class="col-md-1"> : </span>
                                    <span class="col-md-5">{{$plan}}</span>
                                </div>
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
