<x-modal/>
<nav class="sidebar sidebar-bunker">
  <div class="sidebar-header">
    <a href="#" class="logo text-white"><span>IJOOL</span>.net</a>
    {{--    <a href="{{ route("welcome") }}" class="logo">--}}
    {{--      <img src="{{ asset("dist/img/logo_banner.png") }}" alt="logo">--}}
    {{--    </a>--}}
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
  <div class="search sidebar-form">
    <div class="search__inner">
      @if($user->subscribe)
        <button type="button" class="btn btn-warning btn-block rounded-pill" id="unsubscribe">
          unsubscribe
        </button>
      @else
        <button type="button" class="btn btn-danger btn-block rounded-pill" data-toggle="modal" data-target="#modal_subscribe">
          subscribe
        </button>
      @endif
    </div>
  </div>
  <div class="sidebar-body">
    <nav class="sidebar-nav">
      <ul class="metismenu">
        <li class="nav-label">Main Menu</li>
        <li class="{{ request()->is(['dashboard']) ? 'mm-active' : '' }}">
          <a href="{{ route("dashboard.index") }}">
            <i class="typcn typcn-home-outline mr-2"></i> Dashboard
          </a>
        </li>
        <li class="{{ request()->is(['doge/withdraw']) ? 'mm-active' : '' }}">
          <a href="{{ route("doge.withdraw.create") }}">
            <i class="fas fa-store mr-2"></i> Withdraw
          </a>
        </li>
      </ul>
    </nav>
  </div>
</nav>
