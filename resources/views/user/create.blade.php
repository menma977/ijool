@extends("layouts.app")

@section("title")
  <nav aria-label="breadcrumb" class="col-sm-4 order-sm-last mb-3 mb-sm-0 p-0 ">
    <ol class="breadcrumb d-inline-flex font-weight-600 fs-13 bg-white mb-0 float-sm-right">
      <li class="breadcrumb-item"><a href="{{ route("dashboard.index") }}">Dashboard</a></li>
      <li class="breadcrumb-item">User</li>
      <li class="breadcrumb-item active">Add</li>
    </ol>
  </nav>
  <div class="col-sm-8 header-title p-0">
    <div class="media">
      <div class="header-icon text-success mr-3"><i class="fas fa-users text-warning"></i></div>
      <div class="media-body">
        <h1 class="font-weight-bold">Add User</h1>
      </div>
    </div>
  </div>
@endsection

@section("content")
  <div class="row">
    <div class="col-md-12">
      <div class="card card-stats statistic-box mb-4">
        <div class="card-header card-header-warning card-header-icon position-relative border-0 text-right px-3 py-0">
          <div class="card-icon d-flex align-items-center justify-content-center">
            <i class="fas fa-parking"></i>
          </div>
          <p class="card-category text-uppercase fs-10 font-weight-bold text-muted">Your Pin</p>
          <h3 class="card-title fs-18 font-weight-bold">
            <label>{{ $totalPin }}</label>
          </h3>
        </div>
      </div>
    </div>
    @if($totalPin > 1)
      <div class="col-md-12">
        <div class="card mb-4">
          <form method="POST" action="{{ route("user.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
              <div class="form-group">
                <label for="amount" class="font-weight-600">Full Name *</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="_name" name="name" placeholder="full name" value="{{ old("name") }}" autofocus>
                @error('name')
                <small class="form-text text-danger">{{ $message }}</small>
                @enderror
              </div>
              <div class="form-group">
                <label for="amount" class="font-weight-600">Username *</label>
                <input type="text" class="form-control @error('username') is-invalid @enderror" id="_username" name="username" placeholder="Username" value="{{ old("username") }}">
                @error('username')
                <small class="form-text text-danger">{{ $message }}</small>
                @enderror
              </div>
              <div class="form-group">
                <label for="amount" class="font-weight-600">Email *</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="_email" name="email" placeholder="Email" value="{{ old("email") }}">
                @error('email')
                <small class="form-text text-danger">{{ $message }}</small>
                @enderror
              </div>
              <div class="form-group">
                <label for="amount" class="font-weight-600">Password *</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="_password" name="password" placeholder="Password">
                @error('password')
                <small class="form-text text-danger">{{ $message }}</small>
                @enderror
              </div>
              <div class="form-group">
                <label for="amount" class="font-weight-600">confirm password *</label>
                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="_password_confirmation" name="password_confirmation"
                       placeholder="confirm password">
                @error('password_confirmation')
                <small class="form-text text-danger">{{ $message }}</small>
                @enderror
              </div>
              <div class="form-group">
                <label for="amount" class="font-weight-600">City</label>
                <input type="text" class="form-control @error('city') is-invalid @enderror" id="_city" name="city" placeholder="city" value="{{ old("city") }}">
                @error('city')
                <small class="form-text text-danger">{{ $message }}</small>
                @enderror
              </div>
              <div class="form-group">
                <label for="amount" class="font-weight-600">Country</label>
                <input type="text" class="form-control @error('country') is-invalid @enderror" id="_country" name="country" placeholder="country" value="{{ old("country") }}">
                @error('country')
                <small class="form-text text-danger">{{ $message }}</small>
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
            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-success">add</button>
            </div>
          </form>
        </div>
      </div>
    @endif
  </div>
@endsection