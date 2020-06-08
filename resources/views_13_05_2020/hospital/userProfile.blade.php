@extends('hospital.layout')

@section('content')

@php
    if(isset($userProfile['name'])) $firstName = $userProfile['name'] ; else $firstname = 'N/A' ;
    if(isset($userProfile['lastname'])) $lastName = $userProfile['lastname'] ; else $lastName = 'N/A' ;
    if(isset($userProfile['phone'])) $phone = $userProfile['phone'] ; else $phone = 'N/A' ;
    if(isset($userProfile['email'])) $email = $userProfile['email'] ; else $email = 'N/A' ;
@endphp

<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark" style="float:left;">Hospital</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('admin/hospital/user')}}">Dashboard</a></li>
            @php
                $uid = trim($userProfile['uid']);
            @endphp
            <li class="breadcrumb-item active"><a href="{{url('admin/hospital/user/'.$uid)}}">Profile</a></li>
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
                                        @if(isset($userProfile['uid'])) {{$userProfile['uid']}} @else N/A @endif
                                    </span>
                                </div>
                                <div class="row col-md-12">
                                    <label class="col-md-5">
                                        <h6>First Name</h6>
                                    </label>
                                    <span class="col-md-1"> : </span>
                                    <span class="col-md-5">{{$firstName}}</span>
                                </div>
                                <div class="row col-md-12">
                                    <label class="col-md-5">
                                        <h6>Last Name</h6>
                                    </label>
                                    <span class="col-md-1"> : </span>
                                    <span class="col-md-5">{{$lastName}}</span>
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
