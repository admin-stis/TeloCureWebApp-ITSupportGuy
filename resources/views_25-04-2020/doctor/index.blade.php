@extends('doctor.layout')

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
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
      <div class="center" style="text-align:center;color:red">
      @if(Auth::check() && !Auth::user()->hasVerifiedEmail())
        <p>Please verify your email address. An email containing verification instructions was sent to {{ Auth::user()->email }}.</p>
      @endif
    </div>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-12 connectedSortable">
            <!-- TO DO List -->
            <div class="card">
              <!-- /.card-header -->
              <div class="">
                  <div class="btn-group w-100 mb-2">
                    <a class="btn btn-primary active" href="javascript:void(0)" data-filter="all"> Weekly Earnings </a>
                    <a class="btn btn-primary" href="javascript:void(0)" data-filter="1"> Statements </a>
                    <a class="btn btn-primary" href="javascript:void(0)" data-filter="1"> 01 Jun </a>
                    <a class="btn btn-primary" href="javascript:void(0)" data-filter="1"> 02 Jun </a>
                    <a class="btn btn-primary" href="javascript:void(0)" data-filter="1"> 03 Jun </a>
                    <a class="btn btn-primary" href="javascript:void(0)" data-filter="1"> 04 Jun </a>
                    <a class="btn btn-primary" href="javascript:void(0)" data-filter="1"> 05 Jun </a>
                    
                  </div>
                  <div style="padding: 50px 15px">
                    <h3>Total Earning</h3>
                    <h2><b>$50.00</b></h2>
                  </div>
                  <div style="padding:0 15px; border-top: 1px solid #ddd">
                    
                    <div class="row">
                        <div class="col-md-4" style="border-right: 1px solid #ddd">
                          <h4>0</h4>
                          <h4>Completed Trips</h4>
                        </div>
                        <div class="col-md-8">
                          <h4>10hr</h4>
                          <h4>Online Hours</h4>
                        </div>
                      </div>
                  </div>
              </div>
              <a class="btn btn-info active text-left" href="javascript:void(0)" data-filter="all"> Weekly Earnings </a>
              <!-- /.card-body -->
              
            </div>
            <!-- /.card -->
          </section>

          <section class="col-lg-12 connectedSortable">
            <!-- TO DO List -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="ion ion-clipboard mr-1"></i>
                  Bank Account Details
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <ul class="todo-list" data-widget="todo-list" style="width: 50%; float: left;">
                  
                  <li>
                    <span class="text">Name  of Account Holder</span>
                  </li>
                  <li>
                    <i class="nav-icon fas fa-book mr-1"></i>
                    <span class="text">Md. Mafizur Rahman</span>
                  </li>

                  <li>
                    <span class="text">Bank Account Number</span>
                  </li>
                  <li>
                    <i class="nav-icon fas fa-book mr-1"></i>
                    <span class="text">0000 0000 0000 0000</span>
                  </li>

                  <li>
                    <span class="text">Address</span>
                  </li>
                  <li>
                    <i class="nav-icon fas fa-book mr-1"></i>
                    <span class="text">-----------------</span>
                  </li>

                  <li>
                    <span class="text">State</span>
                  </li>
                  <li>
                    <i class="nav-icon fas fa-book mr-1"></i>
                    <span class="text">------------------</span>
                  </li>
                  
                </ul>
                <ul class="todo-list" data-widget="todo-list" style="width: 50%; float: left;">
                  
                  <li>
                    <span class="text">Routing Number</span>
                  </li>
                  <li>
                    <i class="nav-icon fas fa-book mr-1"></i>
                    <span class="text">000000000</span>
                  </li>

                  <li>
                    <span class="text">Date of Birth</span>
                  </li>
                  <li>
                    <i class="nav-icon fas fa-book mr-1"></i>
                    <span class="text">15 Oct 2000</span>
                  </li>

                  <li>
                    <span class="text">City</span>
                  </li>
                  <li>
                    <i class="nav-icon fas fa-book mr-1"></i>
                    <span class="text">-----------------</span>
                  </li>

                  <li>
                    <span class="text">Postal Code</span>
                  </li>
                  <li>
                    <i class="nav-icon fas fa-book mr-1"></i>
                    <span class="text">------------------</span>
                  </li>
                  
                </ul>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </section>

          <!-- /.Left col -->


        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
     @endsection 