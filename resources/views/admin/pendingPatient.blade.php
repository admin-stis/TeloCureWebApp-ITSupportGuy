@extends('admin.layout')

@section('content')


@php 
    //for roles and security 
    $perm_role = Session::get('user_roles');
    $all_perms = $perm_role["perms"]; 
    $editPermission = false; 
    $deletePermission = false; 
    $approvePermission = false; 
    for($i=0; $i<count($all_perms); $i++)
    {
      if($all_perms[$i]=="Edit") { $editPermission = true; }
      if($all_perms[$i]=="Delete") { $deletePermission = true; }
      if($all_perms[$i]=="Approve") { $approvePermission = true; }    
    }
@endphp 


<div class="content-header">
      <div class="container-fluid">
            <div class="row mb-2">
                  @if(Session::has('update_msg'))
                            <ul><p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('update_msg') }}</p></ul>
                  @endif
{{-- New column add shefat 2.2.21 --}}
                  @php
                          if(isset($pending_patient['status'])){
                              $status = $pending_patient['status'];
                          }
                  @endphp

            </div>
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin')}}">Home</a></li>
              <li class="breadcrumb-item active">Patient</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>


    <section class="content">
      <div class="container-fluid">

          <div class="row">
          <!-- Left col -->
              <section class="col-lg-12 ">

            <div class="card">
                <div class="card-header">
                    <div class="col-md-12">
                        {{-- <span class=""><i class="fas fa-list mr-1"></i> List of Patient</span> --}}
                        {{-- New column add shefat 2.2.21 --}}
                        <span class=""><i class="fas fa-list mr-1"></i> List of @php echo ucfirst($status); @endphp Patients</span>
                    </div>
                    <div class="col-md-6">

                    </div>
                </div>
              <div class="card-body"><div>
                    <h4 style="color: rgb(253, 6, 6); text-align: center; margin: 5%" > Untill Completed the migration the VIEW PROFILE button won't work. </h4>
                  </div>
                <div class="tab-content p-0">
                  <!-- Morris chart - Sales -->
                  <div class="chart tab-pane active" id="revenue-chart"
                       style="position: relative;">
                       <div class="row">
                         
                        <input id="search" type="text" class="col-md-4 col-lg-4 form-control"  placeholder="Search..."/>
                    </div>
                       <table class="table">
              <thead>
                <tr>
                    <th scope="col">#</th>
                    {{-- <th scope="col">Reg No.</th> --}}
                    <th scope="col">Name</th>
                    <th scope="col">District</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Email</th>
                    <th scope="col">Date</th>
                    <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody>
                 <?php
                $frb_tz = new \DateTimeZone('Asia/Dhaka');
                foreach ($pending_patient as $key => $value)
                { ?>

                <tr>
                    <td>{{++$key}}</td>
                    {{-- <td>@if(isset($value['regNo'])) {{$value['regNo']}} @else N/A @endif</td> --}}
                    <td>@if(isset($value['name'])) {{$value['name']}} @else N/A  @endif</td>
                    <td>@if(isset($value['district'])) {{$value['district']}} @else N/A  @endif</td>
                    <td>@if(isset($value['phone'])) {{$value['phone']}} @else N/A  @endif</td>
                    <td>@if(isset($value['email'])) {{$value['email']}} @else N/A  @endif</td>
                    {{-- <td>@if(isset($value['email'])) {{$value['email']}} @else N/A  @endif</td> --}}
                    <td>
                        {{-- mridul 12-9-20 --}}
                         @if(isset($value['createdAt'])) 
                         
                         @php                            
                          $frb_date = new \DateTime($value['createdAt']);
                          $frb_date->setTimezone($frb_tz);
                          echo $frb_date->format('d-m-y  h:i:s A'); 
                         @endphp
                         @endif
                    </td>


                    
                    <td>
                        @if(isset($value['uid']))
                            <a class="btn btn-sm btn-primary" href="{{url('admin/pprofile/'.trim($value['uid']))}}">View profile</a>
                            @php if($status == 'deactive'){ @endphp  
                            <a type="button" class="btn btn-danger btn-sm" href="{{url('admin/patientProfileDeleteId/'.trim($value['uid']))}}" 
                            onclick="return confirm('ARE YOU SURE TO DELETE THE PATIENT ACCOUNT ?')">Delete</a> @php } @endphp 
                        @else
                            <a class="btn btn-sm btn-primary" href="#">View profile</a>

                            @if($approvePermission)
                            {{-- <a class="btn btn-sm btn-success btn-disabled" href="#">Approve</a>
                            <a class="btn btn-sm btn-danger btn-disabled" href="#">Reject</a> --}}
                            @endif

                        @endif
                    </td>
                </tr>
            @php } @endphp
              </tbody>
            </table>
            <div class="col-md-6 col-lg-6 jquery-script-clear"></div>

                   </div>
                </div>
              </div> 
            </div>

    </section>
          	</div>
      </div>
    
    
    
    @endsection 