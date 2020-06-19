@extends('doctor.layout')
@section('content')

<div class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6">
            <h1 class="m-0 text-dark" style="float:left;">Doctor</h1>
         </div>
         <!-- /.col -->
         <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="{{url('admin/doctor')}}">Doctor Dashboard</a></li>
               @php
               $uid = trim($doctorProfile['uid']);
               @endphp
               <li class="breadcrumb-item active"><a href="{{url('admin/doctor/'.$uid)}}">Profile</a></li>
            </ol>
         </div>
         <!-- /.col -->
      </div>
      <!-- /.row -->
   </div>
   <!-- /.container-fluid -->
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
                     @else
                     <i class="fa fa-user-circle" style="font-size: 8em;
                        margin: 0 auto;
                        display: table;"></i>
                     @endif
                  </div>
                  <!-- END SIDEBAR USERPIC -->
                  <!-- SIDEBAR USER TITLE -->
                  <div class="profile-usertitle">
                     <div class="profile-usertitle-name">
                        @if(isset($doctorProfile['online']) == 1)
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
                     {{-- <button type="button" class="btn btn-danger btn-sm">Message</button> --}}
                  </div>
                  <!-- END SIDEBAR BUTTONS -->
                  <!-- SIDEBAR MENU -->
                  {{--
                  <div class="profile-usermenu">
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
                  </div>
                  --}}
                  <!-- END MENU -->
               </div>
            </div>
            <div class="col-md-9">
               <ul class="nav nav-tabs profile-tab">
                  <li class="col-md-6 col-sm-12 text-center active "><a data-toggle="tab" href="#info">Basic</a></li>
                  <!-- <li class="col-md-4 text-center "><a data-toggle="tab" href="#doc">Documents</a></li> -->
                  <li class="col-md-6 col-sm-12 text-center"><a data-toggle="tab" href="#bank">Bank Account</a></li>
               </ul>
               <div class="tab-content">
                  <div id="info" class="tab-pane fade active show">
                     <div class="col-md-12">
                        <div class="profile-content row" style="min-height: 460px;">
                           <div class="well well-sm col-sm-12">
                              <label class="col-sm-6"><i class="fa fa-bullseye"></i> Registration Number :</label>
                              <span class="col-sm-6">{{$doctorProfile['regNo']}}</span>
                           </div>
                           <hr>
                           <div class="well well-sm col-sm-6 row">
                              <label class="col-sm-6"><i  class="fa fa-user"></i> Name :</label>
                              <span class="col-sm-6">{{$doctorProfile['name']}}</span>
                           </div>
                           <div class="well well-sm col-sm-6 row">
                              <label class="col-sm-6"><i  class="fa fa-birthday-cake"></i> Date of Birth :</label>
                              <span class="col-sm-6">{{$doctorProfile['dateOfBirth']}}</span>
                           </div>
                           <hr>
                           <div class="well well-sm col-sm-6 row">
                              <label class="col-sm-6"><i  class="fa fa-male"></i> Gender :</label>
                              <span class="col-sm-6">{{$doctorProfile['gender']}}</span>
                           </div>
                           <div class="well well-sm col-sm-6 row">
                              <label class="col-sm-6"><i  class="fa fa-phone"></i> Phone :</label>
                              @if(isset($doctorProfile['phone']))
                              <span class="col-sm-6">{{$doctorProfile['phone']}}</span>
                              @else
                              <span class="col-sm-6">N/A</span>
                              @endif
                           </div>
                           <hr>
                           <div class="well well-sm col-sm-6 row">
                              <label class="col-sm-6"><i  class="fa fa-envelope"></i> Email :</label>
                              <span class="col-sm-6">{{$doctorProfile['email']}}</span>
                           </div>
                           <hr>
                           <div class="well well-sm col-sm-12 row">
                              <label class="col-sm-3"><i  class="fa fa-map-marker"></i> Location :</label>
                              <span class="col-sm-8">{{$doctorProfile['district']}}</span>
                           </div>
                           <hr>
                           @if(isset($doctorProfile['price']))
                           <div class="well well-sm col-sm-12 row">
                              <label class="col-sm-6"><i  class="fa fa-clone"></i> Price :</label>
                              <span class="col-sm-6">{{$doctorProfile['price']}}</span>
                           </div>
                           <hr>
                           @endif
                           @if(isset($doctorProfile['totalRating']) && isset($doctorProfile['totalCount']) && $doctorProfile['totalCount'] > 0)
                           @php

                           <div class="well well-sm col-sm-12">
                              <label class="col-sm-6"><i  class="fa fa-star"></i> Rating :</label>
                              <span class="col-sm-6">
                                @php
                                        $rating = round(($totalRating/$totalCount),1);
                                            echo $rating;
                                        }else{
                                            $rating = 5 ;
                                            echo $rating;
                                        }
                                @endphp
                           </span>
                           </div>
                           @endif
                           {{-- @if(isset($doctorProfile['totalCount']))
                           <div class="well well-sm col-sm-12">
                              <label class="col-sm-6"><i  class="fa fa-cube"></i> Total Count :</label>
                              {{$doctorProfile['totalCount']}}
                           </div>
                           @endif --}}
                           {{--
                           <div class="well well-sm col-sm-12">
                              <label class="col-sm-6"><i  class="fa fa-certificate"></i> Status :</label>
                              @if(isset($doctorProfile['approve']) == true) <span class="badge badge-success">Approved</span> @endif
                              @if(!isset($doctorProfile['pending'])) <span class="badge badge-pending">Pending</span> @endif
                              @if(isset($doctorProfile['approve'])  == false) <span class="badge badge-danger">Rejected</span> @endif
                           </div>
                           --}}
                        </div>
                     </div>
                  </div>
                  <!-- <div id="doc" class="tab-pane fade">
                     <div class="col-md-12">
                           <div class="profile-content row">
                               <div class="well well-sm col-sm-12">
                                   <label class="col-sm-6"><i class="fa fa-user"></i> Profile :</label>
                                       @if($doctorProfile['profileImage'])
                                           <img src="{{$doctorProfile['profileImage']}}"/>
                                       @else <span>N/A</span>
                                       @endif
                               </div>
                           </div>
                           <div class="profile-content row">
                               <div class="well well-sm col-sm-12">
                                   <label class="col-sm-6"><i class="fa fa-copy"></i> Certificate :</label>
                                       @if($doctorProfile['degreeCertificate'])
                                           {{$doctorProfile['degreeCertificate']}}
                                       @else <span>N/A</span>
                                       @endif
                               </div>
                           </div>
                           <div class="profile-content row">
                               <div class="well well-sm col-sm-12">
                                   <label class="col-sm-6"><i class="fa fa-copy"></i> Prescription Form :</label>
                                       @if($doctorProfile['prescriptionForm'])
                                           {{$doctorProfile['prescriptionForm']}}
                                       @else <span>N/A</span>
                                       @endif
                               </div>
                           </div>
                       </div>
                     </div> -->
                  <div id="bank" class="tab-pane fade">
                     <div class="col-md-12">
                        <div class="profile-content row" style="min-height: 460px;">
                           <div class="well well-sm col-sm-12 row">
                              <label class="col-sm-6"><i class="fa fa-user"></i> Account Name :</label>
                              @if($doctorProfile['accountName'])
                              <span class="col-sm-6">{{$doctorProfile['accountName']}}</span>
                              @else <span class="col-sm-6">N/A</span>
                              @endif
                           </div>
                           <hr>
                           <div class="well well-sm col-sm-12">
                              <label class="col-sm-6"><i  class="fa fa-bullseye"></i> Account No :</label>
                              @if($doctorProfile['accountNo'])
                              <span class="col-sm-6">{{$doctorProfile['accountNo']}}</span>
                              @else <span class="col-sm-6">N/A</span>
                              @endif
                           </div>
                           <hr>
                           <div class="well well-sm col-sm-12">
                              <label class="col-sm-6"><i  class="fa fa-building"></i>Bank Name :</label>
                              @if($doctorProfile['bankName'])
                              <span class="col-sm-6">{{$doctorProfile['bankName']}}</span>
                              @else <span class="col-sm-6">N/A</span>
                              @endif
                           </div>
                           <hr>
                           <div class="well well-sm col-sm-12">
                              <label class="col-sm-6"><i  class="fa fa-map-marker"></i> Branch Name :</label>
                              @if($doctorProfile['branchName'])
                              <span class="col-sm-6">{{$doctorProfile['branchName']}}</span>
                              @else <span class="col-sm-6">N/A</span>
                              @endif
                           </div>
                           <hr>
                           @if(isset($doctorProfile['swiftCode']))
                           <div class="well well-sm col-sm-12">
                              <label  class="col-sm-6"><i  class="fa fa-clone"></i> Swift Code :</label>
                              <span class="col-sm-6">{{$doctorProfile['swiftCode']}}</span>
                           </div>
                           <hr>
                           @endif
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
