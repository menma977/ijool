@extends("layouts.app")

@section("title")
  <nav aria-label="breadcrumb" class="col-sm-4 order-sm-last mb-3 mb-sm-0 p-0 ">
    <ol class="breadcrumb d-inline-flex font-weight-600 fs-13 bg-white mb-0 float-sm-right">
      <li class="breadcrumb-item"><a href="#">Home</a></li>
      <li class="breadcrumb-item"><a href="#">Page</a></li>
      <li class="breadcrumb-item active">Blank</li>
    </ol>
  </nav>
  <div class="col-sm-8 header-title p-0">
    <div class="media">
      <div class="header-icon text-success mr-3"><i class="typcn typcn-puzzle-outline"></i></div>
      <div class="media-body">
        <h1 class="font-weight-bold">Blank Page</h1>
        <small>From now on you will start your activities.</small>
      </div>
    </div>
  </div>
@endsection

@section("content")
  <div class="card mb-4">
    <div class="card-body">
      <div id="apexCandlestickCharts"></div>
    </div>
  </div>
@endsection

@section("addJs")
  <script src="{{ asset("plugins/apexcharts/dist/apexcharts.min.js") }}"></script>
  <script>
    const oldData = @json($marketPrice);
    $(function () {
      const defaultData = {
        chart: {
          height: 350,
          type: 'candlestick'
        },
        series: [{
          data: oldData
        }],
        title: {
          text: 'Doge Price',
          align: 'left'
        },
        yaxis: {
          tooltip: {
            enabled: true
          }
        },
      };

      const chart = new ApexCharts(document.querySelector("#apexCandlestickCharts"), defaultData);
      chart.render();

      setInterval(async function () {
        await fetch("{{ route("dashboard.candle", null) }}", {
          method: 'GET',
          headers: new Headers({
            'Content-Type': 'application/x-www-form-urlencoded',
            "X-CSRF-TOKEN": $("input[name='_token']").val()
          })
        }).then((response) => response.json()).then((response) => {
          oldData.shift();
          oldData.push(response);
          chart.updateSeries([{
            data: oldData
          }]);
        }).catch((e) => {
          console.log(e);
        })
      }, 10000);
    })
    ;
  </script>
@endsection