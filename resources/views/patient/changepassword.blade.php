@extends('patient.layout')

@section('content')

<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark" style="float:left;">
              @php
                $t = ucfirst($title);
              @endphp
              {{$t}}</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('/'.$title)}}">Home</a></li>
              <li class="breadcrumb-item active">Change Password</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <section class="content">
      <div class="container-fluid">
        <div class="card col-md-6" style="margin:0 auto;display:table;">
        @if ($errors->any())
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <p class="alert alert-danger">{{ $error }}</p>
                                    @endforeach
                                </ul>
        @endif
          @if(Session::has('change-password'))
            <ul><p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('change-password') }}</p></ul>
          @endif
          @if(Session::has('error-changepassword'))
            <ul><p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('error-changepassword') }}</p></ul>
          @endif
          <div class="card-header"><span style="margin-left:22px">Change Password</span></div>
          @php

          @endphp
          <div class="card-body" >
            <form class="" method="post" action="{{url('changepassword')}}">
              @csrf
              <input type="hidden" name="title" value="{{$title}}">
              <input type="hidden" name="id" value="{{$id}}">
              <div class="form-group">
                <input class="form-control" type="text" name="Password" required="true" placeholder="Enter New Password">
              </div>
              <div class="form-group">
                <button class="btn btn-sm btn-primary" name="submit" value="submit">Submit</button>
              </div>
            </form>
          </div>
          <div class="card-footer"></div>
        </div>
      </div>
    </section>

<script>

</script>

@endsection
