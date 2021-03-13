@extends("layouts.app")

@section("title")
  <nav aria-label="breadcrumb" class="col-sm-4 order-sm-last mb-3 mb-sm-0 p-0 ">
    <ol class="breadcrumb d-inline-flex font-weight-600 fs-13 bg-white mb-0 float-sm-right">
      <li class="breadcrumb-item"><a href="{{ route("dashboard.index") }}">Dashboard</a></li>
      <li class="breadcrumb-item active">Mining</li>
    </ol>
  </nav>
  <div class="col-sm-8 header-title p-0">
    <div class="media">
      <div class="header-icon text-success mr-3"><i class="fas fa-paw text-warning"></i></div>
      <div class="media-body">
        <h1 class="font-weight-bold">Mining</h1>
        <small>IJOOL.NET is only a tool to facilitate users of using <a href="{{ url("999doge.com") }}">999doge.com</a></small>
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
            <i class="fas fa-paw"></i>
          </div>
          <p class="card-category text-uppercase fs-10 font-weight-bold text-muted">Your Balance</p>
          <h3 class="card-title fs-18 font-weight-bold">
            <label id="balanceDoge">0</label>
            <small>DOGE</small>
          </h3>
        </div>
        <div class="card-footer p-3 row">
          <div class="col-md-6">
            <button id="loadBalanceDoge" type="button" class="btn btn-primary btn-block w-100p mb-2">Load Balance</button>
          </div>
          <div class="col-md-6">
            <button data-toggle="modal" data-target="#modal_withdraw_bot" type="button" class="btn btn-danger btn-block w-100p mb-2">Send Balance To Bot</button>
          </div>
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
            <label id="balanceBot">0</label>
            <small>DOGE</small>
          </h3>
        </div>
        <div class="card-footer p-3 row">
          <div class="col-md-6">
            <button id="loadBalanceBot" type="button" class="btn btn-primary btn-block w-100p mb-2">Load Balance</button>
          </div>
          <div class="col-md-6">
            <button data-toggle="modal" data-target="#modal_withdraw_doge" type="button" class="btn btn-danger btn-block w-100p mb-2">Send Balance To Wallet</button>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-12">
      <div class="form-group">
        <label for="value" class="font-weight-600">Default Mining Size</label>
        <input type="number" class="form-control" id="valueDefault" placeholder="Enter default Mining size" value="0.01">
        <small class="form-text text-muted">Application recommendation 0.01.</small>
      </div>
    </div>
    <div class="col-md-12">
      <div id="currentBalance" class="d-flex flex-column p-3 mb-3 bg-white shadow-sm rounded">
        <div class="header-pretitle text-muted fs-11 font-weight-bold text-uppercase mb-2">Current Balance</div>
        <div class="d-flex align-items-center text-size-3">
          <i class="fas fa fa-paw opacity-25 mr-2"></i>
          <div class="text-monospace">
            <span id="amount" class="text-size-1">0</span> DOGE
          </div>
          <div id="status"></div>
        </div>
      </div>
    </div>
    <div class="col-md-12">
      <button id="onBet" type="button" class="btn btn-warning btn-block mb-2">Mining</button>
    </div>
    <div class="col-md-6">
      <div id="bet" class="card">
        <div class="card-header">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <h6 class="fs-17 font-weight-600 mb-0">Mining Size Setup</h6>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="form-group">
            <label for="value" class="font-weight-600">Mining Size</label>
            <input type="number" class="form-control" id="value" placeholder="Enter Mining size" value="0.01">
          </div>
          <div class="row">
            <div class="col-md-4">
              <button id="reset" type="button" class="btn btn-inverse rounded-pill btn-block mb-2">Reset</button>
            </div>
            <div class="col-md-4">
              <button id="double" type="button" class="btn btn-danger rounded-pill btn-block mb-2">Double</button>
            </div>
            <div class="col-md-4">
              <button id="half" type="button" class="btn btn-warning rounded-pill btn-block mb-2">Half</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div id="chance" class="card">
        <div class="card-header">
          <div class="d-flex justify-content-between align-items-center">
            <div>
              <h6 class="fs-17 font-weight-600 mb-0">Chance to win (%)</h6>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="form-group">
            <label for="value" class="font-weight-600">Chance</label>
            <input type="number" class="form-control" id="value" placeholder="Enter Chance" value="49.95">
            <small class="form-text text-muted">Application recommends do not change the chance of winning.</small>
          </div>
          <div class="row">
            <div class="col-md-4">
              <button id="reset" type="button" class="btn btn-inverse rounded-pill btn-block mb-2">Reset</button>
            </div>
            <div class="col-md-4">
              <button id="double" type="button" class="btn btn-danger rounded-pill btn-block mb-2">Double</button>
            </div>
            <div class="col-md-4">
              <button id="half" type="button" class="btn btn-warning rounded-pill btn-block mb-2">Half</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section("addJs")
  <script>
    $(function () {
      let currentBalance = 0;
      let oldBalance = 0;
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
          $("#currentBalance #amount").text(response.balance);
          currentBalance = response.balance;
          oldBalance = response.balance;
        }).fail((e) => {
          toastr.error(e.responseJSON.message);
        }).always(function () {
          $("#loadBalanceBot").text("Load Balance");
        });
      });

      $("#onBet").on("click", function () {
        let bot = $("#onBet");
        bot.text("please wait...");
        bot.prop('disabled', true);
        $.ajax("{{ route("doge.bet.store") }}", {
          method: 'POST',
          headers: {
            "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr('content'),
            "X-Requested-With": "XMLHttpRequest",
          },
          data: {
            high: $("#chance #value").val(),
            bet: $("#bet #value").val(),
          }
        }).done(async function (response) {
          response = await response;
          if (response.code === 200) {
            $("#currentBalance #amount").text(response.profitBalance);
            if (response.profit > 0) {
              $("#currentBalance #status").html('<i class="fas fa fa-arrow-up text-primary ml-2"></i>');
            } else {
              $("#currentBalance #status").html('<i class="fas fa fa-arrow-down text-danger ml-2"></i>');
            }
          } else {
            toastr.error(response.message);
          }
        }).fail((e) => {
          console.log(e.responseJSON.message);
          toastr.error(e.responseJSON.message);
        }).always(function () {
          $("#onBet").text("Mining");
          bot.prop('disabled', false);
        })
      });

      $("#valueDefault").change(function () {
        $("#bet #value").val($("#valueDefault").val());
      });

      $("#bet #reset").on("click", function () {
        $("#bet #value").val($("#valueDefault").val());
      });
      $("#bet #double").on("click", function () {
        let value = $("#bet #value");
        value.val(value.val() * 2);
      });
      $("#bet #half").on("click", function () {
        let value = $("#bet #value");
        value.val(value.val() / 2);
      });

      $("#chance #reset").on("click", function () {
        $("#chance #value").val("49.95");
      });
      $("#chance #double").on("click", function () {
        let value = $("#chance #value");
        value.val((value.val() * 2).toFixed(2));
      });
      $("#chance #half").on("click", function () {
        let value = $("#chance #value");
        value.val((value.val() / 2).toFixed(2));
      });
    });
  </script>
@endsection