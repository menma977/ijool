@extends("layouts.app")

@section("title")
  <nav aria-label="breadcrumb" class="col-sm-4 order-sm-last mb-3 mb-sm-0 p-0 ">
    <ol class="breadcrumb d-inline-flex font-weight-600 fs-13 bg-white mb-0 float-sm-right">
      <li class="breadcrumb-item"><a href="{{ route("dashboard.index") }}">Dashboard</a></li>
      <li class="breadcrumb-item active">Android</li>
    </ol>
  </nav>
  <div class="col-sm-8 header-title p-0">
    <div class="media">
      <div class="header-icon text-success mr-3"><i class="fas fa-store text-warning"></i></div>
      <div class="media-body">
        <h1 class="font-weight-bold">Android</h1>
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
            <div class="col-12 col-xl-10">
              <h2 class="fs-23 font-weight-600 mb-2">
                Android
              </h2>
              <p class="text-muted">
                Android APK is ready. play store in process
              </p>
              <a href="{{ asset("download/apk/app-release.apk") }}" target="_blank" class="btn btn-success mb-2">
                Android APK
              </a>
              <a href="{{ url("https://play.google.com/store/apps/details?id=net.ijool.v2") }}" target="_blank" class="btn btn-primary mb-2">
                Google Play
              </a>
              <div class="row">
                <div class="col-md-4">
                  <img src="{{ asset("img/apk/image6.jpg") }}" alt="..." class="img-fluid mb-2" style="height:400px">
                </div>
                <div class="col-md-4">
                  <img src="{{ asset("img/apk/image5.jpg") }}" alt="..." class="img-fluid mb-2" style="height:400px">
                </div>
                <div class="col-md-4">
                  <img src="{{ asset("img/apk/image4.jpg") }}" alt="..." class="img-fluid mb-2" style="height:400px">
                </div>
                <div class="col-md-3">
                  <img src="{{ asset("img/apk/image3.jpg") }}" alt="..." class="img-fluid mb-2" style="height:400px">
                </div>
                <div class="col-md-3">
                  <img src="{{ asset("img/apk/image2.jpg") }}" alt="..." class="img-fluid mb-2" style="height:400px">
                </div>
                <div class="col-md-3">
                  <img src="{{ asset("img/apk/image1.jpg") }}" alt="..." class="img-fluid mb-2" style="height:400px">
                </div>
                <div class="col-md-3">
                  <img src="{{ asset("img/apk/image0.jpg") }}" alt="..." class="img-fluid mb-2" style="height:400px">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection