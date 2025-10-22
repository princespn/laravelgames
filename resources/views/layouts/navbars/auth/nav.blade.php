@php
    $getNavData = getUserDashboardDynamicData();
    $date = $getNavData['current_date'];
    //$withdrawDate = "Mon";
    $withdrawDate = $getNavData['project_withdraw_date'];
@endphp
@if (Session::has('toastr'))
    {!! Session::get('toastr') !!}
@endif


<style>
    .form-control,
    .form-select {
        color: #000;
/*         font-weight: 600 !important; */
    }
    a.VIpgJd-ZVi9od-l4eHX-hSRGPd {
    display: none;
}
ul#simple-bar {
    overflow: auto;
}
</style>
<script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
}
</script>
<?php
   $auth = Auth::user()->id;
   $is_compile = DB::table('tbl_users')
     ->join('tbl_topup as tp', 'tp.id', '=', 'tbl_users.id')
     ->where('tp.top_up_by', '=', $auth)
     ->where('tp.id', '!=', $auth)
     ->count();
?>
<!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
      <!-- Page Header Start-->
      <div class="page-header">
        <div class="header-wrapper row m-0">
          <form class="form-inline search-full col" action="#" method="get">
            <div class="form-group w-100">
              <div class="Typeahead Typeahead--twitterUsers">
                <div class="u-posRelative">
                  <input class="demo-input Typeahead-input form-control-plaintext w-100" type="text" placeholder="Search Riho .." name="q" title="" autofocus>
                  <div class="spinner-border Typeahead-spinner" role="status"><span class="sr-only">Loading... </span></div><i class="close-search" data-feather="x"></i>
                </div>
                <div class="Typeahead-menu"> </div>
              </div>
            </div>
          </form>
          <div class="header-logo-wrapper col-auto p-0">
            <div class="logo-wrapper"> <a href="{{url('/')}}"><img class="img-fluid for-light" src="{{ asset('/images/logo/logo_dark.png')}}" alt="logo-light"><img class="img-fluid for-dark" src="{{ asset('/images/logo/logo.png')}}" alt="logo-dark"></a></div>
            <div class="toggle-sidebar"> <i class="status_toggle middle sidebar-toggle" data-feather="align-center"></i></div>
          </div>
          <div class="left-header col-xxl-5 col-xl-6 col-lg-5 col-md-4 col-sm-3 p-0">
            <div> <a class="toggle-sidebar" href="javascript:void(0)"> <i class="iconly-Category icli"> </i></a>
              <div class="d-flex align-items-center gap-2 ">
                <h4 class="f-w-600">Welcome {{ Auth::user()->fullname }}</h4><img class="mt-0" src="{{ asset('/images/hand.gif')}}" alt="hand-gif">
              </div>
            </div>
            <div class="welcome-content d-xl-block d-none"><span class="text-truncate col-12">{{ Auth::user()->user_id }} </span></div>
          </div>
          <div class="nav-right col-xxl-7 col-xl-6 col-md-7 col-8 pull-right right-header p-0 ms-auto">
            <ul class="nav-menus">
              <li class="profile-nav onhover-dropdown">
                <div class="media profile-media"><img width="50" class="b-r-10" src="{{ asset('/images/user.png')}}" alt="">
                </div>
                <ul class="profile-dropdown onhover-show-div">
                  <li><a href="{{ url('/profile') }}"><i data-feather="user"></i><span>My Profile</span></a></li>
                  <li><a class="btn btn-pill btn-outline-primary btn-sm" href="javascript:void(0)" onclick="sidebarLogout()">Log Out</a></li>
                </ul>
              </li>
            </ul>
          </div>
         </div>
      </div>
      <!-- Page Header Ends                              -->
      <!-- Page Body Start-->
      <div class="page-body-wrapper">
        <!-- Page Sidebar Start-->
        <div class="sidebar-wrapper" data-layout="stroke-svg">
          <div class="logo-wrapper"><a href="{{url('/')}}"><img class="img-fluid" src="{{ asset('/images/logo/logo.png')}}" alt=""></a>
            <div class="back-btn"><i class="fa fa-angle-left"> </i></div>
            <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
          </div>
          <div class="logo-icon-wrapper"><a href="{{url('/')}}"><img class="img-fluid" src="{{ asset('/images/logo/logo-icon.png')}}" alt=""></a></div>
          <nav class="sidebar-main">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="sidebar-menu">
              <ul class="sidebar-links" id="simple-bar">
                <li class="back-btn"><a href="{{url('/')}}"><img class="img-fluid" src="{{ asset('/images/logo/logo-icon.png')}}" alt=""></a>
                  <div class="mobile-back text-end"> <span>Back </span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
                </li>
                <li class="pin-title sidebar-main-title">
                  <div>
                    <h6>Pinned</h6>
                  </div>
                </li>
                <li class="sidebar-main-title">
                  <div>
                    <h6></h6>
                  </div>
                </li>
                <li class="sidebar-list">
                  {{-- <i class="fa fa-thumb-tack"></i> --}}
                  <a class="sidebar-link sidebar-title link-nav" href="{{ url('/dashboard') }}">
                    <svg class="stroke-icon">
                      <use href="{{ asset('/svg/icon-sprite.svg#stroke-home')}}"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="{{ asset('/svg/icon-sprite.svg#fill-home')}}"></use>
                    </svg>
                    <span>STATION</span>
                  </a>
                </li>
                <li class="sidebar-list">
                  {{-- <i class="fa fa-thumb-tack"> </i> --}}
                  <a class="sidebar-link sidebar-title" href="javascript:void(0)">
                    <svg class="stroke-icon">
                      <use href="{{ asset('/svg/icon-sprite.svg#stroke-user')}}"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="{{ asset('/svg/icon-sprite.svg#fill-user')}}"></use>
                    </svg>
                    <span>Profile</span>
                  </a>
                  <ul class="sidebar-submenu">
                    <li><a href="{{ url('/profile') }}">Profile Management</a></li>
                    <li><a href="{{ url('/google2fa')}}">2FA</a></li>
                  </ul>
                </li>
                <li class="sidebar-list">
                  {{-- <i class="fa fa-thumb-tack"> </i> --}}
                  <a class="sidebar-link sidebar-title" href="javascript:void(0)">
                    <svg class="stroke-icon">
                      <use href="{{ asset('/svg/icon-sprite.svg#stroke-charts')}}"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="{{ asset('/svg/icon-sprite.svg#fill-charts')}}"></use>
                    </svg>
                    <span>Deposit</span>
                  </a>
                  <ul class="sidebar-submenu">
                    <li><a href="{{ url('/addfund') }}">Deposit Funds</a></li>
                    <li><a href="{{ url('/fundreport') }}">Deposit Report</a></li>
                  </ul>
                </li>
                <li class="sidebar-list">
                  {{-- <i class="fa fa-thumb-tack"> </i> --}}
                  <a class="sidebar-link sidebar-title" href="javascript:void(0)">
                    <svg class="stroke-icon">
                      <use href="{{ asset('/svg/icon-sprite.svg#stroke-ecommerce')}}"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="{{ asset('/svg/icon-sprite.svg#fill-ecommerce')}}"></use>
                    </svg>
                    <span>Power Station</span>
                  </a>
                  <ul class="sidebar-submenu">
                    <li><a href="{{ url('/topup') }}">Install Station</a></li>
                    <li><a href="{{ url('/topup-report') }}">Installation Report</a></li>
                    <li><a href="{{ url('/downline-topup-report') }}">Structure Report</a></li>
                  </ul>
                </li>
                <li class="sidebar-list">
                  {{-- <i class="fa fa-thumb-tack"> </i> --}}
                  <a class="sidebar-link sidebar-title" href="javascript:void(0)">
                    <svg class="stroke-icon">
                      <use href="{{ asset('/svg/icon-sprite.svg#stroke-learning')}}"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="{{ asset('/svg/icon-sprite.svg#fill-learning')}}"></use>
                    </svg>
                    <span>Station Network</span>
                  </a>
                  <ul class="sidebar-submenu">
                    <li><a href="{{ url('getlevelviewtree') }}">Station Tree</a></li>
                    <li><a href="{{ url('directsreport') }}">Direct Station</a></li>
                    <li><a href="{{ url('teamview') }}">Team Report</a></li>
                  </ul>
                </li>
                <li class="sidebar-list">
                  {{-- <i class="fa fa-thumb-tack"> </i> --}}
                  <a class="sidebar-link sidebar-title" href="javascript:void(0)">
                    <svg class="stroke-icon">
                      <use href="{{ asset('/svg/icon-sprite.svg#stroke-task')}}"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="{{ asset('/svg/icon-sprite.svg#fill-task')}}"></use>
                    </svg>
                    <span>Station Income</span>
                  </a>
                  <ul class="sidebar-submenu">
                    <li><a href="{{ url('rank-achived-reports-list') }}"> Milestone Attainment Report</a></li>
                    <li><a href="{{ url('rank-reward-reports-list') }}">Rank Income Report</a></li>
                    <li><a href="{{ url('matching-earning-report') }}">Matching Income Report</a></li>
                    <li><a href="{{ url('direct-earning') }}">Direct Income Report</a></li>
                    <li><a href="{{ url('roi-earning') }}">Power Return Income Report</a></li>
                  </ul>
                </li>
                <li class="sidebar-list">
                  {{-- <i class="fa fa-thumb-tack"> </i> --}}
                  <a class="sidebar-link sidebar-title" href="javascript:void(0)">
                    <svg class="stroke-icon">
                      <use href="{{ asset('/svg/icon-sprite.svg#stroke-form')}}"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="{{ asset('/svg/icon-sprite.svg#fill-form')}}"></use>
                    </svg>
                    <span>Withdrawal</span>
                  </a>
                  <ul class="sidebar-submenu">
                    <li><a href="{{ url('/wallet-withdrawal') }}">Income Withdrawal</a></li>
                    <li><a href="{{ url('/wallet-withdrawal-report') }}">Withdrawal Report</a></li>
                    <li><a href="{{ url('/structure-payout') }}">Structure Pull</a></li>
                    <li><a href="{{ url('/structure-payout-report') }}">Structure Pull Report</a></li>
                  </ul>
                </li>
                <li class="sidebar-list">
                  {{-- <i class="fa fa-thumb-tack"></i> --}}
                  <a class="sidebar-link sidebar-title link-nav" onclick="sidebarLogout()" href="javascript:void(0)">
                    <svg class="stroke-icon">
                      <use href="{{ asset('/svg/icon-sprite.svg#stroke-social')}}"></use>
                    </svg>
                    <svg class="fill-icon">
                      <use href="{{ asset('/svg/icon-sprite.svg#fill-social')}}"></use>
                    </svg>
                    <span>Logout</span>
                  </a>
                </li>
              </ul>
              <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
            </div>
          </nav>
        </div>
        <!-- Page Sidebar Ends-->

                                    
       

