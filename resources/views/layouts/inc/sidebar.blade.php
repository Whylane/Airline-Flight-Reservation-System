  <!-- Sidebar Start -->
  <div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-secondary navbar-dark">
        <a href="{{ url('/admin/dashboard') }}" class="navbar-brand mx-4 mb-3">
            <div class="sidebar-brand-icon">
                <img src="{{ asset('assets/img/psu logo.png') }}" alt="Logo" height="40">
            </div>
            <div class="brand-text">PSU ACC</div>
        </a>
        <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">
                <img class="rounded-circle" src="{{ asset('admin/img/user.jpg') }}" alt="" style="width: 40px; height: 40px;">
                <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
            </div>
            <div class="ms-3">
                <h6 class="mb-0">{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</h6>
                <span>Admin</span>
            </div>
        </div>
        <div class="navbar-nav w-100">
            <a href="{{ url('admin/dashboard') }}" class="nav-item nav-link {{ Request::is('admin/dashboard') ? 'active' : '' }}"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
            <a href="{{ url('admin/flight') }}" class="nav-item nav-link {{ Request::is('admin/flight') ? 'active' : '' }}"><i class="fas fa-list-ul me-2"></i>Flight Lists</a>
            <a href="{{ url('admin/passenger') }}" class="nav-item nav-link {{ Request::is('admin/passenger') ? 'active' : '' }}"><i class="fas fa-users me-2"></i>Passenger Lists</a>
            <a href="{{ url('admin/airline') }}" class="nav-item nav-link {{ Request::is('admin/airline') ? 'active' : '' }}">
                <i class="fas fa-plane me-1"></i>
                {{ auth()->user()->airlines()->first()->airline }}
            </a>
            
            <a href="{{ url('admin/airport') }}" class="nav-item nav-link {{ Request::is('admin/airport') ? 'active' : '' }}"><i class="fa fa-building me-2"></i>Airports</a>
            <a href="{{ url('admin/report') }}" class="nav-item nav-link {{ Request::is('admin/report') ? 'active' : '' }}"><i class="fas fa-file-alt me-2"></i>Reports</a>
        </div>
    </nav>
</div>
<!-- Sidebar End -->
<style>
    .navbar-brand {
    font-family: 'Lato', sans-serif;
    font-weight: bolder;
    display: flex;
    align-items: center;
}

.sidebar-brand-icon {
    display: inline-block;
}

.brand-text {
    display: inline-block;
    margin-left: 10px; 
    vertical-align: middle;
}
</style>