<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Roboto Admin Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- App favicon -->
    <link rel="shortcut icon" href="/assets/images/favicon.ico">

    <!-- App css-->
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/icons.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/metismenu.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/style.css" rel="stylesheet" type="text/css" />

</head>

<body>

    <!-- Top Bar Start -->
    <div class="topbar">
        <!-- Navbar -->
        <nav class="navbar-custom">

            <!-- LOGO -->
            <div class="topbar-left">
                <a href="index.html" class="logo">
                    <span>
                        <img src="/assets/images/logo-sm.png" alt="logo-small" class="logo-sm">
                    </span>
                    <span>
                        <img src="/assets/images/logo-dark.png" alt="logo-large" class="logo-lg">
                    </span>
                </a>
            </div>

            <ul class="list-unstyled topbar-nav float-right mb-0">

                <li class="dropdown">
                    <a class="nav-link dropdown-toggle arrow-none waves-light waves-effect" data-toggle="dropdown"
                        href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <i class="mdi mdi-bell-outline nav-icon"></i>
                        <span class="badge badge-danger badge-pill noti-icon-badge">2</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-lg">
                        <!-- item-->
                        <h6 class="dropdown-item-text">
                            Notifications (258)
                        </h6>
                        <div class="slimscroll notification-list">
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item active">
                                <div class="notify-icon bg-success"><i class="mdi mdi-cart-outline"></i></div>
                                <p class="notify-details">Your order is placed<small class="text-muted">Dummy text of
                                        the printing and typesetting industry.</small></p>
                            </a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <div class="notify-icon bg-warning"><i class="mdi mdi-message"></i></div>
                                <p class="notify-details">New Message received<small class="text-muted">You have 87
                                        unread messages</small></p>
                            </a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <div class="notify-icon bg-info"><i class="mdi mdi-glass-cocktail"></i></div>
                                <p class="notify-details">Your item is shipped<small class="text-muted">It is a long
                                        established fact that a reader will</small></p>
                            </a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <div class="notify-icon bg-primary"><i class="mdi mdi-cart-outline"></i></div>
                                <p class="notify-details">Your order is placed<small class="text-muted">Dummy text of
                                        the printing and typesetting industry.</small></p>
                            </a>
                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item notify-item">
                                <div class="notify-icon bg-danger"><i class="mdi mdi-message"></i></div>
                                <p class="notify-details">New Message received<small class="text-muted">You have 87
                                        unread messages</small></p>
                            </a>
                        </div>
                        <!-- All-->
                        <a href="javascript:void(0);" class="dropdown-item text-center text-primary">
                            View all <i class="fi-arrow-right"></i>
                        </a>
                    </div>
                </li>
                <li class="dropdown">
                    <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown"
                        href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <img src="@yield('userLogo')" alt="profile-user" class="rounded-circle" />
                        <span class="ml-1 nav-user-name hidden-sm"> <i class="mdi mdi-chevron-down"></i> </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="{{ route('AdminLogout', app()->getLocale()) }}"><i
                                class="dripicons-exit text-muted mr-2"></i>
                            Logout</a>
                    </div>
                </li>
            </ul>
            <ul class="list-unstyled topbar-nav mb-0">
                <li>
                    <button class="button-menu-mobile nav-link waves-effect waves-light">
                        <i class="mdi mdi-menu nav-icon"></i>
                    </button>
                </li>
                <li class="hide-phone app-search">
                    <form role="search" class="">
                        <input type="text" placeholder="Search..." class="form-control">
                        <a href=""><i class="fas fa-search"></i></a>
                    </form>
                </li>

            </ul>

        </nav>
        <!-- end navbar-->
    </div>
    <!-- Top Bar End -->
    <div class="page-wrapper-img">
        <div class="page-wrapper-img-inner">
            <div class="sidebar-user media">
                <img src="@yield('userLogo')" alt="user" class="rounded-circle img-thumbnail mb-1">
                <span class="online-icon"><i class="mdi mdi-record text-success"></i></span>
                <div class="media-body align-item-center">
                    <h5>@yield('Username')</h5>
                    <ul class="list-unstyled list-inline mb-0 mt-2">
                        <li class="list-inline-item">
                            <a href="{{ route('AdminLogout', app()->getLocale()) }}" class=""><i
                                    class="mdi mdi-power"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Page-Title -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-box">
                        <h4 class="page-title mb-2"><i class="mdi mdi-grid-large mr-2"></i>@yield('contentName')</h4>
                        <div class="">
                            <ol class="breadcrumb">
                                @yield('breadcrumb')
                                {{-- <li class="breadcrumb-item"><a href="javascript:void(0);">AdminPanel</a></li> --}}
                                {{-- <li class="breadcrumb-item active">Dashboards</li>   --}}
                            </ol>
                        </div>
                    </div>
                    <!--end page title box-->
                </div>
                <!--end col-->
            </div>
            <!--end row-->
            <!-- end page title end breadcrumb -->
        </div>
        <!--end page-wrapper-img-inner-->
    </div>
    <!--end page-wrapper-img-->

    <div class="page-wrapper">
        <div class="page-wrapper-inner">

            <!-- Left Sidenav -->
            <div class="left-sidenav">

                <ul class="metismenu left-sidenav-menu" id="side-nav">

                    <li class="menu-title">Main</li>

                    <li>
                        <a href="{{ route('Panel', app()->getLocale()) }}"><i
                                class="mdi mdi-monitor"></i><span>Dashboards</span></a>
                    </li>

                    <li>
                        <a href="{{ route('Category', app()->getLocale()) }}"><i
                                class="mdi mdi-format-list-bulleted-type"></i><span>Category</span></a>
                    </li>
                    <li>
                        <a href="{{ route('language', app()->getLocale()) }}"><i
                                class="mdi mdi-format-list-bulleted-type"></i><span>Language</span></a>
                    </li>
                    <li>
                        <a href="{{ route('MultiLanguage', app()->getLocale()) }}"><i
                                class="mdi mdi-format-list-bulleted-type"></i><span>Multi Language System</span></a>
                    </li>
                    <li>
                        <a href="{{ route('City', app()->getLocale()) }}"><i
                                class="mdi mdi-format-list-bulleted-type"></i><span>City</span></a>
                    </li>
                    <li>
                        <a href="{{ route('Educationlevel', app()->getLocale()) }}"><i
                                class="mdi mdi-format-list-bulleted-type"></i><span>Education Level</span></a>
                    </li>
                    <li>
                        <a href="{{ route('CompanyUser', app()->getLocale()) }}"><i
                                class="mdi mdi-format-list-bulleted-type"></i><span>Company User</span></a>
                    </li>
                    <li>
                        <a href="{{ route('User', app()->getLocale()) }}"><i
                                class="mdi mdi-format-list-bulleted-type"></i><span>Users</span></a>
                    </li>
                    <li>
                        <a href="{{ route('Vacancy', app()->getLocale()) }}"><i
                                class="mdi mdi-format-list-bulleted-type"></i><span>Vacancy</span></a>
                    </li>
                    <li>
                        <a href="{{ route('VacancyRequest', app()->getLocale()) }}"><i
                                class="mdi mdi-format-list-bulleted-type"></i><span>new Vacancy Request</span></a>
                    </li>
                    <li>
                        <a href="{{ route('SetPaymentData', app()->getLocale()) }}"><i
                                class="mdi mdi-format-list-bulleted-type"></i><span>Config</span></a>
                    </li>
                    <li>
                        <a href="{{ route('Blogs', app()->getLocale()) }}"><i
                                class="mdi mdi-format-list-bulleted-type"></i><span>Blogs</span></a>
                    </li>
                </ul>
            </div>
            <!-- end left-sidenav-->
            <!-- Page Content-->
            @yield('content')
            <!-- end page content -->
        </div>
        <!--end page-wrapper-inner -->
    </div>
    <!-- end page-wrapper -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <!-- jQuery  -->
    <script src="/assets/js/jquery.min.js"></script>
    <script src="/assets/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/metisMenu.min.js"></script>
    <script src="/assets/js/waves.min.js"></script>
    <script src="/assets/js/jquery.slimscroll.min.js"></script>

    <script src="/assets/plugins/tiny-editable/mindmup-editabletable.js"></script>
    <script src="/assets/plugins/tiny-editable/numeric-input-example.js"></script>
    {{-- <script src="/assets/plugins/tabledit/jquery.tabledit.js"></script> --}}
    {{-- <script src="/assets/pages/jquery.tabledit.init.js"></script> --}}

    <script src="/assets/js/app.js"></script>
</body>

</html>
