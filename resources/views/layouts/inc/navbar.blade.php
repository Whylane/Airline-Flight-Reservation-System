 <!-- Navbar Start -->
 <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
  <a href="{{ url('/admin/dashboard') }}" class="navbar-brand d-flex d-lg-none me-4">
  </a>
  <a href="#" class="sidebar-toggler flex-shrink-0">
      <i class="fa fa-bars"></i>
  </a>

  <div class="navbar-nav align-items-center ms-auto">
      <div class="nav-item dropdown">
          <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
              <img class="rounded-circle me-lg-2" src="img/user.jpg" alt="" style="width: 40px; height: 40px;">
              <span class="d-none d-lg-inline-flex">{{ Auth::user()->first_name }}</span>
          </a>
          <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                 {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form></a>
          </div>
      </div>
  </div>
</nav>
<!-- Navbar End -->