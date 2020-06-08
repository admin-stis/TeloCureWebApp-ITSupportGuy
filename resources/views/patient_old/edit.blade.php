@extends('patient.layout')

@section('content')

<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Patient Update</h1>
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

        <section class="col-lg-12 connectedSortable">
          <!-- TO DO List -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title text-center">
                <i class="ion ion-clipboard mr-1"></i>
                Update Patient
              </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form role="form" method="post" action="{{url('patient/editAction/'.$patient[0]['uid'])}}">
                    @csrf
                    <input type="hidden" name="uid" value="{{$patient[0]['uid']}}">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label>Name :</label>
                                <input class="form-control" name="name" value="{{$patient[0]['name']}}">
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Date of Birth :</label>
                                <input class="form-control" name="dateOfBirth" value="{{$patient[0]['dateOfBirth']}}">
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Gender :</label>
                                <input class="form-control" name="gender" value="{{$patient[0]['gender']}}">
                            </div>
                            <div class="form-group  col-sm-4">
                                <label>Blood Group :</label>
                                <input class="form-control" name="bloodGroup" value="{{$patient[0]['bloodGroup']}}">
                            </div>
                            <div class="form-group  col-sm-4">
                                <label>weight :</label>
                                <input class="form-control" name="weight" value="{{$patient[0]['weight']}}">
                            </div>
                            <div class="form-group  col-sm-4">
                                <label>Height :</label>
                                <input class="form-control" name="height" value="{{$patient[0]['height']}}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label>District :</label>
                                <input class="form-control" name="district" value="{{$patient[0]['district']}}">
                            </div>
                            <div class="form-group  col-sm-6">
                                <label>Email :</label>
                                <input class="form-control" name="email" value="{{$patient[0]['email']}}">
                            </div>
                            <div class="form-group  col-sm-6">
                                <label>Phone :</label>
                                <input class="form-control" name="phone" value="{{$patient[0]['phone']}}">
                            </div>
                        </div>
                        <div>
                            <button class="btn-small btn btn-success pull-right"><i class="fa fa-edit"> Edit</i></button>
                        </div>
                    </div>
                </form>
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
