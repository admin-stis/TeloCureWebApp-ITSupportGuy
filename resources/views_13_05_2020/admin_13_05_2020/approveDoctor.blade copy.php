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
                       style="position: relative; height: 300px;">

                       <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">First</th>
                  <th scope="col">Last</th>
                  <th scope="col">Handle</th>
                  <th scope="col">Action</th>

                </tr>
              </thead>
              <tbody>
                <?php

                foreach ($pending_doctor as $key => $value)

              {

                ?>
                <tr id="{{($value['uid'])?trim($value['uid']):0}}">
                  <th scope="row">1</th>
                  <td>Mark</td>
                  <td><?php print_r($value['email']) ?></td>
                  <td>@mdo</td>
                  <td>
                    <!-- <a href="{{url('admin/dprofile',$key)}}">View profile</a> -->
                    <!-- <a href="#" id="viewprofile" >View profile</a> -->
                    <button type="button" class="btn btn-primary" onclick="showprofile({{'"'.$value['uid'].'"'}})">Profile</button>

                    <!-- <button type="button" class="btn btn-success" onclick="approve({{'"'.$value['uid'].'"'}})">Approve</button>

                    <button type="button" class="btn btn-warning" onclick="reject({{'"'.$value['uid'].'"'}})">Reject</button> -->


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
});
</script>

















              </section>
            </div>
      </div>
     </section>

@endsection
