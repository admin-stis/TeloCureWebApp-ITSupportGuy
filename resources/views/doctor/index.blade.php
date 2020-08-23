@extends('doctor.layout')

@section('content')
<!-- Content Header (Page header) -->
@php
$revenue = json_encode($rev) ;

//-----------------------------------------------
$todayData=0;
$curWeekData=0;
$curMonthData=0;
$curYearData=0;

$today=date('Y-m-d');

$start_date = new \DateTime(date('Y-m-d'));

$day_of_week = $start_date->format("w");

$curWeek=date('Y-m-d', strtotime("-$day_of_week days", strtotime(date('Y-m-d'))));

$curMonth=date('Y-m');

$curYear=date('Y');

$dailyIncome = 0 ;
$weeklyIncome = 0 ;
$monthlyIncome = 0 ;
$yearlyIncome = 0;

for($i = 0; $i < count($rev); $i++) { $income=intval(substr($rev[$i]['title'],0,-2)); $rKey=$rev[$i]['start'];
    $rKeyDate=explode('-', $rKey); if($rev[$i]['start']==$today){ $dailyIncome +=$income; } if($rev[$i]['start']>=
    $curWeek){
    $weeklyIncome += $income;
    }

    if($curMonth == ($rKeyDate[0].'-'.$rKeyDate[1])){
    $monthlyIncome += $income;
    }

    if($curYear==$rKeyDate[0]){
    $yearlyIncome += $income;
    }

    }
    //------------------------------------------------------------------------

    <!-- 
        This is new Hello  -->

    @endphp


    <div class="rev d-none"><?php echo $revenue ; ?></div>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark" style="float:left;">Dashboard</h1>
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
    <span class="uid text d-none">{{$doctorInfo['uid']}}</span>

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
            <div class="row" style="">

                {{-- calender --}}
                <!-- Left col -->
                <section class="col-md-6 col-sm-12 col-lg-6">
                    <!-- TO DO List -->
                    <div class="card  earning-card" style="height:100%;">
                        <!-- /.card-header -->
                        <div class="earning-reports">
                            <div class="btn-group w-100 mb-2">
                                <a id="we" class="col-sm-6 col-md-12 earning-bar btn btn-default active"
                                    href="#weeklyEarning" data-filter="all">
                                    <h4>Earnings</h4>
                                </a>
                                <a id="stmnts" class="col-sm-6 col-md-12 earning-bar btn btn-default" href="#statements"
                                    data-filter="1">
                                    <h4>Statements</h4>
                                </a>
                            </div>
                            <div id="weeklyEarning" style="padding: 50px 15px">
                                <h2>Total Earning : @if(isset($tRev[0])){{$tRev[0]}} Tk @else 0 Tk @endif</h2>
                                <hr>

                                <ul class="todo-list" data-widget="todo-list" style="width: 100%; float: left;">

                                    <li>
                                        <span class="text  col-md-7 col-sm-12">Today's Income</span>
                                        <span class="">:</span>
                                        <span class="text  col-md-4 col-sm-12">{{$dailyIncome}} Tk</span>
                                    </li>
                                    <li>
                                        <span class="text  col-md-7 col-sm-12">Income in this week</span>
                                        <span class="">:</span>
                                        <span class="text  col-md-4 col-sm-12">{{$weeklyIncome}} Tk</span>
                                    </li>
                                    <li>
                                        <span class="text  col-md-7 col-sm-12">Monthly Income</span>
                                        <span class="">:</span>
                                        <span class="text  col-md-4 col-sm-12">{{$monthlyIncome}} Tk
                                        </span>

                                    </li>
                                    <li>
                                        <span class="text  col-md-7 col-sm-12">Yearly Income : </span>
                                        <span class="">:</span>
                                        <span class="text  col-md-4 col-sm-12">{{$yearlyIncome}} Tk</span>
                                    </li>

                                </ul>

                            </div>
                            <div id="statements" style="padding: 50px 15px">
                                <h4>Earning List</h4>
                                <br>
                                <table class="table table-condensed">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Earning</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($rev as $item)
                                        <tr>
                                            <td>{{$item['start']}}</td>
                                            <td>{{$item['title']}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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
                        {{-- <a class="btn btn-info active text-left" href="javascript:void(0)" data-filter="all"> Weekly Earnings </a> --}}
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
                                center: 'title',
                                //left: 'month,week,agendaDay'
                            },
                            events: rev,
                        });
                    });
                    </script>
                </section>

                @if(Session::has('profile-success'))
                <section class="col-md-12 col-lg-12 colsm-12" style="margin-top: 10px;">
                    <ul>
                        <p class="alert {{ Session::get('alert-class', 'alert-success') }}">
                            {{ Session::get('profile-success') }}</p>
                    </ul>
                </section>
                @endif

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
                                    <span class="text col-md-5 col-sm-12">Account Holder Name</span>
                                    <span class="">:</span>
                                    <span class="text col-md-6 col-sm-12">
                                        @if(isset($bank_info['accountName']))
                                        {{$bank_info['accountName']}}
                                        @endif
                                    </span>
                                </li>
                                {{-- <li>
                    <i class="nav-icon fas fa-book mr-1"></i>
                    <span class="text">{{$doctorInfo[0]['accountName']}}</span>
                                </li> --}}

                                <li>
                                    <span class="text  col-md-5 col-sm-12">Bank Account Number</span>
                                    <span class="">:</span>
                                    {{-- <span class="text col-md-6 col-sm-12">{{$bank_info['accountNo']}}</span> --}}
                                    <span class="text col-md-6 col-sm-12">
                                        @if(isset($bank_info['accountNumber'])){{$bank_info['accountNumber']}}
                                        @endif</span>
                                </li>

                                <li>
                                    <span class="text   col-md-5 col-sm-12">Address</span>
                                    <span class="">:</span>
                                    <span class="text   col-md-6 col-sm-12">
                                        @if(isset($others['presentAddress'])){{$others['presentAddress']}}
                                        @else N/A
                                        @endif
                                    </span>
                                </li>
                                <li>
                                    <span class="text col-md-5 col-sm-12">State</span>
                                    <span class="">:</span>
                                    <span
                                        class="text col-md-6 col-sm-12">@if(isset($doctorInfo['district'])){{$doctorInfo['district']}}
                                        @endif</span>
                                </li>

                            </ul>
                            <ul class="todo-list" data-widget="todo-list" style="width: 50%; float: left;">

                                <li>
                                    <span class="text  col-md-7 col-sm-12">Swift Code / Routing Number</span>
                                    <span class="">:</span>
                                    <span
                                        class="text  col-md-4 col-sm-12">@if(isset($bank_info['swiftCode'])){{$bank_info['swiftCode']}}@endif</span>
                                </li>
                                <li>
                                    <span class="text  col-md-7 col-sm-12">Date of Birth</span>
                                    <span class="">:</span>
                                    <span
                                        class="text  col-md-4 col-sm-12">@if(isset($doctorInfo['dateOfBirth'])){{$doctorInfo['dateOfBirth']}}@endif</span>
                                </li>
                                <li>
                                    <span class="text  col-md-7 col-sm-12">City</span>
                                    <span class="">:</span>
                                    <span class="text  col-md-4 col-sm-12">
                                        @if(isset($doctorInfo['district'])){{$doctorInfo['district']}}
                                        @else N/A
                                        @endif
                                    </span>

                                </li>
                                {{--<li>
                    <span class="text  col-md-7 col-sm-12">Postal Code</span>
                    <span class="">:</span>
                    <span class="text  col-md-4 col-sm-12">{{$doctorInfo['postalCode']}}</span>
                                </li>--}}
                                <li>
                                    <span class="text  col-md-7 col-sm-12">Postal Code</span>
                                    <span class="">:</span>
                                    <span
                                        class="text  col-md-4 col-sm-12">@if(isset($doctorInfo['districtId'])){{$doctorInfo['districtId']}}@endif</span>
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