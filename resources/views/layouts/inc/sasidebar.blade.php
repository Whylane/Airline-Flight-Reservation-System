    <!-- Sidebar -->
    <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('superadmin/dashboard') }}">
        <div class="sidebar-brand-icon">
          <img src="{{ asset('assets/img/psu logo.png') }}" alt="Logo" height="40">
        </div>
        <div class="sidebar-brand-text mx-3" style="font-family: 'Lato', sans-serif; font-weight: bold;">PSU ACC</div>
      </a>
      <hr class="sidebar-divider my-0">
      <li class="nav-item {{ Request::is('superadmin/dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('superadmin/dashboard') }}">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>
      <hr class="sidebar-divider">
      <div class="sidebar-heading">
        Features
      </div>
      <li class="nav-item {{ Request::is('superadmin/', 'superadmin/create-flight', 'superadmin/flight-lists') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="{{ url('superadmin/') }}" data-toggle="collapse" data-target="#collapseFlight"
          aria-expanded="true" aria-controls="collapseFlight">
          <i class="fas fa-list-ul"></i>
          <span>Flights</span>
        </a>
        <div id="collapseFlight" class="collapse" aria-labelledby="headingFlight" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Flights</h6>
            {{-- <a class="collapse-item {{ Request::is('superadmin/create-flight') ? 'active' : '' }}" href="{{ url('superadmin/create-flight') }}">Add Flights</a> --}}
            <a class="collapse-item {{ Request::is('superadmin/flight-lists') ? 'active' : '' }}" href="{{ url('superadmin/flight-lists') }}">Flight Lists</a>
          </div>
        </div>
      </li>    
      <li class="nav-item {{ Request::is('superadmin/', 'superadmin/passenger-lists', 'superadmin/passenger-history') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePassenger" aria-expanded="true"
          aria-controls="collapsePassenger">
          <i class="far fa-id-card"></i>
          <span>Passengers</span>
        </a>
        <div id="collapsePassenger" class="collapse" aria-labelledby="headingPassenger" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Passengers</h6>
            <a class="collapse-item {{ Request::is('superadmin/passenger-lists') ? 'active' : '' }}" href="{{ url('superadmin/passenger-lists') }}">Passenger Lists</a>
            <a class="collapse-item {{ Request::is('superadmin/passenger-history') ? 'active' : '' }}" href="{{ url('superadmin/passenger-history') }}">Passenger History</a>
          </div>
        </div>
      </li>
      <li class="nav-item {{ Request::is('superadmin/', 'superadmin/create-airline', 'superadmin/airline-lists') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAirline" aria-expanded="true"
          aria-controls="collapseAirline">
          <i class="fas fa-plane"></i>
          <span>Airlines</span>
        </a>
        <div id="collapseAirline" class="collapse" aria-labelledby="headingAirline" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Airlines</h6>
            <a class="collapse-item {{ Request::is('superadmin/create-airline') ? 'active' : '' }}" href="{{ url('superadmin/create-airline') }}">Add Airlines</a>
            <a class="collapse-item {{ Request::is('superadmin/airline-lists') ? 'active' : '' }}" href="{{ url('superadmin/airline-lists') }}">Airline Lists</a>
          </div>
        </div>
      </li>
      {{-- <li class="nav-item {{ Request::is('superadmin/', 'superadmin/create-airport', 'superadmin/airport-lists') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAirport" aria-expanded="true"
          aria-controls="collapseAirport">
          <i class="fa fa-building"></i>
          <span>Airports</span>
        </a>
        <div id="collapseAirport" class="collapse" aria-labelledby="headingAirport" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Airports</h6>
            <a class="collapse-item {{ Request::is('superadmin/create-airport') ? 'active' : '' }}" href="{{ url('superadmin/create-airport') }}">Add Airports</a>
            <a class="collapse-item {{ Request::is('superadmin/airport-lists') ? 'active' : '' }}" href="{{ url('superadmin/airport-lists') }}">Airport Lists</a>
          </div>
        </div>
      </li> --}}
   <li class="nav-item {{ Request::is('superadmin/', 'superadmin/user-lists', 'superadmin/add-admin') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUser" aria-expanded="true"
          aria-controls="collapseUser">
          <i class="fas fa-users"></i>
          <span>Users</span>
        </a>
        <div id="collapseUser" class="collapse" aria-labelledby="headingUser" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Users</h6>
            <a class="collapse-item {{ Request::is('superadmin/user-lists') ? 'active' : '' }}" href="{{ url('superadmin/user-lists') }}">User Lists</a>
            <a class="collapse-item {{ Request::is('superadmin/add-admin') ? 'active' : '' }}" href="{{ url('superadmin/add-admin') }}">Add Admin</a>
          </div>
        </div>
      </li>
      <li class="nav-item {{ Request::is('superadmin/', 'superadmin/report') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseReport" aria-expanded="true"
          aria-controls="collapseReport">
          <i class="fas fa-file-alt"></i>
          <span>Reports</span>
        </a>
        <div id="collapseReport" class="collapse" aria-labelledby="headingReport" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Reports</h6>
            <a class="collapse-item {{ Request::is('superadmin/report') ? 'active' : '' }}" href="{{ url('superadmin/report') }}">Report</a>
          </div>
        </div>
      </li>
    </ul>
    <!-- Sidebar -->