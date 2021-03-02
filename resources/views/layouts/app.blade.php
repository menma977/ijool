<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Website for infestation and treading">
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
  <link href="{{ asset("plugins/sweetalert/sweetalert.css") }}" rel="stylesheet">
  <link href="{{ asset("plugins/toastr/toastr.css") }}" rel="stylesheet">
  <!--Start Your Custom Style Now-->
  <link href="{{ asset("dist/css/style.css") }}" rel="stylesheet">
  @yield("addCss")
</head>

<body class="fixed">
<!-- Page Loader -->
<div class="page-loader-wrapper">
  <div class="loader">
    <div class="preloader">
      <div class="spinner-layer pl-green">
        <div class="circle-clipper left">
          <div class="circle"></div>
        </div>
        <div class="circle-clipper right">
          <div class="circle"></div>
        </div>
      </div>
    </div>
    <p>Please wait...</p>
  </div>
</div>
<!-- #END# Page Loader -->
<div class="wrapper">
  <!-- Sidebar  -->
  <x-side-bar/>
  <!-- Page Content  -->
  <div class="content-wrapper">
    <div class="main-content">
      <x-header/>
      <!--/.navbar-->
      <!--Content Header (Page header)-->
      <div class="content-header row align-items-center m-0">
        @yield("title")
      </div>
      <!--/.Content Header (Page header)-->
      <div class="body-content">
        @yield("content")
      </div>
      <!--/.body content-->
    </div>
    <!--/.main content-->
    <footer class="footer-content">
      <div class="footer-text d-flex align-items-center justify-content-between">
        <div class="copy">© 2021 Ijool</div>
        <div class="credit">Designed by: <a href="#">GENOM</a></div>
      </div>
    </footer>
    <!--/.footer content-->
    <div class="overlay"></div>
  </div>
  <!--/.wrapper-->
</div>
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
  @csrf
</form>
<!--Global script(used by all pages)-->
<script src="{{ asset("plugins/jQuery/jquery-3.4.1.min.js") }}"></script>
<script src="{{ asset("dist/js/popper.min.js") }}"></script>
<script src="{{ asset("plugins/bootstrap/js/bootstrap.min.js") }}"></script>
<script src="{{ asset("plugins/metisMenu/metisMenu.min.js") }}"></script>
<script src="{{ asset("plugins/perfect-scrollbar/dist/perfect-scrollbar.min.js") }}"></script>
<!-- Third Party Scripts(used by this page)-->
<script src="{{ asset("plugins/sweetalert/sweetalert.min.js") }}"></script>
<script src="{{ asset("plugins/toastr/toastr.min.js") }}"></script>
<!--Page Active Scripts(used by this page)-->

<!--Page Scripts(used by all page)-->
<script src="{{ asset("dist/js/sidebar.js") }}"></script>
<script>
  $(function () {
    $("#logout-web").on("click", function () {
      event.preventDefault();
      document.getElementById('logout-form').submit();
    });

    @if(session()->has("message"))
    toastr.success("{{ session()->get("message") }}");
    @endif

    @if(session()->has("info"))
    toastr.info("{{ session()->get("info") }}");
    @endif

    @if(session()->has("warning"))
    toastr.warning("{{ session()->get("warning") }}");
    @endif

    @if(session()->has("error"))
    toastr.error("{{ session()->get("error") }}");
    @endif

    @if ($errors->any())
    @foreach ($errors->all() as $error)
    toastr.error("{{ $error }}");
    @endforeach
    @endif

    $("#unsubscribe").on("click", function () {
      swal({
          title: "Are you sure to unsubscribe?",
          text: "You can not play again before re-subscribe !",
          type: "warning",
          showCancelButton: true,
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Yes, unsubscribe!",
          closeOnConfirm: false
        },

        function () {
          window.location.replace("{{ route("subscribe.agree") }}");
        }
      );
    });
  });
</script>

@yield("addJs")
</body>

</html>
