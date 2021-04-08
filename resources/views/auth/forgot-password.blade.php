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
            <h3 class="fs-24">Forgot password</h3>
            <p class="text-muted text-center mb-0">We will send you an email to change your password.</p>
          </div>
          <form class="register-form" action="{{ route('password.email') }}" method="post">
            @csrf
            <div class="form-group">
              <input type="email" class="form-control @error('email') is-invalid @enderror" id="_email" name="email" placeholder="Enter email" value="{{ old("email") }}" autofocus>
              @error('email')
              <div class="invalid-feedback text-left">{{ $message }}</div>
              @enderror
            </div>
            <button type="submit" class="btn btn-success btn-block">Email Password Reset Link</button>
          </form>
        </div>
        <div class="bottom-text text-center my-3">
          have an account? <a href="{{ route("login") }}" class="font-weight-500">Sign In</a>
          <br>
          @if (Route::has('register'))
            Don't have an account? <a href="{{ route("register") }}" class="font-weight-500">Sign Up</a>
          @endif
          @if (Route::has('password.request'))
            <br>
            Remind <a href="{{ route('password.request') }}" class="font-weight-500">Password</a>
          @endif
        </div>
      </div>
    </div>
  </div>
@endsection

@section("addCss")
  {{--  NotificationStyles--}}
  <link href="{{ asset("plugins/NotificationStyles/css/demo.css") }}" rel="stylesheet">
  <link href="{{ asset("plugins/NotificationStyles/css/ns-default.css") }}" rel="stylesheet">
  <link href="{{ asset("plugins/NotificationStyles/css/ns-style-growl.css") }}" rel="stylesheet">
  <link href="{{ asset("plugins/NotificationStyles/css/ns-style-attached.css") }}" rel="stylesheet">
  <link href="{{ asset("plugins/NotificationStyles/css/ns-style-bar.css") }}" rel="stylesheet">
  <link href="{{ asset("plugins/NotificationStyles/css/ns-style-other.css") }}" rel="stylesheet">
@endsection

@section("addJs")
  {{--  NotificationStyles--}}
  <script src="{{ asset("plugins/NotificationStyles/js/modernizr.custom.js") }}"></script>
  <script src="{{ asset("plugins/NotificationStyles/js/classie.js") }}"></script>
  <script src="{{ asset("plugins/NotificationStyles/js/notificationFx.js") }}"></script>
  <script src="{{ asset("plugins/NotificationStyles/js/snap.svg-min.js") }}"></script>

  <script>
    $(function () {
      @if(session('status'))
      let notification = new NotificationFx({
        message: '<span class="fas fa-exclamation-circle"></span> ' + @json(session('status')),
        layout: 'attached',
        effect: 'bouncyflip',
        type: 'warning', // notice, warning or error
      })
      notification.show();
      @endif

      @if ($errors->any())
      @foreach ($errors->all() as $error)
      let notificationError = new NotificationFx({
        message: '<span class="fas fa-exclamation-circle"></span> ' + @json($error),
        layout: 'attached',
        effect: 'bouncyflip',
        type: 'error', // notice, warning or error
      })
      notificationError.show();
      @endforeach
      @endif
    });
  </script>
@endsection