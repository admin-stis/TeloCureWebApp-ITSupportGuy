@extends('hospital.layout')

@section('content')

@php
    $user = Session::get('user');

    $id = $user[0]['hospitalUid'];
    //if(isset($branch[0]['hospitalUserId'])) $id = $branch[0]['hospitalUserId']; else $id = '';
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
              <li class="breadcrumb-item breadcrumb-hospitalUser"><a href="{{url('/hospital')}}"> Home</a></li>
              <li class="breadcrumb-item breadcrumb-hospitalUser active">Branch</li>
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
        <div class="row" style="background: #f8f9fa;
        padding: 10px;
        border: 5px solid #dee2e6;
        border-radius: 8px;">
          <!-- Left col -->


          <section class="col-md-6 m-0 m-auto d-table">
            <!-- TO DO List -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="ion ion-clipboard mr-1"></i>
                  Branch
                  <a class="btn btn-sm btn-info" style="float:right;" href="{{url('admin/hospital/addhospital/'.$id)}}">New</a>
                </h3>
              </div>
              <!-- /.card-header -->

              <div class="card-body">

                @if(Session::has('success'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>{{ Session::get('success') }}</strong>
                    </div>
                @endif

                  <table id="table" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                      <th class="text-center">Sl</th>
                      <th class="text-center">Branch</th>
                      <th class="text-center">Address</th>
                      {{-- <th class="text-center">Delete</th> --}}
                    </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($branch as $key=>$item)
                            <tr>
                                <td><span>{{$i++}}</span></td>
                                <td><span>{{$item['branch']}}</span></td>
                                <td><span>{{$item['address']}}</span></td>
                                {{-- <td>
                                    <a class="btn btn-danger btn-sm" href="{{url('admin/hospital/delbranch/'.$id)}}">Delete</a>
                                </td> --}}
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



    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.2.1/Chart.min.js"></script>

    <script>
        $(document).ready(function(){
            var uid = $('#uid').val();
            // alert(uid);
            $.ajax({
                url: "hospital/rev/"+uid,
                method: "GET",
                success: function(data) {
                    console.log(data.amount);
                var dates = [];
                var amount = [];

                for(var i in data) {
                    var val = 0 ;
                    dateData = new Date((data[i].date));
                    dates.push(data[i].date);
                    amount.push(data[i].val);
                }

                var chartdata = {
                    labels: data.amount,
                    datasets : [
                    {
                        label: 'Revenue ',
                        backgroundColor: '#17a2b8',
                        borderColor: 'rgba(200, 200, 200, 0.75)',
                        hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
                        hoverBorderColor: 'rgba(200, 200, 200, 1)',
                        data: data.date,
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
        });

</script>






     @endsection
