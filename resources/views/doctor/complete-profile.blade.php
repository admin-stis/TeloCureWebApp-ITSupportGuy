@extends('doctor.layout')

@section('content')
<!-- Content Header (Page header) -->
    @php
        $doctorInfo = Session::get('user');
        $district = Session::get('district');

        /*
        if(isset($doctorInfo[0]['hospitalUserId']))
            $id = $doctorInfo[0]['hospitalUserId'];
        else $id = "";
        */

        if(isset($doctorInfo[0]['hospitalUid']))
            $id = $doctorInfo[0]['hospitalUid'];
        else $id = "";

        if(isset($doctorInfo[0]['doctorType'])) $type = $doctorInfo[0]['doctorType'];
        else $type = "";

        if(isset($doctorInfo[0]['gender'])) $gender = $doctorInfo[0]['gender'];
        else $gender = "";

        if(isset($doctorInfo[0]['district'])) $dis = $doctorInfo[0]['district'];
        else $dis = "";

        //dd($doctorInfo);
        //dd($district);
        //dd($bank_info);



    @endphp

    @php
        if(isset($doctorInfo[0]['dateOfBirth'])){
          $dobirth = $doctorInfo[0]['dateOfBirth'];
          $dob = date('Y-m-d',strtotime($dobirth));
        }else{
          $dob = '';
        }
        // dd($dob);
    @endphp
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark" style="float:left;">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('doctor')}}">Home</a></li>
              <li class="breadcrumb-item active">Complete Profile</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
        <div class="notification text-center"></div>

        <div class="card">
        <div class="card-header complete-profille-header alert-primary">
                <div class="card-title text-center">
                    <h4>Complete Profile Information</h4>
                </div>
            </div>
            <div class="card-body col-md-12 col-sm-12">

                @if ($errors->any())
                    <ul>
                        @foreach ($errors->all() as $error)
                            <p class="alert alert-danger">{{ $error }}</p>
                        @endforeach
                    </ul>
                @endif

                <form id="regForm" method="post" action="{{url('doctor/complete-profileAction')}}" enctype="multipart/form-data">
                    <!-- One "tab" for each step in the form: -->
                    @csrf
                    <input type="hidden" name="uid" value="{{$doctorInfo[0]['uid']}}"/>


                    <input type="hidden" name="hospitalUid" value="{{$id}}"/>

                    <div class="tab">
                        <div class="tab-header">
                            <h5 class="m-0 m-auto d-table pb-10  ">Basic Information</h5>
                            <hr>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-4 col-md-4 col-sm-12">
                                <label class="control-label">NID <i class="iconFa fa fa-asterisk color-red"></i> </label>
                                <input name="nid" type="number" required="required" class="form-control" placeholder=""  value=
                                @if(isset($doctorInfo[0]['uid'])){{$doctorInfo[0]['uid']}}@else
                                {{old('nid')}} @endif />
                            </div>
                            <div class="dates form-group  col-lg-4 col-md-4 col-sm-12">
                                <label class="control-label">Date of Birth <i class="iconFa fa fa-asterisk color-red"></i> </label>
                                {{-- <input id="datepicker" type="text" required="required" class="form-control" placeholder=""/> --}}
                                {{--
                                    <input name="dateOfBirth" type="date" class="form-control" id="usr1" placeholder="YYYY-MM-DD" autocomplete="off"  value=
                                @if(isset($doctorInfo[0]['dateOfBirth'])) {{$doctorInfo[0]['dateOfBirth']}} @else {{old('dateOfBirth')}} @endif>
                                --}}
                                <input name="dateOfBirth" type="date" class="form-control" id="usr1" placeholder="YYYY-MM-DD" autocomplete="off"  value="{{$dob}}">
                            </div>
                            <div class="form-group  col-lg-4 col-md-4 col-sm-12">
                                <label class="control-label">Gender <i class="iconFa fa fa-asterisk color-red"></i> </label>
                                <select name="gender" type="text" required="required" class="form-control">
                                    <option value="">Select Gender</option>
                                    <option value="Male" @if($gender == 'Male') selected @endif>Male</option>
                                    <option value="Female" @if($gender == 'Female') selected @endif>Female</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                <label class="control-label">Name <i class="iconFa fa fa-asterisk color-red"></i> </label>
                                <input  name="name" type="text" required="required" class="form-control" placeholder="" value="{{$doctorInfo[0]['name']}}"/>
                            </div>
                            {{-- <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                <label  class="control-label">Last Name <i class="iconFa fa fa-asterisk color-red"></i> </label>
                                <input name="lastname" type="text" required="required" class="form-control" placeholder="" value="{{$doctorInfo[0]['lastname']}}"/>
                            </div> --}}
                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <label class="control-label">BMDC Registration Number <i class="iconFa fa fa-asterisk color-red"></i> </label>
                                <input  name="regNo" type="text" required="required" class="form-control" placeholder="" value="@if(isset($doctorInfo[0]['regNo'])){{$doctorInfo[0]['regNo']}}@else{{old('regNo')}}@endif"/>
                            </div>
                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <label class="">Academic Degree <i class="iconFa fa fa-asterisk color-red"></i> </label>
                                <input name="acadeimcDegree" type="text" required="required" class="form-control" placeholder=""  value="{{old('acadeimcDegree')}}"/>
                            </div>
                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <label class="">Other Degrees</label>
                                <input name="otherDegree" type="text" class="form-control" placeholder="" value="   "/>
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                <label class="">Phone</label>
                                <input name="phone" type="text"  readonly required="required" class="form-control" placeholder="" value="{{$doctorInfo[0]['phone']}}"/>
                            </div>

                            <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                <label class="">Email</label>
                                <input name="email" type="email" required="required" class="form-control" placeholder="" value="{{$doctorInfo[0]['email']}}"/>
                            </div>
                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <label class="">Currrent Address <i class="iconFa fa fa-asterisk color-red"></i> </label>
                                <textarea name="presentAddress" type="text" required="required" class="form-control" placeholder="">{{old('presentAddress')}}</textarea>
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                <label class="">District <i class="iconFa fa fa-asterisk color-red"></i></label>

                                <select name="district" type="text" required="required" class="form-control" >
                                    <option value="">Select District</option>
                                    {{-- <option value="{{$dis}}" selected>{{$dis}}</option> --}}
                                    @foreach ($district as $key=>$item)
                                        @php //print_r($item); @endphp
                                        <option value="{{$item['name']}}"

                                        @if($item['name'] == $dis) selected @endif

                                        >{{$item['name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                <label class="">PostalCode <i class="iconFa fa fa-asterisk color-red"></i></label>
                                <input name="postalCode" type="text" required="required" class="form-control" placeholder="" value="{{old('postalCode')}}"/>
                            </div>
                            <div class="form-group  col-lg-4 col-md-4 col-sm-12">
                                <label class="control-label">Speciality <i class="iconFa fa fa-asterisk color-red"></i> </label>
                                <select name="doctorType" type="text" required="required" class="form-control">
                                    <option value="">Select Speciality</option>
                                    <option value="GENERAL" @if($type == "GENERAL") selected @endif>General Practitioner</option>
                                    <option value="PEDIATRIC" @if($type == "PEDIATRIC") selected @endif>Pediatric</option>
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
                        
                   {{-- mridul addition 13-7-20 --}}
                    
                    @php                     
                    if(array_key_exists("registrationStat", $doctorInfo[0])) { $regStat = $doctorInfo[0]['registrationStat']; } else { $regStat = 0; } 
                    @endphp
                     
                    <input type="hidden" name="registrationStat" value="@php echo $regStat; @endphp" />
                    
                    @php if($regStat < 2) { @endphp                     
                     
                    <div class="tab">
                        <div class="tab-header">
                            <h5 class="m-0 m-auto d-table">Upload Documents</h5>
                            <hr>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <label class="control-label">Degree/Certificate Documents(MBBS) <i class="iconFa fa fa-asterisk color-red"></i> </label>
                                <input name="degreeCertificate" type="file" required="required" class="form-control" placeholder="" />
                                <p class="text-danger mt-1" style="font-size:12px;">Only JPG, PNG, BMP and GIF files are allowed</p>
                            </div>

                            @if(isset($doctorInfo[0]['photoUrl']) && !empty($doctorInfo[0]['photoUrl']))
                            {{-- mridul 20-8-20 if hospital doc then show it as dummy profile pic was added when hospital added doc: --}}
                            @if(isset($doctorInfo[0]['hospitalized']) && $doctorInfo[0]['hospitalized'] == true) 
                            
                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <label class="control-label">Profile Picture <i class="iconFa fa fa-asterisk color-red"></i> </label>
                                <input name="photoUrl" type="file" required="required" class="form-control" placeholder=""/>
                                <p class="text-danger mt-1" style="font-size:12px;">Only JPG, PNG, BMP and GIF files are allowed</p>
                            </div>
                            
                            @else
                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <input name="old_photoUrl" type="hidden" required="required" class="form-control" placeholder="" value="{{$doctorInfo[0]['photoUrl']}}"/>
                            </div>
                            @endif
                            
                            @else 

                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <label class="control-label">Profile Picture <i class="iconFa fa fa-asterisk color-red"></i> </label>
                                <input name="photoUrl" type="file" required="required" class="form-control" placeholder=""/>
                                <p class="text-danger mt-1" style="font-size:12px;">Only JPG, PNG, BMP and GIF files are allowed</p>
                            </div>
                            
                            @endif
                            
                            {{-- mridul addition 20-7-20 --}}
                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <label class="control-label">NID Front Side</label>
                                <input name="nidFront" type="file" class="form-control" placeholder="" />
                                <p class="text-danger mt-1" style="font-size:12px;">Only JPG, PNG, BMP and GIF files are allowed</p>
                            </div>
                            
                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <label class="control-label">NID back side</label>
                                <input name="nidBack" type="file" class="form-control" placeholder="" />
                                <p class="text-danger mt-1" style="font-size:12px;">Only JPG, PNG, BMP and GIF files are allowed</p>
                            </div>
                            
                            {{-- mridul comment 19-7-20 --}}
                            {{-- <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <label class="control-label">Prescription Form </label>
                                <input name="prescriptionForm" type="file" class="form-control" placeholder="" />
                                <p class="text-danger mt-1" style="font-size:12px;">Only JPG, PNG, BMP and GIF files are allowed</p>
                            </div> --}}

                        </div>
                    </div> @php } @endphp
                    
                    {{-- mridul addition 20-7-20 --}}
                     @php if($regStat ==2) { @endphp                      
                     <div class="tab">
                        <div class="tab-header">
                            <h5 class="m-0 m-auto d-table">Upload Documents</h5>
                            <hr>
                        </div>
                        <div class="row">                                                       
                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <label class="control-label">NID Front Side</label>
                                <input name="nidFront" type="file" class="form-control" placeholder="" />
                                <p class="text-danger mt-1" style="font-size:12px;">Only JPG, PNG, BMP and GIF files are allowed</p>
                            </div>
                            
                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <label class="control-label">NID back side</label>
                                <input name="nidBack" type="file" class="form-control" placeholder="" />
                                <p class="text-danger mt-1" style="font-size:12px;">Only JPG, PNG, BMP and GIF files are allowed</p>
                            </div>

                        </div>
                    </div> @php } @endphp
                    
                    <div class="tab">
                        <div class="tab-header">
                            <h5 class="m-0 m-auto d-table  tab-header">Bank Information</h5>
                            <hr>
                        </div>
                        <div class="row">

                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <label class="">Name on the Account <i class="iconFa fa fa-asterisk color-red"></i></label>

                                @if(isset($bank_info['accountName']))
                                <input name="accountName" type="text" required="required" class="form-control" placeholder="" value="{{$bank_info['accountName']}}" readonly />
                                @else
                                <input name="accountName" type="text" required="required" class="form-control" placeholder="" value="{{old('accountName')}}"/>
                                @endif

                            </div>

                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <label class="">Bank Name <i class="iconFa fa fa-asterisk color-red"></i></label>

                                @if(isset($bank_info['bankName']))
                                <input name="bankName" type="text" required="required" class="form-control" placeholder="" value="{{$bank_info['bankName']}}" readonly />
                                @else
                                <input name="bankName" type="text" required="required" class="form-control" placeholder="" value="{{old('bankName')}}"/>
                                @endif
                            </div>
                            @if(isset($bank_info['accountNumber']))
                            <div class="form-group col-lg-12 col-md-12 col-sm-12" style="display: none;">
                                <label class="">Bank Account Number <i class="iconFa fa fa-asterisk color-red"></i></label>
                                <input name="accountNo" type="number" required="required" class="form-control" placeholder="" value="{{$bank_info['accountNumber']}}" readonly />
                            </div>
                            @else
                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <label class="">Bank Account Number <i class="iconFa fa fa-asterisk color-red"></i></label>
                                <input name="accountNo" type="number" required="required" class="form-control" placeholder="" value="{{old('accountNo')}}"/>
                            </div>
                            @endif

                            {{--
                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <label class="">Branch Name <i class="iconFa fa fa-asterisk color-red"></i></label>
                                <input name="branchName" type="text" required="required" class="form-control" placeholder=""/>
                            </div>
                            --}}

                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <label class="">Swift Code/Routing Number</label>
                                @if(isset($bank_info['swiftCode']))
                                <input name="swiftCode" type="text" class="form-control" placeholder="" value="{{$bank_info['swiftCode']}}" readonly />
                                @else
                                <input name="swiftCode" type="text" class="form-control" placeholder="" value="{{old('swiftCode')}}"  />
                                @endif
                            </div>


                        </div>
                    </div>

                    <div style="overflow:auto;">
                      <div style="float:right;">
                        <button class="btn btn-secondary" type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                        <button class="btn btn-primary" type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
                      </div>
                    </div>
                    <!-- Circles which indicates the steps of the form: -->
                    <div style="text-align:center;margin-top:40px;">
                      <span class="step"></span>
                      <span class="step"></span>
                      <span class="step"></span>
                    </div>
                  </form>
                </div>
        </div>

    </section>

@endsection
