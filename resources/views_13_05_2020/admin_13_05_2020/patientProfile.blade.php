@extends('admin.layout')

@section('content')


<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Patient</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('admin/patient')}}">Patient Dashboard</a></li>
            @php
                $uid = trim($userProfile['uid']);
            @endphp
            <li class="breadcrumb-item active"><a href="{{url('admin/patient/'.$uid)}}">Profile</a></li>
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
					@if (isset($userProfile['photoUrl']))
                        <img src="{{$userProfile['photoUrl']}}" alt="{{$userProfile['name']}}"/>
                    @endif
                </div>
				<!-- END SIDEBAR USERPIC -->
				<!-- SIDEBAR USER TITLE -->
				<div class="profile-usertitle">
					<div class="profile-usertitle-name">
                        @if($userProfile['online'] == 1)
                            <div class="alert alert-success alert-sm">
                                {{$userProfile['name']}}
                                <div><small>Online</small></div>
                            </div>
                        @else
                            <div class="alert alert-danger alert-sm">
                                {{$userProfile['name']}}
                                <div><small>Offline</small></div>
                            </div>
                        @endif
					</div>
					{{-- <div class="profile-usertitle-job">
					    {{$userProfile['doctorType']}}
					</div> --}}
				</div>
				<!-- END SIDEBAR USER TITLE -->
				<!-- SIDEBAR BUTTONS -->
				<div class="profile-userbuttons">
                    @if (isset($userProfile['active']) && $userProfile['active'] == 1)
                        <a type="button" class="btn btn-success btn-sm" href="{{url('admin/activeUser/'.$userProfile['uid'])}}">Active</a>
                    @else
                        <a href="{{url('admin/activeUser/'.$userProfile['uid'])}}" type="button" class="btn btn-primary btn-sm">Deactive</a>
                    @endif
					{{-- <button type="button" class="btn btn-danger btn-sm">Message</button> --}}
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
                //    print_r($userProfile);
               @endphp
               {{-- <div class="well well-sm col-sm-12">
                    <label><i class="fa fa-bullseye"></i> Registration Number :</label>
                    {{$userProfile['regNo']}}</div> --}}
               <div class="well well-sm col-sm-6 row">
                    <label class="col-md-6"><i  class="fa fa-user"></i> Name :</label>
                    <span class="col-md-6">{{$userProfile['name']}}</span>
                </div>
                <div class="well well-sm col-sm-6 row">
                    <label class="col-md-6"><i  class="fa fa-male"></i> Gender :</label>
                    <span class="col-md-6">
                        @if(isset($userProfile['gender'])){{$userProfile['gender']}}
                        @else N/A
                        @endif
                    </span>
                </div>
                <hr>
               <div class="well well-sm col-sm-6 row">
                    <label class="col-md-6"><i  class="fa fa-birthday-cake"></i> Date of Birth :</label>
                    <span class="col-md-6">
                        @if(isset($userProfile['dateOfBirth'])) {{$userProfile['dateOfBirth']}}
                        @else N/A
                        @endif
                    </span>
                </div>
                <div class="well well-sm col-sm-6 row">
                <label class="col-md-6"><i  class="fa fa-tint"></i> Blood Group :</label>
                 <span class="col-md-6">
                     @if(isset($userProfile['bloodGroup'])) {{$userProfile['bloodGroup']}}  @else N/A @endif
                 </span>
                    </div>
                    <hr>
                 <div class="well well-sm col-sm-6 row">
                    <label class="col-md-6"><i  class="fa fa-balance-scale"></i> Weight :</label>
                  <span class="col-md-6">
                      @if(isset($userProfile['weight'])) {{$userProfile['weight']}} KG  @else N/A @endif
                    </span>
                </div>
                  <div class="well well-sm col-sm-6 row">
                    <label class="col-md-6"><i  class="fa fa-arrow-up"></i> Height :</label>
                   <span class="col-md-6">
                       @if(isset($userProfile['height'])) {{$userProfile['height']}}  @else N/A @endif
                   </span>
                </div>
                <hr>
                <div class="well well-sm col-sm-6 row">
                    <label class="col-md-6"><i  class="fa fa-phone"></i> Phone :</label>
                    <span class="col-md-6">
                    @if(isset($userProfile['phone']))
                        {{$userProfile['phone']}}
                    @else
                        <span>N/A</span>
                    @endif
                    </span>
                </div>
                <div class="well well-sm col-sm-6 row">
                    <label class="col-md-6"><i  class="fa fa-envelope"></i> Email :</label>
                    <span class="col-md-6">
                    @if(isset($userProfile['email'])) {{$userProfile['email']}}  @else N/A @endif
                    </span>
                </div>
                <hr>
               <div class="well well-sm col-sm-12 row">
                <label class="col-md-3"><i  class="fa fa-map-marker"></i> Location :</label>
                <span class="col-md-3">
                @if(isset($userProfile['district'])) {{$userProfile['district']}}  @else N/A @endif
                </span>
                </div>
                {{-- <div class="well well-sm col-sm-12">
                    <label><i  class="fa fa-clone"></i> Price :</label>
                    {{$userProfile['price']}}
                </div>
                <div class="well well-sm col-sm-12">
                    <label><i  class="fa fa-star"></i> Rating :</label>
                    {{$userProfile['totalRating']}}
                </div>--}}
                {{-- <div class="well well-sm col-sm-12">
                    <label><i  class="fa fa-cube"></i> Total Count :</label>
                    {{$userProfile['totalCount']}}
                </div> --}}
                {{-- <div class="well well-sm col-sm-12">
                    <label><i  class="fa fa-certificate"></i> Status :</label>
                    @if(isset($userProfile['approve']) == true) <span class="badge badge-success">Approved</span> @endif
                    @if(isset($userProfile['pending'])  == true) <span class="badge badge-pending">Pending</span> @endif
                    @if(isset($userProfile['reject'])  == true) <span class="badge badge-danger">Rejected</span> @endif
                </div> --}}
            </div>
		</div>
    </div>
                </section>
            </div>
    </div>


@endsection
