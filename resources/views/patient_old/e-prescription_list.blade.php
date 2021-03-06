@extends('patient.layout')

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
              <li class="breadcrumb-item active">E-preacription</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
      <div class="center" style="text-align:center;color:red">
      @if(Auth::check() && !Auth::user()->hasVerifiedEmail())
        <p class="alert alert-danger">Please verify your email address. An email containing verification instructions was sent to {{ Auth::user()->email }}.</p>
      @endif
    </div>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-5 connectedSortable">
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
                <ul class="todo-list" data-widget="todo-list">

                  <li>
                    <span class="handle">
                      <i class="fas fa-ellipsis-v"></i>
                      <i class="fas fa-ellipsis-v"></i>
                    </span>
                    <span class="text">Name  : {{$patientData[0]['name']}}</span>
                  </li>

                  <li>
                    <span class="handle">
                      <i class="fas fa-ellipsis-v"></i>
                      <i class="fas fa-ellipsis-v"></i>
                    </span>
                    <span class="text">Designation MBBS</span>
                  </li>

                  <li>
                    <span class="handle">
                      <i class="fas fa-ellipsis-v"></i>
                      <i class="fas fa-ellipsis-v"></i>
                    </span>
                    <span class="text">Cell : {{$patientData[0]['phone']}}</span>
                  </li>

                  <li>
                    <span class="handle">
                      <i class="fas fa-ellipsis-v"></i>
                      <i class="fas fa-ellipsis-v"></i>
                    </span>
                    <span class="text">Blood Group @if(isset($patientData[0]['bloodGroup'])) {{$patientData[0]['bloodGroup']}} @else N/A @endif</span>
                  </li>

                  <li>
                    <span class="handle">
                      <i class="fas fa-ellipsis-v"></i>
                      <i class="fas fa-ellipsis-v"></i>
                    </span>
                    <span class="text">Date of Birth  @if(isset($patientData[0]['dateOfBirth'])) {{$patientData[0]['dateOfBirth']}} @else N/A @endif</span>
                  </li>

                </ul>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <a href="{{'patient/edit/'.$patientData[0]['uid']}}" class="btn btn-sm btn-info float-right">
                    <i class="fas fa-edit"></i> Edit</a>
              </div>
            </div>
            <!-- /.card -->
          </section>

          <section class="col-lg-7 connectedSortable">
            <!-- TO DO List -->
            <div class="card" style="min-height: 370px !important;">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="ion ion-clipboard mr-1"></i>
                  E-Prescription
                </h3>
              </div>
              <!-- /.card-header -->

              <div class="card-body">
                <ul class="row todo-list" data-widget="todo-list">
                    @foreach($pres as $key => $val)
                      <li class="col-sm-12">
                        <ul>
                          <li>
                            <a href="{{url('patient/prescription/details/'.$val['prescriptionId'])}}">{{$val['prescriptionId']}}</a>
                          </li>
                        </ul>
                    </li>
                    @endforeach
                </ul>
              </div>
              <!-- /.card-body -->

            </div>
            <!-- /.card -->
          </section>

          <section class="col-lg-12 connectedSortable">
            <!-- TO DO List -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="ion ion-clipboard mr-1"></i>
                  Prescription List
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                      <th class="text-center">Date</th>
                      <th class="text-center">Doctor</th>
                      <th class="text-center">Diagnosis</th>
                      <th class="text-center">Status</th>
                      <th class="text-center">view</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($pres as $key=>$val)

                        <tr>
                            <td>{{$val['callStartTime']->get()->format('d-m-Y')}}</td>
                            <td>{{$doctor[0]['name']}}</td>
                            <td><a href="{{url('patient/prescription/details/'.$val['prescriptionId'])}}">View</a></td> {{--Diagnosis infomation--}}
                            <td></td>
                            <td><a href="{{url('patient/prescription/details/'.$val['prescriptionId'])}}">Details</a></td>

                        </tr>

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
     @endsection
