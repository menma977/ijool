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
            <p class="text-muted text-center mb-0">Thanks for signing up! Before getting started,</p>
            <p class="text-muted text-center mb-0">could you verify your email address by clicking on the link we just emailed to you? If you didn't receive the email,</p>
            <p class="text-muted text-center mb-0">we will gladly send you another.</p>
          </div>
          <form class="register-form" action="{{ route('verification.send') }}" method="post">
            @csrf
            <button type="submit" class="btn btn-success btn-block">Resend Verification Email</button>
          </form>
          <hr/>
          <form class="register-form" action="{{ route('logout') }}" method="post">
            @csrf
            <button type="submit" class="btn btn-success btn-block">Logout</button>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
