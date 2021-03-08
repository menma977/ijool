@extends("layouts.app")

@section("title")
  <nav aria-label="breadcrumb" class="col-sm-4 order-sm-last mb-3 mb-sm-0 p-0 ">
    <ol class="breadcrumb d-inline-flex font-weight-600 fs-13 bg-white mb-0 float-sm-right">
      <li class="breadcrumb-item active">Dashboard</li>
    </ol>
  </nav>
  <div class="col-sm-8 header-title p-0">
    <div class="media">
      <div class="header-icon text-success mr-3"><i class="fas fa-paw text-warning"></i></div>
      <div class="media-body">
        <h1 class="font-weight-bold">Current Price</h1>
        <small>application retrieves doge data from <a href="{{ url("https://indodax.com/") }}">indodax.com</a></small>
      </div>
    </div>
  </div>
@endsection

@section("content")
  <div class="row">
    <div class="col-md-6">
      <div class="card card-stats statistic-box mb-4">
        <div class="card-header card-header-warning card-header-icon position-relative border-0 text-right px-3 py-0">
          <div class="card-icon d-flex align-items-center justify-content-center">
            <i class="fas fa-dollar-sign"></i>
          </div>
          <p class="card-category text-uppercase fs-10 font-weight-bold text-muted">Your Balance</p>
          <h3 class="card-title fs-18 font-weight-bold">
            <label class="dogeBalance">-</label>
            <small>DOGE</small>
          </h3>
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
            <label class="botBalance">-</label>
            <small>DOGE</small>
          </h3>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div id="wallet" class="form-group">
        <label class="font-weight-600">Wallet Deposit</label>
        <div class="input-group mb-3">
          <div class="form-control" id="wallet-deposit">{{ Auth::user()->doge->wallet }}</div>
          <div class="input-group-append">
            <button class="btn btn-primary copy" type="button" data-copy="wallet-deposit">Copy</button>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div id="share" class="form-group">
        <label class="font-weight-600">Share Link</label>
        <div class="input-group mb-3">
          <div class="form-control" id="share-link">{{ route("register-voucher", Auth::user()->code) }}</div>
          <div class="input-group-append">
            <button class="btn btn-primary copy" type="button" data-copy="share-link">Copy</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card mb-4">
        <div class="card-body">
          <div class="row">
            <div class="col-md-6">
              <div class="d-flex flex-column p-3 mb-3 bg-white">
                <div class="header-pretitle text-muted fs-11 font-weight-bold text-uppercase mb-2">Low</div>
                <div class="d-flex align-items-center text-size-3">
                  <i class="fas fa-dollar-sign opacity-25 mr-2"></i>
                  <div class="text-monospace">
                    <span id="low" class="text-size-2 ">0</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="d-flex flex-column p-3 mb-3 bg-white">
                <div class="header-pretitle text-muted fs-11 font-weight-bold text-uppercase mb-2">High</div>
                <div class="d-flex align-items-center text-size-3">
                  <i class="fas fa-dollar-sign opacity-25 mr-2"></i>
                  <div class="text-monospace">
                    <span id="high" class="text-size-2 ">0</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="progress progress-lg">
            <div id="progress" class="progress-bar progress-bar-warning progress-bar-striped active" role="progressbar"
                 aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 0">
              0 (0%)
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-12">
      <div class="row">
        <div class="col-md-4">
          <div id="lastPrice" class="card card-stats statistic-box mb-4">
            <div class="card-header card-header-info card-header-icon position-relative border-0 text-right px-3 py-0">
              <div class="card-icon d-flex align-items-center justify-content-center">
                <i class="fas fa-dollar-sign"></i>
              </div>
              <p class="card-category text-uppercase fs-10 font-weight-bold text-muted">Last Price</p>
              <h3 id="price" class="card-title fs-14 font-weight-bold pb-4 pt-2">0</h3>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div id="buyPrice" class="card card-stats statistic-box mb-4">
            <div class="card-header card-header-success card-header-icon position-relative border-0 text-right px-3 py-0">
              <div class="card-icon d-flex align-items-center justify-content-center">
                <i class="fas fa-dollar-sign"></i>
              </div>
              <p class="card-category text-uppercase fs-10 font-weight-bold text-muted">Buy Price</p>
              <h3 id="price" class="card-title fs-14 font-weight-bold pb-4 pt-2">0</h3>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div id="sellPrice" class="card card-stats statistic-box mb-4">
            <div class="card-header card-header-danger card-header-icon position-relative border-0 text-right px-3 py-0">
              <div class="card-icon d-flex align-items-center justify-content-center">
                <i class="fas fa-dollar-sign"></i>
              </div>
              <p class="card-category text-uppercase fs-10 font-weight-bold text-muted">Sell Price</p>
              <h3 id="price" class="card-title fs-14 font-weight-bold pb-4 pt-2">0</h3>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section("addJs")
  <script>
    $(() => {
      $(".copy").on("click", (e) => {
        const el = $(e.target);
        let temp = $("<input>");
        $("body").append(temp);
        temp.val($(`#${(el.data("copy"))}`).text()).select();
        document.execCommand("copy");
        temp.remove();
      });

      startLive();

      interval = setInterval(function () {
        startLive();
      }, 60000);

      window.onbeforeunload = function () {
        clearInterval(interval);
      };


      function startLive() {
        $.ajax("{{ route("dashboard.candle", null) }}", {
          method: 'GET',
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
            "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr('content'),
            "pragma": 'no-cache',
            "cache-control": 'no-cache',
            "X-Requested-With": "XMLHttpRequest",
          }
        }).done(async function (response) {
          response = await response
          $("#lastPrice #price").text(response.last);
          $("#buyPrice #price").text(response.buy);
          $("#sellPrice #price").text(response.sell);
          const currentPrice = response.last;
          const highPrice = response.high - response.low;
          const lowPrice = currentPrice - response.low;
          const progress = (lowPrice / highPrice) * 100;
          $("#progress").text(response.last + " (" + progress.toFixed(2) + "%)").width(progress + "%");
          $("#high").text(response.high);
          $("#low").text(response.low);
        }).fail((e) => {
          console.log(e);
        });
      }
    });
  </script>
@endsection
