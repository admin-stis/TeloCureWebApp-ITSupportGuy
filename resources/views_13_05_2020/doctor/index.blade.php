@extends('doctor.layout')

@section('content')
<!-- Content Header (Page header) -->
    @php
        $doctorInfo = Session::get('user');

        if(!isset($doctorInfo[0]['accountName'])){
          $doctorInfo = Session::get('doctor');
        }
        else{
          $doctorInfo = Session::get('user');
        }
        $revenue = json_encode($rev) ;
        //dd($tRev[0]);
    @endphp


    <div class="rev d-none"><?php echo $revenue ; ?></div>
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"  style="float:left;">Dashboard</h1>
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

    {{-- edited --}}
    <span class="uid text d-none">{{$doctorInfo[0]['uid']}}</span>


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

            {{-- calender --}}
            <!-- Left col -->
          <section class="col-md-6 col-sm-12 col-lg-6 connectedSortable">
            <!-- TO DO List -->
            <div class="card  earning-card">
              <!-- /.card-header -->
              <div class="earning-reports">
                  <div class="btn-group w-100 mb-2">
                    <a id="we" class="earning-bar btn btn-default active" href="#weeklyEarning" data-filter="all"><h2>Earnings</h2></a>
                    <a id="stmnts" class="earning-bar btn btn-default" href="#statements" data-filter="1"><h2>Statements</h2></a>
                  </div>
                  <div id="weeklyEarning" style="padding: 50px 15px">
                    <h3>Total Earning</h3>
                    <h2><b>@if(isset($tRev[0])){{$tRev[0]}} Tk @else 0 Tk @endif</b></h2>
                  </div>
                  <div id="statements" style="padding: 50px 15px">
                    <h3>Statement will go there...</h3>
                    {{--<h2><b>50.00 Tk</b></h2>--}}
                  </div>
                  {{--<div id="wEarn" style="padding:0 15px; border-top: 1px solid #fff">
                    <div class="row" style="padding:8px;">
                        <div class="col-md-4" style="border-right: 1px solid #fff">
                          <h4>0</h4>
                          <h4>Completed Trips</h4>
                        </div>
                        <div class="col-md-8">
                          <h4>10hr</h4>
                          <h4>Online Hours</h4>
                        </div>
                      </div>
                  </div>--}}
              </div>
              <a class="btn btn-info active text-left" href="javascript:void(0)" data-filter="all"> Weekly Earnings </a>
              <!-- /.card-body -->

            </div>
            <!-- /.card -->
          </section>

          <section class="col-md-6 col-sm-12 col-lg-6">
            <div class="container">
                <div id="calendar"></div>
               </div>
               <script>
                $(document).ready(function() {
                    var uid = $('.uid').html();
                    var rev = $('.rev').html();
                    rev = JSON.parse(rev);
                    // page is now ready, initialize the calendar...
                    $('#calendar').fullCalendar({
                        header: {
                            left: '',
                            right: 'prev,next today',
                            center: 'title'
                            // right: 'month,week,agendaDay'
                        },
                       events: rev,
                    });
                });
            </script>
          </section>


          <section class="col-lg-12 " style="margin-top: 10px;">
            <!-- TO DO List -->
            <div class="card">
              <div class="row card-header">
                <div class="col-6">
                  <h3 class="card-title">
                    <i class="ion ion-clipboard mr-1"></i>
                    Bank Account Details
                  </h3>
                </div>
                <div class="row col-6">
                <h5 class="alert-info col-md-4 col-sm-8 text-center">Weekly Percut</h5>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <ul class="todo-list" data-widget="todo-list" style="width: 50%; float: left;">

                  <li>
                    <span class="text">Name  of Account Holder</span>
                  </li>
                  <li>
                    <i class="nav-icon fas fa-book mr-1"></i>
                    <span class="text">{{$doctorInfo[0]['accountName']}}</span>
                  </li>

                  <li>
                    <span class="text">Bank Account Number</span>
                  </li>
                  <li>
                    <i class="nav-icon fas fa-book mr-1"></i>
                    {{-- <span class="text">0000 0000 0000 0000</span> --}}
                    <span class="text">{{$doctorInfo[0]['accountNo']}}</span>
                  </li>

                  <li>
                    <span class="text">Address</span>
                  </li>
                  <li>
                    <i class="nav-icon fas fa-book mr-1"></i>
                    <span class="text">{{$doctorInfo[0]['presentAddress']}}</span>
                  </li>

                  <li>
                    <span class="text">State</span>
                  </li>
                  <li>
                    <i class="nav-icon fas fa-book mr-1"></i>
                    <span class="text">{{$doctorInfo[0]['district']}}</span>
                  </li>

                </ul>
                <ul class="todo-list" data-widget="todo-list" style="width: 50%; float: left;">

                  <li>
                    <span class="text">Swift Code / Routing Number</span>
                  </li>
                  <li>
                    <i class="nav-icon fas fa-book mr-1"></i>
                    <span class="text">{{$doctorInfo[0]['swiftCode']}}</span>
                  </li>

                  <li>
                    <span class="text">Date of Birth</span>
                  </li>
                  <li>
                    <i class="nav-icon fas fa-book mr-1"></i>
                    <span class="text">{{$doctorInfo[0]['dateOfBirth']}}</span>
                  </li>

                  <li>
                    <span class="text">City</span>
                  </li>
                  <li>
                    <i class="nav-icon fas fa-book mr-1"></i>
                    <span class="text">{{$doctorInfo[0]['district']}}</span>
                  </li>

                  <li>
                    <span class="text">Postal Code</span>
                  </li>
                  <li>
                    <i class="nav-icon fas fa-book mr-1"></i>
                    <span class="text">{{$doctorInfo[0]['postalCode']}}</span>
                  </li>

                </ul>
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
