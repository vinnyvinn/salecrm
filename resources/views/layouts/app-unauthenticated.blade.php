<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Simulor - Responsive Admin Dashboard Template</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">
        <!-- App css -->
        <link href="{{ asset('simulor/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('simulor/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('simulor/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    </head>
    <body class="authentication-bg">
        <div class="account-pages mt-5 mb-5">
            <div class="container">
                @yield('content')
            </div>
        </div>
        <script src="{{ asset('simulor/js/vendor.min.js') }}"></script>
        <script src="{{ asset('simulor/js/app.min.js') }}"></script>
        
    </body>
</html>