@extends('admin.layout')

@section('content')

<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin')}}">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
         <!-- Small boxes (Stat box) -->
        <div class="row">

          <!-- ./col -->
          <div class="col-lg-3 col-12">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner" style="padding:21px;">
                <h5 class="text-center text-bold">Total Doctors Active</h5>
                <h3>{{$activeDoctor}}</h3>
              </div>
              <div class="icon">
                <i class="fas fa-user-md"></i>
              </div>
              <a href="{{url('admin/doctor')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-12">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h5 class="text-center text-bold">Total Registered Patient</h5>
                <h3>{{$totalPatient}}</h3>
              </div>
              <div class="icon">
                <i class="fa fa-bed"></i>
              </div>
              <a href="{{url('admin/patient')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-12">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h5 class="text-center text-bold text-white">Total Hospital Registered</h5>
                <h3  class="text-white">{{$totalHospitalUser}}</h3>
              </div>
              <div class="icon">
                <i class="fa fa-hospital"></i>
              </div>
              <a href="{{url('admin/hospital')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-12">
            <!-- small box -->
            <div class="small-box bg-secondary">
              <div class="inner" style="padding:21px;">
                <h5 class="text-center text-bold text-white">Total Transaction</h5>
                <h3  class="text-white">{{$totalRevenue[0]}} Tk</h3>
              </div>
              <div class="icon">
                <i class="fa fa-hospital"></i>
              </div>
              <a href="{{url('admin/doctorTransactionData')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>




        {{-- charts --}}

        <div class="row" style="margin-top: 10px;margin-bottom: 28px;background: #fff;margin-right: 0px;margin-left: 0px;padding: 20px">
            <!-- ./col -->
            <div class="col-lg-6 col-12 graph">
              <!-- small box -->
              <h5>Registered User</h5>
              <canvas id="bar-chart"></canvas>
            </div>

            <div class="col-lg-6 col-12 graph">
              <!-- small box -->
              <h5>Visited User</h5>
              <canvas id="bar-chart2"></canvas>
            </div>
            <div class="col-lg-12 col-12 graph">
              <!-- small box -->
              <h5>Revenue Information</h5>
              <canvas id="mycanvas"></canvas>
            </div>
            <!-- ./col -->
            <div class="col-lg-6 col-12 d-none">
              <!-- small box -->
              <canvas id="chartByPatient"></canvas>
            </div>
            <!-- ./col -->
            <div class="col-lg-6 col-12  d-none">
                <!-- small box -->
                <h4>Revenue</h4>
                <canvas id="line-chart"></canvas>
              </div>
            <!-- ./col -->
          </div>
        {{-- ens charts --}}

        <!-- /.row -->
        <!-- Small boxes (Stat box) -->
        <div class="row">

            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h4 class="text-center text-bold">Doctor</h4>
                </div>
                <a href="{{url('admin/doctor')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box" style="background-color: #af28c1;color: #fff;">
                <div class="inner">
                  <h4 class="text-center text-bold">Patient</h4>
                </div>
                <a href="{{url('admin/patient')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h4 class="text-center text-bold">Hospital</h4>
                </div>
                <a href="{{url('admin/hospital')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <!-- ./col -->
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-primary">
                  <div class="inner">
                    <h4 class="text-center text-bold">Service & Revenue</h4>
                  </div>
                  <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <!-- ./col -->
          </div>
          <!-- /.row -->
        <!-- Main row -->



      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.2.1/Chart.min.js"></script>

    <script>
        $(document).ready(function(){
            $.ajax({
                url: "admin/revenue",
                method: "GET",
                success: function(data) {
                var dates = [];
                var amount = [];

                for(var i in data) {
                    var val = 0 ;
                    dateData = new Date((data[i].date));
                    dates.push(data[i].date);
                    amount.push(data[i].val);
                }

                var chartdata = {
                    labels: dates,
                    datasets : [
                    {
                        label: 'Revenue ',
                        backgroundColor: '#17a2b8',
                        borderColor: 'rgba(200, 200, 200, 0.75)',
                        hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
                        hoverBorderColor: 'rgba(200, 200, 200, 1)',
                        data: amount,
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

            //registered user (patients)
            $.ajax({
                url: "admin/regUser",
                method: "GET",
                success: function(data) {

                    var dates = [];
	                var amount = [];

	                for(var i in data) {
	                    var val = 0 ;
	                    dateData = new Date((data[i].date));
	                    dates.push(data[i].date);
	                    amount.push(data[i].val);
	                }

                    var chartdata = {
                        labels: dates,
                        datasets : [
                            {
                                label: 'Registered Users ',
                                backgroundColor:["rgb(54, 162, 235)","rgb(255, 99, 132),rgb(54, 162, 235)","rgb(255, 99, 132),rgb(54, 162, 235)","rgb(255, 99, 132),rgb(54, 162, 235)","rgb(255, 99, 132),rgb(54, 162, 235)","rgb(255, 99, 132)"],
                                borderColor: 'rgba(200, 200, 200, 0.75)',
                                hoverBackgroundColor:["rgb(255, 99, 132)","rgb(54, 162, 235)","rgb(255, 205, 86),rgb(255, 99, 132)","rgb(54, 162, 235)","rgb(255, 205, 86),rgb(255, 99, 132)","rgb(54, 162, 235)","rgb(255, 205, 86),rgb(255, 99, 132)","rgb(54, 162, 235)","rgb(255, 205, 86),rgb(255, 99, 132)","rgb(54, 162, 235)","rgb(255, 205, 86)"],
                                hoverBorderColor: 'rgba(200, 200, 200, 1)',
                                data: amount,
                            }
                        ]
                    };

                    var ctx = $("#bar-chart");

                    var barGraph = new Chart(ctx, {
                        type: 'bar',
                        data: chartdata
                    });
                },
                error: function(data) {
                console.log(data);
                }
            });


            $.ajax({
                url: "admin/visitors",
                method: "GET",
                success: function(data) {

                    var dates = [];
                  var amount = [];

                  for(var i in data) {
                      var val = 0 ;
                      dateData = new Date((data[i].date));
                      dates.push(data[i].date);
                      amount.push(data[i].val);
                  }

                    var chartdata = {
                        labels: dates,
                        datasets : [
                            {
                                label: 'Patient Visited ',
                                backgroundColor:["rgb(54, 162, 235)","rgb(255, 99, 132),rgb(54, 162, 235)","rgb(255, 99, 132),rgb(54, 162, 235)","rgb(255, 99, 132),rgb(54, 162, 235)","rgb(255, 99, 132),rgb(54, 162, 235)","rgb(255, 99, 132)"],
                                borderColor: 'rgba(200, 200, 200, 0.75)',
                                hoverBackgroundColor:["rgb(255, 99, 132)","rgb(54, 162, 235)","rgb(255, 205, 86),rgb(255, 99, 132)","rgb(54, 162, 235)","rgb(255, 205, 86),rgb(255, 99, 132)","rgb(54, 162, 235)","rgb(255, 205, 86),rgb(255, 99, 132)","rgb(54, 162, 235)","rgb(255, 205, 86),rgb(255, 99, 132)","rgb(54, 162, 235)","rgb(255, 205, 86)"],
                                hoverBorderColor: 'rgba(200, 200, 200, 1)',
                                data: amount,
                            }
                        ]
                    };

                    var ctx = $("#bar-chart2");

                    var barGraph = new Chart(ctx, {
                        type: 'bar',
                        data: chartdata
                    });
                },
                error: function(data) {
                console.log(data);
                }
            });
        });


        //end

        // Bar chart
        /*new Chart(document.getElementById("bar-chart"), {
            type: 'bar',
            data: {
            labels: ["January", "February", "March", "April", "May","June","July"],
            datasets: [
                {
                label: "Active Doctors",
                backgroundColor: ["#3e95cd"],
                data: [2478,5267,734,784,433,500,600]
                }
            ]
            },
            options: {
            legend: { display: false },
            title: {
                display: true,
                text: 'Active Doctor List (Dummy)'
            }
            }
        });

        new Chart(document.getElementById("pie-chart"), {
            type: 'pie',
            data: {
            labels: ["January", "February", "March", "April", "May","June","July"],
            datasets: [
                {
                label: "Revenue",
                backgroundColor: ["#3e95cd"],
                data: [2478,5267,734,784,433,500,600]
                }
            ]
            },
            options: {
            legend: { display: false },
            title: {
                display: true,
                text: 'Revenue Info (Dummy)'
            }
            }
        });

        new Chart(document.getElementById("line-chart"), {
            type: 'line',
            data: {
            labels: ["January", "February", "March", "April", "May","June","July"],
            datasets: [
                {
                label: "Patient",
                backgroundColor: ["#3e95cd"],
                data: [2478,5267,734,784,433,500,600]
                }
            ]
            },
            options: {
            legend: { display: false },
            title: {
                display: true,
                text: 'Patient Information (Dummy)'
            }
            }
        });*/

    </script>

     @endsection
