@extends('layouts.admin')
@section('title', 'Passenger List')
@section('content')
<!-- Passenger Lists Start -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary rounded p-4">
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h5 class="mb-0">Passenger Lists</h5>
            <a href="{{ url('admin/passenger-history') }}" class="btn btn-warning"><i class="material-icons opacity-10"></i>Passenger History Lists</a>
        </div>
        <div class="table-responsive">
            <table class="table align-middle table-borderless table-hover mb-0 text-center">
                <thead>
                    <tr class="text-white table-primary">
                        <th>Flight Number</th>
                        <th>Name</th>
                        <th>Ticket Amount</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($tickets->isEmpty())
                    <tr>
                        <td colspan="5">No passenger has been booked.</td>
                    </tr>
                    @else
                    @foreach ($tickets as $ticket)
                    @php
                    $seat_prices = [];
                    $numberofPassengers = $ticket->adultPassengers + $ticket->childPassengers +
                    $ticket->infantPassengers;
                    $baggage_array = explode('|', $ticket->adds_on_baggage);
                    $baggage_sum = array_sum($baggage_array);
                    @endphp

                    @for ($i = 1; $i <= $numberofPassengers; $i++) @php $seat=explode('|', $ticket->seat);
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
                        <td>{{ $ticket->flight_number }}</td>
                        <td>{{ $ticket->last_name }} , {{ $ticket->first_name }} {{ $ticket->middle_initial }}</td>
                        <td>₱{{ $ticket->price * $numberofPassengers + $baggage_sum + $total_seat_price }}</td>
                        <td>{{ $ticket->status == '0' ? 'Pending' : ($ticket->status == '1' ? 'Approved' : 'Canceled') }}</td>
                        <td>
                            <a href="{{ url('admin/view-details/'.$ticket->id) }}" class="btn btn-primary btn-sm">Details</a>
                        </td>
                    </tr>
                   @endforeach
                   @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Passenger Lists End -->
@endsection
