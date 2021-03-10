<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', env('APP_NAME')) }}</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ url('assets/css/bootstrap.min.css') }}">
    <!-- Owl Carousel CSS -->
    <link rel="stylesheet" href="{{ url('assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/owl.theme.default.min.css') }}">
    <!-- Meanmenu CSS -->
    <link rel="stylesheet" href="{{ url('assets/css/meanmenu.css') }}">
    <!-- Icofonts CSS -->
    <link rel="stylesheet" href="{{ url('assets/css/icofont.min.css') }}">
    <!-- Slick Slider CSS -->
    <link rel="stylesheet" href="{{ url('assets/css/slick.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/slick-theme.css') }}">
    <!-- Magnific Popup -->
    <link rel="stylesheet" href="{{ url('assets/css/magnific-popup.css') }}">
    <!-- Wow CSS -->
    <link rel="stylesheet" href="{{ url('assets/css/animate.css') }}">
    <!-- Style CSS -->
    <link rel="stylesheet" href="{{ url('assets/css/style.css') }}">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{ url('assets/css/responsive.css') }}">
    <!-- Media Query -->
    <link rel="stylesheet" href="{{ url('assets/css/media-queries.css') }}">

    <!-- <link rel="icon" type="image/png" href="{{ url('assets/img/logo.png') }}"> -->


    <style>

    </style>
</head>

