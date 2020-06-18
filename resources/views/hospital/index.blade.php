@extends('hospital.layout')

@section('content')

<style>
    #search1 {
        border: 1px solid !important;
        padding: 10px;
        margin-left: 17px;
    }
</style>

@php
    if(isset($hospitalUser[0]['hospitalUid'])) $id = $hospitalUser[0]['hospitalUid']; else $id = '';
    if(isset($hospitalUser[0]['uid'])) $uid = $hospitalUser[0]['uid']; else $uid = '';
    if(isset($hospitalUser[0]['name'])) $name = $hospitalUser[0]['name']; else $name = 'N/A' ;
    if(isset($hospitalUser[0]['email'])) $email = $hospitalUser[0]['email']; else $email = 'N/A' ;
    if(isset($hospitalUser[0]['phone'])) $phone = $hospitalUser[0]['phone']; else $phone = 'N/A' ;
    if(isset($hospitalUser[0]['hospitalName'])) $hospitalName = $hospitalUser[0]['hospitalName']; else $hospitalName = 'N/A' ;
    if(isset($hospitalUser[0]['hospitalAddress'])) $hospitalAddress = $hospitalUser[0]['hospitalAddress']; else $hospitalAddress = 'N/A' ;
    if(isset($hospitalUser[0]['plan'])) $plan = ucfirst($hospitalUser[0]['plan']); else $plan = 'N/A' ;
    if(isset($hospitalUser[0]['active'])) $approve = $hospitalUser[0]['active'];

@endphp

<input id="uid" type="hidden" value="{{$id}}"/>

