@extends('hospital.layout')

@section('content')

@php

    print_r(1);
    print_r($doctorProfile);
    dd($doctorProfile);
    dd(1);

    if(isset($doctorProfile[0]['hospitalUserId'])) $hospitalUid = $doctorProfile[0]['hospitalUserId']; else $hospitalUserId = '';

    if(isset($doctorProfile[0]['district'])) $district = $doctorProfile[0]['district']; else $hospitalUserId = '';
    if(isset($doctorProfile[0]['doctorType'])) $doctorType = $doctorProfile[0]['doctorType']; else $doctorType = '';
    if(isset($doctorProfile[0]['name'])) $name = $doctorProfile[0]['name']; else $name = '';
    if(isset($doctorProfile[0]['phone'])) $phone = $doctorProfile[0]['phone']; else $phone = '';
    if(isset($doctorProfile[0]['email'])) $email = $doctorProfile[0]['email']; else $email = '';
    if(isset($doctorProfile[0]['nid'])) $nid = $doctorProfile[0]['nid']; else $nid = '';

    if(isset($doctorProfile[0]['photoUrl'])) $photoUrl = $doctorProfile[0]['photoUrl']; else $photoUrl = '';
    if(isset($doctorProfile[0]['price'])) $price = $doctorProfile[0]['price']; else $price = '';
    if(isset($doctorProfile[0]['regNo'])) $regNo = $doctorProfile[0]['regNo']; else $regNo = '';
    if(isset($doctorProfile[0]['gender'])) $gender = $doctorProfile[0]['gender']; else $gender = '';
    if(isset($doctorProfile[0]['bloodGroup'])) $blood = $doctorProfile[0]['bloodGroup']; else $blood = '';
    if(isset($doctorProfile[0]['dateOfBirth'])) $dateOfBirth = $doctorProfile[0]['dateOfBirth']; else $dateOfBirth = '';

    if(isset($doctorProfile[0]['academicDegree'])) $academicDegree = $doctorProfile[0]['academicDegree']; else $academicDegree = '';
    if(isset($doctorProfile[0]['otherDegree'])) $otherDegree = $doctorProfile[0]['otherDegree']; else $otherDegree = '';

    if(isset($doctorProfile[0]['presentAddress'])) $presentAddress = $doctorProfile[0]['presentAddress']; else $presentAddress = '';

@endphp





<!-- Content Header (Page header) -->

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark" style="float:left;">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/doctor')}}">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
        <div class="notification text-center"></div>

        <div class="card">
        <div class="card-header complete-profille-header">
                <div class="card-title text-center alert-primary">
                    <h4>Update Profile Information</h4>
                </div>
            </div>
            <div class="card-body col-md-12 col-sm-12">

                <form id="updateDoctorForm" class="row" method="post" action="{{url('doctor/update-profileAction')}}" enctype="multipart/form-data">
                    <!-- One "tab" for each step in the form: -->
                    @csrf

                    <input type="hidden" name="uid" value="{{$doctorProfile[0]['uid']}}"/>

                    <input type="hidden" name="hospitalUid" value="{{$hospitalUid}}"/>

                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                            <label class="control-label">Profile Picture <i class="iconFa fa fa-asterisk color-red"></i> </label>

                            <input name="old_photoUrl" type="hidden" required="" class="form-control" value="{{$photoUrl}}" />
                            <input name="photoUrl" type="file" required="" class="form-control" placeholder="" />
                        </div>

                        <div class="form-group  col-lg-12 col-md-12 col-sm-12">
                            <label>Name</label>
                            <input name="name" type="text" class="form-control" value="{{$name}}"/>
                        </div>

                        <div class="form-group  col-lg-12 col-md-12 col-sm-12">
                            <label>NID</label>
                            <input name="nid" type="" class="form-control"  value="{{$nid}}"/>
                        </div>

                        <div class="form-group  col-lg-6 col-md-6 col-sm-12">
                            <label>Date of Birth</label>
                            <input type="hidden" name="old_dateOfBirth" value="{{$dateOfBirth}}"/>
                            <input type="date" class="form-control" name="dateOfBirth" value="{{$dateOfBirth}}"/>
                        </div>

                        <div class="form-group  col-lg-6 col-md-6 col-sm-12">
                            <label class="control-label">Gender <i class="iconFa fa fa-asterisk color-red"></i> </label>
                            <select name="gender" type="text" required="required" class="form-control">
                                <option value="">Select Gender</option>
                                <option @if($gender == 'Male') selected @endif value="Male">Male</option>
                                <option @if($gender == 'Female') selected @endif value="Female">Female</option>
                            </select>
                        </div>

                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                            <label class="control-label">BMDC Registration Number <i class="iconFa fa fa-asterisk color-red"></i> </label>
                            <input  name="regNo" type="text" value="{{$regNo}}" required="required" class="form-control" placeholder=""/>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6">
                            <label class="">Academic Degree <i class="iconFa fa fa-asterisk color-red"></i> </label>
                            <input name="academicDegree" value="{{$academicDegree}}" type="text" required="required" class="form-control" placeholder=""/>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6">
                            <label class="">Other Degree</label>
                            <input name="otherDegree" value="{{$otherDegree}}" type="text" class="form-control" placeholder=""/>
                        </div>

                        <div class="form-group col-lg-7 col-md-7 col-sm-12">
                            <label class="">Present Address</label>
                            <input name="presentAddress" value="{{$presentAddress}}" type="text" class="form-control" placeholder=""/>
                        </div>

                        <div class="form-group col-lg-5 col-md-5 col-sm-12">
                            <label class="">District</label>

                            <select name="district" type="text" required="required" class="form-control" >
                                <option value="">Select District</option>
                                @foreach ($districtlist as $key=>$item)
                                    <option @if($district == $item['name']) selected @endif value="{{$item['name']}}">{{$item['name']}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group  col-lg-4 col-md-4 col-sm-12">
                            <label class="control-label">Speciality <i class="iconFa fa fa-asterisk color-red"></i> </label>
                            <select name="doctorType" type="text" required="required" class="form-control">
                                <option value="">Select Speciality</option>
                                <option @if($doctorType == 'GENERAL') selected @endif value="GENERAL">General Practitioner</option>
                                <option @if($doctorType == 'PEDIATRIC') selected @endif value="PEDIATRIC">Pediatric</option>
                            </select>
                        </div>

                        <div class="form-group col-lg-12 col-md-12 col-sm-12">
                            <button type="submit" class="btn btn-sm btn-primary">Update</button>
                        </div>




                    </form>

                </div>
        </div>

    </section>

@endsection
