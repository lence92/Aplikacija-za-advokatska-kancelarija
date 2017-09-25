<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Law Office</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ url('image/profil_pozadina.png') }}"/>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css"
          integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css"
          integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js"
            integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js"
            integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
            crossorigin="anonymous"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}

            <!-- ui-jQuery -->
    <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet"
          type="text/css"/>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>

    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <script type="text/javascript">
        var jQuery_1_4 = $.noConflict(true);
    </script>

    <!-- Moi pozadini -->
    <link rel="stylesheet" href="{{ url('css/pozadina.css') }}"/>
    <link rel="stylesheet" href="{{ url('css/slika_cases.css') }}"/>
    <link rel="stylesheet" href="{{ url('css/slika_logo.css') }}"/>


    <style>
        body {
            font-family: 'Lato';
            background-color: #E9E9E9;
            padding-top: 50px;
        }

        #navBarGore {
            background-color: #3d4952;
        }

        #navBarStrana {
            background-color: #B0BEC5;
        }

        .nav.navbar-nav li a {
            color: #4EB1BA;
        }

        .nav.navbar-nav li a:hover {
            color: #E9E9E9;
        }

        .nav.navbar-nav .dropdown-menu li a {
            color: #626262;
        }

        .nav.navbar-nav .dropdown .dropdown-toggle:focus {
            background-color: #333b44;
            color: #E9E9E9;
        }

        .fa-btn {
            margin-right: 6px;
        }

        #bodyText {
            padding-top: 30px !important;

        }

        #bodyText2 {
            padding-top: 60px !important;
        }

        .dropdown-menu {
            position: absolute;
            left: 1px !important;
            padding-top: 15px;
            padding-bottom: 15px;
            margin-right: 20px;
        }

        #sideBar li a:focus {
            background-color: #E9E9E9 !important;
        }

        #sideBar li a:hover {
            background-color: #E9E9E9 !important;
        }

        #search {
            width: 130px;
            box-sizing: border-box;
            border: 2px solid #ccc;
            border-bottom-left-radius: 4px;
            border-top-left-radius: 4px;
            font-size: 16px;
            -webkit-transition: width 0.4s ease-in-out;
            transition: width 0.4s ease-in-out;
        }

        #search:focus {
            width: 83%;
        }

        #submit {
            border: 2px solid #ccc;
            font-size: 16px;
            margin-left: -5px;
            border-bottom-right-radius: 4px;
            border-top-right-radius: 4px;
        }

        footer {
            position: relative;
            height: 100px;
            width: 100%;
            margin-top: 150px;
        }

        p.copyright {
            position: absolute;
            width: 100%;
            color: #555555;
            line-height: 40px;
            font-size: 0.7em;
            text-align: center;
            padding-left: 150px !important;
            bottom: 0;
        }

    </style>
    @if(Auth::guest())
        <style>
            .navbar .navbar-default .navbar-fixed-top {
                min-height: 80px;
            }

            .navbar-nav > li > a {
                padding-top: 29px !important;
                padding-bottom: 0 !important;
                height: 80px;
            }

            .navbar-brand {
                padding-top: 20px !important;
                padding-bottom: 0 !important;
                height: 80px;
            }


        </style>
    @else
        <style>
            .navbar .navbar-default .navbar-fixed-top {
                min-height: 32px;
            }

            .navbar-nav > li > a {
                padding-top: 15px !important;
                padding-bottom: 0 !important;
                height: 46px;
                margin-right: 30px;
            }

            .navbar-brand {
                padding-top: 10px !important;
                padding-bottom: 0 !important;
                height: 30px;
            }

            .navbar-nav li .profile-image {
                margin-top: 10px !important;
                padding-bottom: 0 !important;
                border-radius: 50%;
            }

            #bodySideBar {
                padding-top: 30px;
                padding-bottom: 30px;
            }

            #bodySideBar .nav li a {
                color: #3d4952;
            }

            #bodySideBar .nav li a:hover {
                background: none;
            }

            .navbar-fixed-left {
                width: 170px;
                position: fixed;
                border-radius: 0;
                height: 100%;
                margin: 0 -30px;
                margin-top: -5px;
            }

        </style>
    @endif
