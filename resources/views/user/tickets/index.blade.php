@extends('layouts.front')

@section('title', 'Flight Reservation')
@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">My Flights</h1>

    <div class="card">
        <div class="card-body">
            <table class="table text-center">
                <thead class="table-primary">
                    <tr>
                        <th scope="col" >Flight #</th>
                        <th scope="col">Destination</th>
                        <th scope="col">Origin</th>
                        <th scope="col">Airline</th>
                        <th scope="col">Status</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tickets as $ticket)
                    <tr>
                        <td>{{ $ticket->flight_number }}</td>
                        <td>{{ $ticket->destinationAirportLocation }}</td>
                        <td>{{ $ticket->originAirportLocation }}</td>
                        <td>{{ $ticket->airline }}</td>
                        <td>{{ $ticket->status == '0' ? 'Pending' : ($ticket->status == '1' ? 'Approved' : 'Canceled') }}</td>
                        <td>
                            @if ($ticket->status == '0') {{-- Show actions for pending reservations --}}
                                <form action="{{ route('cancel-flight') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $ticket->id }}">
                                    <input class="d-none" type="checkbox" checked name="status" disabled="disabled">
                                    <button class="btn btn-danger btn-sm" type="submit" data-bs-toggle="modal"
                                        data-bs-target="#myModal">Cancel Reservation</button>
                                </form>
                            @elseif ($ticket->status == '2') {{-- Show actions for canceled reservations --}}
                                <form action="{{ route('rebook-flight') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $ticket->id }}">
                                    <button class="btn btn-success btn-sm" type="submit">Rebook</button>
                                </form>
                            @endif
                        </td>
                        
                    </tr>
                    @endforeach

                    <!-- Add more rows as needed -->
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
