@extends('admin.layout')

@section('content')



<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Hospital User</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin')}}">Home</a></li>
              <li class="breadcrumb-item active">Hospital User</li>
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
                  <h3>{{$totalHospitalUser[0]}}</h3>

                  <p>Hospital User</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="{{url('admin/hospital')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-4 col-6">
              <!-- small box -->
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3>{{$pendingHospitalUser[0]}}<sup style="font-size: 20px"></sup></h3>

                  <p>Pending</p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="{{url('admin/hospitalUser/pending')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-4 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3>{{$approvedHospitalUser[0]}}</h3>

                  <p>Approved</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <a href="{{url('admin/hospitalUser/approve')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            {{--<div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3>{{$rejectHospitalUser[0]}}</h3>

                  <p>Reject</p>
                </div>
                <div class="icon">
                  <i class="ion ion-pie-graph"></i>
                </div>
                <a href="{{url('admin/hospitalUser/reject')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>--}}
            <!-- ./col -->
          </div>
          <!-- /.row -->
            <div class="card">
                    <div class="card-header">
                        <div class="col-md-12">
                            <span class=""><i class="fas fa-list mr-1"></i> List of Hospital User</span>
                        </div>
                        <div class="col-md-6">

                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                                                   @if(Session::has('notifyplan'))
                            <ul><p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('notifyplan') }}</p></ul>
                        @endif

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
                                                <th scope="col">Name</th>
                                                <th scope="col">Phone</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Hospital</th>
                                                <th scope="col">Address</th>
                                                <th scope="col">Plan</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($userList as $key=>$item)

                                                @php

                                                    if(isset($item['hospitalUid'])) $id = $item['hospitalUid']; else $id = '';
                                                    if(isset($item['name'])) $name = $item['name']; else $name = 'N/A' ;
                                                    if(isset($item['email'])) $email = $item['email']; else $email = 'N/A' ;
                                                    if(isset($item['phone'])) $phone = $item['phone']; else $phone = 'N/A' ;
                                                    if(isset($item['hospitalName'])) $hospitalName = $item['hospitalName']; else $hospitalName = 'N/A' ;
                                                    if(isset($item['hospitalAddress'])) $hospitalAddress = $item['hospitalAddress']; else $hospitalAddress = 'N/A' ;
                                                    if(isset($item['plan'])) $plan = ucfirst($item['plan']); else $plan = 'N/A' ;
                                                    if(isset($item['active'])) $approve = $item['active']; else $approve = false;

                                                @endphp

                                                <tr>
                                                    <td>{{++$key}}</td>
                                                    <td>{{$name}}</td>
                                                    <td>{{$phone}}</td>
                                                    <td>{{$email}}</td>
                                                    <td>{{$hospitalName}}</td>
                                                    <td>{{$hospitalAddress}}</td>
                                                    <td>{{$plan}}</td>
                                                    <td>



                                                       {{-- <a style="margin-top:5px;" class="btn btn-primary btn-sm" href="{{url('admin/viewHospitalUser')}}">View</a> --}}
                                                        @if($approve == true)

                                                            <a  style="margin-top:5px;width:100%;" class="btn btn-info btn-sm" disabled>Approved</a>
                                                            @if(isset($item['bankInfoUpdateRequest']) && $item['bankInfoUpdateRequest'] == true)
                                                                <a  type="button" style="margin-top:5px;width:100%;" class="btn btn-primary btn-sm" href="{{url('admin/updateBankInfo/'.$id)}}">
                                                                    Change Bank Information
                                                                </a>
                                                            @else
                                                                <a  style="margin-top:5px;width:100%;" class="btn btn-default btn-sm" disabled>
                                                                    Change Bank Information
                                                                </a>
                                                            @endif
                                                            {{-- <a  style="margin-top:5px;" class="btn btn-danger btn-sm" href="{{url('admin/unapproveHospitalUser')}}">Reject</a> --}}
                                                        @elseif($approve == false)
                                                            <a  style="margin-top:5px;width:100%;" class="btn btn-success btn-sm" href="{{url('admin/approveHospitalUser/'.$id)}}">Approve</a>
                                                            {{-- <br><a  style="margin-top:5px;" class="btn btn-info btn-sm" href="{{url('admin/unapproveHospitalUser')}}"  disabled>Rejected</a> --}}
                                                        {{--@else
                                                            <a  style="margin-top:5px;width:100%;" class="btn btn-success btn-sm" href="{{url('admin/approveHospitalUser/'.$id)}}">Approve</a>--}}
                                                            {{-- <br><a   style="margin-top:5px;"class="btn btn-danger btn-sm" href="{{url('admin/unapproveHospitalUser')}}">Reject</a> --}}
                                                        @endif
                                                        <a  style="margin-top:5px;width:100%;width:100%;" class="btn btn-warning btn-sm" href="{{url('hospital/planchange/'.$id)}}">Change Plan</a>

                                                    </td>
                                                </tr>

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

</script>

@endsection
