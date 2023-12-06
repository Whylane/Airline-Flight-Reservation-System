@extends('layouts.front')

@section('title', 'Flight Reservation')
@section('content')
<div class=" container text-center mt-3">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-body">
                    <h1 class="mb-2 mt-0">Flight List </h1>
                    <span>
                        {{ \Carbon\Carbon::parse($queryDeparture)->format('M d Y, D.') }}
                    </span>
                    <div class="d-flex align-items-center gap-2 justify-content-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" style="width: 24px; height: 24px;">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
                        </svg>
                        <h4>
                            {{ $destinationAirportLocation }} ({{ $destinationAirportCode }})
                        </h4>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" style="width: 24px; height: 24px;">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                        </svg>
                        <h4>
                            {{ $originAirportLocation }} ({{ $originAirportCode }})
                        </h4>
                    </div>
                    <h5>Return Flight to {{ $originAirportLocation }}</h5>

                    <a href="/" class="btn btn-primary">Change Flight</a>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th>Airline</th>
                            <th>Flight No</th>
                            <th>Departure Date</th>
                            <th>Departure Time</th>
                            <th>Arrival Date</th>
                            <th>Arrival Time</th>
                            <th>Duration</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                        @forelse ($results as $result)
                        <form action="{{ route('continue-passenger-details', $result->id) }}" method="GET">
                            <input name="origin_id" type="hidden" value="{{ $result->origin_id }}">
                            <input name="destination_id" type="hidden" value="{{ $result->destination_id }}">
                            <input name="flight_type" id="flight_type" type="hidden" value="{{ $queryFlightType }}">
                            <input name="airline" type="hidden" value="{{ $result->airline->airline }}">
                            <input name="id" type="hidden" value="{{ $result->id }}">
                            <input name="departure_date" type="hidden" value="{{ $result->departure_date }}">
                            <input name="departure_date" type="hidden" value="{{ $result->departure_date }}">
                            <input name="arrival_date" type="hidden" value="{{ $result->arrival_date }}">
                            <input name="duration" type="hidden" value="{{ $result->duration }}">
                            <input name="price" type="hidden" value="{{ $result->price }}">
                            <input name="adultPassengers" type="hidden" value="{{ $adult }}">
                            <input name="childPassengers" type="hidden" value="{{ $child }}">
                            <input name="infantPassengers" type="hidden" value="{{ $infant }}">
                            <input name="seatClass" type="hidden" value="{{ $querySeatClass }}">
                            <tr>
                                <td>{{ $result->airline->airline }}
                                </td>
                                <td> {{ substr($result->flight_number, 0, 2) }} {{ substr($result->flight_number, 2) }}
                                </td>
                                <td>{{ $result->departure_date_return }}</td>
                                <td>{{ $result->departure_time_return }}</td>
                                <td>{{ $result->arrival_date_return }}</td>
                                <td>{{ $result->arrival_time_return }}</td>
                                <td>{{ $result->duration }}</td>
                                <td>₱{{ $result->price }}</td>
                                <td>
                                    <button type=" submit" class="btn btn-primary">Continue</button>
                                    {{-- @auth
                                    <button type=" submit" class="btn btn-primary">Continue</button>
                                    @else
                                    <a href="/login" class="btn btn-sm btn-primary">Continue</a>
                                    @endauth --}}
                                </td>
                            </tr>

                        </form>
                        @empty
                        <tr>
                            <td style="background: red; padding: .5rem 1reml; color: white;">No matching
                                flights found
                            </td>
                        </tr>
                        @endforelse

                        <!-- Repeat the above 'tr' for each flight -->
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


<script>
    if (!window.location.href.includes('passenger-details')) {
        console.log("not passenger details")
        // Clear the localStorage
        localStorage.removeItem('currentStep');
        // Set the initial step to 1
        currentStep = 1;
    }

</script>