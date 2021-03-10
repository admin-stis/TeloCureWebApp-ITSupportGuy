@extends('admin.layout')
@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Dashboard</h1>
                </div>
                <!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('admin') }}">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- Left col -->
                <section class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="col-md-12">
                                <span class=""><i class="fas fa-list mr-1"></i>Financial Information</span>
                            </div>
                            <div class="col-md-6">
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content p-0">
                                <!-- Morris chart - Sales -->
                                <div class="chart tab-pane active" id="revenue-chart"
                                    style="position: relative; overflow-x: auto;">
                                    <div class="row">
                                        <input id="search" type="text" class="col-md-4 col-lg-4 form-control"
                                            placeholder="Search..." />
                                        <div id="reportrange"
                                            style="background: #fff; cursor: pointer; padding: 5px 10px; margin:0 5px 0 5px; border: 1px solid #ccc;">
                                            <i class="fa fa-calendar"></i>&nbsp;<span>Select Date Range</span> <i
                                                class="fa fa-caret-down"></i>
                                        </div>
                                    </div>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Visit ID</th>
                                                <th>Total</th>
                                                <th>Doctor</th>
                                                <th>Patient</th>
                                                <th>Patient District</th>
                                                <th>Transaction Refund</th>
                                                <th>Patient Phone</th>
                                                <th>Call Start Time</th>
                                                <th>Total time (minutes: seconds)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $frb_tz = new \DateTimeZone('Asia/Dhaka'); @endphp
                                            @foreach ($visitArr as $item)
                                                @php
                                                    //$date = $item['callStartTime']->get()->format('d-m-Y');
                                                @endphp
                                                <tr>
                                                    <td>{{ $item['visitId'] }}</td>
                                                    <td>{{ $item['transactionHistory']['subTotalRounded'] }} Tk</td>
                                                    <td>{{ $item['doctor']['name'] }}</td>
                                                    <td>{{ $item['patient']['name'] }}</td>
                                                    <td>{{ $item['patient']['district'] }}</td>
                                                    <td>
                                                        @if ($item['transactionHistory']['refundAmount'] != 0)
                                                        {{ $item['transactionHistory']['refundAmount'] }} Tk @else 0Tk
                                                        @endif
                                                    </td>
                                                    <td>{{ $item['patient']['phone'] }}{{-- @if (isset($item['transactionHistory']['cardType']) && $item['transactionHistory']['cardType'] != 0) {{$item['transactionHistory']['cardType']}} Tk @else N/A @endif --}}</td>
                                                    <td>
                                                        @php
                                                            
                                                            $frb_date = new \DateTime($item['callStartTime']);
                                                            $frb_date->setTimezone($frb_tz);
                                                            echo $frb_date->format('d-m-Y  h:i:s A');
                                                            
                                                        @endphp
                                                        <input type="hidden" class="date_val"
                                                            value="{{ $frb_date->format('d/m/Y') }}" />
                                                    </td>
                                                    <td>
                                                        @if (isset($item['transactionHistory']))
                                                            @php
                                                                $finalMinutes = 0;
                                                                $tempTime = $item['transactionHistory']['totalTimeInSeconds'];
                                                                if ($tempTime < 60) {
                                                                    $finalMinutes = '0:' . $tempTime;
                                                                } else {
                                                                    $tempMin = (int) ($tempTime / 60); // get minutes
                                                                    $tempSec = (int) fmod($tempTime, 60); //get remainder means the remaining seconds
                                                                    if ($tempSec == 0) {
                                                                        $tempSec = '';
                                                                    } else {
                                                                        $tempSec = ':' . $tempSec;
                                                                    }
                                                                    $finalMinutes = $tempMin . $tempSec;
                                                                }
                                                            @endphp

                                                            {{ $finalMinutes }}

                                                        @else
                                                            @if (isset($item['callEndTime']))

                                                                @php
                                                                    $start_date = new \DateTime($item['callStartTime']);
                                                                    $end_date = new \DateTime($item['callEndTime']);
                                                                    $diffSeconds = $end_date->getTimestamp() - $start_date->getTimestamp();
                                                                    
                                                                    $finalMinutes = 0;
                                                                    $tempTime = $diffSeconds;
                                                                    if ($tempTime < 60) {
                                                                        $finalMinutes = '0:' . $tempTime;
                                                                    } else {
                                                                        $tempMin = (int) ($tempTime / 60); // get minutes
                                                                        $tempSec = (int) fmod($tempTime, 60); //get remainder means the remaining seconds
                                                                        if ($tempSec == 0) {
                                                                            $tempSec = '';
                                                                        } else {
                                                                            $tempSec = ' : ' . $tempSec;
                                                                        }
                                                                        $finalMinutes = $tempMin . $tempSec;
                                                                    }
                                                                @endphp

                                                                {{ $finalMinutes }} (calculated)

                                                            @else
                                                                Call not ended
                                                            @endif

                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="col-md-6 col-lg-6 jquery-script-clear"></div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>

                </section>

                {{-- <section class="col-lg-5">
            <div class="card">
               <div class="card-header">
                  <div class="col-md-12">
                     <span class=""><i class="fas fa-list mr-1"></i>Financial Information</span>
                  </div>
                  <div class="col-md-6">
                  </div>
               </div>
               <!-- /.card-header -->
               <div class="card-body">
                  <div class="tab-content p-0">
                     <!-- Morris chart - Sales -->
                     <div class="chart tab-pane active" id="revenue-chart"
                        style="position: relative;">
                        <div class="row">
                           <input id="search" type="text" class="col-md-4 col-lg-4 form-control"  placeholder="Search..."/>
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Calls</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    print_r(array_keys($dateArr));
                                    print_r(array_values($dateArr));

                                    for($i= 0; $i < count($dateArr); $i++ ){
                                        <tr></tr>
                                    }

                                @endphp

                            </tbody>
                        </table>
                        <div class="col-md-6 col-lg-6 jquery-script-clear"></div>
                     </div>
                  </div>
               </div>
               <!-- /.card-body -->
            </div>

         </section> --}}

            </div>
        </div>
    </section>

    <script type="text/javascript">
        $(document).ready(function() {
            $("#search").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("tbody tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });

    </script>

@endsection
