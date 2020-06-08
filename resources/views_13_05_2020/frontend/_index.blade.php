@extends('frontend.layouts.app')

@section('content')

@include('frontend.slider')


    <div class="tab-menu row col-md-12">
        <ul class="nav nav-pills nav-primary sub-section-menu col-md-8 col-sm-10">
            <li class="active"><a data-toggle="pill" href="#patient">Patient</a></li>
            <li><a data-toggle="pill" href="#doctor">Doctor</a></li>
            <li><a data-toggle="pill" href="#hospital">Hospital</a></li>
            <li><a data-toggle="pill" href="#e-prescription">E-Prescription</a></li>
        </ul>
    </div>

        <div class="tab-content">
            <div id="patient" class="tab-pane active">

                    <img src="{{asset('images/homeSection/patient.jpg')}}" alt="Patient" style="width:1347px;height:400px;">
                    {{-- <div class="carousel-caption d-none d-md-block ">
                        <h3 style="color:#000;">Feel better in minutes with HeloDoc</h3>
                        <h3 style="color:#000;">
                            Get quick and professional medical service at all times from board-certified doctors.
                        </h3>
                        <p><a href="#">More information</a></p>
                        <a class="patient btn btn-dark" href="">JOIN NOW</a>|<a class="patient btn btn-dark" href="">SIGN IN</a>
                    </div> --}}

            </div>
            <div id="doctor" class="tab-pane fade">
                <img src="{{asset('images/homeSection/doctor.jpg')}}" alt="Doctor" style="width:1347px;height:400px;">
                {{-- <div class="carousel-caption d-none d-md-block ">
                    <h3 style="color:#000;">Join the virtual care solutions team</h3>
                    <h3 style="color:#000;">Partner with HeloDoc to provide patients with urgent care and wellness visit. HeloDoc makes it convenient for both you and your patients.
                    </h3>
                    <p style="color:#000;"> <a href="#">More information</a></p>
                    <a class="hospital btn btn-dark" href="">JOIN NOW</a>|<a class="patient btn btn-dark" href="">SIGN IN</a>
                </div> --}}
            </div>
            <div id="hospital" class="tab-pane fade">
                <img src="{{asset('images/homeSection/hospital.jpg')}}" alt="Hospital" style="width:1347px;height:400px;">
                {{-- <div class="carousel-caption d-none d-md-block ">
                    <h3 style="color:#000;">Easier Hospital Visits</h3>
                    <h3 style="color:#000;">
                        Search for hospitals and make appointments easily
                    </h3>
                    <p><a href="#">More information</a></p>
                    <a class="hospital btn btn-dark" href="">JOIN NOW</a>|<a class="patient btn btn-dark" href="">SIGN IN</a>
                </div> --}}
            </div>
            <div id="e-prescription" class="tab-pane fade">
                <img src="{{asset('images/homeSection/e-prescription.jpg')}}" alt="E-prescription"  style="width:1347px;height:400px;">
                {{-- <div class="carousel-caption d-none d-md-block ">
                    <h3 style="color:#000;">Convenient and flexible medication information</h3>
                    <h3 style="color:#000;">
                        Get reliable, secure and confidential medication information through our e-prescription service.
                    </h3>
                </div> --}}
            </div>
        </div>





