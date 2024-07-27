<!DOCTYPE html>
<html lang="es-ES">
<meta
    http-equiv="content-type"
    content="text/html;charset=UTF-8"
  />
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    @yield('og-meta-tags')
    <title>@yield('title', 'PROFE')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('assets/profe/icono.png')}}" type="image/x-icon" />
    
    
    @include('frontend.layouts.partials.styles')
    @yield('styles')
    
</head>

<body class="home page-template page-template-home-page page-template-home-page-php page page-id-9 elementor-default elementor-kit-6 elementor-page elementor-page-9">

    @include('frontend.layouts.partials.nabar')

    @yield('frontend-content')

    <!-- main content area end -->
    @include('frontend.layouts.partials.footer')

    @include('frontend.layouts.partials.offsets')
    @include('frontend.layouts.partials.scripts')
    @yield('scripts')
</body>

</html>
