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
    <link rel="stylesheet" type="text/css" href="/css/component.css">

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
                <li>Tetap<i class="caret" style="margin-left: 20px;"></i></li>
                <div>
                    <a href="{{ url('/admin/home') }}"><li class="nav-link">Karyawan</li></a>
                    <a href="{{ url('/admin/payroll') }}"><li class="nav-link">Payroll</li></a>
                    <a href="{{ url('/admin/sendEmail') }}"><li class="nav-link">Send E-Slip</li></a>
                </div>

                <li style="margin-top: 30px;">Kontrak<span class="caret" style="margin-left: 20px;"></span></li>
                <div>
                    <a href="{{ url('/user/home') }}"><li>Karyawan</li></a>
                    <a href="{{ url('/user/payroll') }}"><li>Payroll</li></a>
                    <a href="{{ url('/user/sendEmail') }}"><li>Send E-Slip</li></a>
                </div>

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
    <script>
    (function() {
        var menuEl = document.getElementById('ml-menu'),
            mlmenu = new MLMenu(menuEl, {
                // breadcrumbsCtrl : true, // show breadcrumbs
                // initialBreadcrumb : 'all', // initial breadcrumb text
                backCtrl : false, // show back button
                // itemsDelayInterval : 60, // delay between each menu item sliding animation
                onItemClick: loadDummyData // callback: item that doesn´t have a submenu gets clicked - onItemClick([event], [inner HTML of the clicked item])
            });

        // mobile menu toggle
        var openMenuCtrl = document.querySelector('.action--open'),
            closeMenuCtrl = document.querySelector('.action--close');

        openMenuCtrl.addEventListener('click', openMenu);
        closeMenuCtrl.addEventListener('click', closeMenu);

        function openMenu() {
            classie.add(menuEl, 'menu--open');
            closeMenuCtrl.focus();
        }

        function closeMenu() {
            classie.remove(menuEl, 'menu--open');
            openMenuCtrl.focus();
        }

        // simulate grid content loading
        var gridWrapper = document.querySelector('.content');

        function loadDummyData(ev, itemName) {
            ev.preventDefault();

            closeMenu();
            gridWrapper.innerHTML = '';
            classie.add(gridWrapper, 'content--loading');
            setTimeout(function() {
                classie.remove(gridWrapper, 'content--loading');
                gridWrapper.innerHTML = '<ul class="products">' + dummyData[itemName] + '<ul>';
            }, 700);
        }
    })();
    </script>
    <!-- end navbar default beserta script end -->
</body>
</html>
