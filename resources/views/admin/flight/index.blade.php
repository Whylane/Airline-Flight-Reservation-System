@extends('layouts.admin')
@section('title', 'Flight Lists')
@section('content')
  <!-- Flight Lists Start -->
  <div class="container-fluid pt-4 px-4">
    <div class="bg-secondary rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h5 class="mb-0">Flight Lists</h5>
            <a href="{{ url('admin/create-flight') }}" class="btn btn-primary"><i class="fas fa-plus me-2"></i>Add Flight</a>
        </div>
        <div class="table-responsive">
            <table class="table align-middle table-borderless table-hover mb-0 text-center text-white">
                <thead>
                    <tr class="table-primary">
                        <th scope="col">#</th>
                        <th scope="col">Flight Type</th>
                        <th scope="col">Airline</th>
                        <th scope="col">Route</th>
                        <th scope="col">Date & Time</th>
                        <th scope="col">Price</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($flights as $flight)
                    <tr>
                        <td>{{ $flight->id }}</td>
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
                            <h6>Duration: </h6> {{ $flight->formatted_duration }}
                            @if ($flight->flight_type === 'round_trip')
                            <h6>Return Departure Date: </h6>{{ $flight->departure_date_return ? date('d M Y', strtotime($flight->departure_date_return)) : '' }}
                            <h6>Return Departure Time: </h6>{{ $flight->departure_time_return ? date('h:i A', strtotime($flight->departure_time_return)) : '' }}
                            <h6>Return Arrival Date: </h6>{{ $flight->arrival_date_return ? date('d M Y', strtotime($flight->arrival_date_return)) : '' }}
                            <h6>Return Arrival Time: </h6>{{ $flight->arrival_time_return ? date('h:i A', strtotime($flight->arrival_time_return)) : '' }}
                        @endif
                        </td>
                        <td>&#8369; {{ $flight->price }}</td>
                        <td>
                            <a href="{{ url('admin/edit-flight/'.$flight->id) }}" class="btn btn-success btn-sm">Update</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
  <!-- Flight Lists End -->
@endsection
