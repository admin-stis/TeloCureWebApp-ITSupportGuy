@extends('patient.layout')

@section('content')
<!-- Content Header (Page header) -->
@php
    dd($prescription);
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
            <li class="breadcrumb-item active">Dashboard v1</li>
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
              <h3 class="card-title">
                <i class="ion ion-clipboard mr-1"></i>
                E-prescription Information
              </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="">UID : {{$patient[0]['uid']}}</div>
                <div class="">Name : {{$patient[0]['name']}}</div>
                <div class="">Gender : {{$patient[0]['gender']}}</div>
                <div class="">Phone : {{$patient[0]['phone']}}</div>
                <div class="">Email : {{$patient[0]['email']}} </div>
@php
    // dd($diagnosis);
@endphp
                <div class="">Blood Pressure : @if($diagnosis[0]['bpm']){{$diagnosis[0]['bpm']}} @else N/A @endif</div>
                <div class="">Measure Time : @if($diagnosis[0]['measureTime']){{$diagnosis[0]['measureTime']->get()->format('d-m-Y')}}  @else N/A @endif</div>
                <div class="">Respiration : @if($diagnosis[0]['resp']){{$diagnosis[0]['resp']}} @else N/A @endif</div>
                <div class="">Temparature : @if($diagnosis[0]['temp']){{$diagnosis[0]['temp']}} @else N/A @endif</div>
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
