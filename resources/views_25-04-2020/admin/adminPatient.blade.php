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
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active"><a href="{{url('admin/patient')}}">Patient</a></li>
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

                    <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-3 col-6">
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
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3>{{$noOfPendingUser}}<sup style="font-size: 20px"></sup></h3>

                  <p>Pending</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="{{url('admin/patient/pending')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3>{{$approvedUser}}</h3>

                  <p>Approved</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <a href="{{url('admin/patient/approve')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
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
            </div>
            <!-- ./col -->
          </div>
          <!-- /.row -->
    <div class="card">
                    <div class="row card-header">
                        <div class="col-md-6">
                            <h3 class="card-title">
                                <i class="fas fa-chart-pie mr-1"></i>List of Patient
                            </h3>
                        </div>
                        <div class="col-md-6">
                            {{-- <button class="btn btn-primary float-right">
                                <a href="#" class="text-white">
                                    <span class="fa fa-plus-circle"> New</span>
                                </a>
                            </button> --}}
                        </div>
                    </div>
                        <div class="card-tools">
                        <!-- <ul class="nav nav-pills ml-auto">
                            <li class="nav-item">
                            <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Area</a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link" href="#sales-chart" data-toggle="tab">Donut</a>
                            </li>
                        </ul> -->
                        </div>
                    {{-- </div> --}}
                    <!-- /.card-header -->
                    <div class="card-body">
                            <div class="tab-content p-0">
                            <!-- Morris chart - Sales -->
                                <div class="chart tab-pane active" id="revenue-chart"
                                    style="position: relative;">

                                    <table class="table">
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
                                                            <a class="btn btn-sm btn-primary" href="{{url('admin/pprofile/'.trim($item['uid']))}}">View profile</a>
                                                            <a class="btn  btn-sm btn-success" href="{{url('admin/approveDocotr/'.trim($item['uid']))}}">Approve</a>
                                                            <a class="btn  btn-sm btn-danger" href="{{url('admin/rejactUser/'.trim($item['uid']))}}">Reject</a>
                                                        @else
                                                        <a class="btn btn-sm btn-primary" href="#">View profile</a>
                                                        <a class="btn btn-sm btn-success btn-disabled" href="#">Approve</a>
                                                        <a class="btn btn-sm btn-danger btn-disabled" href="#">Reject</a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                        </table>


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
