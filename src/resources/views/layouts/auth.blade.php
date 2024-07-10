<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Ecommerce Fashion</title>
    <!-- Scripts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- <link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css') }}"> -->
    <!-- for icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>


    <style>
        html,
        body,
        #app {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        .navbar {
            height: 60px;
            /* adjust as needed */
        }

        #app {
            display: flex;
            flex-direction: column;
        }

        main {
            flex: 1;
            overflow: auto;
            height: 100%;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
        }

        .loginHeader {
            background-color: #FFD8FO;
            width: 100%;
            text-align: right;
        }

        a {
            color: black;
            text-decoration: none;
        }

        .test::before {
            content: "";
            position: absolute;
            z-index: -1;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('/images/welcomePage.png');
            background-repeat: no-repeat;
            background-size: cover;
            filter: blur(3px);
        }

        .test {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
            justify-content: center;
            align-items: center;
        }

        .dropdown:hover .dropdown-menu {
            display: block;
            /* optional: remove the top margin */
        }

        .searchField {
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
        }

        .searchBtn {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
        }

        .footer {
            background-color: #FFD8FO;
            width: 100%;
            padding-top: 10px;
        }

        .navbar-brand {
            font-size: 30px !important;
            font-family: Fantasy;
        }

        .category-link {
            display: inline-block;
            color: #ffff;
            font-weight: bold;
            font-size: 18px !important;
            text-transform: uppercase;
            padding: 10px 20px;
            background-color: #FFD8FO;
            border-radius: 5px;
            transition: background-color 0.2s ease;
        }

        .category-link:hover {
            background-color: #6699ff;
        }

        .navbar-nav {
            display: flex;
            align-items: center;
        }

        .nav-link {
            font-size: 18px;
        }

        .w-5 {
            display: none
        }
    </style>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel loginHeader">
            <div class="container">
                <a class="navbar-brand" href="{{ route('home') }}">
                    Ecommerce Fashion 
                </a>

                <button class="navbar-toggler" type="button" datatoggle="collapse" data-target="#navbarSupportedContent" ariacontrols="navbarSupportedContent" aria-expanded="false" arialabel="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    
                    <!-- Right Side Of Navbar -->
                    <div style="display:flex; justify-content:flex-end; width:100%;">
                        @cannot('isAdmin')
                        <form class="d-flex" style="margin-right:30px;" action="{{ route('search') }}" method="GET">
                            <input class="form-control searchField" type="text" name="query" placeholder="Search products..." aria-label="Search">
                            <button class="btn btn-primary searchBtn" type="submit"><i class="fas fa-search"></i></button>
                        </form>
                        @endCannot
                        <ul class="navbar-nav">
                            <!-- Authentication Links -->
                            @cannot('isAdmin')
                            <li class="nav-item">
                                <a class="nav-link" aria-current="page" href="{{ route('cart') }}"><i class="fa fa-shopping-cart" style="font-size:20px"></i></a>
                            </li>
                            @endCannot
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle {{ Request::is('*myAccount*') ? 'active' : '' }}" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class='far fa-user-circle' style='font-size:25px'></i> {{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                   
                                
                                <li><a class="dropdown-item" href="{{ route('myAccount') }}">My Account</a></li>
                                    <hr> 
                                    <li><a class="redirectButton"> Chat </a></li>
                                    <hr>
                                    <li><a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <main>
            <div class="container mt-4">
                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif
                @yield('content')
            </div>

            @yield('scripts')
        </main>
    </div>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelector(".redirectButton").addEventListener("click", function() {
            var prefix = "<?php echo env('CHATIFY_ROUTES_PREFIX', 'chat'); ?>";
            window.location.href = "http://127.0.0.1:8000/" + prefix;
        });
    });
</script>
</body>

<footer>
    <div class="footer">
        <div class="container">
            <div class="row" style="width:100%;">
                @cannot('isAdmin')

                @endCannot

                <div class="col">
                    <h3>USEFUL LINK</h3>
                    <ul>
                        <li><a href="{{ route('about') }}">ABOUT US</a></li>
                        <li><a href="{{ route('aboutUs') }}">ANNOUNCEMENT</a></li>
                        <li><a href="{{ route('orderHistory') }}">ORDER HISTORY</a></li>
                        <li><a href="{{ route('privacy') }}">PRIVACY POLICY</a></li>
                        <li><a href="{{ route('terms') }}">TERMS & CONDITIONS</a></li>
                        <li><a href="{{ route('myAccount') }}">MY ACCOUNT</a></li>

                    
                    </ul>
                </div>

                <div class="col">
                    <h3>FOLLOW US</h3>
                    <div class="social-links">
                        <a href="https://www.facebook.com/"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://www.instagram.com/"><i class="fab fa-instagram"></i></a>
                        <a href="https://www.whatsapp.com/"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
            </div>

            <p style="color: white; text-align:center"> Copyright © 2023 Ecommerce Fashion </p>
        </div>
    </div>
</footer>

</html>