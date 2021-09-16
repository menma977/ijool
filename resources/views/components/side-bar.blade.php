<x-modal/>
<nav class="sidebar sidebar-bunker">
  <div class="sidebar-header">
    <a href="#" class="logo text-white"><span>IJOOL</span>.net</a>
  </div>
  <!--/.sidebar header-->
  <div class="profile-element d-flex align-items-center flex-shrink-0">
    <div class="avatar online">
      <img src="{{ $user->profile->image ? asset("storage/profile/".$user->profile->image) : asset("dist/img/logo_bg.png") }}" class="img-fluid rounded-circle" alt="">
    </div>
    <div class="profile-text">
      <h6 class="m-0">{{ $user->name }}</h6>
      <span>{{ $user->code }}</span>
    </div>
  </div>
{{--  <div class="search sidebar-form">--}}
{{--    <div class="search__inner">--}}
{{--      @if($user->subscribe)--}}
{{--        <button type="button" class="btn btn-warning btn-block rounded-pill" id="unsubscribe">--}}
{{--          unsubscribe--}}
{{--        </button>--}}
{{--      @else--}}
{{--        <button type="button" class="btn btn-danger btn-block rounded-pill" data-toggle="modal" data-target="#modal_subscribe">--}}
{{--          subscribe--}}
{{--        </button>--}}
{{--      @endif--}}
{{--    </div>--}}
{{--  </div>--}}
  <div class="sidebar-body">
    <nav class="sidebar-nav">
      <ul class="metismenu">
        <li class="nav-label">Main Menu</li>
        <li class="{{ request()->is(["dashboard"]) ? "mm-active" : "" }}">
          <a href="{{ route("dashboard.index") }}">
            <i class="typcn typcn-home-outline mr-2"></i> Dashboard
          </a>
        </li>
        <li class="{{ request()->is(["pin/*", "pin"]) ? "mm-active" : "" }}">
          <a href="{{ route("pin.index") }}">
            <i class="fas fa-parking mr-2"></i> Pin
          </a>
        </li>
        @can("Admin")
          <li class="{{ request()->is(["user/index", "user"]) ? "mm-active" : "" }}">
            <a href="{{ route("user.index") }}">
              <i class="fas fa-users mr-2"></i> List User
            </a>
          </li>
        @endcan
        <li class="{{ request()->is(["user/create"]) ? "mm-active" : "" }}">
          <a href="{{ route("user.create") }}">
            <i class="fas fa-users mr-2"></i> Add User
          </a>
        </li>
        <li class="{{ request()->is(["doge/withdraw"]) ? "mm-active" : "" }}">
          <a href="{{ route("doge.withdraw.create") }}">
            <i class="fas fa-store mr-2"></i> Withdraw
          </a>
        </li>
        <li class="{{ request()->is(["doge/history/income/*"]) ? "mm-active" : "" }}">
          <a class="has-arrow material-ripple" href="#" {{ request()->is(["doge/history/income/*"]) ? "aria-expanded='true'" : "" }}>
            <i class="fas fa-balance-scale-left mr-2"></i> Income Doge
          </a>
          <ul class="nav-second-level mm-collapse {{ request()->is(["doge/history/income/*"]) ? " mm-show" : "" }}">
            <li class="{{ request()->is(["doge/history/income/internal", "doge/history/income/internal/*"]) ? "mm-active" : "" }}">
              <a href="{{ route("doge.history", ["income", "internal"]) }}" {{ request()->is(["doge/history/income/internal", "doge/history/income/internal/*"]) ? "aria-expanded='true'" : "" }}>
                Internal
              </a>
            </li>
            <li class="{{ request()->is(["doge/history/income/external", "doge/history/income/external/*"]) ? "mm-active" : "" }}">
              <a href="{{ route("doge.history", ["income", "external"]) }}" {{ request()->is(["doge/history/income/external", "doge/history/income/external/*"]) ? "aria-expanded='true'" : "" }}>
                External
              </a>
            </li>
          </ul>
        </li>
        <li class="{{ request()->is(["doge/history/outcome/*"]) ? "mm-active" : "" }}">
          <a class="has-arrow material-ripple" href="#" {{ request()->is(["doge/history/outcome/*"]) ? "aria-expanded='true'" : "" }}>
            <i class="fas fa-balance-scale-right mr-2"></i> Outcome Doge
          </a>
          <ul class="nav-second-level mm-collapse {{ request()->is(["doge/history/outcome/*"]) ? " mm-show" : "" }}">
            <li class="{{ request()->is(["doge/history/outcome/internal", "doge/history/outcome/internal/*"]) ? "mm-active" : "" }}">
              <a href="{{ route("doge.history", ["outcome", "internal"]) }}" {{ request()->is(["doge/history/outcome/internal", "doge/history/outcome/internal/*"]) ? "aria-expanded='true'" : "" }}>
                Internal
              </a>
            </li>
            <li class="{{ request()->is(["doge/history/outcome/external", "doge/history/outcome/external/*"]) ? "mm-active" : "" }}">
              <a href="{{ route("doge.history", ["outcome", "external"]) }}" {{ request()->is(["doge/history/outcome/external", "doge/history/outcome/external/*"]) ? "aria-expanded='true'" : "" }}>
                External
              </a>
            </li>
          </ul>
        </li>
        <li class="{{ request()->is(["dashboard/android"]) ? "mm-active" : "" }}">
          <a href="{{ route("dashboard.android") }}">
            <i class="fab fa-google-play mr-2"></i> Android
          </a>
        </li>
        <li class="{{ request()->is(["dashboard/desktop"]) ? "mm-active" : "" }}">
          <a href="{{ route("dashboard.desktop") }}">
            <i class="fab fa-windows mr-2"></i> Desktop
          </a>
        </li>
        @can("Admin")
          <li {{ request()->is(["subscribe/config/*"]) ? "class='mm-active'" : "" }}>
            <a class="has-arrow material-ripple" href="#" {{ request()->is(["subscribe/config/*"]) ? "aria-expanded='true'" : "" }}>
              <i class="fas fa-donate mr-2"></i>
              Subscribe
            </a>
            <ul class="nav-second-level mm-collapse {{ request()->is(["subscribe/config/*"]) ? " mm-show" : "" }}">
              <li class="{{ request()->is(["subscribe/config"]) ? "mm-active" : "" }}">
                <a href="{{ route("subscribe.config.index") }}" {{ request()->is(["subscribe/config"]) ? "aria-expanded='true'" : "" }}>List</a>
              </li>
              <li class="{{ request()->is(["subscribe/config/edit"]) ? "mm-active" : "" }}">
                <a href="{{ route("subscribe.config.edit") }}" {{ request()->is(["subscribe/config/edit"]) ? "aria-expanded='true'" : "" }}>Edit</a>
              </li>
            </ul>
          </li>
        @endcan
        <li class="{{ request()->is(["line", "line/*"]) ? "mm-active" : "" }}">
          <a href="{{ route("line.index") }}">
            <i class="fab fas fa fa-network-wired mr-2"></i> Line
          </a>
        </li>
      </ul>
    </nav>
  </div>
</nav>
