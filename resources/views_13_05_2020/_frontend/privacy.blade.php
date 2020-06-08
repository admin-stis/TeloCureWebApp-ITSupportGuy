@extends('frontend.layouts.app')

@section('content')

    
        <!-- Service Details -->
        <div class="privacydetails-area ptb-100" style="margin-top:30px;">
            <div class="container">
                
                <div class="row" style="margin-bottom:40px">
                    <!-- <div class="privacyalldetails" style="border:2px solid red;"> -->
                       <div class="col-lg-6">
                           <div class="privacydetails" style="padding-top:15px;">
                               <!-- <h2>How is patient privacy protected?</h2> -->
                               <h2>Patient privacy protection</h2>
                               <!-- <a href="{{url('service/hospital')}}" class="more nav-link" style="padding:0px;">More information</a> -->
                               <p>Any information regarding your health is personal, because of this, we strive to maintain full confidentiality of your health records. Through varied means such as administrative, technical and physical means, we continuously safeguard your information.</p> 
                               <a href="{{url('privacy/patientprivacy')}}" class="more nav-link" style="padding:0px;">More information</a>
                           </div>
                       </div>

                       <div class="col-lg-6">
                           <div class="privacydetails-inner-left">
                               <img src="{{asset('assets/img/privacy/1.jpg')}}" width="100%" style="padding-top:20px;" alt="Service">
                           </div>
                       </div>
                    <!-- </div> -->
                </div>

                <div class="row" style="margin-bottom:40px">
                    <div class="col-lg-6">
                        <div class="privacydetails">
                            <!-- <h2>How is health information used and disclosed?</h2> -->
                            <h2>Use of health information</h2>
                            <p>Health information is disclosed and used only for normal business activities the law sees as treatment, healthcare operations, and payment. We only keep a record of all the health information you provide us and may disclose them to other doctors and medical entities so that we can meet your health care needs. No videos of consultations/ visits are recorded.</p>
                            <a href="{{url('privacy/healthinfo')}}" class="more nav-link" style="padding:0px;">More information</a>
                            
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="privacydetails-inner-left">
                            <!-- <img src="assets/img/privacy/UberIM_010182_3x2.jpg" alt="Service"> -->
                            <img src="{{asset('assets/img/privacy/2.png')}}" width="100%" style="padding-top:20px;" alt="Service">
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-bottom:40px">
                    <div class="col-lg-12">
                        <div class="privacydetails">
                            <!-- <h2>How is health information used and disclosed?</h2> -->
                            <h2>Our doctors are board-certified</h2>
                            <p>Our promise to you is quality health care from expert doctors. We make sure all our doctors
are board-certified and go through background checks before being a part of our virtual
team.</p>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-bottom:40px">
                    <div class="col-lg-12">
                        <div class="privacydetails">
                            <!-- <h2>How is health information used and disclosed?</h2> -->
                            <h2>Lady doctors available for female patients</h2>
                            <p>we make sure patients get a comfortable virtual environment to express their medical
problems without being held back. You can always pick a doctor of your own preference
from our list of doctors.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Service Details -->

        <!-- Privacy Blog -->
        <!-- <section class="privacyblog-area">
            <div class="container">
                <div class="privacyblog-title">
                    <h2>How safety is built into your experience</h2>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-lg-4 wow fadeInUp" data-wow-delay=".3s">
                        <div class="privacyblog-item">
                     
                            <div class="privacyblog-bottom">
                                <h3>
                                    <a href="javascript:void()">Safety features in the app</a>
                                </h3>
                                <p>Lorem ipsum is  dolor sit amet, csectetur adipiscing elit, dolore smod tempor incididunt ut labor.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-4 wow fadeInUp" data-wow-delay=".3s">
                        <div class="privacyblog-item">
                            <div class="privacyblog-bottom">
                                <h3>
                                    <a href="javascript:void()">An inclusive community</a>
                                </h3>
                                <p>Lorem ipsum is  dolor sit amet, csectetur adipiscing elit, dolore smod tempor incididunt ut labore</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-sm-6 col-lg-4 wow fadeInUp" data-wow-delay=".3s">
                        <div class="privacyblog-item">
                            <div class="privacyblog-bottom">
                                <h3>
                                    <a href="javascript:void()">Support at every turn</a>
                                </h3>
                                <p>Lorem ipsum is  dolor sit amet, csectetur adipiscing elit, dolore smod tempor incididunt ut labore</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> -->
        <!-- End Privacy Blog -->

        <!-- Privacy Blog -->
        <section class="privacyblog-area">
            <div class="container">
                <!-- <div class="privacyblog-title">
                    <h2>Building safer journeys for everyone</h2>
                </div> -->
                <div class="row">
                    <div class="col-sm-6 col-lg-4 wow fadeInUp" data-wow-delay=".3s">
                        <div class="privacyblog-item">
                            <div class="privacyblog-top">
                                <a href="javascript:void()">
                                    <img src="{{asset('assets/img/privacy/no_video.png')}}" alt="Blog">
                                </a>
                            </div>
                            <div class="privacyblog-bottom">
                                <h3>
                                    <a href="javascript:void()">Video not recorded</a>
                                </h3>
                                <!-- <p>Count on 24/7 support to help with any questions or safety concerns. Share your trip with loved ones. Our focus is on your safety, so you can go where the opportunity is.</p> -->
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-sm-6 col-lg-4 wow fadeInUp" data-wow-delay=".3s">
                        <div class="privacyblog-item">
                            <div class="privacyblog-top">
                                <a href="javascript:void()">
                                    <img src="{{asset('assets/img/privacy/certified.png')}}" alt="Blog">
                                    
                                </a>
                            </div>
                            <div class="privacyblog-bottom">
                                <h3>
                                    <a href="javascript:void()">Certified Doctors</a>
                                </h3>
                                <!-- <p>Millions of rides are requested every day. Every rider has access to safety features built into the app. And every ride has a support team if you need them.</p> -->
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-4 wow fadeInUp" data-wow-delay=".3s">
                        <div class="privacyblog-item">
                            <div class="privacyblog-top">
                                <a href="javascript:void()">
                                    <img src="{{asset('assets/img/privacy/women_doctor.png')}}" alt="Blog">
                                    
                                </a>
                            </div>
                            <div class="privacyblog-bottom">
                                <h3>
                                    <a href="javascript:void()">Women Doctors also available for Women</a>
                                </h3>
                                <!-- <p>Millions of rides are requested every day. Every rider has access to safety features built into the app. And every ride has a support team if you need them.</p> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Privacy Blog -->
@endsection
