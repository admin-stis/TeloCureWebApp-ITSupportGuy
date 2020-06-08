@extends('frontend.layouts.app')

@section('content')
    @if ($title == 'patient')
    <div class="container patient_login">
    @elseif($title == 'doctor')
    <div class="container doctor_login">
    @elseif($title == 'hospital')
    <div class="container hospital_login">
    @else
    <div class="container">
    @endif

        <div class="row justify-content-center">
        <div class="col-md-8" style="padding: 45px;">
            <div class="card" style="">
                <div class="card-header text-transform-uppercase"><?php echo ucfirst($title);?> Login</div>
                <div class="card-body">
                    @if ($errors->any())
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <p class="alert alert-danger">{{ $error }}</p>
                                    @endforeach
                                </ul>
                        @endif

                        @if(Session::has('msg'))
                            <ul><p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('msg') }}</p></ul>
                        @endif

                        @if(Session::has('notify-temporary'))
                            <ul><p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('notify-temporary') }}</p></ul>
                        @endif

                        

                        {{--
                        @if(Session::has('notification'))
                          <ul><p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('notification') }}</p></ul>
                        @endif
                        --}}

                    {{-- <form method="POST" action="{{url('login')}}"> --}}
                    {{-- @if($title == 'doctor') --}}
                    <form method="POST" action="{{url('loggedin')}}">
                    {{-- @else  <form method="POST" action="{{url('login')}}"> --}}
                    {{-- @endif --}}
                        @csrf


                    @if($title == 'admin' || $title == 'hospital')
                        <div class="form-group row">
                            <input id="title" type="hidden" name="title" value="{{$title}}" required="required" class="form-control ">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Email Address</label>
                            <div class="col-md-6"><input id="email" type="" name="common" value="{{old('common')}}" required="required" autocomplete="email" autofocus="autofocus" class="form-control "></div>
                        </div>
                    @else
                        <div class="form-group row">
                                <input id="title" type="hidden" name="title" value="{{$title}}" required="required" class="form-control ">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Mobile</label>
                            <div class="col-md-6  row">
                                <input class="form-control" value="+88" style="width:20%" readonly="">
                                <input id="email" type="" name="common" required="required" autocomplete="common" autofocus="autofocus" class="form-control " value="{{old('common')}}" style="width: 80%;padding: 0;margin: 0;"></div>
                        </div>
                    @endif

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                        <div class="col-md-6"><input id="password" type="password" name="password" required="required" autocomplete="current-password" class="form-control "></div>
                    </div>
                    {{--<div class="form-group row">
                        <div class="col-md-6 offset-md-4">
                            <div class="form-check"><input type="checkbox" name="remember" id="remember" class="form-check-input"> <label for="remember" class="form-check-label">
                                Remember Me
                                </label>
                            </div>
                        </div>
                    </div>--}}
                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4"><button type="submit" class="btn btn-primary">
                            Login
                            </button> <a href="{{url('/passwordreset/'.$title)}}" class="btn btn-link">
                            Forgot Your Password?
                            </a>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </div>
@endsection
