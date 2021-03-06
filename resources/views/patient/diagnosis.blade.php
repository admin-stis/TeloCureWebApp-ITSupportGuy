@extends('patient.layout')

@section('content')
<!-- Content Header (Page header) -->
@php
// dd($patient);
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
            <li class="breadcrumb-item active">Diagnosis</li>
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
                Diagnosis Information
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
                  $pres['vital'] = json_decode($pres[0]['vital'],TRUE);
                @endphp
                
                <div class="">Blood Pressure : @if(isset($pres['vital']['bpm'])){{$pres['vital']['bpm']}} @else N/A @endif</div>
                {{--
                  <div class="">Measure Time : @if(isset($pres['vital']['measureTime'])){{$pres['vital']['measureTime']}}  @else N/A @endif</div>
                --}}
                <div class="">Respiration : @if(isset($pres['vital']['resp'])){{$pres['vital']['resp']}} @else N/A @endif</div>
                <div class="">Temparature : @if(isset($pres['vital']['temp'])){{$pres['vital']['temp']}} @else N/A @endif</div>

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
