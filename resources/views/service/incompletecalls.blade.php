
@extends('admin.layout')
@section('content')

<section class="content">
   <div class="container-fluid">
      <div class="row">
         <!-- Left col -->
         <section class="col-lg-12">
            <div class="card">
               <div class="card-header">
                  <div class="col-md-12">
                     <span class=""><i class="fas fa-list mr-1"></i>All Incomplete calls  </span>
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
                           <input style="margin-left: 5%;" id="search" type="text" class="col-md-4 col-lg-4 form-control"  placeholder="Search..."/>
                           <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; margin:0 5px 0 5px; border: 1px solid #ccc;" >
                              <i class="fa fa-calendar"></i>&nbsp;<span>Select Date Range</span> <i class="fa fa-caret-down"></i>
                           </div>
                        </div>
                        
                        <table class="table" style="text-align: center;">
                           
                            <thead>
                               
                                <tr >
                                    <th style="text-align:center;vertical-align:middle;">Visit ID</th>
                                    <th style="text-align:center;vertical-align:middle;">Total</th>
                                    <th style="text-align:center;vertical-align:middle;">Doctor</th>
                                    <th style="text-align:center;vertical-align:middle;">Patient</th>
                                    <th style="text-align:center;vertical-align:middle;">Patient District</th>
                                    <th style="text-align:center;vertical-align:middle;">Transaction Refund</th>
                                    <th style="text-align:center;vertical-align:middle;">Patient Phone</th>
                                    <th style="text-align:center;vertical-align:middle;">Call Start Time</th>
                                    <!-- <th colspan="3" style="border:1px solid #fff;">Total</th> -->
                                    <th style="text-align:center;vertical-align:middle;">Total time</th>
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
                            	@php $frb_tz = new \DateTimeZone('Asia/Dhaka'); @endphp 
                                
                                @foreach ($visitArr as $item)
                                    @php
                                        //$date = $item['callStartTime']->get()->format('d-m-Y');
                                        $date = date('d-m-Y',strtotime($item['callStartTime']));
                                        $transactionHistory = json_decode($item['transactionHistory'],TRUE);
                                        $doctor = json_decode($item['doctor'],TRUE);
                                        $patient = json_decode($item['patient'],TRUE);

                                    @endphp
                                    <tr>
                                        <td>{{$item['visitId']}}</td>
                                        <td>{{$transactionHistory['subTotalRounded']}} Tk
                                            @if(isset($transactionHistory)) 
                                            <input type="hidden" class="totalInput" value="" />
                                            @endif
                                        </td>
                                        <td>{{$doctor['name']}}</td>
                                        <td>{{$patient['name']}}</td>
                                        <td>{{$patient['district']}}</td>
                                        <td>@if($transactionHistory['refundAmount'] != 0 ) 
                                          {{$transactionHistory['refundAmount']}} Tk 
                                          @else 0 Tk @endif
                                       </td>
                                        <td>{{$patient['phone']}}</td>
        
                                        <td>
                                           @php 
                                           
                                           $frb_date = new \DateTime($item['callStartTime']);
                                           $frb_date->setTimezone($frb_tz);
                                           echo $frb_date->format('d/m/y  g:i a'); 
                                           
                                           @endphp 
                                           <input type="hidden" class="date_val" value="{{ $frb_date->format('d/m/Y') }}"/>
                                       </td>

                                        <td>
                                         @if(isset($transactionHistory)) 
                                         @php 
                                         $finalMinutes = 0; 
                                         $tempTime = $transactionHistory['totalTimeInSeconds']; 
                                         if($tempTime<60) { $finalMinutes = "0.".$tempTime;  } 
                                         else {
                                             $tempMin = (int) ($tempTime/60); // get minutes
                                             $tempSec = (int) fmod($tempTime, 60); //get remainder means the remaining seconds
                                             if($tempSec==0){ $tempSec=""; } else { $tempSec = " : ".$tempSec; }
                                             $finalMinutes = $tempMin.$tempSec; 
                                          }                                                                                  
                                         @endphp 
                                         
                                         {{ $finalMinutes }} Minutes
                                         
                                         @else N/A @endif
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