<body>

    <!-- Header Top -->
    <div class="header-top">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-sm-9 col-lg-10">
                    <div class="header-top-item">
                        <div class="header-top-left">
                            {{-- <marquee class="news" behavior="scroll" direction="left" onmouseover="this.stop();" onmouseout="this.start();">
                                   Breaking News : There are more than 32 million confirmed cases of coronavirus in 188 countries and at least 900,000 people have died .
<a href="https://www.bbc.com/news/world-51235105">Read more</a>
                                </marquee> --}}



                            <marquee style="font-family:Times New Roman, Times, serif;" color:#9adbd9; scrollamount="2"
                                class=" " behavior="scroll" direction="left" onmouseover="this.stop();"
                                onmouseout="this.start();">
                                <div onload="renderTime();">
                                    <span id="clockDisplay" class="container">

                                    </span>
                                    <span>
                                        <img style="height:2%" width="2%"
                                            src="{{ asset('backend/dist/img/logo.png') }}" style="opacity: .8">
                                        Bangladesh to collect another 60 million doses of Covid-19 vaccine by June
                                        <a
                                            href="https://www.dhakatribune.com/health/coronavirus/2020/12/21/covid-19-vaccine-1st-phase-scheduled-for-end-of-january-2021">
                                            Read more</a>
                                        করোনার টিকা আসছে ২৫ জানুয়ারির মধ্যে: বেক্সিমকো
                                        <a
                                            href="https://www.prothomalo.com/bangladesh/%E0%A6%95%E0%A6%B0%E0%A7%8B%E0%A6%A8%E0%A6%BE%E0%A6%B0-%E0%A6%9F%E0%A6%BF%E0%A6%95%E0%A6%BE-%E0%A6%86%E0%A6%B8%E0%A6%9B%E0%A7%87-%E0%A7%A8%E0%A7%AB-%E0%A6%9C%E0%A6%BE%E0%A6%A8%E0%A7%81%E0%A7%9F%E0%A6%BE%E0%A6%B0%E0%A6%BF%E0%A6%B0-%E0%A6%AE%E0%A6%A7%E0%A7%8D%E0%A6%AF%E0%A7%87-%E0%A6%AC%E0%A7%87%E0%A6%95%E0%A7%8D%E0%A6%B8%E0%A6%BF%E0%A6%AE%E0%A6%95%E0%A7%8B">
                                            Read more</a>
                                        ফেব্রুয়ারির শুরুর দিকে দেশের মানুষকে করোনার টিকা দেওয়া শুরু হবে। ব্যাপকভাবে
                                        মানুষকে টিকা দেওয়ার আগে কিছু স্বাস্থ্যকর্মী ও স্বেচ্ছাসেবককে টিকা দেওয়ার পর
                                        পর্যবেক্ষণ করা হবে। টিকা দেওয়ার জন্য অনলাইনে নিবন্ধন শুরু হবে ২৬ জানুয়ারি।
                                        <a href="
                                            https://www.prothomalo.com/bangladesh/%E0%A6%AB%E0%A7%87%E0%A6%AC%E0%A7%8D%E0%A6%B0%E0%A7%81%E0%A7%9F%E0%A6%BE%E0%A6%B0%E0%A6%BF%E0%A6%A4%E0%A7%87-%E0%A6%9F%E0%A6%BF%E0%A6%95%E0%A6%BE%E0%A6%A6%E0%A6%BE%E0%A6%A8-%E0%A6%B6%E0%A7%81%E0%A6%B0%E0%A7%81
                                            
                                            "> Read more</a>
                                    </span>
                                </div>

                            </marquee>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 col-lg-2" style="padding-left: 0%" ;>
                    <div class="header-top-item">
                        <div class="header-top-right">
                            <ul style="padding-left: 0%">
                                <li class="">
                                    <a href="mailto:support@telocure.com">
                                        <i class="icofont-envelope"></i>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="tel:09614501100">
                                        <i class="icofont-phone"></i>
                                    </a>
                                </li>
                                <li class="nav-item trigger">
                                    <a class="" href="#">
                                        <i class="icofont-globe"></i>
                                    </a>
                                    <ul class="sub">
                                        <li class="nav-item item">
                                            <a href="#" class="">English</a>
                                        </li>
                                        <li class="nav-item item">
                                            <a href="#" class="active">Bangla</a>
                                        </li>
                                    </ul>
                                </li>
                                <!--                                    <li class="nav-item dropdown ">
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
  -->
                            </ul>

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
            <a href="{{ url('/') }}" class="logo mobile-logo">
                <img src="{{ url('assets/img/logo_resized.png') }}" alt="HeloDoc">
            </a>
        </div>

        <!-- Menu For Desktop Device -->
        <div class="main-nav">
            <div class="container">
                <nav class="navbar navbar-expand-md navbar-light">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img src="{{ url('assets/img/logo_resized.png') }}" alt="HeloDoc">
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
                                <a href="{{ url('/') }}" class="nav-link">Home</a>
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
                                        <a href="{{ url('service/e-prescription') }}"
                                            class="nav-link">E-prescription</a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nav-item">
                                <a href="{{ url('about') }}" class="nav-link">About Us</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('ourDoctor') }}" class="nav-link">Our Doctors</a>
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
                                        <a href="{{ url('help/howitworks') }}" class="nav-link">How It Works</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('contact') }}" class="nav-link">Contact Us</a>
                            </li>
                        </ul>
                        <div class="nav-srh">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a href="{{ url('loginarea') }}" class="nav-link">Login</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('registerarea') }}" class="nav-link">Sign Up</a>
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
        <img class="footerImage img-responsive" src="{{ asset('assets/img/slider/afterFooter.png') }}"
            style="width:100%;" />
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
                        <img class="footer-img" alt="" src="{{ asset('assets/img/logo_2_resized.png') }}" />
                    </a>
                </div>






                <div class="col-lg-4 col-md-6 col-sm-6">
                  
                    <script src='https://www.google.com/recaptcha/api.js' async defer></script>
                    <form class="form-inline subscribe-mail" action="{{ url('subscribe') }}" method="post">
                        @csrf
                     <div class="subscribe-mail"> 

                        <div class=" ">
                            <div class="g-recaptcha" data-sitekey="6Lc82kMaAAAAAPjnIJ1iI2KcOBvGQVu2_BKN66A1"></div>
                          
                        </div>
                        <input type="email" class="form-control" id="footer-email" required placeholder="Email Address"
                            name="email" style="border:0;border-radius: 0;">
                        <button type="submit" style="padding: 7px;" class="drop-btn btn btn-primary">Subscribe</button>
                       
                       </div>  
                       
                    </form>
                    
                </div>
                






                <div class="col-lg-4 col-md-3 col-sm-7">
                    <ul class="social">
                        <li class="list-inline-item"><a href="https://www.facebook.com/TeloCure-111729097199298/">
                                <i class="icofont-facebook"></i></a></li>
                        <li class="list-inline-item"><a href="https://twitter.com/TeloCure"><i
                                    class="icofont-twitter"></i></a></li>
                        <li class="list-inline-item"><a href="https://www.instagram.com/telocure/"><i
                                    class="icofont-instagram"></i></a></li>
                        {{-- <li class="list-inline-item"><a href="javascript:void();"><i class="icofont-google-plus"></i></a></li>
                                <li class="list-inline-item"><a href="javascript:void();" target="_blank"><i class="icofont-envelope"></i></a></li> --}}
                        <li class="list-inline-item"><a href="https://www.youtube.com/watch?v=YPdOR-I6zHU"><i
                                    class="icofont-youtube"></i></a></li>
                        <li class="list-inline-item"><a href="https://www.linkedin.com/company/telocureapp/"
                                target="_blank"><i class="icofont-linkedin"></i></a></li>
                        <li class="list-inline-item"><a href="https://www.pinterest.com/Telocure" target="_blank"><i
                                    class="icofont-pinterest"></i></a></li>
                    </ul>
                </div>
            </div>
            <br>
        <!-- session message  -->
            <div   class="col-lg-12 col-md-12 col-sm-12 text-center"> @if (Session::has('notify-subscribe'))
                         
                         <p class="alert {{ Session::get('alert-class', 'alert-success') }}">
                             {{ Session::get('notify-subscribe') }}</p>
                   
                 @endif </div>
                 <!-- session message  -->
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
                                    <!-- <a href="mailto:info@medisev.com">hr@stis.com.bd</a> -->
                                    {{-- <a href="mailto:support@telocure.com">support@telocure.com</a> --}}
                                    support@telocure.com
                                </li>
                                <li>
                                    <i class="icofont-stock-mobile"></i>
                                    <!-- <a href="tel:+07554332322">Call: +8801743440907</a> -->
                                    {{-- <a href="tel:+8801743440907">Call: 09614501100</a> --}}
                                    Call: 09614501100
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
                                    <a href="https://telocure.com/loginarea">My Account</a>
                                </li>
                                <li>
                                    <a href="https://telocure.com/registerarea">Sign Up</a>
                                </li>
                                <li>
                                    <a href="{{ url('help/faq') }}"">FAQ</a>
                                    </li>
                                    <li>
                                        <a href=" {{ url('help/howitworks') }}"">How It Works</a>
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
                                <li>
                                    <a target="_blank" href="{{ url('terms') }}">Terms and Conditions</a>
                                </li>
                                <li>
                                    <a target="_blank" href="{{ url('refund') }}">Payment and Refund Policy</a>
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
                                    <a href="{{ url('https://stis.com.bd') }}" target="_blank">Smarttech IT Solution
                                        Ltd.</a>
                                </li>
                                <li>
                                    <!-- <a href="{{ url('appsprivacy') }}" target="_blank">Apps Privacy</a> -->
                                    <!-- <a href="https://stis.com.bd" target="_blank"><img src="{{ asset('assets/img/about-us/STIS.jpg') }}" width="100%" style="border:1px solid #2c7059" alt="Service"></a> -->
                                    <a href="https://stis.com.bd" target="_blank"><img
                                            src="{{ asset('assets/img/about-us/smarttechsolution-resized.png') }}"
                                            width="100%" style="border:1px solid #2c7059" alt="Service"></a>

                                </li>
                                <li>
                                    <a href="https://www.sslcommerz.com" target="_blank"><img
                                            src="{{ asset('assets/img/ssl.png') }}" width="100%" alt="ssl"></a>

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
                    <li class="list-inline-item"><a href="{{ url('/') }}" class="nav-link">Home</a></li>
                    <li class="list-inline-item"><a class="nav-link">|</a></li>
                    <li class="list-inline-item"><a href="{{ url('about') }}" class="nav-link">About Us</a></li>
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
<script src="{{ url('assets/js/jquery.min.js') }}"></script>
<script src="{{ url('assets/js/popper.min.js') }}"></script>
<script src="{{ url('assets/js/bootstrap.min.js') }}"></script>
<!-- Owl Carousel JS -->
<script src="{{ url('assets/js/owl.carousel.min.js') }}"></script>
<!-- Meanmenu JS -->
<script src="{{ url('assets/js/jquery.meanmenu.js') }}"></script>
<!-- Counter JS -->
<script src="{{ url('assets/js/jquery.counterup.min.js') }}"></script>
<script src="{{ url('assets/js/waypoints.min.js') }}"></script>
<!-- Slider Slider JS -->
<script src="{{ url('assets/js/slick.min.js') }}"></script>
<!-- Magnific Popup -->
<script src="{{ url('assets/js/jquery.magnific-popup.min.js') }}"></script>
<!-- Wow JS -->
<script src="{{ url('assets/js/wow.min.js') }}"></script>
<!-- Form Ajaxchimp JS -->
<script src="{{ url('assets/js/jquery.ajaxchimp.min.js') }}"></script>
<!-- Form Validator JS -->
<script src="{{ url('assets/js/form-validator.min.js') }}"></script>
<!-- Contact JS -->
<script src="{{ url('assets/js/contact-form-script.js') }}"></script>
<!-- Map JS -->
<script src="{{ url('assets/js/map.js') }}"></script>
<!-- Custom JS -->
<script src="{{ url('assets/js/custom.js') }}"></script>





