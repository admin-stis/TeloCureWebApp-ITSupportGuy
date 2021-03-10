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
            </div>
            
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Patient</h1>
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
          		<section class="col-lg-12">

                    <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-4 col-6">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3>{{$totalUser}}</h3>

                  <p>Patient</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="{{url('admin/patient/')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-4 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  @php
                    $active = $totalUser - $deactiveUser ;
                  @endphp
                  <h3>{{$active}}<sup style="font-size: 20px"></sup></h3>

                  <p>Active</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="{{url('admin/patient/active')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-4 col-6">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3>{{$deactiveUser}}</h3>

                  <p>Deactive</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <a href="{{url('admin/patient/deactive')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            
            <div class="col-lg-4 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3>{{$online}}</h3>

                  <p>Online</p>
                </div>
                <div class="icon">
                  <i class="ion"></i>
                </div>
                <a href="{{url('admin/patient/online')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            
            <div class="col-lg-4 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  {{-- <h3>{{$online}}</h3> --}}

                  <p>Wallet</p>
                </div>
                <div class="icon">
                  <i class="ion"></i> 
                </div>
                <a href="{{url('admin/patientwallet')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            
            <!-- ./col -->
            {{-- <div class="col-lg-3 col-6">

              <div class="small-box bg-danger">
                <div class="inner">
                  <h3>{{$rejectUser}}</h3>

                  <p>Reject</p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
                <a href="{{url('admin/patient/reject')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div> --}}
            <!-- ./col -->
          </div>
          <!-- /.row -->
    <div class="card">
        <div class="card-header">
            <div class="col-md-12">
                <span class=""><i class="fas fa-list mr-1"></i> List of Patient</span>
            </div>
            <div class="col-md-6">

            </div>
        </div>
        <!-- /.card-header -->
                    {{-- </div> --}}
                    <!-- /.card-header -->
                    <div class="card-body">
                            <div class="tab-content p-0">
                            <!-- Morris chart - Sales -->
                                <div class="chart tab-pane active" id="revenue-chart"
                                    style="position: relative;">
                                    <div class="row">
                                        <input id="search" type="text" class="col-md-4 col-lg-4 form-control"  placeholder="Search..."/>
                                        <div id="reportrange" class="col-md-4 col-lg-4 form-control" style="background: #fff; cursor: pointer; padding: 5px 10px; margin:0 5px 0 5px; border: 1px solid #ccc; text-align:center;" ><i class="fa fa-calendar"></i>&nbsp;
                                        <span>Select Date Range</span> <i class="fa fa-caret-down"></i></div>
                                    </div>
                                    <table class="table table-bordered">
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
                                            @php $frb_tz = new \DateTimeZone('Asia/Dhaka'); @endphp 
                                            @foreach ($usersList as $key=>$item)
                                            @if(isset($item['uid']))
                                            {{-- @if(isset($item['uid'])) <br>{{$item['uid']}} @endif --}}

                                                <tr>
                                                    <td>{{++$key}}</td>
                                                    {{-- <td>@if(isset($item['regNo'])) {{$item['regNo']}} @else N/A @endif</td> --}}
                                                    <td>@if(isset($item['name'])) {{$item['name']}} @else N/A  @endif</td>
                                                    <td>@if(isset($item['district'])) {{$item['district']}} @else N/A  @endif</td>
                                                    <td>@if(isset($item['phone'])) {{$item['phone']}} @else N/A  @endif</td>
                                                    <td>@if(isset($item['email'])) {{$item['email']}} @else N/A  @endif</td>
                                                                                                        <td>
                                                    {{-- mridul 12-9-20 --}}
                                                     @if(isset($item['createdAt'])) 
                                                     
                                                     @php                            
                                                      $frb_date = new \DateTime($item['createdAt']);
                                                      $frb_date->setTimezone($frb_tz);
                                                      echo $frb_date->format('d-m-Y  h:i:s A'); 
                                                     @endphp
                                                     <input type="hidden" class="date_val" value="{{ $frb_date->format('d/m/Y') }}"/>
                                                     @endif
                                                    </td> 
                                                    <td>
                                                        @if(isset($item['uid']))
                                                            <a class="btn btn-primary btn-sm" href="{{url('admin/pprofile/'.trim($item['uid']))}}">View</a>

                                                             @if($approvePermission)
                                                                <a @if(isset($item['active']) && $item['active'] == false ) class="btn  btn-sm btn-danger" ; 
                                                                      @else class="btn  btn-sm btn-warning"; 
                                                                    @endif   href="{{url('admin/deactiveUser/'.trim($item['uid']))}}">Deactive</a>
                                                              @endif
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endif
                                            @endforeach

                                        </tbody>
                                        </table>
                                        <div class="col-md-6 col-lg-6 jquery-script-clear"></div>


                                </div>
                            </div>
                    </div><!-- /.card-body -->
                </div>

            </div>
        </div>
    </div>
</section>

<script>
    function approve(id){
        alert('Hello');
        $.ajax({url: "http://localhost:8000/admin/approvePatient/"+id.trim(), success: function(result){
        toastr.info('patient approve successfully!!');
        rem = '#'+id.trim();
        $(rem).remove();
        }});
    }

    function reject(id){

        $.ajax({url: "http://localhost:8000/admin/rejectPatient/"+id.trim(), success: function(result){
        toastr.info('patient Registation Rejected!!');
        rem = '#'+id.trim();
        $(rem).remove();
        }});

    }

</script>

@endsection
