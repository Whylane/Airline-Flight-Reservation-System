@extends('layouts.email')

@section('content')
<div style="font-size: 16px; line-height: 1.6; padding: 10px;">
    <h1 style="font-size: 24px; font-weight: bold;">Flight Reservation Canceled</h1>

    <p>Dear {{ $ticket->user->first_name }} {{ $ticket->user->last_name }},</p>

    <p>&nbsp;&nbsp;&nbsp;We are truly sorry to inform you that your flight reservation has been <strong>cancelled</strong> due to the following reason/s:</p>

    <p><strong>Cancellation Reason:</strong><br>
    {{ $reason }}</p>

    <p><strong>Reservation Details:</strong></p>
    <ul>
        <li>Passenger Name:{{ str_replace('|', ",", $ticket->first_name) }} {{ str_replace('|', ",", $ticket->last_name) }}</li>
        <li>Flight No: {{ $ticket->flight_number }}</li>
        <li>Flight Date: {{ $ticket->departure_date }}</li>
        <li>Departure: {{ $ticket->destinationAirportLocation }}</li>
        <li>Arrival: {{ $ticket->originAirportLocation }}</li>
        <li>Status: Canceled</li>
    </ul>

    <p>&nbsp;&nbsp;&nbsp;If you have any questions or need further assistance, please contact our support team.</p>

    <p>&nbsp;&nbsp;&nbsp;We apologize for any inconvenience this may have caused.</p>

    <p>Best regard,<br>&nbsp;&nbsp;&nbsp;Airline Flight Reservation Team</p>
</div>
@endsection
