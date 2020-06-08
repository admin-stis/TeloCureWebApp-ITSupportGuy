@extends('hospital.layout')

@section('content')

@php
    if(isset($userProfile['name'])) $firstName = $userProfile['name'] ; else $firstname = 'N/A' ;
    if(isset($userProfile['lastname'])) $lastName = $userProfile['lastname'] ; else $lastName = 'N/A' ;
    if(isset($userProfile['phone'])) $phone = $userProfile['phone'] ; else $phone = 'N/A' ;
    if(isset($userProfile['email'])) $email = $userProfile['email'] ; else $email = 'N/A' ;
    //dd($hospitalInfo['hospitalName']);
    //dd($branchInfo);
    $branchCounter = count($branchInfo);
    //dd($branchCounter);
@endphp

<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark" style="float:left;">Add Doctor</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('hospital')}}">Dashboard</a></li>
            @php
                // $uid = trim($userProfile['uid']);
            @endphp
            <li class="breadcrumb-item active">New Doctor</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

   <section class="content">
        <div class="row col-md-12">
            <div class="col-md-9 m-0 m-auto d-table" >
                <div class="card" style="min-height: 460px;">
                    <div class="card-header">New Doctor</div>
                    <div class="card-body">
                        @if ($errors->any())
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <p class="alert alert-danger">{{ $error }}</p>
                                @endforeach
                            </ul>
                        @endif

                        @if(Session::has('phonemsg'))
                            <ul><p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('phonemsg') }}</p></ul>
                        @endif

                        @if(Session::has('emailmsg'))
                            <ul><p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('emailmsg') }}</p></ul>
                        @endif

                        @if(Session::has('bank_info-check'))
                            <ul><p class="alert {{ Session::get('alert-class', 'alert-danger') }}">
                            {{ Session::get('bank_info-check') }}</p></ul>
                        @endif

                        <form method="post" action="{{url('admin/hospital/addDoctorAction')}}" enctype="multipart/form-data">
                            @csrf
                            <input name="hospitalUserId" type="hidden" value={{$hosUid}} />
                            <div class="row">
                                {{-- <input name="uid" value="{{$uid}}" type="text"> --}}
                                {{-- <div class="form-group col-md-6">
                                    <label>Hospital</label>
                                    <select id="hospital" class="form-control" name="hospitalName" required>
                                        <option value="">Select Hospital</option>
                                        @foreach ($hospitalInfo as $key => $item)
                                            @if (isset($item['uid']))
                                                <option value="{{$item['uid']}}">{{$item['name']}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div> --}}
                                {{-- <div class="form-group col-md-6">
                                    <label>Branch</label>
                                    <select id="branch" class="form-control" name="branchName">
                                        <option value="">Select Branch</option>
                                    </select>
                                </div> --}}

                                @php
                                    //echo 'branchInfo :  ';
                                    //dd($branchInfo) ;
                                @endphp

                                <div class="form-group col-md-12">
                                    <label>Hospital Branch</label>
                                    <select id="hospital" class="form-control" name="branchuid">
                                        <option value="">Select Branch</option>
                                        @if($branchCounter > 0)     
                                            @foreach ($branchInfo as $key => $item)
                                                {{--@if (isset($item['branchuid']) && isset($item['address']))--}}

                                                    <option value="{{$hospitalInfo['hospitalUid']}}">
                                                     {{$hospitalInfo['hospitalName']}} - {{$hospitalInfo['hospitalAddress']}}</option>
                                                    <option value="{{$item['branchUid']}}">
                                                     {{$item['branch']}} - {{$item['address']}}</option>
                                                {{--@endif--}}
                                            @endforeach
                                            
                                        @else
                                            <option value="{{$hospitalInfo['hospitalUid']}}">
                                                     {{$hospitalInfo['hospitalName']}} - {{$hospitalInfo['hospitalAddress']}}</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>First Name</label> <i class="iconFa fa fa-asterisk color-red"></i>
                                    <div class="row" style="width: 100%;margin-left: 1px;">
                                        <input class="form-control" type="text" value="Dr." style="width:20%;" readonly>
                                        <input class="form-control" type="text" name="firstname" value="{{old('firstname')}}" style="width:80%;" placeholder="Enter First Name">
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Last Name</label> <i class="iconFa fa fa-asterisk color-red"></i>
                                    <input class="form-control" type="text" name="lastname" value="{{old('lastname')}}" placeholder="Enter Last Name">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Date of Birth</label> <i class="iconFa fa fa-asterisk color-red"></i>
                                    <input class="form-control" type="date" name="dateOfBirth" value="{{old('dateOfBirth')}}" placeholder="Enter date of birth">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Gender</label> <i class="iconFa fa fa-asterisk color-red"></i>
                                    <select class="form-control" name="gender" required>
                                        <option vale="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Mobile</label> <i class="iconFa fa fa-asterisk color-red"></i>
                                    <div class="row" style="width: 100%;margin-left: 1px;">
                                        <input class="form-control" type="text" value="+88" style="width:20%;" readonly>
                                        <input class="form-control" type="text" name="phone" value="{{old('phone')}}" style="width:80%;" placeholder="Enter Mobile">
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Email</label>  <i class="iconFa fa fa-asterisk color-red"></i>
                                    <input class="form-control" type="email" name="email" value="{{old('email')}}" placeholder="Enter Email">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>District</label> <i class="iconFa fa fa-asterisk color-red"></i>
                                    <select class="form-control" type="text" name="district">
                                        <option>Select district</option>
                                        @foreach ($districtlist as $item)
                                            <option value="{{$item['name']}}">{{$item['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Type</label> <i class="iconFa fa fa-asterisk color-red"></i>
                                    <select class="form-control" type="text" name="type" required>
                                        <option>Select Type</option>
                                        <option value="GENERAL">General</option>
                                        <option value="PEDIATRIC">Pediatric</option>
                                    </select>
                                </div>
                                {{--<div class="form-group col-md-12">
                                    <label>BMDC License Number</label> <i class="iconFa fa fa-asterisk color-red"></i>
                                    <input class="form-control" type="text" name="registration" placeholder="Doctor License Number" value="{{old('registration')}}">
                                </div>--}}
                                {{--<div class="form-group col-md-12">
                                    <label>Profile Picture</label> <i class="iconFa fa fa-asterisk color-red"></i>
                                    <input class="" type="file" name="photoUrl">
                                </div>--}}
                                <div class="form-group col-md-6">
                                    <button class="btn btn-sm btn-info" type="submit">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        $(document).ready(function(){
            $('#hospital').change(function(){
                var id = $('#hospital').val();
                $.ajax({
                    method: 'GET',
                    url: '../getBranch/'+id,
                    success : function(html){
                        // console.log(html);
                        var count = html.length;
                        var option = '';
                        for(var i in html){

                        console.log(i);
                            option += '<option id="'+ html[i].branchId +'">'+ html[i].branch +'</option>';
                            $('#branch').append(option);
                        }
                    },
                    failed : function(){
                        console.log('Wrong');
                    }
                });
            });

        });
    </script>

@endsection
