{{-- new --}}
@extends('admin.layout')

@section('content')


<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

    <section class="content">
      <div class="container-fluid">

      		<div class="row">
          <!-- Left col -->
          		<section class="col-lg-12 connectedSortable">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                            <i class="fas fa-chart-pie mr-1"></i>
                            Transaction List
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
                                <div class="chart tab-pane active" id="" style="position: relative;">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Doctor Reg No.</th>
                                            <th scope="col">Doctor</th>
                                            <th scope="col">Patient ID</th>
                                            <th scope="col">Patient</th>
                                            <th scope="col">Total</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php

                                            foreach ($visited as $key => $value){
                                            ?>
                                            <tr>
                                                <?php if(isset($visited[$key]['transactionHistory'])) {

                                                ?>
                                                <td scope="col"><?php echo $key+1 ; ?></td>
                                                <td scope="col"><?php echo $visited[$key]['doctor']['regNo']; ?></td>
                                                <td scope="col"><?php echo $visited[$key]['doctor']['name']; ?></td>
                                                <td scope="col"><?php echo $visited[$key]['patient']['uid']; ?></td>
                                                <td scope="col"><?php echo $visited[$key]['patient']['name']; ?></td>
                                                <td scope="col"><?php echo $visited[$key]['transactionHistory']['subTotalRounded']; ?></td>
                                                <td scope="col"><a class="btn btn-primary btn-sm" href="{{url('admin/transaction/'.$visited[$key]['visitId'].'')}}">View</a></td>

                                                <?php } ?>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div><!-- /.card-body -->
                    </div>
         		</section>
          	</div>
      </div>
     </section>

@endsection
