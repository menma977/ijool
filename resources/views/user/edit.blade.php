@extends("layouts.app")

@section("title")
  <nav aria-label="breadcrumb" class="col-sm-4 order-sm-last mb-3 mb-sm-0 p-0 ">
    <ol class="breadcrumb d-inline-flex font-weight-600 fs-13 bg-white mb-0 float-sm-right">
      <li class="breadcrumb-item"><a href="{{ route("dashboard.index") }}">Dashboard</a></li>
      <li class="breadcrumb-item"><a href="{{ route("user.profile") }}">Profile</a></li>
      <li class="breadcrumb-item active">Blank</li>
    </ol>
  </nav>
  <div class="col-sm-8 header-title p-0">
    <div class="media">
      <div class="header-icon text-success mr-3"><i class="fas fa-user"></i></div>
      <div class="media-body">
        <h1 class="font-weight-bold">Edit Profile</h1>
        <small>this page to edit your password and profile</small>
      </div>
    </div>
  </div>
@endsection

@section("content")
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-header">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <h6 class="fs-17 font-weight-600 mb-0">Edit Profile</h6>
            </div>
          </div>
        </div>
        <form method="post" action="{{ route("user.update", \Illuminate\Support\Facades\Crypt::encryptString($user->id)) }}" enctype="multipart/form-data">
          @csrf
          <div class="card-body">
            <div class="row">
              <div class="col-md-4 pr-md-1">
                <div class="form-group">
                  <label class="font-weight-600">Name</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{ old("name") ?? $user->name }}">
                  @error('name')
                  <div class="invalid-feedback text-left">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="col-md-4 pr-md-1">
                <div class="form-group">
                  <label class="font-weight-600">City</label>
                  <input type="text" class="form-control" id="city" name="city" placeholder="City" value="{{ old("city") ?? $user->profile->city }}">
                  @error('city')
                  <div class="invalid-feedback text-left">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="col-md-4 px-md-1">
                <div class="form-group">
                  <label class="font-weight-600">Country</label>
                  <input type="text" class="form-control" id="country" name="country" placeholder="Country" value="{{ old("country") ?? $user->profile->country }}">
                  @error('country')
                  <div class="invalid-feedback text-left">{{ $message }}</div>
                  @enderror
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6 pr-md-1">
                <div class="form-group">
                  <label class="font-weight-600">Password <small>leave blank if you don't want to be changed</small></label>
                  <input type="text" class="form-control" id="_password" name="password" placeholder="Password" value="{{ old("password") }}">
                  @error('password')
                  <div class="invalid-feedback text-left">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="col-md-6 px-md-1">
                <div class="form-group">
                  <label class="font-weight-600">Confirmation Password</label>
                  <input type="text" class="form-control" id="_password_confirmation" name="password_confirmation" placeholder="Password Confirmation" value="{{ old("password_confirmation") }}">
                  @error('password_confirmation')
                  <div class="invalid-feedback text-left">{{ $message }}</div>
                  @enderror
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 text-center">
                <img id="image_preview" src="{{ asset("dist/img/logo.png") }}" class="img-fluid rounded-circle" alt="avatar" style="width: 150px">
                <div class="form-group">
                  <label class="font-weight-600">Your avatar</label>
                  <input type="file" name="image" id="image" class="custom-input-file custom-input-file--2">
                  <label for="image">
                    <i class="fa fa-upload"></i>
                    <span id="image_name">Choose a file…</span>
                  </label>
                </div>
                @error('image')
                <div class="invalid-feedback text-left">{{ $message }}</div>
                @enderror
              </div>
            </div>
          </div>
          <div class="card-footer">
            <button type="submit" class="btn btn-fill btn-primary">Save</button>
          </div>
        </form>
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
        $("#image_name").html(input.files[0]["name"]);
      }
    }

    $("#image").change(function () {
      readURL(this);
    });
  </script>
@endsection