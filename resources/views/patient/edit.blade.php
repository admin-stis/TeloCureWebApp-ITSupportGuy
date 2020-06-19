@extends('patient.layout')

@section('content')

@php
    //dd($district);
@endphp

<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Patient Update</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('/patient')}}">Home</a></li>
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
                <form role="form" method="post" action="{{url('patient/editAction/'.$patient[0]['uid'])}}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="uid" value="{{$patient[0]['uid']}}">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <label class="control-label">Profile Picture <i class="iconFa fa fa-asterisk color-red"></i> </label>

                                {{--<input name="photoUrl" type="file" class="form-control" placeholder="" />--}}

                                <input name="old_photoUrl" type="hidden" class="form-control"
                                value="@if(isset($patient[0]['photoUrl'])){{$patient[0]['photoUrl']}} @endif" />
                                <input name="photoUrl" type="file" class="form-control" placeholder="" value="@if(isset($patient[0]['photoUrl'])){{$patient[0]['photoUrl']}} @endif"/>
                            </div>

                            <div class="form-group col-sm-12">
                                <label>Name :</label>
                                <input class="form-control" name="name" value="{{$patient[0]['name']}}">
                            </div>
                            <div class="form-group col-sm-6">
                                <label>Date of Birth :</label>
                                <input class="form-control" name="dateOfBirth" type="date"
                                value="@if(isset($patient[0]['dateOfBirth'])){{$patient[0]['dateOfBirth']}}@endif">
                            </div>
                            <div class="form-group col-sm-6">

                                <label>Gender :</label>
                                <select class="form-control" type="text" name="gender" required>
                                    <option value=" ">Select Gender</option>
                                    <option value="Male" @if(isset($patient[0]['gender']) && $patient[0]['gender'] == 'Male') selected @endif>Male</option>
                                    <option value="Female" @if(isset($patient[0]['gender']) && $patient[0]['gender'] == 'Female') selected @endif>Female</option>
                                </select>

                            </div>
                            <div class="form-group  col-sm-4">
                                <label>Blood Group :</label>
                                <select name="bloodGroup" class="form-control" required>
                                    <option value="A+" @if(isset($patient[0]['bloodGroup']) && $patient[0]['bloodGroup'] == 'A+') selected @endif>A+</option>
                                    <option value="A-" @if(isset($patient[0]['bloodGroup']) && $patient[0]['bloodGroup'] == 'A-') selected @endif>A-</option>
                                    <option value="AB+" @if(isset($patient[0]['bloodGroup']) && $patient[0]['bloodGroup'] == 'AB+') selected @endif>AB+</option>
                                    <option value="AB-" @if(isset($patient[0]['bloodGroup']) && $patient[0]['bloodGroup'] == 'AB-') selected @endif>AB-</option>
                                    <option value="B+" @if(isset($patient[0]['bloodGroup']) && $patient[0]['bloodGroup'] == 'B+') selected @endif>B+</option>
                                    <option value="B-" @if(isset($patient[0]['bloodGroup']) && $patient[0]['bloodGroup'] == 'B-') selected @endif>B-</option>
                                    <option value="O+" @if(isset($patient[0]['bloodGroup']) && $patient[0]['bloodGroup'] == 'O+') selected @endif>O+</option>
                                    <option value="O-" @if(isset($patient[0]['bloodGroup']) && $patient[0]['bloodGroup'] == 'O-') selected @endif>O-</option>
                                </select>
                            </div>
                            <div class="form-group  col-sm-4">
                                <label>weight :</label>
                                <input class="form-control" name="weight"
                                value="@if(isset($patient[0]['weight'])){{$patient[0]['weight']}}@endif">
                            </div>
                            <div class="form-group  col-sm-4">
                                <label>Height :</label>
                                <input class="form-control" name="height"
                                value="@if(isset($patient[0]['height'])){{$patient[0]['height']}}@endif">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label>District :</label>
                                <select name="district" class="form-control" required>
                                    <option value=" ">Select District</option>
                                    @foreach ($district as $item)
                                        <option value="{{$item['name']}}"
                                        @if(isset($patient[0]['district']) && $item['name'] == $patient[0]['district']) selected @endif
                                        >{{$item['name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group  col-sm-6">
                                <label>Email :</label>
                                <input class="form-control" name="email"
                                value="@if(isset($patient[0]['email'])){{$patient[0]['email']}}@endif">
                            </div>
                            <div class="form-group  col-sm-6">
                                <label>Phone :</label>
                                <input class="form-control" name="phone"
                                value="@if(isset($patient[0]['phone'])){{$patient[0]['phone']}}@endif">
                            </div>
                        </div>
                        <div>
                            <button class="btn-sm btn btn-success pull-right">Update</button>
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
