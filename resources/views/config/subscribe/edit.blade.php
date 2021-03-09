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
      <div class="header-icon text-success mr-3"><i class="fas fa-wrench text-warning"></i></div>
      <div class="media-body">
        <h1 class="font-weight-bold">List Subscribe</h1>
        <small>List User Subscription</small>
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
              <h6 class="fs-17 font-weight-600 mb-0">Edit Subscribe</h6>
            </div>
          </div>
        </div>
        <form method="post" action="{{ route("subscribe.config.update") }}">
          @csrf
          <div class="card-body">
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="font-weight-600">Subscribe Price</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">Rp</span>
                    </div>
                    <input type="text" class="form-control @error('price') is-invalid @enderror" name="price" placeholder="Price (IDR)"
                           value="{{ old("price") ?? number_format($settingSubscribe->idr, 0, ".", ".") }}">
                    <div class="input-group-append">
                      <span class="input-group-text">.00</span>
                    </div>
                  </div>
                  @error('price')
                  <div class="invalid-feedback text-left">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label class="font-weight-600">Share</label>
                  <div class="input-group">
                    <input type="text" class="form-control @error('share') is-invalid @enderror" name="share" placeholder="Share Amount (%)"
                           value="{{ old("share") ?? $settingSubscribe->share * 100 }}">
                    <div class="input-group-append">
                      <span class="input-group-text">%</span>
                    </div>
                  </div>
                  @error('share')
                  <div class="invalid-feedback text-left">{{ $message }}</div>
                  @enderror
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <button type="submit" class="btn btn-success rounded-pill">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection