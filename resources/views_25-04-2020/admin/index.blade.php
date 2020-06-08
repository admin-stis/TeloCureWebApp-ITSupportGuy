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
              <li class="breadcrumb-item"><a href="#">Home</a></li>
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
        <div class="row">

          <!-- ./col -->
          <div class="col-lg-4 col-12">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h4 class="text-center text-bold">Total Doctors Active</h4>
                <h3>{{$activeDoctor}}</h3>
              </div>
              <div class="icon">
                <i class="fas fa-stethoscope"></i>
              </div>
              <a href="{{url('admin/doctor')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-12">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h4 class="text-center text-bold">Total Registered Patients</h4>
                <h3>{{$totalPatient}}</h3>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="{{url('admin/patient')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-12">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h4 class="text-center text-bold text-white">Total Hospital Registered</h4>
                <h3  class="text-white">N/A</h3>
              </div>
              <div class="icon">
                <i class="fa fa-hospital"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>



        {{-- charts --}}

        <div class="row">
            <!-- ./col -->
            <div class="col-lg-4 col-12">
              <!-- small box -->
              <canvas id="bar-chart" width="800" height="450"></canvas>
            </div>
            <!-- ./col -->
            <div class="col-lg-4 col-12">
              <!-- small box -->

              <canvas id="pie-chart"></canvas>
            </div>
            <!-- ./col -->
            <div class="col-lg-4 col-12">
                <!-- small box -->

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
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
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
        // Bar chart
        new Chart(document.getElementById("bar-chart"), {
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
                text: 'Patient List (Dummy)'
            }
            }
        });

        new Chart(document.getElementById("line-chart"), {
            type: 'line',
            data: {
            labels: ["January", "February", "March", "April", "May","June","July"],
            datasets: [
                {
                label: "Hospital",
                backgroundColor: ["#3e95cd"],
                data: [2478,5267,734,784,433,500,600]
                }
            ]
            },
            options: {
            legend: { display: false },
            title: {
                display: true,
                text: 'Hospital List (Dummy)'
            }
            }
        });

    </script>

     @endsection
