@extends('patient.layout')

@section('content')
<!-- Content Header (Page header) -->
@php

    //dd($pres);

@endphp
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">E-prescription</li>
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
                E-prescription Information
              </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body row">

              <div class="col-sm-12 row" style="border-bottom:1px solid;paddimg:5px;">
                <h4>Profile Information</h4>
                <hr>
                <div class="col-sm-12">UID : {{$patient[0]['uid']}}</div>
                <div class="col-sm-6">Name : {{$patient[0]['name']}}</div>
                <div class="col-sm-12 col-md-6 col-lg-6">Gender : {{$patient[0]['gender']}}</div>
                <div class="col-sm-12 col-md-6 col-lg-6">Phone : {{$patient[0]['phone']}}</div>
                <div class="col-sm-12 col-md-6 col-lg-6">Email : {{$patient[0]['email']}} </div>
              </div>
              <hr>

              <div class="col-sm-12 col-md-6 col-lg-6 todo-list connectedSortable"  data-widget="todo-list" style="border-right:1px solid;padding: 10px;margin-top: 20px;">

                <h5>Diagnosis Information</h5>
                <hr>

                <ul class="todo-list" data-widget="todo-list">
                  <li><span class="">Blood Pressure : @if($pres[0]['vital']['bpm']){{$pres[0]['vital']['bpm']}} @else N/A @endif</span></li>
                  <li><span class="">Measure Time : @if($pres[0]['vital']['measureTime']){{$pres[0]['vital']['measureTime']->get()->format('d-m-Y')}}  @else N/A @endif</span></li>
                  <li><span class="">Respiration : @if($pres[0]['vital']['resp']){{$pres[0]['vital']['resp']}} @else N/A @endif</span></li>
                  <li><span class="">Temparature : @if($pres[0]['vital']['temp']){{$pres[0]['vital']['temp']}} @else N/A @endif</span></li>
                </ul>

              </div>

              <div class="col-sm-12 col-md-6 col-lg-6 todo-list connectedSortable"  data-widget="todo-list" style="padding: 10px;margin-top: 20px;">

                <h5>Disease : {{$pres[0]['disease']}}</h4>
                <h4>Medicine</h4>
                @foreach($pres[0]['medicineMap'] as $key => $val)
                  <div>Medicine Name : {{$val['name']}}</div>
                  <hr>
                  <h5>Medicine Time</h5>
                  <ul class="todo-list" data-widget="todo-list">
                    <li><span>Morning : {{$val['morning']}}</span></li>
                    <li><span>Noon : {{$val['noon']}}</span></li>
                    <li><span>Night : {{$val['night']}}</span></li>
                  </ul>
                  <hr>
                @endforeach
              </div>
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
