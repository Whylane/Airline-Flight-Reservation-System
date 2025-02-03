@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')
        <!-- Admin Dashboard Start -->
        <div class="container-fluid pt-4 px-4">
          <div class="row g-3">
              <div class="col-sm-4 col-xl-4">
                  <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                      <i class="fa fa-users fa-3x text-primary"></i>
                      <div class="ms-3">
                          <p class="mb-2">Total Passenger</p>
                          <h6 class="mb-0 text-center">{{ $totalPassengers }}</h6>
                      </div>
                  </div>
              </div>
              <div class="col-sm-4 col-xl-4">
                  <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fas fa-ticket-alt fa-3x text-primary"></i>
                      <div class="ms-3">
                          <p class="mb-2">Total Ticket</p>
                          <h6 class="mb-0 text-center">₱{{ $totalTicketAmount }}</h6>
                      </div>
                  </div>
              </div>
              <div class="col-sm-4 col-xl-4">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fas fa-plane-departure fa-3x text-primary"></i>
                      <div class="ms-3">
                          <p class="mb-2">Total Flight</p>
                          <h6 class="mb-0 text-center">{{ $flights }}</h6>
                      </div>
                </div>
            </div>

          </div>
      </div>
      
      <div class="container-fluid pt-4 px-4">
        <div class="row g-3">
            <div class="col-sm-4 col-xl-4">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fas fa-check-circle fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Available {{ auth()->user()->airlines()->first()->airline }}</p>
                        <h6 class="mb-0 text-center">{{ $airlines }}</h6>
                    </div>
                </div>
            </div>
    
            <div class="col-sm-4 col-xl-4">
                <div class="bg-secondary rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-building fa-3x text-primary"></i>
                    <div class="ms-3">
                        <p class="mb-2">Total Airports</p>
                        <h6 class="mb-0 text-center">{{ $airports }}</h6>
                    </div>
                </div>
            </div>
        </div>
      </div>

      <!-- Today's Flight Start -->
      <div class="container-fluid pt-4 px-4">
        <div class="bg-secondary text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Today's Flights</h6>
            </div>
            <div class="table-responsive">
                <table class="table text-center align-middle table-borderless table-hover mb-0">
                    <thead>
                        <tr class="text-white table-primary">
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
                        <tr>
                            <td colspan="7">No today's flight data</td>
                        </tr>
                        @else
                        @foreach ($todayFlights as $flight)
                        <tr>
                            <!-- Display non-delayed flight details -->
                            <td>{{ $flight->airline->flight_number }}</td>
                            <td>{{ $flight->departure_date ? date('d M Y', strtotime($flight->departure_date)) : '' }}</td>
                            <td>{{ $flight->arrival_date ? date('d M Y', strtotime($flight->arrival_date)) : '' }}</td>
                            <td>{{ $flight->originAirport->location }} ({{ $flight->originAirport->code }})</td>
                            <td>{{ $flight->destinationAirport->location }} ({{ $flight->destinationAirport->code  }})</td>
                            <td>{{ $flight->airline->airline }}</td>
                            <td>
                                <form action="{{ url('admin/delay-flight', $flight->id) }}" method="post">
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
        </div>
    </div>

    <!-- Today's Flight Issues Start -->
    <div class="container-fluid pt-4 px-4">
        <div class="bg-secondary text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <h6 class="mb-0">Today's Flight Issues</h6>
            </div>
            <div class="table-responsive">
                <table class="table text-center align-middle table-borderless table-hover mb-0">
                    <thead>
                        <tr class="text-white table-primary">
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
                        <tr>
                            <td colspan="7">No today's flight issues data</td>
                        </tr>
                        @else 
                        @foreach ($delayedFlights as $flight)
                        <tr>
                            <!-- Display delayed flight details -->
                            <td>{{ $flight->airline->flight_number }}</td>
                            <td>{{ $flight->departure_date ? date('d M Y', strtotime($flight->departure_date)) : '' }}</td>
                            <td>{{ $flight->arrival_date ? date('d M Y', strtotime($flight->arrival_date)) : '' }}</td>
                            <td>{{ $flight->originAirport->location }} ({{ $flight->originAirport->code }})</td>
                            <td>{{ $flight->destinationAirport->location }} ({{ $flight->destinationAirport->code  }})</td>
                            <td>{{ $flight->airline->airline }}</td>
                            <td>
                                <form action="{{ url('admin/move-back', $flight->id) }}" method="post">
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
        </div>
    </div>
      <!-- Admin Dashboard End -->
@endsection
