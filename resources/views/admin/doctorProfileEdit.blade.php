@extends('admin.layout')

@section('content')

<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Doctor</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('admin/doctor')}}">Doctor</a></li>
            @php
               /* if(isset($doctorProfile['uid']))
                $uid = trim($doctorProfile['uid']);  */
            @endphp
            <li class="breadcrumb-item active">Edit Profile</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>

  <section class="content">
           <div class="col-md-12">
            <div class="card" style="min-height: 460px;">
                         @if ($errors->any())
                    <ul style="margin-top:20px;">
                        @foreach ($errors->all() as $error)
                            <p class="alert alert-danger">{{ $error }}</p>
                        @endforeach
                    </ul>
                @endif
                            @if(Session::has('update_msg'))
                            <ul><p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('update_msg') }}</p></ul>
                        @endif
                        
                <div class="card-body">
                    <form id="adminDocEditForm" method="post" action="{{url('admin/dprofileEditAction')}}" enctype="multipart/form-data">
                    @csrf
                    
                    <input type="hidden" name="uid" value="@if(isset($doctorProfile['uid'])){{$doctorProfile['uid']}}@endif"/>
                    
                        <div class="tab-header">
                            <h5 class="m-0 m-auto d-table">Edit Profile </h5>
                            <hr>
                        </div>
                        <div class="row">
                           <div class="form-group col-lg-4 col-md-4 col-sm-12">
                                <label class="control-label">NID <i class="iconFa fa fa-asterisk color-red"></i> </label>
                                <input name="nid" type="text" value="@if(isset($others['nid'])){{$others['nid']}}@endif" class="form-control" />
                            </div>
                            @php
                                if(isset($doctorProfile['dateOfBirth'])){
                                  $dobirth = $doctorProfile['dateOfBirth'];
                                  $dob = date('Y-m-d',strtotime($dobirth));
                                }else{
                                  $dob = '';
                                }
                                // dd($dob);
                            @endphp

                            <div class="dates form-group  col-lg-4 col-md-4 col-sm-12">
                                <label class="control-label">Date of Birth <i class="iconFa fa fa-asterisk color-red"></i></label>

                                <input type="hidden" name="old_dateOfBirth" value="{{$dob}}"/>
                                <input type="date" class="form-control" name="dateOfBirth" value="{{$dob}}"/>
                            </div>
                              <div class="form-group  col-lg-4 col-md-4 col-sm-12">
                                <label class="control-label">Gender <i class="iconFa fa fa-asterisk color-red"></i> </label>
                                <select name="gender" type="text" class="form-control">
                                    <option value="">Select Gender</option>
                                    <option @if(isset($doctorProfile['gender'])) @if($doctorProfile['gender'] == 'Male') selected @endif @endif value="Male">Male</option>
                                    <option @if(isset($doctorProfile['gender'])) @if($doctorProfile['gender'] == 'Female') selected @endif @endif value="Female">Female</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                <label class="control-label">Name <i class="iconFa fa fa-asterisk color-red"></i> </label>
                                <input  name="name" type="text" class="form-control" placeholder="" value="@if(isset($doctorProfile['name'])){{$doctorProfile['name']}}@endif"/>
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-sm-12">                            
                                <label class="control-label">BMDC Registration Number <i class="iconFa fa fa-asterisk color-red"></i> </label>
                                <input  name="regNo" type="text" value="@if(isset($doctorProfile['regNo'])){{$doctorProfile['regNo']}}@endif" class="form-control" placeholder=""/>
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-sm-6">
                                <label class="">Academic Degree <i class="iconFa fa fa-asterisk color-red"></i> </label>

                                @if(isset($others['acadeimcDegree']))
                                <input name="acadeimcDegree" value="{{$others['acadeimcDegree']}}" type="text" class="form-control" placeholder=""/>
                                @else
                                <input name="acadeimcDegree" value="{{old('acadeimcDegree')}}" type="text" class="form-control" placeholder=""/>
                                @endif

                            </div>
                            
                            <div class="form-group col-lg-6 col-md-6 col-sm-6">
                                <label class="">Other Degrees</label>
                                <input name="otherDegree" value="@if(isset($others['otherDegree'])){{$others['otherDegree']}}@endif" type="text" class="form-control" placeholder="" />
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                <label class="">Phone <i class="iconFa fa fa-asterisk color-red"></i> </label>
                                <input name="phone" type="text" readonly class="form-control" placeholder="" value="@if(isset($doctorProfile['phone'])){{$doctorProfile['phone']}}@endif"/>
                            </div>

                            <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                <label class="">Email <i class="iconFa fa fa-asterisk color-red"></i> </label>
                                <input name="email" type="email" class="form-control" placeholder="" value="@if(isset($doctorProfile['email'])){{$doctorProfile['email']}}@endif"/>
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
                                    <option value="@if(isset($doctorProfile['district'])){{$doctorProfile['district']}}@endif">@if(isset($doctorProfile['district'])){{$doctorProfile['district']}}@endif</option>
                                </select>
                            </div>
                            
                             <div class="form-group  col-lg-6 col-md-6 col-sm-12">
                                <label class="control-label">Speciality <i class="iconFa fa fa-asterisk color-red"></i> </label>
                                <select name="doctorType" type="text" class="form-control">
                                    <option value="">Select Speciality</option>
                                    <option @if(isset($doctorProfile['doctorType'])) @if($doctorProfile['doctorType'] == 'GENERAL') selected @endif @endif value="GENERAL">General Practitioner</option>
                                    <option @if(isset($doctorProfile['doctorType'])) @if($doctorProfile['doctorType'] == 'PEDIATRIC') selected @endif @endif value="PEDIATRIC">Pediatric</option>
                                </select>
                            </div>
                            
                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <label class="control-label">Profile Picture (Only JPG, PNG, BMP and GIF files are allowed)</label>
                                <input name="photoUrl" type="file" class="form-control" placeholder="" value="@if(isset($doctorProfile['photoUrl'])) {{$doctorProfile['photoUrl']}} @endif"/>
                                
                            </div>
                           <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <label class="control-label">Degree/Certificate Documents(MBBS) (Only JPG, PNG, BMP and GIF files are allowed)</label>
                                <input name="degreeCertificate" type="file"  class="form-control" placeholder="" value="@if(isset($documents['academicCertificate'])){{$documents['academicCertificate']}}@endif" />
                                
                            </div>
                            
                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <label class="control-label">NID Front Side (Only JPG, PNG, BMP and GIF files are allowed)</label>
                                <input name="nidFront" type="file" class="form-control" placeholder="" value="@if(isset($documents['nidFront'])){{$documents['nidFront']}}@endif"/>
                                
                            </div>
                            
                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <label class="control-label">NID back side(Only JPG, PNG, BMP and GIF files are allowed)</label>
                                <input name="nidBack" type="file" class="form-control" placeholder="" value="@if(isset($documents['nidBack'])){{$documents['nidBack']}}@endif"/>
                                
                            </div>
                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                            <button class="btn btn-primary" type="submit" id="submit" >Submit</button>
                            </div>
                            </div> 
                            </form>
                    
</div></div></div>
</section>

@endsection