<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark" style="float:left;">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item breadcrumb-hospitalUser"><a href="{{url('/hospital')}}">Home </a></li>

              <li class="breadcrumb-item breadcrumb-hospitalUser active" >Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
     <section class="content">
      <div class="center" style="text-align:center;color:red">
      @if(Auth::check() && !Auth::user()->hasVerifiedEmail())
        <p>Please verify your email address. An email containing verification instructions was sent to {{ Auth::user()->email }}.</p>
      @endif
    </div>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-6">
            <!-- TO DO List -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="ion ion-clipboard mr-1"></i>
                  Profile Information
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="" style="margin-top:10px;">
                    <div class="row col-md-12">
                        <label class="col-md-4">
                            <h6>User ID</h6>
                        </label>
                        <span class="col-md-1"> : </span>
                        <span class="col-md-6">
                            {{$id}}
                        </span>
                    </div>
                    <div class="row col-md-12">
                        <label class="col-md-4">
                            <h6>Name</h6>
                        </label>
                        <span class="col-md-1"> : </span>
                        <span class="col-md-6">{{$name}}</span>
                    </div>
                    <div class="row col-md-12">
                        <label class="col-md-4">
                            <h6>Phone</h6>
                        </label>
                        <span class="col-md-1"> : </span>
                        <span class="col-md-6">
                                {{$phone}}
                        </span>
                    </div>
                    <div class="row col-md-12">
                        <label class="col-md-4">
                            <h6>Email</h6>
                        </label>
                        <span class="col-md-1"> : </span>
                        <span class="col-md-6">{{$email}}</span>
                    </div>

                    <div class="row col-md-12">
                        <label class="col-md-4">
                            <h6>Hospital Name</h6>
                        </label>
                        <span class="col-md-1"> : </span>
                        <span class="col-md-6">{{$hospitalName}}</span>
                    </div>
                    <div class="row col-md-12">
                        <label class="col-md-4">
                            <h6>Hospital Address</h6>
                        </label>
                        <span class="col-md-1"> : </span>
                        <span class="col-md-6">{{$hospitalAddress}}</span>
                    </div>
                    <div class="row col-md-12">
                        <label class="col-md-4">
                            <h6>Subscription Plan</h6>
                        </label>
                        <span class="col-md-1"> : </span>
                        <span class="col-md-6">{{$plan}}</span>
                    </div>

                </div>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                  <a class="btn btn-info btn-sm" href="{{url('admin/hospital/profile/'.$id)}}" style="float:right;">View</a>
              </div>
            </div>
            <!-- /.card -->
          </section>



          <section class="col-lg-6">
            <!-- TO DO List -->
            <div class="card" style="min-height:382px;">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="ion ion-clipboard mr-1"></i>
                  {{--Total Revenue : {{ $rev['total'] }} Tk--}}
                  Total Revenue : 0 Tk
                </h3>
              </div>
              <!-- /.card-header -->
             <div class="card-body">
                <div class="row">
                    <input id="search1" type="text" class="col-md-4 col-lg-4 form-control"  placeholder="Search..."/>
                </div>
                    <table class="table revTable">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php //dd($rev['rev']);
                            @endphp
                            @foreach ($rev['rev'] as $key=>$item)

                                <tr class="t1">
                                    <td><span>{{$item['date']}}</span></td>
                                    <td><span>{{$item['amount']}} Tk</span></td>
                                </tr>

                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{--<a class="btn btn-info btn-sm" href="{{url('admin/hospital/revenueinfo/'.$id)}}" style="float:right;">View</a>--}}
                </div>
            </div>

          </section>

            {{-- @if(Session::has('success'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Success!</strong> Indicates a successful or positive action.
                </div>
            @endif --}}

          <section class="col-lg-12">
            <!-- TO DO List -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="ion ion-clipboard mr-1"></i>
                  Doctor
                  <a class="btn btn-sm btn-info" style="float:right;" href="{{url('hospital/addDoctor/'.$id)}}">New</a>
                </h3>
              </div>
              <!-- /.card-header -->

              <div class="card-body">

                @if(Session::has('success'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>{{ Session::get('success') }}</strong>
                    </div>
                @endif

                <div class="row">
                    <input id="search" type="text" class="col-md-4 col-lg-4 form-control"  placeholder="Search..."/>
                </div>

                <div class="col-md-6 col-lg-6 jquery-script-clear"></div>

                  <table id="table" class="table table-bordered table-hover doctorListTable">
                    <thead>
                    <tr>
                      <th class="text-center">Sl</th>
                      <th class="text-center">Name</th>
                      <th class="text-center">Phone</th>
                      <th class="text-center">Email</th>
                      <th class="text-center">Type</th>
                      <th scope="col">Rating</th>
                      <th scope="col">Price</th>
                      <th class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($hospitalsDoctor as $item)
                            @php
                                //dd($item);
                            @endphp
                            <tr>
                                <td>{{$i}}</td>
                                <td>{{$item['name']}}</td>
                                <td>{{$item['phone']}}</td>
                                <td>{{$item['email']}}</td>
                                <td>@if(isset($item['doctorType'])){{$item['doctorType']}} @else N/A @endif</td>

                                <td>
                                                      @php
                                                        if(isset($item['totalRating']) && isset($item['totalCount']) && $item['totalCount'] > 0)
                                                        {
                                                            $totalRating = $item['totalRating'];
                                                            $totalCount = $item['totalCount'];
                                                            $rating = round(($totalRating/$totalCount),1);
                                                            echo $rating ;
                                                        }
                                                        else
                                                        {
                                                          echo '5';
                                                        }
                                                      @endphp
                                                    </td>
                                                    <td>@if(isset($item['price'])){{$item['price']}} Tk @else N/A @endif</td>

                                <td>
                                    <a class="btn btn-sm btn-primary" href="{{url('hospital/viewDoctor/'.$item['uid'])}}">View</a>
                                    <a class="btn btn-sm btn-danger" href="{{url('hospital/deleteDoctor/'.$item['uid'])}}">Delete</a>
                                </td>
                            </tr>
                            @php
                                $i++;
                            @endphp
                        @endforeach
                    </tbody>
                  </table>
              </div>
              <!-- /.card-body -->

            </div>
            <!-- /.card -->
          </section>
          <!-- /.Left col -->

        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->



    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.2.1/Chart.min.js"></script>

    <script>
        $(document).ready(function(){
            var uid = $('#uid').val();
            // alert(uid);
            $.ajax({
                url: "hospital/rev/"+uid,
                method: "GET",
                success: function(data) {
                    console.log(data.amount);
                var dates = [];
                var amount = [];

                for(var i in data) {
                    var val = 0 ;
                    dateData = new Date((data[i].date));
                    dates.push(data[i].date);
                    amount.push(data[i].val);
                }

                var chartdata = {
                    labels: data.amount,
                    datasets : [
                    {
                        label: 'Revenue ',
                        backgroundColor: '#17a2b8',
                        borderColor: 'rgba(200, 200, 200, 0.75)',
                        hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
                        hoverBorderColor: 'rgba(200, 200, 200, 1)',
                        data: data.date,
                        options: {
                            scales: {
                                xAxes: [{
                                    type: 'time',
                                    distribution: 'series',
                                    time: {
                                    displayFormats: {
                                        quarter: 'MMM YYYY'
                                    }
                            }
                                }]
                            }
                        }
                    }
                    ]
                };

                var ctx = $("#mycanvas");

                var barGraph = new Chart(ctx, {
                    type: 'line',
                    data: chartdata
                });
                },
                error: function(data) {
                console.log(data);
                }
            });
        });

    </script>

    <script type="text/javascript">
        $(document).ready(function(){
        $("#search").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("tbody tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
        $("#search1").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("tbody tr.t1").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });

    $(document).ready(function () {
        $('.doctorListTable').paginate({
            'elemsPerPage': 10,
                'maxButtons': 6
        });
        $('.revTable').paginate({
            'elemsPerPage': 5,
                'maxButtons': 4
        });
    });

    $(document).ready(function(){
        $('.dp li a').click(function(){
            let v = $(this).attr('href');
            $('v').addClasses('btn-success');
            $('v').removeClass('btn-success');

        });
    });
    </script>

     @endsection
