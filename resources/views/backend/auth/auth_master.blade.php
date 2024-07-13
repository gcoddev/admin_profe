<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('auth_title', 'Authentication - Admin Panel')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="assets/images/icon/favicon.ico">
    @include('backend.layouts.partials.styles')
    @yield('styles')
</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- preloader area start -->
    <div class="theme-loader">
        <div class="ball-scale">
          <div class="contain">
            <div class="ring">
              <div class="frame"></div>
            </div>
            <div class="ring">
              <div class="frame"></div>
            </div>
            <div class="ring">
              <div class="frame"></div>
            </div>
            <div class="ring">
              <div class="frame"></div>
            </div>
            <div class="ring">
              <div class="frame"></div>
            </div>
            <div class="ring">
              <div class="frame"></div>
            </div>
            <div class="ring">
              <div class="frame"></div>
            </div>
            <div class="ring">
              <div class="frame"></div>
            </div>
            <div class="ring">
              <div class="frame"></div>
            </div>
            <div class="ring">
              <div class="frame"></div>
            </div>
          </div>
        </div>
      </div>
    <!-- preloader area end -->

    @yield('auth-content')

    @include('backend.layouts.partials.scripts')
    @yield('scripts')
</body>

</html>
