@extends("layouts.app")

@section("content")
  <div class="row">
    <div class="col-sm-12 col-xl-8">
      <div class="media d-flex m-1 ">
        <div class="align-left p-1">
          <a href="#" class="profile-image">
            <img src="{{ $user->profile->image ? asset("storage/profile/".$user->profile->image) : asset("dist/img/logo_bg.png") }}" class="avatar avatar-xl rounded-circle img-border height-100"
                 alt="{{ $user->name }}">
          </a>
        </div>
        <div class="media-body text-left ml-3 mt-1">
          <h3 class="font-large-1 white">{{ $user->name }}
          </h3>
          <p class="white">
            <i class="fas fa-map-marker-alt"></i> {{ $user->profile->city }}, {{ $user->profile->country }}
          </p>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12 m-2 row">
      <div class="col-md-3">
        <a href="{{ route("doge.history", ["income", "internal", "-", $user->doge->cookie]) }}" class="btn btn-success w-100 mb-2 mr-1">Income Internal</a>
      </div>
      <div class="col-md-3">
        <a href="{{ route("doge.history", ["income", "external", "-", $user->doge->cookie]) }}" class="btn btn-success w-100 mb-2 mr-1">Income External</a>
      </div>
      <div class="col-md-3">
        <a href="{{ route("doge.history", ["outcome", "internal", "-", $user->doge->cookie]) }}" class="btn btn-danger w-100 mb-2 mr-1">Outcome Internal</a>
      </div>
      <div class="col-md-3">
        <a href="{{ route("doge.history", ["outcome", "external", "-", $user->doge->cookie]) }}" class="btn btn-danger w-100 mb-2 mr-1">Outcome External</a>
      </div>
    </div>
    <div class="col-md-6">
      <div id="wallet" class="form-group">
        <label class="font-weight-600">Wallet Deposit</label>
        <div class="input-group mb-3">
          <div class="form-control" id="wallet-deposit">{{ $user->doge->wallet }}</div>
          <div class="input-group-append">
            <button class="btn btn-primary copy" type="button" data-copy="wallet-deposit">Copy</button>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div id="wallet" class="form-group">
        <label class="font-weight-600">Wallet Bot</label>
        <div class="input-group mb-3">
          <div class="form-control" id="wallet-bot">{{ $user->trading->wallet }}</div>
          <div class="input-group-append">
            <button class="btn btn-primary copy" type="button" data-copy="wallet-bot">Copy</button>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card card-stats statistic-box mb-4">
        <div class="card-header card-header-warning card-header-icon position-relative border-0 text-right px-3 py-0">
          <div class="card-icon d-flex align-items-center justify-content-center">
            <i class="fas fa-paw"></i>
          </div>
          <p class="card-category text-uppercase fs-10 font-weight-bold text-muted">Your Balance</p>
          <h3 class="card-title fs-18 font-weight-bold">
            <label id="balanceDoge" class="dogeBalance">-</label>
            <small>DOGE</small>
          </h3>
        </div>
        <div class="card-footer p-3">
          <button id="loadBalanceDoge" type="button" class="btn btn-primary btn-block w-100p">Load Balance</button>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="card card-stats statistic-box mb-4">
        <div class="card-header card-header-success card-header-icon position-relative border-0 text-right px-3 py-0">
          <div class="card-icon d-flex align-items-center justify-content-center">
            <i class="fas fa-rocket"></i>
          </div>
          <p class="card-category text-uppercase fs-10 font-weight-bold text-muted">BOT Balance</p>
          <h3 class="card-title fs-18 font-weight-bold">
            <label id="balanceBot" class="botBalance">-</label>
            <small>DOGE</small>
          </h3>
        </div>
        <div class="card-footer p-3">
          <button id="loadBalanceBot" type="button" class="btn btn-primary btn-block w-100p">Load Balance</button>
        </div>
      </div>
    </div>
    <div class="{{ $lines->count() ? "col-lg-4" : "col-lg-12" }}">
      <div class="card mb-4">
        <div class="card-body">
          <div class="row align-items-center">
            <div class="col">
              <h6 class="mb-0 font-weight-600">name</h6>
            </div>
            <div class="col-auto">
              <time class="fs-13 font-weight-600 text-muted" datetime="1988-10-24">{{ $user->name }}</time>
            </div>
          </div>
          <hr>
          <div class="row align-items-center">
            <div class="col">
              <h6 class="mb-0 font-weight-600">username</h6>
            </div>
            <div class="col-auto">
              <time class="fs-13 font-weight-600 text-muted" datetime="2018-10-28">{{ $user->username }}</time>
            </div>
          </div>
          <hr>
          <div class="row align-items-center">
            <div class="col">
              <h6 class="mb-0 font-weight-600">email</h6>
            </div>
            <div class="col-auto">
              <span class="fs-13 font-weight-600 text-muted">{{ $user->email }}</span>
            </div>
          </div>
          <hr>
          <div class="row align-items-center">
            <div class="col">
              <h6 class="mb-0 font-weight-600">created at</h6>
            </div>
            <div class="col-auto">
              <span class="fs-13 font-weight-600 text-muted">{{ $user->created_at }}</span>
            </div>
          </div>
        </div>
      </div>
      <div class="card mb-4">
        <div class="card-header">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <h6 class="fs-17 font-weight-600 mb-0">Subscription</h6>
            </div>
          </div>
        </div>
        <div class="card-body">
          @foreach ($subscribe as $item)
            <div class="row mb-3">
              <div class="col-9">
                <div class="progress-wrapper">
                  <span class="progress-label {{ $item->is_finished ? "text-danger" : "text-warning" }}">{{ $item->label }}</span>
                  <div class="progress mt-1 mb-2" style="height: 5px;">
                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: {{ $item->progress }}%;"></div>
                  </div>
                </div>
              </div>
              <div class="col-3 align-self-end text-right">
                <span class="h6 mb-0">{{ $item->progress }}%</span>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>
    @if($lines->count())
      <div class="col-lg-8">
        <div class="card">
          <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <h6 class="fs-17 font-weight-600 mb-0">Your Mate</h6>
              </div>
            </div>
          </div>
          <div class="list-group list-group-flush">
            @foreach ($lines as $item)
              <div class="list-group-item list-group-item-action">
                <div class="d-flex align-items-center" data-toggle="tooltip" data-placement="right" data-title="2 hrs ago" data-original-title="" title="">
                  <div>
                    @if($item->user->profile->image)
                      <img src="{{ asset("storage/profile/".$item->user->profile->image) }}" class="avatar bg-success text-white rounded-circle" alt="{{ $item->user->name }}">
                    @else
                      <div class="avatar bg-success text-white rounded-circle">{{ substr($item->user->name, 0, 2) }}</div>
                    @endif
                  </div>
                  <div class="flex-fill ml-3">
                    <h6 class="fs-15 font-weight-600 mb-0">
                      {{ $item->user->name }}
                      <small class="float-right text-muted">
                        {{ \Carbon\Carbon::parse($item->user->created_at)->diffInDays(\Carbon\Carbon::now()) }} Day
                      </small>
                    </h6>
                    <p class="mb-0">{{ $item->user->email }}</p>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
          <div class="card-footer py-2 text-center">
            <a href="#" class="text-muted font-weight-bold">See all notifications</a>
          </div>
        </div>
      </div>
    @endif
  </div>
