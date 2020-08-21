
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
               <li class="breadcrumb-item"><a href="{{url('admin')}}">Home</a></li>
               <li class="breadcrumb-item"><a href="{{url('admin/service')}}">Service Info</a></li>
               <li class="breadcrumb-item active">Financial Info</li>
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
                     <span class=""><i class="fas fa-list mr-1"></i>Financial Information (Patient)</span>
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
                                    <th>Visit ID</th>
                                    <th>Doctor</th>
                                    <th>Doctor Phone</th>
                                    <th>Hospital</th>
                                    <!-- <th colspan="3" style="border:1px solid #fff;">Total</th> -->
                                    <th>Total</th>
                                    <th>Refund</th>
                                    <th>Payment Method</th>
                                    <th>Date</th>
                                </tr>
                                <!-- <tr>
                            		<th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    
                                    <td style="border:1px solid #fff;">TeloCure Fee</td>
                                    <td style="border:1px solid #fff;">Hospital Fee</td>
                                    <td style="border:1px solid #fff;">Service Charge Fee</td>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                            	</tr> -->
                            </thead>
                            <tbody>
                            	
                                @foreach ($visitArr as $item)
                                    @php
                                        //$date = $item['callStartTime']->get()->format('d-m-Y');
                                        $date = date('d-m-Y',strtotime($item['callStartTime']));
                                        $transactionHistory = json_decode($item['transactionHistory'],TRUE);
                                        $doctor = json_decode($item['doctor'],TRUE);

                                        /*
                                        @if($transactionHistory['subTotalRounded'] != 0){
                                        	$total = $transactionHistory['subTotalRounded'];
                                        	$telocure = $total * 20/100 ;
                                        	$fee = $total * 80/100 ;
                                    	}
                                    	*/


                                    @endphp
                                    <tr>
                                        <td>#{{$item['visitId']}}</td>
                                        <td>{{$doctor['name']}}</td>
                                        <td>{{$doctor['phone']}}</td>
                                        <td>{{$doctor['hospitalName']}}</td>

                                        @php
                                        	/*
                                        	$serviceCharge = $transactionHistory['serviceFee'];
                                        	$total = intval($transactionHistory['subTotalRounded']) - intval($transactionHistory['serviceFee']);
                                        	$telocurefee = intval($total) * 0.2 ;
                                        	$Hospitalfee = intval($total) * 0.8 ;
                                        	*/
                                        @endphp

                                        <td>{{$transactionHistory['subTotalRounded']}}</td>

                                        {{--
                                        <td>{{$telocurefee}} Tk</td>
                                        
                                        <td>{{$Hospitalfee}}</td>

                                        <td>@if($transactionHistory['serviceFee'] != 0 ) {{$transactionHistory['serviceFee']}} Tk @else 0Tk @endif</td>
                                        --}}

                                        <td>@if($transactionHistory['refundAmount'] != 0 ) {{$transactionHistory['refundAmount']}} Tk @else 0Tk @endif</td>
                                        <td>@if(isset($transactionHistory['cardType']) && $transactionHistory['cardType'] != 0 ) {{$transactionHistory['cardType']}} Tk @else N/A @endif </td>
                                        <td>{{$date}}</td>
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

         {{--<section class="col-lg-5">
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

         </section>--}}

        </div>
   </div>
</section>

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


