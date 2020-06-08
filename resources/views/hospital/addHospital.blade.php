@extends('hospital.layout')

@section('content')

@php

//dd($hospital[0]['hospitalName']);

if(isset($hospital[0]['hospitalName'])) $hospitalName = $hospital[0]['hospitalName'];
else $hospitalName  = 'N/A';

@endphp

<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark" style="float:left;">New Hospital</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{''}}"> Home</a></li>
            <li class="breadcrumb-item active"> New Hospital</li>
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
      <div class="row" style="background: #f8f9fa;
      padding: 10px;
      border: 5px solid #dee2e6;
      border-radius: 8px;">

        <section class="col-md-6 m-0 m-auto d-table">
          <!-- TO DO List -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title text-center">
                <i class="ion ion-clipboard mr-1"></i>
                Add Hospital Branch
              </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

                <form method="POST" action="{{url('admin/hospital/addBranchAction')}}">
                    @csrf
                    <input name="hospitalUserId" type="hidden" value="{{$uid}}" />
                    <input name="hospitalName" name="hospitalName" type="hidden" value="{{$hospitalName}}"/>

                    <div class="form-group row d-none">
                        <label for="branch" class="col-md-4 col-form-label text-md-right">Name <i class="iconFa fa fa-asterisk color-red"></i></label>
                        <div class="col-md-6"><input id="name" type="text" name="name" value="{{old('name')}}" placeholder="Enter Hospital Name" class="form-control "></div>
                    </div>

                    <div class="form-group row">
                        <label for="branch" class="col-md-4 col-form-label text-md-right">Branch</label>
                        <div class="col-md-6"><input id="branch" type="text" name="branchName" required="required" placeholder="Enter Branch Name" class="form-control " value="{{old('branchName')}}"></div>
                    </div>

                    <div class="form-group row">
                        <label for="branch" class="col-md-4 col-form-label text-md-right">Address <i class="iconFa fa fa-asterisk color-red"></i></label>
                        <div class="col-md-6"><textarea id="address" type="text" name="address" value="{{old('address')}}" required="required" class="form-control ">Enter address</textarea></div>
                    </div>
                    
                    <div class="form-group row  d-none">
                        <label for="branch" class="col-md-4 col-form-label text-md-right">Phone</label>
                        <div class="col-md-6"><input id="phone" type="text" name="phone" placeholder="Enter Contact Number" class="form-control "></div>
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
