<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
</head>

<body>

    @php
    $first_names = explode('|', $ticket->first_name);
    $middle_initials = explode('|', $ticket->middle_initial);
    $last_names = explode('|', $ticket->last_name);
    $seat = explode('|', $ticket->seat);
    $ticket_id = explode('|', $ticket->ticket_id);
    @endphp

    @for ($i = 1; $i <= $additionalData["numberofPassengers"]; $i++) <div class="card">
        <header class="container">
            <div class="d-flex">
                <div class="logo">
                    <span>A</span>
                    <span class="yellow">F</span>
                    <span>R</span>
                    <span class="yellow">S</span>
                </div>
                <div>
                    <p class="title">Boarding Pass</p>
                    <p class="class">Economy Class</p>
                </div>
            </div>
            {{-- <div>
                <div>
                    <p class="title">Boarding Pass</p>
                    <p class="class">Economy Class</p>
                </div>
            </div> --}}
        </header>
        <main class="container">
            <div class="main">
                <div>
                    <h3>Airline</h3>
                    <p class="value">{{ $ticket->airline }}</p>
                </div>
                <div>
                    <h3>To</h3>
                    <p class="value">{{ $ticket->destinationAirportLocation }}</p>
                </div>
                <div>
                    <h3>From</h3>
                    <p class="value">{{ $ticket->destinationAirportLocation }}</p>
                </div>
                <div>
                    <h3>Passenger Name</h3>
                    <p class="value">
                        {{ $first_names[$i - 1] }} {{ $middle_initials[$i - 1] }}
                        {{ $last_names[$i - 1] }}
                    </p>
                </div>
                <div>
                    <h3>Flight Number</h3>
                    <p class="value">
                        {{ $ticket->flight_number }}
                    </p>
                </div>
                <div>
                    <h3>Gate</h3>
                    <p class="value">
                        {{ $ticket->gate }}
                    </p>
                </div>

                <div>
                    <h3>Seat</h3>
                    <p class="value">
                        {{ $ticket->seat }}
                    </p>
                </div>

                <div>
                    <h3>Boarding Time</h3>
                    <p class="value">
                        {{ \Carbon\Carbon::createFromFormat('h:i A',
                        $ticket->departureTime)
                        ->subMinutes(30)
                        ->format('h:i A') }} ON {{ $ticket->departure_date }}
                    </p>
                </div>

            </div>
        </main>
        </div>
        @endfor
</body>

</html>

<style>
    body {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: Arial, Helvetica, sans-serif;
    }

    h3 {
        line-height: 0;
        font-weight: normal;
        font-size: 16px;
        color: rgb(61, 58, 58);
    }

    .value {
        font-size: 18px;
        font-weight: bold;
    }

    .container {
        display: grid;
        grid-template-columns: 2fr 1fr;
        grid-template-rows: 1fr;
        gap: 0px 0px;
        grid-auto-flow: row;
        grid-template-areas: ". .";
        gap: 30px;
    }

    .card {
        width: 90%;
        border: 1px dashed black;
        margin: 0 auto;
        margin-bottom: 3rem;
    }

    header {
        background: rgb(41, 41, 183);
        color: white;
        padding: 1rem;
    }

    .logo {
        font-size: 2rem;
    }

    .title {
        font-weight: bold;
        text-transform: uppercase;
        margin: 0;
        padding: 0;
    }

    .class {
        display: inline-block;
    }

    .d-flex {
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .yellow {
        color: yellow;
    }

    .main {
        border-right: 2px dashed black;

        padding: 16px;
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        grid-template-rows: 1fr 1fr 1fr;
        gap: 0px 0px;
        grid-auto-flow: row;
        grid-template-areas:
            ". . ."
            ". . ."
            ". . .";
    }
</style>