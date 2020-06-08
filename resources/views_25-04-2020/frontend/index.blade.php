@extends('frontend.layouts.app')

@section('content')
<style type="text/css">
    .speciality-right img {
    /*display: none;*/
    height: 360px;
    }
</style>
        <div id="demo" class="carousel slide" data-ride="carousel">

    <!-- Indicators -->
    <ul class="carousel-indicators">
      <li data-target="#demo" data-slide-to="0" class="active"></li>
      {{-- <li data-target="#demo" data-slide-to="1"></li>
      <li data-target="#demo" data-slide-to="2"></li>
      <li data-target="#demo" data-slide-to="3"></li>
      <li data-target="#demo" data-slide-to="4"></li> --}}
    </ul>

    <!-- The slideshow -->
    <div class="carousel-inner">

      <div class="carousel-item active">
        <img src="{{asset('assets/img/slider/slide-1.jpg')}}" alt="Patient" style="width:100%;">

      </div>
      <div class="carousel-item ">
        <img src="{{asset('assets/img/slider/slide-2.jpg')}}" alt="Doctor" style="width:100%;">

      </div>
      <div class="carousel-item">
        <img src="{{asset('assets/img/slider/slide-3.jpg')}}" alt="Hospital" style="width:100%;">

      </div>
    </div>

    <!-- Left and right controls -->
    <a class="carousel-control-prev" href="#demo" data-slide="prev">
      <span class="carousel-control-prev-icon"></span>
    </a>
    <a class="carousel-control-next" href="#demo" data-slide="next">
      <span class="carousel-control-next-icon"></span>
    </a>
  </div>




        <!-- tab section -->
<!--         <div class="tab-menu row col-md-12">
        <ul class="nav nav-pills navbar navbar-expand-md navbar-light">
            <li class="active"><a data-toggle="pill" href="#patient">Patient</a></li>
            <li><a data-toggle="pill" href="#doctor">Doctor</a></li>
            <li><a data-toggle="pill" href="#hospital">Hospital</a></li>
            <li><a data-toggle="pill" href="#e-prescription">E-Prescription</a></li>
        </ul>
    	</div -->
<div class="tab-section">
    	<div class="container">
		  <div class="row">
		    <div class="col-sm-12">
			      <ul class="nav nav-tabs tabs-left" role="tablist">
				      <li role="presentation" class="active">
				      	<!-- <a href="#patient" aria-controls="home" role="tab" data-toggle="tab">Patient</a> -->
				      	<a href="#patient" aria-controls="home" role="tab" data-toggle="tab" class="active" aria-selected="true">Patient</a>
				      </li>
				      <li role="presentation"><a href="#doctor" aria-controls="profile" role="tab" data-toggle="tab">Doctor</a></li>
				      <li role="presentation"><a href="#hospital" aria-controls="messages" role="tab" data-toggle="tab">Hospital</a></li>
				      <li role="presentation"><a href="#e-prescription" aria-controls="settings" role="tab" data-toggle="tab">E-prescription</a></li>
			    </ul>
		    </div>
		    <!-- <div class="col-sm-12">
      <div class="tab-content">
      <div role="tabpanel" class="tab-pane active" id="home">home tab</div>
      <div role="tabpanel" class="tab-pane" id="profile">profile tab</div>
      <div role="tabpanel" class="tab-pane" id="messages">messages tab</div>
      <div role="tabpanel" class="tab-pane" id="settings">setting tabs</div>
    </div>
    </div> -->
  </div>
</div>
</div>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="patient">
                <img src="{{asset('assets/img/tab/patient.jpg')}}" alt="Patient" class="img-fluid">
                    <div class="bottom-left caption slider-text">
                        <!-- <h3 style="">Feel better in minutes with HeloDoc</h3>
                        <h5 style="">
                            Get quick and professional medical service at all times from<br>board-certified doctors.
     z                   </h5>

                        <a href="#" class="nav-link" >More information</a>
 -->
<!--
                        <span class="tab-title" style="margin-bottom:5px">Feel better in minutes<br>with HeloDoc</span>
                        <br><br>
                        <span class="tab-sub-title">
                            Get quick and professional medical service at all times from<br>board-certified doctors.
                        </span>
                        <br><br>-->
                        <div class="pt-10 btn-area" style="margin-left:0px;">
                            <a href="{{url('service/patient')}}" class="nav-link" style="padding:0px;">More information</a><br>
                            <a href="{{url('register/patient')}}" class="btn drop-btn"><span>JOIN NOW</span></a>
                            <a class="btn drop-btn" href="{{url('login/patient')}}"><span>SIGN IN</span></a>
                        </div>
                    </div>

                    <!-- <div class="carousel-caption d-none d-md-block "> -->
                        <!-- <h3 style="color:#000;">Feel better in minutes with HeloDoc</h3>
                        <h3 style="color:#000;">
                            Get quick and professional medical service at all times from board-certified doctors.
                        </h3>
                        <p><a href="#">More information</a></p>
                        <a class="patient btn btn-dark" href="">JOIN NOW</a>|<a class="patient btn btn-dark" href="">SIGN IN</a> -->
                    <!-- </div>  -->


            </div>

            <div role="tabpanel" class="tab-pane" id="doctor">
                <img src="{{asset('assets/img/tab/doctor.jpg')}}" alt="Doctor" >

                <div class="bottom-left caption slider-text">
