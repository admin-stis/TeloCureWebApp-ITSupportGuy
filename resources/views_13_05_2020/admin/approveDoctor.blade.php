@extends('admin.layout')

@section('content')

<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>


    <section class="content">
      <div class="container-fluid">

          <div class="row">
          <!-- Left col -->
              <section class="col-lg-12 connectedSortable">

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-chart-pie mr-1"></i>
                  List of Doctor
                </h3>
                <div class="card-tools">
                  <!-- <ul class="nav nav-pills ml-auto">
                    <li class="nav-item">
                      <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Area</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#sales-chart" data-toggle="tab">Donut</a>
                    </li>
                  </ul> -->
                </div>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content p-0">
                  <!-- Morris chart - Sales -->
                  <div class="chart tab-pane active" id="revenue-chart"
                       style="position: relative;">

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


                   </div>
                </div>
              </div><!-- /.card-body -->
            </div>











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

<script>

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
});
</script>

















              </section>
            </div>
      </div>
     </section>

@endsection
