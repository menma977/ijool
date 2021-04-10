@extends("layouts.app")

@section("title")
  <nav aria-label="breadcrumb" class="col-sm-4 order-sm-last mb-3 mb-sm-0 p-0 ">
    <ol class="breadcrumb d-inline-flex font-weight-600 fs-13 bg-white mb-0 float-sm-right">
      <li class="breadcrumb-item"><a href="{{ route("dashboard.index") }}">Dashboard</a></li>
      <li class="breadcrumb-item">History</li>
      <li class="breadcrumb-item">{{ $type }}</li>
      <li class="breadcrumb-item active">{{ $target }}</li>
    </ol>
  </nav>
  <div class="col-sm-8 header-title p-0">
    <div class="media">
      <div class="header-icon text-success mr-3"><i class="fas fa-donate text-warning"></i></div>
      <div class="media-body">
        <h1 class="font-weight-bold">History {{ $type }} {{ $target }}</h1>
      </div>
    </div>
  </div>
@endsection

@section("content")
  <div class="row">
    @if($next)
      <div class="col-sm-12 p-2">
        <a href="{{ route("doge.history", [$type, $target]) }}">
          <button type="button" class="btn btn-labeled btn-info mb-2 mr-1">
            <span class="btn-label"><i class="fas fa-redo-alt"></i></span>Refresh
          </button>
        </a>
        <a href="{{ route("doge.history", [$type, $target, $next]) }}">
          <button type="button" class="btn btn-labeled btn-primary mb-2 mr-1">
            <span class="btn-label"><i class="fas fa-chevron-right"></i></span>Next
          </button>
        </a>
      </div>
    @endif
    <div class="col-lg-12">
      <div class="table-responsive">
        <table class="table table-striped text-center">
          <thead>
          <tr>
            @if($type == "income")
              <th scope="col">Date</th>
            @else
              <th scope="col">Date</th>
              <th scope="col">Completed At</th>
            @endif
            <th scope="col">Address</th>
            @if($target == "external")
              <th scope="col">HASH</th>
            @endif
            <th scope="col">Amount</th>
          </tr>
          </thead>
          <tbody>
          @foreach($lists as $list)
            <tr>
              @if($type == "income")
              <td>{{ \Carbon\Carbon::parse($list["Date"])->format("Y-m-d H:i:s") }}</td>
              @else
              <td>{{ \Carbon\Carbon::parse($list["Requested"])->format("Y-m-d H:i:s") }}</td>
              <td>{{ \Carbon\Carbon::parse($list["Completed"])->format("Y-m-d H:i:s") }}</td>
              @endif
              <td>{{ $list["Address"] }}</td>
              @if($target == "external")
                <td>{{ $list["TransactionHash"] }}</td>
              @endif
              <td>{{ round($list["Value"] / 10 ** 8, 8) }} {{ $list["Currency"] }}</td>
            </tr>
          @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection

@section("addCss")
  <link href="{{ asset("plugins/bootstrap-social/bootstrap-social.css") }}" rel="stylesheet">
@endsection