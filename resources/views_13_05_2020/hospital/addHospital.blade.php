@extends('hospital.layout')

@section('content')

<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Add Hospital</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Add Hospital</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  <!--
  <section class="content">
    <div class="center" style="text-align:center;color:red">
    @if(Auth::check() && !Auth::user()->hasVerifiedEmail())
      {{-- <p class="alert alert-danger">Please verify your email address. An email containing verification instructions was sent to {{ Auth::user()->email }}.</p> --}}
    @endif
  </div>
  </section>
  -->
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Main row -->
      <div class="row">

        <section class="col-lg-12">
          <!-- TO DO List -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title text-center">
                <i class="ion ion-clipboard mr-1"></i>
                Add Hospital
              </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

                <form method="POST" action="{{url('admin/hospital/addHospitalAction')}}">
                    @csrf
                    <input name="hospitalUserId" type="hidden" value="{{$uid}}" />
                    <div class="form-group row">
                        <label for="branch" class="col-md-4 col-form-label text-md-right">Name</label>
                        <div class="col-md-6"><input id="name" type="text" name="name" required="required" placeholder="Enter Hospital Name" class="form-control "></div>
                    </div>
                    <div class="form-group row">
                        <label for="branch" class="col-md-4 col-form-label text-md-right">Branch</label>
                        <div class="col-md-6"><input id="branch" type="text" name="branchName" required="required" placeholder="Enter Branch Name" class="form-control "></div>
                    </div>
                    <div class="form-group row">
                        <label for="branch" class="col-md-4 col-form-label text-md-right">Address</label>
                        <div class="col-md-6"><textarea id="address" type="text" name="address" required="required" class="form-control ">Enter address</textarea></div>
                    </div>
                    <div class="form-group row">
                        <label for="branch" class="col-md-4 col-form-label text-md-right">Phone</label>
                        <div class="col-md-6"><input id="phone" type="text" name="phone" required="required" placeholder="Enter Contact Number" class="form-control "></div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                            Submit
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
        </section>
        <!-- /.Left col -->


      </div>
      <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
@endsection
