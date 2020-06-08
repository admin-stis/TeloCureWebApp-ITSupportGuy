<!DOCTYPE html>
<html lang="zxx">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{url('assets/css/bootstrap.min.css')}}">
        <!-- Owl Carousel CSS -->
        <link rel="stylesheet" href="{{url('assets/css/owl.carousel.min.css')}}">
        <link rel="stylesheet" href="{{url('assets/css/owl.theme.default.min.css')}}">
        <!-- Meanmenu CSS -->
        <link rel="stylesheet" href="{{url('assets/css/meanmenu.css')}}">
        <!-- Icofonts CSS -->
        <link rel="stylesheet" href="{{url('assets/css/icofont.min.css')}}">
        <!-- Slick Slider CSS -->
        <link rel="stylesheet" href="{{url('assets/css/slick.min.css')}}">
        <link rel="stylesheet" href="{{url('assets/css/slick-theme.css')}}">
        <!-- Magnific Popup -->
        <link rel="stylesheet" href="{{url('assets/css/magnific-popup.css')}}">
        <!-- Wow CSS -->
        <link rel="stylesheet" href="{{url('assets/css/animate.css')}}">
        <!-- Style CSS -->
        <link rel="stylesheet" href="{{url('assets/css/style.css')}}">
        <!-- Responsive CSS -->
        <link rel="stylesheet" href="{{url('assets/css/responsive.css')}}">
        <!-- Media Query -->
        <link rel="stylesheet" href="{{url('assets/css/media-queries.css')}}">

        <!-- <link rel="stylesheet" href="{{url('assets/css/style-new.css')}}"> -->

        <title>HeloDoc</title>

        <link rel="icon" type="image/png" href="{{url('assets/img/logo.png')}}">
    </head>
    <body>

        <!-- Header Top -->
        <div class="header-top">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-sm-9 col-lg-10">
                        <div class="header-top-item">
                            <div class="header-top-left">
                                <marquee class="news" behavior="scroll" direction="left" onmouseover="this.stop();" onmouseout="this.start();">Breaking News : There are more than 1.7 million confirmed cases of coronavirus in 185 countries and at least 103,000 people have died .
