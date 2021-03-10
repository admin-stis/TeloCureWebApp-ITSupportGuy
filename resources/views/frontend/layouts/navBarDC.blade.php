
<style>
    
    </style>

  <!-- Start Navbar Area -->
    <div class="navbar-area sticky-top">
        <!-- Menu For Mobile Device -->
        <div class="mobile-nav mean-container">
            <div class="mean-bar">

               <a href="{{url('/')}}" class="meanmenu-reveal" style="background:;color:;right:0;left:auto;">
                <span></span><span></span><span></span>
                </a> 
            <a href="{{url('/')}}" class="logo mobile-logo">
                <img src="{{url('assets/img/logo.png')}}"  alt="HeloDoc">
            </a>
             
            </div>
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

                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- End Navbar Area -->
