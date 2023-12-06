@extends('layouts.front')

@section('title', 'Flight Reservation')
@section('content')
<div class="container  my-5 step">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card mb-4">
                <div class="card-body">
                    <h2 class="mb-2 text-center text-primary">TICKETS</h2>
                    <div class="d-flex align-items-center justify-content-between">
                        <form action="{{ route('cancel-flight') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $ticket->id }}">
                            <input class="d-none" type="checkbox" checked name="status" disabled="disabled">
                            <button class="btn btn-danger" type="submit" data-bs-toggle="modal"
                                data-bs-target="#myModal">Cancel Flight</button>
                        </form>
                        <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                            data-bs-target="#myModal">Print</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Rate Experience Button -->
        <div class="text-end mb-3">
            <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#rateModal">Rate
                Experience</button>
        </div>
    </div>


    @php $numberofPassengers = $ticket->adultPassengers + $ticket->childPassengers + $ticket->infantPassengers; @endphp

    @php
    $first_names = explode('|', $ticket->first_name);
    $middle_initials = explode('|', $ticket->middle_initial);
    $last_names = explode('|', $ticket->last_name);
    $seat = explode('|', $ticket->seat);
    $ticket_id = explode('|', $ticket->ticket_id);
    @endphp



    @for ($i = 1; $i <= $numberofPassengers; $i++) <div class="card rounded-2  my-2">
        <header class="bg-primary py-3 rounded-2">
            <div class="row">
                <div class="col-md-8 d-flex justify-content-between px-5">
                    <h3>
                        <a class="navbar-brand" href="{{ url('/') }}">
                            <span class="brand-letter brand-letter-a">A</span>
                            <span class="brand-letter brand-letter-f">F</span>
                            <span class="brand-letter brand-letter-r">R</span>
                            <span class="brand-letter brand-letter-s">S</span>
                        </a>
                    </h3>
                    <div class="mr-3">
                        <h5 class="fw-bold m-0 text-white">BOARDING PASS</h5>
                        <p class="fw-normal text-uppercase text-center m-0 p-0 text-white">{{ $ticket->seatClass
                            }} CLASS
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mr-3">
                        <h5 class="fw-bold m-0 text-white">BOARDING PASS</h5>
                        <p class="fw-normal text-uppercase  m-0 p-0 text-white">{{ $ticket->seatClass
                            }} CLASS
                        </p>
                    </div>
                </div>
            </div>



        </header>
        <div class="card-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <!-- Content for the wider first column goes here -->
                        <div class="row mb-3 ">
                            <div class="col-md-4 text-left ">
                                <p class="m-0 text-muted">Airline</p>
                                <h5>{{ $ticket->airline }}</h5>
                                <!-- Content for the first column goes here -->
                            </div>
                            <div class="col-md-4">
                                <p class="m-0 text-muted">From</p>
                                <h5>{{ $ticket->destinationAirportLocation }}</h5>
                            </div>
                            <div class="col-md-4">
                                <p class="m-0 text-muted">To</p>
                                <h5>{{ $ticket->originAirportName }}</h5>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <p class="m-0 text-muted">Passenger Name</p>
                                <h5>{{ $first_names[$i - 1] }} {{ $middle_initials[$i - 1] }} {{ $last_names[$i - 1] }}
                                </h5>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <p class="m-0 text-muted">Booking ID</p>
                                {{-- <h5> {{ substr($ticket->flight_no, 0, 2) }} {{ substr($ticket->flight_no, 2) }}
                                </h5> --}}
                                <h5> {{ $ticket->booking_id }}</h5>
                            </div>
                            <div class="col-md-4">
                                <p class="m-0 text-muted">Boarding Time</p>
                                <h5> {{ \Carbon\Carbon::createFromFormat('h:i A', $ticket->departureTime)
                                    ->subMinutes(30)
                                    ->format('h:i A') }}</h5>
                            </div>
                            <div class="col-md-4">
                                <p class="m-0 text-muted">Date</p>
                                <h5>{{ $ticket->departure_date }}</h5>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <p class="m-0 text-muted">Gate</p>
                                <h5>{{ $ticket->gate }}</h5>
                            </div>
                            <div class="col-md-3">
                                <p class="m-0 text-muted">Seat</p>
                                <h5>{{ $seat[$i - 1] }}</h5>
                            </div>
                            <div class="col-md-3">
                                <p class="m-0 text-muted">Departure</p>
                                <h5>{{ $ticket->departureTime }}</h5>
                            </div>
                            <div class="col-md-3">
                                <p class="m-0 text-muted">Arrival</p>
                                <h5>{{ $ticket->arrivalTime }}</h5>
                            </div>
                        </div>
                        {{-- <div class="row mb-3">
                            <div class="col-md-3">
                                <p class="m-0 text-muted">Ticket ID</p>
                                <h5>{{ $ticket_id[$i - 1] ?? null }} </h5>
                            </div>
                        </div> --}}
                    </div>
                    <div class="col-md-4 dashed-border">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p class="m-0 text-muted">Booking ID</p>
                                {{-- <h6 class="fw-bold"> {{ substr($ticket->flight_no, 0, 2) }} {{
                                    substr($ticket->flight_no, 2) }}</h6> --}}
                                <h5> {{ $ticket->booking_id }}</h5>
                            </div>
                            <div class="col-md-6">
                                <p class="m-0 text-muted">Airline</p>
                                <h6 class="fw-bold">{{ $ticket->airline }}</h6>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p class="m-0 text-muted">Passenger Name</p>
                                <h6 class="fw-bold">
                                    {{ $first_names[$i - 1] }} {{ $middle_initials[$i - 1] }} {{ $last_names[$i - 1] }}
                                </h6>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p class="m-0 text-muted">From</p>
                                <h6 class="fw-bold">
                                    {{ $ticket->destinationAirportLocation }}
                                </h6>
                            </div>
                            <div class="col-md-6">
                                <p class="m-0 text-muted">To</p>
                                <h6 class="fw-bold">
                                    {{ $ticket->originAirportLocation }}
                                </h6>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <p class="m-0 text-muted">Date</p>
                                <h6 class="fw-bold">
                                    {{ $ticket->departure_date }}
                                </h6>
                            </div>
                            <div class="col-md-6">
                                <p class="m-0 text-muted">Boarding Time</p>
                                <h6 class="fw-bold">
                                    {{ \Carbon\Carbon::createFromFormat('h:i A', $ticket->departureTime)
                                    ->subMinutes(30)
                                    ->format('h:i A') }}
                                </h6>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <p class="m-0 text-muted">Gate</p>
                                <h6 class="fw-bold">
                                    {{ $ticket->gate }}
                                </h6>
                            </div>
                            <div class="col-md-4">
                                <p class="m-0 text-muted">Seat</p>
                                <h6 class="fw-bold">
                                    {{ $seat[$i - 1] }}
                                </h6>
                            </div>
                            <div class="col-md-4">
                                <p class="m-0 text-muted">Departure</p>
                                <h6 class="fw-bold">
                                    {{ $ticket->departureTime }}
                                </h6>
                            </div>
                            <div class="col-md-4">
                                <p class="m-0 text-muted">Arrival</p>
                                <h6 class="fw-bold">
                                    {{ $ticket->arrivalTime }}
                                </h6>
                            </div>
                        </div>
                        {{-- <div class="row mb-3">
                            <div class="col-md-12">
                                <p class="m-0 text-muted">Ticket ID</p>
                                <h6 class="fw-bold">
                                    {{ $ticket_id[$i - 1] ?? null }}
                                </h6>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>

        </div>
</div>


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

@php
$total_seat_price = array_sum($seat_prices);
@endphp

@endfor

<div class="rounded-1 p-2 card" style="margin-bottom: 70px; margin-top: 18px;">
    <h4>
        @php
        $baggage_array = explode('|', $ticket->adds_on_baggage);
        $baggage_sum = array_sum($baggage_array);
        @endphp
        Price: ₱{{ $ticket->price * $numberofPassengers + $baggage_sum + $total_seat_price }}

    </h4>
</div>
</div>


<!-- Modal -->
<div class="modal fade" id="rateModal" tabindex="-1" aria-labelledby="rateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="rateModalLabel">Rate Your Experience</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('rate-flight') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="rating" class="form-label">Rating</label>
                        <div class="star-rating">
                            <input type="radio" id="star5" name="rating" value="5" />
                            <label for="star5" title="5 stars"></label>
                            <input type="radio" id="star4" name="rating" value="4" />
                            <label for="star4" title="4 stars"></label>
                            <input type="radio" id="star3" name="rating" value="3" />
                            <label for="star3" title="3 stars"></label>
                            <input type="radio" id="star2" name="rating" value="2" />
                            <label for="star2" title="2 stars"></label>
                            <input type="radio" id="star1" name="rating" value="1" />
                            <label for="star1" title="1 star"></label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="comment" class="form-label">Comment</label>
                        <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                    </div>
                    <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

<style>
    .dashed-border {
        border-left: 1px dashed #000;
        /* You can adjust the color and width */
        padding-left: 10px;
        /* Add padding to separate content from the border */
    }
</style>

<style>
    /* Add this to your existing styles or create a new style block */
    .star-rating input[type="radio"] {
        display: none;
    }

    .star-rating label {
        font-size: 1.5em;
        padding: 0.3em;
        cursor: pointer;
        float: right;
    }

    .star-rating label:before {
        content: '\2605';
        /* Unicode character for a star */
    }

    .star-rating input[type="radio"]:checked~label:before {
        color: #ffcc00;
        /* Color for the selected stars */
    }
</style>