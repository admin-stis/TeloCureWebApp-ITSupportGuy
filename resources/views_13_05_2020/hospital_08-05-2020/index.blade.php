@extends('hospital.layout')

@section('content')
<!-- Content Header (Page header) -->
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
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-5">
            <!-- TO DO List -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="ion ion-clipboard mr-1"></i>
                  Total Calls
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="" style="margin-top:10px;">
                    <div class="row col-md-12">
                        <label class="col-md-4">
                            <h6>User ID.</h6>
                        </label>
                        <span class="col-md-1"> : </span>
                        <span class="col-md-6">
                            @if(isset($hospitalUser[0]['uid'])) {{$hospitalUser[0]['uid']}} @else N/A @endif
                        </span>
                    </div>
                    <div class="row col-md-12">
                        <label class="col-md-4">
                            <h6>First Name</h6>
                        </label>
                        <span class="col-md-1"> : </span>
                        <span class="col-md-6">{{$hospitalUser[0]['name']}}</span>
                    </div>
                    <div class="row col-md-12">
                        <label class="col-md-4">
                            <h6>Last Name</h6>
                        </label>
                        <span class="col-md-1"> : </span>
                        <span class="col-md-6">{{$hospitalUser[0]['lastname']}}</span>
                    </div>
                    <div class="row col-md-12">
                        <label class="col-md-4">
                            <h6>Phone</h6>
                        </label>
                        <span class="col-md-1"> : </span>
                        <span class="col-md-6">
                                {{$hospitalUser[0]['phone']}}
                        </span>
                    </div>
                    <div class="row col-md-12">
                        <label class="col-md-4">
                            <h6>Email</h6>
                        </label>
                        <span class="col-md-1"> : </span>
                        <span class="col-md-6">{{$hospitalUser[0]['email']}}</span>
                    </div>
                </div>
              </div>
              <!-- /.card-body -->

            </div>
            <!-- /.card -->
          </section>

          <section class="col-lg-7">
            <!-- TO DO List -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="ion ion-clipboard mr-1"></i>
                  Total Revenue
                </h3>
              </div>
              <!-- /.card-header -->
             <div class="card-body">
                  <div id='myChart'></div>
                    <script src="https://cdn.zingchart.com/zingchart.min.js"></script>
                    <script>
                      ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "b55b025e438fa8a98e32482b5f768ff5"];
                      var myConfig = {
                        "type": "pie",
                        "labels": [{ //Label One
                            "text": "Total Revenue",
                            "font-family": "Georgia",
                            "font-size": "30",
                            "x": "60%",
                            "y": "30%"
                          },

                          { //Label Three
                            "text": "$11111111",
                            "font-color": "#29A2CC",
                            "font-family": "Georgia",
                            "font-size": "30",
                            "x": "60%",
                            "y": "45%"
                          },

                        ],
                        "plot": {
                          "value-box": {
                            "placement": "in",
                            "offset-r": "-10",
                            "font-family": "Georgia",
                            "font-size": 10,
                            "font-weight": "normal"
                          }
                        },
                        "plotarea": {
                          "margin-right": "45%",
                          "margin-top": "5%",
                          "margin-bottom": "5%"
                        },
                        "series": [{
                            "values": [34]
                          },
                          {
                            "values": [30]
                          },
                          {
                            "values": [15]
                          },
                          {
                            "values": [14]
                          },
                          {
                            "values": [5]
                          }
                        ]
                      };

                      zingchart.render({
                        id: 'myChart',
                        data: myConfig,
                        height: 250,
                        width: "100%"
                      });
                    </script>
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
                  Doctor
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                      <th class="text-center">Name</th>
                      <th class="text-center">Calls</th>
                      <th class="text-center">Revenue</th>
                      <th class="text-center">Total</th>
                      <th class="text-center">Others</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                      <td></td>
                    </tr>
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
