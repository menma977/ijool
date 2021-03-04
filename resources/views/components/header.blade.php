<nav class="navbar-custom-menu navbar navbar-expand-lg m-0">
  <div class="sidebar-toggle-icon" id="sidebarCollapse">
    sidebar toggle<span></span>
  </div><!--/.sidebar toggle icon-->
  <div class="d-flex flex-grow-1">
    <ul class="navbar-nav flex-row align-items-center ml-auto">
      <li class="nav-item dropdown quick-actions">
        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
          <i class="typcn typcn-th-large-outline"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right">
          <div class="nav-grid-row row">
            <a href="{{ route("doge.bet") }}" class="icon-menu-item col-4">
              <i class="fas fa-rocket d-block"></i>
              <span>BET</span>
            </a>
          </div>
        </div>
      </li>
      <li class="nav-item dropdown user-menu">
        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
          <i class="typcn typcn-user-add-outline"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-right">
          <div class="dropdown-header d-sm-none">
            <a href="#" class="header-arrow"><i class="icon ion-md-arrow-back"></i></a>
          </div>
          <div class="user-header">
            <div class="img-user">
              <img src="{{ $user->profile->image ? asset("storage/profile/".$user->profile->image) : asset("dist/img/logo_bg.png") }}" alt="{{ $user->name }}">
            </div><!-- img-user -->
            <h6>{{ $user->name }}</h6>
            <span>{{ $user->email }}</span>
          </div><!-- user-header -->
          <a href="{{ route("user.profile") }}" class="dropdown-item">
            <i class="typcn typcn-user-outline"></i> My Profile
          </a>
          <a href="{{ route("user.edit", \Illuminate\Support\Facades\Crypt::encryptString(\Illuminate\Support\Facades\Auth::id())) }}" class="dropdown-item">
            <i class="typcn typcn-edit"></i> Edit Profile
          </a>
          <a href="{{ route("logout") }}" class="dropdown-item" id="logout-web">
            <i class="typcn typcn-key-outline"></i> Sign Out
          </a>
        </div><!--/.dropdown-menu -->
      </li>
    </ul><!--/.navbar nav-->
    <div class="nav-clock">
      <div class="time">
        <span class="time-hours"></span>
        <span class="time-min"></span>
        <span class="time-sec"></span>
      </div>
    </div><!-- nav-clock -->
  </div>
</nav>