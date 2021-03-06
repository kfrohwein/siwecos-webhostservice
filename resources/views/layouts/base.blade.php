<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>CMS-Garden - {{ config('app.name', 'SIWECOS') }}</title>

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Fonts -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">


        <!-- Scripts -->
        <script>
            window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
        </script>
    </head>
    <body>
        <div class="full-height">
            <nav class="navbar navbar-default navbar-static-top">
                <div class="container">
                    <div class="navbar-header">

                        <!-- Collapsed Hamburger -->
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#base-navbar-collapse">
                            <span class="sr-only">Toggle Navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>

                        <!-- Branding Image -->
                        <a class="navbar-brand" href="{{ url('/') }}">
                            <img class="img-responsive" alt="{{ config('app.name', 'SIWECOS') }}" src="{{ asset('images/siwecos_logo.png') }}">
                        </a>
                    </div>

                    <div class="collapse navbar-collapse" id="base-navbar-collapse">
                        <!-- Left Side Of Navbar -->
                        <ul class="nav navbar-nav">
                            @if (!Auth::guest())
                                <li><a href="{{ url('/') }}">List Incidents</a></li>
                                @if (Auth::user()->isCMSSecurity() || Auth::user()->isCMSGarden())
                                    <li><a href="{{ url('/notification/create') }}">Create Pre-Notification Mail</a></li>
                                    <li><a href="{{ url('/bugreport/create') }}">Create Incident Mail</a></li>
                                @endif
                                <li><a href="{{ url('/invite') }}">Invite a Colleague</a></li>
                                @if (Auth::user()->isCMSGarden())
                                    <li><a href="{{ url('/users') }}">List of Users</a></li>
                                @endif
                            @endif
                        </ul>
                        <!-- Right Side Of Navbar -->
                        <ul class="nav navbar-nav navbar-right">
                            <!-- Authentication Links -->
                            @if (Auth::guest())
                                <li><a href="{{ route('login') }}">Login</a></li>
                            @else
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>

                                    <ul class="dropdown-menu" role="menu">
                                        <li>
                                            <a href="{{ url('/user/profile') }}">Profile</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('logout') }}"
                                                onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                                Logout
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                {{ csrf_field() }}
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="container content">
                @if(Session::has('message'))
                    <div class="alert alert-info alert-dismissable">
                        <h4><i class="glyphicon glyphicon-info-sign"></i> Message</h4>
                        <ul class="errors">
                            <li>{{ Session::get('message') }}</li>
                        </ul>
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
