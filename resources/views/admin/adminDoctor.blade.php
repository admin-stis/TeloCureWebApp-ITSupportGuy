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
                    <li class="breadcrumb-item"><a href="{{url('admin')}}">Home</a></li>
                    <li class="breadcrumb-item active">Doctor</li>
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
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{$totalDoctor}}</h3>
                                <p>Doctor</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="{{url('admin/doctor/')}}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    {{--
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h3>{{$noOfPendingDoctor}}<sup style="font-size: 20px"></sup></h3>

                    <p>Pending</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="{{url('admin/doctor/pending')}}" class="small-box-footer">More info <i
                        class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    --}}
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{$approvedDoctor}}</h3>

                <p>Active</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="{{url('admin/doctor/approve')}}" class="small-box-footer">More info <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{$noOfPendingDoctor}}</h3>
                <p>Pending</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{url('admin/doctor/pending')}}" class="small-box-footer">More info <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{$rejectDoctor}}</h3>
                <p>Rejected</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="{{url('admin/doctor/reject')}}" class="small-box-footer">More info <i
                    class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    </div>
    <!-- /.row -->
    <div class="card">
        <div class="card-header">
            <div class="col-md-12">
                <span class=""><i class="fas fa-list mr-1"></i> List of Doctor</span>
            </div>
            <div class="col-md-6">

            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="tab-content p-0">
                <!-- Morris chart - Sales -->
                <div class="chart tab-pane active" id="revenue-chart" style="position: relative;    overflow-x: auto;">
                    <div class="row">
                        <input id="search" type="text" class="col-md-4 col-lg-4 form-control" placeholder="Search..." />
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">BMDC No.</th>
                                <th scope="col">Name</th>
                                <th scope="col">District</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Email</th>
                                <th scope="col">Rating</th>
                                <th scope="col">Price</th>
                                <th scope="col">Hospital</th>
                                <th scope="col">Date</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $count = 0; $frb_tz = new \DateTimeZone('Asia/Dhaka'); @endphp
                            @foreach ($doctorList as $key=>$item)

                            <tr>
                                <td>{{++$key}}</td>
                                <td>@if(isset($item['regNo'])) {{$item['regNo']}} @else N/A @endif</td>
                                <td>@if(isset($item['name'])) {{$item['name']}} @else N/A @endif</td>
                                <td>@if(isset($item['district'])) {{$item['district']}} @else N/A @endif</td>
                                <td>@if(isset($item['phone'])) {{$item['phone']}} @else N/A @endif</td>
                                <td>@if(isset($item['email'])) {{$item['email']}} @else N/A @endif</td>
                                <td>
                                    @php
                                    if(isset($item['totalRating']) && isset($item['totalCount']) && $item['totalCount']
                                    > 0)
                                    {
                                    $totalRating = $item['totalRating'];
                                    $totalCount = $item['totalCount'];
                                    $rating = round(($totalRating/$totalCount),1);
                                    echo $rating ;
                                    }
                                    else
                                    {
                                    $rating = 5 ;
                                    echo $rating ;
                                    }
                                    @endphp
                                </td>
                                <td>@if(isset($item['price'])){{$item['price']}} Tk @else N/A @endif</td>
                                <td>@if(isset($item['hospitalName']) && $item['hospitalName']
                                    !=null){{$item['hospitalName']}} @else N/A @endif</td>
                                <td>
                                    @if(isset($item['createdAt']))

                                    {{--  @php                            
                                                      $frb_date = new \DateTime($item['createdAt']);
                                                      $frb_date->setTimezone($frb_tz);
                                                      echo $frb_date->format('d-m-y  h:i:s A'); 
                                                       @endphp
                                                       /--}}
                                    @endif
                                </td>
                                <td>
                                    @if(isset($item['uid']))
                                    <a class="btn btn-sm btn-primary"
                                        href="{{url('admin/dprofile/'.$item['uid'])}}">View</a>
                                    <a @if(isset($item['active']) && $item['active']=='true' )
                                        class="btn btn-sm btn-danger disabled" ; @else class="btn btn-sm btn-success" ;
                                        @endif href="{{url('admin/approveDocotr/'.$item['uid'])}}">Approve</a>
                                    <a @if(isset($item['rejected']) && $item['rejected']=='true' )
                                        class="btn  btn-sm btn-danger disabled" ; @else class="btn btn-sm btn-warning" ;
                                        @endif href="{{url('admin/rejactDoctor/'.$item['uid'])}}">Reject</a>
                                    @else
                                    <a class="btn btn-sm btn-primary disabled" href="#">View </a>
                                    <a class="btn btn-sm btn-success disabled" href="#">Approve</a>
                                    <a class="btn btn-sm btn-danger  disabled" href="#">Reject</a>
                                    @endif
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