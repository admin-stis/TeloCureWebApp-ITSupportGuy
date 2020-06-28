@extends('hospital.layout')

@section('content')

@php
    //dd($info);
@endphp
 <!-- Content Header (Page header) -->
 <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark" style="float:left;">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('hospital')}}">Home</a></li>
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
       <!-- Small boxes (Stat box) -->
      <div class="row">
        <!-- ./col -->
        <div class="col-lg-6">
            <div class="card" style='min-height:415px;'>
                <div class="card-header">Total calls and revenue</div>
                <div class="card-body">
                    <ul class="todo-list" data-widget="todo-list" style="width: 100%; float: left;margin-top:25%;">

                        <li>
                          <span class="text  col-md-7 col-sm-12">Total Call</span>
                          <span class="">:</span>
                          <span class="text  col-md-4 col-sm-12">
                              @if(isset($info[0]['calls']))
                                {{$info[0]['calls']}}
                              @else
                                0
                              @endif
                           </span>
                        </li>
                        <li>
                          <span class="text  col-md-7 col-sm-12">Total Revenue</span>
                          <span class="">:</span>
                          <span class="text  col-md-4 col-sm-12">
                            @if(isset($info[0]['totalRev']))
                                {{$info[0]['totalRev']}} Tk
                            @else 0 Tk
                            @endif
                            </span>
                        </li>

                      </ul>

                </div>
                <div class="card-footer"></div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">Hospital Revenue By Date</div>
                <div class="card-body">
                    Date : <input id="date" type="date" class="form-control" name="revDate"/>
                    <p id="hosId" style="display:none;" value="@if(isset($info[0]['id'])){{$info[0]['id']}}@endif"></p>
                    <canvas id="mycanvas"></canvas>
                </div>
                <div class="card-footer"></div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">Hospital Revenue By Month</div>
                <div class="card-body">
                    Month : <input id="date_month" type="month"  class="form-control" name="revDate"/>
                    <canvas id="monthCanvas"></canvas>
                </div>
                <div class="card-footer"></div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">Hospital Revenue By Year</div>
                <div class="card-body">
                    Year : <input id="year" type="year" name="revDate" class="form-control"/>
                    <canvas id="yearCanvas"></canvas>
                </div>
                <div class="card-footer"></div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">Summary</div>
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
                                      <th>Doctor</th>
                                      <th>Phone</th>
                                      <th>Calls</th>
                                      <th>Revenue</th>
                                    </tr>
                              </thead>
                              <tbody>
                                @php
                                    //dd($summary);
                                @endphp
                                  @php $i = 0 ; @endphp
                                  @foreach ($summary as $item)

                                      <tr class="table">
                                          <td>{{$item['doctor']}}</td>
                                          <td>{{$item['phone']}}</td>
                                          <td>{{$item['calls']}}</td>
                                          <td>{{$item['revenue']}} Tk</td>
                                      </tr>
                                      @php $i = 1 ; @endphp
                                  @endforeach
                              </tbody>
                          </table>
                          <div class="col-md-6 col-lg-6 jquery-script-clear"></div>
                       </div>
                    </div>
                 </div>
                <div class="card-footer"></div>
            </div>
        </div>

      </div>
    </div>
    <input type="hidden" id="today" value="<?php echo date('Y-m-d');?>"/>
    @php
        $d = strtotime(date('Y-m-d'));
        $oldmonth = date('Y-m', $d);
        $oldyear = date('Y',$d);
    @endphp
    <input type="hidden" id="oldmonth" value="<?php echo $oldmonth ;?>"/>
    <input type="hidden" id="oldYear" value="<?php echo $oldyear ;?>"/>
  </section>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.2.1/Chart.min.js"></script>

    <script>
        $(document).ready(function(){
            var oldDate = $('#today').val();
            $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                    url: "/hospital/revenue/"+oldDate,
                    method: "get",
                    success: function(data) {
                        //alert(data);
                        //console.log(data);
                        var dates = [];
                        var amount = [];

                        for(var i in data) {
                            var val = 0 ;
                            dateData = new Date((data[i].date));
                            dates.push(data[i].date);
                            amount.push(data[i].rev);
                        }

                        if(dates.length == 0){
                            dates = [0];
                        }
                        if(amount.length == 0){
                            amount = [0];
                        }

                        var chartdata = {
                            labels: dates,
                            datasets : [
                            {
                                label: 'Revenue ',
                                backgroundColor: '#17a2b8',
                                borderColor: 'rgba(200, 200, 200, 0.75)',
                                //hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
                                //hoverBorderColor: 'rgba(200, 200, 200, 1)',
                                data: amount,
                                options: {
                                    hover: {mode: null},
                                    scales: {
                                        xAxes: [{
                                            type: 'time',
                                            distribution: 'series',
                                            time: {
                                            displayFormats: {
                                                quarter: 'MMM YYYY'
                                            }
                                    }
                                        }]
                                    }
                                }
                            }
                            ]
                        };

                        var ctx = $("#mycanvas");

                        var barGraph = new Chart(ctx, {
                            type: 'bar',
                            data: chartdata
                        });
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });


            $('#date').on('change',function(){
                var date = $('#date').val();
                console.log(date);
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                    url: "/hospital/revenue/"+date,
                    method: "get",
                    success: function(data) {
                        //alert(data);
                        //console.log(data);
                        var dates = [];
                        var amount = [];

                        for(var i in data) {
                            var val = 0 ;
                            dateData = new Date((data[i].date));
                            dates.push(data[i].date);
                            amount.push(data[i].rev);
                        }

                        if(dates.length == 0){
                            dates = [0];
                        }
                        if(amount.length == 0){
                            amount = [0];
                        }

                        var chartdata = {
                            labels: dates,
                            datasets : [
                            {
                                label: 'Revenue ',
                                backgroundColor: '#17a2b8',
                                borderColor: 'rgba(200, 200, 200, 0.75)',
                                //hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
                                //hoverBorderColor: 'rgba(200, 200, 200, 1)',
                                data: amount,
                                options: {
                                    hover: {mode: null},
                                    scales: {
                                        xAxes: [{
                                            type: 'time',
                                            distribution: 'series',
                                            time: {
                                            displayFormats: {
                                                quarter: 'MMM YYYY'
                                            }
                                    }
                                        }]
                                    }
                                }
                            }
                            ]
                        };

                        var ctx = $("#mycanvas");

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

            var oldMonth = $('#oldmonth').val();
            $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                    url: "/hospital/revenuebymonth/"+oldMonth,
                    method: "get",
                    success: function(data) {
                        var dates = [];
                        var amount = [];

                        for(var i in data) {
                            var val = 0 ;
                            dateData = new Date((data[i].date));
                            dates.push(data[i].date);
                            amount.push(data[i].rev);
                        }

                        var chartdata = {
                            labels: dates,
                            datasets : [
                            {
                                label: 'Revenue',
                                backgroundColor: '#17a2b8',
                                borderColor: 'rgba(200, 200, 200, 0.75)',
                                //hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
                                //hoverBorderColor: 'rgba(200, 200, 200, 1)',
                                data: amount,
                                options: {
                                    hover: {mode: null},
                                    scales: {
                                        xAxes: [{
                                            type: 'time',
                                            distribution: 'series',
                                            time: {
                                            displayFormats: {
                                                quarter: 'MMM YYYY'
                                            }
                                    }
                                        }]
                                    }
                                }
                            }
                            ]
                        };

                        var ctx = $("#monthCanvas");

                        var barGraph = new Chart(ctx, {
                            type: 'bar',
                            data: chartdata
                        });
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });

            $('#date_month').on('change',function(){
                var month = $('#date_month').val();
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                    url: "/hospital/revenuebymonth/"+month,
                    method: "get",
                    success: function(data) {
                        var dates = [];
                        var amount = [];

                        for(var i in data) {
                            var val = 0 ;
                            dateData = new Date((data[i].date));
                            dates.push(data[i].date);
                            amount.push(data[i].rev);
                        }

                        var chartdata = {
                            labels: dates,
                            datasets : [
                            {
                                label: 'Revenue',
                                backgroundColor: '#17a2b8',
                                borderColor: 'rgba(200, 200, 200, 0.75)',
                                //hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
                                //hoverBorderColor: 'rgba(200, 200, 200, 1)',
                                data: amount,
                                options: {
                                    hover: {mode: null},
                                    scales: {
                                        xAxes: [{
                                            type: 'time',
                                            distribution: 'series',
                                            time: {
                                            displayFormats: {
                                                quarter: 'MMM YYYY'
                                            }
                                    }
                                        }]
                                    }
                                }
                            }
                            ]
                        };

                        var ctx = $("#monthCanvas");

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

            var oldYear = $('#oldYear').val();
            $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                    url: "/hospital/revenuebyyear/"+oldYear,
                    method: "get",
                    success: function(data) {
                        var dates = [];
                        var amount = [];

                        for(var i in data) {
                            var val = 0 ;
                            dateData = new Date((data[i].date));
                            dates.push(data[i].date);
                            amount.push(data[i].rev);
                        }

                        var chartdata = {
                            labels: dates,
                            datasets : [
                            {
                                label: 'Revenue',
                                backgroundColor: '#17a2b8',
                                borderColor: 'rgba(200, 200, 200, 0.75)',
                                //hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
                                //hoverBorderColor: 'rgba(200, 200, 200, 1)',
                                data: amount,
                                options: {
                                    hover: {mode: null},
                                    scales: {
                                        xAxes: [{
                                            type: 'time',
                                            distribution: 'series',
                                            time: {
                                            displayFormats: {
                                                quarter: 'MMM YYYY'
                                            }
                                    }
                                        }]
                                    }
                                }
                            }
                            ]
                        };

                        var ctx = $("#yearCanvas");

                        var barGraph = new Chart(ctx, {
                            type: 'bar',
                            data: chartdata
                        });
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            $('#year').on('change',function(){
                var year = $('#year').val();
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                    url: "/hospital/revenuebyyear/"+year,
                    method: "get",
                    success: function(data) {
                        var dates = [];
                        var amount = [];

                        for(var i in data) {
                            var val = 0 ;
                            dateData = new Date((data[i].date));
                            dates.push(data[i].date);
                            amount.push(data[i].rev);
                        }

                        var chartdata = {
                            labels: dates,
                            datasets : [
                            {
                                label: 'Revenue',
                                backgroundColor: '#17a2b8',
                                borderColor: 'rgba(200, 200, 200, 0.75)',
                                //hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
                                //hoverBorderColor: 'rgba(200, 200, 200, 1)',
                                data: amount,
                                options: {
                                    hover: {mode: null},
                                    scales: {
                                        xAxes: [{
                                            type: 'time',
                                            distribution: 'series',
                                            time: {
                                            displayFormats: {
                                                quarter: 'MMM YYYY'
                                            }
                                    }
                                        }]
                                    }
                                }
                            }
                            ]
                        };

                        var ctx = $("#yearCanvas");

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
        });


    </script>


<script type="text/javascript">
    $(document).ready(function(){
        $("#search").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("tbody tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>

  @endsection

