@extends("layouts.app")

@section("title")
  <nav aria-label="breadcrumb" class="col-sm-4 order-sm-last mb-3 mb-sm-0 p-0 ">
    <ol class="breadcrumb d-inline-flex font-weight-600 fs-13 bg-white mb-0 float-sm-right">
      <li class="breadcrumb-item"><a href="{{ route("dashboard.index") }}">Dashboard</a></li>
      <li class="breadcrumb-item active">Pin</li>
    </ol>
  </nav>
  <div class="col-sm-8 header-title p-0">
    <div class="media">
      <div class="header-icon text-success mr-3"><i class="fas fa-parking text-warning"></i></div>
      <div class="media-body">
        <h1 class="font-weight-bold">Pin</h1>
        <small>List Pin</small>
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
    <div class="col-md-12 mb-4">
      <form method="POST" action="{{ route("pin.store") }}">
        @csrf
        <div class="form-group">
          <label for="_amount" class="font-weight-600">Send Pin</label>
          <div class="input-group">
            <div>
              <input type="text" class="form-control @error("amount") is-invalid @enderror" id="_amount" name="amount" value="{{ old("amount") ?? 0 }}">
            </div>
            <input type="text" class="form-control @error("username") is-invalid @enderror" id="_username" name="username" placeholder="Enter Username" value="{{ old("username") }}">
            <div class="input-group-append">
              <button type="submit" class="btn btn-outline-secondary">Send</button>
            </div>
          </div>
          @error("amount")
          <small id="emailHelp" class="form-text text-danger">{{ $message }}</small>
          @enderror
          @error("username")
          <small id="emailHelp" class="form-text text-danger">{{ $message }}</small>
          @enderror
        </div>
      </form>
    </div>
    @if($pins->hasPages())
      <div class="col-sm-12 p-4">
        {{ $pins->links() }}
      </div>
    @endif
    <div class="col-lg-12">
      <div class="table-responsive">
        <table class="table table-striped text-center">
          <thead>
          <tr>
            <th scope="col">#</th>
            @can("Admin")
              <th scope="col">User</th>
            @endcan
            <th scope="col">Description</th>
            <th scope="col">In</th>
            <th scope="col">Out</th>
            <th scope="col">At</th>
          </tr>
          </thead>
          <tbody>
          @foreach($pins as $pin)
            <tr>
              <th scope="row">{{ ($pins->currentpage() - 1) * $pins->perpage() + $loop->index + 1 }}.</th>
              @can("Admin")
                <td>{{ $pin->user->name }}</td>
              @endcan
              <td>{{ $pin->description ?? "-" }}</td>
              <td>{{ $pin->debit }}</td>
              <td>{{ $pin->credit }}</td>
              <td>{{ $pin->created_at }}</td>
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