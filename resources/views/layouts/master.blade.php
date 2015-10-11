<html>
  <head>
    <title>SaborunaYo</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    @yield('addCss')
    <script src="/js/app.js" type="text/javascript"></script>
    @yield('addJs')
  </head>
  <body>
    @yield('body')
  </body>
</html>
