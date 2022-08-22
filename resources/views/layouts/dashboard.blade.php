<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Responsive Admin Dashboard Template">
    <meta name="keywords" content="admin,dashboard">
    <meta name="author" content="stacks">
    <!-- The above 6 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    
    <!-- Title -->
    <title>{{ $title ?? 'CPNS Indonesia' }}</title>

    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet">
    <link href="{{ asset('dashboard/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dashboard/plugins/font-awesome/css/all.min.css') }}" rel="stylesheet">

    
    <!-- Theme Styles -->
    <link href="{{ asset('dashboard/css/connect.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dashboard/css/dark_theme.css') }}" rel="stylesheet">
    <link href="{{ asset('dashboard/css/custom.css') }}" rel="stylesheet">
    @stack('css')

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <div class='loader'>
        <div class='spinner-grow text-primary' role='status'>
            <span class='sr-only'>Loading...</span>
        </div>
    </div>
    <div class="connect-container align-content-stretch d-flex flex-wrap">
        <div class="page-sidebar">
            <div class="logo-box"><a href="#" class="logo-text">CPNS</a><a href="#" id="sidebar-close"><i class="material-icons">close</i></a> <a href="#" id="sidebar-state"><i class="material-icons">adjust</i><i class="material-icons compact-sidebar-icon">panorama_fish_eye</i></a></div>
            <div class="page-sidebar-inner slimscroll">
                <ul class="accordion-menu">
                    @include('menu.'.auth()->user()->level)
                </ul>
            </div>
        </div>
        <div class="page-container">
            <div class="page-header">
                <nav class="navbar navbar-expand">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <ul class="navbar-nav">
                        <li class="nav-item small-screens-sidebar-link">
                            <a href="#" class="nav-link"><i class="material-icons-outlined">menu</i></a>
                        </li>
                        <li class="nav-item nav-profile dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="{{ asset('dashboard/images/avatars/profile-image-1.png') }}" alt="profile image">
                                <span>{{ auth()->user()->name }}</span><i class="material-icons dropdown-icon">keyboard_arrow_down</i>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#" onclick="$('#form-logout').submit()">Log out</a>
                                <form method="post" action="{{ url('logout') }}" style="display: none;" id="form-logout">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                    <div class="collapse navbar-collapse" id="navbarNav"></div>
                    <div class="navbar-search">
                        <form></form>
                    </div>
                </nav>
            </div>
            <div class="page-content">
                <div class="page-info">
                    @include('includes.header')
                </div>
                <div class="main-wrapper">
                    @include('includes.notif')
                    @yield('content')
                </div>
            </div>
            <div class="page-footer">
                <div class="row">
                    <div class="col-md-12">
                        <span class="footer-text">{{ Date('Y') }} © CPNS Indonesia - Digital Agency Nusantara</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Javascripts -->
    <script src="{{ asset('dashboard/plugins/jquery/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/bootstrap/popper.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/apexcharts/dist/apexcharts.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/blockui/jquery.blockUI.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/flot/jquery.flot.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/flot/jquery.flot.time.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/flot/jquery.flot.symbol.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/flot/jquery.flot.resize.min.js') }}"></script>
    <script src="{{ asset('dashboard/plugins/flot/jquery.flot.tooltip.min.js') }}"></script>
    <script src="{{ asset('dashboard/js/connect.min.js') }}"></script>
    <script src="{{ asset('dashboard/js/pages/dashboard.js') }}"></script>
    @stack('js')
</body>
</html>