<a href="https://www.bbc.com/news/world-51235105">Read more</a>
                                </marquee>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3 col-lg-2">
                        <div class="header-top-item">
                            <div class="header-top-right">
                                <ul>
                                    <li  class="">
                                        <a href="mailto:info@medisev.com">
                                            <i class="icofont-envelope"></i>
                                        </a>
                                    </li>
                                    <li  class="">
                                        <a href="tel:+07554332322">
                                            <i class="icofont-phone"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item trigger">
                                        <a class="" href="#">
                                            <i class="icofont-globe"></i>
                                        </a>
                                        <ul class="sub">
                                            <li class="nav-item item">
                                                <a href="index.html" class="">English</a>
                                            </li>
                                            <li class="nav-item item">
                                                <a href="#" class="active">Bangla</a>
                                            </li>
                                        </ul>
                                    </li> <!--                                    <li class="nav-item dropdown ">
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="icofont-globe"></span>
                                            <span class="caret"></span></a>
                                            <div aria-labelledby="navbarDropdown"
                                            class="globe dropdown-menu dropdown-menu-right"><a href="#" class="dropdown-item" style="">
                                                English
                                                </a>
                                                <a href="#" class="dropdown-item" >
                                                    Bangla
                                                </a>
                                            </div>
                                    </li>
  -->                               </ul>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Header Top -->

        <!-- Start Navbar Area -->
        <div class="navbar-area sticky-top">
            <!-- Menu For Mobile Device -->
            <div class="mobile-nav">
            <a href="{{url('/')}}" class="logo mobile-logo">
                    <img src="{{url('assets/img/logo.png')}}" alt="HeloDoc">
                </a>
            </div>

            <!-- Menu For Desktop Device -->
            <div class="main-nav">
                <div class="container">
                    <nav class="navbar navbar-expand-md navbar-light">
                        <a class="navbar-brand" href="{{url('/')}}">
                            <img src="{{url('assets/img/logo.png')}}" alt="HeloDoc">
                        </a>
                        <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    {{-- <a href="#" class="nav-link dropdown-toggle ">Home</a>
                                    <ul class="dropdown-menu">
                                        <li class="nav-item">
                                            <a href="index.html" class="nav-link">Home Page 1</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link active">Home Page 2</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="index-3.html" class="nav-link">Home Page 3</a>
                                        </li>
                                    </ul> --}}
                                    <a href="{{url('/')}}" class="nav-link">Home</a>
                                </li>

                                <li class="nav-item">
                                    <a href="#" class="nav-link dropdown-toggle">Product & Services</a>
                                    <ul class="dropdown-menu">
                                        <li class="nav-item">
                                            <a href="{{ url('service/patient') }}" class="nav-link">Patient</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ url('service/doctor') }}" class="nav-link">Doctor</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ url('service/hospital') }}" class="nav-link">Hospital</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="{{ url('service/e-prescription') }}" class="nav-link">E-prescription</a>
                                        </li>
                                    </ul>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ url('about') }}" class="nav-link">About Us</a>
                                </li>

                                <li class="nav-item">
                                    <a href="{{ url('privacy') }}" class="nav-link">Privacy</a>
                                </li>


                                <li class="nav-item">
                                    <a href="#" class="nav-link dropdown-toggle">Help</a>
                                    <ul class="dropdown-menu">
                                        <li class="nav-item">
                                            <a href="{{ url('help/faq') }}" class="nav-link">FAQ</a>
                                        </li>
                                        <li class="nav-item">
                                            <a  href="{{ url('help/howitworks') }}" class="nav-link">How It Works</a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a href="{{url('contact')}}" class="nav-link">Contact Us</a>
                                </li>
                            </ul>
                            <div class="nav-srh">
                                <ul class="navbar-nav">
                                    <li class="nav-item">
                                        <a href="{{url('loginarea')}}" class="nav-link">Login</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{url('registerarea')}}" class="nav-link">Sign Up</a>
                                    </li>
                                </ul>

                                {{-- <div class="search-toggle">
                                    <button class="search-icon icon-search"><i class="icofont-search-1"></i></button>
                                    <button class="search-icon icon-close"><i class="icofont-close"></i></button>
                                </div>
                                <div class="search-area">
                                    <form>
                                        <input type="text" class="src-input" id="search-terms" placeholder="Search here..." />
                                        <button type="submit" name="submit" value="Go" class="search-icon"><i class="icofont-search-1"></i></button>
                                    </form>
                                </div> --}}
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
        <!-- End Navbar Area -->

        <main class="">
            @yield('content')
        </main>

        <div class="">
            <img class="footerImage img-responsive" src="{{asset('assets/img/slider/afterFooter.png')}}" style="width:100%;" />
        </div>

        <!-- Footer -->
        <footer class="" style="padding-top:20px;">

            <!-- Newsletter -->
            {{-- <div class="newsletter-area">
                <div class="container">
                    <div class="row newsletter-wrap align-items-center">
                        <div class="col-lg-7">
                            <div class="newsletter-item">
                                <h2>Join Our Newsletter</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod.</p>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="newsletter-item">
                                <div class="newsletter-form">
                                    <form class="newsletter-form" data-toggle="validator">
                                        <input type="email" class="form-control" placeholder="Enter Your Email" name="EMAIL" required autocomplete="off">

                                        <button class="btn newsletter-btn" type="submit">
                                            Subscribe
                                        </button>

                                        <div id="validator-newsletter" class="form-result"></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            <!-- End Newsletter -->

            <div class="container">
                <div class="row">
                    <div class="col-lg-4  col-md-3 col-sm-7">
                            <a class="" href="#" style="">
                                <img class="footer-img" alt="" src="{{asset('assets/img/logo_2.png')}}"/>
                            </a>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <form class="form-inline subscribe-mail" action="#">
                                {{-- <div class="subscribe-mail"> --}}
                                  <input type="email" class="form-control" id="footer-email" placeholder="Email Address" name="email" style="border:0;border-radius: 0;">
                                  <button type="submit" style="padding: 7px;" class="drop-btn btn btn-primary">Subscribe</button>
                                {{-- </div> --}}
                            </form>
                        </div>
                        <div class="col-lg-4 col-md-3 col-sm-7">
                            <ul class="social">
                                <li class="list-inline-item"><a href="javascript:void();">
                                    <i class="icofont-facebook"></i></a></li>
                                <li class="list-inline-item"><a href="javascript:void();"><i class="icofont-twitter"></i></a></li>
                                <li class="list-inline-item"><a href="javascript:void();"><i class="icofont-instagram"></i></a></li>
                                <li class="list-inline-item"><a href="javascript:void();"><i class="icofont-google-plus"></i></a></li>
                                <li class="list-inline-item"><a href="javascript:void();" target="_blank"><i class="icofont-envelope"></i></a></li>
                            </ul>
                                    </div>
                </div>
                <hr>
                <div style="margin-bottom: 2px;"></div>

                <div class="row">

                    <div class="col-sm-6 col-lg-3">
                        <div class="footer-item">
                            <div class="footer-contact footer-quick">
                                <h3>Contact Us</h3>
                                <ul>
                                    <li>
                                        <i class="icofont-ui-message"></i>
                                        <a href="mailto:info@medisev.com">hr@stis.com.bd</a>
                                    </li>
                                    <li>
                                        <i class="icofont-stock-mobile"></i>
                                        <a href="tel:+07554332322">Call: +8801743440907</a>
                                    </li>
                                    <li>
                                        <i class="icofont-location-pin"></i>
                                        House #34, Road #3, Section #11, Block #D, Mirpur, Dhaka 1216
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-2">
                        <div class="footer-item">
                            <div class="footer-quick">
                                <h3>Product & Service</h3>
                                <ul>
                                    <li>
                                        <a href="{{ url('service/patient') }}">Patient</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('service/doctor') }}">Doctor</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('service/hospital') }}">Hospital</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('service/e-prescription') }}">E-prescription</a>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-2">
                        <div class="footer-item">
                            <div class="footer-quick">
                                <h3>Quick Links</h3>
                                <ul>
                                    <li>
                                        <a href="#">My Account</a>
                                    </li>
                                    <li>
                                        <a href="#">Sign Up</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('help/faq') }}"">FAQ</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('help/howitworks') }}"">How HeloDoc Works</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-2">
                        <div class="footer-item">
                            <div class="footer-quick">
                                <h3>Others</h3>
                                <ul>
                                    <li>
                                        <a href="{{ url('privacy') }}">Privacy</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('appsprivacy') }}" target="_blank">Apps Privacy</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-lg-3">
                        <div class="footer-item">
                            <div class="footer-quick">
                                <h3>Powered By</h3>
                                <ul>
                                    <li>
                                        <a href="{{ url('https://stis.com.bd') }}" target="_blank">Smarttech IT Solution Ltd.</a>
                                    </li>
                                    <li>
                                        <!-- <a href="{{ url('appsprivacy') }}" target="_blank">Apps Privacy</a> -->
                                        <!-- <a href="https://stis.com.bd" target="_blank"><img src="{{asset('assets/img/about-us/STIS.jpg')}}" width="100%" style="border:1px solid #2c7059" alt="Service"></a> -->
                                        <a href="https://stis.com.bd" target="_blank"><img src="{{asset('assets/img/about-us/smarttechsolution.png')}}" width="100%" style="border:1px solid #2c7059" alt="Service"></a>

                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-sm-6 col-lg-3">
                        <div class="footer-item">
                            <div class="footer-feedback">
                                <h3>Feedback</h3>
                                <form>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Name">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Phone">
                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control" id="your_message" rows="5" placeholder="Message"></textarea>
                                    </div>
                                    <div class="text-left">
                                        <button type="submit" class="btn feedback-btn">SUBMIT</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div> --}}
                </div>

            <hr>

            <div class="row">
                <ul class="footer-bottom">
                    <li class="list-inline-item"><a href="{{url('/')}}" class="nav-link">Home</a></li>
                    <li class="list-inline-item"><a class="nav-link">|</a></li>
                    <li class="list-inline-item"><a href="{{ url('about') }}" class="nav-link">About</a></li>
                    <li class="list-inline-item"><a class="nav-link">|</a></li>
                    <li class="list-inline-item"><a href="{{ url('contact') }}" class="nav-link">Contact Us</a></li>
                </ul>
            </div>
            </div>

        </footer>
        <!-- End Footer -->
    </div>
