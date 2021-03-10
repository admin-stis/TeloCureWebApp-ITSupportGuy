@extends('admin.layout')
@section('content')

@php 
    //for roles and security 
    $perm_role = Session::get('user_roles');
    $all_perms = $perm_role["perms"]; 
    $editPermission = false; 
    $deletePermission = false; 
    $approvePermission = false; 
    for($i=0; $i<count($all_perms); $i++)
    {
      if($all_perms[$i]=="Edit") { $editPermission = true; }
      if($all_perms[$i]=="Delete") { $deletePermission = true; }
      if($all_perms[$i]=="Approve") { $approvePermission = true; }    
    }
@endphp 


@php
  //dd($perm_role["perms"]);
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
                      if($status == 'False') echo 'Rejected';
                              else echo $status ;
                          }
                        @endphp
                Doctor</li>
            </ol>
         </div>
         <!-- /.col -->
      </div>
            <div class="row mb-2">
                  @if(Session::has('update_msg'))
                            <ul><p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('update_msg') }}</p></ul>
                        @endif
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
                              if($status == 'False') echo 'Rejected';
                              else echo $status ;
                          }
                        @endphp
                        Doctor @php if($status == "Online"){ @endphp(<b style="color:red;">Note: To match with production site, this page only shows data from firebase not from mysql, make offline button updates only firebase not mysql, view profile button only works if record also exists in mysql</b>) @php } @endphp</span>
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
                                 <th scope="col">Rating</th>
                                 <th scope="col">Hospital</th>
                                 @if($status=="Online")
                                 <th scope="col">Online time</th>
                                 @else 
                                 <th scope="col">Date</th>
                                 @endif 
                                 <th scope="col">Action</th>
                              </tr>
                           </thead>
                           <tbody>
                           @php $frb_tz = new \DateTimeZone('Asia/Dhaka'); @endphp
                              <?php
                                 foreach ($pending_doctor as $key => $value){
                                    if(!empty($value['regNo'])){
                              ?>
                                   <tr>
                                     <td>{{++$key}}</td>
                                     <td>@if(isset($value['regNo'])) {{$value['regNo']}} @else N/A @endif</td>
                                     <td>@if(isset($value['name'])) {{$value['name']}} @else N/A  @endif</td>
                                     <td>@if(isset($value['district'])) {{$value['district']}} @else N/A  @endif</td>
                                     <td>@if(isset($value['phone'])) {{$value['phone']}} @else N/A  @endif</td>
                                     <td>@if(isset($value['email'])) {{$value['email']}} @else N/A  @endif</td>
                                     <td>
                                                      {{-- mridul 26-7-20 --}}
                                                      @php
                                                        if(isset($value['totalRating']) && isset($value['totalCount']) && $value['totalCount'] > 0)
                                                        {
                                                            $totalRating = $value['totalRating'];
                                                            $totalCount = $value['totalCount'];
                                                            $rating = round(($totalRating/$totalCount),1);
                                                            echo $rating ;
                                                        }
                                                        else
                                                        {
                                                          $rating = 5 ;
                                                          echo $rating ;
                                                        }
                                                      @endphp
                                 </td>
                                 <td>@if(isset($value['hospitalName']) && $value['hospitalName'] !=null){{$value['hospitalName']}} @else N/A @endif</td>
                                 <td> 
                                 @if($status=="Online") 
                                 @if(isset($value['onlineTime']) && $value['onlineTime'] != null)
                                @php                                                         
                                $frb_date = new \DateTime($value['onlineTime']);
                                $frb_date->setTimezone($frb_tz);
                                echo $frb_date->format('d-m-y h:i:s A'); 
                                @endphp
                                 @else
                                 N/A 
                                 @endif
                                 
                                 @else
                                @if(isset($value['createdAt'])) {{-- required else for some doc without date throws error --}}                           
                                @php                                                         
                                $frb_date = new \DateTime($value['createdAt']);
                                $frb_date->setTimezone($frb_tz);
                                echo $frb_date->format('d-m-y h:i:s A'); 
                                @endphp @endif @endif</td>
                                
                                 <td>
                                    @if(isset($value['uid']))
                                    <a class="btn btn-sm btn-primary" href="{{url('admin/dprofile/'.trim($value['uid']))}}">View profile</a> 
                                    
                                    
                                    @php if($status == 'False'){ /* First letter was made capital at first, it's ok */@endphp  
                                       @if($approvePermission)   
                                          <a class="btn btn-sm btn-success" href="{{url('admin/approveDocotr/'.trim($value['uid']))}}">Approve</a>
                                       @endif
                                       @if($deletePermission)                                      
                                          <a class="btn btn-sm btn-danger" href="{{url('admin/dprofileDelAction/'.trim($value['uid']))}}" onclick="return confirm('ARE YOU SURE ?')">Delete</a> 
                                       @endif
                                    @php } @endphp
                                    
                                    @php if($status == "Online"){ @endphp   
                                    @if($editPermission)                                   
                                    <a class="btn btn-sm btn-danger" href="{{url('admin/makedocoffline/'.trim($value['uid']))}}" onclick="return confirm('ARE YOU SURE TO MAKE THE DOCTOR OFFLINE ?')">Make offline</a> 
                                    @endif
                                     @php } @endphp
                                     
                                     
                                    @else
                                    <a class="btn btn-sm btn-primary" href="#">View profile</a>                                                
                                 @endif

                                 </td>
                                   </tr>
                                <?php  }else{

                               }
                              } ?>
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

