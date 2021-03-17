@extends("layouts.app")

@section("title")
  <nav aria-label="breadcrumb" class="col-sm-4 order-sm-last mb-3 mb-sm-0 p-0 ">
    <ol class="breadcrumb d-inline-flex font-weight-600 fs-13 bg-white mb-0 float-sm-right">
      <li class="breadcrumb-item"><a href="{{ route("dashboard.index") }}">Dashboard</a></li>
      <li class="breadcrumb-item active">Withdraw</li>
    </ol>
  </nav>
  <div class="col-sm-8 header-title p-0">
    <div class="media">
      <div class="header-icon text-success mr-3"><i class="fas fa-store text-warning"></i></div>
      <div class="media-body">
        <h1 class="font-weight-bold">Withdraw</h1>
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
            <i class="fas fa-paw"></i>
          </div>
          <p class="card-category text-uppercase fs-10 font-weight-bold text-muted">Your Balance</p>
          <h3 class="card-title fs-18 font-weight-bold">
            <label class="dogeBalance">-</label>
            <small>DOGE</small>
          </h3>
        </div>
      </div>
    </div>
    <div class="col-md-12">
      <div class="card mb-4">
        <div class="card-header">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <h6 class="fs-17 font-weight-600 mb-0">Withdraw Form</h6>
            </div>
          </div>
        </div>
        <form method="POST" action="{{ route("doge.withdraw.store") }}">
          @csrf
          <div class="card-body">
            <div class="form-group">
              <label for="amount" class="font-weight-600">Amount</label>
              <input type="number" class="form-control @error("amount") is-invalid @enderror" id="amount" name="amount" placeholder="Enter Amount">
              <small id="emailHelp" class="form-text text-muted">Fee for outward application is 5 doge.</small>
              @error("amount")
              <small id="emailHelp" class="form-text text-danger">{{ $message }}</small>
              @enderror
            </div>
            <div class="form-group">
              <label for="wallet" class="font-weight-600">Wallet</label>
              <input type="text" class="form-control @error("wallet") is-invalid @enderror" id="wallet" name="wallet" placeholder="Enter Wallet">
              @error("wallet")
              <small id="emailHelp" class="form-text text-danger">{{ $message }}</small>
              @enderror
            </div>
          </div>
          <div class="card-footer">
            <button type="submit" class="btn btn-success">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection