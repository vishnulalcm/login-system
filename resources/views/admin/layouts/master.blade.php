
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">

<head>
    <title>@yield('pageTitle')</title>
    <meta charset="utf-8">
    <meta name="author" content="themesflat.com">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/animate.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/animation.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('font/fonts.css') }}">

    <link rel="icon" href="{{ asset('images/default-favicon.ico') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <link rel="apple-touch-icon-precomposed" href="{{ asset('images/default-favicon.ico') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/sweetalert.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css') }}">

    <!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<!-- DataTables JS -->

    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.css" rel="stylesheet">
    @stack('stylesheets')


</head>

<body class="body">
    <div id="wrapper">
        <div id="page" class="">
            <div class="layout-wrap">

                  @include('admin.layouts.siderbar')
                <div class="section-content-right">

                 @include('admin.layouts.header')
                    <div class="main-content">

                        <div class="main-content-inner">
                            @yield('content')
                        </div>
                       @include('admin.layouts.footer')
                    </div>

                </div>
            </div>
        </div>
    </div>


    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('js/sweetalert.min.js') }}"></script>
    <script src="{{ asset('js/apexcharts/apexcharts.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>


<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>


    @stack('scripts')




</body>

</html>


