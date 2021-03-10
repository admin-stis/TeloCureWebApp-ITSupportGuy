@extends('admin.layout')

@section('content')
@php
    //dd($transaction);
@endphp
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark" style="float:left;">Transaction Details</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('admin')}}">Dashboard</a></li>
            @php
                // $uid = trim($transaction['uid']);
            @endphp
            <li class="breadcrumb-item active">Transaction Details</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>

  <section class="content">
    <div class="container-fluid">

        <div class="row">
        <!-- Left col -->
            <section class="col-lg-12">
                <div class="row profile">
                        @if(Session::has('error_msg'))
                            <ul><p class="alert {{ Session::get('alert-class', 'alert-error') }}">{{ Session::get('error_msg') }}</p></ul>
                        @endif
                    @if(isset($transaction[0]))    
                    <div class="col-md-12 text-center" style="backgroud:#fff;padding: 10px;background:white;"><h4>Transaction History</h4></div>
                    <div class="row col-md-12" style="background: #fff;">
                        <div class="doctor col-sm-12 col-md-4 col-lg-4" style="background: #363748;color: #fff;padding: 10px;">
                            <h4 class="text-center">Doctor</h4><hr>
                            <div class="col-sm-12">

                                @php
                                    $doctor = json_decode($transaction[0]['doctor'],TRUE);
                                @endphp

                                <div><label>Registration No. :</label>
                                <span>{{$doctor['regNo']}}</span></div>
                                <div><label>Name :</label>
                                <span>{{$doctor['name']}}</span></div>
                                <div><label>Doctor Type :</label>
                                <span>{{$doctor['doctorType']}}</span></div>
                                <div><label>Phone :</label>
                                @if(isset($doctor['phone']))
                                    <span>{{$doctor['phone']}}</span></div>
                                @else
                                    <span>N/A</span></div>
                                @endif
                                <div><label>Email :</label>
                                <span>{{$doctor['email']}}</span></span></div>

                            </div>
                        </div>
                        <div class="patient col-sm-12 col-md-4 col-lg-4" style="background: #2d1d28;
                        padding: 10px;
                        color: #fff;">
                            <h4 class="text-center">Patient</h4><hr>

                            @php

                                $patient = json_decode($transaction[0]['patient'],TRUE);

                            @endphp


                            <div class="col-sm-12">
                                <div><label>Patient ID :</label>
                                <span class="col-sm-7">{{$patient['uid']}}</span>

                                <div><label>Name :</label>
                                <span>{{$patient['name']}}</span>

                                @if(isset($transaction['phone']))
                                <div>
                                    <label><i  class="fa fa-phone"></i> Phone :</label>
                                    <span>{{$patient['phone']}}</span></div>
                                @else
                                    <span>N/A</span></div>
                                @endif

                                @if(isset($patient['email']))
                                <div><label>Email :</label>
                                <span>{{$patient['email']}}</span></div>
                                @endif

                                @if(isset($patient['district']))
                                <div><label>District :</label>
                                <span>{{$patient['district']}}</span></div>
                                @endif

                                @if(isset($patient['totalRating']))
                                <div><label>Rating :</label>
                                <span>{{$patient['totalRating']}}</span></div>
                                @endif
                                @if(isset($patient['totalCount']))
                                <div><label>Total Count :</label>
                                <span>{{$patient['totalCount']}}</span></div>

                            @endif
                            </div>
                        </div>
                        </div>
                        <div class="transaction col-sm-12 col-md-4 col-lg-4" style="background: #2e5463;
                        color: #fff;
                        padding: 10px;">
                            <h4 class="text-center">Transaction</h4><hr>

                            @php
                                $transactionHistory = json_decode($transaction[0]['transactionHistory'],TRUE);
                            @endphp


                            <div class="col-md-12">
                                <div>
                                    <label>Visit Fee :</label>
                                          <span>{{$transactionHistory['visitFee']}}</span> Tk</div>
                                <div>
                                    <label>Service Fee :</label>
                                          <span>{{$transactionHistory['serviceFee']}}</span> Tk</div>
                                <div>
                                    <label>Discount Fee :</label>
                                          <span>{{$transactionHistory['discountedValue']}}</span> Tk</div>
                                <div>
                                    <label>Discount Percentage :</label>
                                          <span>{{$transactionHistory['discountPercentage']}}</span>%</div>
                                <div>
                                    <label>Total Time in Second :</label>
                                          <span>{{$transactionHistory['totalTimeInSeconds']}}</span> s</div>
                                <div>
                                    <label> Time Cost :</label>
                                          <span>{{$transactionHistory['timeCost']}}</span> Tk</div>
                                <div>
                                    <label>Total  :</label>
                                          <span>{{$transactionHistory['subTotalRounded']}}</span> Tk</div>

                            </div>
                    </div>
                    @else 
                    <div>No transaction data exists for this visit id or visit id does not exist in mysql db</div>
                    @endif 
                </div>
            </section>
        </div>
    </div>
  </section>

@endsection





