<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Website for infestation and treading">
  <meta name="author" content="IJOOL">
  <title>IJOOL</title>
  <!-- App favicon -->
  <link rel="shortcut icon" href="{{ asset("dist/img/favicon.png") }}">
  <!--Global Styles(used by all pages)-->
  <link href="{{ asset("plugins/bootstrap/css/bootstrap.min.css") }}" rel="stylesheet">
  <link href="{{ asset("plugins/metisMenu/metisMenu.min.css") }}" rel="stylesheet">
  <link href="{{ asset("plugins/fontawesome/css/all.min.css") }}" rel="stylesheet">
  <link href="{{ asset("plugins/typicons/src/typicons.min.css") }}" rel="stylesheet">
  <link href="{{ asset("plugins/themify-icons/themify-icons.min.css") }}" rel="stylesheet">
  <!--Third party Styles(used by this page)-->

  <!--Start Your Custom Style Now-->
  <link href="{{ asset("dist/css/style.css") }}" rel="stylesheet">
</head>
<body class="fixed">
<!-- Page Loader -->
<div class="page-loader-wrapper">
  <div class="loader">
    <div class="preloader">
      <div class="spinner-layer pl-green">
        <div class="circle-clipper left">
          <div class="circle"></div>
        </div>
        <div class="circle-clipper right">
          <div class="circle"></div>
        </div>
      </div>
    </div>
    <p>Please wait...</p>
  </div>
