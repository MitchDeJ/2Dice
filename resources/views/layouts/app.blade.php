<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="2Dice,Timetodice,Dice,Gamble,Fun,Free-to-play,Business">
    <meta name="description" content="2Dice is a free-to-play gamble website. We offer a fun way of gambling without losing real money.">
    <meta name="author" content="Mitchell de Jonge, Ruben Catshoek">
    <title>2Dice - V1.0</title>
    <!-- Force scrollbar -->
    <style> html {
            overflow: -moz-scrollbars-vertical;
            overflow-y: scroll;
        }</style>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}">
    <!-- Custom stylesheet -->
{{ Html::style('css/stylesheet.css') }}
<!-- Bootstrap core CSS-->
{{ Html::style("vendor/bootstrap/css/bootstrap.min.css" ) }}
<!-- Custom fonts for this template-->
{{ Html::style("vendor/font-awesome/css/font-awesome.min.css" ) }}
<!-- Custom styles for this template-->
{{ Html::style("css/sb-admin.css") }}
<!-- jQuery-->
    {{ Html::script("js/jquery-3.2.1.min.js") }}
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a href="{{ url('/dashboard') }}"><img src="{{asset("img/dicelogo.png")}}" alt="Dice logo" width="100px"
                                           height="40px"></a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
            data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
            aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">

            <li class="nav-item test" data-toggle="tooltip" data-placement="right" title="Dashboard">
                <a class="nav-link" href="{{ url('/dashboard') }}">
                    <i class="fa fa-fw fa-dashboard"></i>
                    <span class="nav-link-text">Dashboard</span>
                </a>
            </li>

            <li class="nav-item nav-small" data-toggle="tooltip" data-placement="right" title="Leaderboard">
                <a class="nav-link" href="{{ url('/leaderboard/1') }}">
                    <i class="fa fa-fw fa-tasks"></i>
                    <span class="nav-link-text">Leaderboard</span>
                </a>
            </li>

            <li class="nav-item nav-small" data-toggle="tooltip" data-placement="right" title="Statistics">
                <a class="nav-link" href="{{ url('/statistics') }}">
                    <i class="fa fa-fw fa-area-chart"></i>
                    <span class="nav-link-text">Statistics</span>
                </a>
            </li>

            <li class="nav-item nav-small" data-toggle="tooltip" data-placement="right" title="Marketplace">
                <a class="nav-link" href="{{ url('/marketplace') }}">
                    <i class="fa fa-fw fa-university"></i>
                    <span class="nav-link-text">Marketplace</span>
                </a>
            </li>

            <li class="nav-item nav-small" data-toggle="tooltip" data-placement="right" title="Marketprices">
                <a class="nav-link" href="{{ url('/marketprices') }}">
                    <i class="fa fa-fw fa-university"></i>
                    <span class="nav-link-text">Prices</span>
                </a>
            </li>

            <li class="nav-item nav-small" data-toggle="tooltip" data-placement="right" title="Location">
                <a class="nav-link" href="{{ url('/location') }}">
                    <i class="fa fa-fw fa-plane"></i>
                    <span class="nav-link-text">Location</span>
                </a>
            </li>

            <li class="nav-item nav-small" data-toggle="tooltip" data-placement="right" title="Objectoverview">
                <a class="nav-link" href="{{ url('/objectoverview') }}">
                    <i class="fa fa-fw fa-globe"></i>
                    <span class="nav-link-text">Objects</span>
                </a>
            </li>

            <li class="nav-item nav-small" data-toggle="tooltip" data-placement="right" title="Location">
                <a class="nav-link" href="{{ url('/vip') }}">
                    <i class="fa fa-fw fa-diamond"></i>
                    <span class="nav-link-text">VIP</span>
                </a>
            </li>

            <li class="nav-item nav-small" data-toggle="tooltip" data-placement="right" title="Shop">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseShop"
                   data-parent="#exampleAccordion">
                    <i class="fa fa-fw fa-shopping-bag"></i>
                    <span class="nav-link-text">Shop</span>
                </a>
                <ul class="sidenav-second-level collapse" id="collapseShop">
                    <li>
                        <a href="{{ url('/general') }}">General store</a>
                    </li>
                    <li>
                        <a href="{{ url('/prestige') }}">Prestige shop</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item nav-small" data-toggle="tooltip" data-placement="right" title="Betting">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseBetting"
                   data-parent="#exampleAccordion">
                    <i class="fa fa-fw fa-dollar"></i>
                    <span class="nav-link-text">Betting</span>
                </a>
                <ul class="sidenav-second-level collapse" id="collapseBetting">
                    <li>
                        <a href="{{ url('/55x2') }}">55x2</a>
                    </li>
                    <li>
                        <a href="{{ url('/coinflip') }}">Coinflip</a>
                    </li>
                    <li>
                        <a href="{{ url('/blackjack') }}">Blackjack</a>
                    </li>
                    <li>
                        <a href="{{ url('/roulette') }}">Roulette</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item nav-small" data-toggle="tooltip" data-placement="right" title="Business">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseBusiness"
                   data-parent="#exampleAccordion">
                    <i class="fa fa-fw fa-suitcase"></i>
                    <span class="nav-link-text">Business</span>
                </a>
                <ul class="sidenav-second-level collapse" id="collapseBusiness">
                    <li>
                        <a href="{{ url('/sendcash') }}">Send cash</a>
                    </li>
                    <li>
                        <a href="{{ url('/stockmarket') }}">Stock market</a>
                    </li>
                    <li>
                        <a href="{{ url('/collab') }}">Collaboration</a>
                    </li>
                    <li>
                        <a href="{{ url('/jobs') }}">Jobs</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item nav-small" data-toggle="tooltip" data-placement="right" title="Company">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseCompany"
                   data-parent="#exampleAccordion">
                    <i class="fa fa-fw fa-building"></i>
                    <span class="nav-link-text">Company</span>
                </a>
                <ul class="sidenav-second-level collapse" id="collapseCompany">
                    @if (ComAff::getAffiliation(Auth::user()) != -1)
                        <li>
                            <a href="{{ url('/companyprofile') }}">Profile</a>
                        </li>
                        <li>
                            <a href="{{ url('/companydashboard') }}">Dashboard</a>
                        </li>
                    @else
                        <li>
                            <a href="{{ url('/companycreate') }}">Create company</a>
                        </li>
                    @endif
                    <li>
                        <a href="{{ url('/companyleaderboard/1') }}">Leaderboard</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item nav-small" data-toggle="tooltip" data-placement="right" title="2Dice">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapse2Dice"
                   data-parent="#exampleAccordion">
                    <i class="fa fa-fw fa-comments"></i>
                    <span class="nav-link-text">2Dice</span>
                </a>
                <ul class="sidenav-second-level collapse" id="collapse2Dice">
                    <li>
                        <a href="{{ url('/gameinformation') }}">Game information</a>
                    </li>
                    <li>
                        <a href="https://discord.gg/kxWhCRY" target="_blank">Discord</a>
                    </li>
                    @if(Auth::user()->name == "admin")
                        <li>
                            <a href="{{ url('/adminpanel') }}">Admin Panel</a>
                        </li>
                    @endif
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
            <li class="nav-item nav-small">
                @if ( MessageNotifier::getUnread() > 0)
                    <a href="{{ url('/inbox') }}" class="nav-link"><i
                                class="fa fa-fw fa-envelope i_button_background"></i></a>
                @else
                    <a href="{{ url('/inbox') }}" class="nav-link"><i class="fa fa-fw fa-envelope"></i></a>
                @endif
            </li>

            <span style="display:inline-block; width: 50px;"></span>

            <li class="nav-item nav-small">
                <span class="navbar-text">${{number_format(Auth::user()->cash)}}</span>
            </li>

            <span style="display:inline-block; width: 50px;"></span>

            <li class="nav-item nav-small">
                <a href="{{ url('/profile') }}" class="nav-link"><strong
                            style="color:{{Titles::getTitleColor(Auth::user()->title)}}">
                        {{Titles::getTitle(Auth::user()->title)}}</strong>{{ Auth::user()->name }}</a>
            </li>

            <span style="display:inline-block; width: 50px;"></span>

            <li class="nav-item nav-small">
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
    <div class="container-fluid">
        @include('layouts.appmessage')
    </div>
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

