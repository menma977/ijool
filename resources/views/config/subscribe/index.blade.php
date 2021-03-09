@extends("layouts.app")

@section("title")
  <nav aria-label="breadcrumb" class="col-sm-4 order-sm-last mb-3 mb-sm-0 p-0 ">
    <ol class="breadcrumb d-inline-flex font-weight-600 fs-13 bg-white mb-0 float-sm-right">
      <li class="breadcrumb-item"><a href="{{ route("dashboard.index") }}">Dashboard</a></li>
      <li class="breadcrumb-item active">Subscribe</li>
      <li class="breadcrumb-item active">List</li>
    </ol>
  </nav>
  <div class="col-sm-8 header-title p-0">
    <div class="media">
      <div class="header-icon text-success mr-3"><i class="fas fa-donate text-warning"></i></div>
      <div class="media-body">
        <h1 class="font-weight-bold">List Subscribe</h1>
        <small>List User Subscription</small>
      </div>
    </div>
  </div>
@endsection

@section("content")
  <div class="row">
    @if($subscribes->hasPages())
      <div class="col-sm-12 p-4">
        {{ $subscribes->links() }}
      </div>
    @endif
    <div class="col-lg-12">
      <div class="table-responsive">
        <table class="table table-striped text-center">
          <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Price</th>
            <th scope="col">Status</th>
            <th scope="col">Expired At</th>
          </tr>
          </thead>
          <tbody>
          @foreach($subscribes as $subscribe)
            <tr>
              <th scope="row">{{ ($subscribes->currentpage() - 1) * $subscribes->perpage() + $loop->index + 1 }}.</th>
              <td>{{ $subscribe->user->name }}</td>
              <td>{{ $subscribe->price }} DOGE</td>
              <td>
                @if($subscribe->is_finished)
                  <label class="fas fa-check-circle text-danger">Finish</label>
                @else
                  <label class="fas fa-circle-notch text-success">Progress</label>
                @endif
              </td>
              <td>{{ $subscribe->expired_at }}</td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection