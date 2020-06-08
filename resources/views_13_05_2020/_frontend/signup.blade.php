@extends('frontend.layouts.app')

@section('content')

    @if ($title == 'patient')
    <div class="container patient_login">
    @elseif($title == 'doctor')
    <div class="container doctor_login">
    @elseif($title == 'hospital')
    <div class="container hospital_login">
    @endif

    <div class="row justify-content-center">
        <div class="col-md-8" style="padding: 45px;">

        <div class="row">
            <div class="col-md-12" style="margin: 0 auto;">
                <div class="card">
                    <!-- <div class="card-header">{{ __($title.' Register') }}</div> -->
                    <div class="card-header"><?php echo ucfirst($title);?> Register</div>
                    <div class="card-body">
                        @if($title == 'patient')<p class="mb-2"><strong>Become a patient</strong></p>
                        @elseif($title == 'doctor')<p class="mb-2"><strong>Become a doctor</strong></p>
                        @endif

                        <form method="POST" action="">
                            <div class="row col-md-12">
                                <div class="form-group col-md-6">
                                    <div class="">
                                        <label>First Name</label>
                                    </div>
                                    <div class="">
                                        <input class="form-control" type="text">
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <div class="">
                                        <label>Last Name</label>
                                    </div>
                                    <div class="">
                                        <input class="form-control" type="text">
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <div class="">
                                        <label>Email</label>
                                    </div>
                                    <div class="">
                                        <input class="form-control" type="text">
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <div class="">
                                        <label>Password</label>
                                    </div>
                                    <div class="">
                                        <input class="form-control" type="text">
                                    </div>
                                </div>

                                <div class="form-group col-md-12">
                                    <div class="">
                                        <label>Phone Number</label>
                                    </div>
                                    <div class="">
                                        <input class="form-control" type="text">
                                    </div>
                                </div>

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

    </div>

@endsection
