<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="/template-admin/production/images/favicon.ico" type="image/ico" />

    <title>@yield('title', 'Dashboard')</title>

    <!-- Bootstrap -->
    <link href="/template-admin/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="/template-admin/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="/template-admin/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="/template-admin/vendors/iCheck/skins/flat/green.css" rel="stylesheet">

    <!-- bootstrap-progressbar -->
    <link href="/template-admin/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="/template-admin/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet" />
    <!-- bootstrap-daterangepicker -->
    <link href="/template-admin/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="/template-admin/build/css/custom.min.css" rel="stylesheet">
</head>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                        <a href="" class="site_title"></i> <span>Absensi</span></a>
                    </div>

                    <div class="clearfix"></div>



                    <br />

                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                        <div class="menu_section">
                            <h3>General</h3>
                            <ul class="nav side-menu">
                                {{-- <li>
                                    <a href="/guru/dashboard">
                                        <i class="fa fa-home"></i> Dashboard
                                    </a>
                                </li> --}}
                                <li>
                                    <a href="/guru/data-absensi">
                                        <i class="fa fa-calendar-check-o"></i> Absensi
                                    </a>
                                </li>
                                <li>
                                    <a href="/guru/rekap-absensi">
                                        <i class="fa fa-list-alt"></i> Rekap Absensi
                                    </a>
                                </li>
                                <li>
                                    <a href="/guru/profil">
                                        <i class="fa fa-user"></i> Profil
                                    </a>
                                </li>
                                <li>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>

                                    <a href="#"
                                        onclick="event.preventDefault(); if(confirm('Apakah Anda yakin ingin logout?')) { document.getElementById('logout-form').submit(); }">
                                        <i class="fa fa-sign-out"></i> Logout
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </div>
                    <!-- /sidebar menu -->

                    <!-- /menu footer buttons -->
                    <div class="sidebar-footer hidden-small">
                        <a data-toggle="tooltip" data-placement="top" title="Settings">
                            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                            <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Lock">
                            <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Logout" href="login.html">
                            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                        </a>
                    </div>
                    <!-- /menu footer buttons -->
                </div>
            </div>

            <!-- top navigation -->
            <div class="top_nav">
                <div class="nav_menu">
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>

                </div>
            </div>
            <!-- /top navigation -->

            {{-- Main Content --}}
            <div class="right_col" role="main">
                @yield('content')
            </div>
            <!-- /page content -->

            <!-- footer content -->
            <footer>
                <div class="pull-right">
                    Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
                </div>
                <div class="clearfix"></div>
            </footer>
            <!-- /footer content -->
        </div>
    </div>

    <!-- jQuery -->
    <script src="/template-admin/vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="/template-admin/vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FastClick -->
    <script src="/template-admin/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="/template-admin/vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
    <script src="/template-admin/vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="/template-admin/vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="/template-admin/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
    <script src="/template-admin/vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
    <script src="/template-admin/vendors/skycons/skycons.js"></script>
    <!-- Flot -->
    <script src="/template-admin/vendors/Flot/jquery.flot.js"></script>
    <script src="/template-admin/vendors/Flot/jquery.flot.pie.js"></script>
    <script src="/template-admin/vendors/Flot/jquery.flot.time.js"></script>
    <script src="/template-admin/vendors/Flot/jquery.flot.stack.js"></script>
    <script src="/template-admin/vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="/template-admin/vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="/template-admin/vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="/template-admin/vendors/flot.curvedlines/curvedLines.js"></script>
    <!-- DateJS -->
    <script src="/template-admin/vendors/DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="/template-admin/vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="/template-admin/vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>
    <script src="/template-admin/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="/template-admin/vendors/moment/min/moment.min.js"></script>
    <script src="/template-admin/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>

    <!-- Custom Theme Scripts -->
    <script src="/template-admin/build/js/custom.min.js"></script>

</body>

</html>
