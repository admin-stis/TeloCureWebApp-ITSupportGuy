@extends('frontend.layouts.app')

@section('content')
    @if ($title == 'patient')
    <div class="container patient_login">
    @elseif($title == 'doctor')
    <div class="container doctor_login">
    @elseif($title == 'hospital')
    <div class="container hospital_login">
    @endif

        {{-- <div class="row justify-content-center">
        <div class="row col-md-8">
            <div class="card">
                <div class="card-header">{{ __($title.' Register') }}</div>

                <div class="card-body">

                    @if($title == 'patient')<strong>Become a patient</strong>
                    @elseif($title == 'doctor')<strong>Become a doctor</strong>
                    @endif

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group col-md-6 col-sm-12">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group col-md-6 col-sm-12">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div> --}}

        <div class="row row justify-content-center">
            <div class="col-md-8" style="padding: 45px;">
                <div class="card">
                    <div class="card-header"><?php echo ucfirst($title);?> Register</div>
                    <div class="card-body">
                        @if($title == 'patient')<p class="mb-2"><strong>Become a patient</strong></p>
                        @elseif($title == 'doctor')<p class="mb-2"><strong>Become a doctor</strong></p>
                        @endif

                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="row col-md-12">
                                <div class="form-group col-md-6">
                                    <div class="">
                                        <label>Firstname</label>
                                    </div>
                                    <div class="">
                                        <input class="form-control" type="text" name="name">
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <div class="">
                                        <label>Lastname</label>
                                    </div>
                                    <div class="">
                                        <input class="form-control" type="text" name="lastname">
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <div class="">
                                        <label>Email</label>
                                    </div>
                                    <div class="">
                                        <input class="form-control" type="email" name="email">
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <div class="">
                                        <label>Password</label>
                                    </div>
                                    <div class="">
                                        <input class="form-control" type="password" name="password">
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <div class="">
                                        <label>Confirm Password</label>
                                    </div>
                                    <div class="">
                                        <input class="form-control" type="password" name="password_confirmation">
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <div class="">
                                        <label>Phone Number</label>
                                    </div>
                                    <div class="">
                                        <input class="form-control" type="trxt" name="phone">
                                    </div>
                                </div>
                                        <input type="hidden" name="role" value="{{$role}}">
                                <div class="form-group col-md-12">
                                    <div class="float-right">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Register') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
