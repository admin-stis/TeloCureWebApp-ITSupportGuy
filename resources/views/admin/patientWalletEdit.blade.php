@extends('admin.layout')

@section('content')

@php 
    //for roles and security 
    $perm_role = Session::get('user_roles');
    $all_perms = $perm_role["perms"]; 
    $editPermission = false; 
    $deletePermission = false; 
    $approvePermission = false; 
    for($i=0; $i<count($all_perms); $i++)
    {
      if($all_perms[$i]=="Edit") { $editPermission = true; }
      if($all_perms[$i]=="Delete") { $deletePermission = true; }
      if($all_perms[$i]=="Approve") { $approvePermission = true; }    
    }
@endphp 



<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Patient Wallet Update</h1> <br/>
          <span style="color:red;">note: wallet value comes from firebase db</span>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('admin/patient')}}">Patient</a></li>
            <li class="breadcrumb-item active">Update Wallet</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>

  <section class="content">
           <div class="col-md-12">
            <div class="card" style="min-height: 460px;">
                         @if ($errors->any())
                    <ul style="margin-top:20px;">
                        @foreach ($errors->all() as $error)
                            <p class="alert alert-danger">{{ $error }}</p>
                        @endforeach
                    </ul>
                @endif
                            @if(Session::has('update_msg'))
                            <ul><p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('update_msg') }}</p></ul>
                        @endif
                        
                <div class="card-body">
                    <form id="adminDocEditForm" method="post" action="{{url('admin/pwalletEditAction')}}" enctype="multipart/form-data">
                    @csrf
                    
                    <input type="hidden" name="uid" value="@if(isset($uid)){{$uid}}@endif"/>
                     <input type="hidden" name="name" value="@if(isset($name)){{$name}}@endif"/>
                    
                        <div class="tab-header">
                            <h5 class="m-0 m-auto d-table">Update Wallet </h5>
                            <hr>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <label class="control-label">Patinet name: </label>
                                <span  id="patname" class="">@if(isset($name)){{$name}}@endif</span>
                            </div>
                            <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <label class="control-label">Balance <i class="iconFa fa fa-asterisk color-red"></i> </label>
                                <input  name="balance" type="text" class="form-control" placeholder="" value="@if(isset($patientWallet['balance'])){{$patientWallet['balance']}}@endif"/>
                            </div>                            
            
                            @if($editPermission)
                                <div class="form-group col-lg-12 col-md-12 col-sm-12">
                                <button class="btn btn-primary" type="submit" id="submit" >Submit</button>
                                </div> 
                            @endif
                            </div> 
                            </form>
                    
</div></div></div>
</section>

@endsection
