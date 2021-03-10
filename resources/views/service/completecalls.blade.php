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
                                <span class=""><i class="fas fa-list mr-1"></i>All Completed calls </span>
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
                                        <input style="margin-left: 5%;" id="search" type="text"
                                            class="col-md-4 col-lg-4 form-control" placeholder="Search..." />
                                        <div id="reportrange"
                                            style="background: #fff; cursor: pointer; padding: 5px 10px; margin:0 5px 0 5px; border: 1px solid #ccc;">
                                            <i class="fa fa-calendar"></i>&nbsp;<span>Select Date Range</span> <i
                                                class="fa fa-caret-down"></i>
                                        </div>
                                    </div>
                                    <input type="hidden" id="lastVisitId" value="{{$lastVisitId}}"/>
                                    <table class="table" style="text-align: center;">

                                        <thead>

                                            <tr>
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
                                                    $date = date('d-m-Y', strtotime($item['callStartTime']));
                                                    
                                                    //firebase codes
                                                    $transactionHistory = $item['transactionHistory'];
                                                    $doctor = $item['doctor'];
                                                    $patient = $item['patient'];
                                                    
                                                    //mysql codes
                                                    /*
                                                     $transactionHistory = json_decode($item['transactionHistory'],TRUE);
                                                     $doctor = json_decode($item['doctor'],TRUE);
                                                     $patient = json_decode($item['patient'],TRUE);
                                                     */
                                                                                                                                                                                       
                                                    
                                                @endphp
                                                <tr>
                                                    <td>{{ $item['visitId'] }}</td>
                                                    <td>{{ $transactionHistory['subTotalRounded'] }} Tk
                                                        @if (isset($transactionHistory))
                                                            <input type="hidden" class="totalInput" value="" />
                                                        @endif
                                                    </td>
                                                    <td>{{ $doctor['name'] }}</td>
                                                    <td>{{ $patient['name'] }}</td>
                                                    <td>{{ $patient['district'] }}</td>
                                                    <td>
                                                        @if ($transactionHistory['refundAmount'] != 0)
                                                            {{ $transactionHistory['refundAmount'] }} Tk
                                                        @else 0 Tk @endif
                                                    </td>
                                                    <td>{{ $patient['phone'] }}</td>

                                                    <td>
                                                        @php
                                                            
                                                            $frb_date = new \DateTime($item['callStartTime']);
                                                            $frb_date->setTimezone($frb_tz);
                                                            echo $frb_date->format('d/m/y  g:i a');
                                                            
                                                        @endphp
                                                        <input type="hidden" class="date_val"
                                                            value="{{ $frb_date->format('d/m/Y') }}" />
                                                    </td>

                                                    <td>
                                                        @if (isset($transactionHistory))
                                                            @php
                                                                $finalMinutes = 0;
                                                                $tempTime = $transactionHistory['totalTimeInSeconds'];
                                                                if ($tempTime < 60) {
                                                                    $finalMinutes = '0.' . $tempTime;
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

<button id="nextData" class="btn btn-dark btn-block mb-3 mt-3" type="button">
Show more
</button>
<button id="buttonLoader" style="display:none;" class="btn btn-dark btn-block mb-3 mt-3" type="button" disabled>
  <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
  Loading...
</button>
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
        $(document).ready(function() {

          $("#nextData").click(function(){
          
          $("#buttonLoader").show();  $(this).hide(); 
          if($("#lastVisitId").val()==""){ $("#buttonLoader").text("Error found: last visit time data is empty"); } else {
          var format = 'DD/MM/YY hh:mm a'; var format2 = 'DD/MM/YYYY';
          //console.log($("#lastVisitId").val());
          var markup = "";
           
              $.ajax({
                url: "{{url('admin/getNextVisits')}}/"+$("#lastVisitId").val(),
                method: "GET",
                success: function(data) {
                   //console.log(data);
                   if(Array.isArray(data)){
                   
                   var i=0; var j = data.length;
                   for( i=0; i<data.length; i++){
                   
                    var finalMinutes = '';
                    if(exists(data[i].transactionHistory)) {
                    
                            var tempTime = data[i].transactionHistory.totalTimeInSeconds;
                            if (tempTime < 60) {
                                finalMinutes = '0:' + Math.floor(tempTime);
                            } else {
                                var tempMin = Math.floor(tempTime / 60); // get minutes
                                var tempSec = tempTime % 60; //get remainder means the remaining seconds
                                if (tempSec == 0) {
                                    tempSec = '';
                                } else {
                                    tempSec = ' : ' + tempSec;
                                }
                                finalMinutes = ''+ tempMin +''+ tempSec +'';
                            }    
                   }
                   else {
                           if(exists(data[i].newEndDate)){
                                
                                var end_date = moment(data[i].newEndDate.date).milliseconds(0); //exclude miliseconds else it become rounded to sec:
                                var start_date = moment(data[i].newDate.date).milliseconds(0);
                                var duration = moment.duration(end_date.diff(start_date));
                                var diffSeconds = duration.asSeconds();

                            var tempTime = diffSeconds;
                            if (tempTime < 60) {
                                finalMinutes = '0:' + Math.floor(tempTime) +' (calculated)';
                            } else {
                                var tempMin = Math.floor(tempTime / 60); // get minutes
                                var tempSec = tempTime % 60; //get remainder means the remaining seconds
                                if (tempSec == 0) {
                                    tempSec = '';
                                } else {
                                    tempSec = ' : ' + tempSec;
                                }
                                finalMinutes = ''+ tempMin +''+ tempSec +' (calculated)';
                            }   

                        } else {
                            finalMinutes='Call not ended';
                        }
                   }               

                      var TotalTime = !exists(data[i].transactionHistory) ? '': data[i].transactionHistory.subTotalRounded;                      
                      var refund = !exists(data[i].transactionHistory) ? '': data[i].transactionHistory.refundAmount;
                       
                      var docName = !exists(data[i].doctor) ? '': data[i].doctor.name;
                      var patientName = !exists(data[i].patient) ? '': data[i].patient.name;
                      var patientDistrict = !exists(data[i].patient) ? '': data[i].patient.district;
                      var patientPhone = !exists(data[i].patient) ? '': data[i].patient.phone;
                      
                      //const d = data[i].callStartTime.toDate(); 
                      markup += "<tr>"; 
                      markup += "<td>"+data[i].visitId+"</td>";
                      markup += "<td>"+TotalTime+" TK</td>";
                      markup += "<td>"+docName+"</td>";
                      markup += "<td>"+patientName+"</td>";
                      markup += "<td>"+patientDistrict+"</td>";
                      markup += "<td>"+ refund +" TK</td>";
                      markup += "<td>"+patientPhone+"</td>";
                      markup += "<td>"+moment(data[i].newDate.date).format(format)+"<input type='hidden' class='date_val' value='"+moment(data[i].newDate.date).format(format2)+"' /></td>";
                      markup += "<td>"+finalMinutes+"</td>";
                      
                      markup += "</tr>";
                      //console.log(data[i]);
                     if((i+1)==j) { $("#lastVisitId").val(data[i].originalDate.date); } 
                   }
                                    
                   //place in complete function 
                   var tableBody = $("table tbody"); 
                   tableBody.append(markup);
                   
                   $('table').paginate('update');
                   
                   $("#buttonLoader").hide(); 
                   $("#nextData").show(); 
                   
                   } else { var showMessage="invalid data returned, not an array"; if(exists(data)){ showMessage=data; } $("#buttonLoader").text("Error found: "+ showMessage); }

                },
                error: function(xhr, status, error) {
                   var err = JSON.parse(xhr.responseText);
                   //console.log(xhr);
                   $("#buttonLoader").text("Error found: "+err.message);
                }
            });
            }  
            });
                      
            $("#search").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("tbody tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });            
             
        });
function exists(data) 
{
  if(!data || data==null || data=='undefined' || typeof(data)=='undefined' || data===false)
  {
    return false; 
  } else {return true; }
}       

    </script>

@endsection
