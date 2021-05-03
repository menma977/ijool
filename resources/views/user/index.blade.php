@extends("layouts.app")

@section("title")
  <nav aria-label="breadcrumb" class="col-sm-4 order-sm-last mb-3 mb-sm-0 p-0 ">
    <ol class="breadcrumb d-inline-flex font-weight-600 fs-13 bg-white mb-0 float-sm-right">
      <li class="breadcrumb-item"><a href="{{ route("dashboard.index") }}">Dashboard</a></li>
      <li class="breadcrumb-item active">Users</li>
    </ol>
  </nav>
  <div class="col-sm-8 header-title p-0">
    <div class="media">
      <div class="header-icon text-success mr-3"><i class="fas fa-users text-warning"></i></div>
      <div class="media-body">
        <h1 class="font-weight-bold">Users</h1>
        <small>List User</small>
      </div>
    </div>
  </div>
@endsection

@section("content")
  <div class="row">
    @if($users->hasPages())
      <div class="col-sm-12 p-4">
        {{ $users->links() }}
      </div>
    @endif
    <div class="col-lg-12">
      <div class="table-responsive">
        <table class="table table-striped">
          <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col" colspan="2">User</th>
            <th scope="col">Username</th>
            <th scope="col">Email</th>
          </tr>
          </thead>
          <tbody>
          @foreach($users as $user)
            <tr>
              <td scope="row">{{ ($users->currentpage() - 1) * $users->perpage() + $loop->index + 1 }}.</td>
              <td style="width: 45px">
                <img src="{{ $user->profile->image ? asset("storage/profile/".$user->profile->image) : asset("dist/img/logo_bg.png") }}"
                     class="img-fluid rounded-circle"
                     alt="{{ $user->name }}"
                     style="width: 25px;height: 25px">
              </td>
              <td>
                <a href="{{ route("user.profile", $user->id) }}">
                  {{ $user->name }}
                </a>
              </td>
              <td>{{ $user->username }}</td>
              <td>{{ $user->email }}</td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection

@section("addCss")
  <link href="{{ asset("plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css") }}" rel="stylesheet">
@endsection

@section("addJs")
  <script src="{{ asset("plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js") }}"></script>
  <script src="{{ asset("plugins/bootstrap-touchspin/bootstrap-touchspin.active.js") }}"></script>
  <script>
    $(function () {
      $("#_amount").TouchSpin();
    });
  </script>
@endsection