<html>
  <head>
    <title>SaborunaYo</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link href="/css/lib/pnotify.core.min.css" media="all" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="css/app.css">
    @yield('addCss')
    <script src="/js/app.js" type="text/javascript"></script>
    @yield('addJs')
  </head>
  <body>
    @yield('body')
  </body>
</html>
