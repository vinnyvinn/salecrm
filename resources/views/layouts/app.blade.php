<!DOCTYPE html>
<html lang="en">
    <head>
        <title>@yield('title', config('app.name'))</title>
        <!--[if lt IE 10]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="description" content="Dash Able bootstrap admin template suitable for any project backend need. It comes with lots of UI components, pages, plugins with easy to use well structured code." />
        <meta name="keywords" content="admin template, bootstrap admin template, bootstrap dashboard, admin theme, dashboard template, bootstrap dashboard template, bootstrap admin panel, dashboard theme, best admin template, dashboard theme, website templates, bootstrap 4 admin template">
        <meta name="author" content="Phoenixcoded" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <link rel="icon" href="http://html.phoenixcoded.net/dash-able/bootstrap/files/assets/images/favicon.ico" type="image/x-icon">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,600,700" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{ asset('dashable/bower_components/bootstrap/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('dashable/assets/pages/waves/css/waves.min.css') }}" type="text/css" media="all">
        <link rel="stylesheet" type="text/css" href="{{ asset('dashable/assets/icon/feather/css/feather.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('dashable/assets/css/font-awesome-n.min.css') }}">
        <link rel="stylesheet" href="{{ asset('dashable/assets/pages/chart/radial/css/radial.css') }}" type="text/css" media="all">
        <link rel="stylesheet" type="text/css" href="{{ asset('dashable/assets/css/style.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('dashable/assets/css/widget.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('plugins/DataTables/datatables.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('dashable/assets/pages/advance-elements/css/bootstrap-datetimepicker.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('dashable/bower_components/datedropper/css/datedropper.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('js/bootstrap-datepicker.standalone.min.css') }}">
        <style>
            .v--modal-overlay .v--modal-box {
                overflow: unset !important;
            }
        </style>
        @yield('css')
    </head>
    <body>
        <div id="app">
            @yield('modals')
            <div id="pcoded" class="pcoded">
                {{-- <div class="pcoded-overlay-box"></div> --}}
                <div class="pcoded-container navbar-wrapper">
                    <nav class="navbar header-navbar pcoded-header">
                        <div class="navbar-wrapper">
                            <div class="navbar-logo">
                                <a href="{{url('/')}}">
                                    <img class="img-fluid" src="/dashable/assets/images/logo.png" alt="Theme-Logo" />
                                </a>
                                <a class="mobile-menu" id="mobile-collapse" href="index.html#!">
                                    <i class="feather icon-menu"></i>
                                </a>
                                <a class="mobile-options waves-effect waves-light">
                                    <i class="feather icon-more-horizontal"></i>
                                </a>
                            </div>
                            <div class="navbar-container container-fluid">
                                <ul class="nav-right">
                                    <li class="header-notification">
                                        <div class="dropdown-primary dropdown">
                                            <div class="dropdown-toggle" data-toggle="dropdown">
                                                <i class="feather icon-bell"></i>
                                                <span class="badge bg-c-red">5</span>
                                            </div>
                                            <ul class="show-notification notification-view dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                                <li>
                                                    <h6>Notifications</h6>
                                                    <label class="label label-danger">New</label>
                                                </li>
                                                <li>
                                                    <div class="media">
                                                        <div class="media-body">
                                                            <h5 class="notification-user">John Doe</h5>
                                                            <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer elit.</p>
                                                            <span class="notification-time">30 minutes ago</span>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="media">
                                                        <img class="img-radius" src="dashable/assets/images/avatar-3.jpg" alt="Generic placeholder image">
                                                        <div class="media-body">
                                                            <h5 class="notification-user">Joseph William</h5>
                                                            <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer elit.</p>
                                                            <span class="notification-time">30 minutes ago</span>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="media">
                                                        <img class="img-radius" src="dashable/assets/images/avatar-4.jpg" alt="Generic placeholder image">
                                                        <div class="media-body">
                                                            <h5 class="notification-user">Sara Soudein</h5>
                                                            <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer elit.</p>
                                                            <span class="notification-time">30 minutes ago</span>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    <li class="header-notification">
                                        <div class="dropdown-primary dropdown">
                                            <div class="displayChatbox dropdown-toggle" data-toggle="dropdown">
                                                <i class="feather icon-message-square"></i>
                                                <span class="badge bg-c-green">3</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="user-profile header-notification">
                                        <div class="dropdown-primary dropdown">
                                            <div class="dropdown-toggle" data-toggle="dropdown">
                                                <i class="icon feather icon-settings"></i>
                                            </div>
                                            <ul class="show-notification profile-notification dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                                <li class="drp-u-details">
                                                    
                                                    <span>{{ auth()->user()->name }}</span>
                                                </li>
                                                <li>
                                                    <a href="index.html#!">
                                                        <i class="feather icon-settings"></i> Settings
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#" onclick="event.preventDefault();document.getElementById('logoutForm').submit();">
                                                        <i class="feather icon-log-out"></i> Logout
                                                    </a>
                                                    <form method="post" action="{{ route('logout') }}" id="logoutForm">
                                                        @csrf
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                    <div id="sidebar" class="users p-chat-user showChat">
                        <div class="had-container">
                            <div class="p-fixed users-main">
                                <div class="user-box">
                                    <div class="chat-search-box">
                                        <a class="back_friendlist">
                                            <i class="feather icon-x"></i>
                                        </a>
                                        <div class="right-icon-control">
                                            <div class="input-group input-group-button">
                                                <input type="text" id="search-friends" name="footer-email" class="form-control" placeholder="Search Friend">
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary waves-effect waves-light" type="button"><i class="feather icon-search"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="main-friend-list">
                                        <div class="media userlist-box waves-effect waves-light" data-id="1" data-status="online" data-username="Josephin Doe">
                                            <a class="media-left" href="index.html#!">
                                                <img class="media-object img-radius img-radius" src="dashable/assets/images/avatar-3.jpg" alt="Generic placeholder image ">
                                                <div class="live-status bg-success"></div>
                                            </a>
                                            <div class="media-body">
                                                <div class="chat-header">Josephin Doe</div>
                                            </div>
                                        </div>
                                        <div class="media userlist-box waves-effect waves-light" data-id="2" data-status="online" data-username="Lary Doe">
                                            <a class="media-left" href="index.html#!">
                                                <img class="media-object img-radius" src="dashable/assets/images/avatar-2.jpg" alt="Generic placeholder image">
                                                <div class="live-status bg-success"></div>
                                            </a>
                                            <div class="media-body">
                                                <div class="f-13 chat-header">Lary Doe</div>
                                            </div>
                                        </div>
                                        <div class="media userlist-box waves-effect waves-light" data-id="3" data-status="online" data-username="Alice">
                                            <a class="media-left" href="index.html#!">
                                                <img class="media-object img-radius" src="dashable/assets/images/avatar-4.jpg" alt="Generic placeholder image">
                                                <div class="live-status bg-success"></div>
                                            </a>
                                            <div class="media-body">
                                                <div class="f-13 chat-header">Alice</div>
                                            </div>
                                        </div>
                                        <div class="media userlist-box waves-effect waves-light" data-id="4" data-status="offline" data-username="Alia">
                                            <a class="media-left" href="index.html#!">
                                                <img class="media-object img-radius" src="dashable/assets/images/avatar-3.jpg" alt="Generic placeholder image">
                                                <div class="live-status bg-default"></div>
                                            </a>
                                            <div class="media-body">
                                                <div class="f-13 chat-header">Alia<small class="d-block text-muted">10 min ago</small></div>
                                            </div>
                                        </div>
                                        <div class="media userlist-box waves-effect waves-light" data-id="5" data-status="offline" data-username="Suzen">
                                            <a class="media-left" href="index.html#!">
                                                <img class="media-object img-radius" src="dashable/assets/images/avatar-2.jpg" alt="Generic placeholder image">
                                                <div class="live-status bg-default"></div>
                                            </a>
                                            <div class="media-body">
                                                <div class="f-13 chat-header">Suzen<small class="d-block text-muted">15 min ago</small></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="showChat_inner">
                        <div class="media chat-inner-header">
                            <a class="back_chatBox">
                                <i class="feather icon-x"></i> Josephin Doe
                            </a>
                        </div>
                        <div class="main-friend-chat">
                            <div class="media chat-messages">
                                <a class="media-left photo-table" href="index.html#!">
                                    <img class="media-object img-radius img-radius m-t-5" src="dashable/assets/images/avatar-2.jpg" alt="Generic placeholder image">
                                </a>
                                <div class="media-body chat-menu-content">
                                    <div class="">
                                        <p class="chat-cont">I'm just looking around. Will you tell me something about yourself?</p>
                                    </div>
                                    <p class="chat-time">8:20 a.m.</p>
                                </div>
                            </div>
                            <div class="media chat-messages">
                                <div class="media-body chat-menu-reply">
                                    <div class="">
                                        <p class="chat-cont">Ohh! very nice</p>
                                    </div>
                                    <p class="chat-time">8:22 a.m.</p>
                                </div>
                            </div>
                            <div class="media chat-messages">
                                <a class="media-left photo-table" href="index.html#!">
                                    <img class="media-object img-radius img-radius m-t-5" src="dashable/assets/images/avatar-2.jpg" alt="Generic placeholder image">
                                </a>
                                <div class="media-body chat-menu-content">
                                    <div class="">
                                        <p class="chat-cont">can you come with me?</p>
                                    </div>
                                    <p class="chat-time">8:20 a.m.</p>
                                </div>
                            </div>
                        </div>
                        <div class="chat-reply-box">
                            <div class="right-icon-control">
                                <div class="input-group input-group-button">
                                    <input type="text" class="form-control" placeholder="Write hear . . ">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary waves-effect waves-light" type="button"><i class="feather icon-message-circle"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="pcoded-main-container">
                        <div class="pcoded-wrapper">
                            @include('_partials.sidemenu')
                            <div class="pcoded-content">
                                
                                @yield('content')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--[if lt IE 10]>
        <div class="ie-warning">
            <h1>Warning!!</h1>
            <p>You are using an outdated version of Internet Explorer, please upgrade
                <br/>to any of the following web browsers to access this website.
            </p>
            <div class="iew-container">
                <ul class="iew-download">
                    <li>
                        <a href="http://www.google.com/chrome/">
                            <img src="dashable/assets/images/browser/chrome.png" alt="Chrome">
                            <div>Chrome</div>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.mozilla.org/en-US/firefox/new/">
                            <img src="dashable/assets/images/browser/firefox.png" alt="Firefox">
                            <div>Firefox</div>
                        </a>
                    </li>
                    <li>
                        <a href="http://www.opera.com">
                            <img src="dashable/assets/images/browser/opera.png" alt="Opera">
                            <div>Opera</div>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.apple.com/safari/">
                            <img src="dashable/assets/images/browser/safari.png" alt="Safari">
                            <div>Safari</div>
                        </a>
                    </li>
                    <li>
                        <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                            <img src="dashable/assets/images/browser/ie.png" alt="">
                            <div>IE (9 & above)</div>
                        </a>
                    </li>
                </ul>
            </div>
            <p>Sorry for the inconvenience!</p>
        </div>
        <![endif]-->
        <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>
        <script type="text/javascript" src="{{  asset('dashable/assets/js/pace.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('dashable/bower_components/jquery-ui/js/jquery-ui.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('dashable/bower_components/popper.js/js/popper.min.j') }}s"></script>
        <script type="text/javascript" src="{{ asset('dashable/bower_components/bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('dashable/assets/pages/waves/js/waves.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('dashable/bower_components/jquery-slimscroll/js/jquery.slimscroll.js') }}"></script>
        <script src="{{ asset('dashable/assets/pages/widget/amchart/amcharts.js') }}"></script>
        <script src="{{ asset('dashable/assets/pages/widget/amchart/serial.js') }}"></script>
        <script src="{{ asset('dashable/assets/pages/widget/amchart/light.js') }}"></script>
        <script src="{{ asset('dashable/bower_components/chartist/js/chartist.js') }}"></script>
        <script src="{{ asset('dashable/assets/js/pcoded.min.js') }}"></script>
        <script src="{{ asset('dashable/assets/js/vertical/vertical-layout.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('dashable/assets/pages/dashboard/custom-dashboard.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('dashable/assets/pages/advance-elements/moment-with-locales.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/axios.js') }}"></script>
        <script type="text/javascript" src="{{ asset('dashable/bower_components/bootstrap-daterangepicker/js/daterangepicker.js') }}"></script>

        <script type="text/javascript" src="{{ asset('dashable/assets/js/script.min.js') }}"></script>

        <script src="{{ asset('plugins/DataTables/datatables.min.js') }}"></script>
        <script src="{{ asset('plugins/sweetalert2.js') }}"></script>
        <script type="text/javascript">
            $(document).ready( function () {
                var date_input=$('.datepicker'); //our date input has the name "date"
                var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
                var options={
                    format: 'mm/dd/yyyy',
                    // format: 'mm/dd/yyyy HH:mm:ss',
                    // sideBySide: true,
                    container: container,
                    todayHighlight: true,
                    autoclose: true,
                    startDate: "dateToday",
                };
                date_input.datepicker(options);

            });
        </script>
        @include('sweetalert::alert')
        @yield('js')
    </body>
</html>