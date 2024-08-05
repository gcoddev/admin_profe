<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title', 'Laravel Role Admin')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
    <!-- page container area start -->
    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">
            @include('backend.layouts.partials.sidebar')

            <!-- main content area start -->
            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                    @include('backend.layouts.partials.nabar')
                    <div class="pcoded-content">
                        <div class="pcoded-inner-content">
                            <div class="main-body">
                                @yield('admin-content')

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- main content area end -->
            @include('backend.layouts.partials.footer')
        </div>
    </div>
    <!-- page container area end -->

    @include('backend.layouts.partials.offsets')
    @include('backend.layouts.partials.scripts')
    @yield('scripts')
</body>

</html>
