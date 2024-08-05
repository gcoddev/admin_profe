<!doctype html>
<html class="no-js" lang="es-ES">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="{{asset('assets/profe/icono.png')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('1/css/style.css')}}" />
</head>
<body class="flat">
    <div id="particles-js"></div>

    <a href="#" class="logo-link" title="back home">
      <img src="{{asset('assets/profe/logoprofe.png')}}" width="200" class="logo" alt="Logotipo de la empresa" />
    </a>
    <div class="content">
      <div class="content-box">
        <div class="big-content">
          <div class="list-square">
            <span class="square"></span>
            <span class="square"></span>
            <span class="square"></span>
          </div>

          <div class="list-line">
            <span class="line"></span>
            <span class="line"></span>
            <span class="line"></span>
            <span class="line"></span>
            <span class="line"></span>
            <span class="line"></span>
          </div>

          <i class="fa fa-search" aria-hidden="true"></i>

          <div class="clear"></div>
        </div>
               @yield('error-content')
            </div>
        </div>
        <footer class="light">
          <ul>
            {{-- <li><a href="#">Soporte</a></li> --}}
            <li>
              {{-- <a href="#"><i class="fa fa-facebook"></i></a> --}}
            </li>
            <li>
              {{-- <a href="#"><i class="fa fa-twitter"></i></a> --}}
            </li>
          </ul>
        </footer>
        <script src="{{asset('1/js/jquery.min.js')}}"></script>
        <script src="{{asset('1/js/bootstrap.min.js')}}"></script>
    
        <script src="{{asset('1/js/particles.js')}}"></script>
      </body>
    @yield('scripts')
</body>

</html>