</div>
<!-- #END# Page Loader -->
<div class="wrapper">
  <!-- Sidebar  -->
  <nav class="sidebar sidebar-bunker">
    <div class="sidebar-header">
      <!--<a href="#" class="logo"><span>bd</span>task</a>-->
      <a href="#" class="logo"><img src="{{ asset("dist/img/logo.png") }}" alt=""></a>
    </div>
    <!--/.sidebar header-->
    <div class="profile-element d-flex align-items-center flex-shrink-0">
      <div class="avatar online">
        <img src="{{ asset("dist/img/avatar-1.jpg") }}" class="img-fluid rounded-circle" alt="">
      </div>
      <div class="profile-text">
        <h6 class="m-0">Naeem Khan</h6>
        <span>example@gmail.com</span>
      </div>
    </div>
    <!--/.profile element-->
    <form class="search sidebar-form" action="#" method="get">
      <div class="search__inner">
        <input type="text" class="search__text" placeholder="Search...">
        <i class="typcn typcn-zoom-outline search__helper" data-sa-action="search-close"></i>
      </div>
    </form>
    <!--/.search-->
    <div class="sidebar-body">
      <nav class="sidebar-nav">
        <ul class="metismenu">
          <li class="nav-label">Main Menu</li>
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
          <li>
            <a class="has-arrow material-ripple" href="#">
              <i class="typcn typcn-chart-pie-outline mr-2"></i>
              Charts
            </a>
            <ul class="nav-second-level">
              <li><a href="#">Flot Chart</a></li>
              <li><a href="#">Chart js</a></li>
              <li><a href="#">Morris Charts</a></li>
              <li><a href="#">Sparkline Charts</a></li>
              <li><a href="#">Am Charts</a></li>
              <li><a href="#">Chart Apex</a></li>
            </ul>
          </li>
          <li><a href="#"><i class="typcn typcn-messages mr-2"></i> Chat</a></li>
          <li>
            <a class="has-arrow material-ripple" href="#">
              <i class="typcn typcn-mail mr-2"></i>
              Mailbox
            </a>
            <ul class="nav-second-level">
              <li><a href="#">Mailbox</a></li>
              <li><a href="#">Mailbox Details</a></li>
              <li><a href="#">Compose</a></li>
            </ul>
          </li>
          <li>
            <a class="has-arrow material-ripple" href="#">
              <i class="typcn typcn-archive mr-2"></i>
              Tables
            </a>
            <ul class="nav-second-level">
              <li><a href="#">Bootstrap tables</a></li>
              <li>
                <a class="has-arrow" href="#" aria-expanded="false">Data tables</a>
                <ul class="nav-third-level">
                  <li><a href="#">Basic initialization</a></li>
                  <li><a href="#">Data sources</a></li>
                  <li><a href="#">API</a></li>
                  <li><a href="#">Styling</a></li>
                  <li><a href="#">Advanced initialization</a></li>
                  <li><a href="#">Bootstrap4</a></li>
                </ul>
              </li>
              <li><a href="#">FooTable</a></li>
              <li><a href="#">Jsgrid table</a></li>
            </ul>
          </li>
          <li>
            <a class="has-arrow material-ripple" href="#">
              <i class="typcn typcn-clipboard mr-2"></i>
              Forms
            </a>
            <ul class="nav-second-level">
              <li><a href="#">Basic Forms</a></li>
              <li><a href="#">Input group</a></li>
              <li><a href="#">Form Mask</a></li>
              <li><a href="#">Touchspin</a></li>
              <li><a href="#">Select</a></li>
              <li><a href="#">Cropper</a></li>
              <li><a href="#">Forms File Upload</a></li>
              <li><a href="#">CK Editor</a></li>
              <li><a href="#">Summernote</a></li>
              <li><a href="#">Form Wizaed</a></li>
              <li><a href="#">Markdown</a></li>
              <li><a href="#">Trumbowyg</a></li>
              <li><a href="#">Wysihtml5</a></li>
            </ul>
          </li>
          <li class="nav-label">Components</li>
          <li>
            <a class="has-arrow material-ripple" href="#">
              <i class="typcn typcn-coffee mr-2"></i>
              UI Elements
            </a>
            <ul class="nav-second-level">
              <li><a href="#">Buttons</a></li>
              <li><a href="#">Badges</a></li>
              <li><a href="#">Spinners</a></li>
              <li><a href="#">Tab</a></li>
              <li><a href="#">Notification</a></li>
              <li><a href="#">Tree View</a></li>
              <li><a href="#">Progressber</a></li>
              <li><a href="#">List View</a></li>
              <li><a href="#">Ratings</a></li>
              <li><a href="#">Date & Time Picker</a></li>
              <li><a href="#">Typography</a></li>
              <li><a href="#">Modals</a></li>
              <li><a href="#">iCheck, Toggle, pagination</a></li>
            </ul>
          </li>
          <li>
            <a class="has-arrow material-ripple" href="#">
              <i class="typcn typcn-world-outline mr-2"></i>
              Maps
            </a>
            <ul class="nav-second-level">
              <li><a href="#">Amcharts Map</a></li>
              <li><a href="#">gMaps</a></li>
              <li><a href="#">Data Maps</a></li>
              <li><a href="#">Jvector Maps</a></li>
              <li><a href="#">Google map</a></li>
              <li><a href="#">Snazzy Map</a></li>
            </ul>
          </li>
          <li>
            <a class="has-arrow material-ripple" href="#">
              <i class="typcn typcn-info-large-outline mr-2"></i>
              Icons
            </a>
            <ul class="nav-second-level">
              <li><a href="#">Bootstrap Icons</a></li>
              <li><a href="#">Fontawesome Icon</a></li>
              <li><a href="#">Flag Icons</a></li>
              <li><a href="#">Material Icons</a></li>
              <li><a href="#">Weather Icons </a></li>
              <li><a href="#">Line Icons</a></li>
              <li><a href="#">Pe Icons</a></li>
              <li><a href="#">Socicon Icons</a></li>
              <li><a href="#">Typicons Icons</a></li>
            </ul>
          </li>
          <li><a href="#"><i class="typcn typcn-gift mr-2"></i>Widgets</a></li>
          <li><a href="#"><i class="typcn typcn-calendar-outline mr-2"></i>Calendar</a></li>
          <li class="nav-label">Extra</li>
          <li>
            <a class="has-arrow material-ripple" href="#">
              <i class="typcn typcn-device-tablet mr-2"></i>
              App Views
            </a>
            <ul class="nav-second-level">
              <li><a href="#">Invoice</a></li>
              <li><a href="#">Invoice two</a></li>
              <li><a href="#">Horizontal timeline</a></li>
              <li><a href="#">Vertical timeline</a></li>
              <li><a href="#">Pricing Table</a></li>
              <li><a href="#">Range Slider</a></li>
              <li><a href="#">Carousel</a></li>
              <li><a href="#">Code editor</a></li>
              <li><a href="#">Grid System</a></li>
            </ul>
          </li>
          <li>
            <a class="has-arrow material-ripple" href="#">
              <i class="typcn typcn-book mr-2"></i>
              Authentication
            </a>
            <ul class="nav-second-level">
              <li><a href="#">Login</a></li>
              <li><a href="#">Register</a></li>
              <li><a href="#">Profile</a></li>
              <li><a href="#">Forget password</a></li>
              <li><a href="#">Lockscreen</a></li>
              <li><a href="#">404 Error</a></li>
              <li><a href="#">505 Error</a></li>
            </ul>
          </li>
          <li>
            <a class="has-arrow material-ripple" href="#">
              <i class="typcn typcn-flow-merge mr-2"></i>
              Multi Level Menu
            </a>
            <ul class="nav-second-level">
              <li><a href="#">Menu Item</a></li>
              <li><a href="#">Menu Item - 2</a></li>
              <li>
                <a class="has-arrow" href="#" aria-expanded="false">Level - 2</a>
                <ul class="nav-third-level">
                  <li><a href="#">Menu Item</a></li>
                  <li>
                    <a class="has-arrow" href="#" aria-expanded="false">Level - 3</a>
                    <ul class="nav-fourth-level">
                      <li><a href="#">Level - 4</a></li>
                    </ul>
                  </li>
                </ul>
              </li>
            </ul>
          </li>
          <li class="mm-active"><a href="#"><i class="typcn typcn-bookmark mr-2"></i>Blank page</a></li>
          <li>
            <a class="has-arrow material-ripple" href="#">
              <i class="typcn typcn-puzzle-outline mr-2"></i>
              Layouts
            </a>
            <ul class="nav-second-level">
              <li><a href="#">Layout</a></li>
              <li><a href="#">Fixed layout</a></li>
              <li><a href="#">Fixed layout without navbar</a></li>
            </ul>
          </li>
          <li><a href="#"><i class="typcn typcn-support mr-2"></i>Documentation</a></li>
        </ul>
      </nav>
    </div>
    <!-- sidebar-body -->
  </nav>
  <!-- Page Content  -->
  <div class="content-wrapper">
    <div class="main-content">
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
                  <a href="#" class="icon-menu-item col-4">
                    <i class="typcn typcn-cog-outline d-block"></i>
                    <span>Settings</span>
                  </a>
                  <a href="#" class="icon-menu-item col-4">
                    <i class="typcn typcn-group-outline d-block"></i>
                    <span>Users</span>
                  </a>
                  <a href="#" class="icon-menu-item col-4">
                    <i class="typcn typcn-puzzle-outline d-block"></i>
                    <span>Components</span>
                  </a>
                  <a href="#" class="icon-menu-item col-4">
                    <i class="typcn typcn-chart-bar-outline d-block"></i>
                    <span>Profits</span>
                  </a>
                  <a href="#" class="icon-menu-item col-4">
                    <i class="typcn typcn-time d-block"></i>
                    <span>New Event</span>
                  </a>
                  <a href="#" class="icon-menu-item col-4">
                    <i class="typcn typcn-edit d-block"></i>
                    <span>Tasks</span>
                  </a>
                </div>
              </div>
            </li><!--/.dropdown-->
            <li class="nav-item">
              <a class="nav-link" href="#"><i class="typcn typcn-messages"></i></a>
            </li>
            <li class="nav-item dropdown notification">
              <a class="nav-link dropdown-toggle badge-dot" href="#" data-toggle="dropdown">
                <i class="typcn typcn-bell"></i>
              </a>
              <div class="dropdown-menu dropdown-menu-right">
                <h6 class="notification-title">Notifications</h6>
                <p class="notification-text">You have 2 unread notification</p>
                <div class="notification-list">
                  <div class="media new">
                    <div class="img-user"><img src="{{ asset("dist/img/avatar.png") }}" alt=""></div>
                    <div class="media-body">
                      <h6>Congratulate <strong>Socrates Itumay</strong> for work anniversaries</h6>
                      <span>Mar 15 12:32pm</span>
                    </div>
                  </div><!--/.media -->
                  <div class="media new">
                    <div class="img-user online"><img src="{{ asset("dist/img/avatar2.png") }}" alt=""></div>
                    <div class="media-body">
                      <h6><strong>Joyce Chua</strong> just created a new blog post</h6>
                      <span>Mar 13 04:16am</span>
                    </div>
                  </div><!--/.media -->
                  <div class="media">
                    <div class="img-user"><img src="{{ asset("dist/img/avatar3.png") }}" alt=""></div>
                    <div class="media-body">
                      <h6><strong>Althea Cabardo</strong> just created a new blog post</h6>
                      <span>Mar 13 02:56am</span>
                    </div>
                  </div><!--/.media -->
                  <div class="media">
                    <div class="img-user"><img src="{{ asset("dist/img/avatar4.png") }}" alt=""></div>
                    <div class="media-body">
                      <h6><strong>Adrian Monino</strong> added new comment on your photo</h6>
                      <span>Mar 12 10:40pm</span>
                    </div>
                  </div><!--/.media -->
                </div><!--/.notification -->
                <div class="dropdown-footer"><a href="#">View All Notifications</a></div>
              </div><!--/.dropdown-menu -->
            </li><!--/.dropdown-->
            <li class="nav-item dropdown user-menu">
              <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">
              <!--<img  src="{{ asset("dist/img/user2-160x160.png") }}"  alt="">-->
                <i class="typcn typcn-user-add-outline"></i>
              </a>
              <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-header d-sm-none">
                  <a href="#" class="header-arrow"><i class="icon ion-md-arrow-back"></i></a>
                </div>
                <div class="user-header">
                  <div class="img-user">
                    <img src="{{ asset("dist/img/avatar-1.jpg") }}" alt="">
                  </div><!-- img-user -->
                  <h6>Naeem Khan</h6>
                  <span>example@gmail.com</span>
                </div><!-- user-header -->
                <a href="#" class="dropdown-item"><i class="typcn typcn-user-outline"></i> My Profile</a>
                <a href="#" class="dropdown-item"><i class="typcn typcn-edit"></i> Edit Profile</a>
                <a href="#" class="dropdown-item"><i class="typcn typcn-arrow-shuffle"></i> Activity Logs</a>
                <a href="#" class="dropdown-item"><i class="typcn typcn-cog-outline"></i> Account Settings</a>
                <a href="#" class="dropdown-item"><i class="typcn typcn-key-outline"></i> Sign Out</a>
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
      </nav><!--/.navbar-->
      <!--Content Header (Page header)-->
      <div class="content-header row align-items-center m-0">
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
      </div>
      <!--/.Content Header (Page header)-->
      <div class="body-content">
        <div class="card mb-4">
          <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
              <div>
                <h6 class="fs-17 font-weight-600 mb-0">Project status</h6>
              </div>
              <div class="text-right">
                <div class="actions">
                  <a href="#" class="action-item"><i class="ti-reload"></i></a>
                  <div class="dropdown action-item" data-toggle="dropdown">
                    <a href="#" class="action-item"><i class="ti-more-alt"></i></a>
                    <div class="dropdown-menu dropdown-menu-right">
                      <a href="#" class="dropdown-item">Refresh</a>
                      <a href="#" class="dropdown-item">Manage Widgets</a>
                      <a href="#" class="dropdown-item">Settings</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="card-body">
          </div>
        </div>
      </div><!--/.body content-->
    </div><!--/.main content-->
    <footer class="footer-content">
      <div class="footer-text d-flex align-items-center justify-content-between">
        <div class="copy">© 2018 Bdtask Responsive Bootstrap 4 Dashboard Template</div>
        <div class="credit">Designed by: <a href="#">Bdtask</a></div>
      </div>
    </footer><!--/.footer content-->
    <div class="overlay"></div>
  </div>
  <!--/.wrapper-->
</div>
<!--Global script(used by all pages)-->
<script src="{{ asset("plugins/jQuery/jquery-3.4.1.min.js") }}"></script>
<script src="{{ asset("dist/js/popper.min.js") }}"></script>
<script src="{{ asset("plugins/bootstrap/js/bootstrap.min.js") }}"></script>
<script src="{{ asset("plugins/metisMenu/metisMenu.min.js") }}"></script>
<script src="{{ asset("plugins/perfect-scrollbar/dist/perfect-scrollbar.min.js") }}"></script>
<!-- Third Party Scripts(used by this page)-->

<!--Page Active Scripts(used by this page)-->

<!--Page Scripts(used by all page)-->
<script src="{{ asset("dist/js/sidebar.js") }}"></script>
</body>
</html>