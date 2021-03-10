@extends('admin.layout')

@section('content')
@php 
    $admin = Session::get('user');
    if($admin[0]['user_name']=="super") {
      $view_doctorPermission = true; 
      $view_patientPermission = true; 
      $view_hospitalPermission = true; 
      $view_service_financePermission = true; 
      $view_districtPermission = true; 
      $view_all_pagesPermission = true; 
      $view_district_discountPermission = true;  
      $view_manage_paymentsPermission = true; 
      $view_settingsPermission = true; 
    } else { 
    //for roles and security 
    $perm_role = Session::get('user_roles');
    $all_perms = $perm_role["perms"]; 
    //dd($all_perms); 
    $view_doctorPermission = false; $view_patientPermission = false;$view_hospitalPermission = false; $view_service_financePermission = false; $view_districtPermission = false; 
    $view_authorizationPermission = false; $view_all_pagesPermission = false; $view_district_discountPermission = false; 
    $view_manage_paymentsPermission = false; $view_settingsPermission = false; 
    for($i=0; $i<count($all_perms); $i++){      
      if($all_perms[$i]=="view_doctor") { $view_doctorPermission = true; }
      if($all_perms[$i]=="view_patient") { $view_patientPermission = true; }
      if($all_perms[$i]=="view_hospital") { $view_hospitalPermission = true; }
      if($all_perms[$i]=="view_service_finance") { $view_service_financePermission = true; }
      if($all_perms[$i]=="view_district") { $view_districtPermission = true; }
      if($all_perms[$i]=="view_all_pages") { $view_all_pagesPermission = true; }
      if($all_perms[$i]=="view_authorization") { $view_authorizationPermission = true; }
      if($all_perms[$i]=="view_district_discount") { $view_district_discountPermission = true; } 
      if($all_perms[$i]=="view_manage_payments") { $view_manage_paymentsPermission = true; }
      if($all_perms[$i]=="view_settings") { $view_settingsPermission = true; }
    } }
    
