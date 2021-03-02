<x-modal/>
<div class="modal modal-warning fade" id="modal_subscribe" tabindex="-1" role="dialog" aria-labelledby="warningModalLabel" style="display: none;" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-weight-600" id="warningModalLabel">IJOOL subscribe</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body text-center">
        <div class="p-2 bg-warning text-black rounded mb-3 p-3 shadow-sm text-center position-relative overflow-hidden">
          <i class="decorative-icon fas fa fa-exclamation-circle opacity-25 fa-5x animated infinite pulse slower"></i>
          <div class="bg-dark text-white rounded p-2 mb-0">
            <h1>PRICE {{ $price ?? null }} DOGE</h1>
          </div>
        </div>
        <div class="alert alert-warning" role="alert">
          <p class="mb-0">
            By continuing this transaction,
            <label class="alert-link">winnings and losses</label>
            are completely the
            <label class="alert-link">responsibility of each users</label>.
          </p>
          <p class="mb-0">
            Application <label class="alert-link">is not responsible</label> for transactions made because it's entirely the
            <label class="alert-link">choice of the user</label>.
          </p>
        </div>
        <p class="mb-0">
          <b>This subscription will be automatically renewed, unsubscribe to stop.</b>
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <a href="{{ route("subscribe.agree") }}" class="btn btn-success">Agree</a>
      </div>
    </div>
  </div>
</div>

<nav class="sidebar sidebar-bunker">
  <div class="sidebar-header">
    <!--<a href="#" class="logo"><span>bd</span>task</a>-->
    <a href="{{ route("welcome") }}" class="logo">
      <img src="{{ asset("dist/img/logo_banner.png") }}" alt="logo">
    </a>
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
        <a href="{{ route("subscribe.agree") }}" class="btn btn-warning btn-block rounded-pill">
          unsubscribe
        </a>
      @else
        <button type="button" class="btn btn-danger btn-block rounded-pill" data-toggle="modal" data-target="#modal_subscribe">
          subscribe
        </button>
      @endif
    </div>
  </div>
  <div class="modal modal-warning fade" id="modal_subscribe" tabindex="-1" role="dialog" aria-labelledby="warningModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-600" id="warningModalLabel">IJOOL subscribe</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body text-center">
          <div class="p-2 bg-warning text-black rounded mb-3 p-3 shadow-sm text-center position-relative overflow-hidden">
            <i class="decorative-icon fas fa fa-exclamation-circle opacity-25 fa-5x animated infinite pulse slower"></i>
            <div class="bg-dark text-white rounded p-2 mb-0">
              <h1>PRICE {{ $price ?? null }} DOGE</h1>
            </div>
          </div>
          <div class="alert alert-warning" role="alert">
            <p class="mb-0">
              By continuing this transaction,
              <label class="alert-link">winnings and losses</label>
              are completely the
              <label class="alert-link">responsibility of each users</label>.
            </p>
            <p class="mb-0">
              Application <label class="alert-link">is not responsible</label> for transactions made because it's entirely the
              <label class="alert-link">choice of the user</label>.
            </p>
          </div>
          <p class="mb-0">
            <b>This subscription will be automatically renewed, unsubscribe to stop.</b>
          </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <a href="{{ route("subscribe.agree") }}" class="btn btn-success">Agree</a>
        </div>
      </div>
    </div>
  </div>
  <div class="sidebar-body">
    <nav class="sidebar-nav">
      <ul class="metismenu">
        <li class="nav-label">Main Menu</li>
        <li class="mm-active">
          <a href="{{ route("dashboard.index") }}">
            <i class="typcn typcn-home-outline mr-2"></i> Dashboard
          </a>
        </li>
        <li>
          <a class="has-arrow material-ripple" href="#">
            <i class="typcn typcn-home-outline mr-2"></i>
            Dashboard
          </a>
          <ul class="nav-second-level">
            <li><a href="#">Default</a></li>
            <li><a href="#">Dashboard Two</a></li>
          </ul>
        </li>
      </ul>
    </nav>
  </div>
</nav>