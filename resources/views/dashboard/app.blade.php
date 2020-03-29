<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>
        @yield('title')
    </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('dashboard/fontawesome/css/all.min.css')}}">
    
    {{-- Jquery Datatables --}}
    <link rel="stylesheet" href="{{asset('dashboard/datatables/css/complete.datatables.min.css')}}">

    <link rel="stylesheet" href="{{asset('dashboard/select2/css/select2.css')}}">

    <link rel="stylesheet" href="{{asset('dashboard/date_picker/DateTimePicker.min.css')}}">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('dashboard/dist/css/adminlte.min.css')}}">

    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{asset('dashboard/overlayScrollbars/css/OverlayScrollbars.min.css')}}">

    <link rel="stylesheet" href="{{asset('dashboard/css/custom.css')}}">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-dark bg-dark-blue pb-3">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>
            </ul>


            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <p>
                            <i class="fa fa-user-circle fa-2x"></i>
                            {{-- <img src="{{asset('uploads/'.Auth::User()->image)}}" alt="#" width="40px" height="40px" class="rounded-circle"> --}}
                            <span >
                                {{-- {{
                                    Auth::user()->name
                                }} --}}
                                Name
                            </span>
                            <i class="fa fa-chevron-circle-down"></i>
                        </p>
                    </a>
                    <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                        {{-- <span class="dropdown-item dropdown-header">Profile</span> --}}
                        <a href="{{url('profile')}}" class="dropdown-item text-dark">
                            <i class="fa fa-user-circle"> </i>
                            Profile
                        </a>
                        <div class="dropdown-divider"></div>
                        {{-- <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out-alt mr-2"></i> Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form> --}}
                    </div>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        {{-- sidebar-dark-primary --}}
        <aside class="main-sidebar sidebar-dark-primary bg-dark-blue elevation-4">
            <!-- Brand Logo -->
            <a href="{{url('portal/dashboard')}}" class="brand-link">
                <span class="brand-text font-weight-bold">
                    <i class="fa fa-dumbbell fa-2x"></i>
                    {{config('app.name')}}
                </span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar sidebar-bg-blue">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex justify-content-center">
                    <div class="image text-center">
                        <i class="fa fa-user-circle fa-6x text-blue"></i>
                        {{-- <img src="{{asset('uploads/'.Auth::user()->image)}}" alt="AdminLTE Logo" class="img-circle elevation-3" style="opacity: .8;width:100px"> --}}
                        <br>
                        <a href="#" class="d-block">
                            {{-- {{
                                Auth::user()->name
                            }} --}}
                            Name Here
                        </a>
                    </div>
                </div>
                

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon classwith font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <a href="{{url('portal/dashboard')}}" class="nav-link">
                                <i class="nav-icon fa fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-user-tie"></i>
                                <p>
                                    Products
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview ml-3">
                                <li class="nav-item">
                                    <a href="{{url('portal/user/create')}}" class="nav-link">
                                        <i class="fa fa-user-plus nav-icon"></i>
                                        <p>Add New Product</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        {{-- <li class="nav-header">EXAMPLES</li>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon far fa-envelope"></i>
                                <p>
                                    Mailbox
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="pages/mailbox/mailbox.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Inbox</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/mailbox/compose.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Compose</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="pages/mailbox/read-mail.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Read</p>
                                    </a>
                                </li>
                            </ul>
                        </li> --}}
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper pb-5">
            <!-- Main content -->   
            <section class="content pb-5">
                @yield('content')
                <!-- yield -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <span>
                &copy; {{now()->year}} SH Fitness | Developed by <a href="https://www.linkedin.com/in/afrasiyab-haider-8bab20135/" target="__blank" class="text-success">Afrasiyab Haider</a>
            </span>
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{asset('dashboard/jquery/jquery.min.js')}}"></script>

     {{-- @include('sweetalert::alert') --}}

    <script src="{{asset('dashboard/fontawesome/js/all.min.js')}}"></script>

    {{-- Jquery Data Tables --}}
    <script src="{{asset('dashboard/datatables/js/complete.datatables.min.js')}}"></script>

    <script src="{{asset('dashboard/select2/js/select2.min.js')}}"></script>

    <script src="{{asset('dashboard/date_picker/DateTimePicker.min.js')}}"></script>

    <script src="{{asset('dashboard/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('dashboard/dist/js/adminlte.js')}}"></script>
    <script src="{{asset('dashboard/js/imoViewer.js')}}"></script>
    
    <script src="{{asset('dashboard/js/scripts.js')}}"></script>
</body>

</html>
