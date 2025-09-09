<!DOCTYPE html>
<!--
   This is a starter template page. Use this page to start your new project from
   scratch. This page gets rid of all links and provides the needed markup only.
   -->
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('favicon/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('favicon/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('favicon/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('favicon/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('favicon/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('favicon/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('favicon/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('favicon/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('favicon/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('favicon/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('favicon/manifest.json') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('favicon/ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#ffffff">

    <title>@lang('app.projectAdminPanel') | {{ $pageTitle }}</title>
    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel='stylesheet prefetch'
          href='https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/0.8.2/css/flag-icon.min.css'>
    <link rel='stylesheet prefetch'
          href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.2/css/bootstrap-select.min.css'>

    <!-- This is Sidebar menu CSS -->
    <link href="{{ asset('plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css') }}" rel="stylesheet">

    <link href="{{ asset('plugins/bower_components/toast-master/css/jquery.toast.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/bower_components/sweetalert/sweetalert.css') }}" rel="stylesheet">

    <!-- This is a Animation CSS -->
    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">

    @stack('head-script')

            <!-- This is a Custom CSS -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <!-- color CSS you can use different color css from css/colors folder -->
    <!-- We have chosen the skin-blue (default.css) for this starter
       page. However, you can choose any other skin from folder css / colors .
       -->
    <link href="{{ asset('css/colors/blue-dark.css') }}" id="theme" rel="stylesheet">
    <link href="{{ asset('plugins/froiden-helper/helper.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    {{--Custom theme styles--}}
    <style>
        .navbar-header {
            background: {{ $projectAdminTheme->header_color }};
        }
        .navbar-top-links > li > a {
            color: {{ $projectAdminTheme->link_color }};
        }
        /*Right panel*/
        .right-sidebar .rpanel-title {
            background: {{ $projectAdminTheme->header_color }};
        }
        /*Bread Crumb*/
        .bg-title .breadcrumb .active {
            color: {{ $projectAdminTheme->header_color }};
        }
        /*Sidebar*/
        .sidebar {
            background: {{ $projectAdminTheme->sidebar_color }};
            box-shadow: 1px 0px 20px rgba(0, 0, 0, 0.08);
        }
        .sidebar .label-custom {
            background: {{ $projectAdminTheme->header_color }};
        }
        #side-menu li a {
            color: {{ $projectAdminTheme->sidebar_text_color }};
        }
        #side-menu li a {
            color: {{ $projectAdminTheme->sidebar_text_color }};
            border-left: 0px solid {{ $projectAdminTheme->sidebar_color }};
        }
        #side-menu > li > a:hover,
        #side-menu > li > a:focus {
            background: rgba(0, 0, 0, 0.07);
        }
        #side-menu > li > a.active {
            border-left: 3px solid {{ $projectAdminTheme->header_color }};
            color: {{ $projectAdminTheme->link_color }};
        }
        #side-menu > li > a.active i {
            color: {{ $projectAdminTheme->link_color }};
        }
        #side-menu ul > li > a:hover {
            color: {{ $projectAdminTheme->link_color }};
        }
        #side-menu ul > li > a.active {
            color: {{ $projectAdminTheme->link_color }};
        }
        .sidebar #side-menu .user-pro .nav-second-level a:hover {
            color: {{ $projectAdminTheme->header_color }};
        }
        .nav-small-cap {
            color: {{ $projectAdminTheme->sidebar_text_color }};
        }
        .content-wrapper .sidebar .nav-second-level li {
            background: #444859;
        }
        @media (min-width: 768px) {
            .content-wrapper #side-menu ul,
            .content-wrapper .sidebar #side-menu > li:hover,
            .content-wrapper .sidebar .nav-second-level > li > a {
                background: #444859;
            }
        }

        /*themecolor*/
        .bg-theme {
            background-color: {{ $projectAdminTheme->header_color }} !important;
        }
        .bg-theme-dark {
            background-color: {{ $projectAdminTheme->sidebar_color }} !important;
        }
        /*Chat widget*/
        .chat-list .odd .chat-text {
            background: {{ $projectAdminTheme->header_color }};
        }
        /*Button*/
        .btn-custom {
            background: {{ $projectAdminTheme->header_color }};
            border: 1px solid {{ $projectAdminTheme->header_color }};
            color: {{ $projectAdminTheme->link_color }};
        }
        .btn-custom:hover {
            background: {{ $projectAdminTheme->header_color }};
            border: 1px solid {{ $projectAdminTheme->header_color }};
        }
        /*Custom tab*/
        .customtab li.active a,
        .customtab li.active a:hover,
        .customtab li.active a:focus {
            border-bottom: 2px solid {{ $projectAdminTheme->header_color }};
            color: {{ $projectAdminTheme->header_color }};
        }
        .tabs-vertical li.active a,
        .tabs-vertical li.active a:hover,
        .tabs-vertical li.active a:focus {
            background: {{ $projectAdminTheme->header_color }};
            border-right: 2px solid {{ $projectAdminTheme->header_color }};
        }
        /*Nav-pills*/
        .nav-pills > li.active > a,
        .nav-pills > li.active > a:focus,
        .nav-pills > li.active > a:hover {
            background: {{ $projectAdminTheme->header_color }};
            color: {{ $projectAdminTheme->link_color }};
        }

        .project-admin-panel-name{
            background: {{ $projectAdminTheme->header_color }};
        }

    </style>

</head>
<body class="fix-sidebar">
<!-- Preloader -->
<div class="preloader">
    <div class="cssload-speeding-wheel"></div>
