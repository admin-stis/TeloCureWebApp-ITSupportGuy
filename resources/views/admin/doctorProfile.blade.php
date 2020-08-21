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
                if(isset($doctorProfile['uid']))
                $uid = trim($doctorProfile['uid']);
            @endphp
            <li class="breadcrumb-item active">Profile</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>

  <section class="content">


    <div class="row col-md-12">
        <div class="col-md-3">
			<div class="profile-sidebar">
				<!-- SIDEBAR USERPIC -->
				<div class="profile-userpic">
					@if (isset($doctorProfile['photoUrl']))
                        <img style="width:100px;height:100px;" src="{{$doctorProfile['photoUrl']}}" alt="{{$doctorProfile['name']}}"/>
                    @else
                        <span class="userIcon fa fa-user-circle"></span>
                    @endif
                </div>
				<!-- END SIDEBAR USERPIC -->
				<!-- SIDEBAR USER TITLE -->
				<div class="profile-usertitle">
					<div class="profile-usertitle-name">
                        @if($doctorProfile['online'] == 1)
                            <div class="alert alert-success alert-sm">
                                {{$doctorProfile['name']}}
                                <div><small>Online</small></div>
                            </div>
                        @else
                            <div class="alert alert-danger alert-sm">
                                {{$doctorProfile['name']}}
                                <div><small>Offline</small></div>
                            </div>
                        @endif
					</div>
					<div class="profile-usertitle-job">
					    @if(isset($doctorProfile['doctorType']))
                            {{$doctorProfile['doctorType']}}
                        @endif
					</div>
				</div>
				<!-- END SIDEBAR USER TITLE -->
				<!-- SIDEBAR BUTTONS -->
				{{--
                <div class="profile-userbuttons">
                    @if (isset($doctorProfile['active']) && $doctorProfile['active'] == 1)
                        <a class="btn btn-primary btn-sm" href="{{url('admin/deactiveDoctor/'.$uid)}}">Active</a>
                    @else
                        <a class="btn btn-danger btn-sm" href="{{url('admin/activeDoctor/'.$uid)}}">Deactive</a>
                    @endif
					<button type="button" class="btn btn-danger btn-sm">Message</button>
                </div>
                --}}

                <div class="margin:0 auto;display:table">
                    <p style="margin:0 auto;display:table">Rating <p>
                    <p style="margin:0 auto;display:table">
                    @php
                        if(isset($doctorProfile['totalRating']) && isset($doctorProfile['totalCount']) && $doctorProfile['totalCount'] > 0)
                        {
                            $totalRating = $doctorProfile['totalRating'];
                            $totalCount = $doctorProfile['totalCount'];
                            $rating = round(($totalRating/$totalCount),1);
                            echo $rating;
                        }
                        else {
                            $rating = 5 ;
                            echo $rating;
                        }
                    @endphp
                    </p>
                </div>
                <div class="">
                    @if(isset($doctorProfile['price']))
                    <p style="margin:0 auto;display:table">Price : {{$doctorProfile['price']}} Tk</p>
                    @else
                    <p style="margin:0 auto;display:table">Price : 0 Tk</p>
                    @endif
                    <p style="margin:0 auto;display:table"><a class="btn btn-sm btn-primary" href="{{url('admin/dprofileEdit/'.$uid)}}">Edit</a>
                    </p>
                </div>
				<!-- END SIDEBAR BUTTONS -->
				<!-- SIDEBAR MENU -->
				{{-- <div class="profile-usermenu">
					<ul class="nav">
						<li class="active">
							<a href="#">
							<i class="glyphicon glyphicon-home"></i>
							Overview </a>
						</li>
						<li>
							<a href="#">
							<i class="glyphicon glyphicon-user"></i>
							Account Settings </a>
						</li>
						<li>
							<a href="#" target="_blank">
							<i class="glyphicon glyphicon-ok"></i>
							Tasks </a>
						</li>
						<li>
							<a href="#">
							<i class="glyphicon glyphicon-flag"></i>
							Help </a>
						</li>
					</ul>
				</div> --}}
				<!-- END MENU -->
			</div>
		</div>
        <div class="col-md-9">
            <div class="card" style="min-height: 460px;">
                <div class="card-body">

                    <div class="">
                        <ul class="pro nav nav-pills">
                            <li class="col-md-2 btn btn-xs btn-default active"><a class="btn btn-xs btn-default active" data-toggle="pill" href="#basic">Basic</a></li>
                            <li class="col-md-2 btn btn-xs btn-default"><a class="btn btn-xs btn-default" data-toggle="pill" href="#contact">Contact</a></li>

                            <li class="col-md-3 btn btn-xs btn-default"><a class="btn btn-xs btn-default" data-toggle="pill" href="#h">Hospital</a></li>

                            <li class="col-md-2 btn btn-xs btn-default"><a class="btn btn-xs btn-default" data-toggle="pill" href="#documents">Document</a></li>
                            <li class="col-md-3 btn btn-xs btn-default"><a class="btn btn-xs btn-default" data-toggle="pill" href="#bankInfo">Bank Information</a></li>
                        </ul>
                    </div>

                    <div class="tab-content">
                        <div id="basic" class="tab-pane fade show active">
                            <div class="" style="margin-top:10px;">
                                <div class="row col-md-12">
                                    <label class="col-md-5">
                                        <h6>Registration No.</h6>
                                    </label>
                                    <span class="col-md-1"> : </span>
                                    <span class="col-md-5">
                                        @if(isset($doctorProfile['regNo'])) {{$doctorProfile['regNo']}} @else N/A @endif
                                    </span>
                                </div>
                                <div class="row col-md-12">
                                    <label class="col-md-5">
                                        <h6>NID</h6>
                                    </label>
                                    <span class="col-md-1"> : </span>
                                    <span class="col-md-5">
                                    @if(isset($others['nid']))
                                        {{$others['nid']}}
                                    @else N/A
                                    @endif</span>
                                </div>
                                <div class="row col-md-12">
                                    <label class="col-md-5">
                                        <h6>Name</h6>
                                    </label>
                                    <span class="col-md-1"> : </span>
                                    <span class="col-md-5">{{$doctorProfile['name']}}</span>
                                </div>
                                <div class="row col-md-12">
                                    <label class="col-md-5">
                                        <h6>Date of Birth</h6>
                                    </label>
                                    <span class="col-md-1"> : </span>
                                    <span class="col-md-5">
                                        @if(isset($doctorProfile['dateOfBirth']))
                                            {{$doctorProfile['dateOfBirth']}}
                                        @else N/A
                                        @endif
                                    </span>
                                </div>
                                <div class="row col-md-12">
                                    <label class="col-md-5">
                                        <h6>Gender</h6>
                                    </label>
                                    <span class="col-md-1"> : </span>
                                    <span class="col-md-5">
                                        @if(isset($doctorProfile['gender']))
                                            {{$doctorProfile['gender']}}
                                        @else
                                            N/A
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div id="contact" class="tab-pane fade">
                            <div class="" style="margin-top:10px;">
                                <div class="row col-md-12">
                                    <label class="col-md-5">
                                        <h6>Email</h6>
                                    </label>
                                    <span class="col-md-1"> : </span>
                                    <span class="col-md-5">{{$doctorProfile['email']}}</span>
                                </div>
                                <div class="row col-md-12">
                                    <label class="col-md-5">
                                        <h6>Phone</h6>
                                    </label>
                                    <span class="col-md-1"> : </span>
                                    <span class="col-md-5">{{$doctorProfile['phone']}}</span>
                                </div>
                                @if(isset($others['presentAddress']))
                                <div class="row col-md-12">
                                    <label class="col-md-5">
                                        <h6>Present Address</h6>
                                    </label>
                                    <span class="col-md-1"> : </span>
                                    <span class="col-md-5">@if(isset($others['presentAddress'])) {{$others['presentAddress']}}@endif</span>
                                </div>
                                @endif
                                <div class="row col-md-12">
                                    <label class="col-md-5">
                                        <h6>District</h6>
                                    </label>
                                    <span class="col-md-1"> : </span>
                                    <span class="col-md-5">
                                        @if(isset($doctorProfile['district'])){{$doctorProfile['district']}}
                                        @else N/A
                                        @endif
                                    </span>
                                </div>
                                <div class="row col-md-12">
                                    <label class="col-md-5">
                                        <h6>Postal Code</h6>
                                    </label>
                                    <span class="col-md-1"> : </span>
                                    <span class="col-md-5">@if(isset($doctorProfile['districtId'])){{$doctorProfile['districtId']}}
                                    @else N/A
                                    @endif</span>
                                </div>
                            </div>
                        </div>
