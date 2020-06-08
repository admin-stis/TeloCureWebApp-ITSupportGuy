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
            <li class="breadcrumb-item"><a href="{{url('admin/doctor')}}">Dashboard</a></li>
            @php
                // $uid = trim($transaction['uid']);
            @endphp
            <li class="breadcrumb-item active"><a href="{{url('admin/doctor/')}}">Transaction Details</a></li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>

  <section class="content">
    <div class="container-fluid">

        <div class="row">
        <!-- Left col -->
            <section class="col-lg-12 connectedSortable">
                <div class="row profile">
                    <div class="col-md-12 text-center" style="backgroud:#fff;"><h3>Transaction History</h3></div>
                    <div class="row col-md-12" style="background: #fff;">
                        <div class="doctor col-sm-12 col-md-4 col-lg-4" style="background: #363748;color: #fff;padding: 10px;">
                            <h4 class="text-center">Doctor</h4><hr>
                            <div class="col-sm-12">
                                <div><label>Registration No. :</label>
                                <span>{{$transaction[0]['doctor']['uid']}}</span></div>
                                <div><label>Name :</label>
                                <span>{{$transaction[0]['doctor']['name']}}</span></div>
                                <div><label>Doctor Type :</label>
                                <span>{{$transaction[0]['doctor']['doctorType']}}</span></div>
                                <div><label>Phone :</label>
                                @if(isset($transaction['phone']))
                                    <span>{{$transaction[0]['doctor']['phone']}}</span></div>
                                @else
                                    <span>N/A</span></div>
                                @endif
                                <div><label>Email :</label>
                                <span>{{$transaction[0]['doctor']['email']}}</span></span></div>

                            </div>
                        </div>
                        <div class="patient col-sm-12 col-md-4 col-lg-4" style="background: #2d1d28;
                        padding: 10px;
                        color: #fff;">
                            <h4 class="text-center">Patient</h4><hr>
                            <div class="col-sm-12">
                                <div><label>Patient ID :</label>
                                <span class="col-sm-7">{{$transaction[0]['patient']['uid']}}</span>

                                <div><label>Name :</label>
                                <span>{{$transaction[0]['patient']['name']}}</span>

                                @if(isset($transaction['phone']))
                                <div>
                                    <label><i  class="fa fa-phone"></i> Phone :</label>
                                    <span>{{$transaction[0]['patient']['phone']}}</span></div>
                                @else
                                    <span>N/A</span></div>
                                @endif
                                @if(isset($transaction[0]['patient']['totalRating']))
                                <div><label>Rating :</label>
                                <span>{{$transaction[0]['patient']['totalRating']}}</span></div>
                                @endif
                                @if(isset($transaction[0]['patient']['totalCount']))
                                <div><label>Total Count :</label>
                                <span>{{$transaction[0]['patient']['totalCount']}}</span></div>

                            @endif
                            </div>
                        </div>
                        </div>
                        <div class="transaction col-sm-12 col-md-4 col-lg-4" style="background: #2e5463;
                        color: #fff;
                        padding: 10px;">
                            <h4 class="text-center">Transaction</h4><hr>
                            <div class="col-md-12">
                                <div>
                                    <label>Visit Fee :</label>
                                          <span>{{$transaction[0]['transactionHistory']['visitFee']}}</span> Tk</div>
                                <div>
                                    <label>Service Fee :</label>
                                          <span>{{$transaction[0]['transactionHistory']['serviceFee']}}</span> Tk</div>
                                <div>
                                    <label>Discount Fee :</label>
                                          <span>{{$transaction[0]['transactionHistory']['discountedValue']}}</span> Tk</div>
                                <div>
                                    <label>Discount Percentage :</label>
                                          <span>{{$transaction[0]['transactionHistory']['discountPercentage']}}</span>%</div>
                                <div>
                                    <label>Total Time in Second :</label>
                                          <span>{{$transaction[0]['transactionHistory']['totalTimeInSeconds']}}</span> s</div>
                                <div>
                                    <label> Time Cost :</label>
                                          <span>{{$transaction[0]['transactionHistory']['timeCost']}}</span> Tk</div>
                                <div>
                                    <label>Total  :</label>
                                          <span>{{$transaction[0]['transactionHistory']['subTotalRounded']}}</span> Tk</div>

                            </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
  </section>

@endsection





