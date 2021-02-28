@extends("layouts.app")

@section("title")
<nav aria-label="breadcrumb" class="col-sm-4 order-sm-last mb-3 mb-sm-0 p-0 ">
  <ol class="breadcrumb d-inline-flex font-weight-600 fs-13 bg-white mb-0 float-sm-right">
    <li class="breadcrumb-item active">Dashboard</li>
  </ol>
</nav>
<div class="col-sm-8 header-title p-0">
  <div class="media">
    <div class="header-icon text-success mr-3"><i class="fas fa-paw"></i></div>
    <div class="media-body">
      <h1 class="font-weight-bold">Current Price</h1>
      <small>application retrieves doge data from <a href="{{ url("https://indodax.com/") }}">indodax.com</a></small>
    </div>
  </div>
</div>
@endsection

@section("content")
<button id="startChart" type="button"
  class="btn btn-warning-soft btn-block rounded-pill w-100p mb-2 mr-1">Start</button>
<div class="row">
  <div class="col-md-12">
    <div class="card mb-4">
      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
            <div class="d-flex flex-column p-3 mb-3 bg-white">
              <div class="header-pretitle text-muted fs-11 font-weight-bold text-uppercase mb-2">High</div>
              <div class="d-flex align-items-center text-size-3">
                <i class="fas fa-paw opacity-25 mr-2"></i>
                <div id="high" class="text-monospace">
                  <span class="text-size-2 ">0</span> DOGE
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="d-flex flex-column p-3 mb-3 bg-white">
              <div class="header-pretitle text-muted fs-11 font-weight-bold text-uppercase mb-2">Low</div>
              <div class="d-flex align-items-center text-size-3">
                <i class="fas fa-paw opacity-25 mr-2"></i>
                <div id="low" class="text-monospace">
                  <span class="text-size-2 ">0</span> DOGE
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="progress progress-lg">
          <div id="progress" class="progress-bar progress-bar-warning progress-bar-striped active" role="progressbar"
            aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 0">
            0 DOGE (0%)
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
              <i class="fas fa-paw"></i>
            </div>
            <p class="card-category text-uppercase fs-10 font-weight-bold text-muted">Last Price</p>
            <h3 id="price" class="card-title fs-14 font-weight-bold pb-4 pt-2">0 DOGE</h3>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div id="buyPrice" class="card card-stats statistic-box mb-4">
          <div class="card-header card-header-success card-header-icon position-relative border-0 text-right px-3 py-0">
            <div class="card-icon d-flex align-items-center justify-content-center">
              <i class="fas fa-paw"></i>
            </div>
            <p class="card-category text-uppercase fs-10 font-weight-bold text-muted">Buy Price</p>
            <h3 id="price" class="card-title fs-14 font-weight-bold pb-4 pt-2">0 DOGE</h3>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div id="sellPrice" class="card card-stats statistic-box mb-4">
          <div class="card-header card-header-danger card-header-icon position-relative border-0 text-right px-3 py-0">
            <div class="card-icon d-flex align-items-center justify-content-center">
              <i class="fas fa-paw"></i>
            </div>
            <p class="card-category text-uppercase fs-10 font-weight-bold text-muted">Sell Price</p>
            <h3 id="price" class="card-title fs-14 font-weight-bold pb-4 pt-2">0 DOGE</h3>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<canvas id="livePriceChart" height="80"></canvas>
@endsection

@section("addJs")
{{--  chart js--}}
<script src="{{ asset("plugins/chartJs/Chart.min.js") }}"></script>
{{--  apexcharts--}}
<script src="{{ asset("plugins/apexcharts/dist/apexcharts.min.js") }}"></script>
<script>
  const last = @json($last);
    const buy = @json($buy);
    const sell = @json($sell);
    $(() => {
      const liveChart = new Chart($("#livePriceChart"), {
        type: 'line',
        data: {
          labels: @json($index),
          datasets: [
            {
              label: "Last",
              borderColor: "#00acc1",
              fill: false,
              borderWidth: 2,
              pointRadius: 0,
              pointHitRadius: 0,
              data: last
            },
            {
              label: "Buy",
              borderColor: "#288c6c",
              fill: false,
              borderWidth: 2,
              pointRadius: 0,
              pointHitRadius: 0,
              data: buy
            },
            {
              label: "Sell",
              borderColor: "#d22824",
              fill: false,
              borderWidth: 2,
              pointRadius: 0,
              pointHitRadius: 0,
              data: sell
            }
          ]
        },
        options: {
          legend: false,
          scales: {
            yAxes: [{
              gridLines: {
                color: "#e6e6e6",
                zeroLineColor: "#e6e6e6",
                borderDash: [2],
                borderDashOffset: [2],
                drawBorder: true,
                drawTicks: true
              },
              ticks: {
                padding: 20
              }
            }],

          }
        }
      });

      setInterval(function () {
        $.ajax("{{ route("dashboard.candle", null) }}", {
          method: 'GET',
          headers: new Headers({
            'Content-Type': 'application/x-www-form-urlencoded',
            "X-CSRF-TOKEN": $("input[name='_token']").val(),
            "pragma": 'no-cache',
            "cache-control": 'no-cache',
          })
        }).done(async function(response) {
          response = await response
          last.shift();
          last.push(response.last);
          buy.shift();
          buy.push(response.buy);
          sell.shift();
          sell.push(response.sell);
          liveChart.update();
          $("#lastPrice #price").html(response.last + " DOGE");
          $("#buyPrice #price").html(response.buy + " DOGE");
          $("#sellPrice #price").html(response.sell + " DOGE");
          const currentPrice = response.last;
          const highPrice = response.high - response.low;
          const lowPrice = currentPrice - response.low;
          const progress = (lowPrice / highPrice) * 100;
          $("#progress").html(response.last + " DOGE (" + progress.toFixed(2) + "%)").width(progress + "%");
          $("#high").html('<span class="text-size-2 ">' + response.high + '</span> DOGE');
          $("#low").html('<span class="text-size-2 ">' + response.low + '</span> DOGE');
        }).fail((e) => {
          console.log(e);
        })
      }, 1000);
    });
</script>
@endsection
