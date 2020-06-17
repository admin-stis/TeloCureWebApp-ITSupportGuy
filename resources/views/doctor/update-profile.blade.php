@extends('doctor.layout')

@section('content')

@php

//dd($doctorProfile);

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
              <li class="breadcrumb-item"><a href="{{url('doctor')}}">Home</a></li>
              <li class="breadcrumb-item active">Edit Profile</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
        <div class="notification text-center"></div>

        <div class="card">
        <div class="card-header complete-profille-header  alert-primary">
                <div class="card-title text-center">
                    <h4>Update Profile Information</h4>
                </div>
            </div>

            @if(Session::has('update_msg'))
                            <ul><p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('update_msg') }}</p></ul>
                        @endif


            <div class="card-body col-md-12 col-sm-12">


                <form id="regForm" method="post" action="{{url('doctor/profile/editAction')}}" enctype="multipart/form-data">
                    <!-- One "tab" for each step in the form: -->
                    @csrf
                    <input type="hidden" name="uid" value="{{$doctorProfile['uid']}}"/>


                    {{--<input type="hidden" name="hospitalUid" value="{{$id}}"/>--}}

                    <div class="">
                        <div class="tab-header">
                            <h5 class="m-0 m-auto d-table pb-10  ">Basic Information</h5>
                            <hr>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-4 col-md-4 col-sm-12">
                                <label class="control-label">NID <i class="iconFa fa fa-asterisk color-red"></i> </label>
                                <input name="nid" type="number"
                                value="@if(isset($others['nid'])){{$others['nid']}}@endif" class="form-control" value=""placeholder=""/>
                            </div>
                            <div class="dates form-group  col-lg-4 col-md-4 col-sm-12">
                                <label class="control-label">Date of Birth <i class="iconFa fa fa-asterisk color-red"></i> </label>
                                {{-- <input id="datepicker" type="text" class="form-control" placeholder=""/>
                                <input name="dateOfBirth" type="date" class="form-control"
                                value="{{$doctorProfile['dateOfBirth']}}"
                                id="usr1" name="event_date" placeholder="YYYY-MM-DD" autocomplete="off" >--}}

                                <input type="hidden" name="old_dateOfBirth" value="{{$doctorProfile['dateOfBirth']}}"/>
                                <input type="date" class="form-control" name="dateOfBirth" value="{{$doctorProfile['dateOfBirth']}}"/>
                            </div>

                            <div class="form-group  col-lg-4 col-md-4 col-sm-12">
                                <label class="control-label">Gender <i class="iconFa fa fa-asterisk color-red"></i> </label>
                                <select name="gender" type="text" class="form-control">
                                    <option value="">Select Gender</option>
                                    <option @if($doctorProfile['gender'] == 'Male') selected @endif value="Male">Male</option>
                                    <option @if($doctorProfile['gender'] == 'Female') selected @endif value="Female">Female</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                <label class="control-label">Name <i class="iconFa fa fa-asterisk color-red"></i> </label>
                                <input  name="name" type="text" class="form-control" placeholder="" value="{{$doctorProfile['name']}}"/>
                            </div>
                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <label class="control-label">BMDC Registration Number <i class="iconFa fa fa-asterisk color-red"></i> </label>
                                <input  name="regNo" type="text" value="{{$doctorProfile['regNo']}}" class="form-control" placeholder=""/>
                            </div>
                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <label class="">Academic Degree <i class="iconFa fa fa-asterisk color-red"></i> </label>

                                @if(isset($others['acadeimcDegree']))
                                <input name="acadeimcDegree" value="{{$others['acadeimcDegree']}}" type="text" class="form-control" placeholder=""/>
                                @else
                                <input name="acadeimcDegree" value="{{old('acadeimcDegree')}}" type="text" class="form-control" placeholder=""/>
                                @endif

                            </div>
                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <label class="">Other Degrees</label>
                                <input name="otherDegree" value="@if(isset($others['otherDegree'])){{$others['otherDegree']}}@endif" type="text" class="form-control" placeholder="" value="   "/>
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                <label class="">Phone</label>
                                <input name="phone" type="text"  readonly class="form-control" placeholder="" value="{{$doctorProfile['phone']}}"/>
                            </div>

                            <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                <label class="">Email</label>
                                <input name="email" type="email" class="form-control" placeholder="" value="{{$doctorProfile['email']}}"/>
                            </div>
                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <label class="">Currrent Address <i class="iconFa fa fa-asterisk color-red"></i> </label>
                                <textarea name="presentAddress" value="@if(isset($others['presentAddress'])){{$others['presentAddress']}}@endif" type="text" class="form-control" placeholder="">
                                    @if(isset($others['presentAddress'])){{$others['presentAddress']}}@endif
                                </textarea>
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                <label class="">District <i class="iconFa fa fa-asterisk color-red"></i></label>

                                <select name="district" type="text" class="form-control" >
                                    <option value="{{$doctorProfile['district']}}">{{$doctorProfile['district']}}</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                <label class="">District ID <i class="iconFa fa fa-asterisk color-red"></i></label>
                                <input name="postalCode" value="@if(isset($doctorProfile['districtId'])){{$doctorProfile['districtId']}}@endif" type="text" class="form-control" placeholder=""/>
                            </div>
                            <div class="form-group  col-lg-4 col-md-4 col-sm-12">
                                <label class="control-label">Speciality <i class="iconFa fa fa-asterisk color-red"></i> </label>
                                <select name="doctorType" type="text" class="form-control">
                                    <option value="">Select Speciality</option>
                                    <option @if($doctorProfile['doctorType'] == 'GENERAL') selected @endif value="GENERAL">General Practitioner</option>
                                    <option @if($doctorProfile['doctorType'] == 'PEDIATRIC') selected @endif value="PEDIATRIC">Pediatric</option>
                                </select>
                            </div>
                            {{--
                            <div class="form-group  col-lg-12 col-md-12 col-sm-12">
                                <button class="col-md-2 btn btn-primary nextBtn m-0 d-table m-auto" type="button">
                                    Next <i class="fa fa-arrow-circle-right pull-right"></i>
                                </button>
                            </div>
                            --}}
                            </div>
                        </div>
                    <div class="">
                        <div class="tab-header">
                            <h5 class="m-0 m-auto d-table">Upload Documents</h5>
                            <hr>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <label class="control-label">Degree/Certificate Documents <i class="iconFa fa fa-asterisk color-red"></i> </label>

                                <input name="old_degreeCertificate" type="hidden" class="form-control" value="{{$documents['academicCertificate']}}" />
                                <input name="degreeCertificate" type="file" class="form-control" placeholder="" />

                            </div>
                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <label class="control-label">Profile Picture <i class="iconFa fa fa-asterisk color-red"></i> </label>

                                {{--<input name="photoUrl" type="file" class="form-control" placeholder="" />--}}

                                <input name="old_photoUrl" type="hidden" class="form-control" value="{{$doctorProfile['photoUrl']}}" />
                                <input name="photoUrl" type="file" class="form-control" placeholder="" value="{{$doctorProfile['photoUrl']}}"/>
                            </div>


                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <label class="control-label">Prescription Form <i class="iconFa fa fa-asterisk color-red"></i> </label>
                                @if(isset($documents['prescriptionForm']))
                                <input name="old_prescriptionForm" type="hidden" class="form-control" value="{{$documents['prescriptionForm']}}" />
                                <input name="prescriptionForm" type="file" class="form-control" placeholder="" value="{{$documents['prescriptionForm']}}"/>
                                @else
                                <input name="old_prescriptionForm" type="hidden" class="form-control" value="" />
                                <input name="prescriptionForm" type="file" class="form-control" placeholder="" value=""/>
                                @endif
                            </div>

                        </div>
                    </div>
                    <div class="">


                        @if(isset($doctorProfile['hospitalized']) && $doctorProfile['hospitalized'] == true)
                        <div class="tab-header" style="display: none;">
                            <h5 class="m-0 m-auto d-table  tab-header">Bank Information</h5>
                            <hr>
                        </div>
                        <div class="row" style="display: none;">
                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <label class="">Name on the Account <i class="iconFa fa fa-asterisk color-red"></i></label>
                                <input name="accountName" type="text" class="form-control"  value="@if(isset($bank_info['accountName'])){{$bank_info['accountName']}} @endif"placeholder=""/>
                            </div>
                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <label class="">Bank Name <i class="iconFa fa fa-asterisk color-red"></i></label>
                                <input name="bankName" type="text" class="form-control" value="{{$bank_info['bankName']}}" placeholder=""/>
                            </div>
                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <label class="">Bank Account Number <i class="iconFa fa fa-asterisk color-red"></i></label>
                                <input name="accountNo" type="number" class="form-control" value="{{$bank_info['accountNumber']}}"placeholder=""/>
                            </div>
                            {{--<div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <label class="">Branch Name <i class="iconFa fa fa-asterisk color-red"></i></label>
                                <input name="branchName" type="text" value="{{$bank_info['branch']}}" class="form-control" placeholder=""/>
                            </div>--}}
                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <label class="">Swift Code/Routing Number</label>
                                <input name="swiftCode" type="text" class="form-control" value="{{$bank_info['swiftCode']}}" placeholder=""/>
                            </div>

                        </div>
                        @else
                        <div class="tab-header">
                            <h5 class="m-0 m-auto d-table  tab-header">Bank Information</h5>
                            <hr>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <label class="">Name on the Account <i class="iconFa fa fa-asterisk color-red"></i></label>
                                <input name="accountName" type="text" class="form-control"  value="@if(isset($bank_info['accountName'])){{$bank_info['accountName']}} @endif"placeholder=""/>
                            </div>
                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <label class="">Bank Name <i class="iconFa fa fa-asterisk color-red"></i></label>
                                <input name="bankName" type="text" class="form-control" value="{{$bank_info['bankName']}}" placeholder=""/>
                            </div>
                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <label class="">Bank Account Number <i class="iconFa fa fa-asterisk color-red"></i></label>
                                <input name="accountNo" type="number" class="form-control" value="{{$bank_info['accountNumber']}}"placeholder=""/>
                            </div>
                            {{--<div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <label class="">Branch Name <i class="iconFa fa fa-asterisk color-red"></i></label>
                                <input name="branchName" type="text" value="{{$bank_info['branch']}}" class="form-control" placeholder=""/>
                            </div>--}}
                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <label class="">Swift Code/Routing Number</label>
                                <input name="swiftCode" type="text" class="form-control" value="{{$bank_info['swiftCode']}}" placeholder=""/>
                            </div>

                        </div>
                        @endif
                    </div>

                    {{--<div style="overflow:auto;">
                      <div style="float:right;">
                        <button class="btn btn-secondary" type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                        <button class="btn btn-primary" type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
                      </div>
                    </div>--}}
                    <!-- Circles which indicates the steps of the form: -->
                    {{--<div style="text-align:center;margin-top:40px;">
                      <span class="step"></span>
                      <span class="step"></span>
                      <span class="step"></span>
                    </div>--}}

                        <button class="btn btn-primary" type="submit" id="submit" >Submit</button>
                                       </form>
                </div>
        </div>

    </section>

@endsection
