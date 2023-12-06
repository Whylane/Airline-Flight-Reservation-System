@extends('layouts.email')

@section('content')
<div style="font-size: 16px; line-height: 1.6; padding: 10px;">
    <h1 style="font-size: 24px; font-weight: bold;">Flight Reservation Approved</h1>

    <p>Dear {{ $ticket->user->first_name }} {{ $ticket->user->last_name }},</p>

    <p>&nbsp;&nbsp;&nbsp;Our team at airline flight reservation is delighted to inform you that your flight request has been successfully <strong>approved</strong>. Your travel details are confirmed, and you are all set for your upcoming journey.</p>

    <p><strong>Reservation Details:</strong></p>
    <ul>
        <li>Passenger Name:{{ str_replace('|', ",", $ticket->first_name) }} {{ str_replace('|', ",", $ticket->last_name) }}</li>
        <li>Flight No: {{ $ticket->flight_number }}</li>
        <li>Flight Date: {{ $ticket->departure_date }}</li>
        <li>Departure: {{ $ticket->destinationAirportLocation }}</li>
        <li>Arrival: {{ $ticket->originAirportLocation }}</li>
        <li>Status: Approved</li>
    </ul>

    <p>&nbsp;&nbsp;&nbsp;Thank you for choosing our services. We look forward to serving you.</p>

    <p>Best regard,<br>&nbsp;&nbsp;&nbsp;Airline Flight Reservation Team</p>
</div>
@endsection