<!--                    <span class="tab-title" style="margin-bottom:5px">Join the virtual care solutions team</span><br>
                    <span class="tab-sub-title">Partner with HeloDoc to provide patients with urgent care and wellness visit. HeloDoc makes it convenient for both you and your patients.
                    </span>
                    <br>
                        <a href="#" class="more nav-link" style="padding:0px;">More information</a>

                    <!-- <div>
                        <button type="" class="drop-btn" style="pointer-events: all; cursor: pointer;">
                                        Send
                                    </button>
                    </div> -->
<!-- <br>-->
                        <div class="pt-10 btn-area" style="margin-left:0px;">
                            <a href="{{url('service/doctor')}}" class="more nav-link" style="padding:0px;">More information</a><br>
                            <a href="{{url('/register/doctor')}}" class="btn drop-btn" style="pointer-events: all; cursor: pointer;">JOIN NOW</a>
                            <a href="{{url('/login/doctor')}}" class="btn drop-btn" style="pointer-events: all; cursor: pointer;">SIGN IN</a>

                        </div>

                </div>
                <!-- <img src="{{asset('assets/img/tab/paitent.png')}}" alt="Patient"> -->


            </div>

            <div role="tabpanel" class="tab-pane" id="hospital">
                <img src="{{asset('assets/img/tab/hospital.jpg')}}" alt="Hospital" >

                <div class="bottom-left caption slider-text">
                    <!-- <span class="tab-title" style="margin-bottom:5px">Easier Hospital Visits</span><br><br>
                    <span class="tab-sub-title">Search for hospitals and make appointments easily
                    </span><br>-->

<!--                 <a href="#" class="more nav-link" style="padding:0px;">More information</a>
<br> -->

                        <div class="pt-10  btn-area" style="margin-left:0px;">
                            <a href="{{url('service/hospital')}}" class="more nav-link" style="padding:0px;">More information</a><br>
                            <a href="{{url('/register/hospital')}}" class="btn drop-btn">JOIN NOW</a>
                            <a href="{{url('/login/hospital')}}" class="btn drop-btn">SIGN IN</a>
                        </div>
                </div>

            </div>

            <div role="tabpanel" class="tab-pane" id="e-prescription">
                <!-- <div class="caption slider-text">
                    <span class="tab-title" style="margin-bottom:5px">Convenient and flexible<br>medication information</span><br><br>
                    <span class="tab-sub-title" >
                        Get reliable, secure and confidential medication information through<br>our e-prescription service.
                    </span>
                </div> -->
                <img src="{{asset('assets/img/tab/e-prescription.jpg')}}" alt="E-prescription" >

            </div>
        </div>

