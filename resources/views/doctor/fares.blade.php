@extends('doctor.layout')

@section('content')
<!-- Content Header (Page header) -->
    @php
        //dd($doctorInfo['phone']);
        //$doctorInfo = Session::get('user');

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
              <li class="breadcrumb-item"><a href="{{url('doctor')}}">Home</a></li>
              <li class="breadcrumb-item active">Visits</li>
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

            {{-- <section class="col-lg-12" style="margin-top:10px;">
                <div class="row">


                    <!-- ./col -->
                    <div class="col-lg-4 col-12">
                      <!-- small box -->
                      <div class="small-box bg-info">
                        <div class="inner">
                          <h5 class="text-center text-bold">Visits</h5>
                          <h3>N/A</h3>
                        </div>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-4 col-12">
                      <!-- small box -->
                      <div class="small-box bg-warning">
                        <div class="inner">
                          <h5 class="text-center text-bold text-white">Lifetime Visits</h5>
                          <h3  class="text-white">N/A</h3>
                        </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-12">
                      <!-- small box -->
                      <div class="small-box bg-secondary">
                        <div class="inner" style="padding:21px;">
                          <h5 class="text-center text-bold text-white">Ratings</h5>
                          <h3  class="text-white">N/A</h3>
                        </div>
                        </div>
                    </div>
                    <!-- ./col -->
                  </div>
            </section> --}}

          <section class="col-lg-12 " style="margin-top: 10px;">
            <!-- TO DO List -->
            <div class="card">
              <div class="row card-header">
                <div class="col">
                  <h3 class="card-title">
                    <i class="ion ion-clipboard mr-1"></i>
                    Visits Information
                  </h3>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

                <div class="row">
                    <input id="search" type="text" class="col-md-4 col-lg-4 form-control"  placeholder="Search..."/>
                </div>

                <div class="col-md-6 col-lg-6 jquery-script-clear"></div>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td>Sl</td>
                            <td>Patient Name</td>
                                    <td>Phone</td>
                                    <td>Gender</td>
                                    <td>District</td>
                                    <td>Prescription</td>
                                    @if(isset($doctorInfo['hospitalized']) && $doctorInfo['hospitalized'] == 'false')
                                    <td>Visit Fee</td>
                                    <td>Discount</td>
                                    <td>Total</td>
                                    @endif
                                    <td>Date</td>

                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 0; @endphp
                        @foreach ($fares as $item)

                        @php
                            $i++;
                            //dd($item);
                            $patient = json_decode($item['patient'],TRUE);
                            //$doctor = json_decode($item['doctor'],TRUE);
                            $patient = json_decode($item['patient'],TRUE);
                            if(isset($item['transactionHistory'])){
                              $transactionHistory = json_decode($item['transactionHistory'],TRUE);
                            }
                            //dd($doctor['hospitalized']);
                            $date = date('d-m-Y',strtotime($item['created_at']));
                        @endphp
                        <tr>
                            <td>{{$i}}</td>
                            <td>{{$patient['name']}}</td>
                            <td>{{$patient['phone']}}</td>
                            <td>{{$patient['gender']}}</td>
                            <td>{{$patient['district']}}</td>
                            <td>
                              @if(isset($item['prescriptionId']))
                              <a href="{{url('doctor/prescription/'.$item['patientUid'].'/'.$item['doctorUid'].'/'.$item['prescriptionId'])}}">View</a>
                              @else N/A
                              @endif
                            </td>
                            @if(isset($doctorInfo['hospitalized']) && $doctorInfo['hospitalized'] == 'false')
                            <td>@if($transactionHistory['visitFee']) {{$transactionHistory['visitFee']}} Tk @else 0Tk @endif</td>
                            <td>@if($transactionHistory['discountPercentage']){{$transactionHistory['discountPercentage']}} % @else 0% @endif </td>
                            <td>@if($transactionHistory['subTotal']){{$transactionHistory['subTotal']}} Tk @else 0Tk @endif</td>
                            @endif
                            {{-- <td>{{$item['transactionHistory']['createdDate']->get()->format('Y-m-d')}}</td> 
                            <td>{{$item['callStartTime']->get()->format('Y-m-d')}}</td> --}}
                            <td>{{$date}}</td>
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

    <script type="text/javascript">
      $(document).ready(function(){
        $("#search").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("tbody tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });

    $(document).ready(function () {
        $('table').paginate({
            'elemsPerPage': 10,
                'maxButtons': 6
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
