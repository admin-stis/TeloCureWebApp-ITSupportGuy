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
            <li class="breadcrumb-item"><a href="{{url('admin/doctor')}}">Doctor Dashboard</a></li>
            @php
                $uid = trim($doctorProfile['uid']);
            @endphp
            <li class="breadcrumb-item active"><a href="{{url('admin/doctor/'.$uid)}}">Profile</a></li>
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
                        <img src="{{$doctorProfile['photoUrl']}}" alt="{{$doctorProfile['name']}}"/>
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
					    {{$doctorProfile['doctorType']}}
					</div>
				</div>
				<!-- END SIDEBAR USER TITLE -->
				<!-- SIDEBAR BUTTONS -->
				<div class="profile-userbuttons">
                    @if (isset($doctorProfile['active']) && $doctorProfile['active'] == 1)
                        <a class="btn btn-primary btn-sm" href="{{url('admin/deactiveDoctor/'.$uid)}}">Active</a>
                    @else
                        <a class="btn btn-danger btn-sm" href="{{url('admin/activeDoctor/'.$uid)}}">Deactive</a>
                    @endif
					{{-- <button type="button" class="btn btn-danger btn-sm">Message</button> --}}
                </div>
                <div class="">
                    <p style="margin:0 auto;display:table">Rating : N/A<p>
                    @php
                        if(isset($doctorProfile['totalRating']) && isset($doctorProfile['totalCount']) && $doctorProfile['totalCount'] > 0)
                        {
                            $totalRating = $doctorProfile['totalRating'];
                            $totalCount = $doctorProfile['totalCount'];
                            $rating = round(($totalRating/$totalCount),1);
                            echo $rating;
                        }else{
                            $rating = 5;
                            echo $rating;
                        }
                    @endphp
                </div>
                <div class="">
                    @if(isset($doctorProfile['price']))
                    <p style="margin:0 auto;display:table">Price : {{$doctorProfile['price']}} Tk</p>
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
                            <li class="col-md-3 btn btn-xs btn-default active"><a class="btn btn-xs btn-default active" data-toggle="pill" href="#basic">Basic</a></li>
                            <li class="col-md-3 btn btn-xs btn-default"><a class="btn btn-xs btn-default" data-toggle="pill" href="#contact">Contact</a></li>
                            <li class="col-md-3 btn btn-xs btn-default"><a class="btn btn-xs btn-default" data-toggle="pill" href="#documents">Document</a></li>
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
                                    <span class="col-md-5">@if(isset($doctorProfile['nid'])) {{$doctorProfile['nid']}} @else N/A @endif</span>
                                </div>
                                <div class="row col-md-12">
                                    <label class="col-md-5">
                                        <h6>First Name</h6>
                                    </label>
                                    <span class="col-md-1"> : </span>
                                    <span class="col-md-5">{{$doctorProfile['name']}}</span>
                                </div>
                                <div class="row col-md-12">
                                    <label class="col-md-5">
                                        <h6>Last Name</h6>
                                    </label>
                                    <span class="col-md-1"> : </span>
                                    <span class="col-md-5">{{$doctorProfile['lastname']}}</span>
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
                                    <span class="col-md-5">{{$doctorProfile['gender']}}</span>
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
                                <div class="row col-md-12">
                                    <label class="col-md-5">
                                        <h6>Present Address</h6>
                                    </label>
                                    <span class="col-md-1"> : </span>
                                    <span class="col-md-5">{{$doctorProfile['presentAddress']}}</span>
                                </div>
                                <div class="row col-md-12">
                                    <label class="col-md-5">
                                        <h6>District</h6>
                                    </label>
                                    <span class="col-md-1"> : </span>
                                    <span class="col-md-5">{{$doctorProfile['district']}}</span>
                                </div>
                                <div class="row col-md-12">
                                    <label class="col-md-5">
                                        <h6>Postal Code</h6>
                                    </label>
                                    <span class="col-md-1"> : </span>
                                    <span class="col-md-5">{{$doctorProfile['postalCode']}}</span>
                                </div>
                            </div>
                        </div>
                        <div id="documents" class="tab-pane fade">
                            <div class="" style="margin-top:10px;">
                                <p>
                                    Contents are coming soon......
                                </p>
                            </div>
                        </div>
                        <div id="bankInfo" class="tab-pane fade">
                            <div class="" style="margin-top:10px;">
                                <div class="row col-md-12">
                                    <label class="col-md-5">
                                        <h6>Account Name</h6>
                                    </label>
                                    <span class="col-md-1"> : </span>
                                    <span class="col-md-5">{{$doctorProfile['accountName']}}</span>
                                </div>
                                <div class="row col-md-12">
                                    <label class="col-md-5">
                                        <h6>Bank Name</h6>
                                    </label>
                                    <span class="col-md-1"> : </span>
                                    <span class="col-md-5">{{$doctorProfile['bankName']}}</span>
                                </div>
                                <div class="row col-md-12">
                                    <label class="col-md-5">
                                        <h6>Branch</h6>
                                    </label>
                                    <span class="col-md-1"> : </span>
                                    <span class="col-md-5">{{$doctorProfile['branchName']}}</span>
                                </div>
                                <div class="row col-md-12">
                                    <label class="col-md-5">
                                        <h6>Swift Code</h6>
                                    </label>
                                    <span class="col-md-1"> : </span>
                                    <span class="col-md-5">{{$doctorProfile['swiftCode']}}</span>
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
