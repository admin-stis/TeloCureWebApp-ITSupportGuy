@extends('hospital.layout')

@section('content')

@php
    //dd($doctorProfile);
@endphp

<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark" style="float:left;">Doctor</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('hospital')}}">Hospital</a></li>
            @php
                if(isset($doctorProfile[0]['uid']))
                $uid = trim($doctorProfile[0]['uid']);
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
					@if (isset($doctorProfile[0]['photoUrl']) && $doctorProfile[0]['photoUrl'] != '')
                        <img style="width:100px;height:100px;" src="{{$doctorProfile[0]['photoUrl']}}" alt="{{$doctorProfile[0]['name']}}"/>
                    @else
                        <span class="userIcon fa fa-user-circle" style="margin:0 auto;display: table;font-size:8em;"></span>
                    @endif
                </div>

				<!-- END SIDEBAR USERPIC -->
				<!-- SIDEBAR USER TITLE -->
				<div class="profile-usertitle">
					<div class="profile-usertitle-name">
                        @if($doctorProfile[0]['online'] == 1)
                            <div class="alert alert-success alert-sm">
                                {{$doctorProfile[0]['name']}}
                                <div><small>Online</small></div>
                            </div>
                        @else
                            <div class="alert alert-danger alert-sm">
                                {{$doctorProfile[0]['name']}}
                                <div><small>Offline</small></div>
                            </div>
                        @endif
					</div>
					<div class="profile-usertitle-job">
					    @if(isset($doctorProfile[0]['doctorType']))
                            {{$doctorProfile[0]['doctorType']}}
                        @endif
					</div>
				</div>

                
				<!-- END SIDEBAR USER TITLE -->
				<!-- SIDEBAR BUTTONS -->
				{{--
                <div class="profile-userbuttons">
                    @if (isset($doctorProfile[0]['active']) && $doctorProfile[0]['active'] == 'true')
                        <a class="btn btn-primary btn-sm" href="{{url('admin/deactiveDoctor/'.$uid)}}">Active</a>
                    @else
                        <a class="btn btn-danger btn-sm" href="{{url('admin/activeDoctor/'.$uid)}}">Deactive</a>
                    @endif
					<button type="button" class="btn btn-danger btn-sm">Message</button>
                </div>
                --}}

                <div class="">
                    <p style="margin:0 auto;display:table">Rating :
                    @php
                        if(isset($doctorProfile[0]['totalRating']) && isset($doctorProfile[0]['totalCount']) && $doctorProfile[0]['totalCount'] > 0)
                        {
                            $totalRating = $doctorProfile[0]['totalRating'];
                            $totalCount = $doctorProfile[0]['totalCount'];
                            $rating = round(($totalRating/$totalCount),1);
                            echo $rating.'</p>' ;
                        }
                        else {
                            $rating = 5 ;
                            echo $rating.'</p>';
                        }
                    @endphp
                </div>
                <div class="">
                    @if(isset($doctorProfile[0]['price']))
                    <p style="margin:0 auto;display:table">Price : {{$doctorProfile[0]['price']}} Tk</p>
                    @else
                    <p style="margin:0 auto;display:table">Price : 0 Tk</p>
                    @endif
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
                            <li class="col-md-3 btn btn-xs btn-default"><a class="btn btn-xs btn-default" data-toggle="pill" href="#bankInfo">Bank</a></li>
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
                                        @if(isset($doctorProfile[0]['regNo'])) {{$doctorProfile[0]['regNo']}} @else N/A @endif
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
                                    <span class="col-md-5">{{$doctorProfile[0]['name']}}</span>
                                </div>
                                <div class="row col-md-12">
                                    <label class="col-md-5">
                                        <h6>Date of Birth</h6>
                                    </label>
                                    <span class="col-md-1"> : </span>
                                    <span class="col-md-5">
                                        @if(isset($doctorProfile[0]['dateOfBirth']))
                                            {{$doctorProfile[0]['dateOfBirth']}}
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
                                        @if(isset($doctorProfile[0]['gender']))
                                            {{$doctorProfile[0]['gender']}}
                                        @else
                                            N/A
                                        @endif
                                    </span>
                                </div>

                                {{--
                                @if(isset($others[0]['regNo']))
                                <div class="row col-md-12">
                                    <label class="col-md-5">
                                        <h6>Hsopital Name</h6>
                                    </label>
                                    <span class="col-md-1"> : </span>
                                    <span class="col-md-5">
                                        {{$others[0]['regNo']}}
                                    </span>
                                </div>
                                @endif
                                --}}

                            </div>
                        </div>
                        <div id="contact" class="tab-pane fade">
                            <div class="" style="margin-top:10px;">
                                <div class="row col-md-12">
                                    <label class="col-md-5">
                                        <h6>Email</h6>
                                    </label>
                                    <span class="col-md-1"> : </span>
                                    <span class="col-md-5">{{$doctorProfile[0]['email']}}</span>
                                </div>
                                <div class="row col-md-12">
                                    <label class="col-md-5">
                                        <h6>Phone</h6>
                                    </label>
                                    <span class="col-md-1"> : </span>
                                    <span class="col-md-5">{{$doctorProfile[0]['phone']}}</span>
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
                                        @if(isset($doctorProfile[0]['district'])){{$doctorProfile[0]['district']}}
                                        @else N/A
                                        @endif
                                    </span>
                                </div>
                                <div class="row col-md-12">
                                    <label class="col-md-5">
                                        <h6>Postal Code</h6>
                                    </label>
                                    <span class="col-md-1"> : </span>
                                    <span class="col-md-5">@if(isset($doctorProfile[0]['postalCode'])){{$doctorProfile[0]['postalCode']}}
                                    @else N/A
                                    @endif</span>
                                </div>
                            </div>
                        </div>

                        <div id="h" class="tab-pane fade">
                            <div class="" style="margin-top:10px;">
                                <div class="row col-md-12">
                                    @php //dd($hinfo); @endphp
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
                                        @if(isset($documents['prescriptionForm']))
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
                        @php //dd($bank_info['accountName']) @endphp
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
