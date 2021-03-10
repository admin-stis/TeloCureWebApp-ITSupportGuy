@extends('admin.layout')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
         </div>
         <!-- /.col -->
         <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="{{url('admin')}}">Home</a></li>
               <li class="breadcrumb-item active">Manage Payments</li>
            </ol>
         </div>
         <!-- /.col -->
      </div>
      <!-- /.row -->
   </div>
   <!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<section class="content">
   <div class="container-fluid">
      <div class="row">
         <!-- Left col -->
         <section class="col-lg-12">
            <div class="card">
               <div class="card-header">
                  <div class="col-md-12">
                     <span class=""><i class="fas fa-list mr-1"></i>Password Security</span>
                  </div>
                  <div class="col-md-6">
                  </div>
               </div>
               <!-- /.card-header -->
               <div class="card-body">
                @if(Session::has('password_msg'))
                  <ul><p class="alert {{ Session::get('alert-class', 'alert-error') }}">{{ Session::get('password_msg') }}</p></ul>
                @endif
                @if(Session::has('msg'))
                  <ul><p class="alert {{ Session::get('alert-class', 'alert-error') }}">{{ Session::get('msg') }}</p></ul>
                @endif
                <form class="" method="post" action="{{url('admin/processManagePayPass')}}">
                @csrf
                <div class="form-group col-6">
                <div class="">
                <span style="margin:5px 0 15px 0px;display:block;font-weight:bold;">Enter security password</span>
                <input class="form-control" type="text" id="password" name="password" value="" style="">
                </div></div>             
              <div class="form-group col-6">
                <button class="btn btn-sm btn-success" name="submit" value="submit">Submit</button>
              </div>
            </form>
               </div>
               <!-- /.card-body -->
            </div>
         </section>
      </div>
   </div>
</section>
@endsection

