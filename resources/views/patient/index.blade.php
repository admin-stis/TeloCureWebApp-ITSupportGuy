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
              <li class="breadcrumb-item"><a href="{{url('/patient')}}">Home</a></li>
              <li class="breadcrumb-item active">Patient</li>
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
          <section class="col-lg-5 connectedSortable">
            <!-- TO DO List -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="ion ion-clipboard mr-1"></i>
                  Profile Information
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <ul class="todo-list" data-widget="todo-list">

                  <li>
                    <span class="handle">
                      <i class="fas fa-ellipsis-v"></i>
                      <i class="fas fa-ellipsis-v"></i>
                    </span>

                    @if(isset($patientData[0]['name']))
                    <span class="text">Name  : {{$patientData[0]['name']}} </span>
                    @else
                    <span class="text">Name  : N/A</span>
                    @endif

                  </li>

                  <li>
                    <span class="handle">
                      <i class="fas fa-ellipsis-v"></i>
                      <i class="fas fa-ellipsis-v"></i>
                    </span>
                    @isset($patientData[0]['email'])
                    <span class="text">Email :  {{$patientData[0]['email']}}</span>
                    @else
                    <span class="text">Email  : N/A</span>
                    @endif
                </li>

                  <li>
                    <span class="handle">
                      <i class="fas fa-ellipsis-v"></i>
                      <i class="fas fa-ellipsis-v"></i>
                    </span>

                    @if(isset($patientData[0]['phone']))
                    <span class="text">Contact No : {{$patientData[0]['phone']}}</span>
                    @else <span class="text">Contact No  : N/A</span>
                    @endif
                  </li>

                  <li>
                    <span class="handle">
                      <i class="fas fa-ellipsis-v"></i>
                      <i class="fas fa-ellipsis-v"></i>
                    </span>
                    <span class="text">Blood Group : @if(isset($patientData[0]['bloodGroup'])) {{$patientData[0]['bloodGroup']}} @else N/A @endif</span>
                  </li>

                  <li>
                    <span class="handle">
                      <i class="fas fa-ellipsis-v"></i>
                      <i class="fas fa-ellipsis-v"></i>
                    </span>
                    <span class="text">Date of Birth  : @if(isset($patientData[0]['dateOfBirth'])) {{$patientData[0]['dateOfBirth']}} @else N/A @endif</span>
                  </li>

                </ul>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                @if(isset($patientData[0]['uid']))
                <a href="{{'patient/edit/'.$patientData[0]['uid']}}" class="btn btn-sm btn-info float-right">
                    <i class="fas fa-edit"></i> Edit</a>
                @endif
              </div>
            </div>
            <!-- /.card -->
          </section>

          <section class="col-lg-7 connectedSortable">
            <!-- TO DO List -->
            <div class="card" style="min-height: 370px !important;">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="ion ion-clipboard mr-1"></i>
                  E-Prescription
                </h3>
              </div>
              <!-- /.card-header -->

              <div class="card-body">
                <ul class="row todo-list" data-widget="todo-list">
                    {{-- mridul addition date 7-7-20 --}} 
                    @php $count = 0; $frb_tz = new \DateTimeZone('Asia/Dhaka'); @endphp
                    @foreach($pres as $key => $val)
                    @php
                       //dd($val);
                    @endphp
                      <li class="col-sm-12">
                        <ul>
                          <li>
                          {{--   Date : <a href="{{url('patient/prescription/details/'.$patientData[0]['uid'].'/'.$val['doctorId'].'/'.$val['prescriptionId'])}}">{{$val['createdDate']->get()->format('d-m-y')}}</a>
                          --}}
                          {{-- mridul addition date 7-7-20 --}} 
                          @php $count++; echo $count."."; @endphp
                            <span style="margin-left:8px;" >Date :                                                         
                            {{-- mridul 8/7/20 --}}
                            @php                             
                                $frb_date = new \DateTime($val['createdDate']);
                                $frb_date->setTimezone($frb_tz);
                                echo $frb_date->format('d-m-y  h:i:s A'); 
                            @endphp                            
                            </span></span>
                            <a style="margin-left:25px;" href="{{url('patient/prescription/details/'.$patientData[0]['uid'].'/'.$val['doctorId'].'/'.$val['prescriptionId'])}}" class="btn btn-sm btn-info"><i class="fa fa-eye"></i>
                                View</a>
                          </li>
                        </ul>
                    </li>
                    @endforeach
                </ul><!-- /.card-body -->

              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                  <a class="btn btn-sm btn-primary  float-right" href="{{url('patient/eprescription/'.$patientData[0]['uid'])}}"><i class="fas fa-edit"></i>  Read more...</a>
                </div>

            </div>
            <!-- /.card -->
          </section>
          <section class="col-lg-12">
            @if(Session::has('edit-success'))
                <ul><p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('edit-success') }}</p></ul>
            @endif
          </section>
          <section class="col-lg-12 connectedSortable">
            <!-- TO DO List -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="ion ion-clipboard mr-1"></i>
                  Your Visits
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
                      <th class="text-center">Rating</th>
                      <th class="text-center">Duration</th>
                      <th class="text-center">Cost</th>
                      <th class="text-center">Diagnosis</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($visits as $key=>$visit)

                            @php
                                $visit_doctor = json_decode($visit['doctor'],TRUE);

                                $totalCount = $visit_doctor['totalCount'];
                                $totalRating = $visit_doctor['totalRating'];

                                $date_a = new DateTime($visit['callStartTime']);
                                $date_b = new DateTime($visit['callEndTime']);

                                $interval = date_diff($date_b,$date_a);

                                $date = date('d-m-Y',strtotime($visit['callStartTime']));

                                echo '<tr>';
                                //echo '<td>'.$visit['callStartTime']->get()->format('d-m-Y').'</td>';
                                echo '<td>'.$date.'</td>';
                                echo '<td>'.$visit_doctor['name'].'</td>';

                                /*if($totalRating != 0 && $totalCount != 0){
                                    $rating = $totalRating/$totalCount;
                                    echo '<td>'.$rating.'</td>';
                                }else{
                                    echo '<td>0</td>';
                                }
                                echo '<td>'.$interval->format("%H:%I:%S").'</td>';
                                if(isset($visit['transactionHistory']['subTotalRounded'])){
                                    $rating = $totalRating/$totalCount;
                                    echo '<td>'.$visit['transactionHistory']['subTotalRounded'].' Tk</td>';
                                }else{
                                    echo '<td>0 Tk</td>';
                                }*/

                                $rate = '';

                                if(isset($totalRating) && isset($totalCount) && $totalCount > 0)
                                {
                                    $rating = $totalRating/$totalCount;
                                    /*
                                    for($i = 0;$i < $rating; $i++)
                                    {
                                        $rate .= '<span class="fa fa-star" style="color:#d4af37"></span>';
                                    }
                                    */
                                    echo '<td>'.round($rating,1).'</td>';
                                }

                                else
                                {
                                    $rating = 5;
                                    /*
                                    for($i = 0;$i < 5; $i++)
                                    {
                                        $rate .= '<span class="fa fa-star" style=""></span>';
                                    }
                                    echo '<td>'.$rate.'</td>';
                                    */
                                    echo '<td>'.$rating.'</td>';
                                }

                                echo '<td>'.$interval->format("%H:%I:%S").'</td>';
                                if(isset($visit['transactionHistory'])){
                                    $transactionHistory = json_decode($visit['transactionHistory'],TRUE);
                                    echo '<td>'.$transactionHistory['subTotalRounded'].' Tk</td>';
                                }else{
                                    echo '<td>0 Tk</td>';
                                }
                                $pId = $visit['patientUid'];
                                $dId = $visit['doctorUid'];
                                $prId = $visit['prescriptionId'];
                            @endphp
                                
                                @if(!empty($prId))
                                  <td>
                                      <a href="{{url('patient/diagnosis/'.$pId.'/'.$dId.'/'.$prId)}}" class="btn btn-sm btn-info"><i class="fa fa-eye"></i>
                                      View</a>
                                  </td>
                                @else
                                  <td>
                                      N/A
                                  </td>
                                @endif

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
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('backend/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->

    {{-- DataTables --}}
    <script src="{{ asset('backend/plugins/datatables/jquery.dataTables.js') }}"></script>
    {{-- End --}}

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

        // $(document).ready(function(){
        //     $('.dp li a').click(function(){
        //         let v = $(this).attr('href');
        //         $('v').addClasses('btn-success');
        //         $('v').removeClass('btn-success');

        //     });
        // });
    </script>
     @endsection
