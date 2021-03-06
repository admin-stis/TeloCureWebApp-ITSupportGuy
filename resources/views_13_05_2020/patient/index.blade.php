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
              <li class="breadcrumb-item active">Patient</li>
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
                    @php
                       //dd($val);
                    @endphp
                      <li class="col-sm-12">
                        <ul>
                          <li>Date :
                            <a href="{{url('patient/prescription/details/'.$patientData[0]['uid'].'/'.$val['doctorId'].'/'.$val['prescriptionId'])}}">{{$val['createdDate']->get()->format('d-m-y')}}</a>
                          </li>
                        </ul>
                    </li>
                    @endforeach
                </ul><!-- /.card-body -->
                
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                  <a class="btn btn-sm btn-primary  float-right" href="{{url('patient/eprescription/'.$patientData[0]['uid'])}}"><i class="fas fa-edit"></i>  Read more...</a>
                </div>

            </div>
            <!-- /.card -->
          </section>

          <section class="col-lg-12 connectedSortable">
            <!-- TO DO List -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="ion ion-clipboard mr-1"></i>
                  Your Visits
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                      <th class="text-center">Date</th>
                      <th class="text-center">Doctor</th>
                      <th class="text-center">Rating</th>
                      <th class="text-center">Duration</th>
                      <th class="text-center">Cost</th>
                      {{--<th class="text-center">Diagnosis</th>--}}
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($visits as $key=>$visit)

                            @php
                                $totalCount = $visit['doctor']['totalCount'];
                                $totalRating = $visit['doctor']['totalRating'];

                                $date_a = new DateTime($visit['callStartTime']);
                                $date_b = new DateTime($visit['callEndTime']);

                                $interval = date_diff($date_b,$date_a);
                                echo '<tr>';
                                echo '<td>'.$visit['callStartTime']->get()->format('d-m-Y').'</td>';
                                echo '<td>'.$visit['doctor']['name'].'</td>';
                                if($totalRating != 0 && $totalCount != 0){
                                    $rating = $totalRating/$totalCount;
                                    echo '<td>'.$rating.'</td>';
                                }else{
                                    echo '<td>0</td>';
                                }
                                echo '<td>'.$interval->format("%H:%I:%S").'</td>';
                                if(isset($visit['transactionHistory']['subTotalRounded'])){
                                    $rating = $totalRating/$totalCount;
                                    echo '<td>'.$visit['transactionHistory']['subTotalRounded'].' Tk</td>';
                                }else{
                                    echo '<td>0 Tk</td>';
                                }
                                //echo '<td><a class="btn btn-small btn-info"><i class="fa fa-eye"></i> 
                                //View</a></td>';
                                echo '</tr>';
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
     @endsection
