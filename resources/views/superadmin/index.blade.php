@extends('layouts.superadmin')
@section('title', 'Dashboard')
@section('content')
         <!-- Container Fluid-->
         <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
            </ol>
          </div>

          <div class="row mb-3">
            <div class="col-xl-4 col-sm-4 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Users</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $users }}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-user-friends fa-2x text-warning"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="col-xl-4 col-sm-4 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Total Flights</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $flights }}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-plane-departure fa-2x text-primary"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-4 col-sm-4 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Total Passengers</div>
                      <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $totalPassengers }}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-users fa-2x text-info"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-4 col-sm-4 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Airlines</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $airlines }}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fa fa-plane fa-2x text-primary"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-4 col-sm-4 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Airports</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $airports }}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fa fa-building fa-2x text-success"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
 
            <div class="col-xl-4 col-sm-4 mb-4">
              <div class="card h-100">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-uppercase mb-1">Total Tickets</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">₱{{ $totalTicketAmount }}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-ticket-alt fa-2x text-warning"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Today's Flight Table -->
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Today's Flight</h6>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>Flight No.</th>
                        <th>Departure Date</th>
                        <th>Arrival Date</th>
                        <th>Origin</th>
                        <th>Departure</th>
                        <th>Airline</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if($todayFlights->isEmpty())
                        <tr class="text-center">
                            <td colspan="7">No today's flight data</td>
                        </tr>
                        @else
                      @foreach ($todayFlights as $flight)
                      <tr>
                          <td>{{ $flight->airline->flight_number }}</td>
                          <td>{{ $flight->departure_date ? date('d M Y', strtotime($flight->departure_date)) : '' }}</td>
                          <td>{{ $flight->arrival_date ? date('d M Y', strtotime($flight->arrival_date)) : '' }}</td>
                          <td>{{ $flight->originAirport->location }} ({{ $flight->originAirport->code }})</td>
                          <td>{{ $flight->destinationAirport->location }} ({{ $flight->destinationAirport->code  }})</td>
                          <td>{{ $flight->airline->airline }}</td>
                          <td>
                            <form action="{{ url('superadmin/delay-flight', $flight->id) }}" method="post">
                              @csrf
                              <button type="submit" class="btn btn-warning btn-sm">Delay</button>
                          </form>
                          </td>
                      </tr>
                      @endforeach
                      @endif   
                    </tbody>
                  </table>
                </div>
                <div class="card-footer"></div>
              </div>
            </div>
            <!-- Today's Flight Issue Table -->
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Today's Flight Issue</h6>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>Flight No.</th>
                        <th>Departure Date</th>
                        <th>Arrival Date</th>
                        <th>Origin</th>
                        <th>Departure</th>
                        <th>Airline</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if($delayedFlights->isEmpty())
                      <tr class="text-center">
                          <td colspan="7">No today's flight issues data</td>
                      </tr>
                      @else 
                      @foreach ($delayedFlights as $flight)
                      <tr>
                          <td>{{ $flight->airline->flight_number }}</td>
                          <td>{{ $flight->departure_date ? date('d M Y', strtotime($flight->departure_date)) : '' }}</td>
                          <td>{{ $flight->arrival_date ? date('d M Y', strtotime($flight->arrival_date)) : '' }}</td>
                          <td>{{ $flight->originAirport->location }} ({{ $flight->originAirport->code }})</td>
                          <td>{{ $flight->destinationAirport->location }} ({{ $flight->destinationAirport->code  }})</td>
                          <td>{{ $flight->airline->airline }}</td>
                          <td>
                            <form action="{{ url('superadmin/move-back', $flight->id) }}" method="post">
                              @csrf
                              <button type="submit" class="btn btn-info btn-sm">Move</button>
                          </form>
                          </td>
                      </tr>
                      @endforeach
                      @endif    
                    </tbody>
                  </table>
                </div>
                <div class="card-footer"></div>
              </div>
            </div>
          </div>
          <!--Row-->



        </div>
        <!---Container Fluid-->
@endsection
