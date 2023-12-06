<!-- TopBar -->
<nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
  <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
      <i class="fa fa-bars"></i>
  </button>
  <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown no-arrow mx-1">
        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-bell fa-fw"></i>
            @if(isset($userNotification['newUserCount']))
                <span class="badge badge-danger badge-counter">{{ $userNotification['newUserCount'] }}</span>
            @else
                <span class="badge badge-danger badge-counter">0</span>
            @endif
        </a>
        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
            aria-labelledby="alertsDropdown">
            <h6 class="dropdown-header">
                User
            </h6>
            @if ($userNotification['isNewUser'] && $userNotification['newUserCount'] > 0)
                <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="mr-3">
                        <div class="icon-circle bg-warning">
                            <i class="fas fa-user-alt text-white"></i>
                        </div>
                    </div>
                    <div>
                        <div class="small text-gray-500">{{ now()->format('F d, Y') }}</div>
                        <span class="font-weight-bold">New user(s) added:</span>
                        <ul style="list-style-type: none; padding: 0;">
                            @foreach ($userNotification['users'] as $newUser)
                                <li>{{ $newUser->first_name }} {{ $newUser->last_name }}</li>
                            @endforeach
                        </ul>
                    </div>
                </a>
            @else
                <a class="dropdown-item text-center small text-gray-500" href="#">
                    No new notifications
                </a>
            @endif
            <a class="dropdown-item text-center small text-gray-500" href="{{ url('superadmin/user-lists') }}">Show All Notifications</a>
        </div>
    </li>
      <div class="topbar-divider d-none d-sm-block"></div>
      <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">
              <img class="img-profile rounded-circle"
                  src="{{ asset('superadmin/img/superadmin.png') }}" style="max-width: 60px">
              <span class="ml-2 d-none d-lg-inline text-white small">{{ Auth::user()->first_name }} {{
                  Auth::user()->last_name }}</span>
          </a>
          <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" id="userDropdown"
              aria-labelledby="userDropdown">
              <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal"
                  data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  {{ __('Logout') }}
              </a>
          </div>
      </li>
  </ul>
</nav>
<!-- Topbar -->