</div>
<div id="wrapper">
    <!-- Top Navigation -->
    <nav class="navbar navbar-default navbar-static-top m-b-0">
        <div class="navbar-header">
            <!-- Toggle icon for mobile view -->
            <a class="navbar-toggle hidden-sm hidden-md hidden-lg " href="javascript:void(0)" data-toggle="collapse"
               data-target=".navbar-collapse"><i class="ti-menu"></i></a>

            <div class="top-left-part">
                <!-- Logo -->
                <a class="logo hidden-xs hidden-sm" href="{{ route('project-admin.dashboard') }}">
                    <!-- Logo icon image, you can use font-icon also -->
                        @if(is_null($global->logo))
                                <!--This is dark logo icon-->
                        <img src="{{ asset('worksuite-project-admin-logo.svg') }}" alt="home" class="dark-logo project-admin-logo"/>
                        @else
                            <img src="{{ asset('storage/app-logo/'.$global->logo) }}" alt="home" class="dark-logo"/>
                        @endif
                </a>

                <div class="project-admin-panel-name hidden-xs">@lang('app.projectAdminPanel')</div>
            </div>
            <!-- /Logo -->
            <!-- Search input and Toggle icon -->
            <ul class="nav navbar-top-links navbar-left hidden-xs">
                <li><a href="javascript:void(0)" class="open-close hidden-xs waves-effect waves-light"><i
                                class="icon-arrow-left-circle ti-menu"></i></a></li>

                <li>
                    <a href="{{ route('member.dashboard') }}">
                        @lang('app.loginAsEmployee') <i class="ti-arrow-right"></i>
                    </a>

                </li>
            </ul>
            <!-- This is the message dropdown -->
            <ul class="nav navbar-top-links navbar-right pull-right">

                <!-- .Task dropdown -->
                <li class="dropdown" id="top-notification-dropdown">
                    <a class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" href="#">
                        <i class="icon-bell"></i>
                        @if(count($user->unreadNotifications) > 0)
                            <div class="notify"><span class="heartbit"></span><span class="point"></span></div>
                        @endif
                    </a>
                    <ul class="dropdown-menu mailbox animated slideInDown">
                        <li>
                            <div class="drop-title">You have <span
                                        id="top-notification-count">{{ count($user->unreadNotifications) }}</span> new
                                notifications
                            </div>
                        </li>
                        @foreach ($user->unreadNotifications as $notification)
                            @include('notifications.member.'.snake_case(class_basename($notification->type)))
                        @endforeach

                        @if(count($user->unreadNotifications) > 0)
                            <li>
                                <a class="text-center" id="mark-notification-read"
                                   href="javascript:;"> @lang('app.markRead') <i class="fa fa-check"></i> </a>
                            </li>
                        @endif
                    </ul>
                </li>
                <!-- /.Task dropdown -->
                </li>
                <!-- /.dropdown -->


                <li class="dropdown">
                    <a href="{{ route('logout') }}" title="Logout" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"
                    ><i class="fa fa-power-off"></i> Logout
                    </a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-header -->
        <!-- /.navbar-top-links -->
        <!-- /.navbar-static-side -->
    </nav>
    <!-- End Top Navigation -->
    <!-- Left navbar-header -->
    @include('sections.project_admin_left_sidebar')
            <!-- Left navbar-header end -->
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            @yield('page-title')

                    <!-- .row -->
            @yield('content')

        </div>
        <!-- /.container-fluid -->
        <footer class="footer text-center"> {{ \Carbon\Carbon::now()->year }} &copy; {{ $companyName }} </footer>
    </div>
    <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->

{{--Timer Modal--}}
<div class="modal fade bs-modal-md in" id="projectTimerModal" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-md" id="modal-data-application">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <span class="caption-subject font-red-sunglo bold uppercase" id="modelHeading"></span>
            </div>
            <div class="modal-body">
                Loading...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn default" data-dismiss="modal">Close</button>
                <button type="button" class="btn blue">Save changes</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
{{--Timer Modal Ends--}}


<!-- jQuery -->
<script src="{{ asset('plugins/bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap Core JavaScript -->
<script src="{{ asset('bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.2/js/bootstrap-select.min.js'></script>

<!-- Sidebar menu plugin JavaScript -->
<script src="{{ asset('plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js') }}"></script>
<!--Slimscroll JavaScript For custom scroll-->
<script src="{{ asset('js/jquery.slimscroll.js') }}"></script>
<!--Wave Effects -->
<script src="{{ asset('js/waves.js') }}"></script>
<!-- Custom Theme JavaScript -->
<script src="{{ asset('plugins/bower_components/sweetalert/sweetalert.min.js') }}"></script>
<script src="{{ asset('js/custom.min.js') }}"></script>
<script src="{{ asset('js/jasny-bootstrap.js') }}"></script>
<script src="{{ asset('plugins/froiden-helper/helper.js') }}"></script>
<script src="{{ asset('plugins/bower_components/toast-master/js/jquery.toast.js') }}"></script>

<script>
    $('#mark-notification-read').click(function () {
        var token = '{{ csrf_token() }}';
        $.easyAjax({
            type: 'POST',
            url: '{{ route("mark-notification-read") }}',
            data: {'_token': token},
            success: function (data) {
                if (data.status == 'success') {
                    $('.top-notifications').remove();
                    $('#top-notification-count').html('0');
                    $('#top-notification-dropdown .notify').remove();
                }
            }
        });

    });

    $('.show-all-notifications').click(function () {
        var url = '{{ route('show-all-member-notifications')}}';
        $('#modelHeading').html('View Unread Notifications');
        $.ajaxModal('#projectTimerModal', url);
    });


    $(function () {
        $('.selectpicker').selectpicker();
    });


</script>
@stack('footer-script')

</body>
</html>