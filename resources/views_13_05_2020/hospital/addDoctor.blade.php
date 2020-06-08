@extends('hospital.layout')

@section('content')

@php
    if(isset($userProfile['name'])) $firstName = $userProfile['name'] ; else $firstname = 'N/A' ;
    if(isset($userProfile['lastname'])) $lastName = $userProfile['lastname'] ; else $lastName = 'N/A' ;
    if(isset($userProfile['phone'])) $phone = $userProfile['phone'] ; else $phone = 'N/A' ;
    if(isset($userProfile['email'])) $email = $userProfile['email'] ; else $email = 'N/A' ;
@endphp

<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark" style="float:left;">Add Doctor</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('admin/hospital')}}">Dashboard</a></li>
            @php
                // $uid = trim($userProfile['uid']);
            @endphp
            {{-- <li class="breadcrumb-item active"><a href="{{url('admin/hospital/addDoctor/'.$uid)}}">New Doctor</a></li> --}}
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
                        <form method="post" action="{{url('admin/hospital/addDoctorAction')}}">
                            @csrf
                            <input name="hospitalUserId" type="hidden" value={{$hosUid}} />
                            <div class="row">
                                {{-- <input name="uid" value="{{$uid}}" type="text"> --}}
                                {{-- <div class="form-group col-md-6">
                                    <label>Hospital</label>
                                    <select id="hospital" class="form-control" name="hospitalName">
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
                                <div class="form-group col-md-12">
                                    <label>Hospital Branch</label>
                                    <select id="hospital" class="form-control" name="branchuid">
                                        <option value="">Select Branch</option>
                                        @foreach ($branchInfo as $key => $item)
                                            @if (isset($item['branchuid']))
                                                <option value="{{$item['branchuid']}}">{{$item['branch']}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>First Name</label>
                                    <input class="form-control" type="text" name="name" placeholder="Enter First Name">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Last Name</label>
                                    <input class="form-control" type="text" name="lastname" placeholder="Enter Last Name">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Date of Birth</label>
                                    <input class="form-control" type="date" name="dateOfBirth" placeholder="Enter date of birth">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Gender</label>
                                    <select class="form-control" name="gender">
                                        <option>Select Gender</option>
                                        <option vale="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Phone</label>
                                    <input class="form-control" type="text" name="phone" placeholder="Enter First Name">
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Email</label>
                                    <input class="form-control" type="text" name="email" placeholder="Enter Last Name">
                                </div>
                                <div class="form-group col-md-12">
                                    <label>Dsitrict</label>
                                    <select class="form-control" type="text" name="district">
                                        <option>Select district</option>
                                        @foreach ($districtlist as $item)
                                            <option value="{{$item['name']}}">{{$item['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-12">
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
