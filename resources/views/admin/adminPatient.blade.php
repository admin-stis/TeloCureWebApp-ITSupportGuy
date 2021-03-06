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
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
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
                                                        @if(isset($item['uid']))

                                                            <a class="btn btn-primary btn-sm" href="{{url('admin/pprofile/'.trim($item['uid']))}}">View</a>
                                                            {{--<a @if(isset($item['active']) && $item['active'] == true ) class="btn  btn-sm btn-danger disabled" ; @else class="btn  btn-sm btn-success"; @endif   href="{{url('admin/activeUser/'.trim($item['uid']))}}">Active</a>
                                                            --}}
                                                            <a @if(isset($item['active']) && $item['active'] == false ) class="btn  btn-sm btn-danger" ; @else class="btn  btn-sm btn-warning"; @endif   href="{{url('admin/deactiveUser/'.trim($item['uid']))}}">Deactive</a>

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