</head>
<body id="app-layout">
<nav class="navbar navbar-default navbar-fixed-top" id="navBarGore">
    <div class="container-fluid">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
                @if(Auth::guest())
                    <img src='{{ url('image/LogoMakr.png') }}' width="300" height="40" style="padding-left: 50px">
                @else
                    <img src='{{ url('image/LogoMakr.png') }}' width="200" height="25">
                @endif
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li style="padding-right: 50px;"><a href="{{ url('/login') }}">Најави се</a></li>
                @else
                    <li>
                        <img src="{{ url(Auth::user()->image) }}" class="profile-image" width="35" height="30">
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }}<span class="caret"></span>
                        </a>
                        @if(!empty($username))
                            <div>{{$username}}</div>
                        @endif

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('/profile/'.Auth::user()->id) }}"><i class="fa fa-btn fa-user"></i>Профил</a>
                            </li>
                            <hr>
                            @if(Auth::user()->is_admin())
                                <li><a href="{{ url('/addUser') }}"><i class="fa fa-btn fa-pencil"></i>Додади
                                        корисник</a></li>
                            @endif
                            <li><a href="{{ url('/addCase') }}"><i class="glyphicon glyphicon-briefcase"></i> &nbsp
                                    Додади предмет </a></li>
                            <li><a href="{{ url('/addTask') }}"><i class="glyphicon glyphicon-list-alt"></i> &nbsp
                                    Додади задача </a></li>
                            <hr>
                            <li>
                                &nbsp;<span style="margin-left: 30px; margin-right: 10px"><a href="{{ url('/shareOnFB') }}"><i class="fa fa-facebook" aria-hidden="true"></i></a></span>
                                &nbsp;<span style="margin-right: 10px">
                                    <a href="https://plus.google.com/share?url={{url('image/LogoMakr.png')}}"
                                       onclick="javascript:window.open(this.href,'', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=500,width=500');return false;">
                                        <i class="fa fa-google-plus" aria-hidden="true" data-action="share"></i>
                                    </a></span>
                                &nbsp;<span style="margin-right: 10px"><a><i class="fa fa-twitter" aria-hidden="true"></i></a></span>
                            </li>
                            <hr>
                            <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Одјави се</a></li>
                        </ul>
                    </li>
                    <li style="padding-top: 10px; padding-right: 50px;">
                        <form action="{{ url('/search') }}" method="post">
                            {{ csrf_field() }}
                            <input type="text" name="search" placeholder="Пребарај..." id="search">
                            <button name="submit" type="submit" id="submit">
                                <img src="{{ url('/image/search_icon.png') }}" width="20" height="19">
                            </button>
                        </form>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>

@if(!Auth::guest())
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-4 col-sm-3 col-md-2 col-lg-2">
                <nav class="navbar navbar-default navbar-fixed-left" id="navBarStrana">
                    <!-- normal collapsable navbar markup -->
                    <div class="container-fluid" id="bodySideBar">

                        <div style="padding-left: 23px">

                            <ul class="nav" id="sideBar">
                                <li style="margin-left: -25px;"><a href="{{ url('/') }}" style="white-space: nowrap; font-size: 16px;"><img src="{{ url('image/bar-chart.png') }}" width="40" height="40">Почетна</a></li>
                                <li style="margin-left: -25px;"><a href="{{ url('/allemployee') }}" style="white-space: nowrap; font-size: 16px;"><img src="{{ url('image/employee2.png') }}" width="40" height="40"> Вработени</a></li>
                                <li style="margin-left: -25px;"><a href="{{ url('/getCases') }}" style="white-space: nowrap; font-size: 16px;"><img src="{{ url('image/briefcase.png') }}" width="40" height="40"> Предмети</a></li>
                                @if(Auth::user()->is_admin() || Auth::user()->is_lawyer())
                                    <li style="margin-left: -25px;"><a href="{{ url('/hearings') }}" style="font-size: 16px;"><img src="{{ url('image/Iconleak-Or-Justice-balance.ico') }}" width="40" height="40" align="left"><div>&nbsp Закажи<br/> &nbsp рочиште</div></a></li>
                                @endif
                                <li style="margin-left: -25px;"><a href="{{ url('/moiDok') }}" style="white-space: nowrap; font-size: 16px;"><img src="{{ url('image/folder-add-icon.png') }}" width="40" height="40">Документи</a></li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>

            <div class="col-xs-8 col-sm-9 col-md-10 col-lg-10">
                <!-- your page content -->
                        <span class="container" id="bodyText">
                            <div class="row">
                                @if (Session::has('message'))
                                    <div class="flash alert-info">
                                        <p class="panel-body">
                                            {{ Session::get('message') }}
                                        </p>
                                    </div>
                                @endif

                                @yield('content')
                                @include('features/search')

                            </div>
                        </span>
            </div>
        </div>
    </div>
    @else
            <!-- your page content -->
    <div class="container" id="bodyText2">
        <div class="row">
            @if (Session::has('message'))
                <div class="flash alert-info">
                    <p class="panel-body">
                        {{ Session::get('message') }}
                    </p>
                </div>
            @endif

            @yield('content')

        </div>
    </div>

@endif

<div>
    <footer>
        <p class="copyright">&copy; Copyright 2016, Lenche Petkovska</p>
    </footer>
</div>

</body>
</html>
