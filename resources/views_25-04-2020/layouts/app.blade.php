<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', env('APP_NAME')) }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    {{-- Font Awesom --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('css/mobile.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <header class="banner">
            <div class="container">
                <div class="row">

                    <div class="logo col-md-4 col-sm-12">
                        <a class="col-6 navbar-brand" href="{{ url('/') }}">
                            <img src="{{asset('images/logo.png')}}" alt="HeloDoc" class=""/>
                        </a>
                    </div>

                    <div class="col-md-4 col-sm-12"></div>

                    <div class="top-right col-md-4 col-sm-12">
                        <ul class=" navbar-brand pull-right" >
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <span class="fa fa-globe"></span> <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="#">
                                        {{ __('English') }}
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        {{ __('Bangla') }}
                                    </a>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#"><span class="fa fa-phone"></span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#"><span class="fa fa-envelope"></span></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>

        <nav class="navbar navbar-expand-md navbar-light shadow-sm menu">
            <div class="container">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="col-10 navbar-nav primary_menu">
                        <!-- Authentication Links -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('home') }}">{{ __('Home') }}</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ __('Product & Services') }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ url('service/patient') }}">
                                    {{ __('Patient') }}
                                </a>
                                <a class="dropdown-item" href="{{ url('service/doctor') }}">
                                    {{ __('Doctor') }}
                                </a>
                                <a class="dropdown-item" href="{{ url('service/hospital') }}">
                                    {{ __('Hospital') }}
                                </a>
                                <a class="dropdown-item" href="{{ url('service/e-prescription') }}">
                                    {{ __('E-prescription') }}
                                </a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ __('Profile') }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ url('profile/about') }}">
                                    {{ __('About Us') }}
                                </a>
                                <a class="dropdown-item" href="{{ url('profile/workingprocess') }}">
                                    {{ __('How HeloDoc Works') }}
                                </a>
                                <a class="dropdown-item" href="{{ url('profile/investor') }}">
                                    {{ __('Investor') }}
                                </a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('privacy') }}">{{ __('Privacy') }}</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ __('Help') }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ url('help/patient') }}">
                                    {{ __('Patient') }}
                                </a>
                                <a class="dropdown-item" href="{{ url('help/doctor') }}">
                                    {{ __('Doctor') }}
                                </a>
                                <a class="dropdown-item" href="{{ url('help/hospital') }}">
                                    {{ __('Hospital') }}
                                </a>
                            </div>
                        </li>
                    </ul>
                    <ul class="navbar-nav ml-auto">
                        
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>

                    {{-- <ul class="col-2 navbar-nav mr-auto d-flex" >
                        @guest
                            <li class="nav-item">
                                
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item"
                                href="{{ __('login/patient') }}">
                                    {{ __('Patient Login') }}
                                </a>
                                <a class="dropdown-item" href="{{ __('login/doctor') }}">
                                    {{ __('Doctor Login') }}
                                </a>
                                <a class="dropdown-item" href="{{ __('login/hospital') }}">
                                    {{ __('Hospital Login') }}
                                </a>
                            </div>


                            @if (Route::has('register'))
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ __('Register') }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ __('register') }}">
                                        {{ __('Patient Register') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ __('register') }}">
                                        {{ __('Doctor Register') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ __('register') }}">
                                        {{ __('Hospital Register') }}
                                    </a>
                                </div>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ url('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ url('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul> --}}
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>

        <section id="footer" class="">
            <div class="container">
                {{-- <div class="row text-center text-xs-center text-sm-left text-md-left"> --}}
                <div class="row">
                    <div class="col-xs-12 col-sm-4 col-md-4">
                        <h5>HeloDoc Product & Services </h5>
                        <ul class="list-unstyled quick-links">
                            <li><a href="javascript:void();"><i class="fa fa-angle-double-right"></i>Patient</a></li>
                            <li><a href="javascript:void();"><i class="fa fa-angle-double-right"></i>Doctor</a></li>
                            <li><a href="javascript:void();"><i class="fa fa-angle-double-right"></i>Hospital</a></li>
                        </ul>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4">
                        <h5>Quick links</h5>
                        <ul class="list-unstyled quick-links">
                            <li><a href="javascript:void();"><i class="fa fa-angle-double-right"></i>Login</a></li>
                            <li><a href="javascript:void();"><i class="fa fa-angle-double-right"></i>Sign Up</a></li>
                            <li><a href="javascript:void();"><i class="fa fa-angle-double-right"></i>Privacy</a></li>
                            <li><a href="javascript:void();"><i class="fa fa-angle-double-right"></i>Help</a></li>
                        </ul>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4">
                        <ul class="list-unstyled list-inline social">
                            <li class="list-inline-item"><a href="javascript:void();"><i class="fa fa-facebook"></i></a></li>
                            <li class="list-inline-item"><a href="javascript:void();"><i class="fa fa-twitter"></i></a></li>
                            <li class="list-inline-item"><a href="javascript:void();"><i class="fa fa-instagram"></i></a></li>
                            <li class="list-inline-item"><a href="javascript:void();"><i class="fa fa-google-plus"></i></a></li>
                            <li class="list-inline-item"><a href="javascript:void();" target="_blank"><i class="fa fa-envelope"></i></a></li>
                        </ul>
                        <div class="row powered_by">
                            <p class="col-md-12">Powered by</p>
                            <div class="col-md-3"><img alt="" src="{{asset('images/logo.png')}}" /></div>
                            <div class="col-md-9">
                                <span>Smart Tech Solutions</span><br>
                                <span>Bringing Innovation For All</span><br>
                                <span><b>Smart Tech IT Solutions BD</b></span>
                            </div>
                            <div class="col-xs-12 col-sm-4 col-md-4"></div>
                        </div>
                    </div>
                    <div></div>
                </div>
                <div class="row">
                    <ul class="navbar-brand footer_menu" >
                        <li class="nav-item">
                            <a class="nav-link" href="#"><img alt="" src="{{asset('images/logo.png')}}"/></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">About us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">How HeloDoc Works</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="copyright col-xs-12 col-sm-12 col-md-12 text-white">
                <p class="">&copy Copyright - 2020 All right Reversed.<a class="text-green ml-2" href="https://www.sunlimetech.com" target="_blank"></a></p>
            </div>
        </section>

    </div>
</body>
</html>
