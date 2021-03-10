@extends('frontend.layouts.doctorsapp')

@section('content')

<style >
    table { 
  width: 100%; 
  border-collapse: collapse; 
  
}
/* Zebra striping */
tr:nth-of-type(odd) { 
  background: rgb(77, 218, 12); 
}
th { 
  /* background: rgb(51, 51, 51);  */
  color: white; 
  font-weight: bold; 
}
td, th { 
  padding: 6px; 
  border: 1px solid rgb(136, 95, 233); 
  text-align: left; 
}





  
  


 

    </style>

                    <div class="card " style="margin: 2%; " >
                        <div class="card-header  " style="text-align: center;  ">
                            <div class="col-md-12 container" style="text-align: center;  ">
                                <span  style=""><img style="width:60px;height:60px;" src="{{url('assets/img/doctor.png')}}"  alt="doctor"> 
                                    <p class="font-weight-bold"> Our Board certified Doctors</p></span>
                            </div>
                            <div class="col-md-6">

                            </div>
                    </div></div>
                    <!-- /.card-header -->
    <div class="card-body">
                            <div class="tab-content p-0">
                            <!-- Morris chart - Sales -->
                                <div class="chart tab-pane active" id="revenue-chart"
                                    style="position: relative;    overflow-x: auto;">
                                    <div class="">
                                        <input id="search" type="text" class="col-md-2 col-lg-2 form-control"  placeholder="Search..."/>
                                    </div>                                   
    <table     class="table table-striped     table-bordered table-hover responsive-table" style="background-color: rgb(212, 231, 231);" >
    <thead   >
        <tr class="customers"  style="text-align: center; vertical-align:middle;">
        {{-- <th style="width: 14.2857%; text-align: center; vertical-align:middle;" scope="col">SlNo</th> --}}
        <th   style="width: 14.2857%; text-align: center; vertical-align:middle; " scope="col">Picture</th>
        <th   style="width: 14.2857%; text-align: center; vertical-align:middle; " scope="col">Name</th>
        <th   style="width: 14.2857%; text-align: center; vertical-align:middle; " scope="col">Degree</th>
        <th   style="width: 14.2857%; text-align: center; vertical-align:middle; " scope="col">BMDC No</th>
        <th   style="width: 14.2857%; text-align: center; vertical-align:middle;" scope="col">Specialty</th>
        {{-- <th style="width: 14.2857%; text-align: center; vertical-align:middle;" scope="col">Experiences</th> --}}
        </tr>
    </thead>

    <tbody>
         @foreach ($doctorList as $key=>$item)

                 @php
                 //test doc account checking condition starts 
                 if ((strpos(strtolower($item['name']), 'test') !== false) || (strpos(strtolower($item['name']), 'mridul samadder') !== false) ) {} else {
                 
                 $new_photo_url = ""; 
                 $current_url="";
                 if(isset($item['photoUrl'])) {
                    if(($item['photoUrl'] != null) || ($item['photoUrl'] != "")) {
                        $current_url = $item['photoUrl']; }
                    }

                        if(($current_url != null) || ($current_url != "")) {
                        $image_name = "";
                        $file_path = "";
                        
                        $image_name = substr($current_url, (((int)strpos($current_url, "/api/download/")) + 14));
                        $new_photo_url = "https://telocuretest.com/public/images/profilepic/".$image_name;
                        
                    }
               @endphp
               {{-- //end image get from api image url  --}}
         <tr style="background-color: ">
                {{-- <td style="vertical-align: middle;">{{++$key}}</td> --}}
                <td style="vertical-align: middle;"> @if(isset($item['photoUrl']))
                        {{-- <img style="width:100px;height:100px;"  src="{{$item['photoUrl']}}"/> call with api --}}
                         <img style="width:100px;height:100px;"  src="{{$new_photo_url}}"/>
                    @else N/A @endif</td>
                <td style="vertical-align: middle;">@if(isset($item['name'])) {{$item['name']}} @else N/A  @endif</td>
                <td style="vertical-align: middle;">@if(isset($item['degree']))
                    @php                        
                        //$others = json_decode($item['others'],true);
                        //echo $others['acadeimcDegree'].",".$others['otherDegree'];
                        $others = $item['degree'];
                        echo (isset($others['acadeimcDegree'])?$others['acadeimcDegree']:"").(isset($others['otherDegree'])?', '.$others['otherDegree']:"");
                    @endphp
                    @else N/A  @endif</td>
                    {{-- <td style="vertical-align: middle;"> MBBS</td> --}} 
                <td style="vertical-align: middle;">@if(isset($item['regNo'])) {{$item['regNo']}} @else N/A  @endif</td>
                <td style="vertical-align: middle;">@if(isset($item['doctorType'])) {{$item['doctorType']}} @else N/A  @endif</td>
                 {{-- <td style="vertical-align: middle;">@if(isset($item['yearsOfExprience'])) {{$item['yearsOfExprience'].' Years'}} @else N/A  @endif</td>  --}}

         </tr>
         @php }  @endphp {{-- test doc account condition ends--}}
         @endforeach
    </tbody>
                                        </table>
                                        <div class="col-md-6 col-lg-6 jquery-script-clear"></div>
                                </div>
                            </div>
                    </div><!-- /.card-body -->
                </div>

            </div>
        </div>
    </div>
@endsection
