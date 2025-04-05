
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">

    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <!-- CSS -->
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
        <link rel="stylesheet" href="{{ asset('auth/css/login-v3.css') }}">
        @stack('stylesheets')
    </head>


  <body>
    <div class="container">
        <div class="forms">
            <!-- Login Form -->

             @yield('content')
            <!-- Registration Form -->
        </div>
    </div>

  </body>

  <script src="{{ asset('auth/js/custom-scripts.js') }}"></script>

  @stack('script')
</html>