</body>

<!-- Essential JS -->
<script src="{{url('assets/js/jquery.min.js')}}"></script>
<script src="{{url('assets/js/popper.min.js')}}"></script>
<script src="{{url('assets/js/bootstrap.min.js')}}"></script>
<!-- Owl Carousel JS -->
<script src="{{url('assets/js/owl.carousel.min.js')}}"></script>
<!-- Meanmenu JS -->
<script src="{{url('assets/js/jquery.meanmenu.js')}}"></script>
<!-- Counter JS -->
<script src="{{url('assets/js/jquery.counterup.min.js')}}"></script>
<script src="{{url('assets/js/waypoints.min.js')}}"></script>
<!-- Slider Slider JS -->
<script src="{{url('assets/js/slick.min.js')}}"></script>
<!-- Magnific Popup -->
<script src="{{url('assets/js/jquery.magnific-popup.min.js')}}"></script>
<!-- Wow JS -->
<script src="{{url('assets/js/wow.min.js')}}"></script>
<!-- Form Ajaxchimp JS -->
<script src="{{url('assets/js/jquery.ajaxchimp.min.js')}}"></script>
<!-- Form Validator JS -->
<script src="{{url('assets/js/form-validator.min.js')}}"></script>
<!-- Contact JS -->
<script src="{{url('assets/js/contact-form-script.js')}}"></script>
<!-- Map JS -->
<script src="{{url('assets/js/map.js')}}"></script>
<!-- Custom JS -->
<script src="{{url('assets/js/custom.js')}}"></script>

</html>
