@extends("layouts.app")

@section("title")
  <nav aria-label="breadcrumb" class="col-sm-4 order-sm-last mb-3 mb-sm-0 p-0 ">
    <ol class="breadcrumb d-inline-flex font-weight-600 fs-13 bg-white mb-0 float-sm-right">
      <li class="breadcrumb-item"><a href="{{ route("dashboard.index") }}">Dashboard</a></li>
      <li class="breadcrumb-item active">Desktop</li>
    </ol>
  </nav>
  <div class="col-sm-8 header-title p-0">
    <div class="media">
      <div class="header-icon text-success mr-3"><i class="fas fa-store text-warning"></i></div>
      <div class="media-body">
        <h1 class="font-weight-bold">Desktop</h1>
      </div>
    </div>
  </div>
@endsection

@section("content")
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body text-center">
          <div class="row justify-content-center">
            <div class="greet-user col-12 col-xl-10">
              <img src="{{ asset("dist/img/happiness.svg") }}" alt="..." class="img-fluid  mb-2">
              <h2 class="fs-23 font-weight-600 mb-2">
                please wait
              </h2>
              <p class="text-muted">
                desktop application still in progress
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection