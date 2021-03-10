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


<!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin')}}">Home</a></li>
              <li class="breadcrumb-item active">Change Plan</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
         <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="card col-md-12">
            <div class="card-header">Change Plan</div>
              <div class="card-body">
                <form method="post" action="{{url('hospital/planchangeaction')}}">
                  @csrf
                  <input type="hidden" name="uid" value="{{$uid}}">
                  <div class="form-group">
                    <label>Plan</label>  
                    <select class="form-control" name="plan">
                      <option value="basic">Basic</option>
                      <option value="silver">Silver</option>
                      <option value="gold">Gold</option>
                      <option value="platinum">Platinum</option>
                    </select>
                  </div>
                  @if($approvePermission)
                  <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                  @endif
                </form>
              </div>
        </div>
      </div>
    </section>
@endsection