@endsection

@section("addJs")
  <script>
    $(function () {
      $("#loadBalanceDoge").on("click", function () {
        $("#loadBalanceDoge").text("please wait...");
        let url = "{{ route("user.balance.doge", "%data%") }}";
        url = url.replace('%data%', "{{ \Illuminate\Support\Facades\Crypt::encryptString($user->id) }}");
        $.ajax(url, {
          method: 'GET',
          headers: {
            "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr('content'),
            "X-Requested-With": "XMLHttpRequest",
          }
        }).done(async function (response) {
          response = await response;
          console.log(response);
          $("#balanceDoge").text(response.balance);
        }).fail((e) => {
          toastr.error(e.responseJSON.message);
        }).always(function () {
          $("#loadBalanceDoge").text("Load Balance");
        });
      });

      $("#loadBalanceBot").on("click", function () {
        $("#loadBalanceBot").text("please wait...");
        let url = "{{ route("user.balance.bot", "%data%") }}";
        url = url.replace('%data%', "{{ \Illuminate\Support\Facades\Crypt::encryptString($user->id) }}");
        $.ajax(url, {
          method: 'GET',
          headers: {
            "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr('content'),
            "X-Requested-With": "XMLHttpRequest",
          }
        }).done(async function (response) {
          response = await response;
          $("#balanceBot").text(response.balance);
        }).fail((e) => {
          toastr.error(e.responseJSON.message);
        }).always(function () {
          $("#loadBalanceBot").text("Load Balance");
        });
      });
    });
  </script>
@endsection