<script>
    function renderTime() {
        var myDate = new Date();
        var year = myDate.getYear();
        if (year < 1000) {
            year += 1900
        }
        var day = myDate.getDay();
        var month = myDate.getMonth();
        var daym = myDate.getDate();
        var dayarray = new Array("Saturday", "Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday");
        var montharray = new Array("January", "February", "March", "April", "May", "June", "July", "August",
            "September", "October", "November", "December");


        //Time

        var currentTime = new Date();
        var h = currentTime.getHours();
        var m = currentTime.getMinutes();
        var s = currentTime.getSeconds();
        var session = "AM";
        if (h == 0) {
            h = 12;
        }
        if (h >= 12) {
            session = "PM";
        }


        if (h > 12) {
            h = h - 12;
        }

        m = (m < 10) ? m = "0" + m : m;
        s = (s < 10) ? s = "0" + s : s;


        var myClock = document.getElementById("clockDisplay");
        myClock.textContent = "Welcome to our Telocure. Today is " + dayarray[day] + " " + daym + " " + montharray[
                month] + " " + year + ". The time is    " + h + " : " + m + " : " + s + " " + session +
            ". Thanks for join us. ";
        myClock.innerText = "Welcome to our Telocure. Today is " + dayarray[day] + " " + daym + " " + montharray[
                month] + " " + year + ". The time is    " + h + " : " + m + " : " + s + " " + session +
            ". Thanks for join us. ";
        setTimeout("renderTime()", 1000);
    }
    renderTime();




    // International phone
    $(".dropdown-menu li a").click(function(evt) {
        // Setup VARs
        var inputGroup = $('.input-group');
        var inputGroupBtn = inputGroup.find('.input-group-btn .btn');
        var inputGroupAddon = inputGroup.find('.input-group-addon');
        var inputGroupInput = inputGroup.find('.form-control');

        // Get info for the selected country
        var selectedCountry = $(evt.target).closest('li');
        var selectedEmoji = selectedCountry.find('.flag-emoji').html();
        var selectedExampleNumber = selectedCountry.find('.example-number').html();
        var selectedCountryCode = selectedCountry.find('.country-code').html();

        // Dynamically update the picker
        inputGroupBtn.find('.emoji').html(selectedEmoji);
        inputGroupAddon.html(selectedCountryCode)
        inputGroupInput.attr("placeholder", selectedExampleNumber);
    });

</script>

</html>
