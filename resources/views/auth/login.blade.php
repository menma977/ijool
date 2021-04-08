@extends("layouts.guest")

@section("content")
  <div class="d-flex align-items-center justify-content-center text-center h-100vh">
    <div class="form-wrapper m-auto">
      <div class="form-container my-4">
        <div class="register-logo text-center mb-4">
          <img src="{{ asset("dist/img/logo.png") }}" alt="ijool" style="width: 20%">
        </div>
        <div class="panel">
          <div class="panel-header text-center mb-3">
            <h3 class="fs-24">Sign into your account!</h3>
            <p class="text-muted text-center mb-0">Nice to see you! Please log in with your account.</p>
          </div>
          <form class="register-form" action="{{ route('login') }}" method="post">
            @csrf
            <div class="form-group">
              <input type="text" class="form-control @error('username') is-invalid @enderror" id="_username" name="username" placeholder="Enter username" value="{{ old("username") }}" autofocus>
              @error('username')
              <div class="invalid-feedback text-left">{{ $message }}</div>
              @enderror
            </div>
            <div class="form-group">
              <input type="password" class="form-control @error('password') is-invalid @enderror" id="_password" name="password" placeholder="Password">
              @error('password')
              <div class="invalid-feedback text-left">{{ $message }}</div>
              @enderror
            </div>
            <div class="custom-control custom-checkbox mb-3">
              <input type="checkbox" class="custom-control-input" id="remember_me" name="remember">
              <label class="custom-control-label" for="remember_me">Remember me next time </label>
            </div>
            <button type="submit" class="btn btn-success btn-block">Sign in</button>
          </form>
        </div>
        <div class="bottom-text text-center my-3">
          Don't have an account? <a href="{{ route("register") }}" class="font-weight-500">Sign Up</a>
          @if (Route::has('password.request'))
            <br>
            Remind <a href="{{ route('password.request') }}" class="font-weight-500">Password</a>
          @endif
        </div>
      </div>
    </div>
  </div>
@endsection