<div class='container'>

    <div class="row indexContent">

        <div class="row col-md-12 col-sm-12">

            <div class="row col-md-9 col-sm-12">
                <div class="common"></div>
                <div class="row col-md-12 col-sm-12">
                <div class="row col-md-12 col-sm-12"><h1>Download the App</h1></div>
                <div class="left-content col-md-6 col-sm-12" style="    position: absolute;
                margin-top: 60px;">
                    <div class="row col-md-12 col-sm-12">
                        <h4>Patients:</h4>
                        <span class="span text-justify">
                            Get HeloDoc on your phone and get immediate medical attention. We designed this app to provide you medical care online anytime, anywhere on your smartphone.
                        </span>

                        <div class="appStore" >
                            <div><span>Patient App</span></div>
                            <img class="img-responsive" src="{{asset('images/google-play.png')}}"/>
                        </div>
                    </div>
                </div>
                <div class="left-content col-md-6 col-sm-12" style="right: 0px;
                position: absolute;
                top: 45px;">
                    <div class="row col-md-12 col-sm-12">

                        <h4>Doctors:</h4>
                        <span class="span text-justify">
                            Download our app to provide patients with urgent care at your convenience</span>
                        </span>


                        <div class="appStore" style="margin-top:28px;">
                            <div style="margin-top:20px;"><span>Doctor App</span></div>
                            <img class="img-responsive" src="{{asset('images/google-play.png')}}"/>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-12 heloDoc_mobile">
                <img src="{{asset('images/heloDoc_mobile.png')}}" />
            </div>
        </div>



    </div>
    <div class="common"></div>
    <div class="row indexParagraph textImage">
        <div class="col-md-6 col-sm-12 left">
            <img class="img-responsive img-thumbnail" src="{{asset('images/textImage/why_visit.png')}}" />
        </div>
        <div class="col-md-6 col-sm-12">
            <h1>Why HeloDoc</h1>
            {{-- <h3>
                <p class="text-info">HeloDoc is the nation’s most trusted physician recruitment resource.</p>
            </h3> --}}
            <p class="text-justify">
                It’s similar to an office visit, but instead of going over to the doctor’s office you can consult them from the comfort of your home, work or anywhere that is convenient for you. Our certified physicians can assess and make a diagnosis, recommend the necessary treatment and send you your required prescription.
<br>More than ever HeloDoc is needed as it helps with social distancing. Keep yourself and your family safe by getting medical attention. With the ongoing COVID-19 pandemic we encourage you to stay home and stay safe.</p>
        </div>
    </div>
    <div class="common"></div>
    <div class="row indexParagraph textImage">
        <div class="col-md-6 col-sm-12">
            <h1>HeloDoc</h1>
            {{-- <h3>
                <p class="text-info">HeloDoc is the nation’s most trusted physician recruitment resource.</p>
            </h3> --}}
            <p class="text-justify">
                A health care platform to find doctors near you, book an appointment, consult via video on your smartphone, and get medication information through e-prescription services. Our doctors are available 24/7 to meet your medical needs. Get access to primary health care from anywhere in Bangladesh at an affordable price.
            </p>
            <div class="row col-md-12 col-sm-12">
                <div class="">
                    <a class="hospital btn btn-dark float-left text-white rounded border border-0" href="#">
                        <span class="font-weight-bold text-uppercase">Join Now</span>
                    </a>
                </div>
                <div class="col-sm-3 col-md-3">
                    <a class="hospital btn btn-dark float-left text-white rounded border border-0" href="#">
                        <span class="font-weight-bold text-uppercase">Sign In</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="common"></div>
        <div class="col-md-6 col-sm-12">
            <img class="img-responsive img-thumbnail" src="{{asset('images/textImage/text2.png')}}" />
        </div>

    </div>
    <div class="common"></div>
    <div class="row indexParagraph">
        <div class="col-md-4 col-sm-12">

            <h3 class="">See how an online medical<br>visit works.</h3>
            {{-- <ul>
                <dl>Lorem Ipsum is simply dummy</dl><hr>
                <dl>Lorem Ipsum has been the industry</dl><hr>
                <dl>Aldus PageMaker including</dl><hr>
            </ul> --}}
            {{-- <dl class="row">
                <dt class="col-sm-3">Description lists</dt>
                <dd class="col-sm-9">A description list is perfect for defining terms.</dd>

                <dt class="col-sm-3">Euismod</dt>
                <dd class="col-sm-9">
                  <p>Vestibulum id ligula porta felis euismod semper eget lacinia odio sem nec elit.</p>
                  <p>Donec id elit non mi porta gravida at eget metus.</p>
                </dd>
            </dl> --}}
            <p class="text-justify">Through HeloDoc visit your doctor from anywhere and at anytime virtually. Sign up to HeloDoc and book your appointment to see your doctor for a regular check-up or for urgent care, get connected to a doctor immediately. Watch the video to see how an online visit works. </p>
            <a class="hospital btn btn-dark float-left text-white rounded border border-0"><span class="font-weight-bold text-uppercase">SIGN UP</span></a>
        </div>
        <div class="col-md-8 col-sm-12">
            <div class="youtube_video img-responsive">
                <iframe width="745" height="315" src="https://www.youtube.com/embed/_mruBhMj2uE" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
        </div>
    </div>
    <div class="common"></div>

</div>

@endsection
