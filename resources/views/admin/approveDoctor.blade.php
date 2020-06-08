@extends('admin.layout')
@section('content')

@php
  //dd($pending_doctor);
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
                    if(isset($pending_doctor['status'])){
                      $status = ucfirst($pending_doctor['status']);
                      if($status == 'False') echo 'Pending';
                              else echo $status ;
                          }
                        @endphp
                Doctor</li>
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
                          if(isset($pending_doctor['status'])){
                              $status = ucfirst($pending_doctor['status']);
                              if($status == 'False') echo 'Pending';
                              else echo $status ;
                          }
                        @endphp
                        Doctor</span>
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
                                 <th scope="col">#</th>
                                 <th scope="col">Reg No.</th>
                                 <th scope="col">Name</th>
                                 <th scope="col">District</th>
                                 <th scope="col">Phone</th>
                                 <th scope="col">Email</th>
                                 <th scope="col">Action</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php
                                 foreach ($pending_doctor as $key => $value)

                                 {

                                 ?>
                              <tr>
                                 <td>{{++$key}}</td>
                                 <td>@if(isset($value['regNo'])) {{$value['regNo']}} @else N/A @endif</td>
                                 <td>@if(isset($value['name'])) {{$value['name']}} @else N/A  @endif</td>
                                 <td>@if(isset($value['district'])) {{$value['district']}} @else N/A  @endif</td>
                                 <td>@if(isset($value['phone'])) {{$value['phone']}} @else N/A  @endif</td>
                                 <td>@if(isset($value['email'])) {{$value['email']}} @else N/A  @endif</td>
                                 <td>
                                    @if(isset($value['uid']))
                                    <a class="btn btn-sm btn-primary" href="{{url('admin/dprofile/'.trim($value['uid']))}}">View profile</a>
                                    {{-- <a class="btn  btn-sm btn-success" href="{{url('admin/approveDocotr/'.trim($value['uid']))}}">Approve</a>
                                    <a class="btn  btn-sm btn-danger" href="{{url('admin/rejactDoctor/'.trim($value['uid']))}}">Reject</a> --}}
                                    @else
                                    <a class="btn btn-sm btn-primary" href="#">View profile</a>
                                    {{-- <a class="btn btn-sm btn-success btn-disabled" href="#">Approve</a>
                                    <a class="btn btn-sm btn-danger btn-disabled" href="#">Reject</a> --}}
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

