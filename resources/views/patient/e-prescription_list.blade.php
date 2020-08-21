@extends('patient.layout')

@section('content')
<!-- Content Header (Page header) -->
   
    <style>
      .paginateContainer{
        width: 29%;
        float: right;
        position: relative;
        right: 26px;
        top: -40px;
      }
    </style>

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">E-prescription</li>
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


          <section class="col-lg-12 connectedSortable">
            <!-- TO DO List -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="ion ion-clipboard mr-1"></i>
                  Prescription List
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                 <div class="row col-sm-12">
                    <input id="search" type="text" class="col-md-4 col-lg-4 form-control"  placeholder="Search..."/>
                     <div class="col-md-6 col-lg-6 jquery-script-clear"></div>
                </div>

               
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                      <th class="text-center">Date</th>
                      <th class="text-center">Doctor</th>
                      <th class="text-center">Phone</th>
                      <th class="text-center">Diagnosis</th>
                      <th class="text-center">Status</th>
                      <th class="text-center">view</th>
                    </tr>
                    </thead>
                    <tbody>
                      
                      @foreach ($output as $key=>$val)
                        
                        @php
                            
                            //$oldDate = strtotime($val['pres']['createdDate']->get()->format('m/d/Y'));
                            $date = date('d-m-y',strtotime($val['pres']['createdDate']));
                            $oldDate = strtotime($val['pres']['created_at']);
                            $newDate = strtotime(date('m/d/Y',strtotime('+30 days',$oldDate)));

                        @endphp


                        <tr>
                            <td>{{$date}}</td>
                            <td>{{$val['doc']['name']}}</td>
                            <td>{{$val['doc']['phone']}}</td>
                            <td><a href="{{url('patient/diagnosis/'.$val['pres']['patientId'].'/'.$val['pres']['doctorId'].'/'.$val['pres']['prescriptionId'])}}">View</a></td>
                             {{--Diagnosis infomation--}}
                            <td>
                              @if($oldDate <= $newDate) Validate
                              @else Expired
                              @endif
                            </td>
                            <td>
                              {{--@if(!empty() && !empty() && !empty())--}}
                              <a href="{{url('patient/prescription/details/'.$val['pres']['patientId'].'/'.$val['pres']['doctorId'].'/'.$val['pres']['prescriptionId'])}}">Details</a></td>
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

    </script>
     @endsection
