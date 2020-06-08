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
               <li class="breadcrumb-item"><a href="#">Home</a></li>
               <li class="breadcrumb-item active">Dashboard</li>
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
                     <span class=""><i class="fas fa-list mr-1"></i> List of Pending Hospital</span>
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
                           <input id="search" type="text" class="col-md-6 col-lg-6 form-control"  placeholder="Search..."/>
                        </div>
                        <table class="table">
                           <thead>
                              <tr>
                                 <th scope="col">#</th>
                                 <th scope="col">Name</th>
                                 <th scope="col">Phone</th>
                                 <th scope="col">Email</th>
                                 <th scope="col">Hospital Name</th>
                                 <th scope="col">Address</th>
                                 <th scope="col">Action</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php
                                 foreach ($pending_hospitalUser as $key => $value)
                                 {
                                    if(isset($item['name'])) $name = $item['name']; else $name = 'N/A' ;
                                    if(isset($item['email'])) $email = $item['email']; else $email = 'N/A' ;
                                    if(isset($item['phone'])) $phone = $item['phone']; else $phone = 'N/A' ;
                                    if(isset($item['hospitalName'])) $hospitalName = $item['hospitalName']; else $hospitalName = 'N/A' ;
                                    if(isset($item['hospitalAddress'])) $hospitalAddress = $item['hospitalAddress']; else $hospitalAddress = 'N/A' ;
                                    if(isset($item['plan'])) $plan = ucfirst($item['plan']); else $plan = 'N/A' ;
                                    if(isset($item['approve'])) $approve = $item['approve']; else $approve = 'pending' ;
                                 ?>
                              <tr>
                                <td>{{++$key}}</td>
                                <td>{{$name}}</td>
                                <td>{{$phone}}</td>
                                <td>{{$email}}</td>
                                <td>{{$plan}}</td>
                                <td>{{$hospitalName}}</td>
                                <td>{{$hospitalAddress}}</td>
                                <td>
                                    <a class="btn btn-primary btn-sm" href="{{url('admin/viewHospitalUser')}}">View</a>
                                    @if($approve == true && $approve != '')
                                        <a class="btn btn-info btn-sm" href="{{url('admin/approveHospitalUser')}}" disabled>Approved</a>
                                        <a class="btn btn-danger btn-sm" href="{{url('admin/unapproveHospitalUser')}}">Reject</a>
                                    @elseif($approve == false && $approve != '')
                                        <a class="btn btn-success btn-sm" href="{{url('admin/approveHospitalUser')}}">Approve</a>
                                        <a class="btn btn-info btn-sm" href="{{url('admin/unapproveHospitalUser')}}"  disabled>Rejected</a>
                                    @else
                                        <a class="btn btn-success btn-sm" href="{{url('admin/approveHospitalUser')}}">Approve</a>
                                        <a class="btn btn-danger btn-sm" href="{{url('admin/unapproveHospitalUser')}}">Reject</a>
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
            {{--
            <div class="container mt-10">
               <h2>Activate Modal with JavaScript</h2>
               <!-- Trigger the modal with a button -->
               <button type="button" class="btn btn-primary" id="myBtn">Open Modal</button>
               <!-- The Modal -->
               <div class="modal fade" id="myModal">
                  <div class="modal-dialog modal-lg">
                     <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                           <div >
                              <h4 class="modal-title" id="doctorname">jon doe</h4>
                           </div>
                           <button type="button" class="close" data-dismiss="modal">×</button>
                        </div>
                        <!-- Modal body -->
                        <div class="modal-body">
                           <div style="text-align: center;margin-bottom:10px;">
                              <img src="{{ asset('backend/dist/img/user1-128x128.jpg') }}" alt="User Avatar" class="img-size-100 mr-6 img-circle">
                           </div>
                           <table class="table" style="text-align: center;border: 1px solid lightgray">
                              <thead>
                                 <tr>
                                    <th scope="col">Name</th>
                                    <th id="name" scope="col"></th>
                                 </tr>
                                 <tr>
                                    <th scope="col">Email</th>
                                    <th id="email" scope="col">demo@gmial.com</th>
                                 </tr>
                                 <tr>
                                    <th scope="col">Phone</th>
                                    <th id="phone" scope="col">017222333</th>
                                 </tr>
                                 <tr>
                                    <th scope="col">Special</th>
                                    <th id="special" scope="col">Gearal</th>
                                 </tr>
                                 <tr>
                                    <th scope="col">District</th>
                                    <th id="distric" scope="col">Dhaka</th>
                                 </tr>
                              </thead>
                           </table>
                        </div>
                        <!-- Modal footer -->
                        <div class="modal-footer">
                           <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            --}}
            <script>
               /*
               function showprofile(argument) {

               $.ajax({url: "http://localhost:8000/admin/dprofile/"+argument, success: function(result){
                   // $("#div1").html(result);
                   // alert(result.dateOfBirth);
                   $("#name").html(result.name);
                   $("#email").html(result.email);
                   $("#phone").html("01737377773");
                   $("#special").html(result.doctorType);
                   $("#distric").html(result.district);
                  $("#myModal").modal();

                 }});


               }

               function approve(id){

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

