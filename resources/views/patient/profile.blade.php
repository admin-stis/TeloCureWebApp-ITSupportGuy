@extends('patient.layout')

@section('content')

<style>
  .profile{
    margin-bottom: 20px;
    padding-top:20px
  }
  .profile-userpic img{
      width: 100px;
      height: 100px;
      margin: 0 auto;
      display: table;
      border-radius: 50px;
      margin-bottom: 20px;
  }

  .profile-userbuttons{
    margin: 0 auto;
    display: table;
  }

  .profile-content{
    background: #fff;
  }

</style>

@php
    //dd($userProfile[uid]);
@endphp


<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Patient</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('/patient')}}">Home</a></li>
            @php
                $uid = trim($userProfile[0]['uid']);
            @endphp
            <li class="breadcrumb-item active">Profile</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>

  <section class="content">
    <div class="container-fluid">

            <div class="row">
        <!-- Left col -->
                <section class="col-lg-12 connectedSortable" style="min-height:500px;background:#fff;">
     <div class="row profile">
    <div class="col-md-3"     style="background: #fff;padding-top: 15px;">
      <div class="profile-sidebar">
        <!-- SIDEBAR USERPIC -->
        <div class="profile-userpic">
            @if (isset($userProfile[0]['photoUrl']))
                <img src="{{$userProfile[0]['photoUrl']}}" alt="{{$userProfile[0]['name']}}"/>
            @else
                <i class="fa fa-user-o"></i>
            @endif
        </div>
        <!-- END SIDEBAR USERPIC -->
        <!-- SIDEBAR USER TITLE -->
        <div class="profile-usertitle">
          <div class="profile-usertitle-name">
                        @if($userProfile[0]['online'] == 1)
                            <div class="alert alert-success alert-sm text-center">
                                {{$userProfile[0]['name']}}
                                <div><small>Online</small></div>
                            </div>
                        @else
                            <div class="alert alert-danger alert-sm text-center">
                                {{$userProfile[0]['name']}}
                                <div><small>Offline</small></div>
                            </div>
                        @endif
          </div>
          {{-- <div class="profile-usertitle-job">
              {{$userProfile ['doctorType']}}
          </div> --}}
        </div>
        <!-- END SIDEBAR USER TITLE -->
        <!-- SIDEBAR BUTTONS -->
        <div class="profile-userbuttons">
                    @if (isset($userProfile[0]['active']) && $userProfile[0]['active'] == 'true')
                        <button type="button" class="btn btn-primary btn-sm">Active</button>
                    @else
                        <button type="button" class="btn btn-primary btn-sm">Deactive</button>
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
            <div class="profile-content row">

            {{-- <div class="well well-sm col-sm-12">
                    <label><i class="fa fa-bullseye"></i> Registration Number :</label>
                    {{$userProfile ['regNo']}}</div> --}}
               <div class="well well-sm col-sm-12">
                    <label><i  class="fa fa-user"></i> Name :</label>
                    {{$userProfile[0]['name']}}                 </div>
               <div class="well well-sm col-sm-12">
                   <label><i  class="fa fa-birthday-cake"></i> Date of Birth :</label>
                   @if(isset($userProfile[0]['dateOfBirth'])){{$userProfile[0]['dateOfBirth']}}@endif</div>
                <div class="well well-sm col-sm-12">
                    <label><i  class="fa fa-male"></i> Gender :</label>
                    @if(isset($userProfile[0]['gender'])){{$userProfile[0]['gender']}}@endif
                </div>
                <div class="well well-sm col-sm-12">
                 <label><i  class="fa fa-tint"></i> Blood Group :</label>
                 @if(isset($userProfile[0]['bloodGroup'])){{$userProfile[0]['bloodGroup']}}@endif</div>
                 <div class="well well-sm col-sm-12">
                  <label><i  class="fa fa-balance-scale"></i> Weight :</label>
                  @if(isset($userProfile[0]['weight'])){{$userProfile[0]['weight']}} KG @endif</div>
                  <div class="well well-sm col-sm-12">
                   <label><i  class="fa fa-arrow-up"></i> Height :</label>@if(isset($userProfile [0]['height'])){{$userProfile[0]['height']}}@endif</div>

                <div class="well well-sm col-sm-12">
                    <label><i  class="fa fa-phone"></i> Phone :</label>
                    @if(isset($userProfile[0]['phone']))
                        {{$userProfile[0]['phone']}}
                    @else
                        <span>N/A</span>
                    @endif
                </div>
                <div class="well well-sm col-sm-12">
                    <label><i  class="fa fa-envelope"></i> Email :</label>
                    @if(isset($userProfile[0]['email'])){{$userProfile[0]['email']}}@endif
                </div>
               <div class="well well-sm col-sm-12">
                <label><i  class="fa fa-map-marker"></i> Location :</label>@if(isset($userProfile [0]['district'])){{$userProfile[0]['district']}}@endif</div>
                {{-- <div class="well well-sm col-sm-12">
                    <label><i  class="fa fa-clone"></i> Price :</label>
                    {{$userProfile[0]['price']}}
                </div>
                <div class="well well-sm col-sm-12">
                    <label><i  class="fa fa-star"></i> Rating :</label>
                    {{$userProfile[0]['totalRating']}}
                </div>--}}
                <div class="well well-sm col-sm-12">
                    <label><i  class="fa fa-cube"></i> Total Count :</label>
                    @if(isset($userProfile[0]['totalCount'])){{$userProfile[0]['totalCount']}}@endif
                </div>
                {{-- <div class="well well-sm col-sm-12">
                    <label><i  class="fa fa-certificate"></i> Status :</label>
                    @if(isset($userProfile[0]['approve']) == 'true') <span class="badge badge-success">Approved</span> @endif
                    @if(isset($userProfile[0]['pending'])  == 'true') <span class="badge badge-pending">Pending</span> @endif
                    @if(isset($userProfile[0]['reject'])  == 'true') <span class="badge badge-danger">Rejected</span> @endif
                </div> --}}
            </div>
    </div>
    </div>
                </section>
            </div>
    </div>

@endsection
