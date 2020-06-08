@extends('admin.layout')

@section('content')

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
                  <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                </form>
              </div>
        </div>
      </div>
    </section>
@endsection