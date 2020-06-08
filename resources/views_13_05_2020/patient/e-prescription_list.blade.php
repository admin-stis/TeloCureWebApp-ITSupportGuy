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


                        @php 
                            $oldDate = strtotime($val['createdDate']->get()->format('m/d/Y'));
                            $newDate = date('m/d/Y',strtotime('+30 days',$oldDate));
                        @endphp


                        <tr>
                            <td>{{$val['createdDate']->get()->format('d-m-Y')}}</td>
                            <td>{{$doctor[0]['name']}}</td>
                            <td><a href="{{url('patient/diagnosis/'.$patient[0]['uid'].'/'.$doctor[0]['uid'].'/'.$val['prescriptionId'])}}">View</a></td> {{--Diagnosis infomation--}}
                            <td>
                              @if($oldDate <= $newDate) Validate
                              @else Expired
                              @endif
                            </td>
                            <td><a href="{{url('patient/prescription/details/'.$patient[0]['uid'].'/'.$doctor[0]['uid'].'/'.$val['prescriptionId'])}}">Details</a></td>
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
