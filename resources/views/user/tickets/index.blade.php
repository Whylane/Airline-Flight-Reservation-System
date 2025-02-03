@extends('layouts.front')

@section('title', 'Flight Reservation')
@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">My Flights</h1>
    @if(session('warning'))
    <div class="alert alert-warning">
        {{ session('warning') }} <a href="mailto:afrs02642@gmail.com"><u>afrs02642@gmail.com</u></a>
    </div>
@endif
    <div class="card">
        <div class="card-body">
            <table class="table text-center">
                <thead class="table-primary">
                    <tr>
                        <th scope="col">Flight #</th>
                        <th scope="col">Destination</th>
                        <th scope="col">Origin</th>
                        <th scope="col">Airline</th>
                        <th scope="col">Status</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($tickets->isEmpty())
                    <tr>
                        <td colspan="6">You have no flights have been booked.</td>
                    </tr>
                    @else
                    @foreach ($tickets as $ticket)
                    <tr>
                        <td>{{ $ticket->flight_number }}</td>
                        <td>{{ $ticket->destinationAirportLocation }}</td>
                        <td>{{ $ticket->originAirportLocation }}</td>
                        <td>{{ $ticket->airline }}</td>
                        <td>{{ $ticket->status == '0' ? 'Pending' : ($ticket->status == '1' ? 'Approved' : 'Canceled') }}</td>
                        <td>
                            @if ($ticket->status == '0') {{-- Show actions for pending reservations --}}
                                <form action="{{ route('cancel-flight') }}" method="POST" id="cancelForm_{{ $ticket->id }}">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $ticket->id }}">
                                    <input class="d-none" type="checkbox" checked name="status" disabled="disabled">
                                    <button class="btn btn-danger btn-sm" type="button" data-bs-toggle="modal"
                                        data-bs-target="#cancelModal_{{ $ticket->id }}">Cancel Reservation</button>
                                </form>

                                <!-- Cancel Reservation Modal -->
                                <div class="modal fade" id="cancelModal_{{ $ticket->id }}" tabindex="-1" aria-labelledby="cancelModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="cancelModalLabel">Cancel Reservation</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                For voluntary cancellations, fares, taxes, and fees are generally non-refundable. However, passengers have the option to reschedule their flights for a different time up to <span class="highlight">two hours</span> before the scheduled departure, subject to applicable penalties and fare differences.
                                            </div>                                          
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-danger" onclick="document.getElementById('cancelForm_{{ $ticket->id }}').submit()">Confirm Cancel</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @elseif ($ticket->status == '2') {{-- Show actions for canceled reservations --}}
                                <form action="{{ route('rebook-flight') }}" method="POST" id="rebookForm_{{ $ticket->id }}">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $ticket->id }}">
                                    <button class="btn btn-success btn-sm" type="button" data-bs-toggle="modal"
                                        data-bs-target="#rebookModal_{{ $ticket->id }}">Rebook</button>
                                </form>

                                <!-- Rebook Modal -->
                                <div class="modal fade" id="rebookModal_{{ $ticket->id }}" tabindex="-1" aria-labelledby="rebookModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="rebookModalLabel">Rebook Flight</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                In this scenario, if the flight is considered to have taken place, the Passenger is not permitted to rebook the flight or apply for the creation of a Travel Fund. Consequently, the Passenger forfeits the Fare, surcharges, taxes, and fees paid, and these amounts are retained by the Airline.
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-success" onclick="submitRebookForm('{{ $ticket->id }}')">Confirm Rebook</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>
    </div>
</div>

<style>
    .modal-body {
        text-align: justify;
    }
    .highlight {
        background-color: yellow; 
        font-weight: bold; 
    }
</style>
<script>
    function submitRebookForm(ticketId) {
        document.getElementById('rebookForm_' + ticketId).submit();
    }
</script>

@endsection
