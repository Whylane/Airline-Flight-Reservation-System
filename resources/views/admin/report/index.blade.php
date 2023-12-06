@extends('layouts.admin')
@section('title', 'Passenger List')
@section('content')
<!-- Passenger Lists Start -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary rounded p-4">
    <!-- Filter Form -->
    <form action="{{ route('report.index') }}" method="get" id="filterForm">
        <div class="form-group" id="departureDateGroup">
            <label for="departure_date">Filter by Departure Date:</label>
            <input type="date" class="form-control mt-2 mb-2" name="departure_date" id="departure_date"
                value="{{ request('departure_date') }}">
        </div>

        <div class="form-group" id="returnDateGroup"
            style="display: {{ request('flight_type') === 'round_trip' ? 'block' : 'none' }};">
            <label for="departure_date_return">Filter by Return Date:</label>
            <input type="date" class="form-control mt-2 mb-2" name="departure_date_return" id="departure_date_return"
                value="{{ request('departure_date_return') }}">
        </div>

        <div class="form-group">    
            <label for="flight_type">Filter by Flight Type:</label>
            <select class="form-control bg-dark mt-2" name="flight_type" id="flight_type">
                <option value="all" @if(request('flight_type')==='all' ) selected @endif>All</option>
                <option value="one_way" @if(request('flight_type')==='one_way' ) selected @endif>One Way</option>
                <option value="round_trip" @if(request('flight_type')==='round_trip' ) selected @endif>Round Trip
                </option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Filter</button>
    </form>
        <div class="table-responsive">
            <div class="card-header">
                <h2>Booking History</h2>
            </div>
            <div class="card-body">
                @if($flights->isEmpty())
                <p>No passenger has been booked on this day</p>
                @else
            <table class="table align-middle table-borderless table-hover mb-0 text-center">
                <thead>
                    <tr class="text-white table-primary">
                        <th>#</th>
                        <th>Name</th>
                        <th>Ticket Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($fullyBookedPassengers as $book)
                    @php
                    $seat_prices = [];
                    $numberofPassengers = $book->adultPassengers + $book->childPassengers +
                    $book->infantPassengers;
                    $baggage_array = explode('|', $book->adds_on_baggage);
                    $baggage_sum = array_sum($baggage_array);
                    @endphp

                    @for ($i = 1; $i <= $numberofPassengers; $i++) @php $seat=explode('|', $book->seat);
                        @endphp

                        @if (in_array($seat[$i - 1], ["A1", "A2", "A3", "A4", "A5", "A6"]))
                        @php
                        $seat_prices[] = 390;
                        @endphp
                        @elseif (in_array($seat[$i - 1], ["B1", "B2", "B3", "B4", "B5", "B6"]))
                        @php
                        $seat_prices[] = 245;
                        @endphp
                        @else
                        @php
                        $seat_prices[] = 200;
                        @endphp
                        @endif
                        @endfor

                        @php
                        $total_seat_price = array_sum($seat_prices);
                        @endphp

                        <tr>
                            <td>{{ $book->id }}</td>
                            <td>{{ $book->last_name }}, {{ $book->first_name }} {{ $book->middle_initial }}</td>
                            <td>₱{{ $book->price * $numberofPassengers + $baggage_sum + $total_seat_price }}
                            </td>
                        </tr>
                        @endforeach
                </tbody>
            </table>
                    <!-- Display Total Price -->
                    <div class="mt-4">
                        <strong>Total Price:</strong> &#8369; {{ $totalTicketAmount }}
                    </div>
                    @endif
        </div>
        </div>
    </div>
</div>
<!-- Passenger Lists End -->
@endsection
