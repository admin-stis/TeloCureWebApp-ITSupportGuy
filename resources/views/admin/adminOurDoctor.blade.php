@extends('admin.layout')

@section('content')
 
 

{{-- @include('layouts.doctorMenuBox') --}}
 <div class="card " style="margin: 2%; ">
                    <div class="card-header " style="text-align: center;">
                        {{-- <div class="col-md-12 container">
                            <span ><img style="width:60px;height:60px;" src="{{url('assets/img/doctor.png')}}"  alt="doctor"> <p class="font-weight-bold"> Our Board certified Doctors</p></span>
                        </div> --}}
                        <div class="col-md-6">

                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                            <div class="tab-content p-0">
                            <!-- Morris chart - Sales -->
                                <div class="chart tab-pane active" id="revenue-chart"
                                    style="position: relative;    overflow-x: auto;">
                                    <div class="">
                                        <input id="search" type="text" class="col-md-4 col-lg-4 form-control"  placeholder="Search..."/>
                                    </div>
    <table class="table  table-bordered table-hover responsive-table"  style="text-align: center" >
    <thead>
        <tr class="customers"  style="text-align: center; vertical-align:middle;">
        <th style="width: 14.2857%; text-align: center; vertical-align:middle;" scope="col">Sl No</th>
        <th style="width: 14.2857%; text-align: center; vertical-align:middle; " scope="col">Picture</th>
        <th style="width: 14.2857%; text-align: center; vertical-align:middle; " scope="col">Doc Name</th>
        <th style="width: 14.2857%; text-align: center; vertical-align:middle; " scope="col">Degree</th>
        <th style="width: 14.2857%; text-align: center; vertical-align:middle; " scope="col">BMDC No</th>
        <th style="width: 14.2857%; text-align: center; vertical-align:middle;" scope="col">Specialty</th>
        <th style="width: 14.2857%; text-align: center; vertical-align:middle;" scope="col">Experiences</th>
        </tr>
    </thead>

    <tbody>
         @foreach ($doctorList as $key=>$item)
                {{-- //image get from api image url  --}}
                 @php
                 $new_photo_url = ""; 
                 $current_url="";
                 if(isset($item['photoUrl'])) {
                    if(($item['photoUrl'] != null) || ($item['photoUrl'] != "")) {
                        $current_url = $item['photoUrl']; }
                    }
                       /*  $prodPicUrl = "https://telocure.com/public/images/profilepic/";
                        $testPicUrl = "https://telocuretest.com/public/images/profilepic/";  */

                        if(($current_url != null) || ($current_url != "")) {
                        $image_name = "";
                        $file_path = "";
                        
                        $image_name = substr($current_url, (((int)strpos($current_url, "/api/download/")) + 14));
                         $new_photo_url = "https://telocuretest.com/public/images/profilepic/".$image_name;
                          /* $prod = false; 
                          $test = false;

                        if (strpos($current_url, 'https://telocure.com/public/images/profilepic/') !== false) {
                           $prod = true; 
                          }
                        if (strpos($current_url, 'https://telocuretest.com/public/images/profilepic/') !== false) {
                           $test = true; 
                          }
 

                          if ($prod == true ){
                              $new_photo_url = "https://telocure.com/public/images/profilepic/".$image_name;
                          }
                          if ($test == true ){
                              $new_photo_url = "https://telocuretest.com/public/images/profilepic/".$image_name;
                          }
                         
                        */
                        
                    }
               @endphp
               {{-- //end image get from api image url  --}}
         <tr style="background-color: ">
                <td style="vertical-align: middle;">{{++$key}}</td>
                <td style="vertical-align: middle;"> @if(isset($item['photoUrl']))
                        {{-- <img style="width:100px;height:100px;"  src="{{$item['photoUrl']}}"/> call with api --}}
                         <img style="width:100px;height:100px;"  src="{{$new_photo_url}}"/>
                    @else N/A @endif</td>
                <td style="vertical-align: middle;">@if(isset($item['name'])) {{$item['name']}} @else N/A  @endif</td>
                 <td style="vertical-align: middle;">@if(isset($item['others']))
                    @php
                        $others = json_decode($item['others'],true);
                        echo $others['acadeimcDegree'].",".$others['otherDegree'];
                    @endphp
                    @else N/A  @endif</td>
                <td style="vertical-align: middle;">@if(isset($item['regNo'])) {{$item['regNo']}} @else N/A  @endif</td>
                <td style="vertical-align: middle;">@if(isset($item['doctorType'])) {{$item['doctorType']}} @else N/A  @endif</td>
                 <td style="vertical-align: middle;">@if(isset($item['yearsOfExprience'])) {{$item['yearsOfExprience'].' Years'}} @else N/A  @endif</td> 

         </tr>
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
