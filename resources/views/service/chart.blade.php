 
<!-- Content Header (Page header) -->
@php
// $doctorInfo = Session::get('doctor');
// if(isset($doctorInfo[0]['accountName'])) $accountName = $doctorInfo[0]['accountName'];
@endphp

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                {{-- <h1 class="m-0 text-dark" style="float:left;">Dashboard</h1> --}}
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
        <p>Please verify your email address. An email containing verification instructions was sent to
            {{ Auth::user()->email }}.</p>
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
                    <h5>Patient By Gender</h5>
                    <hr>
                    <canvas id="mycanvas"></canvas>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-12" style="background:#fff;padding:15px;">
                    <h5>Patient Status</h5>
                    <hr>
                    <canvas id="patientActivityChart"></canvas>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-12" style="background:#fff;padding:15px;">
                    <h5>Doctor Type</h5>
                    <hr>
                    <canvas id="doctorTypeChart"></canvas>
                </div>

                <!--  20/07/2020 -->
                <div class="col-lg-6 col-md-6 col-sm-12" style="background:#fff;padding:15px;">
                    <h5>Doctor By District</h5>
                    <hr>
                    <canvas id="doctorDistrictChart"></canvas>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12" style="background:#fff;padding:15px;">
                    <h5>Revenue By District</h5>
                    <hr>
                    <canvas id="visitDistrictChart"></canvas>
                </div>
                <!--  end -->



                {{-- <div class="col-lg-6 col-md-6" style="margin-top:20px;">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h4 class="text-center text-bold">Service Info</h4>
                        </div>
                        <a href="{{url('admin/service')}}" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6" style="margin-top:20px;">
                    <!-- small box -->
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h4 class="text-center text-bold">Financial Info</h4>
                        </div>
                        <a href="{{url('admin/finance')}}" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div> --}}

                    <!-- ./col -->
                </div>
            </section>

            <!-- /.Left col -->

            {{-- Patient information with diagnosis --}}



        </div>
        <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.2.1/Chart.min.js"></script>

<script>
$(document).ready(function() {
    $.ajax({
        url: "patientInfo",
        method: "GET",
        success: function(data) {
            var male = 0,
                female = 0;
            for (var i in data) {
                if (data[i].gender == 'Male') male++;
                else if (data[i].gender == 'Female') female++;
            }

            var chartdata = {
                labels: ['Male', 'Female'],
                datasets: [{
                    label: 'Patient By Sex ',
                    backgroundColor: ["rgb(54, 162, 235)", "rgb(255, 99, 132)"],
                    borderColor: 'rgba(200, 200, 200, 0.75)',
                    hoverBackgroundColor: ["rgb(54, 162, 235)", "rgb(255, 99, 132)"],
                    hoverBorderColor: 'rgba(200, 200, 200, 1)',
                    data: [male, female],
                }]
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
            var general = 0,
                pediatric = 0;
            for (var i in data) {
                if (data[i].doctorType == 'General Practitioner' || data[i].doctorType == 'GENERAL')
                    general++;
                else if (data[i].doctorType == 'PEDIATRIC') pediatric++;
            }

            var chartdata = {
                labels: ['General Practitioner', 'Pediatric'],
                datasets: [{
                    label: 'Doctor By Type ',
                    backgroundColor: ["#4DA660", "#152A45"],
                    borderColor: 'rgba(200, 200, 200, 0.75)',
                    hoverBackgroundColor: ["#4DA660", "#152A45"],
                    hoverBorderColor: 'rgba(200, 200, 200, 1)',
                    data: [general, pediatric],
                }]
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
            var online = 0,
                offline = 0;
            for (var i in data) {
                if (data[i].online == true) online++;
                else if (data[i].online == false) offline++;
            }

            var chartdata = {
                labels: ['Online', 'Offline'],
                datasets: [{
                    label: 'Patient',
                    backgroundColor: [ "rgb(255, 99, 132)","rgb(54, 162, 235)"],
                    borderColor: 'rgba(200, 200, 200, 0.75)',
                    hoverBackgroundColor: ["rgb(255, 99, 132)", "rgb(54, 162, 235)",
                        "rgb(255, 205, 86)"
                    ],
                    hoverBorderColor: 'rgba(200, 200, 200, 1)',
                    data: [online, offline],
                }]
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


    // graph for doctor-count by district
    $.ajax({
        url: "doctorInfoByDistrict",
        method: "GET",
        success: function(data) {

            var val;
            var key;
            key = Object.keys(data);
            val = Object.values(data);
            console.log(val);
            console.log(key);


            var chartdata = {
                labels: key,
                datasets: [{
                    label: 'Doctor',
                    backgroundColor: "#4DA660",
                    borderColor: 'rgba(200, 200, 200, 0.75)',
                    hoverBackgroundColor: "#152A45",
                    hoverBorderColor: 'rgba(200, 200, 200, 1)',
                    data: val,
                }]
            };

            var ctx = $("#doctorDistrictChart");

            var barGraph = new Chart(ctx, {
                type: 'bar',
                data: chartdata
            });
        },
        error: function(data) {
            console.log(data);
        }
    });



    // graph for visit-count by district
    $.ajax({
        url: "visitInfoByDistrict",
        method: "GET",
        success: function(data) {

            var district = [];
            var rev = [];
            // key = Object.keys(data.date);
            // val = Object.values(data.val);
            var i;
            for (i in data) {
                district.push(data[i].date);
                rev.push(data[i].val);
            }



            var chartdata = {
                labels: district,
                datasets: [{
                    label: 'District',
                    backgroundColor: "#4DA660",
                    borderColor: 'rgba(200, 200, 200, 0.75)',
                    hoverBackgroundColor: "#152A45",
                    hoverBorderColor: 'rgba(200, 200, 200, 1)',
                    data: rev,
                }]
            };

            var ctx = $("#visitDistrictChart");

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
</script>

