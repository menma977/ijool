<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Website for mining">
  <meta name="author" content="IJOOL">
  <title>IJOOL</title>
  <!-- App favicon -->
  <link rel="shortcut icon" href="{{ asset("dist/img/logo_bg.png") }}">
  <!--Global Styles(used by all pages)-->
  <link href="{{ asset("plugins/bootstrap/css/bootstrap.min.css") }}" rel="stylesheet">
  <link href="{{ asset("plugins/metisMenu/metisMenu.min.css") }}" rel="stylesheet">
  <link href="{{ asset("plugins/fontawesome/css/all.min.css") }}" rel="stylesheet">
  <link href="{{ asset("plugins/typicons/src/typicons.min.css") }}" rel="stylesheet">
  <link href="{{ asset("plugins/themify-icons/themify-icons.min.css") }}" rel="stylesheet">
  <!--Third party Styles(used by this page)-->

  <!--Start Your Custom Style Now-->
  <link href="{{ asset("dist/css/style.css") }}" rel="stylesheet">
  @yield("addCss")
</head>
<body class="bg-white">
@yield("content")
<!-- /.End of form wrapper -->
<!--Global script(used by all pages)-->
<script src="{{ asset("plugins/jQuery/jquery-3.4.1.min.js") }}"></script>
<script src="{{ asset("dist/js/popper.min.js") }}"></script>
<script src="{{ asset("plugins/bootstrap/js/bootstrap.min.js") }}"></script>
<script src="{{ asset("plugins/metisMenu/metisMenu.min.js") }}"></script>
<script src="{{ asset("plugins/perfect-scrollbar/dist/perfect-scrollbar.min.js") }}"></script>
<!-- Third Party Scripts(used by this page)-->

<!--Page Active Scripts(used by this page)-->

<!--Page Scripts(used by all page)-->
<script src="{{ asset("dist/js/sidebar.js") }}"></script>
@yield("addJs")
</body>
</html>