@extends('layouts.superadmin')
@section('title', 'Flight Lists')
@section('content')
<!-- Flight Lists Start -->
<div class="container-fluid" id="container-wrapper">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Flight Lists</h1>
    <ol class="breadcrumb">
      {{-- <li class="breadcrumb-item"><a href="./">Home</a></li> --}}
      <li class="breadcrumb-item">Flights</li>
      <li class="breadcrumb-item active" aria-current="page">Flight Lists</li>
    </ol>
  </div>
          <!-- Row -->
          <div class="row">
            <!-- DataTable with Hover -->
            <div class="col-lg-12">
              <div class="card mb-4">
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                    <thead class="thead-light">
                      <tr>
                        <th>#</th>
                        <th>Flight Type</th>
                        <th>Airline</th>
                        <th>Route</th>
                        <th>Date & Time</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>    
                      @foreach ($flights as  $key => $flight)
                      <tr>
                          <td>{{ $key + 1 }}</td>
                          <td>  
                              @if ($flight->flight_type === 'one_way')
                              One Way
                              @elseif ($flight->flight_type === 'round_trip')
                              Round Trip
                              @endif
                          </td>
                          <td>{{ $flight->airline->airline}}</td>
                          <td>
                              @if ($flight->originAirport)
                                  <h6>Origin: </h6>{{ $flight->originAirport->location }}
                              @endif
                              @if ($flight->destinationAirport)
                                  <h6>Destination: </h6>{{ $flight->destinationAirport->location }}
                              @endif
                          <td>
                              <h6>Departure Date: </h6>{{ $flight->departure_date ? date('d M Y', strtotime($flight->departure_date)) : '' }}
                              <h6>Departure Time: </h6>{{ $flight->departure_time ? date('h:i A', strtotime($flight->departure_time)) : '' }}
                              <h6>Arrival Date: </h6>{{ $flight->arrival_date ? date('d M Y', strtotime($flight->arrival_date)) : '' }}
                              <h6>Arrival Time: </h6>{{ $flight->arrival_time ? date('h:i A', strtotime($flight->arrival_time)) : '' }}
                              <h6>Duration: </h6>{{ $flight->formatted_duration }}
                              @if ($flight->flight_type === 'round_trip')
                              <h6>Return Departure Date: </h6>{{ $flight->departure_date_return ? date('d M Y', strtotime($flight->departure_date_return)) : '' }}
                              <h6>Return Departure Time: </h6>{{ $flight->departure_time_return ? date('h:i A', strtotime($flight->departure_time_return)) : '' }}
                              <h6>Return Arrival Date: </h6>{{ $flight->arrival_date_return ? date('d M Y', strtotime($flight->arrival_date_return)) : '' }}
                              <h6>Return Arrival Time: </h6>{{ $flight->arrival_time_return ? date('h:i A', strtotime($flight->arrival_time_return)) : '' }}
                          @endif
                          </td>
                          <td>&#8369; {{ $flight->price }}</td>
                          <td>{{ $flight->status == '0' ? 'Pending' : ($flight->status == '1' ? 'Approve' : 'Reject') }}</td>
                          <td>
                            <form action="{{ url('superadmin/approve-flight', $flight->id) }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-success btn-sm mb-3">Approve</button>
                            </form>
                            <form action="{{ url('superadmin/reject-flight', $flight->id) }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                            </form>
                          
                        </td>
                        
                      </tr>
                      @endforeach
                  </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <!--Row-->
</div>
<!-- Flight lists End -->
@endsection