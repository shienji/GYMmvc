<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Home Master')</title>


    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/ionicons.min.css') }}">
    @yield('stylesheet1')
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    @yield('stylesheet2')
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">


        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="{{ route("home_master") }}" class="brand-link">
                <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">GYMmvc</span>
            </a>


            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                            alt="User Image">
                    </div>
                    <div class="info">
                        <a href="{{ route("home_master") }}" class="d-block">Theodore Kindly Suprayogi</a>
                    </div>
                </div>


                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        {{-- MENU --}}
                        <li class="nav-item menu-open">
                            <a href="#" class="nav-link side-trans">
                                <i class="nav-icon fas fa-money-check"></i>
                                <p>
                                    Master
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route("role_master") }}" class="nav-link side-trans-vdashboard">
                                        <i class="far fa-circle nav-icon  text-danger"></i>
                                        <p>Master Role</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route("fasilitas_master") }}" class="nav-link side-trans-vregister">
                                        <i class="far fa-circle nav-icon  text-warning"></i>
                                        <p>Master Fasilitas</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route("peralatan_master") }}" class="nav-link side-trans-vrenewal">
                                        <i class="far fa-circle nav-icon  text-success"></i>
                                        <p>Master Peralatan</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route("pelatih_master") }}" class="nav-link">
                                        <i class="far fa-circle nav-icon text-info"></i>
                                        <p>Master Pelatih</p>
                                    </a>
                                </li>
                            </ul>
                        </li>


                    </ul>
                </nav>
            </div>
        </aside>

        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">

                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">

                            </ol>
                        </div>
                    </div>
                </div>
            </div>


            <div class="content">
                <div class="container-fluid">
                    @yield('konten')
                </div>
            </div>
        </div>

        <aside class="control-sidebar control-sidebar-dark">
        </aside>

        <footer class="main-footer">
            <strong>Copyright &copy; 2023 @php
                if (date('Y') > 2023) {
                    echo '- ' . date('Y');
                }
            @endphp <a href="https://adminlte.io">GYMmvc</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 1.1.0
            </div>
        </footer>
    </div>

    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    @yield('script1')
    <script src="{{ asset('dist/js/adminlte.js') }}"></script>
    @yield('script2')
</body>

</html>
