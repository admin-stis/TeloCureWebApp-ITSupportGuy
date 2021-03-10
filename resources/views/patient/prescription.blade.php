@extends('patient.layout')

@section('content')
<!-- Content Header (Page header) -->
    @php
        //dd($doctorInfo['phone']);
        // $doctorInfo = Session::get('user');

        // if(!isset($doctorInfo[0]['accountName'])){
        //   $doctorInfo = Session::get('doctor');
        // }
        // else{
        //   $doctorInfo = Session::get('user');
        // }
        //$revenue = json_encode($rev) ;
        //dd($doctor['hospitalized']);
    @endphp

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"  style="float:left;">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('patient')}}">Home</a></li>
              <li class="breadcrumb-item active">Prescription</li>
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
        <div class="row" style="">



          <section class="col-lg-12 " style="margin-top: 10px;">
            <!-- TO DO List -->
            <div class="card">
              <div class="row card-header">
                <div class="col">
                  <h3 class="card-title">
                    <i class="ion ion-clipboard mr-1"></i>
                    Prescription
                  </h3>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body row">
                <div class="col-sm-12 col-md-6 col-lg-6 todo-list connectedSortable"  data-widget="todo-list" style="border-right:1px solid;padding: 10px;margin-top: 20px;">

                <h5>Diagnosis Information</h5>
                <hr>
                @php
                  $pres['vital'] = json_decode($pres[0]['vital'],TRUE);
                  $pres['medicineMap'] = json_decode($pres[0]['medicineMap'],TRUE);
                @endphp
                <ul class="todo-list" data-widget="todo-list">
                  <li><span class="">Blood Pressure : @if($pres['vital']['bpm']){{$pres['vital']['bpm']}} @else N/A @endif</span></li>

                  {{--<li><span class="">Measure Time : @if($pres['vital']['measureTime']){{$pres['vital']['measureTime']->get()->format('d-m-Y')}}  @else N/A @endif</span></li>--}}

                  <li><span class="">Measure Time : @if($pres['vital']['measureTime']){{$pres['vital']['measureTime']}}  @else N/A @endif</span></li>

                  <li><span class="">Respiration : @if($pres['vital']['resp']){{$pres['vital']['resp']}} @else N/A @endif</span></li>

                  <li><span class="">Temparature : @if($pres['vital']['temp']){{$pres['vital']['temp']}} @else N/A @endif</span></li>
                </ul>

              </div>

              <div class="col-sm-12 col-md-6 col-lg-6 todo-list connectedSortable"  data-widget="todo-list" style="padding: 10px;margin-top: 20px;">

                      @php //dd($presDoc); @endphp
                <h5>Disease : @if(isset($pres[0]['disease'])) {{$pres[0]['disease']}} @else N/A @endif</h4>
                <hr>
                <h4>Medicine</h4>
                  {{-- <div>Medicine Name : {{$val['name']}}</div>
                  <hr>
                  <h5>Medicine Time</h5>
                  <ul class="todo-list" data-widget="todo-list">
                    <li><span>Morning : {{$val['morning']}}</span></li>
                    <li><span>Noon : {{$val['noon']}}</span></li>
                    <li><span>Night : {{$val['night']}}</span></li>
                  </ul>
                  <hr> --}}
                  {{-- mridul addition --}}

                  <table class="table table-bordered" style="margin-top:20px;">
                      <thead class="thead-light">
                          <tr class="">
                                <th rowspan="2" colspan="1">
                                    Medicine
                                </th>

                                <th rowspan="1" colspan="3" style="text-align:center;">
                                    Medicine time
                                </th>

                            </tr>
                            <tr class="">
                                <th>Morning</th>
                                <th>Noon</th>
                                <th>Night</th>
                            </tr>
                      </thead>
                      <tbody>
                      @foreach($pres['medicineMap'] as $key => $val)
                            <tr class="table-default">
                              <th scope="row">{{$val['name']}}</th>
                              <td>{{$val['morning']}}</td>
                              <td>{{$val['noon']}}</td>
                              <td>{{$val['night']}}</td>
                            </tr>
                     @endforeach
                      </tbody>
                </table>
              </div>
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