<!--     	    <div class="main-nav">
                <div class="container">
                    <nav class="nav nav-pills sub-section-menu navbar navbar-expand-md navbar-light">
                        <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
                            <ul class="tab navbar-nav">
                                <li class="active"><a data-toggle="pill" href="#patient">Patient</a></li>
					            <li><a data-toggle="pill" href="#doctor">Doctor</a></li>
					            <li><a data-toggle="pill" href="#hospital">Hospital</a></li>
					            <li><a data-toggle="pill" href="#e-prescription">E-Prescription</a></li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
 -->


 <!-- Download the APP -->
 <!-- Departments -->
        <section class="departments-area pt-50">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-lg-4">
                        <div class="google-play">

                        	<h3>Download the App</h3>
                            <h4 class="patient">Patients</h4>
                            <p>
                            	Get HeloDoc on your phone and get immediate medical attention. We designed this app to provide you medical care online anytime, anywhere on your smartphone.
							</p>
							<h6>Patient App</h6>
                            <img src="{{asset('assets/img/google-play.png')}}" alt="Doctor App">
                        </div>
                    </div>
                    <div class="col-lg-1"></div>
                    <div class="col-sm-6 col-lg-4">
                        <div class="google-play">

                        	<h4 class="doctor">Doctors</h4>
                            <p>Download our app to provide patients with urgent care at your convenience.</p>
                            <h6 class="doctor-app">Doctor App</h6>
                            <img src="{{asset('assets/img/google-play.png')}}" alt="Doctor App">
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3 col-md-12">
                        <div class="">
                            <!-- <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Praesentium eaque omnis corporis, animi aspernatur tempora.</p>
                            <i class="icofont-laboratory"></i> -->
                            <img class="mobile-app" src="{{asset('assets/img/heloDoc_mobile.png')}}" alt="HeloDoc Mobile App" />
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Departments -->
 <!-- End -->

		<!-- Welcome -->
        <section class="welcome-area ptb-100" style="display: none;">
            <div class="container p-0">
                <div class="row m-0">
                    <div class="col-lg-6 col-sm-12">
                        <div class="welcome-item welcome-left">
                            <img src="{{asset('assets/img/home/why_heloDoc.jpg')}}" alt="HeloDoc">
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="welcome-item welcome-right">
                            <div class="section-title-two">
                                <!-- <span>Why HeloDoc</span>-->
                                <h3>Why HeloDoc</h3>
                            </div>
                            <ul>
                                <li class="wow fadeInUp" data-wow-delay=".3s">
                                    <!-- <i class="icofont-doctor-alt"></i> -->
                                    <div class="welcome-inner">
                                        <!-- <h3>Certified Doctors</h3> -->
                                        <p>
                                        	It’s similar to an office visit, but instead of going over to the doctor’s office you can consult them from the comfort of your home, work or anywhere that is convenient for you. Our certified physicians can assess and make a diagnosis, recommend the necessary treatment and send you your required prescription.
                                        </p>
                                    </div>
                                </li>
                                <li class="wow fadeInUp" data-wow-delay=".5s">
                                    <!-- <i class="icofont-stretcher"></i> -->
                                    <div class="welcome-inner">
                                        <!-- <h3>Emergency 24 hours</h3> -->
                                        <p>
                                        	More than ever HeloDoc is needed as it helps with social distancing. Keep yourself and your family safe by getting medical attention. With the ongoing COVID-19 pandemic we encourage you to stay home and stay safe.
                                        </p>
                                    </div>
                                </li>
                                <!--<li class="wow fadeInUp" data-wow-delay=".7s">
                                    <i class="icofont-network"></i>
                                    <div class="welcome-inner">
                                        <h3>Modern Technologey</h3>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.consectetur adipiscing elit.</p>
                                    </div>
                                </li> -->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Welcome -->

        <!-- Speciality -->
        <section class="speciality-area pb-100">
            <div class="container p-0">
                <div class="row m-0">
                    <div class="col-lg-7 com-sm-12">
                        <div class="speciality-left">
                            <div class="section-title-two">
                                <!-- <span>Speciality</span> -->
                                <h3>Why HeloDoc</h3>
                            </div>
                            <div class="speciality-item">
                                <div class="row m-0">
                                    <div class="col-lg-12 col-sm-12 wow fadeInUp" data-wow-delay=".3s" style="padding-left: 0px;">
                                        <div class="speciality-inner">
                                            <!-- <i class="icofont-check-circled"></i> -->
                                            <!-- <h3>Child Care</h3> -->
                                            <p>
                                                It's similar to an office visit, but instead of going over to the doctor’s office you can consult them from the comfort of your home, work or anywhere that is convenient for you. Our certified physicians can assess and make a diagnosis, recommend the necessary treatment and send you your required prescription.
                                            </p>

                                            <p>
                                                More than ever HeloDoc is needed as it helps with social distancing. Keep yourself and your family safe by getting medical attention. With the ongoing COVID-19 pandemic we encourage you to stay home and stay safe.
                                            </p>
                                        </div>
                                    </div>
                                    <!-- <div class="col-sm-6 col-lg-6 wow fadeInUp" data-wow-delay=".5s">
                                        <div class="speciality-inner">
                                            <i class="icofont-check-circled"></i>
                                            <h3>More Stuff</h3>
                                            <p>Lorem ipsum dolor sit amet, is consectetur adipiscing</p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-6 wow fadeInUp" data-wow-delay=".3s">
                                        <div class="speciality-inner">
                                            <i class="icofont-check-circled"></i>
                                            <h3>Enough Lab</h3>
                                            <p>Lorem ipsum dolor sit amet, is consectetur adipiscing</p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-6 wow fadeInUp" data-wow-delay=".5s">
                                        <div class="speciality-inner">
                                            <i class="icofont-check-circled"></i>
                                            <h3>24 Hour Doctor</h3>
                                            <p>Lorem ipsum dolor sit amet, is consectetur adipiscing</p>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="speciality-item speciality-right">
                            <img src="{{asset('assets/img/home/why_heloDoc.jpg')}}" alt="Speciality">
                            <!-- <div class="speciality-emergency">
                                <div class="speciality-icon">
                                    <i class="icofont-ui-call"></i>
                                </div>
                                <h3>Emergency Call</h3>
                                <p>+07 554 332 322</p>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Speciality -->

        <!-- Speciality -->
        <section class="speciality-area pb-100">
            <div class="container p-0">
                <div class="row m-0">
                    <div class="col-lg-7 com-sm-12">
                        <div class="speciality-left">
                            <div class="section-title-two">
                                <!-- <span>Speciality</span> -->
                                <h3>HeloDoc</h3>
                            </div>
                            <div class="speciality-item">
                                <div class="row m-0">
                                    <div class="col-lg-12 col-sm-12 wow fadeInUp" data-wow-delay=".3s" style="padding-left: 0;">
                                        <div class="speciality-inner">
                                            <!-- <i class="icofont-check-circled"></i> -->
                                            <!-- <h3>Child Care</h3> -->
                                            <p>
                                            	A health care platform to find doctors near you, book an appointment, consult via video on your smartphone, and get medication information through e-prescription services. <br> Our doctors are available 24/7 to meet your medical needs.<br> Get access to primary health care from anywhere in Bangladesh at an affordable price.
											</p>
                                        </div>
                                    </div>
                                    <!-- <div class="col-sm-6 col-lg-6 wow fadeInUp" data-wow-delay=".5s">
                                        <div class="speciality-inner">
                                            <i class="icofont-check-circled"></i>
                                            <h3>More Stuff</h3>
                                            <p>Lorem ipsum dolor sit amet, is consectetur adipiscing</p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-6 wow fadeInUp" data-wow-delay=".3s">
                                        <div class="speciality-inner">
                                            <i class="icofont-check-circled"></i>
                                            <h3>Enough Lab</h3>
                                            <p>Lorem ipsum dolor sit amet, is consectetur adipiscing</p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-6 wow fadeInUp" data-wow-delay=".5s">
                                        <div class="speciality-inner">
                                            <i class="icofont-check-circled"></i>
                                            <h3>24 Hour Doctor</h3>
                                            <p>Lorem ipsum dolor sit amet, is consectetur adipiscing</p>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <div class="speciality-item speciality-right">
                            <img src="{{asset('assets/img/home/heloDoc.jpg')}}" alt="Speciality">
                            <!-- <div class="speciality-emergency">
                                <div class="speciality-icon">
                                    <i class="icofont-ui-call"></i>
                                </div>
                                <h3>Emergency Call</h3>
                                <p>+07 554 332 322</p>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Speciality -->

        <!-- Speciality -->
        <section class="speciality-area" style="margin-bottom: 20px;">
            <div class="container p-0">
                <div class="row m-0">
                    <div class="col-lg-7">
                        <div class="speciality-left">
                            <div class="section-title-two">
                                <!-- <span>Speciality</span> -->
                                <h3>See how an online medical visit works.</h3>
                            </div>
                            <div class="speciality-item">
                                <div class="row m-0">
                                    <div class="col-sm-12 col-lg-12 wow fadeInUp" data-wow-delay=".3s"  style="padding-left: 0px;">
                                        <div class="speciality-inner">
                                            <!-- <i class="icofont-check-circled"></i> -->
                                            <!-- <h3>Child Care</h3> -->
                                            <p>
