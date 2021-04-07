@extends("layouts.app")

@section("title")
<nav aria-label="breadcrumb" class="col-sm-4 order-sm-last mb-3 mb-sm-0 p-0 ">
  <ol class="breadcrumb d-inline-flex font-weight-600 fs-13 bg-white mb-0 float-sm-right">
    <li class="breadcrumb-item"><a href="{{ route("dashboard.index") }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Invite</li>
  </ol>
</nav>
<div class="col-sm-8 header-title p-0">
  <div class="media">
    <div class="header-icon text-success mr-3"><i class="fas fa-store text-warning"></i></div>
    <div class="media-body">
      <h1 class="font-weight-bold">Register User</h1>
    </div>
  </div>
</div>
@endsection

@section("content")
<div class="d-flex align-items-center justify-content-center text-center h-100vh">
  <div class="form-wrapper m-auto">
    <div class="form-container my-4">
      <div class="register-logo text-center mb-4">
        <img src="{{ asset("dist/img/logo.png") }}" alt="ijool" style="width: 30%">
      </div>
      <div class="panel">
        <div class="panel-header text-center mb-3">
          <h3 class="fs-24">Register Mates</h3>
          <p class="text-muted text-center mb-0">accounts that are not verified for 1 day will be deleted.</p>
        </div>
        <p class="text-muted text-center">if there is fraud when using this application, your account will be
          permanently blocked</p>
        <div class="divider font-weight-bold text-uppercase text-dark d-table text-center my-3">Form</div>
        <form class="register-form" action="{{ route('register') }}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="_name" name="name"
              placeholder="full name" value="{{ old("name") }}" autofocus>
            @error('name')
            <div class="invalid-feedback text-left">{{ $message }}</div>
            @enderror
          </div>
          <div class="form-group">
            <input type="text" class="form-control @error('code') is-invalid @enderror" id="_code" name="code"
              placeholder="unique code" value="{{ old("code") }}">
            @error('code')
            <div class="invalid-feedback text-left">{{ $message }}</div>
            @enderror
          </div>
          <div class="form-group">
            <input type="text" class="form-control @error('username') is-invalid @enderror" id="_username"
              name="username" placeholder="username" value="{{ old("username") }}">
            @error('username')
            <div class="invalid-feedback text-left">{{ $message }}</div>
            @enderror
          </div>
          <div class="form-group">
            <small>must be a valid email address*</small>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="_email" name="email"
              placeholder="email" value="{{ old("email") }}">
            @error('email')
            <div class="invalid-feedback text-left">{{ $message }}</div>
            @enderror
          </div>
          <div class="form-group">
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="_password"
              name="password" placeholder="Password">
            @error('password')
            <div class="invalid-feedback text-left">{{ $message }}</div>
            @enderror
          </div>
          <div class="form-group">
            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
              id="_password_confirmation" name="password_confirmation" placeholder="confirm password">
            @error('password_confirmation')
            <div class="invalid-feedback text-left">{{ $message }}</div>
            @enderror
          </div>
          <div class="form-group">
            <input type="text" class="form-control @error('city') is-invalid @enderror" id="_city" name="city"
              placeholder="city" value="{{ old("city") }}">
            @error('city')
            <div class="invalid-feedback text-left">{{ $message }}</div>
            @enderror
          </div>
          <div class="form-group">
            <input type="text" class="form-control @error('country') is-invalid @enderror" id="_country" name="country"
              placeholder="country" value="{{ old("country") }}">
            @error('country')
            <div class="invalid-feedback text-left">{{ $message }}</div>
            @enderror
          </div>
          <div class="form-group">
            <label class="font-weight-600">Your avatar</label>
            <input type="file" name="image" id="image" class="custom-input-file custom-input-file--2">
            <label for="image">
              <i class="fa fa-upload"></i>
              <span id="image_name">Choose a file…</span>
            </label>
          </div>
          <div class="avatar online mb-4">
            <img id="image_preview" src="{{ asset("dist/img/logo.png") }}" class="img-fluid rounded-circle"
              alt="avatar">
          </div>
          <button type="submit" class="btn btn-success btn-block">Sign up</button>
          <p class="text-muted text-center mt-3 mb-0">
            By signing up, you agree to our <a class="external" href="{{ route("rule") }}" target="_blank">terms of
              use</a>.
          </p>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@section("addJs")
<script>
  function readURL(input) {
      if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function (e) {
          $('#image_preview').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
        $("#image_name").text(input.files[0]["name"]);
      }
    }

    $("#image").change(function () {
      readURL(this);
    });
</script>
@endsection
