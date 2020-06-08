
@extends('frontend.layouts.app')

@section('content')
        <!-- Service Details -->
        <div class="privacydetails-area ptb-100" style="margin-top:30px;">
            <div class="container">
                
                <div class="row" style="margin-bottom:40px">
                    <!-- <div class="privacyalldetails" style="border:2px solid red;"> -->
                       <div class="col-lg-6">
                           <div class="privacydetails" style="padding-top:15px;">
                               <h2>About us</h2>
                               <p><b>Providing health care solutions through innovation for everyone, wherever, whenever</b></p> Health should never be compromised, we believe that everyone should have access to instant and affordable health care from certified doctors. The lack of access to affordable primary care in certain rural areas where due to the unavailability of a certified doctor for treatment has led to patient deaths without treatment. Our mission is to connect to everyone and provide affordable primary health care through innovative technology, allowing both patients and doctors to communicate over long distances and within their comfort zone. </p>
                           </div>
                       </div>

                       <div class="col-lg-6">
                           <div class="privacydetails-inner-left">
                               <img src="{{asset('assets/img/about-us/org_aaAbout-Us.jpg')}}" width="100%" style="padding-top:20px;" alt="Service">
                           </div>
                       </div>
                    <!-- </div> -->
                </div>

                <div class="row" style="margin-bottom:40px">
                    <!-- <div class="col-lg-12"><h1 style="border-bottom:1px solid #057bb8;">HeloDoc Investor</h1></div> -->
                    <div class="col-lg-12" style="margin-bottom:15px;">
                        <div class="privacydetails" style="">
                            <h2>HeloDoc Investor</h2>
                            </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="privacydetails">
                            <h4>Medinova Medical Services</h4>
                            <p>Medinova started its journey in 1992. It is an approved medical check-up center of the Executive Board of The Health Minister’s Council for G.C.C (Gulf Co-operation Council) States. They are one of the members of GAMCA, Dhaka, Bangladesh. Medinova began with the vision to create a chain of integrated tertiary-level diagnostic healthcare centers in Bangladesh.<br> Medinova has made it their mission to provide “Good health for all” and is dedicated to providing diversified and personalized medical imaging and laboratory medicine services of high quality to its patients</p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="privacydetails-inner-left">
                            <!-- <img src="assets/img/privacy/UberIM_010182_3x2.jpg" alt="Service"> -->
                            <img src="{{asset('assets/img/about-us/Medinovas.png')}}" width="100%" style="padding-top:20px;border:1px solid #18166a"; alt="Service">
                        </div>
                    </div>
                </div>

                <div class="row" style="margin-bottom:40px">
                    <div class="col-lg-6" style="margin-bottom:15px;">
                        <div class="privacydetails" style="">
                            <h4>Smarttech IT Solution Ltd.</h4>
                            <p>STIS focuses on solving the problems faced by humanity through innovative solutions and partnering with a diverse community.</p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="privacydetails-inner-left">
                            <!-- <img src="assets/img/privacy/UberIM_010182_3x2.jpg" alt="Service"> -->
                            <a href="https://stis.com.bd"><img src="{{asset('assets/img/about-us/STIS.jpg')}}" width="100%" style="padding-top:20px; border:1px solid #2c7059" alt="Service"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- End Privacy Blog -->

        <!-- Service Details -->
        <!-- <div class="privacydetails-area ptb-100">
            <div class="container">
                
                <div class="row" style="margin-bottom:40px">
                    
                       <div class="col-lg-6">
                           <div class="privacydetails-inner-left">
                               <img src="assets/img/privacy/default.jpg" alt="Service">
                           </div>
                       </div>

                       <div class="col-lg-6">
                           <div class="privacydetails-inner">
                               <h2>Partnering to make a difference</h2>
                               <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Architecto blanditiis obcaecati veritatis magnam pariatur molestiae in maxime. Animi quae vitae in inventore. Totam mollitia aspernatur provident veniam aperiam placeat impedit! Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe rem natus nobis, dolorum nam excepturi iure autem nemo ducimus temporibus facere, est eum voluptatem, culpa optio fugit assumenda quod? Praesentium.</p>
                               <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Id, laudantium ullam, iure distinctio officia libero voluptatem obcaecati vero deleniti minima nemo itaque alias nisi eveniet soluta architecto quae laboriosam unde.</p>
                           </div>
                       </div>
                    
                </div>
            </div>
        </div> -->
        <!-- End Service Details -->

        <!-- Privacy Blog -->
        <!-- <section class="privacydriverrider-area">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-lg-6">
                        <div class="privacydriverriderblog-item">
                            <div class="privacydriverriderblog-top">
                                <a href="javascript:void()">
                                    <img src="assets/img/privacy/driver-icon.png" alt="Blog">
                                </a>
                            </div>
                            <div class="privacydriverriderblog-bottom">
                                <h3>
                                    <a href="javascript:void()">Driver safety</a>
                                </h3>
                                <p>Drive when and where you want with confidence.</p>
                                <ul>
                                    <li>
                                        <a href="javascript:void()">
                                            Read More
                                            <i class="icofont-long-arrow-right"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-sm-6 col-lg-6 wow fadeInUp" data-wow-delay=".3s">
                        <div class="privacydriverriderblog-item">
                            <div class="privacydriverriderblog-top">
                                <a href="javascript:void()">
                                    <img src="assets/img/privacy/car-icon.png" alt="Blog">
                                    
                                </a>
                            </div>
                            <div class="privacydriverriderblog-bottom">
                                <h3>
                                    <a href="javascript:void()">Rider safety</a>
                                </h3>
                                <p>Go anytime and get there comfortably.</p>
                                <ul>
                                    <li>
                                        <a href="javascript:void()">
                                            Read More
                                            <i class="icofont-long-arrow-right"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> -->
        <!-- End Privacy Blog -->
@endsection