Through HeloDoc visit your doctor from anywhere and at anytime virtually. Sign up to HeloDoc and book your appointment to see your doctor for a regular check-up or for urgent care, get connected to a doctor immediately. Watch the video to see how an online visit works.
											</p>
                                        </div>
                                    </div>
                                    <!-- <div class="col-sm-6 col-lg-6 wow fadeInUp" data-wow-delay=".5s">
                                        <div class="speciality-inner">
                                            <i class="icofont-check-circled"></i>
                                            <h3>More Stuff</h3>
                                            <p>Lorem ipsum dolor sit amet, is consectetur adipiscing</p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-6 wow fadeInUp" data-wow-delay=".3s">
                                        <div class="speciality-inner">
                                            <i class="icofont-check-circled"></i>
                                            <h3>Enough Lab</h3>
                                            <p>Lorem ipsum dolor sit amet, is consectetur adipiscing</p>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-6 wow fadeInUp" data-wow-delay=".5s">
                                        <div class="speciality-inner">
                                            <i class="icofont-check-circled"></i>
                                            <h3>24 Hour Doctor</h3>
                                            <p>Lorem ipsum dolor sit amet, is consectetur adipiscing</p>
                                        </div>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 col-sm-12" style="padding-left: 15px;">
                        <div class="speciality-item speciality-right video">
                        	  <iframe src="https://www.youtube.com/embed/_mruBhMj2uE" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Speciality -->





@endsection
