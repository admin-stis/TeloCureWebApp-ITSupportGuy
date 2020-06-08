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
    <div class="container-fluid">

            <div class="row">
        <!-- Left col -->
                <section class="col-lg-12 connectedSortable">
     <div class="row profile">
		<div class="col-md-3">
			<div class="profile-sidebar">
				<!-- SIDEBAR USERPIC -->
				<div class="profile-userpic">
					@if (isset($doctorProfile['photoUrl']))
                        <img src="{{$doctorProfile['photoUrl']}}" alt="{{$doctorProfile['name']}}"/>
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
                        <button type="button" class="btn btn-primary btn-sm">Active</button>
                    @else
                        <button type="button" class="btn btn-primary btn-sm">Deactive</button>
                    @endif
					<button type="button" class="btn btn-danger btn-sm">Message</button>
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
            <div class="profile-content row">
               @php
                //    print_r($doctorProfile);
               @endphp
               <div class="well well-sm col-sm-12">
                    <label><i class="fa fa-bullseye"></i> Registration Number :</label>
                    {{$doctorProfile['regNo']}}</div>
               <div class="well well-sm col-sm-12">
                    <label><i  class="fa fa-user"></i> Name :</label>
                    {{$doctorProfile['name']}}
                </div>
               <div class="well well-sm col-sm-6">
                    <label><i  class="fa fa-birthday-cake"></i> Date of Birth :</label>
                   {{$doctorProfile['dateOfBirth']}}</div>
               <div class="well well-sm col-sm-6">
                <label><i  class="fa fa-male"></i> Gender :</label>{{$doctorProfile['gender']}}</div>
                <div class="well well-sm col-sm-6">
                    <label><i  class="fa fa-phone"></i> Phone :</label>
                    @if(isset($doctorProfile['phone']))
                        {{$doctorProfile['phone']}}
                    @else
                        <span>N/A</span>
                    @endif
                </div>
                <div class="well well-sm col-sm-6">
                    <label><i  class="fa fa-envelope"></i> Email :</label>
                    {{$doctorProfile['email']}}
                </div>
               <div class="well well-sm col-sm-12">
                <label><i  class="fa fa-map-marker"></i> Location :</label>{{$doctorProfile['district']}}</div>
                <div class="well well-sm col-sm-12">
                    <label><i  class="fa fa-clone"></i> Price :</label>
                    {{$doctorProfile['price']}}
                </div>
                <div class="well well-sm col-sm-12">
                    <label><i  class="fa fa-star"></i> Rating :</label>
                    {{$doctorProfile['totalRating']}}
                </div>
                <div class="well well-sm col-sm-12">
                    <label><i  class="fa fa-cube"></i> Total Count :</label>
                    {{$doctorProfile['totalCount']}}
                </div>
                <div class="well well-sm col-sm-12">
                    <label><i  class="fa fa-certificate"></i> Status :</label>
                    @if(isset($doctorProfile['approve']) == true) <span class="badge badge-success">Approved</span> @endif
                    @if(isset($doctorProfile['pending'])  == true) <span class="badge badge-pending">Pending</span> @endif
                    @if(isset($doctorProfile['reject'])  == true) <span class="badge badge-danger">Rejected</span> @endif
                </div>
            </div>
		</div>
    </div>
                </section>
            </div>
    </div>


@endsection
