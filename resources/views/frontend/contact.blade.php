@extends('frontend.layouts.app')

@section('content')

<!-- Page Title -->
<div class="page-title-area page-title-five">
    <div class="d-table">
        <div class="d-table-cell">
            <div class="page-title-item">
                <h2>Contact Us</h2>
                <ul>
                    <li>
                        <a href="{{url('/')}}">Home</a>
                    </li>
                    <li>
                        <i class="icofont-simple-right"></i>
                    </li>
                    <li>Contact us</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- End Page Title -->

<!-- Location -->
<div class="location-area">
    <div class="container">
        <div class="row location-wrap">
            <div class="col-sm-6 col-lg-4">
                <div class="location-item">
                    <i class="icofont-location-pin"></i>
                    <h3>Location</h3>
                    <p>House #34, Road #3,<br>Section #11, Block #D, Mirpur,<br>Dhaka 1216
                    </p>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="location-item">
                    <i class="icofont-ui-message"></i>
                    <h3>Email</h3>
                    <ul>
                        <li>support@telocure.com</li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-6 offset-sm-3 offset-lg-0 col-lg-4">
                <div class="location-item">
                    <i class="icofont-ui-call"></i>
                    <h3>Phone</h3>
                    <ul>
                        <li>09614501100</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Location -->

<!-- Drop -->
<section class="drop-area pt-100">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-7 p-0">
                <div class="drop-item drop-img">
                    <div class="drop-left">
                        <h2>Drop your message for any info or question.</h2>
                        <!-- <form id="contactForm" method="post" action="{{url('contact')}}" > -->

                        @if(Session::has('notify-contactus'))
                            <ul><p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('notify-contactus') }}</p></ul>
                        @endif
                        <script src='https://www.google.com/recaptcha/api.js' async defer ></script>
                         <form id="" method="post" action="{{url('contact')}}" >
                            @csrf
                            <div class="row">
                                <div class="col-sm-6 col-lg-6">
                                    <div class="form-group">
                                        <input type="text" name="name" id="name" class="form-control" required data-error="Please enter your name" placeholder="Name">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-lg-6">
                                    <div class="form-group">
                                        <input type="email" name="email" id="email" class="form-control" required data-error="Please enter your email" placeholder="Email">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-lg-6">
                                    <div class="form-group">
                                        <input type="text" name="phone_number" id="phone_number" required data-error="Please enter your number" class="form-control" placeholder="Phone">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="col-sm-6 col-lg-6">
                                    <div class="form-group">
                                        <input type="text" name="msg_subject" id="msg_subject" class="form-control" required data-error="Please enter your subject" placeholder="Subject">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <textarea name="message" class="form-control" id="message" cols="30" rows="5" required data-error="Write your message" placeholder="Your Message"></textarea>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12">
                                   <div class="g-recaptcha" data-sitekey="6Lc82kMaAAAAAPjnIJ1iI2KcOBvGQVu2_BKN66A1"></div>
                                </div>                                
                                
                                <div class="col-sm-6 col-lg-6 mt-3">
                                    <div class="form-group">
                                        @php $add_num = mt_rand(1,9); $sum = 2+$add_num; @endphp 
                                        <span>Enter the sum of 2+@php echo $add_num; @endphp = ?</span>
                                        <input type="hidden" name="msg_number_chk" id="msg_number_chk" class="form-control" value="@php echo $sum; @endphp">
                                        <input type="text" name="msg_number" id="msg_number" class="form-control" required data-error="enter the number" placeholder="Enter 2+@php echo $add_num; @endphp =">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>

                                <div class="col-md-12 col-lg-12">

                                    <button type="submit" class="btn btn-info">
                                        Send
                                    </button>
                                </div>
                            </div>
                        </form> 
                    </div>
                </div>
            </div>
            <div class="col-lg-5 p-0">
                <div class="speciality-item speciality-right speciality-right-two speciality-right-three">
                    <img src="{{asset('assets/img/contact/c2.jpg')}}" alt="Contact">
                    <div class="speciality-emergency" style="margin: 5%">
                        <div class="speciality-icon">
                            <i class="icofont-ui-call"></i>
                        </div>
                        <h3>Emergency Call</h3>
                        <p>09614501100</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Drop -->
@endsection
