@extends('layouts.front')

@section('title', 'Flight Reservation')
@section('content')
<div class=" container text-center mt-3">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-body">
                    <h1 class="mb-2 mt-0">Flight List</h1>
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
                            {{ $originAirportLocation }} ({{ $originAirportCode }})
                        </h4>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" style="width: 24px; height: 24px;">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                        </svg>
                        <h4>
                            {{ $destinationAirportLocation }} ({{ $destinationAirportCode }})
                        </h4>
                    </div>

                    <h5>Departure Flight to {{ $destinationAirportLocation }}</h5>

                    <a href="/" class="btn btn-primary">Change Flight</a>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-4">
                        Select your departing flight
                    </h4>
                    <table class="table">
                        <tr>
                            <th>Airline</th>
                            <th>Flight No</th>
                            <th>Departure Time</th>
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
                            <input name="arrival_date" type="hidden" value="{{ $result->arrival_date }}">
                            <input name="duration" type="hidden" value="{{ $result->duration }}">
                            <input name="price" type="hidden" value="{{ $result->price }}">
                            <input name="adultPassengers" type="hidden" value="{{ $adult }}">
                            <input name="childPassengers" type="hidden" value="{{ $child }}">
                            <input name="infantPassengers" type="hidden" value="{{ $infant }}">
                            <input name="seatClass" type="hidden" value="{{ $querySeatClass }}">
                            <input name="departure_date_return" type="hidden"
                                value="{{ $result->departure_date_return }}">
                            <input name="arrival_date_return" type="hidden" value="{{ $result->arrival_date_return }}">

                            <tr>

                                <td>{{ $result->airline->airline }}
                                </td>
                                <td> {{ $result->airline->flight_number }}
                                <td>{{ Carbon\Carbon::parse($result->departure_time)->format('H:i') }}</td>
                                <td>{{ Carbon\Carbon::parse($result->arrival_time)->format('H:i') }}</td>
                                
                                
                                <td>{{ $result->duration }}</td>
                                <td>₱{{ $result->price }}</td>
                                <td>
                                    <input required type="checkbox" id="checkbox_{{ $result->id }}"
                                        class="flight-checkbox" data-target="{{ $result->id }}" name="selected_flight"
                                        value="{{ $result->id }}">
                                    @if ($queryFlightType === "round_trip")
                                    {{-- <input required type="checkbox" id="checkbox_{{ $result->id }}"
                                        class="flight-checkbox" data-target="{{ $result->id }}" name="selected_flight"
                                        value="{{ $result->id }}"> --}}
                                    @else
                                    <button type=" submit" class="btn btn-primary">Book</button>

                                    @endif
                                </td>

                            </tr>

                        </form>
                        @empty
                        <tr>
                            <td  colspan="7" style="background: red; color: white; text-align: center;">No matching
                                flights found
                            </td>
                        </tr>
                        @endforelse

                        <!-- Repeat the above 'tr' for each flight -->
                    </table>
                </div>
            </div>
        </div>

        @if ($queryFlightType === "round_trip")
        <div class="col-md-12">
        <div id="return_flight_list" class="card mt-5">
            <div class="card-body">
                <h4 class="mb-4">
                    Select your returning flight
                </h4>
                <table class="table">
                    <tr>
                        <th>Airline</th>
                        <th>Flight No</th>
                        <th>Departure Time</th>
                        <th>Arrival Time</th>
                        <th>Duration</th>
                        <th>Price</th>
                        <th>Action</th>
                    </tr>
                    @forelse ($results as $result)

                    <form id="search-form" action="{{ route('continue-passenger-details', $result->id) }}" method="GET">
                        <input name="origin_id" type="hidden" value="{{ $result->origin_id }}">
                        <input name="destination_id" type="hidden" value="{{ $result->destination_id }}">
                        <input name="flight_type" id="flight_type" type="hidden" value="{{ $queryFlightType }}">
                        <input name="airline" type="hidden" value="{{ $result->airline->airline }}">
                        <input name="id" type="hidden" value="{{ $result->id }}">
                        <input name="departure_date" type="hidden" value="{{ $result->departure_date }}">
                        <input name="arrival_date" type="hidden" value="{{ $result->arrival_date }}">
                        <input name="duration" type="hidden" value="{{ $result->duration }}">
                        <input name="return_price" type="hidden" value="{{ $result->return_price }}">
                        <input name="adultPassengers" type="hidden" value="{{ $adult }}">
                        <input name="childPassengers" type="hidden" value="{{ $child }}">
                        <input name="infantPassengers" type="hidden" value="{{ $infant }}">
                        <input name="seatClass" type="hidden" value="{{ $querySeatClass }}">
                        <input name="departure_date_return" type="hidden" value="{{ $result->departure_date_return }}">
                        <input name="arrival_date_return" type="hidden" value="{{ $result->arrival_date_return }}">

                        <tr>
                            <td>{{ $result->airline->airline }}
                            </td>
                            <td> {{ $result->airline->return_flight_number}}</td>
                            <td>{{ Carbon\Carbon::parse($result->departure_time_return)->format('H:i') }}</td>
                            <td>{{ Carbon\Carbon::parse($result->arrival_time_return)->format('H:i') }}</td>
                            <td>{{ $result->duration }}</td>
                            <td>₱{{ $result->return_price }}</td>
                            <td>
                                {{-- <input name="selected_departure" id="selected_departure_{{ $result->id }}"
                                    class="departure-input" type="text" value=""> --}}

                                <input style="display:none;" name="selected_departure" id="selected_departure"
                                    class="departure-input" type="text" value="">

                                <input style="display:none;" name="selected_return" id="selected_return"
                                    class="departure-input" type="text" value="{{ $result->id }}">
                                <button type=" submit" class="btn btn-primary">Continue</button>
                            </td>
                        </tr>

                    </form>
                    @empty
                    <tr>
                        <td  colspan="7" style="background: red; color: white; text-align: center;">No matching
                            flights found
                        </td>
                    </tr>
                    @endforelse

                    <!-- Repeat the above 'tr' for each flight -->
                </table>
            </div>
        </div>
    </div>
        @endif

    </div>
</div>
@endsection


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const checkboxes = document.querySelectorAll('[name="selected_flight"]');
        const returnCheckboxes = document.querySelectorAll('[name="selected_return"]');

        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('change', function () {
                checkboxes.forEach(function (otherCheckbox) {
                    if (otherCheckbox !== checkbox) {
                        otherCheckbox.checked = false;
                    }
                    document.querySelectorAll("#selected_departure").forEach((selected) => {
                        selected.value = checkbox.value;
                    })
                });
            });
        });

        if (!window.location.href.includes('passenger-details')) {
            console.log("not passenger details")
            // Clear the localStorage
            localStorage.removeItem('currentStep');
            // Set the initial step to 1
            currentStep = 1;
        }
    });
</script>
