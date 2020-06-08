@extends('admin.layout')
@section('content')

@php
  //dd($pending_hospital);
@endphp

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
               <li class="breadcrumb-item active">
                 
                        @php
                          //dd($pending_hospital['status']);
                          if(isset($pending_hospital['status'])){
                              $status = ucfirst($pending_hospital['status']);
                              if($status == 'Rejected') echo 'Rejected';
                              else echo $status ;
                          }
                        @endphp
                        Hospital
               </li>
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
         <section class="col-lg-12 connectedSortable">
            <div class="card">
                <div class="card-header">
                    <div class="col-md-12">
                        <span class=""><i class="fas fa-list mr-1"></i> List of 
                        @php
                          //dd($pending_hospital['status']);
                          if(isset($pending_hospital['status'])){
                              $status = ucfirst($pending_hospital['status']);
                              if($status == 'Rejected') echo 'Rejected';
                              else echo $status ;
                          }
                        @endphp
                        Hospital</span>
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
                        <table class="table table-bordered">
                           <thead>
                              <tr>
                                 <th scope="col">#</th>
                                 <th scope="col">Name</th>
                                 <th scope="col">Phone</th>
                                 <th scope="col">Email</th>
                                 <th scope="col">Hospital Name</th>
                                 <th scope="col">Address</th>
                                 <th scope="col">Plan</th>

                                 <th scope="col">Action</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php
                                 //dd($pending_hospital);
                                 foreach ($pending_hospital as $key => $item)

                                 {

                                 ?>
                              @php

                                                    if(isset($item['hospitalUid'])) $id = $item['hospitalUid']; else $id = '';
                                                    if(isset($item['name'])) $name = $item['name']; else $name = 'N/A' ;
                                                    if(isset($item['email'])) $email = $item['email']; else $email = 'N/A' ;
                                                    if(isset($item['phone'])) $phone = $item['phone']; else $phone = 'N/A' ;
                                                    if(isset($item['hospitalName'])) $hospitalName = $item['hospitalName']; else $hospitalName = 'N/A' ;
                                                    if(isset($item['hospitalAddress'])) $hospitalAddress = $item['hospitalAddress']; else $hospitalAddress = 'N/A' ;
                                                    if(isset($item['plan'])) $plan = ucfirst($item['plan']); else $plan = 'N/A' ;
                                                    if(isset($item['active'])) $approve = $item['active']; else $approve = '';
                                                @endphp

                                                <tr>
                                                    <td>{{++$key}}</td>
                                                    <td>{{$name}}</td>
                                                    <td>{{$phone}}</td>
                                                    <td>{{$email}}</td>
                                                    <td>{{$hospitalName}}</td>
                                                    <td>{{$hospitalAddress}}</td>
                                                    <td>{{$plan}}</td>
                                                    
                                                    <td>
                                                        {{-- <a style="margin-top:5px;" class="btn btn-primary btn-sm" href="{{url('admin/viewHospitalUser')}}">View</a> --}}
                                                        @if($approve == true && $approve != '')
                                                            <a  style="margin-top:5px;" class="btn btn-info btn-sm" disabled>Approved</a>
                                                        @elseif($approve == false && $approve != '')
                                                            <a  style="margin-top:5px;" class="btn btn-success btn-sm" href="{{url('admin/approveHospitalUser/'.$id)}}">Approve</a>
                                                        @else
                                                            <a  style="margin-top:5px;" class="btn btn-success btn-sm" href="{{url('admin/approveHospitalUser/'.$id)}}">Approve</a>
                                                        @endif
                                                    </td>
                                                </tr>

                              <?php } ?>
                           </tbody>
                        </table>
                        <div class="col-md-6 col-lg-6 jquery-script-clear"></div>
                     </div>
                  </div>
               </div>
               <!-- /.card-body -->
            </div>

            <script>
               /*function approve(id){

               $.ajax({url: "http://localhost:8000/admin/approveDocotr/"+id.trim(), success: function(result){
               toastr.info('Doctor approve successfully!!');
                rem = '#'+id.trim();
                $(rem).remove();
                 }});
               }


               function reject(id){

               $.ajax({url: "http://localhost:8000/admin/rejactDoctor/"+id.trim(), success: function(result){
               toastr.info('Doctor Registation Rejected!!');
                rem = '#'+id.trim();
                $(rem).remove();
                 }});



               }





               $(document).ready(function(){

                 $("#myBtn").click(function(){

                 });
               });*/
            </script>
         </section>
      </div>
   </div>
</section>
@endsection

