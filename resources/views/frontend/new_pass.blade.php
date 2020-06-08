@extends('frontend.layouts.app')

@section('content')

        @php
        //dd($hospitalUser);
        @endphp
        <div class="row justify-content-center">
        <div class="col-md-8" style="padding: 45px;">
            <div class="card" style="">
                <div class="card-header text-transform-uppercase">New Password</div>
                <div class="card-body">

                    <form method="POST" action="{{url('admin/hospital/newPass')}}">
                    @csrf
                    <input id="uid" type="hidden" name="uid" required="required" value="{{$hospitalUser}}" class="form-control ">
                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                        <div class="col-md-6"><input id="password" type="password" name="password" required="required" autocomplete="current-password" class="form-control "></div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                            Submit
                            </button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </div>
@endsection
