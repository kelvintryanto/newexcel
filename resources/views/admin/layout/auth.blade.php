<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel Multi Auth Guard') }}</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">

    <!-- tambahan stylesheet.css untuk sidebar -->
    <link rel="stylesheet" type="text/css" href="/css/style.css">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    <!-- end script -->
</head>
<body>
    <!-- start navbar default dom dari sini -->
    <nav class="navbar navbar-default navbar-static-top" style="margin-bottom: 0px;">
        
        <!-- tambahan sidebar KT -->
        <div id="sidebar">
            <a href="{{ url('/admin/home') }}"><div style="text-align: center;">
                <img src="../mkp-icon.png" style="padding: 10px 10px 0px 10px;">
                <br>
                <p style="font-size: 12px; border-bottom: 1px solid rgba(100,100,100,0.3); margin-bottom: 0px; color: rgba(230,230,230,0.9); padding: 10px">PT. Mandiri Konsultama Perkasa</p>
            </div></a>
            <ul>
                <a href="{{ url('/admin/home') }}"><li>Karyawan</li></a>
                <a href="{{ url('/admin/payroll') }}"><li>Payroll</li></a>
                <a href="{{ url('/admin/sendEmail') }}"><li>Send Email</li></a>
            </ul>

        </div>
        <!-- tambahan sidebar KT -->

        <!-- ada tambahan margin-left: 200px -->
        <div class="container" style="margin-right: 0px; margin-top: 0px; width: 100%;">

            <div class="navbar-header" style=" margin-left: 200px;">
                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <!-- <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel Multi Auth Guard') }}: Admin
                </a> -->
            </div>

            <!-- Admin LogOut -->
            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                    <li><a href="{{ url('/admin/login') }}">Login</a></li>
                    <li><a href="{{ url('/admin/register') }}">Register</a></li>
                    @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{ url('/admin/logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                Logout
                            </a>

                            <form id="logout-form" action="{{ url('/admin/logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form></li>
                        </ul>
                    </li>
                    @endif
                </ul>
            </div>
            <!-- end of Admin LogOut -->
        </div>
    </nav>

    <!-- tambahahkan div untuk body dan style margin-left: 200px untuk body -->
    <div style="margin-left: 200px;">
        @yield('content')
    </div>
    

    <!-- Scripts -->
    <script src="/js/app.js"></script>
    <script type="text/javascript" src="/js/main.js"></script>
    <!-- end navbar default beserta script end -->
</body>
</html>