@php //dd($hinfo); @endphp
                        <div id="h" class="tab-pane fade">
                            @if(isset($hinfo[0]['hospitalName']))
                            <div class="" style="margin-top:10px;">
                                <div class="row col-md-12">
                                    
                                    <label class="col-md-5">
                                        <h6>Hospital</h6>
                                    </label>
                                    <span class="col-md-1"> : </span>
                                    <span class="col-md-5">
                                        @if(isset($hinfo[0]['hospitalName']))
                                            {{$hinfo[0]['hospitalName']}}
                                        @else
                                            N/A
                                        @endif
                                    </span>
                                </div>
                                <div class="row col-md-12">
                                    <label class="col-md-5">
                                        <h6>Branch</h6>
                                    </label>
                                    <span class="col-md-1"> : </span>
                                    <span class="col-md-5">
                                        @if(isset($hinfo[0]['branch']))
                                            {{$hinfo[0]['branch']}}
                                        @else
                                            Main Branch
                                        @endif
                                    </span>
                                </div>
                                <div class="row col-md-12">
                                    <label class="col-md-5">
                                        <h6>Address</h6>
                                    </label>
                                    <span class="col-md-1"> : </span>
                                    <span class="col-md-5">
                                        @if(isset($hinfo[0]['address']))
                                            {{$hinfo[0]['address']}}
                                        @elseif(isset($hinfo[0]['hospitalAddress']))
                                            {{$hinfo[0]['hospitalAddress']}}
                                        @endif
                                    </span>
                                </div>
                            </div>
                            @else
                            <div class="" style="margin-top:10px;"><p class="text-center">Independent Doctor</p></div>
                            @endif
                        </div>

                        <div id="documents" class="tab-pane fade">
                            <div class="" style="margin-top:10px;">
                                <div class="row col-md-12">
                                    <label class="col-md-5">
                                        <h6>Degree Certificate</h6>
                                    </label>
                                    <span class="col-md-1"> : </span>
                                    <span class="col-md-5">
                                        @if(isset($documents['academicCertificate']))<a href="{{$documents['academicCertificate']}}">Click to download</a>
                                        @else
                                            N/A
                                        @endif

                                    </span>
                                </div>
                                <div class="row col-md-12">
                                    <label class="col-md-5">
                                        <h6>Prescription From</h6>
                                    </label>
                                    <span class="col-md-1"> : </span>
                                    <span class="col-md-5">
                                        @if(isset($documents['prescriptionForm'])  && !empty($documents['prescriptionForm']))
                                            
                                        @php // dd($documents['prescriptionForm']); @endphp
                                            <a href="{{$documents['prescriptionForm']}}">Click to download</a>
                                        @else
                                            N/A
                                        @endif
                                    </span>
                                </div>
                                <div class="row col-md-12">
                                    <label class="col-md-5">
                                        <h6>NID Front</h6>
                                    </label>
                                    <span class="col-md-1"> : </span>
                                    <span class="col-md-5">
                                        @if(isset($documents['nidFront']))
                                            <a href="{{$documents['nidFront']}}">Click to download</a>
                                        @else
                                            N/A
                                        @endif
                                    </span>
                                </div>
                                <div class="row col-md-12">
                                    <label class="col-md-5">
                                        <h6>NID Back</h6>
                                    </label>
                                    <span class="col-md-1"> : </span>
                                    <span class="col-md-5">
                                        @if(isset($documents['nidBack']))
                                            <a href="{{$documents['nidBack']}}">Click to download</a>
                                        @else
                                            N/A
                                        @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div id="bankInfo" class="tab-pane fade">
                            <div class="" style="margin-top:10px;">
                                <div class="row col-md-12">
                                    <label class="col-md-5">
                                        <h6>Account Name</h6>
                                    </label>
                                    <span class="col-md-1"> : </span>
                                    <span class="col-md-5">
                                        @if(isset($bank_info['accountName'])){{$bank_info['accountName']}}
                                        @else N/A
                                        @endif
                                    </span>
                                </div>
                                @if(isset($doctorProfile['hospitalized']) && $doctorProfile['hospitalized'] == false )
                                <div class="row col-md-12">
                                    <label class="col-md-5">
                                        <h6>Account No</h6>
                                    </label>
                                    <span class="col-md-1"> : </span>
                                    <span class="col-md-5">
                                        @php
                                            if(isset($bank_info['accountNumber'])){
                                                $accountNumber = $bank_info['accountNumber'] ;
                                                $len = strlen($accountNumber) ;
                                                $ac = substr($accountNumber,-4) ;
                                                $star = '';
                                                $stringLength = $len - strlen($ac) ;
                                                for($i = 0; $i < $stringLength ; $i++){
                                                    $star .= '<span class="fa fa-star"></span>';
                                                }
                                                $account = $star.' '.$ac ;
                                                echo $account ;
                                            }else{
                                                echo 'N/A';
                                            }
                                        @endphp
                                    </span>
                                </div>
                                @endif

                                <div class="row col-md-12">
                                    <label class="col-md-5">
                                        <h6>Bank Name</h6>
                                    </label>
                                    <span class="col-md-1"> : </span>
                                    <span class="col-md-5">@if(isset($bank_info['bankName'])){{$bank_info['bankName']}}
                                    @else N/A
                                    @endif
                                </span>
                                </div>
                                {{--<div class="row col-md-12">
                                    <label class="col-md-5">
                                        <h6>Branch</h6>
                                    </label>
                                    <span class="col-md-1"> : </span>
                                    <span class="col-md-5">
                                        @if(isset($bank_info['branch']))
                                            {{$bank_info['branch']}}
                                        @else N/A
                                        @endif
                                    </span>
                                </div>--}}
                                <div class="row col-md-12">
                                    <label class="col-md-5">
                                        <h6>Swift Code/Routing Number</h6>
                                    </label>
                                    <span class="col-md-1"> : </span>
                                    <span class="col-md-5">
                                        @if(isset($bank_info['swiftCode']))
                                        {{$bank_info['swiftCode']}}
                                    @else N/A
                                    @endif</span>
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