@endphp 
<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin')}}">Home</a></li>
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
          @php if($view_doctorPermission== true || $view_all_pagesPermission==true) { @endphp
          <!-- ./col -->
          <div class="col-lg-3 col-12">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner" style="padding:21px;">
                <h5 class="text-center text-bold">Total Doctors Active</h5>
                <h3>{{$activeDoctor}}</h3>
              </div>
              <div class="icon">
                <i class="fas fa-user-md"></i>
              </div>
              <a href="{{url('admin/doctor')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div> @php } @endphp
          <!-- ./col -->
          @php if($view_patientPermission== true || $view_all_pagesPermission==true) { @endphp
          <div class="col-lg-3 col-12">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h5 class="text-center text-bold">Total Registered Patient</h5>
                <h3>{{$totalPatient}}</h3>
              </div>
              <div class="icon">
                <i class="fa fa-bed"></i>
              </div>
              <a href="{{url('admin/patient')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div> @php } @endphp
          <!-- ./col -->
          @php if($view_hospitalPermission== true || $view_all_pagesPermission==true) { @endphp
          <div class="col-lg-3 col-12">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h5 class="text-center text-bold text-white">Total Hospital Registered</h5>
                <h3  class="text-white">{{$totalHospitalUser}}</h3>
              </div>
              <div class="icon">
                <i class="fa fa-hospital"></i>
              </div>
              <a href="{{url('admin/hospital')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>  @php } @endphp
          @php if($admin[0]['user_name']=="super") { @endphp
          <div class="col-lg-3 col-12">
            <!-- small box -->
            <div class="small-box bg-secondary">
              <div class="inner" style="padding:21px;">
                <h5 class="text-center text-bold text-white">Total Transaction</h5>
                <h3  class="text-white">{{$totalRevenue}} Tk</h3>
              </div>
              <div class="icon">
                <i class="fa fa-hospital"></i>
              </div>
              <a href="{{url('admin/doctorTransactionData')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div> @php } @endphp
          <!-- ./col -->
        </div>




        {{-- charts --}}

        <div class="row" style="margin-top: 10px;margin-bottom: 28px;background: #fff;margin-right: 0px;margin-left: 0px;padding: 20px">
            <!-- ./col -->
           @php if($view_patientPermission== true || $view_all_pagesPermission==true) { @endphp
            <!-- test purpose -->
            <div class="col-lg-5">
              <div class="card"  style="min-height: 468px;">
                  <div class="card-header">Registered Patient</div>
                  <div class="card-body">
                      Date : <input id="date" type="date" class="form-control" name="revDate"/>
                      <!-- <p id="hosId" style="display:none;" value="@if(isset($info[0]['id'])){{$info[0]['id']}}@endif"></p> -->
                      <canvas id="mycanvasDate"></canvas>
                  </div>
                  <div class="card-footer"></div>
              </div>
            </div>  @php } @endphp
            <!-- end -->
            @php if($view_patientPermission== true || $view_all_pagesPermission==true) { @endphp
            <!-- test visitor purpose -->
            <div class="col-lg-7 ">
              <div class="card">
                  <div class="card-header">Visited Patient</div>
                  <div class="card-body">
                      <div class="row">
                        <div class="col-md-3">Date : <input id="visitDate" type="date" class="form-control" name="rdate"/></div>
                        <div class="col-md-3">Week : <input id="visitWeek" type="Week" class="form-control" name="rdate"/>
                        </div>
                        <div class="col-md-3">Month : <input id="visitMonth" type="month" class="form-control" name="rmonth"/></div>
                        <div class="col-md-3">Year : <input id="visitYear" type="text" class="form-control" placeholder="Enter year" name="rYear"/></div>
                        <canvas id="mycanvasVisitor"></canvas>
                      </div>
                  </div>
                  <div class="card-footer"></div>
              </div>
            </div> @php } @endphp
            <!-- end -->
            @php if($view_service_financePermission== true || $view_all_pagesPermission==true) { @endphp
            <!-- test rev purpose -->
            <div class="col-lg-12 ">
              <div class="card">
                  <div class="card-header">Revenue</div>
                  <div class="card-body">
                      <div class="row">
                        <div class="col-md-3">Date : <input id="revDate" type="date" class="form-control" name="rdate"/>
                        </div>
                        <div class="col-md-3">Week : <input id="revWeek" type="Week" class="form-control" name="rdate"/>
                        </div>
                        <div class="col-md-3">Month : <input id="revMonth" type="month" class="form-control" name="rmonth"/></div>
                        <div class="col-md-3">Year : <input id="revYear" type="text" class="form-control" name="rYear" placeholder="Enter year"/></div>
                        <canvas id="mycanvasRev"></canvas>
                      </div>
                  </div>
                  <div class="card-footer"></div>
              </div>
            </div> @php } @endphp
            <!-- end -->



            <div class="col-lg-6 col-12 graph  d-none">
              <!-- small box -->
              <h5>Registered User</h5>
              <canvas id="bar-chart"></canvas>
            </div>

            <div class="col-lg-6 col-12 graph d-none">
              <!-- small box -->
              <h5>Visited User</h5>
              <canvas id="bar-chart2"></canvas>
            </div>

            <div class="col-lg-12 col-12 graph d-none">
              <!-- small box -->
              <h5>Revenue Information</h5>
              <canvas id="mycanvas"></canvas>
            </div>
            <!-- ./col -->
            <div class="col-lg-6 col-12 d-none">
              <!-- small box -->
              <canvas id="chartByPatient"></canvas>
            </div>
            <!-- ./col -->
            <div class="col-lg-6 col-12  d-none">
                <!-- small box -->
                <h4>Revenue</h4>
                <canvas id="line-chart"></canvas>
              </div>
            <!-- ./col -->
          </div>
        {{-- ens charts --}}

        <!-- /.row -->
        <!-- Small boxes (Stat box) -->
         
        <div class="row">
            @php if($admin[0]['user_name']=="super") { @endphp
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h4 class="text-center text-bold">Doctor</h4>
                </div>
                <a href="{{url('admin/doctor')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div> @php } @endphp
            
            @php if($admin[0]['user_name']=="super") { @endphp
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box" style="background-color: #af28c1;color: #fff;">
                <div class="inner">
                  <h4 class="text-center text-bold">Patient</h4>
                </div>
                <a href="{{url('admin/patient')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div> @php } @endphp
            @php if($admin[0]['user_name']=="super") { @endphp
            <!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-success">
                <div class="inner">
                  <h4 class="text-center text-bold">Hospital</h4>
                </div>
                <a href="{{url('admin/hospital')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
            </div> @php } @endphp
            <!-- ./col -->
            <!-- ./col -->
            @php if($admin[0]['user_name']=="super") { @endphp
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-primary">
                  <div class="inner">
                    <h4 class="text-center text-bold">Service & Revenue</h4>
                  </div>
                <a href="{{url('admin/servicenav')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div> @php } @endphp
              <!-- ./col -->
          </div>
          <!-- /.row -->
        <!-- Main row -->


    <input type="hidden" id="today" value="<?php echo date('Y-m-d');?>"/>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.2.1/Chart.min.js"></script>

    <script>
        $(document).ready(function(){


            // test purpose
            var oldDate = $('#today').val();
            $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')},
                    url: "/admin/regUserDateWise/"+oldDate,
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

                        var ctx = $("#mycanvasDate");

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
                    url: "/admin/regUserDateWise/"+date,
                    method: "get",
                    success: function(data) {
                        //alert(data);
                        console.log(data);
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

                        var ctx = $("#mycanvasDate");

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

            // end


            $.ajax({
                url: "admin/revenue",
                method: "GET",
                success: function(data) {
                var dates = [];
                var amount = [];

                for(var i in data) {
                    var val = 0 ;
                    dateData = new Date((data[i].date));
                    dates.push(data[i].date);
                    amount.push(data[i].val);
                }

                var chartdata = {
                    labels: dates,
                    datasets : [
                    {
                        label: 'Revenue ',
                        backgroundColor: '#17a2b8',
                        borderColor: 'rgba(200, 200, 200, 0.75)',
                        hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
                        hoverBorderColor: 'rgba(200, 200, 200, 1)',
                        data: amount,
                        options: {
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
                    type: 'line',
                    data: chartdata
                });
                },
                error: function(data) {
                console.log(data);
                }
            });


            // test rev
            var oldDate = $('#today').val();
            $.ajax({
                url: "admin/revenue1/"+oldDate,
                method: "GET",
                success: function(data) {
                var dates = [];
                var amount = [];

                for(var i in data) {
                    var val = 0 ;
                    dateData = new Date((data[i].date));
                    dates.push(data[i].date);
                    amount.push(data[i].val);
                }

                var chartdata = {
                    labels: dates,
                    datasets : [
                    {
                        label: 'Revenue ',
                        backgroundColor: '#17a2b8',
                        borderColor: 'rgba(200, 200, 200, 0.75)',
                        hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
                        hoverBorderColor: 'rgba(200, 200, 200, 1)',
                        data: amount,
                        options: {
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

                var ctx = $("#mycanvasRev");

                var barGraph = new Chart(ctx, {
                    type: 'line',
                    data: chartdata
                });
                },
                error: function(data) {
                console.log(data);
                }
            });
            $('#revDate').on('change',function(){
                var revdate = $('#revDate').val();
                $.ajax({
                  url: "admin/revenue1/"+revdate,
                  method: "GET",
                  success: function(data) {
                  console.log(data);
                  var dates = [];
                  var amount = [];

                  for(var i in data) {
                      var val = 0 ;
                      dateData = new Date((data[i].date));
                      dates.push(data[i].date);
                      amount.push(data[i].rev);
                  }

                  console.log(amount);

                  var chartdata = {
                      labels: dates,
                      datasets : [
                      {
                          label: 'Revenue ',
                          backgroundColor: '#17a2b8',
                          borderColor: 'rgba(200, 200, 200, 0.75)',
                          hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
                          hoverBorderColor: 'rgba(200, 200, 200, 1)',
                          data: amount,
                          options: {
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

                  var ctx = $("#mycanvasRev");

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
            $('#revWeek').on('change',function(){
                var revWeek = $('#revWeek').val();
                
                $.ajax({
                  url: "admin/revenue4/"+revWeek,
                  method: "GET",
                  success: function(data) {
                  console.log(data);
                  var dates = [];
                  var amount = [];

                  for(var i in data) {
                      var val = 0 ;
                      dateData = new Date((data[i].date));
                      dates.push(data[i].date);
                      amount.push(data[i].rev);
                  }

                  console.log(amount);

                  var chartdata = {
                      labels: dates,
                      datasets : [
                      {
                          label: 'Revenue ',
                          backgroundColor: '#17a2b8',
                          borderColor: 'rgba(200, 200, 200, 0.75)',
                          hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
                          hoverBorderColor: 'rgba(200, 200, 200, 1)',
                          data: amount,
                          options: {
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

                  var ctx = $("#mycanvasRev");

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
            $('#revMonth').on('change',function(){
                var revmonth = $('#revMonth').val();
                
                $.ajax({
                  url: "admin/revenue2/"+revmonth,
                  method: "GET",
                  success: function(data) {
                  console.log(data);
                  var dates = [];
                  var amount = [];

                  for(var i in data) {
                      var val = 0 ;
                      dateData = new Date((data[i].date));
                      dates.push(data[i].date);
                      amount.push(data[i].rev);
                  }

                  console.log(amount);

                  var chartdata = {
                      labels: dates,
                      datasets : [
                      {
                          label: 'Revenue ',
                          backgroundColor: '#17a2b8',
                          borderColor: 'rgba(200, 200, 200, 0.75)',
                          hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
                          hoverBorderColor: 'rgba(200, 200, 200, 1)',
                          data: amount,
                          options: {
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

                  var ctx = $("#mycanvasRev");

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
            $('#revYear').on('change',function(){
                var revyear = $('#revYear').val();
                
                $.ajax({
                  url: "admin/revenue3/"+revyear,
                  method: "GET",
                  success: function(data) {
                  console.log(data);
                  var dates = [];
                  var amount = [];

                  for(var i in data) {
                      var val = 0 ;
                      dateData = new Date((data[i].date));
                      dates.push(data[i].date);
                      amount.push(data[i].rev);
                  }

                  console.log(amount);

                  var chartdata = {
                      labels: dates,
                      datasets : [
                      {
                          label: 'Revenue ',
                          backgroundColor: '#17a2b8',
                          borderColor: 'rgba(200, 200, 200, 0.75)',
                          hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
                          hoverBorderColor: 'rgba(200, 200, 200, 1)',
                          data: amount,
                          options: {
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

                  var ctx = $("#mycanvasRev");

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
            // test

            //registered user (patients)
            $.ajax({
                url: "admin/regUser",
                method: "GET",
                success: function(data) {

                    var dates = [];
                  var amount = [];

                  for(var i in data) {
                      var val = 0 ;
                      dateData = new Date((data[i].date));
                      dates.push(data[i].date);
                      amount.push(data[i].val);
                  }

                    var chartdata = {
                        labels: dates,
                        datasets : [
                            {
                                label: 'Registered Users ',
                                backgroundColor:["rgb(54, 162, 235)","rgb(255, 99, 132),rgb(54, 162, 235)","rgb(255, 99, 132),rgb(54, 162, 235)","rgb(255, 99, 132),rgb(54, 162, 235)","rgb(255, 99, 132),rgb(54, 162, 235)","rgb(255, 99, 132)"],
                                borderColor: 'rgba(200, 200, 200, 0.75)',
                                hoverBackgroundColor:["rgb(255, 99, 132)","rgb(54, 162, 235)","rgb(255, 205, 86),rgb(255, 99, 132)","rgb(54, 162, 235)","rgb(255, 205, 86),rgb(255, 99, 132)","rgb(54, 162, 235)","rgb(255, 205, 86),rgb(255, 99, 132)","rgb(54, 162, 235)","rgb(255, 205, 86),rgb(255, 99, 132)","rgb(54, 162, 235)","rgb(255, 205, 86)"],
                                hoverBorderColor: 'rgba(200, 200, 200, 1)',
                                data: amount,
                            }
                        ]
                    };

                    var ctx = $("#bar-chart");

                    var barGraph = new Chart(ctx, {
                        type: 'bar',
                        data: chartdata
                    });
                },
                error: function(data) {
                console.log(data);
                }
            });

            $.ajax({
                url: "admin/visitors",
                method: "GET",
                success: function(data) {

                  var dates = [];
                  var amount = [];

                  for(var i in data) {
                      var val = 0 ;
                      dateData = new Date((data[i].date));
                      dates.push(data[i].date);
                      amount.push(data[i].val);
                  }

                    var chartdata = {
                        labels: dates,
                        datasets : [
                            {
                                label: 'Patient Visited ',
                                backgroundColor:["rgb(54, 162, 235)","rgb(255, 99, 132),rgb(54, 162, 235)","rgb(255, 99, 132),rgb(54, 162, 235)","rgb(255, 99, 132),rgb(54, 162, 235)","rgb(255, 99, 132),rgb(54, 162, 235)","rgb(255, 99, 132)"],
                                borderColor: 'rgba(200, 200, 200, 0.75)',
                                hoverBackgroundColor:["rgb(255, 99, 132)","rgb(54, 162, 235)","rgb(255, 205, 86),rgb(255, 99, 132)","rgb(54, 162, 235)","rgb(255, 205, 86),rgb(255, 99, 132)","rgb(54, 162, 235)","rgb(255, 205, 86),rgb(255, 99, 132)","rgb(54, 162, 235)","rgb(255, 205, 86),rgb(255, 99, 132)","rgb(54, 162, 235)","rgb(255, 205, 86)"],
                                hoverBorderColor: 'rgba(200, 200, 200, 1)',
                                data: amount,
                            }
                        ]
                    };

                    var ctx = $("#bar-chart2");

                    var barGraph = new Chart(ctx, {
                        type: 'bar',
                        data: chartdata
                    });
                },
                error: function(data) {
                console.log(data);
                }
            });

            // test
            // test rev
            var oldDate = $('#today').val();
            $.ajax({
                url: "admin/visitors1/"+oldDate,
                method: "GET",
                success: function(data) {
                var dates = [];
                var amount = [];

                for(var i in data) {
                    var val = 0 ;
                    dateData = new Date((data[i].date));
                    dates.push(data[i].date);
                    amount.push(data[i].val);
                }

                var chartdata = {
                    labels: dates,
                    datasets : [
                    {
                        label: 'Revenue ',
                        backgroundColor: '#17a2b8',
                        borderColor: 'rgba(200, 200, 200, 0.75)',
                        hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
                        hoverBorderColor: 'rgba(200, 200, 200, 1)',
                        data: amount,
                        options: {
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

                var ctx = $("#mycanvasVisitor");

                var barGraph = new Chart(ctx, {
                    type: 'line',
                    data: chartdata
                });
                },
                error: function(data) {
                console.log(data);
                }
            });
            $('#visitDate').on('change',function(){
                var visitDate = $('#visitDate').val();
                console.log(visitDate);
                $.ajax({
                  url: "admin/visitors1/"+visitDate,
                  method: "GET",
                  success: function(data) {
                  console.log(data);
                  var dates = [];
                  var amount = [];

                  for(var i in data) {
                      var val = 0 ;
                      dateData = new Date((data[i].date));
                      dates.push(data[i].date);
                      amount.push(data[i].val);
                  }

                  console.log(amount);

                  var chartdata = {
                      labels: dates,
                      datasets : [
                      {
                          label: 'Revenue ',
                          backgroundColor: '#17a2b8',
                          borderColor: 'rgba(200, 200, 200, 0.75)',
                          hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
                          hoverBorderColor: 'rgba(200, 200, 200, 1)',
                          data: amount,
                          options: {
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

                  var ctx = $("#mycanvasVisitor");

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
            $('#visitWeek').on('change',function(){
                var visitWeek = $('#visitWeek').val();
                
                $.ajax({
                  url: "admin/visitors4/"+visitWeek,
                  method: "GET",
                  success: function(data) {
                  console.log(data);
                  var dates = [];
                  var amount = [];

                  for(var i in data) {
                      var val = 0 ;
                      dateData = new Date((data[i].date));
                      dates.push(data[i].date);
                      amount.push(data[i].val);
                  }

                  console.log(amount);

                  var chartdata = {
                      labels: dates,
                      datasets : [
                      {
                          label: 'Revenue ',
                          backgroundColor: '#17a2b8',
                          borderColor: 'rgba(200, 200, 200, 0.75)',
                          hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
                          hoverBorderColor: 'rgba(200, 200, 200, 1)',
                          data: amount,
                          options: {
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

                  var ctx = $("#mycanvasVisitor");

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
            $('#visitMonth').on('change',function(){
                var visitmonth = $('#visitMonth').val();
                
                $.ajax({
                  url: "admin/visitors2/"+visitmonth,
                  method: "GET",
                  success: function(data) {
                  console.log(data);
                  var dates = [];
                  var amount = [];

                  for(var i in data) {
                      var val = 0 ;
                      dateData = new Date((data[i].date));
                      dates.push(data[i].date);
                      amount.push(data[i].val);
                  }

                  console.log(amount);

                  var chartdata = {
                      labels: dates,
                      datasets : [
                      {
                          label: 'Revenue ',
                          backgroundColor: '#17a2b8',
                          borderColor: 'rgba(200, 200, 200, 0.75)',
                          hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
                          hoverBorderColor: 'rgba(200, 200, 200, 1)',
                          data: amount,
                          options: {
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

                  var ctx = $("#mycanvasVisitor");

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
            $('#visitYear').on('change',function(){
                var visitYear = $('#visitYear').val();
                
                $.ajax({
                  url: "admin/visitors3/"+visitYear,
                  method: "GET",
                  success: function(data) {
                  console.log(data);
                  var dates = [];
                  var amount = [];

                  for(var i in data) {
                      var val = 0 ;
                      dateData = new Date((data[i].date));
                      dates.push(data[i].date);
                      amount.push(data[i].val);
                  }

                  console.log(amount);

                  var chartdata = {
                      labels: dates,
                      datasets : [
                      {
                          label: 'Visited Patient ',
                          backgroundColor: '#17a2b8',
                          borderColor: 'rgba(200, 200, 200, 0.75)',
                          hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
                          hoverBorderColor: 'rgba(200, 200, 200, 1)',
                          data: amount,
                          options: {
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

                  var ctx = $("#mycanvasVisitor");

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
            // test
            // end 
        });


        //end

        // Bar chart
        /*new Chart(document.getElementById("bar-chart"), {
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
                label: "Revenue",
                backgroundColor: ["#3e95cd"],
                data: [2478,5267,734,784,433,500,600]
                }
            ]
            },
            options: {
            legend: { display: false },
            title: {
                display: true,
                text: 'Revenue Info (Dummy)'
            }
            }
        });

        new Chart(document.getElementById("line-chart"), {
            type: 'line',
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
                text: 'Patient Information (Dummy)'
            }
            }
        });*/

    </script>

     @endsection
