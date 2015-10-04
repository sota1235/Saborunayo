<meta name="csrf-token" content="{{ csrf_token() }}" />

<h1>Welcome to SaborunaYo!</h1>

<script src="/js/app.js" type="text/javascript"></script>
<script type="text/javascript">
/* add csrf token to request header */
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
</script>
