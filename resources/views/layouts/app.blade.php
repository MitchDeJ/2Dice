<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>2Dice - BETA 1.0</title>
    <!-- Force scrollbar -->
    <style> html {
            overflow: -moz-scrollbars-vertical;
            overflow-y: scroll;
        }</style>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href={{ asset("img/favicon.png")}}/>
    <!-- Custom stylesheet -->
    {{ Html::style('css/stylesheet.css') }}
    <!-- Bootstrap core CSS-->
    {{ Html::style("vendor/bootstrap/css/bootstrap.min.css" ) }}
    <!-- Custom fonts for this template-->
    {{ Html::style("vendor/font-awesome/css/font-awesome.min.css" ) }}
    <!-- Custom styles for this template-->
    {{ Html::style("css/sb-admin.css") }}
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a href="{{ url('/dashboard') }}"><img src="{{asset("img/dicelogo.png")}}" alt="Dice logo" width="100px" height="40px"></a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
            data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
            aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">

            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
                <a class="nav-link" href="{{ url('/dashboard') }}">
                    <i class="fa fa-fw fa-dashboard"></i>
                    <span class="nav-link-text">Dashboard</span>
                </a>
            </li>

            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Leaderboard">
                <a class="nav-link" href="{{ url('/leaderboard/1') }}">
                    <i class="fa fa-fw fa-tasks"></i>
                    <span class="nav-link-text">Leaderboard</span>
                </a>
            </li>

            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Statistics">
                <a class="nav-link" href="{{ url('/statistics') }}">
                    <i class="fa fa-fw fa-area-chart"></i>
                    <span class="nav-link-text">Statistics</span>
                </a>
            </li>

            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Marketplace">
                <a class="nav-link" href="{{ url('/marketplace') }}">
                    <i class="fa fa-fw fa-university"></i>
                    <span class="nav-link-text">Marketplace</span>
                </a>
            </li>

            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Location">
                <a class="nav-link" href="{{ url('/location') }}">
                    <i class="fa fa-fw fa-plane"></i>
                    <span class="nav-link-text">Location</span>
                </a>
            </li>

            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Shop">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseShop"
                   data-parent="#exampleAccordion">
                    <i class="fa fa-fw fa-shopping-bag"></i>
                    <span class="nav-link-text">Shop</span>
                </a>
                <ul class="sidenav-second-level collapse" id="collapseShop">
                    <li>
                        <a href="#">Money shop</a>
                    </li>
                    <li>
                        <a href="#">Prestige shop</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Business">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseBusiness"
                   data-parent="#exampleAccordion">
                    <i class="fa fa-fw fa-suitcase"></i>
                    <span class="nav-link-text">Business</span>
                </a>
                <ul class="sidenav-second-level collapse" id="collapseBusiness">
                    <li>
                        <a href="#">Stockmarket</a>
                    </li>
                    <li>
                        <a href="#">Business collaboration</a>
                    </li>
                    <li>
                        <a href="#">Business jobs</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Betting">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseBetting"
                   data-parent="#exampleAccordion">
                    <i class="fa fa-fw fa-dollar"></i>
                    <span class="nav-link-text">Betting</span>
                </a>
                <ul class="sidenav-second-level collapse" id="collapseBetting">
                    <li>
                        <a href="#">Coinflip</a>
                    </li>
                    <li>
                        <a href="#">Blackjack</a>
                    </li>
                    <li>
                        <a href="#">Roulette</a>
                    </li>
                    <li>
                        <a href="#">Lottery</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Company">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseCompany"
                   data-parent="#exampleAccordion">
                    <i class="fa fa-fw fa-building"></i>
                    <span class="nav-link-text">Company</span>
                </a>
                <ul class="sidenav-second-level collapse" id="collapseCompany">
                    <li>
                        <a href="#">Company profile</a>
                    </li>
                </ul>
            </li>

        </ul>
        <ul class="navbar-nav sidenav-toggler">
            <li class="nav-item">
                <a class="nav-link text-center" id="sidenavToggler">
                    <i class="fa fa-fw fa-angle-left"></i>
                </a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle mr-lg-2" id="messagesDropdown" href="#" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-fw fa-envelope"></i>
                    <span class="d-lg-none">Messages
              <span class="badge badge-pill badge-primary">12 New</span>
            </span>
                    <span class="indicator text-primary d-none d-lg-block">
              <i style="color: #f39c12;" class="fa fa-fw fa-circle"></i>
            </span>
                </a>
                <div class="dropdown-menu" aria-labelledby="messagesDropdown">
                    <h6 class="dropdown-header">New Messages:</h6>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">
                        <strong>David Miller</strong>
                        <span class="small float-right text-muted">11:21 AM</span>
                        <div class="dropdown-message small">Hey there! This new version of SB Admin is pretty awesome!
                            These messages clip off when they reach the end of the box so they don't overflow over to
                            the sides!
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">
                        <strong>Jane Smith</strong>
                        <span class="small float-right text-muted">11:21 AM</span>
                        <div class="dropdown-message small">I was wondering if you could meet for an appointment at 3:00
                            instead of 4:00. Thanks!
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">
                        <strong>John Doe</strong>
                        <span class="small float-right text-muted">11:21 AM</span>
                        <div class="dropdown-message small">I've sent the final files over to you for review. When
                            you're able to sign off of them let me know and we can discuss distribution.
                        </div>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item small" href="{{ url('/inbox') }}">View all messages</a>
                </div>
            </li>

            <span style="display:inline-block; width: 50px;"></span>

            <li class="nav-item">
                <span class="navbar-text">Cash: ${{number_format(Auth::user()->cash)}}</span>
            </li>

            <span style="display:inline-block; width: 50px;"></span>

            <li class="nav-item">
                <a href="{{ url('/profile') }}" class="nav-link">{{Auth::user()->name}}</a>
            </li>

            <span style="display:inline-block; width: 50px;"></span>

            <li class="nav-item">
                <a href="{{ route('logout') }}" onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();" class="nav-link" data-toggle="modal"
                   data-target="#exampleModal">
                    <i class="fa fa-fw fa-sign-out"></i>Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </li>
        </ul>
    </div>
</nav>
<div class="content-wrapper">
    @yield('content')
</div>
<!-- Bootstrap core JavaScript-->
{{ Html::script("vendor/jquery/jquery.min.js") }}

{{ Html::script("vendor/bootstrap/js/bootstrap.bundle.min.js") }}
<!-- Core plugin JavaScript-->
{{ Html::script("vendor/jquery-easing/jquery.easing.min.js") }}
<!-- Custom scripts for all pages-->
{{ Html::script("js/sb-admin.min.js") }}
</body>
</html>

