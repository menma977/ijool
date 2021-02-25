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
            <h3 class="fs-24">This is a safe area of the app</h3>
            <p class="text-muted text-center mb-0">Please confirm your password before continuing.</p>
          </div>
          <form class="register-form" action="{{ route('password.confirm') }}" method="post">
            @csrf
            <div class="form-group">
              <input type="password" class="form-control @error('password') is-invalid @enderror" id="_password" name="password" placeholder="Password">
              @error('password')
              <div class="invalid-feedback text-left">{{ $message }}</div>
              @enderror
            </div>
            <button type="submit" class="btn btn-success btn-block">Confirm</button>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
