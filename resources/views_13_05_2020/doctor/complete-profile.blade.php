@extends('doctor.layout')

@section('content')
<!-- Content Header (Page header) -->
    @php
        $doctorInfo = Session::get('user');
        $district = Session::get('district');
        // echo '<pre>';
        // print_r($doctorInfo);
        // dd(1);
    @endphp
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark" style="float:left;">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
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
                <div class="card-title text-center">
                    <h3>Complete Profile Information</h3>
                </div>
            </div>
            <div class="card-body col-md-12 col-sm-12">
                {{-- <form role="form" class="step-form">
                    <div class="panel panel-primary setup-content" id="step-1">
                        <div class="row panel-body">
                            <div class="form-group col-lg-4 col-md-4 col-sm-12">
                                <label class="control-label">NID <i class="iconFa fa fa-asterisk color-red"></i> </label>
                                <input type="text" required="required" class="form-control" placeholder=""/>
                            </div>
                            <div class="form-group  col-lg-4 col-md-4 col-sm-12">
                                <label class="control-label">Date of Birth <i class="iconFa fa fa-asterisk color-red"></i> </label>
                                <input type="text" required="required" class="form-control" placeholder=""/>
                            </div>
                            <div class="form-group  col-lg-4 col-md-4 col-sm-12">
                                <label class="control-label">Gender <i class="iconFa fa fa-asterisk color-red"></i> </label>
                                <select type="text" required="required" class="form-control">
                                    <option value="">Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Male">Female</option>
                                    <option value="Male">Others</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                <label class="control-label">First Name <i class="iconFa fa fa-asterisk color-red"></i> </label>
                                <input type="text" required="required" class="form-control" placeholder="" value="{{$doctorInfo[0]['name']}}"/>
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                <label class="control-label">Last Name <i class="iconFa fa fa-asterisk color-red"></i> </label>
                                <input type="text" required="required" class="form-control" placeholder="" value="{{$doctorInfo[0]['lastname']}}"/>
                            </div>
                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <label class="control-label">BMDC Registration Number <i class="iconFa fa fa-asterisk color-red"></i> </label>
                                <input type="text" required="required" class="form-control" placeholder=""/>
                            </div>
                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <label class="">Academic Degree <i class="iconFa fa fa-asterisk color-red"></i> </label>
                                <input type="text" required="required" class="form-control" placeholder=""/>
                            </div>
                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <label class="">Other Degrees</label>
                                <input type="text" required="required" class="form-control" placeholder=""/>
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                <label class="">Phone</label>
                                <input type="text" required="required" class="form-control" placeholder=""/>
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                <label class="">Email</label>
                                <input type="text" required="required" class="form-control" placeholder=""/>
                            </div>
                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <label class="">Currrent Address <i class="iconFa fa fa-asterisk color-red"></i> </label>
                                <textarea type="text" required="required" class="form-control" placeholder=""></textarea>
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                <label class="">District</label>
                                <input type="text" required="required" class="form-control" placeholder=""/>
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                <label class="">PostalCode</label>
                                <input type="text" required="required" class="form-control" placeholder=""/>
                            </div>
                            <div class="form-group  col-lg-4 col-md-4 col-sm-12">
                                <label class="control-label">Speciality <i class="iconFa fa fa-asterisk color-red"></i> </label>
                                <select type="text" required="required" class="form-control">
                                    <option value="">Select Speciality</option>
                                    <option value="General Practitioner">General Practitioner</option>
                                    <option value="Pediatric">Pediatric</option>
                                </select>
                            </div>
                            <div class="form-group  col-lg-12 col-md-12 col-sm-12">
                                <button class="col-md-2 btn btn-primary nextBtn m-0 d-table m-auto" type="button">
                                    Next <i class="fa fa-arrow-circle-right pull-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-primary setup-content" id="step-2">
                        <div class="panel-body documents">
                            <div class="form-group">
                                <label class="control-label">Degree/Certificate Documents <i class="iconFa fa fa-asterisk color-red"></i> </label>
                                <input type="file" required="required" class="form-control" placeholder="" />
                            </div>
                            <div class="form-group">
                                <label class="control-label">Profile Picture <i class="iconFa fa fa-asterisk color-red"></i> </label>
                                <input type="file" required="required" class="form-control" placeholder="" />
                            </div>
                            <div class="form-group">
                                <label class="control-label">Prescription Form <i class="iconFa fa fa-asterisk color-red"></i> </label>
                                <input type="file" required="required" class="form-control" placeholder="" />
                            </div>

                            <div class="form-group  col-lg-12 col-md-12 col-sm-12">
                                <button class="col-md-2 btn btn-primary nextBtn m-0 d-table m-auto" type="button">
                                    Next <i class="fa fa-arrow-circle-right pull-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-primary setup-content" id="step-3">
                        <div class="panel-body">
                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <label class="">Name on the Account</label>
                                <input type="text" required="required" class="form-control" placeholder=""/>
                            </div>
                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <label class="">Bank Name</label>
                                <input type="text" required="required" class="form-control" placeholder=""/>
                            </div>
                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <label class="">Bank Account Number</label>
                                <input type="text" required="required" class="form-control" placeholder=""/>
                            </div>
                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <label class="">Branch Name</label>
                                <input type="text" required="required" class="form-control" placeholder=""/>
                            </div><div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <label class="">Swift Code</label>
                                <input type="text" required="required" class="form-control" placeholder=""/>
                            </div>
                            {{-- <button class="btn btn-primary pull-right" type="submit">Submit</button> --}}
                            {{-- <div class="form-group  col-lg-12 col-md-12 col-sm-12">
                                <button class="col-md-2 btn btn-primary nextBtn m-0 d-table m-auto" type="submit">
                                    Next <i class="fa fa-arrow-circle-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                </form> --}}

                <form id="regForm" method="post" action="{{url('doctor/complete-profileAction')}}" enctype="multipart/form-data">
                    <!-- One "tab" for each step in the form: -->
                    @csrf
                    <input type="hidden" name="uid" value="{{$doctorInfo[0]['uid']}}"/>
                    <div class="tab">
                        <div class="tab-header">
                            <h5 class="m-0 m-auto d-table pb-10  ">Basic Information</h5>
                            <hr>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-4 col-md-4 col-sm-12">
                                <label class="control-label">NID <i class="iconFa fa fa-asterisk color-red"></i> </label>
                                <input name="nid" type="text" required="required" class="form-control" placeholder=""/>
                            </div>
                            <div class="dates form-group  col-lg-4 col-md-4 col-sm-12">
                                <label class="control-label">Date of Birth <i class="iconFa fa fa-asterisk color-red"></i> </label>
                                {{-- <input id="datepicker" type="text" required="required" class="form-control" placeholder=""/> --}}
                                <input name="dateOfBirth" type="date" class="form-control" id="usr1" name="event_date" placeholder="YYYY-MM-DD" autocomplete="off" >
                            </div>
                            <div class="form-group  col-lg-4 col-md-4 col-sm-12">
                                <label class="control-label">Gender <i class="iconFa fa fa-asterisk color-red"></i> </label>
                                <select name="gender" type="text" required="required" class="form-control">
                                    <option value="">Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                <label class="control-label">First Name <i class="iconFa fa fa-asterisk color-red"></i> </label>
                                <input  name="name" type="text" required="required" class="form-control" placeholder="" value="{{$doctorInfo[0]['name']}}"/>
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                <label  class="control-label">Last Name <i class="iconFa fa fa-asterisk color-red"></i> </label>
                                <input name="lastname" type="text" required="required" class="form-control" placeholder="" value="{{$doctorInfo[0]['lastname']}}"/>
                            </div>
                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <label class="control-label">BMDC Registration Number <i class="iconFa fa fa-asterisk color-red"></i> </label>
                                <input  name="regNo" type="text" required="required" class="form-control" placeholder=""/>
                            </div>
                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <label class="">Academic Degree <i class="iconFa fa fa-asterisk color-red"></i> </label>
                                <input name="acadeimcDegree" type="text" required="required" class="form-control" placeholder=""/>
                            </div>
                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <label class="">Other Degrees</label>
                                <input name="otherDegree" type="text" class="form-control" placeholder=""/>
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                <label class="">Phone</label>
                                <input name="phone" type="text" required="required" class="form-control" placeholder="" value="{{$doctorInfo[0]['phone']}}"/>
                            </div>

                            <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                <label class="">Email</label>
                                <input name="email" type="text" required="required" class="form-control" placeholder="" value="{{$doctorInfo[0]['email']}}"/>
                            </div>
                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <label class="">Currrent Address <i class="iconFa fa fa-asterisk color-red"></i> </label>
                                <textarea name="presentAddress" type="text" required="required" class="form-control" placeholder=""></textarea>
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                <label class="">District</label>

                                <select name="district" type="text" required="required" class="form-control" >
                                    <option value="">Select District</option>
                                    @foreach ($district as $key=>$item)
                                        <option value="{{$item['name']}}">{{$item['name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-sm-12">
                                <label class="">PostalCode</label>
                                <input name="postalCode" type="text" required="required" class="form-control" placeholder=""/>
                            </div>
                            <div class="form-group  col-lg-4 col-md-4 col-sm-12">
                                <label class="control-label">Speciality <i class="iconFa fa fa-asterisk color-red"></i> </label>
                                <select name="doctorType" type="text" required="required" class="form-control">
                                    <option value="">Select Speciality</option>
                                    <option value="General Practitioner">General Practitioner</option>
                                    <option value="Pediatric">Pediatric</option>
                                </select>
                            </div>
                            </div>
                        </div>
                    <div class="tab">
                        <div class="tab-header">
                            <h5 class="m-0 m-auto d-table">Upload Documents</h5>
                            <hr>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <label class="control-label">Degree/Certificate Documents <i class="iconFa fa fa-asterisk color-red"></i> </label>
                                <input name="degreeCertificate" type="file" required="required" class="form-control" placeholder="" />
                            </div>
                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <label class="control-label">Profile Picture <i class="iconFa fa fa-asterisk color-red"></i> </label>
                                <input name="profileImage" type="file" required="required" class="form-control" placeholder="" />
                            </div>
                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <label class="control-label">Prescription Form <i class="iconFa fa fa-asterisk color-red"></i> </label>
                                <input name="prescriptionForm" type="file" required="required" class="form-control" placeholder="" />
                            </div>

                        </div>
                    </div>
                    <div class="tab">
                        <div class="tab-header">
                            <h5 class="m-0 m-auto d-table  tab-header">Bank Information</h5>
                            <hr>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <label class="">Name on the Account</label>
                                <input name="accountName" type="text" required="required" class="form-control" placeholder=""/>
                            </div>
                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <label class="">Bank Name</label>
                                <input name="bankName" type="text" required="required" class="form-control" placeholder=""/>
                            </div>
                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <label class="">Bank Account Number</label>
                                <input name="accountNo" type="text" required="required" class="form-control" placeholder=""/>
                            </div>
                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <label class="">Branch Name</label>
                                <input name="branchName" type="text" required="required" class="form-control" placeholder=""/>
                            </div>
                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <label class="">Swift Code</label>
                                <input name="swiftCode" type="text" required="required" class="form-control" placeholder=""/>
                            </div>
                            {{-- <button class="btn btn-primary pull-right" type="submit">Submit</button> --}}
                            {{-- <div class="form-group  col-lg-12 col-md-12 col-sm-12">
                                <button class="col-md-2 btn btn-primary nextBtn m-0 d-table m-auto" type="submit">
                                    Next <i class="fa fa-arrow-circle-right"></i>
                                </button>
                            </div>--}}
                        </div>
                    </div>

                    <div style="overflow:auto;">
                      <div style="float:right;">
                        <button   class="btn-primary" type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                        <button  class="btn-primary"  type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
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
