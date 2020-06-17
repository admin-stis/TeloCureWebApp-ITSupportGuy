@extends('admin.layout')

@section('content')
<!-- Content Header (Page header) -->
    @php
        // $doctorInfo = Session::get('doctor');
        // if(isset($doctorInfo[0]['accountName'])) $accountName = $doctorInfo[0]['accountName'];
    @endphp

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"  style="float:left;">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin')}}">Home</a></li>
              <li class="breadcrumb-item active">Service & Revenue</li>
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
          <section class="row col-lg-12">
            <div class="col-lg-4 col-md-4 col-sm-12" style="background:#fff;padding:15px;">
                <h5>Patient By Gender</h5><hr>
                <canvas id="mycanvas"></canvas>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12" style="background:#fff;padding:15px;">
                <h5>Doctor Type</h5><hr>
                <canvas id="doctorTypeChart"></canvas>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12" style="background:#fff;padding:15px;">
                <h5>Patient Status</h5><hr>
                <canvas id="patientActivityChart"></canvas>
            </div>
            <div class="col-lg-6 col-md-6" style="margin-top:20px;">
                <!-- small box -->
                <div class="small-box bg-success">
                  <div class="inner">
                    <h4 class="text-center text-bold">Service Info</h4>
                  </div>
                  <a href="{{url('admin/service')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <div class="col-lg-6 col-md-6" style="margin-top:20px;">
                <!-- small box -->
                <div class="small-box bg-primary">
                  <div class="inner">
                    <h4 class="text-center text-bold">Financial Info</h4>
                  </div>
                  <a href="{{url('admin/finance')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>

              <!-- ./col -->
          </div>
          </section>

          <!-- /.Left col -->

          {{-- Patient information with diagnosis --}}
          <section class="col-lg-12">
            <div class="card">
               <div class="card-header">
                  <div class="col-md-12">
                     <span class=""><i class="fas fa-list mr-1"></i>Financial Information</span>
                  </div>
                  <div class="col-md-6">
                  </div>
               </div>
               <!-- /.card-header -->
               <div class="card-body">
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
                                    <th>Patient</th>
                                    <th>Phone</th>
                                    <th>Gender</th>
                                    <th>District</th>
                                    <th>Diagnosis</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 0; @endphp
                                @foreach ($arr as $item)

                                    <tr>
                                        <td>{{$item['name']}}</td>
                                        <td>{{$item['phone']}}</td>
                                        <td>{{$item['gender']}}</td>
                                        <td>{{$item['district']}}</td>
                                        <td>
                                            <span class="col-md-4">Respiration : @if(isset($item['diagnosis'][$i]['resp'])){{$item['diagnosis'][$i]['resp']}} @else N/A @endif</span>
                                            <span class="col-md-4">Blood Pressure : @if(isset($item['diagnosis'][$i]['bpm'])){{$item['diagnosis'][$i]['bpm']}} @else N/A @endif</span>
                                            <span class="col-md-4">Temparature :@if(isset($item['diagnosis'][$i]['temp'])){{$item['diagnosis'][$i]['temp']}} @else N/A @endif</span>
                                        </td>
                                    </tr>
                                @php $i++; @endphp
                                @endforeach
                            </tbody>
                        </table>
                        <div class="col-md-6 col-lg-6 jquery-script-clear"></div>
                     </div>
                  </div>
               </div>
               <!-- /.card-body -->
            </div>

         </section>


        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.2.1/Chart.min.js"></script>

    <script>
        $(document).ready(function(){
            $.ajax({
                url: "patientInfo",
                method: "GET",
                success: function(data) {
                    var male = 0,female = 0;
                    for(var i in data){
                        if(data[i].gender == 'Male') male++ ;
                        else if(data[i].gender == 'Female') female++ ;
                    }

                var chartdata = {
                    labels: ['Male','Female'],
                    datasets : [
                        {
                            label: 'Patient By Sex ',
                            backgroundColor:["rgb(54, 162, 235)","rgb(255, 99, 132)"],
                            borderColor: 'rgba(200, 200, 200, 0.75)',
                            hoverBackgroundColor:["rgb(54, 162, 235)","rgb(255, 99, 132)"],
                            hoverBorderColor: 'rgba(200, 200, 200, 1)',
                            data: [male,female],
                        }
                    ]
                };

                var ctx = $("#mycanvas");

                var barGraph = new Chart(ctx, {
                    type: 'doughnut',
                    data: chartdata
                });
                },
                error: function(data) {
                console.log(data);
                }
            });

            // graph for doctor by type
            $.ajax({
                url: "doctorInfo",
                method: "GET",
                success: function(data) {
                    var general = 0,pediatric = 0;
                    for(var i in data){
                        if(data[i].doctorType == 'General Practitioner' || data[i].doctorType == 'GENERAL') general++ ;
                        else if(data[i].doctorType == 'PEDIATRIC') pediatric++ ;
                    }

                var chartdata = {
                    labels: ['General Practitioner','Pediatric'],
                    datasets : [
                        {
                            label: 'Doctor By Type ',
                            backgroundColor:["#4DA660","#152A45"],
                            borderColor: 'rgba(200, 200, 200, 0.75)',
                            hoverBackgroundColor:["#4DA660","#152A45"],
                            hoverBorderColor: 'rgba(200, 200, 200, 1)',
                            data: [general,pediatric],
                        }
                    ]
                };

                var ctx = $("#doctorTypeChart");

                var barGraph = new Chart(ctx, {
                    type: 'pie',
                    data: chartdata
                });
                },
                error: function(data) {
                console.log(data);
                }
            });

            // graph for patient by online
            $.ajax({
                url: "patientInfo",
                method: "GET",
                success: function(data) {
                    //console.log(data[4].online);
                    var online = 0,offline = 0;
                    for(var i in data){
                        if(data[i].online == true) online++ ;
                        else if(data[i].online == false) offline++ ;
                    }

                var chartdata = {
                    labels: ['Online','Offline'],
                    datasets : [
                    {
                        label: 'Patient',
                        backgroundColor:["rgb(54, 162, 235)","rgb(255, 99, 132)"],
                        borderColor: 'rgba(200, 200, 200, 0.75)',
                        hoverBackgroundColor:["rgb(255, 99, 132)","rgb(54, 162, 235)","rgb(255, 205, 86)"],
                        hoverBorderColor: 'rgba(200, 200, 200, 1)',
                        data: [online,offline],
                    }
                    ]
                };

                var ctx = $("#patientActivityChart");

                var barGraph = new Chart(ctx, {
                    type: 'doughnut',
                    data: chartdata
                });
                },
                error: function(data) {
                console.log(data);
                }
            });
        });
    </script>

@endsection
